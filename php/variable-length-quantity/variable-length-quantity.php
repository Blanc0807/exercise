<?php

function vlq_encode($numbers)
{
    $results = [];

    foreach ($numbers as $number) {
        if ($number < 0x80) {
            $results[] = $number;
            continue;
        }
        $bytes = [];
        while ($number > 0) {
            $byte = 0x7f & $number;
            array_unshift($bytes, empty($bytes) ? $byte : 0x80 | $byte);
            $number >>= 7;
        }
        $results = array_merge($results, $bytes);
    }
    return $results;
}


function vlq_decode($numbers)
{
    $decodeNumber = 0;
    $result = [];

    if ($numbers[count($numbers) - 1] > 0x7f){
        throw new InvalidArgumentException();
    }

    foreach ($numbers as $number){
        if ($decodeNumber > 0xffffffff - 0x7f){
            throw new OverflowException;
        }
        $decodeNumber <<= 7;
        $decodeNumber |= $number & 0x7f;
        if (($number & 0x80) == 0) {
            $result[] = $decodeNumber;
            $decodeNumber = 0;
        }
    }
    return $result;
}
