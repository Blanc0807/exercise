<?php
//phpinfo();
session_save_path('var/session');
session_start();
$_SESSION['web'] = 'Chad';
session_name('web');
echo session_id();

// 垃圾回收
