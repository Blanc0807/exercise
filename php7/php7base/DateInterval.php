<?php
// diff
date_default_timezone_set('PRC');
$date1 = new DateTime();
$date2 = new DateTime('2020-12-15 16:59:59');
$diff = $date1->diff($date2);
echo $diff->format('%m月%d天%h小时%s秒, 共%a天');

echo "\n";

//DateInterval
$date = new DateTime();
echo $date->format('Y-m-d H:i:s');echo "\n";
$interval = new DateInterval('P2DT5H6M12S');
$date->add($interval);
echo $date->format('Y-m-d H:i:s');echo "\n";
$date->sub($interval);
echo $date->format('Y-m-d H:i:s');echo "\n";


function code(int $len = 5): string{
    $code_map = '0123456789QWERTYUIOPASDFGHasdfghjklzxcv';
    $code = '';
    for ($i = 0;$i< $len;$i++){
        $code .= $code_map[rand(0, strlen($code_map)-1)];
    }
    return $code;
}
