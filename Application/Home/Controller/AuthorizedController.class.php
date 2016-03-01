<?php
namespace Home\Controller;
use Think\Controller;
class AuthorizedController extends Controller {
    // 初始化检查用户权限
    public function _initialize(){
        if(session('?uid')) {
        	return true;
        } else {
            $this->error('请先登录', U('Home/Public/login'));
        }
   }
}
