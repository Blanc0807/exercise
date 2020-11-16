<?php

function isArmstrongNumber($number)
{
    $number = (string)$number;
    $n = strlen($number);
    $sum = 0;
    $i = 0;
    while ($i < $n) {
        $sum += $number[$i] ** $n;
        $i++;
    }
    return $sum == $number;
}
