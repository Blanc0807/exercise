<?php

function resultFor($mapBoard)
{
    $board = array_map(function ($x) {
        return str_split(str_replace(' ', '', $x));
    }, $mapBoard);
    if (search('O', $board)) {
        return 'white';
    }
    if (search('X', $board)) {
        return 'black';
    }
    return null;
}

function search($stone, $board)
{
    if ($stone === 'X') {
        $board = translateMatrix($board);
    }
    $queue = new SplQueue();
    $roots = getRoots($board[0], $stone);
    foreach ($roots as $root) {
        $queue->enqueue($root);
    }
    $visited = [];
    return dsfSearch($stone, $board, $queue, $visited);
}

function dsfSearch($stone, &$board, &$queue, &$visited)
{
    $dimensions = [count($board[0]) - 1, count($board) - 1];
    while (count($queue) > 0) {
        $node = $queue->pop();
        $visited[] = $node;
        if ($node[1] == $dimensions[1]) {
            return true;
        }
        foreach (['left', 'right', 'top', 'below', 'righttop', 'leftbelow'] as $pos) {
            $neighbours = getNeighbours($node, $pos, $dimensions);
            if ($neighbours != null
                && $board[$neighbours[1]][$neighbours[0]] == $stone
                && !in_array($neighbours, $visited)) {
                $queue->enqueue($neighbours);
            }
        }
    }
    return false;
}

function getNeighbours($node, $pos, $dimensions)
{
    switch ($pos) {
        case 'left':
            return $node[0] == 0 ? null : [$node[0] - 1, $node[1]];
        case 'right':
            return $node[0] == $dimensions[0] ? null : [$node[0] + 1, $node[1]];
        case 'top':
            return $node[1] == 0 ? null : [$node[0], $node[1] - 1];
        case 'below':
            return $node[1] == $dimensions[1] ? null : [$node[0], $node[1] + 1];
        case 'leftbelow':
            return $node[0] == 0 || $node[1] == $dimensions[1] ? null : [$node[0] - 1, $node[1] + 1];
        case 'righttop':
            return $node[0] == $dimensions[0] || $node[1] == 0 ? null : [$node[0] + 1, $node[1] - 1];
    }
}

function getRoots($row, $stone)
{
    $roots = [];
    for ($i = 0; $i < count($row); $i++) {
        if ($row[$i] == $stone) {
            $roots[] = [$i, 0];
        }
    }
    return $roots;
}

function translateMatrix($matrix)
{
    $translated = [];
    if (count($matrix) == 1) {
        return $matrix;
    }
    for ($i = 0; $i < count($matrix); $i++) {
        for ($j = 0; $j < count($matrix[0]); $j++) {
            $translated[$j][$i] = $matrix[$i][$j];
        }
    }
    return $translated;
}

