<?php
namespace Home\Model;
use Think\Model\ViewModel;
class NodeComboViewModel extends ViewModel {
	public $viewFields = array(
		'Node'=>array('nid', 'cid','name', 'server_ip', 'domain_name', 'method', 'remark', 'status'),
		'Combo'=>array('title'=>'combo', '_on'=>'Node.cid=Combo.cid'),
	);
}
