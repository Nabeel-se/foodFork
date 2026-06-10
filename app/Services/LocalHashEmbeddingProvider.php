<?php

namespace App\Services;

use App\Interfaces\EmbeddingProvider;

class LocalHashEmbeddingProvider implements EmbeddingProvider
{
    public function __construct(public int $dimensions = 256) {}

    /**
     * @return list<float>
     */
    public function embed(string $text): array
    {
        $normalized = trim(mb_strtolower($text));

        if ($normalized === '') {
            return [];
        }

        $dimensions = max($this->dimensions, 32);
        $vector = array_fill(0, $dimensions, 0.0);

        preg_match_all('/[a-z0-9]+/u', $normalized, $matches);
        $tokens = $matches[0] ?? [];

        if ($tokens === []) {
            return $vector;
        }

        foreach ($tokens as $token) {
            $hash = crc32($token);
            $index = (int) ($hash % $dimensions);
            $direction = ($hash & 1) === 0 ? 1.0 : -1.0;
            $weight = 1.0 + (min(strlen($token), 16) / 16);
            $vector[$index] += $direction * $weight;
        }

        $norm = 0.0;

        foreach ($vector as $value) {
            $norm += $value * $value;
        }

        if ($norm <= 0.0) {
            return $vector;
        }

        $scale = sqrt($norm);

        return array_values(array_map(static fn (float $value): float => $value / $scale, $vector));
    }
}
