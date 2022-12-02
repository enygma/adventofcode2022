<?php

// Rock defeats Scissors, Scissors defeats Paper, and Paper defeats Rock
// Col 1: A for Rock, B for Paper, and C for Scissors.
// Col 2: X for Rock, Y for Paper, and Z for Scissors
// Col1 is their move, Col2 is my move

/**
 * Your total score is the sum of your scores for each round. The score for a single round is the 
 * score for the shape you selected (1 for Rock, 2 for Paper, and 3 for Scissors) plus the score 
 * for the outcome of the round (0 if you lost, 3 if the round was a draw, and 6 if you won).
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

foreach ($lines as $line) {
    $parts = explode(' ', trim($line));
    $col1 = normalize($parts[0]);
    $col2 = normalize($parts[1]);
    $result = didIWin($col1, $col2, $rules);

    // Add score() for the shape and add for the result (0 for loss)
    $score += $rules[$col2]['value'];

    if ($result === true) { $score += 6; }
    if ($result === false) { $score += 0; }
    if ($result === null) { $score += 3; }
}

echo "Final score: ".$score."\n\n";