<?php

/*
This is only a SKELETON file for the "Hamming" exercise. It's been provided as a
convenience to get you started writing code faster.

Remove this comment before submitting your exercise.
*/

function distance(string $strandA, string $strandB): int
{

    if (strlen($strandB) != strlen($strandA)) {
        throw new InvalidArgumentException('DNA strands must be of equal length.');
    }

    $arrayA = str_split($strandA);
    $arrayB = str_split($strandB);
    $countDistance = 0;
    for ($i = 0; $i < count($arrayA); $i++) {
        if ($arrayA[$i] != $arrayB[$i]) {
            $countDistance++;
        }
    }
    return $countDistance;
}
