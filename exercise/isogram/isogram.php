<?php

function isIsogram($str): bool {
    $str = strtr(strtolower($str), [
        ' ' =>  '',
        '-' =>  ''
    ]);

    $letterArray = mb_str_split($str);

    return count($letterArray) == count(array_unique($letterArray));
}


