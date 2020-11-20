<?php
use Model\Upload;
include_once '../model/Upload.php';


$upload = new Upload();
$result = $upload->make();
$success = count($result['success']);
$fail = count($result['fail']);
echo <<<result
<p>文件上传成功{$success}个，失败{$fail}个</p>
<br/>
<a href="../index.html">点击返回</a>
result;