<?php
class KVModel extends Model {

	public function set($key, $val) {
		$m = M('kv');
		$m->setField($key, $val);
	}

}



?>