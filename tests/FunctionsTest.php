<?php

declare(strict_types=1);

namespace WordStats\Tests;

use Generator;
use PHPUnit\Framework\TestCase;
use function WordStats\getTopWords;

final class FunctionsTest extends TestCase
{
    /**
     * @dataProvider dataSuccessDataProvider
     */
    public function testSuccess(array $expected, string $string): void
    {
        $result = getTopWords($string, 5);

        $this->assertSame($expected, $result);
    }

    public function dataSuccessDataProvider(): Generator
    {
        yield 'empty case' => [
            [],
            '',
        ];

        yield 'english case1' => [
            [
                'one' => 4,
                'test' => 4,
                'two' => 3,
                'one123test' => 1,
            ],
            'One"one-one?one one123test two tWo two Test test test test,',
        ];

        yield 'english case2' => [
            [
                'one' => 5,
                'test' => 4,
                'two' => 3,
                'three' => 2,
                'etc' => 1,
            ],
            'Test test test test,One"one-one?one one two tWo two three etc thrEe four five sIx seven',
        ];

        yield 'spanish case' => [
            [
                'uno' => 2,
                'pequeña' => 1,
                'unouno' => 1,
                'dos' => 1,
                'tres' => 1,
            ],
            'pequeña uno,--- unouno, uno,,,,dos=Tres-cuatro?cinco',
        ];

        yield 'russian case' => [
            [
                'один' => 4,
                'два' => 3,
                'пять' => 1,
                'четыре' => 1,
                'три' => 1,
            ],
            'пять четыре???? три два, два--- вад два один один один один ?, ---',
        ];
    }
}
