<?php
namespace Home\Model;
use Think\Model\ViewModel;
class NodeComboViewModel extends ViewModel {
	public $viewFields = array(
		'Node'=>array('nid', 'name', 'server_ip', 'domain_name', 'method', 'remark', 'status'),
		'Combo'=>array('cid', 'flow', 'duration', 'cost', 'title', 'remark', 'status', '_on'=>'Node.nid=Combo.nid'),
	);
}
