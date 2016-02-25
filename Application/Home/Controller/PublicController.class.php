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
		$email = I('post.email');
		$password = sha1(I('post.password'));
		$res = M('Login')->where(array('email' => $email, 'password' => $password))->field('nickname,uid,admin')->find();
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
		$user['password'] = sha1(I('post.password'));
		$user['last_login_ip'] = get_client_ip();
		$user['last_login_time'] = date('Y-m-d H:i:s');
		$user['actived'] = 1;
		$res = M('Login')->data($user)->add();
		if ($res) {
			session('nickname', $res['nickname']);
			session('uid', $res['uid']);
			session('admin', $res['admin']);
			$this->success('注册成功', U('Home/Index/index'));
		} else {
			$this->error('Opps..注册出错了');
		}
	}
	public function logout() {
		session(null);
		$this->success('退出成功！', U('Home/Index/index'));
	}
	public function cron() {
		$res = M('OrderRecord')->where(array('success' => 1))->field('sid,expire_time')->select();
		$Server = M('User');
		for ($i=0; $i < count($res); $i++) {
			if($res[$i]['expire_time'] > date('y-m-d h:i:s')) {
				$Server->enable = 0;
				$Server->switch = 0;
				$Server->where(array('port' => $res[$i]['sid'] ))->save();
			} else {
				continue;
			}
		}
		echo '执行成功';
	}
}
