<?php

function recognize($input)
{
    if (count($input) % 4 != 0 || strlen($input[0]) % 3 != 0) {
        throw new InvalidArgumentException('Incorrect size');
    }
    $numbers = array_chunk($input, 4);
    $output = '';
    for ($i = 0; $i < count($numbers); $i++) {
        $output .= eachNumbers($numbers[$i]) . ',';
    }
    return substr($output, 0, -1);
}

function eachNumbers($s)
{
    $start = 0;
    $length = strlen($s[0]);
    $numberString = '';
    $number = '';
    while ($start < $length) {
        for ($i = 0; $i < 4; $i++) {
            $numberString .= substr($s[$i], $start, 3);
        }
        $number .= OCR[$numberString] ?? '?';
        $numberString = '';
        $start += 3;
    }
    return $number;
}

const OCR = [
    '     |  |   ' => 1,
    ' _  _||_    ' => 2,
    ' _  _| _|   '  =>  3,
    '   |_|  |   '  =>  4,
    ' _ |_  _|   '  =>  5,
    ' _ |_ |_|   '  =>  6,
    ' _   |  |   '  =>  7,
    ' _ |_||_|   '  =>  8,
    ' _ |_| _|   '  =>  9,
    ' _ | ||_|   '  =>  0
];
