<?php

/**
 * TODO:
 * Complete FractionAssembler::assemble() logic. 
 * Read class description and test cases for understanding requirements.
 * FYI:
 * Sample implementation of FractionAssembler class is simple - it takes 100 lines, it uses 5 native php functions, no complicated logic.
 */

test();

/**
 * Class logic assembles rendering result from fractions and their additional extensions.
 * For instance time left, file size output. Possible result examples:
 * 5 days, 10 hours 30 minutes 45 seconds
 * 5 10:30:45
 * 5d 10h 30m 45s
 * 5Gb 10Mb 30Kb 45B
 *
 * It is configurable to trim zero values from left and right sides.
 * And perform final trimming of separation characters.
 */
class FractionAssembler
{
    /** @var array */
    protected $fractions;
    /** @var array */
    protected $extensions;
    /** @var bool */
    protected $isTrimLeftZeros;
    /** @var bool */
    protected $isTrimRightZeros;
    /** @var string */
    protected $trimCharList;

    public function __construct(array $fractions, array $optionals = [])
    {
        $this->fractions = $fractions;
        $this->extensions = $optionals['extensions'] ?? array_fill(0, count($fractions), ' ');
        $this->isTrimLeftZeros = $optionals['trimLeftZeros'] ?? false;
        $this->isTrimRightZeros = $optionals['trimRightZeros'] ?? false;
        $this->trimCharList = $optionals['trimCharList'] ?? ' ';
    }

    public function assemble(): string
    {
        return ''; // Implement logic here
    }
}

function test()
{
    $data = dataProvider();
    foreach ($data as [$fractions, $extensions, $isTrimLeftZeros, $isTrimRightZeros, $trimChars, $expected, $message]) {
        testAssemble($fractions, $extensions, $isTrimLeftZeros, $isTrimRightZeros, $trimChars, $expected, $message);
    }
}

function testAssemble(
    array $fractions,
    array $extensions,
    bool $isTrimLeftZeros,
    bool $isTrimRightZeros,
    string $trimChars,
    string $expected,
    string $message
): void {
    $sut = new FractionAssembler(
        $fractions,
        [
            'extensions' => $extensions,
            'trimLeftZeros' => $isTrimLeftZeros,
            'trimRightZeros' => $isTrimRightZeros,
            'trimCharList' => $trimChars
        ]
    );
    $actual = $sut->assemble();
    echo ($actual === $expected ? "Ok: " : "Fail: ") . "{$message}, expected: {$expected}, actual: {$actual}\n";
}

function dataProvider(): array
{
    $extensions = ['d ', 'h:', 'm:', 's'];
    $trimChars = ' :';
    $data = [
        // fractions
        // extensions
        // trim left zeros
        // trim right zeros
        // character list of final trim
        [[0, 0, 0, 0], $extensions, false, false, $trimChars, '0d 0h:0m:0s', 'No zero trim for full input set of zeros'],
        [[0, 0, 0, 0], $extensions, true, false, $trimChars, '', 'Left zero trim for full input set of zeros'],
        [[0, 0, 0, 0], $extensions, false, true, $trimChars, '', 'Right zero trim for full input set of zeros'],
        [[0, 0, 0, 0], $extensions, true, true, $trimChars, '', 'Left and right zero trim for full input set of zeros'],

        [[0, 0, 0, 1], $extensions, true, false, $trimChars, '1s', 'Left trim of zeros for 1 second input'],

        [[0, 0, 1, 0], $extensions, false, false, $trimChars, '0d 0h:1m:0s', 'No zero trim for 1 minute input'],
        [[0, 0, 2, 0], $extensions, true, false, $trimChars, '2m:0s', 'Left zero trim for 2 minutes input'],
        [[0, 0, 3, 0], $extensions, false, true, $trimChars, '0d 0h:3m', 'Right zero trim for 3 minutes input'],
        [[0, 0, 4, 0], $extensions, true, true, $trimChars, '4m', 'Left and right zero trim for 4 minutes input'],

        [[0, 1, 0, 0], $extensions, false, false, $trimChars, '0d 1h:0m:0s', 'No zero trim for 1 hour input'],
        [[0, 2, 0, 0], $extensions, true, false, $trimChars, '2h:0m:0s', 'Left zero trim for 2 hours input'],
        [[0, 3, 0, 0], $extensions, false, true, $trimChars, '0d 3h', 'Right zero trim for 3 hours input'],
        [[0, 4, 0, 0], $extensions, true, true, $trimChars, '4h', 'Left and right zero trim for 4 hours input'],

        [[1, 0, 0, 0], $extensions, false, false, $trimChars, '1d 0h:0m:0s', 'No zero trim for 1 days input'],
        [[2, 0, 0, 0], $extensions, true, false, $trimChars, '2d 0h:0m:0s', 'Left zero trim for 2 days input'],
        [[3, 0, 0, 0], $extensions, false, true, $trimChars, '3d', 'Right zero trim for 3 days input'],
        [[4, 0, 0, 0], $extensions, true, true, $trimChars, '4d', 'Left and right zero trim for 4 days input'],

        [[0, 0, 5, 0], $extensions, true, true, '', '5m:', 'Left and right zero trim for 5 minutes input, but with missed final trim of separation characters'],

        [[0, 1, 2, 0], ['GB, ', 'MB, ', 'KB, ', 'B'], true, true, ' ,', '1MB, 2KB', 'Left and right zero trim for file size input'],
    ];
    return $data;
}