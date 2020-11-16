<?php

function encode($str, $a, $b)
{
    isCoprime($a, 26);
    $encode = '';
    $str = strtolower($str);

    for ($i = 0; $i < strlen($str); $i++) {
        if (!ctype_alpha($str[$i]) && !is_numeric($str[$i])) {
            continue;
        }
        if (is_numeric($str[$i])) {
            $encode .= $str[$i];
            continue;
        }

        $index = ord($str[$i]) - 97;
        $encode .= chr(($a * $index + $b) % 26 + 97);
    }
    return rtrim(chunk_split($encode, 5, ' '));
}
function isCoprime($a, $m)
{
    $n = 2;
    while ($n <= $a) {
        if ($a % $n === 0 && $m % $n === 0) {
            throw new InvalidArgumentException("Error: a and m must be coprime.");
        }
        $n++;
    }
    return null;
}

function decode($str, $a, $b)
{
    isCoprime($a, 26);
    $decode = '';
    $str = str_replace(' ', '', $str);

    $n = 2;
    while ($n * $a % 26 !== 1) {
        $n++;
    }
    for ($i = 0; $i < strlen($str); $i++) {
        if (is_numeric($str[$i])) {
            $decode .= $str[$i];
            continue;
        }
        $index = ord($str[$i]) - 97;
        $newIndex = $n * ($index - $b) % 26;
        if ($newIndex < 0) $newIndex += 26;
        $newIndex += 97;
        $decode .= chr($newIndex);
    }
    return $decode;
}
