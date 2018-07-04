<?php
namespace jialingfei\tiramisu;

require_once 'autoload.php';//加载类

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use think\Config;
/**
* 七牛上传图片
*/
class Qiniu
{
	private $_accessKey;
	private $_secretKey;
	private $_bucket;
	/**
	 * 配置   查看https://portal.qiniu.com/user/key
	 * @param string $accessKey [description]
	 * @param string $secretKey [description]
	 * @param string $bucket    [description]
	 */
	public function __construct($accessKey = '', $secretKey = '', $bucket = ''){
		$this->_accessKey = Config::get('qiniu')['accessKey'];//更改为自己的
		$this->_secretKey = Config::get('qiniu')['secretKey'];//更改为自己的
		$this->_bucket = Config::get('qiniu')['bucket'];//更改为自己的
	}
	
	/**
	 * 获取bucket值  上传的空间
	 * @return [type] [description]
	 */
	public function _getBucket(){
		if ($this->_bucket) {
			return $this->_bucket;
		}
		$bucket = '';//配置上传
		return $bucket;
	}
	/**
	 * 获取token
	 * @return [type] [description]
	 */
	public function _getToken(){
		$bucket = $this->_getBucket();
		if (!$bucket) {
			return false;
		}
		// 构建鉴权对象
		$auth = new Auth($this->_accessKey, $this->_secretKey);
		$token = $auth->uploadToken($bucket);
		if (!$token) {
			return false;
		}
		return $token;
	}

	/**
	 * 上传图片   tp5可将注释放开
	 * @return [type] [description]  
	 */
	public function upload(){
		$file = $_FILES['image'];
		// $file = request()->file('image');
		//上传的图片路径
		$filePath = $file['tmp_name'];
		// $filePath = $file->getRealPath();
		$ext = pathinfo($file['name'],PATHINFO_EXTENSION);
		// $ext = pathinfo($file->getInfo('name'),PATHINFO_EXTENSION);
		//上传到七牛要保存的路径
		$key = substr(md5($file['name']) , 0, 5). date('YmdHis') . rand(0, 9999) . '.' . $ext;
		// $key = substr(md5($file->getInfo('name')) , 0, 5). date('YmdHis') . rand(0, 9999) . '.' . $ext;

		//进行上传
		$uploadMgr = new UploadManager();
		$token = $this->_getToken();
        // 调用 UploadManager 的 putFile 方法进行文件的上传
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err !== null) {
            return ["err"=>1,"msg"=>$err,"data"=>""];
        } else {
            //返回图片的完整URL
            return ["err"=>0,"msg"=>"上传完成","data"=>$ret['key']];
        }
	}
	public function test(){
		return $this->_getToken();
	}
}