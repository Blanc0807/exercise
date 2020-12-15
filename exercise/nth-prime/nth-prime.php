<?php
function prime($n)
{
    if ($n < 1) {
        return false;
    }

    $primes = [2];
    $number = 2;
    while (count($primes) < $n) {
        $number++;
        foreach ($primes as $prime) {
            if ($number % $prime == 0) {
                continue 2;
            }
        }
        $primes[] = $number;
    }
    return $number;
}