<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends AdminAuthorizedController {
	public function dashboard() {
		$this->display();
	}
	public function statistics() {
		$statistics_data['user_sign'] = M('Login')->count();
		$statistics_data['user_active'] = M('Login')->where(array('actived' => 1))->count();
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
		$orders_data = D('OrderRecordComboView')->where(array('status' => 1, 'success' => 0))->order('submit_time desc')->select();
		$User = M('Login');
		for ($i=0; $i < count($orders_data); $i++) {
			$orders_data[$i]['nickname'] = $User->where(array('uid' => $orders_data[$i]['uid']))->getField('nickname');
			$orders_data[$i]['email'] = $User->where(array('uid' => $orders_data[$i]['uid']))->getField('email');
		}
		$this->assign('orders_data', $orders_data);
		$this->display();
	}

	public function renewManage() {
		$renew_data = D('RenewUserView')->where(array('status' => 1))->order('submit_time desc')->select();
		// dump($renew_data);
		$this->assign('renew_data', $renew_data);
		$this->display();
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
		$node_data = M('Node')->select();
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
	public function billManage() {
		$Bill = D('OrderRecordUserView');
		$count      = $Bill->where(array('success' => 1, 'status' => 0))->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出
		$bill_data  = $Bill->where(array('success' => 1, 'status' => 0))->limit($Page->firstRow.','.$Page->listRows)->field('nickname,email,purchase_time,cost,discount,success')->order('purchase_time desc')->select();
		$this->assign('bill_data',$bill_data);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}
	public function discountManage() {
		$discount_data = M('DiscountCode')->order('create_time desc')->select();
		$this->assign('discount_data', $discount_data);
		$this->display();
	}
	public function configManage() {
		$config_data = M('Config')->where(array('id' => 1))->find();
		$this->assign('config_data', $config_data);
		$this->display();
	}
}
