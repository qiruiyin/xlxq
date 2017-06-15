<?php
namespace app\my\controller;

use think\Controller;
use app\my\model\MyModel;

class My extends \think\Controller {

    public function index() {
		return '默认页面'; 
    }    

    // 分享推荐
    public function share() {
        return $this->fetch('share');
    }

    // 我的收益
    public function profit() {
        $my = new MyModel();
        return json($my->profit());
        // return $this->fetch('profit');
    }

    // 我的预约
    public function appointment() {
        $my = new MyModel();
        // 用户id
        $appointment = $my->appointment(5);
        $this->assign([
            'orderDone' => $appointment->orderDone,
            'orderProcess' => $appointment->orderProcess
        ]);
        return $this->fetch('appointment');
    }

    // 我的爱车
    public function car($userId) {
        $my = new MyModel();
        $car = $my->car($userId);
        $this->assign([
            'carDetail' => $car->carDetail
        ]);
        return $this->fetch('car');
    }

    // 我的车库
    public function carport($userId) {
        $my = new MyModel();
        $car = $my->car($userId);
        $this->assign([
            'carDetail' => $car->carDetail
        ]);
        
        return $this->fetch('carport');
    }

    // 设置默认车辆
    public function setCarCurrent ($userId=4, $id=1) {
        $my = new MyModel();
        $car = $my->setCarCurrent($userId, $id);
        
        $response = array ('code'=> 200,'success'=> false, 'data'=> '失败');

        if($car->setOld && $car->setNew) {
            $response['success'] = true;
            $response['data'] = '成功';
        }

        return $response;
    }
}
