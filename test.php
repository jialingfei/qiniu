<?php
require_once './Qiniu.php';//根据自己项目引入改文件


// use Tiramisu\Qiniu;

$qiniu = new \Tiramisu\Qiniu();

// $arr = $qiniu->_getToken();
$arr = $qiniu->upload();
print_r($arr);die;
