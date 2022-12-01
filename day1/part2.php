<?php

$contents = file_get_contents(__DIR__.'/input.txt');
$groups = explode("\n\n", $contents);

$totals = [];
foreach ($groups as $group) {
    $parts = explode("\n", $group);
    // Add all of the parts together and add it to the totals
    $totals[] = array_sum($parts);
}

rsort($totals);
$topThree = $totals[0]+$totals[1]+$totals[2];

echo "Calories by top three: ".$topThree."\n\n";
