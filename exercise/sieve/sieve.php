<?php

function sieve($number): array
{
    $primes = [];
    if ($number < 2) {
        return [];
    }
    $preprocess = array_fill(2, $number - 1, true);
    for ($i = 2; $i < ceil(sqrt($number)); $i++) {
        if ($preprocess[$i]) {
            for ($j = $i * $i; $j <= $number; $j += $i) {
                $preprocess[$j] = false;
            }
        }
    }

    foreach ($preprocess as $key => $value) {
        if ($value) {
            $primes[] = $key;
        }
    }
    return $primes;
}

