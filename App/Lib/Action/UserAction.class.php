<?php

// 本类由系统自动生成，仅供测试用途
class UserAction extends BaseAction {

	public function index() {
		if($this->login){
			$map = array();
			$map['status'] = 0;
			$map['uid'] = $this->login['id'];
			$Data = M('Publish');
			import('ORG.Util.Page');
			$count = $Data->where($map)->count();
			$Page = new Page($count);
			$show = $Page->show();
			// 进行分页数据查询
			$list = $Data->where($map)->order('date desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
			$pub = D('Publish');
			$pub->formatOutput($list);

			$this->assign('data', $list); // 赋值数据集
			if (!IS_AJAX) {
				$this->assign('page', $show); // 赋值分页输出
			} else {
				$this->assign('total', $Page->totalPages);
			}
		} else {
			$this->error(LC('user_not_login_tips'));
		}
		$this->display();
	}

	public function sendMail() {
		$mail = D('mail');
		if ($mail->create()) {
			$mail->from = $this->login['id'];
			if ($mail->add()) {
				$this->success(LT('fasong').LT('chenggong'), U('User/mail'));
			} else {
				$this->error($mail->getError());
			}
		} else {
			$this->error($mail->getError());
		}
	}

	public function mailDetail() {
		$mail = D('Mail');
		$map = array();
		$map[] = $this->_param('from');
		$data = array();
		foreach ($map as $vo) {
			$ret = $mail->where("(`to` = ".$vo." AND `from`=".$this->login['id'].") OR (`from`= ".$vo." AND `to`=".$this->login['id'].")")
				->order('date desc')->limit(10)->select();
			if ($this->login['id'] == $ret[0]['to']) {
				$data[$ret[0]['from']] = $ret;
			} else {
				$data[$ret[0]['to']] = $ret;
			}
		}

		$mail->formatOutput($data);
		$this->assign('data', $data);
		$this->display();
	}

	public function mail() {
		$mail = D('Mail');

		$recv = $mail->where(array('to'=>$this->login['id']))->Distinct(true)->field(array('from','date'))->order('date desc')->select();
		$send = $mail->where(array('from'=>$this->login['id']))->Distinct(true)->field(array('to', 'date'))->order('date desc')->select();
		$map = array();
		foreach ($recv as $vo) {
			if (!isset($map[$vo['from']])) {
				$map[$vo['from']] = strtotime($vo['date']);
			} else if ($map[$vo['from']] < strtotime($vo['date'])) {
				$map[$vo['from']] = strtotime($vo['date']);
			}
		}

		foreach ($send as $vo) {
			if (!isset($map[$vo['to']])) {
				$map[$vo['to']] = strtotime($vo['date']);
			} else if ($map[$vo['to']] < strtotime($vo['date'])) {
				$map[$vo['to']] = strtotime($vo['date']);
			}
		}
		arsort($map);
		$map = array_keys($map);
		import('ORG.Util.Page');
		$page = new Page(count($map), 1);
		$show = $page->show();
		$map = array_slice($map, $page->firstRow, $page->listRows);
		$this->assign('page', $show);

		$data = array();
		foreach ($map as $vo) {
			$ret = $mail->where("(`to` = ".$vo." AND `from`=".$this->login['id'].") OR (`from`= ".$vo." AND `to`=".$this->login['id'].")")
				->order('date desc')->limit(10)->select();
			if ($this->login['id'] == $ret[0]['to']) {
				$data[$ret[0]['from']] = $ret;
			} else {
				$data[$ret[0]['to']] = $ret;
			}
		}

		$mail->formatOutput($data);
		$this->assign('data', $data);
		$this->display();
	}

	public function userinfo() {
		if (!$this->login) {
			$this->error(LC('user_not_login_tips'));
		}
		$this->success('', '', false, array(
			'id'=>$this->login['id'],
			'username'=>$this->login['username'],
			'jifen'=>$this->login['jifen'],
			'signtime'=>$this->login['signtime'],
			'date'=>$this->login['date']
		));
	}

	public function refresh() {
		if (!$this->login) {
			$this->error(LC('user_not_login_tips'));
		}
		if ($this->login['jifen'] < C('JIFEN_REFRESH_DEC')) {
			$this->error(LC('no_enough_refresh_score', C('JIFEN_REFRESH_DEC')));
		}
		$Form   =   D('Publish');
		$Form->id = $this->_param('id');
		$Form->date = date('Y-m-d H:i:s', time());
		if ($Form->save()) {
			$User = M('User');
			$User->where("username='".$this->login['username']."'")->setDec('jifen', C('JIFEN_REFRESH_DEC'));
			$this->success(LT('caozuo').LT('chengong'));
		} else {
			$this->error(LT('xieru').LT('shibai'));
		}
	}

}

?>
