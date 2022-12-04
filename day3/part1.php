<?php

$lines = file(__DIR__.'/input.txt');
// $lines = file(__DIR__.'/example.txt');

$allTotal = 0;
foreach ($lines as $line) {
    $items = str_split(trim($line));

    // Reset index to 1
    $items = array_combine(range(1,count($items)),$items);
    $half = count($items)/2;

    $first = array_slice($items, 0, $half);
    $second = array_slice($items, $half);

    // Find any in first that are also in second
    $intersect = array_unique(array_intersect($first, $second));

    $lower = array_combine(range(1,count(range('a', 'z'))),range('a', 'z'));
    $all = array_merge($lower, range('A', 'Z'));
    $all = array_combine(range(1,count($all)), $all);

    /**
     * Lowercase item types a through z have priorities 1 through 26.
     * Uppercase item types A through Z have priorities 27 through 52.
     */
    $total = 0;
    foreach ($intersect as $i) {
        $find = array_search($i, $all);
        $total += $find;
    }
    $allTotal += $total;

    echo "---TOTAL: ".$total." >>> ".$allTotal." ----------\n";
}

echo "\n\n";