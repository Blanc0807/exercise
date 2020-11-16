<?php
static $A, $E, $I, $O, $U, $L, $N, $R, $S, $T = 1;
static $D, $G = 2;
static $B, $C, $M, $P = 3;
static $F, $H, $V, $W, $Y = 4;
static $K = 5;
static $J, $X = 8;
static $Q, $Z = 10;

function score($word)
{
    if (!$word) {
        return 0;
    }
    var_dump($GLOBALS);
    return array_reduce(str_split(strtoupper($word)), function ($carry, $item) {
        $carry += 1;
        return $carry;
    });
}
var_dump($GLOBALS);

