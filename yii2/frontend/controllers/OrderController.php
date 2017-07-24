<?php
namespace frontend\controllers;

use yii;
use db;
use yii\web\controller;
class OrderController extends Commoncontroller
{
	// 展示订单页面
	public function actionIndex(){
		// 两表联查 a.order_info 和 b.order_goods
		$db = yii::$app->db;
		$sql = "SELECT * FROM order_info LEFT JOIN order_goods ON order_info.id = order_goods.order_goods_id";
		$order_data = $db->createCommand($sql)->queryAll();
		return $this->renderPartial('orderlist',['order_data'=>$order_data]);
	}
	// 多条件搜索
	public function actionInfo(){
		$db = yii::$app->db;
		$data = yii::$app->request->get();
		$where = '1=1';
		// 订单编号
		$order_sn = $data['order_sn'];
		// 订单状态
		$order_status = $data['order_status'];
		// 物流状态
		$shipping_status = $data['shipping_status'];
		isset($order_sn)? $order_sn:"";
		isset($order_status)? $order_status:"";
		isset($shipping_status)? $shipping_status:"";
		// 各种情况
		if ($order_sn !== "" && $order_status == "" && $shipping_status == "") {
			$where .= ' and `order_sn` like "%'.$order_sn.'%"';
		}
		if ($order_sn !== "" && $order_status !== "" && $shipping_status == "") {
			$where .= ' and `order_sn` like "%'.$order_sn.'%" and `order_status` = '.$order_status;
		}
		if ($order_sn !== "" && $order_status !== "" && $shipping_status !== "") {
			$where .= ' and `order_sn` like "%'.$order_sn.'%" and `order_status` = '.$order_status.' `shipping_status` = '.$shipping_status;
		}
		if ($order_sn == "" && $order_status !== "" && $shipping_status !== "") {
			$where .= ' and `order_status` = '.$order_status.' and `shipping_status` = '.$shipping_status;
		}
		if ($order_sn == "" && $order_status == "" && $shipping_status !== "") {
			$where .= ' and `shipping_status` = '.$shipping_status;
		}
		if ($order_sn == "" && $order_status !== "" && $shipping_status == "") {
			$where .= ' and `order_status` = '.$order_status;
		}
		if ($order_sn == "" && $order_status == "" && $shipping_status == "") {
			$where .= '';
		}
		$sql = sprintf("SELECT * FROM order_info LEFT JOIN order_goods ON order_info.id = order_goods.order_goods_id WHERE %s",$where);
		$search_data = $db->createCommand($sql)->queryAll();
		$json = json_encode($search_data);
		echo preg_replace("#\\\u([0-9a-f]+)#ie","iconv('UCS-2','UTF-8', pack('H4', '\\1'))",$json);
	}
}
?>