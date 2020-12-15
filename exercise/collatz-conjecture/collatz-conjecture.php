<?php

function steps($number)
{
    if ($number < 1) {
        throw new InvalidArgumentException('Only positive numbers are allowed');
    }
    $step = 0;
    while ($number !== 1) {
        $step++;
        if (is_int($number / 2)) {
            $number /= 2;
        } else {
            $number = $number * 3 + 1;
        }
    }
    return $step;
}
