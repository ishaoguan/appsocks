<?php
namespace Home\Controller;
use Think\Controller;
class AjaxController extends AuthorizedController {
    public function getPersonOrderRecord() {
    	$uid = I('post.uid');
    	$record_data = D('OrderRecordComboView')->where(array('uid' => $uid))->select();
    	// var_dump($record_data);
    	$this->ajaxReturn($record_data);
    }
    public function getCombo() {
    	$cid = I('post.cid', 'int');
    	$combo_data = M('Combo')->where(array('cid' => $cid))->find();
    	$this->ajaxReturn($combo_data);
    }
    public function addCombo() {
    	$combo['title'] = I('post.combo_title', 'Null', 'string');
    	$combo['flow'] = I('post.combo_flow', 5, 'int') * 1024;
    	$combo['duration'] = I('post.combo_duration', 30, 'int');
    	$combo['cost'] = I('post.combo_cost', 15, 'int');
    	$combo['remark'] = I('post.combo_remark');
    	$combo['status'] = I('post.combo_status', 1, 'int');
    	$res = M('Combo')->data($combo)->add();
    	if ($res) {
    		$this->success('套餐添加成功');
    	} else {
    		$this->error('套餐添加失败');
    	}
    }
    public function editCombo() {
    	$cid = I('post.cid', 'int');
    	$combo['title'] = I('post.combo_title', 'Null', 'string');
    	$combo['flow'] = I('post.combo_flow', 5, 'int') * 1024;
    	$combo['duration'] = I('post.combo_duration', 30, 'int');
    	$combo['cost'] = I('post.combo_cost', 15, 'int');
    	$combo['remark'] = I('post.combo_remark');
    	$combo['status'] = I('post.combo_status', 1, 'int');
    	$res = M('Combo')->where(array('cid' => $cid))->save($combo);
    	if ($res) {
    		$this->success('套餐修改成功');
    	} else {
    		$this->error('套餐修改失败');
    	}
    }
    public function deleteCombo() {
    	$cid = I('get.cid', 'int');
    	$res = M('Combo')->where(array('cid' => $cid))->delete();
    	if ($res) {
    		$this->success('套餐删除成功');
    	} else {
    		$this->error('套餐删除失败');
    	}
    }
}
