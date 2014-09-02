<?php

// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {

	public $ca;
	public $regions;

	public function initCategory() {
		$cate = M('category');
		$d = $cate->select();
		$this->ca = [];
		foreach($d as $v) {
			if ($v['pid'] == '0') {
				$this->ca[$v['id']]['name'] = $v['name'];
			} else {
				$this->ca[$v['pid']]['sub'][] = $v;
			}

		}
		$this->assign('category', $this->ca);
		$reg = M('region');
		$regions = $reg->select();
		foreach ($regions as $r) {
			$this->regions[$r['id']] = $r['name'];
		}
		$this->assign('regions', $this->regions);
	}

	private function _getCateName($caId) {
		foreach ($this->ca as $id=>$parent) {
			if ($id == $caId) {
				return $parent['name'];
			}
			foreach ($parent['sub'] as $sub) {
				if ($sub['id'] == $caId) {
					return $parent['name'].'-'.$sub['name'];
				}
			}
		}
	}

	public function index() {
		$this->initCategory();
		$region = $this->_param('region');
		if (isset($region)) {
			if ($region == 0) {
				$region = null;
				cookie('region', null, array('expire'=>-1));
			} else {
				cookie('region', array('id'=>$region, 'name'=>$this->regions[$region]), array('expire'=>time()+3600*24));
			}
		} else {
			$region = cookie('region')['id'];
		}
		$category = $this->_param('category');
		$title = $this->_param('title');
		if ($region) {
			$map['region'] = $region;
		}
		if ($category) {
			if (!isset($this->ca[$category])) {
				$map['category'] = array('in', $category);
			} else {
				$q = ['in'];
				foreach ($this->ca[$category]['sub'] as $sub) {
					$q[] = $sub['id'];
				}
				$map['category'] = $q;
			}
		}
		if ($title) {
			$map['title'] = array('like', "%$title%");
		}
		$Data = M('Publish'); // 实例化Data数据对象
		import('ORG.Util.Page'); // 导入分页类
		$count = $Data->where($map)->count(); // 查询满足要求的总记录数 $map表示查询条件
		$Page = new Page($count); // 实例化分页类 传入总记录数
		$show = $Page->show(); // 分页显示输出
		// 进行分页数据查询
		$list = $Data->where($map)->order('date desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		foreach ($list as &$l) {
			$l['category'] = $this->_getCateName($l['category']);
			$l['region'] = $this->regions[$l['region']];
			$photos = explode(',', $l['photo']);
			if(empty($photos[0])){
				$l['photo'] = '/img/photo_64.jpg';
			} else {
				$l['photo'] = '/Uploads/s_'.$photos[0];
			}
		}

		$this->assign('data', $list); // 赋值数据集
		if (!IS_AJAX) {
			$this->assign('page', $show); // 赋值分页输出
		} else {
			$this->assign('total', $Page->totalPages);
		}



		if (cookie('token')) {
			$User = M('User');
			$usr = aes_decode(cookie('token'));
			$jifen = $User->where("username='$usr'")->getField('jifen');
			$permission = $User->where("username='$usr'")->getField('permission');
			$this->assign('jifen', $jifen);
			$this->assign('usr', $usr);
			$this->assign('permission', $permission);
		}


		$this->display(); // 输出模板
	}

	public function login() {
		$User = M('User');
		$data = array('username' => $_POST['username'], 'password' => $_POST['password']);
		$list = $User->where($data)->count();
		if ($list) {
			cookie('token', aes_encode($_POST['username']), array('expire'=>time()+3600*24));
			$this->success('登录成功！', '', false, array('token'=>aes_encode($_POST['username'])));
		} else {
			$this->error('登录失败！');
		}
		//$this->redirect('Index/index');

	}

	public function logout() {
		session(null);
		cookie('token', null, array('expire'=>-1));
		$this->redirect('Index/index');
	}

	public function reg() {
		$Form = D('User');
		if ($Form->create()) {
			$result = $Form->add();
			if ($result) {
				$this->success('注册成功！');
			} else {
				$this->error('注册失败！');
			}
		} else {
			$this->error($Form->getError());
		}

	}

	public function sign() {
		$User = M('User');
		$usr = aes_decode(cookie('token'));
		$sign = $User->where("username='$usr'")->getField('signtime');
		if ($sign == date('Y-m-d', time())) {
			if (IS_AJAX) {
				$this->error("今天已经签到");
				exit;
			}
			$this->redirect('Index/index');
			return;
		}
		$User->where("username='$usr'")->setField('signtime', date('Y-m-d', time()));
		$User->where("username='$usr'")->setInc('jifen', 10);
		if (IS_AJAX) {
			$this->success("签到成功");
		} else {
			$this->redirect('Index/index');
		}
	}

	public function category() {
		$this->initCategory();
		$this->success('', '',false, $this->ca);
	}

	public function regions() {
		$this->initCategory();
		$this->success('', '',false, $this->regions);
	}

	public function userinfo() {
		$User = M('User');
		$usr = aes_decode(cookie('token'));
		$data = $User->where("username='$usr'")->select()[0];
		if (empty($data['username'])) {
			$this->error('请先登录');
		}
		$this->success('', '', false, array(
			'id'=>$data['id'],
			'username'=>$data['username'],
			'jifen'=>$data['jifen'],
			'signtime'=>$data['signtime'],
			'date'=>$data['date']
		));
	}

}

?>