<?php
namespace Home\Model;
use Think\Model\ViewModel;
class RenewUserViewModel extends ViewModel {
	public $viewFields = array(
		'Renew' => array('rid', 'oid', 'uid', 'cost', 'time', 'submit_time', 'status'),
		'Login' => array('uid', 'email', 'nickname', '_on' => 'Login.uid=Renew.uid'),
	);
}
