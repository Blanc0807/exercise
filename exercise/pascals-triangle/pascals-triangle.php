<?php

function pascalsTriangleRows($rows)
{
    $tree = [[1]];
    if ($rows < 0 || $rows === null) {
        return -1;
    }
    if ($rows === 0) {
        return [];
    }
    if ($rows === 1) {
        return $tree;
    }
    $tree[] = [1, 1];
    if ($rows === 2) {
        return $tree;
    }
    for ($i = 3; $i <= $rows; $i++) {
        $tree[] = [1];
        for ($j = 1; $j < count($tree[$i - 2]); $j++) {
            $tree[$i - 1][] = $tree[$i - 2][$j] + $tree[$i - 2][$j - 1];
        }
        $tree[$i - 1][] = 1;
    }
    return $tree;
}
