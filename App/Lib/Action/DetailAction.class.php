<?php 
class DetailAction extends Action{

	public $ca;
	public $regions;

	public function _initialize() {
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

	public function index(){
		$Data = M('Publish');
		$list=$Data->where("id={$_GET['id']}")->find();
		$list['category'] = $this->_getCateName($list['category']);
		$list['region'] = $this->regions[$list['region']];
		$tmp = explode(',', $list['photo']);
		if (!empty($tmp[0])) {
			$phos = array();
			foreach ($tmp as $t) {
				$phos[] = '/Uploads/m_'.$t;
			}
			$list['photo'] = $phos;
		}
		$this->assign('data', $list);

		//dump($res);
		$this->display();
		
	}
	

}



?>