<?php

function transpose($input)
{
    $matrix = array_map(function ($a) {
        return str_split($a);
    }, $input);
    $transposed = array_map(null, ...$matrix);
    return array_map(function ($a) {
        return is_array($a) ?
            array_reduce(dealNull($a), function ($s, $value) {
                return $s . ($value ?? ' ');
            }, '')
            : $a;
    }, $transposed);
}

function dealNull($arr)
{
    while (end($arr) === null) {
        array_pop($arr);
    }
    return $arr;
}
