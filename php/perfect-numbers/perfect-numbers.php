<?php

function getClassification($number)
{
    if ($number <= 0) {
        throw new InvalidArgumentException('Number should be greater than 0');
    }
    $factors = [];
    $s = 1;
    $e = $number;
    while ($s < $e) {
        $n = $number / $s;
        if (is_int($n)) {
            if (!in_array($s, $factors) && $s != $number) {
                $factors[] = $s;
            }
            if (!in_array($n, $factors) && $n != $number) {
                $factors[] = $n;
            }
            $e = $n;
        }
        $s++;
    }
    $aliquotSum = array_sum($factors);
    if ($aliquotSum == $number) {
        return 'perfect';
    } elseif ($aliquotSum > $number) {
        return 'abundant';
    } else {
        return 'deficient';
    }
}
