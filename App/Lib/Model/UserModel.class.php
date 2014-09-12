<?php
class UserModel extends Model {
    // 定义自动验证
    protected $_validate    =   array(
        array('username','require','用户名必须'),
        array('username','','用户名已经存在！',0,'unique',1), 
        array('repassword','password','确认密码不正确',0,'confirm'),
        array('password','require','密码必须'),
	);

	public function getLoginInfo() {
		$vo = false;
		$User = M('User');
		$usr = aes_decode(cookie('token'));
		if ($User->where("username='$usr'")->count()) {
			$vo = $User->where("username='$usr'")->select()[0];
		}
		return $vo;
	}
}



?>