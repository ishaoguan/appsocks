<?php
namespace Home\Model;
use Think\Model\ViewModel;
class UserOrderComboViewModel extends ViewModel {
	public $viewFields = array(
		'User' => array('id' => 'uid'),
		'OrderRecord' => array('oid', 'uid', 'cid', 'purchase_time', 'expire_time', 'cost', 'success','_on'=>'User.id=OrderRecord.uid'),
		'Combo' => array('cid', 'title', '_on' => 'Combo.cid=OrderRecord.cid')
	);
}
