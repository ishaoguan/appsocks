<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends AuthorizedController {
	public function dashboard() {
		$this->display();
	}
	public function statistics() {
		$statistics_data['user_sign'] = M('Login')->count();
		$statistics_data['user_active'] = M('Login')->where(array('active' => 1))->count();
		$flow_data = M('User')->field('u,d')->select();
		$flow_used = 0;
		for ($i=0; $i < count($flow_data); $i++) {
			$flow_used = $flow_used + $flow_data[$i]['u'] + $flow_data[$i]['d'];
		}
		$statistics_data['flow_used'] = round($flow_used / 1048576, 2);
		$this->assign('statistics_data', $statistics_data);
		$this->display();
	}
	public function orderManage() {
		$orders_data = D('OrdersComboView')->where(array('status' => 1))->select();
		$User = M('Login');
		for ($i=0; $i < count($orders_data); $i++) {
			$orders_data[$i]['nickname'] = $User->where(array('uid' => $orders_data[$i]['uid']))->getField('nickname');
		}
		$this->assign('orders_data', $orders_data);
		$this->display();
	}
	public function OpenServer() {
		$oid = I('get.oid');
		$uid = I('get.uid');
		// mark the record as hvae read
		$order_data['status'] = 0;
		$res = M('Orders')->where(array('oid' => $oid))->save($order_data);
		if (!$res) {
			$this->error('开通出错');
		}
		// add to the order record
		unset($order_data);
		$order_data = D('OrdersComboView')->where(array('oid' => $oid))->find();
		$order_record['uid'] = $uid;
		$order_record['cid'] = $order_data['cid'];
		$order_record['purchase_time'] = date('y-m-d h:i:s');
		$order_record['expire_time'] = date('y-m-d h:i:s', strtotime(date('y-m-d h:i:s')) + $order_data['duration']*86400);
		$order_record['cost'] = $order_data['cost'];
		$orid = M('OrderRecord')->data($order_record)->add();
		if (!$orid) {
			$this->error('开通失败');
		}
		// open the server
		$server_data['passwd'] = rand(100000, 999999);
		$server_data['transfer_enable'] = $order_data['flow']*1024*1024;
		$server_data['u'] = 0;
		$server_data['d'] = 0;
		$port = M('User')->data($server_data)->add();
		$OrderRecord = M('OrderRecord');
		if (!$port) {
			$this->error('开通失败');
		} else {
			$OrderRecord->sid = $port;
			$OrderRecord->where(array('oid' => $orid))->save();
			$this->success('开通成功');
		}
	}
	public function closeOrder() {
		$oid = I('get.oid');
		$order_data['status'] = 0;
		$res = M('Orders')->where(array('oid' => $oid))->save($order_data);
		$this->success('拒绝成功');
	}
	public function userManage(){
		$User = M('Login');
		$count      = $User->count();
		$Page       = new \Think\Page($count,15);
		$show       = $Page->show();
		$list = $User->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	public function nodeManage() {
		$node_data = D('NodeComboView')->where(array('status' => 1))->select();
		$this->assign('node_data', $node_data);
		$this->display();
	}

	public function comboManage() {
		$combo_data = M('Combo')->select();
		$node_data = M('Node')->where(array('status' => 1))->field('nid,name')->select();
		$this->assign('node_data', $node_data);
		$this->assign('combo_data', $combo_data);
		$this->display();
	}
	public function inviteManage() {
		$this->display();
	}
}
