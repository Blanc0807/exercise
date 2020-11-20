<?php

include_once '../helper/function.php';

echo '磁盘总容量: ' . size_info(disk_total_space('.')) . "\n";
echo '磁盘剩余容量: ' .size_info( disk_free_space('.'));

echo "\n";

// fseek 操作文件指针
$handle = fopen('../files/hello.txt', 'r+');
fseek($handle, 2);
echo fread($handle, 2); //echo 'll'

//fseek($handle, 1);
//fwrite($handle, '123');
fclose($handle);


$handle1 = fopen('../files/xrq.png', 'r');
$handle2 = fopen('../files/copy.png', 'w');
fwrite($handle2, fread($handle1, 99999999));
fclose($handle2);
fclose($handle1);
echo "\n";
//读取远程文件需要开启php设置 allow_url_open

// flock()  LOCK_SH共享锁 LOCK_EX独享锁 LOCK_UN解锁 LOCK_NB防止阻塞
$fileSize = filesize('../files/xrq.png');
echo 'xrq.png的大小: ' . size_info($fileSize);
echo "\n";
date_default_timezone_set('PRC');
echo date('Y-m-d H:i:s', filemtime('../files/copy.png'));