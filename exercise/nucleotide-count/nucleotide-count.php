<?php

function nucleotideCount($d){
    $nucleotideCount = [
        'a' =>  0,
        'c' =>  0,
        't' =>  0,
        'g' =>  0
    ];
    foreach ($nucleotideCount as $key => &$value){
        $value = substr_count($d, strtoupper($key));
    }
    return $nucleotideCount;
}