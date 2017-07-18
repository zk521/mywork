<?php
namespace backend\controllers;

use yii;
use db;
use yii\web\controller;
use yii\web\UploadedFile;

class VipController extends controller
{
	//vip会员页面展示
	public function actionIndex(){
		return $this->renderPartial('vip.php');
	}
	//vip会员添加展示
	public function actionAdd(){
		//将级别查询出来传递到前台
		$db = yii::$app->db;
		$sql = "select * from viprank";
		$leverdata = $db->createCommand($sql)->queryAll();
		return $this->renderPartial('vipadd',['leverdata'=>$leverdata]);
	}
	//添加页面接值入库
	public function actionAdddata(){
		$data = yii::$app->request->get();
		$time = date('Y-m-d',time());
		$sql = "insert into vip values(null,'$data[email]','$data[lever]','$time','等级积分','$time','最后登录','最后修改','最后ip','$data[parent_id]','$data[alias]','qq','$data[mobile_phone]','$data[is_validated]','最大消费')";
		$db = yii::$app->db;
		$lever = $db->createCommand($sql)->execute();
		if ($lever) {
			echo 1;
		}else{
			echo 2;
		}
	}

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	//会员级别添加展示
	public function actionRankadd(){
		return $this->renderPartial('rankadd.php');
	}
	//级别添加
	public function actionRanklever(){
		$lever = yii::$app->request->get();
		$sql = "insert into viprank values(null,'$lever[lever]')";
		$db = yii::$app->db;
		$lever = $db->createCommand($sql)->execute();
		if ($lever) {
			echo 1;
		}else{
			echo 2;
		}
	}
	//会员级别展示
	public function actionRanklist(){
		$db = yii::$app->db;
		$sql = "select * from viprank";
		$leverdata = $db->createCommand($sql)->queryAll();
		return $this->renderPartial('ranklist',['leverdata'=>$leverdata]);
	}
	//删除
	public function actionDel(){
		$id = yii::$app->request->get();
		$id = $id['id'];

		$db = yii::$app->db;
		$sql = "delete from viprank where rank_id=".$id;
		$deldata = $db->createCommand($sql)->execute();
		if ($deldata) {
			$sql = "select * from viprank";
			$leverdata = $db->createCommand($sql)->queryAll();
			return $this->renderPartial('ranklist',['leverdata'=>$leverdata]);
		}
	}

}
?>