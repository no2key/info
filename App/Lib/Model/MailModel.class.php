<?php
class MailModel extends Model {
	// 定义自动验证
	protected $_validate    =   array(
		array('content','require','内容不能为空'),
	);

	public function formatOutput(&$list) {
		$u = M('user');
		foreach ($list as &$vo) {
			if (isset($vo['from'])) {
				$from = $vo['from'];
				$to = $vo['to'];
				$vo['from'] = $u->where(array('id'=>$from))->getField('username');
				$vo['to'] = $u->where(array('id'=>$to))->getField('username');
			} else {
				$new = array();
				foreach ($vo as &$v) {
					$from = $v['from'];
					$to = $v['to'];
					$newv = $v;
					$newv['from'] = $u->where(array('id'=>$from))->getField('username');
					$newv['to'] = $u->where(array('id'=>$to))->getField('username');
					array_unshift($new, $newv);
				}
				$vo = $new;

			}
		}
	}
}



?>