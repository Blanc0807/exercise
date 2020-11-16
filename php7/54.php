<?php
//时区PRC Asia/Chongqing Asia/shanghai Asia/urumqi
//修改php时区, php.ini设置date.time_zone = PRC

//动态设置时区

date_default_timezone_set('Asia/urumqi');
echo date_default_timezone_get();
echo "\n";
echo date('Y-m-d H:i:s');