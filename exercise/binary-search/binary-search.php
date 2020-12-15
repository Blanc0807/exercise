<?php

function find($item, array $lists)
{
    if (empty($lists)){
        return -1;
    }
    $index = ceil(count($lists) / 2) - 1;
    binary_search($item, $index, $lists);
    return $index;
}

function binary_search($item, &$index, $lists)
{
    if ($index == 0 || $index == count($lists) - 1) {
        if ($lists[$index] == $item) {
            return $index;
        }
        $index = -1;
        return $index;
    }
    if ($lists[$index] == $item) {
        return $index;
    }
    if ($lists[$index] > $item) {
        $index = ceil($index / 2) - 1;
    }
    if ($lists[$index] < $item) {
        $index = ceil(count($lists) + $index - 1) / 2;
    }
    binary_search($item, $index, $lists);
}
