<?php
const YEAR_MAP = [
    ['M', 1000],
    ['CM', 900],
    ['D', 500],
    ['CD', 400],
    ['C',100],
    ['XC', 90],
    ['L',50],
    ['XL', 40],
    ['X',10],
    ['IX', 9],
    ['V',5],
    ['IV', 4],
    ['I',1]
];

function toRoman($number)
{
    $roman = '';
    for ($i = 0; $i < count(YEAR_MAP); $i++) {
        while($number - YEAR_MAP[$i][1] >= 0){
            $number -= YEAR_MAP[$i][1];
            $roman .= YEAR_MAP[$i][0];
        }
    }
    return $roman;

}


