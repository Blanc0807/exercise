<?php

function isPangram(string $str): bool
{
    $characters = strtolower($str);

    foreach (range('a', 'z') as $item) {
        if (strpos($characters, $item) === false) {
            return false;
        }
    }
    return true;
}
