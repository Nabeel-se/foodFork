<?php

namespace App\Console\Commands;

use App\Interfaces\EmbeddingProvider;
use App\Models\Recipe;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Throwable;

class BackfillRecipeEmbeddings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recipes:embeddings-backfill {--chunk=100 : Number of recipes per batch} {--dry-run : Generate embeddings but do not persist} {--preview-only : Build embedding text only (no API call, no writes)} {--only-missing : Process only recipes where embedding is null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill recipe embeddings for semantic search.';

    public function __construct(private readonly EmbeddingProvider $embeddingProvider)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $chunkSize = (int) $this->option('chunk');
        $dryRun = (bool) $this->option('dry-run');
        $previewOnly = (bool) $this->option('preview-only');
        $onlyMissing = (bool) $this->option('only-missing');

        if ($chunkSize < 1) {
            $this->error('The --chunk option must be at least 1.');

            return self::INVALID;
        }

        $processed = 0;
        $updated = 0;
        $failed = 0;
        $previewed = 0;

        $query = Recipe::query()->select([
            'id',
            'title',
            'summary',
            'instructions',
            'dish_types',
            'diets',
            'calories',
            'protein',
            'protein_unit',
            'fat',
            'fat_unit',
            'ready_in_minutes',
            'servings',
            'embedding',
        ]);

        if ($onlyMissing) {
            $query->whereNull('embedding');
        }

        $total = (clone $query)->count();

        if ($total === 0) {
            $this->info('No recipes found. Nothing to backfill.');

            return self::SUCCESS;
        }

        $this->info('Backfilling embeddings for '.$total.' recipes (chunk='.$chunkSize.', dry-run='.($dryRun ? 'yes' : 'no').', preview-only='.($previewOnly ? 'yes' : 'no').', only-missing='.($onlyMissing ? 'yes' : 'no').').');
        $progressBar = $this->output->createProgressBar($total);
        $progressBar->start();

        $query->orderBy('id')->chunkById($chunkSize, function ($recipes) use ($dryRun, $previewOnly, &$processed, &$updated, &$failed, &$previewed, $progressBar): void {
            foreach ($recipes as $recipe) {
                try {
                    $text = $this->buildEmbeddingText($recipe);

                    if ($previewOnly) {
                        $previewed++;
                        $processed++;
                        $progressBar->advance();

                        continue;
                    }

                    $embedding = $this->embeddingProvider->embed($text);

                    if ($embedding === []) {
                        $failed++;
                        $progressBar->advance();

                        continue;
                    }

                    if (! $dryRun) {
                        DB::table('recipes')
                            ->where('id', $recipe->id)
                            ->update([
                                'embedding' => json_encode($embedding, JSON_THROW_ON_ERROR),
                                'updated_at' => now(),
                            ]);
                    }

                    $updated++;
                } catch (Throwable $throwable) {
                    $failed++;
                    $this->newLine();
                    $this->warn('Recipe ID '.$recipe->id.' failed: '.$throwable->getMessage());
                }

                $processed++;
                $progressBar->advance();
            }
        });

        $progressBar->finish();
        $this->newLine(2);
        $this->info('Embedding backfill completed.');
        $this->line('Processed: '.$processed);
        $this->line('Embedded: '.$updated);
        $this->line('Previewed: '.$previewed);
        $this->line('Failed: '.$failed);

        return self::SUCCESS;
    }

    private function buildEmbeddingText(Recipe $recipe): string
    {
        $parts = [
            'title: '.trim((string) $recipe->title),
            'summary: '.trim(strip_tags((string) $recipe->summary)),
            'instructions: '.trim(strip_tags((string) $recipe->instructions)),
            'dish_types: '.$this->normalizeList($recipe->dish_types),
            'diets: '.$this->normalizeList($recipe->diets),
            'nutrition: calories='.$this->nullableScalar($recipe->calories).', protein='.$this->nullableScalar($recipe->protein).' '.trim((string) $recipe->protein_unit).', fat='.$this->nullableScalar($recipe->fat).' '.trim((string) $recipe->fat_unit),
            'meal: ready_in_minutes='.$this->nullableScalar($recipe->ready_in_minutes).', servings='.$this->nullableScalar($recipe->servings),
        ];

        return implode("\n", $parts);
    }

    private function normalizeList(mixed $value): string
    {
        if (! is_array($value)) {
            return '';
        }

        $items = array_values(array_filter(array_map(static fn (mixed $item): string => trim((string) $item), $value), static fn (string $item): bool => $item !== ''));

        return implode(', ', $items);
    }

    private function nullableScalar(mixed $value): string
    {
        if ($value === null) {
            return '';
        }

        return trim((string) $value);
    }
}
