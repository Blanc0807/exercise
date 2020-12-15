<?php

const PLAIN = 'abcdefghijklmnopqrstuvwxyz';
const CIPHER = 'zyxwvutsrqponmlkjihgfedcba';

function encode($word)
{
    $replace = strtolower(str_replace(
        str_split(PLAIN),
        str_split(strtoupper(CIPHER)),
        strtolower($word)
    ));
    $replace = str_replace([' ', ',', '.'], '', $replace);
    return rtrim(chunk_split($replace, 5, ' '));
}
