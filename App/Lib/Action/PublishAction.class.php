<?php 
class PublishAction extends Action{

	public function _initialize() {
		$cate = M('category');
		$d = $cate->select();
		$ca = [];
		foreach($d as $v) {
			if ($v['pid'] == '0') {
				$ca[$v['id']]['name'] = $v['name'];
			} else {
				$ca[$v['pid']]['sub'][] = $v;
			}
		}
		$this->assign('category', $ca);
		$reg = M('region');
		$this->assign('regions', $reg->select());
	}

	public function index(){
		if(cookie('token')){
			$User=M('User');
			$usr=aes_decode(cookie('token'));
			$uid=$User->where("username='$usr'")->getField('id');
            $permission=$User->where("username='$usr'")->getField('permission');
            $this->assign('uid',$uid);
            $this->assign('usr',$usr);
            $this->assign('permission',$permission);
        }
		$this->display();
	}

	public function add(){
		$Form   =   D('Publish');
		if($Form->create()) {
			$User=M('User');
			$usr=aes_decode(cookie('token'));
			$uid=$User->where("username='$usr'")->getField('id');
			if (array_sum($_FILES['photo']['size']) > 0) {
				$uploadList = $this->_upload();
				$photos = array();
				$Form->uid = $uid;
				foreach ($uploadList as $photo) {
					$photos[] = $photo['savename'];
				}
				$Form->photo = implode(',', $photos);
			}
			$result =   $Form->add();
			if($result) {
				$this->success('操作成功！', '/');
			}else{
				$this->error('写入错误！');
			}
		}else{
			$this->error($Form->getError());
		}
	}

	private function _upload() {
		import("ORG.Net.UploadFile");
		import('ORG.Util.Image');
		//导入上传类
		$upload = new UploadFile();
		//设置上传文件大小
		$upload->maxSize = 32922000;
		//设置上传文件类型
		$upload->allowExts = explode(',', 'jpg,gif,png,jpeg');
		//设置附件上传目录
		$upload->savePath = './Uploads/';
		//设置需要生成缩略图，仅对图像文件有效
		$upload->thumb = true;
		// 设置引用图片类库包路径
		$upload->imageClassPath = '@.ORG.Image';
		//设置需要生成缩略图的文件后缀
		$upload->thumbPrefix = 'm_,s_';  //生产2张缩略图
		//设置缩略图最大宽度
		$upload->thumbMaxWidth = '400,100';
		//设置缩略图最大高度
		$upload->thumbMaxHeight = '400,100';
		//设置上传文件规则
		$upload->saveRule = 'uniqid';
		//删除原图
		$upload->thumbRemoveOrigin = true;
		if (!$upload->upload()) {
			//捕获上传异常
			$this->error($upload->getErrorMsg());
		} else {
			//取得成功上传的文件信息
			$uploadList = $upload->getUploadFileInfo();
			return $uploadList;
		}
	}

}


?>