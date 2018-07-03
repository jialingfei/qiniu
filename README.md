# qiniu
第一版

### 第一步
    在Qiniu.php中配置自己的ak和sk 还有上传的地址空间

### 第二步
    在控制器中
    $qiniu = new \Tiramisu\Qiniu();
    $arr = $qiniu->upload();
    返回上传七牛云中路径
    暂时支持form表单提交
