<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }
    public function menu() {
        $menu_data = M('Combo')->where(array('status' => 1))->limit(3)->select();
        $Node = M('Node');
        for ($i=0; $i < count($menu_data); $i++) {
            $menu_data[$i]['node'] = $Node->where(array('nid' => $menu_data[$i]['nid']))->getField('name');
            // dump($menu_data[$i]);
        }


        $this->assign('menu_data', $menu_data);
        $this->display();
    }
    public function cart() {
    	$mid = I('get.cid', '1');
    	$combo_data = M('Combo')->where(array('cid' => $mid))->find();
    	$combo_data['summary'] = $combo_data['cost'];
    	$this->assign('combo', $combo_data);
        $this->display();
    }
    public function pay() {
        $cid = I('post.cid');
        if(!session('?uid')) {
            $user_data['nickname'] = I('post.nickname');
            $user_data['email'] = I('post.email');
            $user_data['password'] = sha1(I('post.password'));
            $user_data['last_login_ip'] = get_client_ip();
            $uid = M('Login')->data($data)->add();
            if (!$uid) {
                $this->error('用户注册错误，订单提交失败');
            } else {
                session('uid', $uid);
                session('nickname', $user_data['nickname']);
            }
        } else {
            $uid = session('uid');
        }
        $orders_data['uid'] = $uid;
        $orders_data['cid'] = $cid;
        $orders_data['remark'] = I('post.remark');
        $res = M('Orders')->data($orders_data)->add();
        if ($res) {
            $this->success('订单提交成功，马上进入后台', U('Home/User/dashboard'));
        } else {
            $this->error('订单提交失败，请联系管理员');
        }
    }
}
