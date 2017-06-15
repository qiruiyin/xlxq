<?php
namespace app\index\controller;

use app\index\model\User;

use think\Controller;
use think\DB;

class Index extends \think\Controller {
    public function index() {
    	$user = new User();
    	$data1 = Db::name('user')->select();

        // return json($user->datat());
    	// return json($data1);
    }	
    
    public function hello($name) {
    	return 'qeqe'; 
        // return $this->fetch('hello',['name'=>$name]);
    }
}
