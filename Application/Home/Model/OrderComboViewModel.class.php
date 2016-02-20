<?php
namespace Home\Model;
use Think\Model\ViewModel;
class OrderComboViewModel extends ViewModel {
	public $viewFields = array(
		'OrderRecord' => array('oid', 'uid', 'cid', 'purchase_time', 'expire_time', 'cost', 'success', 'sid'),
		'Combo' => array('cid', 'title', '_on' => 'Combo.cid=OrderRecord.cid')
	);
}
