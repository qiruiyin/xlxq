<?php
namespace app\index\model;

use think\Model;
use think\DB;

class User extends \think\Model {
	public $demo = 'qwde1111h';
    
    public function datat($value='')
    {
        return Db::name('user')->select();
    }
}