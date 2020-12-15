<?php

function transform($old){
    $expected = [];
    foreach ($old as $key => $value){
        foreach ($value as $newKey){
            $expected[strtolower($newKey)] = $key;
        }
    }
    ksort($expected);
    return $expected;
}