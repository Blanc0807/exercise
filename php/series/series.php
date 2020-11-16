<?php

function slices($numbers, $length)
{
    if (strlen($numbers) < $length || $length <= 0) {
        throw new InvalidArgumentException('Wrong length');
    }
    return array_map(function ($s) use ($numbers, $length){
        return substr($numbers, $s, $length);
    }, range(0, strlen($numbers) - $length));
}