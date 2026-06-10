<?php

namespace App\Services;

use App\Interfaces\EmbeddingProvider;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class OpenAiEmbeddingProvider implements EmbeddingProvider
{
    public function __construct(
        public string $apiKey,
        public string $model,
        public string $endpoint,
        public int $timeout,
    ) {}

    /**
     * @return list<float>
     */
    public function embed(string $text): array
    {
        $text = trim($text);

        if ($text === '') {
            return [];
        }

        if ($this->apiKey === '') {
            throw new RuntimeException('OPENAI_API_KEY is not configured.');
        }

        $payload = Http::timeout($this->timeout)
            ->withToken($this->apiKey)
            ->acceptJson()
            ->post($this->endpoint, [
                'model' => $this->model,
                'input' => $text,
            ])
            ->throw()
            ->json();

        $embedding = data_get($payload, 'data.0.embedding');

        if (! is_array($embedding)) {
            throw new RuntimeException('Invalid embedding response payload.');
        }

        return array_values(array_map(static fn (mixed $value): float => (float) $value, $embedding));
    }
}
