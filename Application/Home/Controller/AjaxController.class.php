<?php
namespace Home\Controller;
use Think\Controller;
class AjaxController extends AdminAuthorizedController {
    public function getPersonOrderRecord() {
    	$uid = I('post.uid');
    	$record_data = D('OrderRecordComboView')->where(array('uid' => $uid))->select();
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
    public function editComboStatus() {
      $cid = I('post.cid','int');
      $status = I('post.status', 1, 'int');
      $Combo = M('Combo');
      $Combo->status = $status;
      $res = $Combo->where(array('cid' => $cid))->save();
      if ($res) {
        $this->ajaxReturn($status);
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
    public function openServer() {
        $oid = I('get.oid');
        $uid = I('get.uid');
        // mark the record as hvae read and update the status
        $duration = D('OrderRecordComboView')->where(array('oid' => $oid))->getField('duration');
        $order_record['purchase_time'] = date('Y-m-d H:i:s');
        $order_record['expire_time'] = date('Y-m-d H:i:s', strtotime(date('y-m-d h:i:s')) + $duration*86400);
        $order_record['success'] = 1;
        $order_record['status'] = 0;
        $res = M('OrderRecord')->where(array('oid' => $oid))->save($order_record);
        if (!$res) {
            $this->error('开通失败');
        }
        // open the server
        $flow = D('OrderRecordComboView')->where(array('oid' => $oid))->getField('flow');
        $server_data['passwd'] = rand(100000, 999999);
        $server_data['u'] = 0;
        $server_data['d'] = 0;
        $server_data['transfer_enable'] = $flow*1024*1024;
        $port = M('User')->data($server_data)->add();
        // add the port to the tabel order_record
        $OrderRecord = M('OrderRecord');
        if (!$port) {
            $this->error('开通失败');
        } else {
            $OrderRecord->sid = $port;
            $OrderRecord->where(array('oid' => $oid))->save();
            // active the user account
            $actived['actived'] = 1;
            M('Login')->where(array('uid' => $uid))->save($actived);
            $this->success('开通成功');
        }
    }
    public function closeOrder() {
        $oid = I('get.oid');
        $order_data['status'] = 0;
        $order_data['success'] = 0;
        $res = M('OrderRecord')->where(array('oid' => $oid))->save($order_data);
        $this->success('关闭订单成功');
    }
    public function openRenew() {
        $rid = I('get.rid');
        $oid = I('get.oid');
        $res = M('Renew')->where(array('rid' => $rid, 'status' => 1))->find();
        if ($res) {
            $renew_data['status'] = 0;
            $order_data = M('OrderRecord')->where(array('oid' => $oid, 'status' => 0, 'expire_time' => array('gt', date('Y-m-d h:i:s'))))->field('cost,expire_time')->find();
            $order_data['expire_time'] = date('Y-m-d H:i:s', strtotime($order_data['expire_time']) + $res['time']*2592000);
            $order_data['cost'] += $res['cost'];
            M('Renew')->where(array('rid' => $rid, 'status' => 1))->save($renew_data);
            M('OrderRecord')->where(array('oid' => $oid))->field('expire_time,cost')->save($order_data);
            $this->success('开通成功');
        } else {
            $this->error('开通失败！');
        }
    }
    public function closeRenew() {
        $rid = I('get.rid');
        $res = M('Renew')->where(array('rid' => $rid, 'status' => 1))->setDec('status');
        if ($res) {
            $this->success('拒绝成功');
        } else {
            $this->error('拒绝失败');
        }
    }
    public function searchBill() {
        $up_to_time = I('post.time',date('Y-m-d'), '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/');
        $Bill       = D('OrderRecordUserView');
        $query_condition['purchase_time'] = array('LT', $up_to_time);
    		$count      = $Bill->where($query_condition)->count();// 查询满足要求的总记录数
    		$Page       = new \Think\Page($count,10);
    		$show       = $Page->show();// 分页显示输出
    		$bill_data  = $Bill->where($query_condition)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->up_to_time = $up_to_time;
    		$this->assign('bill_data',$bill_data);// 赋值数据集
    		$this->assign('page',$show);// 赋值分页输出
    		$this->display('Admin:billManage');
    }
    public function addDiscount() {
        $discount_data['discount'] = I('post.discount_discount');
        $discount_data['remain'] = I('post.discount_remain');
        $discount_data['remark'] = I('post.discount_remark');
        $discount_data['create_time'] = date('Y-m-d H:i:s');
        $discount_data['code'] = sha1(date('Y-m-d H:i:s'));
        $discount_data['status'] = I('post.discount_status');
        $res = M('DiscountCode')->add($discount_data);
        if ($res) {
            $this->success('添加成功');
        } else {
            $this->error('添加失败');
        }
    }
    public function editDiscountStatus() {
        $did = I('post.did');
        $data['status'] = I('post.status');
        $res = M('DiscountCode')->where(array('did' => $did))->save($data);
        if ($res) {
            $this->ajaxReturn($res);
        } else {
            $this->ajaxReturn('502');
        }
    }
    public function editConfig() {
      $config_data['announcement'] = I('post.announcement');
      $config_data['signin'] = I('post.signin');
      $config_data['signin_interval'] = I('post.signin_interval');
      $config_data['signin_max'] = I('post.signin_max');
      $config_data['signin_min'] = I('post.signin_min');
      $config_data['invite'] = I('post.invite');
      if(checkArrayIsNull($config_data)) {
        $this->error('配置不能为空');
      }
      $res = M('Config')->where(array('id' => 1))->save($config_data);
      if ($res) {
        $this->success('系统配置修改成功');
      } else {
        $this->error('系统配置修改失败');
      }
    }
}
