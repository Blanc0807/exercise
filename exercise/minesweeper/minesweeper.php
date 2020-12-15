<?php

function solve($board){
    $boardBody = checkBoard($board);
    if(!$boardBody) {
        throw new InvalidArgumentException;
    }

    $processed = findMine($boardBody);
    return "\n" . array_reduce($processed, function ($v1, $v2) {
        $v1 .= join('', $v2) . "\n";
        return $v1;
        });
}

function checkBoard($board) {
    /*
     *  split string to array
     * '
     *  +--+            [ '+--+',
     *  |* |    =>        '|* |,
     *  | *|              '| *|',
     *  +--+              '+--+'  ]
     * '
     */
    $boardBody = preg_split('/\n/', trim($board));
    $boardRow = count($boardBody);
    $boardColumn = strlen($boardBody[0]);

    // board's first&last line should like '+---+' and couldn't less than 4
    if (
        !preg_match('/^\+-+\+$/', $boardBody[0])
        || !($boardBody[0] === $boardBody[$boardRow - 1])
        || $boardColumn < 4
    ){
        return false;
    }

    // board should like '|  |', '|  *|', '|*  |'
    // and board could'nt be empty, board's column <= 3
    for ( $i = 1; $i <= $boardRow - 2 ; $i++ ) {

        if( !preg_match('/\|[\s\*]*\|/', $boardBody[$i])
            || strlen($boardBody[$i]) != $boardColumn
        )
        {
            return false;
        }
    }

    return $boardBody;

}

function findMine($boardBody){
    $grid = array_map(function ($arr) {return str_split($arr);}, $boardBody);
    $gridRow = count($grid);
    $gridColumn = count($grid[0]);

    for ( $i=1; $i < $gridRow - 1; $i++){
        for ( $j = 1; $j < $gridColumn - 1; $j++){
            if ($grid[$i][$j] == ' '){
                $left = $grid[$i][$j - 1];
                $right = $grid[$i][$j + 1];
                $up = $grid[$i-1][$j];
                $leftUp = $grid[$i - 1][$j - 1];
                $rightUp = $grid[$i - 1][$j + 1];
                $down = $grid[$i + 1][$j];
                $leftDown = $grid[$i + 1][$j - 1];
                $rightDown = $grid[$i + 1][$j + 1];
                $surroundArray = [$left, $right, $up, $leftUp, $rightUp, $down, $leftDown, $rightDown];
                if ( isset(array_count_values($surroundArray)['*']) ){
                    $grid[$i][$j] = array_count_values($surroundArray)['*'];
                    continue;
                }
            }
        }
    }
    return $grid;

}





