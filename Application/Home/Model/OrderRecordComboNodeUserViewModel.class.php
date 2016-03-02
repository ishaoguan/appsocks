<?php
namespace Home\Model;
use Think\Model\ViewModel;
class OrderRecordComboNodeUserViewModel extends ViewModel {
	public $viewFields = array(
		'OrderRecord' => array('oid', 'uid', 'cid','submit_time', 'purchase_time', 'expire_time', 'cost', 'success', 'status', 'remark', 'sid'),
		'Combo' => array('cid', 'nid', 'title', 'duration', '_on' => 'Combo.cid=OrderRecord.cid'),
        'Node' => array('nid', 'domain_name', 'method', '_on' => 'Node.nid=Combo.nid'),
        'User' => array('port', 'passwd', 'u', 'd', 'transfer_enable', 'last_get_gift_time', '_on' => 'User.port=OrderRecord.sid'),
	);
}
