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
		$user_input['email'] = I('post.email', '', 'email,strip_tags,stripslashes,htmlspecialchars');
		$user_input['password'] = base64_encode(substr(I('post.password', '', 'strip_tags,stripslashes,htmlspecialchars'), 0, 20));
		if (checkArrayIsNull($user_input)) {
			$this->error('登录错误，事情绝对没有那没简单');
		}
		$res = M('Login')->where(array('email' => $user_input['email'], 'password' => $user_input['password']))->field('nickname,uid,admin,create_time')->find();
		if ($res) {
			// 获取用户个人信息
			session('nickname', $res['nickname']);
			session('uid', $res['uid']);
			session('registe', substr($res['create_time'], 0,10));
			session('admin', $res['admin']);
			$sum_cost = M('OrderRecord')->where(array('uid' => session('uid'), 'status' => 0, 'success' => 1))->sum('cost');
			session('sum_cost', $sum_cost);
			// 更新登录信息 时间和IP
			$user_data['last_login_time'] = date('Y-m-d H:i:s');
			$user_data['last_login_ip'] = get_client_ip();
			M('Login')->where(array('uid' => $res['uid']))->save($user_data);
			$this->success('登录成功', U('User/userCenter'));
		} else {
			$this->error('账号或密码不正确');
		}
	}
	public function doRegiste() {
		// 验证码的验证
        $verify = I('post.verify', '');
        if(!checkVerify($verify)){
            $this->error("亲，验证码输错了哦！",$this->site_url,5);
        }

		// 获取注册信息
		$user['email'] = I('post.email', '', 'email,strip_tags,stripslashes,htmlspecialchars');
		if (!checkEmail($user['email'])) {
			$this->error("亲，邮箱格式不对哦！",$this->site_url,5);
		}
		$user['nickname'] = I('post.nickname', '', 'strip_tags,stripslashes,htmlspecialchars');
		$user['password'] = base64_encode(substr(I('post.password', '', 'strip_tags,stripslashes,htmlspecialchars'), 0, 20));
		$user['last_login_ip'] = get_client_ip();
		$user['last_login_time'] = date('Y-m-d H:i:s');
		if (checkArrayIsNull($user)) {
			$this->error('注册错误，事情绝对没有那没简单');
		}

		// 检查邮箱是否已用
		$check_user_is_existed = M('Login')->where(array('email' => $user['email']))->count();
		if ($check_user_is_existed) {
			$this->error('该邮箱已被注册');
		}

		// 增加新用户
		$User = M('Login');
		$User->startTrans();
		$uid = $User->add($user);
		if ($uid) {
			$User->commit();
			session('nickname', $user['nickname']);
			session('uid', $uid);
			session('admin', 0);
			$this->success('注册成功', U('User/userCenter'));
		} else {
			$User->rollback();
			$this->error('Opps..注册出错了');
		}
	}
	public function logout() {
		session(null);
		$this->success('退出成功！', U('Index/index'));
	}
	// 定期执行检查过期套餐
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
		echo (date('Y-m-d h:i:s').' 执行成功');
	}
	public function verifyCode() {
		// 生成验证码
        $Verify = new \Think\Verify();
        $Verify->entry();
	}
}
