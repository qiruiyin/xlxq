<?php
namespace app\my\model;

use think\Model;
use think\DB;

class MyModel extends \think\Model {
	// 我的收益
	public function profit ($value='') {
		return Db::name('profit')->select();
	}

	// 我的预约
    public function appointment($userId=4) {
    	// 已付款
    	$orderDone = Db::table('glong_order')
        	->alias('o')
        	->join('glong_merchant m', 'o.merchant_id = m.id')
        	->join('glong_order_business ob', 'o.id = ob.order_id')
        	->join('glong_merchant_business mb', 'ob.merbusiness_id = mb.id')
        	->join('glong_business_details bd', 'mb.business_id = bd.id')
        	->join('glong_user_car uc', 'o.user_car_id = uc.id')
        	->field(['o.id', 'o.price', 'o.order_date', 'o.start_time', 'o.end_time',
        			'm.merchant_name', 'm.merchant_img', 
        			'GROUP_CONCAT(bd.business_name SEPARATOR "、")'=>'business_name',
        			'uc.car_name', 'uc.car_spce'])
        	->where("o.order_state = 1 AND o.user_id = ".$userId)
        	->order('o.id')
        	->limit(5)
        	->group('o.id')
        	->select();

    	// 未付款
        $orderProcess = Db::table('glong_order')
        	->alias('o')
        	->join('glong_merchant m', 'o.merchant_id = m.id')
        	->join('glong_order_business ob', 'o.id = ob.order_id')
        	->join('glong_merchant_business mb', 'ob.merbusiness_id = mb.id')
        	->join('glong_business_details bd', 'mb.business_id = bd.id')
        	->join('glong_user_car uc', 'o.user_car_id = uc.id')
        	->field(['o.id', 'o.price', 'o.order_date', 'o.start_time', 'o.end_time',
        			'm.merchant_name', 'm.merchant_img', 
        			'GROUP_CONCAT(bd.business_name SEPARATOR "、")'=>'business_name',
        			'uc.car_name', 'uc.car_spce'])
        	->where("o.order_state != 1 AND o.user_id = ".$userId)
        	->order('o.id')
        	->limit(5)
        	->group('o.id')
        	->select();

        return (object) [
		    "orderDone" => $orderDone,
        	"orderProcess" => $orderProcess
		];
    }

    // 我的爱车
    public function car($userId=4) {
    	$carDetail = DB::table('glong_user_car')->where('user_id ='.$userId)->order('car_state desc')->select();
    	
    	return (object) [
		    "carDetail" => $carDetail
		];;
    }

    public function setCarCurrent ($userId=4, $id) {
        // 取消旧的默认车辆
    	$setOld = DB::table('glong_user_car')
    		->where('car_state = 1 AND user_id = '.$userId)
    		->update(['car_state' => 0]);
        // 设置新的默认车辆
    	$setNew = DB::table('glong_user_car')
    		->where('id = '.$id)
    		->update(['car_state' => 1]);

    	return (object) [
		    "setOld" => $setOld,
        	"setNew" => $setNew
		];
    }
}