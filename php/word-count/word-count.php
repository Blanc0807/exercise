<?php

function wordCount($phrase){
    $phrase = strtolower($phrase);
    preg_match_all('/[a-z]*|[0-9]*/', $phrase, $matches);
    return array_count_values(array_filter($matches[0]));
}
