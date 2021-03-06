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
		$db = yii::$app->db;
		$sql = "select * from vip order by vip_id desc";
		$data = $db->createCommand($sql)->queryAll();
		return $this->renderPartial('vip.php',['data'=>$data]);
	}
	//vip会员添加展示
	public function actionAdd(){
		//将级别查询出来传递到前台
		$db = yii::$app->db;
		$sql = "select * from viprank";
		$leverdata = $db->createCommand($sql)->queryAll();
		return $this->renderPartial('vipadd',['leverdata'=>$leverdata]);
	}
	//@TODO添加页面接值入库
	public function actionAdddata(){
		$data = yii::$app->request->get();
		$time = date('Y-m-d',time());
		$sql = "insert into vip values(null,'$data[email]','$data[lever]','$time','等级积分','$time','最后登录','最后修改','最后ip','$data[parent_id]','$data[alias]','qq','$data[mobile_phone]','$data[is_validated]','最大消费','id1','0')";
		$db = yii::$app->db;
		$lever = $db->createCommand($sql)->execute();
		if ($lever) {
			echo 1;
		}else{
			echo 2;
		}
	}
	//会员列表删除
	public function actionVipdel(){
		$id = yii::$app->request->get();
		$id = $id['id'];

		$db = yii::$app->db;
		$sql = "delete from vip where vip_id=".$id;
		$deldata = $db->createCommand($sql)->execute();
		if ($deldata) {
			$sql = "select * from vip";
			$data = $db->createCommand($sql)->queryAll();
			return $this->renderPartial('vip',['data'=>$data]);
		}
	}

	//修改展示赋值
	public function actionUpdate(){
		$db = yii::$app->db;
		$id = yii::$app->request->get();
		$sql = "select * from vip where vip_id=".$id['id'];
		$update = $db->createCommand($sql)->queryAll();
		$sql = "select * from viprank";
		$leverdata = $db->createCommand($sql)->queryAll();
		return $this->renderPartial('updatelist',['update'=>$update,'leverdata'=>$leverdata]);
	}
	// 修改接值入库
	public function actionUpdateadd(){
		print_r($_SERVER);
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
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	// 会员审核
	public function actionAudit(){
		$vip = yii::$app->request->get();
		$id = $vip['id'];
		$db = yii::$app->db;
		$sql = "update vip set is_audit = 1 where vip_id = ".$id;
		$update = $db->createCommand($sql)->execute();
		if ($update) {
			echo 1;
		}else{
			echo 2;
		}
	}
}
?>