<?php

function brackets_match($s)
{
    $begin = ['{', '[', '('];
    $end = ['}', ']', ')'];
    $map = [
        '{' => '}',
        '[' => ']',
        '(' => ')'
    ];
    $stack = new SplStack();
    for ($i = 0; $i < strlen($s); $i++) {
        if (in_array($s[$i], $begin)) {
            $stack->push($s[$i]);
        }
        if (in_array($s[$i], $end)) {
            if ($stack->isEmpty()) {
                return false;
            }
            $item = $stack->pop();
            if ($map[$item] !== $s[$i]) {
                return false;
            }
        }
    }
    return $stack->isEmpty();
}
