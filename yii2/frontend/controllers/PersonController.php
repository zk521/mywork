<?php
namespace frontend\controllers;

//使用核心控制器
use yii\web\Controller;
use yii\web\Tel;
use yii\web\Session;
//使用数据库
use db;
//使用核心组件
use yii;

/**
 * Site controller
 */
class PersonController extends CommonController
{
	public $enableCsrfValidation = false;

	//展示主题
	public function actionInfo()
	{
		$user_id  = Yii::$app->session->get('root');
		$id = isset($user_id) ? $user_id : 1 ;

		//查询数据
		$result = yii::$app->db->createCommand("SELECT * FROM bussiness WHERE user_id='$id'")->queryOne();

		return $this->renderPartial('personinfo.php', ['info'=>$result]);
	}

	//修改信息
	public function actionUpda()
	{
		$id = yii::$app->request->get('id');

		//查询数据
		$result = yii::$app->db->createCommand("SELECT * FROM bussiness WHERE id='$id'")->queryOne();

		//查询地区
		$region = yii::$app->db->createCommand("SELECT * FROM region WHERE parent_id=1")->queryAll();

		return $this->renderPartial('personupda.php', ['info'=>$result, 'add'=>$region]);
	}

	//地区联动
	public function actionRegion()
	{
		$region_id=yii::$app->request->post('region_id');
		if($region_id == 0) {
			// $data = yii::$app->db->createCommand("SELECT * FROM region WHERE parent_id=1")->queryAll();
			$data = '';
		} else {
	    	$sql="select * from region where parent_id='$region_id'";
	    	$db=yii::$app->db;
	    	$data=$db->createCommand($sql)->queryAll();
		}

        echo json_encode($data);
	}

	//修改sql
	public function actionUpdasql()
	{
		$id=yii::$app->request->post('id');
		$shopname=yii::$app->request->post('shopname');
		$sort_order=yii::$app->request->post('sort_order');
		$b_address=yii::$app->request->post('b_address');
		$tel=yii::$app->request->post('tel');

		$bl_up = yii::$app->db->createCommand("UPDATE bussiness SET shopname='$shopname',type='$sort_order',tel='$tel', b_address='$b_address' WHERE id='$id' ")->execute();
		if($bl_up) {
			echo 1;
		}
	}
}