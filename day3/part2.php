<?php

$lines = file(__DIR__.'/input.txt');
// $lines = file(__DIR__.'/example.txt');

$groups = [];
$count = 0;
$group = [];

// Make them in to groups of three
foreach ($lines as $line) {
    $count++;
    $group[] = trim($line);
    if ($count == 3) {
        $groups[] = $group;
        $group = [];
        $count = 0;
    }
}

$lower = array_combine(range(1,count(range('a', 'z'))),range('a', 'z'));
$all = array_merge($lower, range('A', 'Z'));
$all = array_combine(range(1,count($all)), $all);

$sum = 0;

// Now, for each grouping, find the common letter between them
foreach ($groups as $group) {
    // Make arrays out of them
    foreach ($group as $index => $e) {
        $group[$index] = str_split(trim($e));
    }
    $intersect = array_unique(array_intersect($group[0], $group[1], $group[2]));

    // Find the value in "all" and get the index
    $find = array_search(array_pop($intersect), $all);
    $sum += $find;
}

echo ">>> RESULT: ".$sum."\n\n";