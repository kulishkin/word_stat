<?php

declare(strict_types=1);

namespace WordStats;

use function array_slice;
use function arsort;
use function mb_strtolower;
use function preg_match_all;
use const SORT_NUMERIC;

function getTopWords(string $string, int $numberOfTop): array
{
    preg_match_all('/\b(\w+)\b/ui', $string, $matches);

    $result = [];
    foreach ($matches[1] ?? [] as $word) {
        $normalizedWord = mb_strtolower($word);
        $result[$normalizedWord] = ($result[$normalizedWord] ?? 0) + 1;
    }
    arsort($result, SORT_NUMERIC);

    return array_slice($result, 0, $numberOfTop);
}
