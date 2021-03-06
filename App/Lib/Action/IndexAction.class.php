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
		//全站置顶KEY
		$s = array(-1);
		if ($category) {
			$s[] = $category;
			$cates = $this->ca->getCategory();
			if (!isset($cates[$category])) {
				$pid = $this->ca->getParent($category);
				$s[] = $pid;
			} else {
				foreach ($cates[$category]['sub'] as $sub) {
					$s[] = $sub['id'];
				}
			}
			$map['category'] = array('in', implode(',', $s));
		}
		$dingMap['info_zding.target'] = array('in', implode(',', $s));
		if ($title) {
			$map['title'] = array('like', "%$title%");
		}
		$Data = M('Publish');
		$Zding = M('Zding');
		$now = date('Y-m-d H:i:s', time());
		$dingMap['info_zding.zding_begin'] = array('lt', $now);
		$dingMap['info_zding.zding_end'] = array('gt', $now);
		$dingData = $Zding->join('`info_publish` ON `info_publish`.id = `info_zding`.id')->where($dingMap)->select();
		shuffle($dingData);
		$dingData = array_slice($dingData, 0, C('ZDING_NUM'));
		$s = array();
		foreach ($dingData as $ding) {
			$s[] = $ding['id'];
		}
		$map['id'] = array('not in', implode(',', $s));
		import('ORG.Util.Page');
		$count = $Data->where($map)->count();
		$Page = new Page($count, 5);
		$show = $Page->show();
		// 进行分页数据查询
		$list = $Data->where($map)->order('date desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		if (!is_array($list)) {
			$list = array();
		}
		foreach ($dingData as $ding) {
			array_unshift($list, $ding);
		}
		$pub = D('Publish');
		$pub->formatOutput($list, 's');
		$this->assign('data', $list);
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
			$this->success(LT('denglu').LT('chenggong'), C('BASE_URI'), false, array('token'=>aes_encode($_POST['username'])));
		} else {
			$this->error(LT('denglu').LT('shibai'));
		}
	}

	public function logout() {
		session(null);
		cookie('token', null, array('expire'=>-1));
		$this->redirect(C('BASE_URI'));
	}

	public function reg() {
		$Form = D('User');
		if ($Form->create()) {
			$result = $Form->add();
			if ($result) {
				$this->success(LT('zhuce').LT('chenggong'));
			} else {
				$this->error(LT('zhuce').LT('shibai'));
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
				$this->error(LS('had_signed_tips'));
				exit;
			}
			$this->redirect('Index/index');
			return;
		}
		$User->where("username='$usr'")->setField('signtime', date('Y-m-d', time()));
		$User->where("username='$usr'")->setInc('jifen', C('JIFEN_SIGN_INC'));
		if (IS_AJAX) {
			$this->success(LT('qiandao').LT('chenggong'));
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
		$data = $User->where("username='$usr'")->select();
		$data = $data[0];
		if (empty($data['username'])) {
			$this->error(LT('qingxiandenglu'));
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
