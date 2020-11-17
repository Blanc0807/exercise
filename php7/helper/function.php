<?php

const MEMORY_MAP = [
    3   =>  'GB',
    2   =>  'MB',
    1   =>  'KB',
];

function size_info(int $bit){
    foreach (MEMORY_MAP as $item => $value){
        if ($bit > pow(1024, $item)){
            return round($bit / pow(1024, $item)) . $value;
        }
    }
}
