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
		if ($jifen < C('JIFEN_POST_DEC')) {
			$this->error = '积分不足,至少需要'.C('JIFEN_POST_DEC').'分';
			return false;
		}
		if (isset($data['photo']) &&
			$jifen < (C('JIFEN_POST_PIC_DEC') + C('JIFEN_POST_DEC'))) {
			$this->error = '积分不足,发送有图信息至少需要'.(C('JIFEN_POST_PIC_DEC') + C('JIFEN_POST_DEC')).'分';
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

		$m = M('kv');
		$m->add(array(
			'key'=>"publish:".$data['id'],
			'value'=>0
		));
	}

	public function formatOutput(&$list, $picSize='m') {
		$ca = D('category');
		$re = D('region');
		foreach ($list as &$l) {
			$l['category'] = $ca->getCateName($l['category']);
			$l['region'] = $re->regions[$l['region']];
			$photos = explode(',', $l['photo']);
			if(empty($photos[0])){
				$l['photo'] = array();
				$l['thumb'] = C('BASE_URI').'img/photo_64.jpg';
			} else {
				$l['photo'] = array();
				foreach ($photos as $p) {
					$l['photo'][] = C('BASE_URI')."Uploads/{$picSize}_{$p}";
				}
				$l['thumb'] = $l['photo'][0];
			}
			$m = M('kv');
			$l['view'] = intval($m->where(array('key'=>"publish:".$l['id']))->getField('value'));
		}
	}

	public function addView($id) {
		$m = M('kv');
		if (!$m->where(array('key'=>"publish:$id"))->find()) {
			$m->add(array(
				'key'=>"publish:".$id,
				'value'=>0
			));
		}
		$m->where(array('key'=>"publish:$id"))->setInc('value', 1);
	}

}



?>