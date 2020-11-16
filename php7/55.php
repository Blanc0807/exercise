<?php

//echo date('Y-m-d H:i:s', time());

function runtime($start = null, $end = null)
{
    static $cache;
    if (is_null($start)) {
        return $cache;
    } elseif (is_null($end)) {
        return $cache[$start] = microtime(true);
    } else {
        $end = $cache[$end] ?? microtime(true);
        return round($end - $cache[$start], 2);
    }
}

runtime('for');

for ($i = 0; $i < 200000000; $i++) {
}
runtime('forEnd');
echo 'for循环: ' . runtime('for', 'forEnd');

echo "\n";

runtime('while');
$j = 0;
while ($j < 200000000){
    $j++;
}
runtime('endWhile');
echo 'while循环: ' . runtime('while', 'endWhile');
