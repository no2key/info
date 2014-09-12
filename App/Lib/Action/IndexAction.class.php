<?php

// 本类由系统自动生成，仅供测试用途
class IndexAction extends BaseAction {

	public function index() {
		$region = $this->_param('region');
		if (isset($region)) {
			if ($region == 0) {
				$region = null;
				cookie('region', null, array('expire'=>-1));
			} else {
				$tmp = $this->regions->getRegion();
				cookie('region', array('id'=>$region, 'name'=>$tmp[$region]), array('expire'=>time()+3600*24));
			}
		} else {
			$tmp = cookie('region');
			$region = $tmp['id'];
		}
		$category = $this->_param('category');
		$title = $this->_param('title');
		$map = array();
		$map['status'] = 0;
		if ($region) {
			$map['region'] = $region;
		}
		if ($category) {
			$cates = $this->ca->getCategory();
			if (!isset($cates[$category])) {
				$map['category'] = array('in', $category);
			} else {
				$q = ['in'];
				foreach ($cates[$category]['sub'] as $sub) {
					$q[] = $sub['id'];
				}
				$map['category'] = $q;
			}
		}
		if ($title) {
			$map['title'] = array('like', "%$title%");
		}
		$Data = M('Publish');
		import('ORG.Util.Page');
		$count = $Data->where($map)->count();
		$Page = new Page($count);
		$show = $Page->show();
		// 进行分页数据查询
		$list = $Data->where($map)->order('date desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$pub = D('Publish');
		$pub->formatOutput($list, 's');

		$this->assign('data', $list); // 赋值数据集
		if (!IS_AJAX) {
			$this->assign('page', $show); // 赋值分页输出
		} else {
			$this->assign('total', $Page->totalPages);
		}

		$this->display();
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
		if (!$this->login) {
			$this->error("请先登录");
		}
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
		$User->where("username='$usr'")->setInc('jifen', C('JIFEN_SIGN_INC'));
		if (IS_AJAX) {
			$this->success("签到成功");
		} else {
			$this->redirect('Index/index');
		}
	}

	public function category() {
		$this->ca->getCategory();
		$this->success('', '',false, $this->ca);
	}

	public function regions() {
		$this->regions->getRegion();
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