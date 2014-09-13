<?php

/**
 * Class BaseAction
 * @property CategoryModel $ca
 * @property RegionModel $regions
 */
class BaseAction extends Action{

	public $ca;
	public $regions;
	public $login;

	public function _initialize() {
		$this->ca = D('Category');
		$cate = $this->ca->getCategory();
		$this->assign('category', $cate);
		$this->regions = D('Region');
		$regions = $this->regions->getRegion();
		$this->assign('regions', $regions);
		$this->login = D('User')->getLoginInfo();
		if ($this->login) {
			$this->assign('jifen', $this->login['jifen']);
			$this->assign('usr', $this->login['username']);
			$this->assign('permission', $this->login['permission']);
		}
	}
	

}



?>
