<?php

$database = [
    'locaLhost' => '127.0.0.1',
    'poRt' => '3306',
    'cachE' => [
        'userNamE' => 'Chad',
        'passWORd' => 'Aa123456',
    ],
];

function cache(string $name, array $data = null)
{
    $file = 'cache' . DIRECTORY_SEPARATOR . md5($name) . '.php';
    if (is_null($data)) {
        $content = is_file($file) ? file_get_contents($file) : null;
        return unserialize($content) ? : null;
    } else {
        return file_put_contents($file, serialize($data));
    }
}

$config = $database;
var_dump(cache('database'));