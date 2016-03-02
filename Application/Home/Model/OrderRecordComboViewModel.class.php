<?php
namespace Home\Model;
use Think\Model\ViewModel;
class OrderRecordComboViewModel extends ViewModel {
	public $viewFields = array(
		'OrderRecord' => array('oid', 'uid', 'cid','submit_time', 'purchase_time', 'expire_time', 'discount', 'cost', 'success', 'status', 'remark', 'sid'),
		'Combo' => array('cid', 'nid', 'flow', 'title', 'duration', '_on' => 'Combo.cid=OrderRecord.cid')
	);
}
