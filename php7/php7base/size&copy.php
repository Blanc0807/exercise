<?php

include_once 'helper/function.php';

// 递归计算目录文件大小
function dirSize($dir){
    $size = 0;
    foreach (glob($dir.'/*') as $file){
        is_file($file) ? $size += filesize($file) : dirSize($file);
    }

    return size_info($size);
}

echo dirSize('../../php');

echo "\n";

// 递归复制文件
function copyFile($dir, $to){
    is_dir($to) or mkdir($to, 0755, true);
    foreach (glob($dir.'/*') as $file){
        if (preg_match_all('/(^\.|phpunit)/', basename($file))) continue;
        $target = $to.'/'.basename($file);
        is_file($file) ? copy($file, $target) : copyFile($file, $target);
    }
    return true;
}

copyFile('../../php/', '../php_copy/');

echo 'copy is done';
echo "\n";
echo 'delete will start at 10s later.....';
sleep(10);

// 递归删除目录
function delDir($dir){
    if (!is_dir($dir)){
        return true;
    }
    foreach (glob($dir.'/*') as $file){
        is_file($file) ? unlink($file) : delDir($file);
    }
    return rmdir($dir);
}

delDir('../php_copy/');