<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/7/19
 * Time: 16:06
 */

namespace backend\controllers;


use yii\web\Controller;
use db;
use yii;
class CountController extends Controller
{
    public $enableCsrfValidation = false;
    //展示统计页面
    public function actionIndex(){
        //商家数量
        $data['bussNum'] = $this->getCount('bussiness');
        //用户数量
        $data['userNum'] = $this->getCount('user');
        //订单数量
        $data['orderNum'] = $this->getCount('order_info');
        //销量总额
        $db = yii::$app->db;
        $sql = 'select order_amount from order_info where pay_status = 1';
        $result = $db->createCommand($sql)->queryAll();
        $data['price'] = 0;
        foreach($result as $key=>$val){
          $data['price'] += $val['order_amount'];
        }

        //统计信息数组
        return $this->renderPartial('count',['data'=>$data]);
    }
    //查询数量方法
    public function getCount($dbname){
        $db = yii::$app->db;
        //查看商家表
        $sql = "select `id` from ".$dbname;
        $res = $db->createCommand($sql)->execute();
        return $res;
    }
}