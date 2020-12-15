<?php

function smallest($start, $end)
{
    if ($start >= $end) {
        throw new InvalidArgumentException();
    }
    $min = PHP_INT_MAX;
    for ($i = $start; $i <= $end; $i++) {
        for ($j = $i; $j <= $end; $j++) {
            $product = $i * $j;
            if ($product > $min) break;
            if ($product == strrev($product) && $product < $min){
                $min = $product;
            }
        }
    }
    if ($min == PHP_INT_MAX){
        throw new InvalidArgumentException();
    }
    $factors = findFactors($min, $start, $end);
    return [$min, $factors];
}

function largest($start, $end)
{
    if ($start >= $end) {
        throw new InvalidArgumentException();
    }
    $max = 0;
    for ($i = $end; $i >= $start; $i--) {
        for ($j = $i; $j >= $start; $j--) {
            $product = $i * $j;
            $a[]=$product;
            if ($product < $max) break;
            if ($product == strrev($product) && $product > $max){
                $max = $product;
            }
        }
    }
    if ($max === 0){
        throw new InvalidArgumentException();
    }
    $factors = findFactors($max, $start, $end);
    return [$max, $factors];
}

function findFactors($n, $s, $e)
{
    $factors = [];
    while ($s < $e) {
        if ($n % $s === 0) {
            if ($n / $s <= $e) {
                $e = $n / $s;
                $factors[] = [$s, $e];
            }
        }
        $s++;
    }
    return $factors;
}

