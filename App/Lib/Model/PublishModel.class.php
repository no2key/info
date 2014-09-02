<?php
class PublishModel extends Model {
    // 定义自动验证
    protected $_validate    =   array(
        array('title','require','标题必须'),
		array('uid','require','请先登录'),
	);

	protected function _before_insert(&$data,$options) {
		$User=M('User');
		$usr=aes_decode(cookie('token'));
		$jifen = $User->where("username='$usr'")->getField('jifen');
		if ($jifen < 10) {
			$this->error = '积分不足,至少需要10分';
			return false;
		}
		if (isset($data['photo']) && $jifen < 20) {
			$this->error = '积分不足,发送有图信息至少需要20分';
			return false;
		}
		return true;
	}

	protected function _after_insert($data,$options) {
		$dec = 10;
		if (isset($data['photo'])) {
			$dec += 10;
		}
		$User=M('User');
		$usr=aes_decode(cookie('token'));
		$User->where("username='$usr'")->setDec('jifen', $dec);
	}
}



?>