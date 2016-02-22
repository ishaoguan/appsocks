<?php
namespace Home\Model;
use Think\Model\ViewModel;
class OrderRecordComboViewModel extends ViewModel {
	public $viewFields = array(
		'OrderRecord' => array('oid', 'uid', 'cid', 'purchase_time', 'expire_time', 'cost', 'success', 'sid'),
		'Combo' => array('cid', 'nid', 'title', '_on' => 'Combo.cid=OrderRecord.cid')
	);
}
