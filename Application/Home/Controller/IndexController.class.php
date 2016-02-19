<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }
    public function menu() {
        $this->display();
    }
    public function cart() {
    	$mid = I('get.mid', '1');
    	$combo_data = M('Combo')->where(array('cid' => $mid))->find();
    	$combo_data['summary'] = $combo_data['cost'];
    	$this->assign('combo', $combo_data);
        $this->display();
    }
    public function pay() {
    	$this->display();
    }
}
