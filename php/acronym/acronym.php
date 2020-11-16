<?php

function acronym($s){
    preg_match_all('/(?<=^|\p{Ll})\p{Lu}|(?<=\s|\-)\w/u', $s, $matches);
    if (count($matches[0]) < 2){
        return null;
    }
    $match = join('', $matches[0]);
    return mb_strtoupper($match);
}
