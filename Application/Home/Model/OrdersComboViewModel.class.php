<?php
namespace Home\Model;
use Think\Model\ViewModel;
class OrdersComboViewModel extends ViewModel {
	public $viewFields = array(
		'Orders' => array('oid', 'uid', 'cid', 'submit_time', 'status', 'remark'),
		'Combo' => array('cid', 'title', '_on' => 'Combo.cid=Orders.cid')
	);
}
