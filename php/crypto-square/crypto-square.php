<?php

function crypto_square($text)
{
    $text = preg_replace('/[^\w]/', '', strtolower($text));
    $length = strlen($text);
    if ($length <= 1) {
        return $text;
    }
    $c = $length;
    $r = 1;
    while ($c - $r > 1) {
        $r++;
        $c = ceil($length / $r);
    }
    $rectangle = array_map(null, ...array_map(function ($a) {
        return str_split($a);
    }, str_split($text, $c)));
    $output = array_reduce($rectangle, function ($a, $b) {
        $str = '';
        foreach ($b as $item) {
            $str .= $item === null ? ' ' : $item;
        }
        return $a . $str . ' ';
    }, '');
    return substr($output, 0, strlen($output) - 1);
}
