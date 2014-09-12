<?php 
class DetailAction extends BaseAction{

	public function index(){
		$Data = D('Publish');
		$list = $Data->where(array(
			'id'=>$this->_param('id')
		))->select();
		$Data->formatOutput($list);
		$Data->addView($list[0]['id']);

		$this->assign('data', $list[0]);

		$this->display();
		
	}
	

}



?>