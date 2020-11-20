<?php

// 设置浏览器cookie
setcookie('web', 'test', time() + 30, '/cookie');

// 读取cookie
// 客户端在请求时会将cookie放入头部信息里
print_r($_COOKIE['web']);
