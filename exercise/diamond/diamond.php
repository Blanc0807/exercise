<?php


function diamond($letter)
{
    $toA = ord($letter) - 65;
    $offset = 0;
    $halfDiamond = [];
    while ($toA >= 0){
        $nowLetter = chr(ord($letter) - $offset);
        $halfLine = str_repeat(' ', $offset)."$nowLetter".str_repeat(' ', $toA);
        $line = $halfLine . strrev(substr($halfLine, 0, strlen($halfLine) - 1));
        $halfDiamond[] = $line;
        $toA--;
        $offset++;
    }
    $anotherHalf = array_reverse($halfDiamond);
    array_pop($anotherHalf);
    return array_merge($anotherHalf, $halfDiamond);
}
