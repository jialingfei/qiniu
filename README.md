# qiniu
有参考

### 第一步
	在config.php中配置
	//七牛云上传配置
	'qiniu' => [
	    'accessKey' => 'PAPQFhdWKpV-xxx-YtlDbF',
	    'secretKey' => 'xxxxx',
	    'bucket' => 'xx' //上传的空间
	],
    

### 第二步
    在控制器中
    $qiniu = new \jialingfei\tiramisu\Qiniu();
    $arr = $qiniu->upload();
    返回上传七牛云中路径
    暂时支持form表单提交
