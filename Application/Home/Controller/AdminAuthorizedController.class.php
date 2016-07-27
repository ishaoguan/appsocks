<?php
namespace Home\Controller;
use Think\Controller;
class AdminAuthorizedController extends AuthorizedController {
    // 初始化检查用户权限
    public function _initialize(){
        if(session('admin') == 1) {
        	return true;
        } else {
            $this->error('权限不足', U('Home/Index/index'));
        }
   }
}
