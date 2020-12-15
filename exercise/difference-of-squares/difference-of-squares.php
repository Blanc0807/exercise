<?php

function sumOfSquares($n): int
{
    return ($n * ($n + 1) * (2 * $n + 1)) / 6;
}

function squareOfSum($n): int
{
    return ($n * (1 + $n) / 2) ** 2;
}

function difference($n)
{
    return squareOfSum($n) - sumOfSquares($n);
}