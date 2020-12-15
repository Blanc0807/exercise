<?php
const SUFFIX = 'ay';

function translate($words){
    $letters = explode(' ', $words);
    $letters = array_map('translateLetter', $letters);
    return implode(' ', $letters);
}

function translateLetter($letter){
    if (preg_match('/^([aeiou]|yt|xr)/', $letter)){
        return $letter . SUFFIX;
    }

    if (preg_match('/^(ch|qu|squ|thr|th|sch|[bcdfghjklmnpqrstvwxyz])/', $letter, $matches)){
        return substr($letter, strlen($matches[0])) . $matches[0] . SUFFIX;
    }


}