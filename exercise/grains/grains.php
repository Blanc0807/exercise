<?php

function square($square)
{
    if ($square <= 0 || $square > 64) {
        throw new InvalidArgumentException();
    }

    if (2 ** ($square - 1) < PHP_INT_MAX) {
        return (string)2 ** ($square - 1);
    }
    return bigAdd(square($square - 1), square($square - 1));
}

function bigAdd(string $a, string $b)
{

}