<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends AuthorizedController {
	public function dashboard() {
		$this->display();
	}
	public function userCenter() {
		$uid = session('uid');
		// get the announcement
		$user_center_data['announcement'] = M('Config')->where(array('id' => 1))->getField('announcement');
		// get the available order record
		$query_condition = array('uid' => $uid, 'success' => 1, 'expire_time' => array('gt', date('y-m-d h:i:s')));
		$available_order_record = D('OrderRecordComboView')->where($query_condition)->field('title,sid,nid,expire_time')->select();
		$Server = M('User');
		$Node = M('Node');
		for ($i=0; $i < count($available_order_record); $i++) {
			$server_data[$i] = $Server->where(array('port' => $available_order_record[$i]['sid']))->find();
			$server_data[$i]['used_flow'] = $server_data[$i]['u'] + $server_data[$i]['d'];
			$server_data[$i]['expire_time'] = $available_order_record[$i]['expire_time'];
			$nid = $available_order_record[$i]['nid'];
			$node_data = $Node->where(array('nid' => $nid, 'status' => 1))->find();
			$server_data[$i]['method'] = $node_data['method'];
			$server_data[$i]['domain_name'] = $node_data['domain_name'];
		}
		$user_center_data['server_data'] = $server_data;
		// dump($available_order_record);
		$this->assign('user_center_data', $user_center_data);
		$this->display();
	}
	public function getPurchasedCombo() {
		$uid = session('uid');
		$purchased_combo_data = D('OrderRecordComboView')->where(array('uid' => $uid))->order('purchase_time desc')->select();
		// dump($purchased_combo_data);
		$this->assign('purchased_combo_data', $purchased_combo_data);
		$this->display();
	}
	public function editPersonInfo() {
		if (!I('post.')) {
			$this->display();
		} else {
			$receive['old_password'] = sha1(I('post.old_password'));
			$receive['new_password'] = sha1(I('post.new_password'));
			$password = M('Login')->where(array('uid' => session('uid')))->getField('password');
			if ($receive['old_password'] === $password) {
				$data['password'] = $receive['new_password'];
				M('Login')->where(array('uid' => session('uid')))->field('password')->save($data);
				// session(null);
				$this->success('密码修改成功');
			} else {
				$this->error('原始密码不正确');
			}
		}
	}
	public function inviteFriends() {
		$this->display();
	}
	public function createInviteCode() {
		// TODO:achieve the function
	}
}
