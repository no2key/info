<?php
class CategoryModel extends Model {

	public $ca;

	public function  getCategory() {
		if (isset($this->ca)) {
			return $this->ca;
		}
		$cate = M('category');
		$d = $cate->select();
		$this->ca = array();
		foreach($d as $v) {
			if ($v['pid'] == '0') {
				$this->ca[$v['id']]['name'] = $v['name'];
			} else {
				$this->ca[$v['pid']]['sub'][] = $v;
			}
		}
		return $this->ca;
	}

	public function getParent($id) {
		if (!isset($this->ca)) {
			$this->getCategory();
		}
		foreach ($this->ca as $pid=>$p) {
			foreach ($p['sub'] as $e) {
				if ($e['id'] == $id) {
					return $pid;
				}
			}
		}
	}

	public function getCateName($caId) {
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
}



?>