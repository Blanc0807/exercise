<?php

function factors($number)
{
    $primes = [];
    $leave = $number;
    while ($leave !== 1) {
        for ($i = 2; $i <= $leave; $i++) {
            if ($leave % $i == 0){
                $primes[] = $i;
                $leave /= $i;
                continue 2;
            }
        }
    }
    return $primes;
}