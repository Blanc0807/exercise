<?php

function sumOfMultiples($number, $particulars)
{
    $list = [];
    foreach ($particulars as $particular) {
        if ($number < $particular || $particular == 0) {
            $list[] = 0;
            continue;
        }
        $multiple = $particular;
        while ($multiple < $number) {
            if (!in_array($multiple, $list)) {
                $list[] = $multiple;
            }
            $multiple += $particular;
        }
    }
    return array_sum($list);
}
