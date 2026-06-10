<?php

namespace App\Providers;

use App\Interfaces\EmbeddingProvider;
use App\Services\LocalHashEmbeddingProvider;
use App\Services\OpenAiEmbeddingProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(EmbeddingProvider::class, function (): EmbeddingProvider {
            $driver = (string) config('services.embeddings.driver', 'local');

            if ($driver === 'openai') {
                return new OpenAiEmbeddingProvider(
                    apiKey: (string) config('services.openai.key', ''),
                    model: (string) config('services.openai.embedding_model', 'text-embedding-3-small'),
                    endpoint: (string) config('services.openai.embedding_endpoint', 'https://api.openai.com/v1/embeddings'),
                    timeout: (int) config('services.openai.timeout', 15),
                );
            }

            return new LocalHashEmbeddingProvider(
                dimensions: (int) config('services.embeddings.local_dimensions', 256),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
