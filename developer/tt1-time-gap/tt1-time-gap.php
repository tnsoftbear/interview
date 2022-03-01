<?php

test();

function test() {
    $data = [
        [65, '0 day(s), 00:01:05'],
        [0, '0 day(s), 00:00:00'],
        [1, '0 day(s), 00:00:01'],
        [60, '0 day(s), 00:01:00'],
        [60 * 60, '0 day(s), 01:00:00'],
        [60 * 60 + 1, '0 day(s), 01:00:01'],
        [60 * 61 + 1, '0 day(s), 01:01:01'],
        [24 * 60 * 60 + 60 * 61 + 1, '1 day(s), 01:01:01'],
        [5 * 24 * 60 * 60 + 4 * 60 * 60 + 3 * 60 + 2, '5 day(s), 04:03:02'],
    ];
    foreach ($data as [$seconds, $expected]) {
        $actual = timeGap($seconds);
        echo ($actual === $expected ? "Success: " : "Fail: ")
            . "for {$seconds} seconds, expected: {$expected}, actual: {$actual}\n";
    }
}

/**
 * TODO:
 * Add logic (right after "return") that produces time gap information in next format: "D day(s), YY:MM:DD" (see, unit test).
 * There shouldn't be any line of code in function scope, only return statement.
 * In example below, you need to pass 65 seconds to receive response  '0 day(s), 00:01:05'
 * @param int $seconds
 * @return string
 */
function timeGap(int $seconds): string
{
    return '0 day(s), 00:01:05'; // enter code instead hard-coded string
}
