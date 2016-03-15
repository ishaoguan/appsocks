<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $menu_data = D('NodeComboView')->where(array('status' => 1))->order('cost')->field('cid,title,name,duration,flow,cost,remark')->limit(6)->select();
        $this->assign('menu_data', $menu_data);
        $this->display();
    }
    public function menu() {
        $menu_data = D('NodeComboView')->where(array('status' => 1))->order('cost')->field('cid,title,name,duration,flow,cost,remark')->limit(6)->select();
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
        if(!session('?uid')) {
            $user_data['nickname'] = I('post.nickname');
            $user_data['email'] = I('post.email');
            $user_data['password'] = base64_encode(substr(I('post.password'), 0, 20));
            $user_data['last_login_ip'] = get_client_ip();
            if (checkArrayIsNull($user_data)) {
              $this->error('注册失败，事情绝对没有那么简单');
            }
            $check_user_is_existed = M('Login')->where(array('email' => $user_data['email']))->count();
            if ($check_user_is_existed) {
              $this->error('该邮箱已被注册');
            }
            $uid = M('Login')->data($user_data)->add();
            if (!$uid) {
                $this->error('用户注册错误，订单提交失败');
            } else {
                session('uid', $uid);
                session('nickname', $user_data['nickname']);
            }
        } else {
            $uid = session('uid');
        }
        if (I('post.discount_code')) {
            $discount = M('DiscountCode')->where(array('code' => I('post.discount_code'), 'remain' => array('gt', 0)))->getField('discount');
            if ($discount) {
                $order_data['discount'] = $discount;
                M('DiscountCode')->where(array('code' => I('post.discount_code')))->setDec('remain');
            } else {
                $order_data['discount'] = 1;
            }
        } else {
            $order_data['discount'] = 1;
        }
        $order_data['uid'] = $uid;
        $order_data['cid'] = I('post.cid', 1);
        $order_data['submit_time'] = date('Y-m-d h:i:s');
        $cost = M('Combo')->where(array('cid' => $order_data['cid'], 'status' => 1))->getField('cost');
        if (!$cost) {
            $this->error('订购出错');
        }
        $order_data['cost'] = (float)$order_data['discount'] * $cost;
        if (!empty(I('post.remark'))) {
            $order_data['remark'] = I('post.remark');
        }
        // dump($order_data);die;
        if (checkArrayIsNull($order_data)) {
            $this->error('订购出错...');
        }
        $res = M('OrderRecord')->data($order_data)->add();
        if ($res) {
            $this->success('订单提交成功，马上进入后台', U('Home/User/dashboard'));
        } else {
            $this->error('订单提交失败，请联系管理员');
        }
    }
}
