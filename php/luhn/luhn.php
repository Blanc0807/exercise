<?php

const MAP = [
    0   =>  0,
    1   =>  2,
    2   =>  4,
    3   =>  6,
    4   =>  8,
    5   =>  1,
    6   =>  3,
    7   =>  5,
    8   =>  7,
    9   =>  9
];

function isValid($input)
{
    $input = str_replace(' ', '', $input);
    if (strlen($input) < 2 || preg_match('/[^\d]/', $input)) {
        return false;
    }

    $sum = 0;
    for ($i = strlen($input) - 1; $i >= 0; $i--) {
        $sum += (strlen($input) - $i) & 1 ?
            $input[$i]
//            : ($input[$i] > 4 ? $input[$i] * 2 - 9 : $input[$i] * 2);
            : MAP[$input[$i]];
    }

    return !($sum % 10);
}
