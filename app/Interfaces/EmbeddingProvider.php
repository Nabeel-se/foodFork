<?php

namespace App\Interfaces;

interface EmbeddingProvider
{
    /**
     * Convert text into an embedding vector.
     *
     * @return list<float>
     */
    public function embed(string $text): array;
}
