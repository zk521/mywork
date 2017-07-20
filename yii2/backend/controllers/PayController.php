<?php
namespace backend\controllers;

use yii;
use db;
use yii\web\controller;
class PayController extends controller
{
	// 支付接口页面
	public function actionIndex(){
		return $this->renderPartial('index');
	}

	// 接值入库
	public function actionPaydata(){
		$data = yii::$app->request->get();
		$is_on = $data['is_on'];
		$sql = "insert into pay_three values(null,'$data[partner_id]','$data[account_numb]','$data[keys]','$data[p_name]','$data[p_desc]','$data[is_on]')";
		$db = yii::$app->db;
		$paydata = $db->createCommand($sql)->execute();
		if ($paydata) {
			echo 1;
		}else{
			echo 2;
		}
	}

	// 展示列表
	public function actionPaylist(){
		$db = yii::$app->db;
		$sql = "select * from pay_three";
		$paydata = $db->createCommand($sql)->queryAll();
		return $this->renderPartial('paylist',['paydata'=>$paydata]);
	}
}
?>