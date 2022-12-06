<?php

// $lines = file(__DIR__.'/example.txt');
$lines = file(__DIR__.'/input.txt');

$overlapTotal = 0;

foreach ($lines as $line) {
    $assignments = explode(',', trim($line));
    $first = explode('-', $assignments[0]);
    $second = explode('-', $assignments[1]);

    // Now make them ranges...
    $first = range($first[0], $first[1]);
    $second = range($second[0], $second[1]);

    $diff = array_diff($first, $second);

    // See if there's any in the second that overlap - the count would be different in the diff
    if (count($diff) !== count($first)) {
        $overlapTotal++;
    }
}

echo "TOTAL: ".$overlapTotal."\n";