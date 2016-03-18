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

		// get the available order
		$num =	M('OrderRecord')->where(array('uid' => $uid, 'success' => 0, 'status' => 1, 'success' => 0))->count();
		if ($num) {
			$user_center_data['server_hint'] = '有'.$num.'个套餐待支付，加入售后群 <a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=b276d45ea49eda2565bacb8bc200ec0d36d2c8725815beac3919f0ec456e7e4f">513222519</a> 与管理员联系转账';
		} else {
			$user_center_data['server_hint'] = null;
		}
		$query_condition = array('uid' => $uid, 'success' => 1, 'status' => 0, 'expire_time' => array('gt', date('y-m-d h:i:s')));
		$available_order = D('OrderRecordComboNodeUserView')->where($query_condition)->field('oid,domain_name,method,passwd,expire_time,port,u,d,transfer_enable')->select();
		$user_center_data['server_data'] = $available_order;

		$this->assign('user_center_data', $user_center_data);
		// dump($user_center_data);
		$this->display();
	}
	function renew() {
		$oid = I('get.id');
		$query_condition = array('oid' => $oid, 'uid' => session('uid'), 'expire_time' => array('gt', date('y-m-d h:i:s')));
		$res = D('OrderRecordComboView')->where($query_condition)->field('oid,cid,expire_time,discount,cost,price')->find();
		if ($res) {
			$this->assign('renew_data', $res);
			$this->display();
		} else {
			$this->error('不可续费！');
		}
    }
	function renewing() {
		$renew_data = I('post.');
		$is_null = checkArrayIsNull($renew_data);
		if ($is_null) {
			$this->error('续费错误，事情绝对没有那没简单');
		}
		$query_condition = array('oid' => $renew_data['id'], 'uid' => session('uid'), 'expire_time' => array('gt', date('y-m-d h:i:s')));
		$order_record = D('OrderRecordComboView')->where($query_condition)->field('oid,cid,expire_time,discount,cost,price')->find();
		if ($order_record) {
			$price = $order_record['price'] * $order_record['discount'] * $renew_data['time'];
			$renew_data['oid'] = $order_record['oid'];
			$renew_data['uid'] = session('uid');
			$renew_data['cost'] = $price;
			$renew_data['submit_time'] = date('y-m-d h:i:s');
			$rid = M('Renew')->add($renew_data);
			$this->success('订单已提交');
		} else {
			$this->error('不可续费！');
		}
	}
	public function getPurchasedCombo() {
		$uid = session('uid');
		$purchased_combo_data = D('OrderRecordComboView')->where(array('uid' => $uid))->order('purchase_time desc')->select();
		$this->assign('purchased_combo_data', $purchased_combo_data);
		$this->display();
	}
	public function editPersonInfo() {
		if (!I('post.')) {
			$this->display();
		} else {
			$receive['old_password'] = base64_encode(I('post.old_password'));
			$receive['new_password'] = base64_encode(I('post.new_password'));
			if (checkArrayIsNull($receive)) {
				$this->error('修改错误，事情绝对没有那没简单');
			}
			$password = M('Login')->where(array('uid' => session('uid')))->getField('password');
			if ($receive['old_password'] === $password) {
				$data['password'] = $receive['new_password'];
				M('Login')->where(array('uid' => session('uid')))->field('password')->save($data);
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
