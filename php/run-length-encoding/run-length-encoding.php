<?php

//
// This is only a SKELETON file for the "Run Length Encoding" exercise. It's been provided as a
// convenience to get you started writing code faster.
//

function encode($input)
{
    $length = strlen($input);
    if ($length < 2) {
        return $input;
    }

    $result = [
        ['char' => $input[0], 'count' => 1]
    ];
    for ($i = 1; $i < $length; $i++) {
        $current = &$result[count($result) - 1];
        if ($input[$i] == $current['char']) {
            $current['count']++;
            continue;
        }
        $result[] = ['char' => $input[$i], 'count' => 1];

    }
    return array_reduce($result, function ($carry, $row) {
        $carry .= $row['count'] > 1 ? $row['count'] . $row['char'] : $row['char'];
        return $carry;
    }, '');
}

function decode($input)
{
    $length = strlen($input);

    $str = '';

    for ($i = 0; $i < $length; $i++){
        $number = '';
        if (!is_numeric($input[$i])){
            $str .= $input[$i];
            continue;
        }
        $number .= $input[$i];
        while (is_numeric($input[++$i])){
            $number .= $input[$i];
        }
        $str .= str_repeat($input[$i], $number);
    }
    return $str;
}

function encode2($input){
    $length = strlen($input);
    if ($length < 2) {
        return $input;
    }
    $str = '';
    for ($i = 0; $i < $length; $i++) {
        $count = 1;
        while($i < $length - 1 && $input[$i] == $input[$i + 1]){
            $count ++;
            $i++;
        }
        $str .= $count > 1 ? $count.$input[$i] : $input[$i];
    }
    return $str;
}
