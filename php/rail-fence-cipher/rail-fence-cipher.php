<?php

function encode($plainText, $rails)
{

    $shape = shape($plainText, $rails);
    return array_reduce($shape, function ($a, $b) {
        return $a . join($b);
    }, '');
}

function decode($encryptedText, $rails)
{
    $str = '';
    for ($k = 0; $k < strlen($encryptedText); $k++) {
        $str .= '?';
    }
    $shape = shape($str, $rails);
    $index = 0;
    for ($i = 0; $i < count($shape); $i++) {
        for ($j = 0; $j < count($shape[$i]); $j++) {
            $shape[$i][$j] = $encryptedText[$index];
            $index++;
        }
    }
    $output = $shape[0][0];
    $upIndex = $downIndex = $middleIndex = 0;
    $down = true;
    while (strlen($output) < strlen($encryptedText)) {
        if ($down) {
            for ($row = 1; $row < count($shape) - 1; $row++) {
                $output .= $shape[$row][$middleIndex];
            }
            $output .= isset($shape[count($shape) - 1][$downIndex]) ?
                $shape[count($shape) - 1][$downIndex] : null;
            $upIndex++;
        } else {
            for ($row = count($shape) - 2; $row > 0; $row--) {
                $output .= $shape[$row][$middleIndex];
            }
            $output .= isset($shape[0][$upIndex]) ? $shape[0][$upIndex] : null;
            $downIndex++;
        }
        $middleIndex++;
        $down = !$down;
    }
    return $output;
}

function shape($str, $rails)
{
    $row = 0;
    $shape = [];
    $shape[] = [$str[0]];
    $down = true;
    for ($i = 1; $i < strlen($str); $i++) {
        if ($row == $rails - 1) {
            $down = false;
        } elseif ($row == 0) {
            $down = true;
        }
        if ($down) {
            $shape[$row + 1][] = $str[$i];
            $row++;
            continue;
        }
        $shape[$row - 1][] = $str[$i];
        $row--;
        continue;
    }
    return $shape;
}
