<?php

// $lines = file(__DIR__.'/example.txt');
$lines = file(__DIR__.'/input.txt');

$containsTotal = 0;

foreach ($lines as $line) {
    $assignments = explode(',', trim($line));
    $first = explode('-', $assignments[0]);
    $second = explode('-', $assignments[1]);

    // See if the first fully contains the second
    if ($first[0] <= $second[0] && $first[1] >= $second[1]) {
        // echo "1. ".$assignments[0].' contains '.$assignments[1]."!\n";
        $containsTotal++;
        continue;
    }

    // See if the second fully contains the first
    if ($second[0] <= $first[0] && $second[1] >= $first[1]) {
        // echo "2. ".$assignments[1].' contains '.$assignments[0]."!\n";
        $containsTotal++;
    }

    echo "------------\n";
}

echo "TOTAL: ".$containsTotal."\n";