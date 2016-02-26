<?php
namespace Home\Model;
use Think\Model\ViewModel;
class OrderRecordUserViewModel extends ViewModel {
	public $viewFields = array(
		'OrderRecord' => array('oid', 'uid', 'cid', 'purchase_time', 'expire_time', 'cost', 'success', 'sid'),
		'Login' => array('uid', 'nickname', '_on' => 'Login.uid=OrderRecord.uid')
	);
}
