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
    	$combo['nid'] = I('post.combo_node', 1, 'int');
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
    public function addNode() {
        $node_data['name'] = I('post.node_name');
        $node_data['server_ip'] = I('post.node_server_ip');
        $node_data['domain_name'] = I('post.node_domain_name');
        $node_data['method'] = I('post.node_method');
        $node_data['remark'] = I('post.node_remark');
        $res = M('Node')->data($node_data)->add();
        if ($res) {
            $this->success('节点添加成功');
        }
    }
    public function editNodeStatus() {
        $status = I('post.status', 1, 'int');
        $nid = I('post.nid', 1, 'int');
        $Node = M('Node');
        $Node->status = $status;
        $res = $Node->where(array('nid' => $nid))->save();
        if ($res) {
          // $status = abs($status - 1);
          $this->ajaxReturn($status);
        }
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
}
