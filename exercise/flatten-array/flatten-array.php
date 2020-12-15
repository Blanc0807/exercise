<?php

function flatten($input)
{
    $output = [];
    array_walk_recursive($input, function ($a) use (&$output){
        if ($a !== null){
            array_push($output, $a);
        }
    });

    return $output;
}

