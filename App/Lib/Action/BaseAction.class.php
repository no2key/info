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
		$lang = $this->_param('lang');
		$cookieLang = cookie('lang');
		if (isset($lang)) {
			cookie('lang', $lang, array('expire'=>time()+3600*24));
		} else if (!isset($cookieLang)) {
			$lang = 'cn';
			cookie('lang', $lang, array('expire'=>time()+3600*24));
		} else {
			$lang = $cookieLang;
		}
		if ($lang == 'cn') {
			$GLOBALS['lang'] = 'LANG';
			$this->assign('change_lang', 'en');
		} else if ($lang = 'en') {
			$GLOBALS['lang'] = 'LANG-EN';
			$this->assign('change_lang', 'cn');
		}
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
