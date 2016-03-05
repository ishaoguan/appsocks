<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {
	public function login() {
		$this->display();
	}
	public function registe() {
		$this->display();
	}
	public function doLogin() {
		$user_input['email'] = I('post.email');
		$user_input['password'] = base64_encode(I('post.password'));
		if (checkArrayIsNull($user_input)) {
			$this->error('登录错误，事情绝对没有那没简单');
		}
		$res = M('Login')->where(array('email' => $user_input['email'], 'password' => $user_input['password']))->field('nickname,uid,admin')->find();
		if ($res) {
			session('nickname', $res['nickname']);
			session('uid', $res['uid']);
			session('admin', $res['admin']);
			$user_data['last_login_time'] = date('Y-m-d H:i:s');
			$user_data['last_login_ip'] = get_client_ip();
			M('Login')->where(array('uid' => $res['uid']))->save($user_data);
			$this->success('登录成功', U('Home/User/dashboard'));
		} else {
			$this->error('账号或密码不正确');
		}
	}
	public function doRegiste() {
		$user['email'] = I('post.email');
		$user['nickname'] = I('post.nickname');
		$user['password'] = base64_encode(I('post.password'));
		$user['last_login_ip'] = get_client_ip();
		$user['last_login_time'] = date('Y-m-d H:i:s');
		if (checkArrayIsNull($user)) {
			$this->error('注册错误，事情绝对没有那没简单');
		}
		$check_user_is_existed = M('Login')->where(array('email' => $user['email']))->count();
		if ($check_user_is_existed) {
			$this->error('该邮箱已被注册');
		}
		$User = M('Login');
		$User->startTrans();
		$uid = $User->add($user);
		if ($uid) {
			$User->commit();
			session('nickname', $user['nickname']);
			session('uid', $uid);
			session('admin', 0);
			$this->success('注册成功', U('Home/User/dashboard'));
		} else {
			$User->rollback();
			$this->error('Opps..注册出错了');
		}
	}
	public function logout() {
		session(null);
		$this->success('退出成功！', U('Home/Index/index'));
	}
	public function cron() {
		$order_record = M('OrderRecord')->where(array('success' => 1))->field('sid,expire_time')->select();
		$Server = M('User');
		for ($i=0; $i < count($order_record); $i++) {
			if(strtotime($order_record[$i]['expire_time']) < time()) {
				$Server->enable = 0;
				$Server->switch = 0;
				$Server->where(array('port' => $order_record[$i]['sid'] ))->save();
			} else {
				continue;
			}
		}
		echo (date('y-m-d h:i:s').' 执行成功');
	}
}
