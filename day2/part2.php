<?php

// Rock defeats Scissors, Scissors defeats Paper, and Paper defeats Rock
// Col 1: A for Rock, B for Paper, and C for Scissors.
// Col 2: X for Rock, Y for Paper, and Z for Scissors
// Col1 is their move, Col2 is my move

/**
 * the second column says how the round needs to end: X means you need to lose, Y means you need 
 * to end the round in a draw, and Z means you need to win. 
 * 
 * The total score is still calculated in the same way, but now you need to figure out what 
 * shape to choose so the round ends as indicated. 
 */

$rules = [
    'A' => ['beats' => 'C', 'loses' => 'B', 'value' => 1],
    'B' => ['beats' => 'A', 'loses' => 'C', 'value' => 2],
    'C' => ['beats' => 'B', 'loses' => 'A', 'value' => 3]
];

function didIWin($col1, $col2, $rules)
{
    // Find the line for col1 & col2
    $col1Rule = $rules[$col1];
    $col2Rule = $rules[$col2];

    // See if col1 beats col2
    if ($col1Rule['beats'] == $col2) {
        // They win
        return false;
    } else if ($col2Rule['beats'] == $col1) {
        // I win
        return true;
    }
    // Draw
    return null;
}

function normalize($col)
{
    switch($col) {
        case 'X': $col = 'A'; break;
        case 'Y': $col = 'B'; break;
        case 'Z': $col = 'C'; break;
    }
    return $col;
}

$lines = file(__DIR__.'/input.txt');
$score = 0;

function findSymbol($col, $rules, $win = true)
{
    // If it's a draw, just return the same symbol
    if ($win === null) {
        return $col;
    }

    $find = ($win === true) ? 'beats' : 'loses';
    foreach ($rules as $index => $rule) {
        if ($rule[$find] == $col) {
            return $index;
        }
    }
}

foreach ($lines as $line) {
    $parts = explode(' ', trim($line));

    // The second column tells us if we need to win or not
    switch($parts[1]) {
        case 'X': $result = false; break;
        case 'Y': $result = null; break;
        case 'Z': $result = true; break;
    }

    // If we need to win ($result == true), find which symbol we need to win/lose/draw against col1/parts[0]
    $find = findSymbol($parts[0], $rules, $result);

    $col1 = normalize($parts[0]);
    $col2 = normalize($find);
    $result = didIWin($col1, $col2, $rules);

    // Add score() for the shape and add for the result (0 for loss)
    $score += $rules[$col2]['value'];

    if ($result === true) { $score += 6; }
    if ($result === false) { $score += 0; }
    if ($result === null) { $score += 3; }
}

echo "Final score: ".$score."\n\n";