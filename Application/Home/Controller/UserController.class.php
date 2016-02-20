<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends AuthorizedController {
	public function dashboard() {
		// checkPermission(I('get.uid'));
		$this->display();
	}
	public function userCenter() {
		$uid = session('uid');
		// get the announcement
		$user_center_data['announcement'] = M('Config')->where(array('id' => 1))->getField('announcement');
		// get the available order record to calculate the used flow
		$query_condition = array('uid' => $uid, 'success' => 1, 'expire_time' => array('gt', date('y-m-d h:i:s',time())));
		$available_order_record = D('OrderComboView')->where($query_condition)->field('title,sid,expire_time')->select();
		$Server = M('User');
		for ($i=0; $i < count($available_order_record); $i++) {
				$server_data[$i] = $Server->where(array('sid' => $available_order_record[$i]['sid']))->find();
				$server_data[$i]['used_flow'] = $server_data[$i]['u'] + $server_data[$i]['d'];
				$server_data[$i]['expire_time'] = $available_order_record[$i]['expire_time'];
		}
		$user_center_data['server_data'] = $server_data;
		// dump($user_center_data);
		$this->assign('user_center_data', $user_center_data);
		$this->display();
	}
	public function getPurchasedCombo() {
		$uid = session('uid');
		$purchased_combo_data = D('OrderComboView')->where(array('uid' => $uid))->order('purchase_time desc')->select();
		// dump($purchased_combo_data);
		$this->assign('purchased_combo_data', $purchased_combo_data);
		$this->display();
	}
	// public function getPersonInfo() {
	// 	$person_info_data = M('Login')->where(array('uid' => session('uid')))->find();
	// 	dump($person_info_data);
	// 	$this->display();
	// }
	public function editPersonInfo() {
		if (!I('post.')) {
			$this->display();
		} else {

		}
	}
	public function inviteFriends() {
		$this->display();
	}
	public function createInviteCode() {
		// TODO:achieve the function
	}
}
