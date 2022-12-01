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

echo "Most calories: ".$totals[0]."\n\n";
