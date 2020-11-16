<?php

function rebase($from, $number, $to)
{
    if ($from < 2 || $to < 2 || empty($number)) {
        return null;
    }
    $dec = to10base($from, $number);
    $output = [];
    decToXBase($dec, $to, $output);
    return $output;
}

function to10base($from, $number)
{
    if (empty($number)) {
        return 0;
    }
    $x = array_pop($number);
    if ($x < 0 || $x >= $from) {
        return null;
    }
    return $from * to10base($from, $number) + $x;
}

function decToXBase($n, $x, &$arr)
{
    $quotient = floor($n / $x);
    $remainder = $n % $x;
    if ($quotient < $x) {
        array_unshift($arr, $quotient, $remainder);
        return;
    }
    array_unshift($arr, $remainder);
    $n = $quotient;
    decToXBase($n, $x, $arr);
}
