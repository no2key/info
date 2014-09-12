<?php 
class PublishAction extends BaseAction {

	public function index(){
		$this->display();
	}

	public function add(){
		$Form   =   D('Publish');
		if($Form->create()) {
			if (!$this->login) {
				$this->error("请先登录");
			}
			$Form->uid = $this->login['id'];
			if (array_sum($_FILES['photo']['size']) > 0) {
				$uploadList = $this->_upload();
				$photos = array();
				$Form->uid = $this->login['id'];
				foreach ($uploadList as $photo) {
					$photos[] = $photo['savename'];
				}
				$Form->photo = implode(',', $photos);
			}
			$result =   $Form->add();
			if($result) {
				$this->success('操作成功！', C('BASE_URI'));
			}else{
				$this->error('写入错误！');
			}
		}else{
			$this->error($Form->getError());
		}
	}

	public function edit($id=0){
		$Form   =   M('Publish');
		if(!$this->login){
			$this->error('用户未登录');
		}

		$data   =   $Form->find($id);
		if (empty($data)) {
			$this->error('编辑的信息不存在');
		}
		$this->assign('data', $data);
		$this->display();
	}

	public function update(){
		$Form   =   D('Publish');
		if($Form->create()) {
			$result =   $Form->save();
			if($result) {
				$this->success('操作成功！', C('BASE_URI'));
			}else{
				$this->error('写入错误！');
			}
		} else {
			$this->error($Form->getError());
		}
	}

	public function del() {
		$Form   =   M('Publish');
		if(!$this->login){
			$this->error('用户未登录');
		}
		$map['uid'] = $this->login['id'];
		$map['id'] = $this->_param('id');
		$ret = $Form->where($map)->count();
		if ($ret) {
			$Form->status = 1;
			$Form->where($map)->save();
		} else {
			$this->error('权限不足');
		}
		$this->success('删除成功');
	}

	public function file() {
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
			echo '<script>ui.error('.$upload->getErrorMsg().');</script>';
		} else {
			$uploadList = $upload->getUploadFileInfo();
			$id = $uploadList[0]['savename'];
			M('attachment')->add(array('id'=>$id));
			$res['id'] = $id;
			$res['url'] = C('BASE_URI').'Uploads/s_'.$id;
			$res = json_encode($res);
			echo '<script>window.parent.updataface('.$res.');</script>';
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