<?php
namespace Home\Model;
use Think\Model\ViewModel;
class OrderRecordUserViewModel extends ViewModel {
	public $viewFields = array(
		'OrderRecord' => array('oid', 'uid', 'cid', 'purchase_time', 'expire_time', 'discount', 'cost', 'success', 'sid'),
		'Login' => array('uid', 'email', 'nickname', '_on' => 'Login.uid=OrderRecord.uid')
	);
}
