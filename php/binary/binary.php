<?php

// Implementation note:
// --------------------
// If the argument to parse_binary isn't a valid binary value the
// function should raise an \InvalidArgumentException
// with a meaningful error message.

function parse_binary($binary)
{
    $last = $binary[-1];
    if ($last !== '0' && $last !== '1') {
        throw new InvalidArgumentException;
    }
    if (strlen($binary) == 1) {
        return $binary;
    }
    return 2 * (parse_binary(substr($binary, 0, -1))) + $last;
}
