<?php

function toDecimal($numberString)
{
    $decimal = 0;
    $n = strlen($numberString);
    for ($i = $n - 1; $i >= 0 ; $i--) {
        if ($numberString[$i] > 2){
            return 0;
        }
        if ($numberString[$i] == 0){
            continue;
        }
        $decimal += $numberString[$i] * pow(3, $n - $i - 1);
    }
    return $decimal;
}
