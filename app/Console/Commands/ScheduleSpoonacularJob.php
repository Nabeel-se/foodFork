<?php

namespace App\Console\Commands;

use App\Jobs\FetchSpoonacularRecipes;
use Illuminate\Console\Command;

class ScheduleSpoonacularJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-spoonacular-recipes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatches the FetchSpoonacularRecipes job to fetch and upsert data.';

    public function handle(): int
    {
        FetchSpoonacularRecipes::dispatch()->onQueue('imports');

        $this->info('FetchSpoonacularRecipes job has been dispatched.');

        return self::SUCCESS;
    }
}
