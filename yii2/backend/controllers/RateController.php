<?php
namespace backend\controllers;

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
class RateController extends Controller
{
	public $enableCsrfValidation = false;

	//展示主题
	public function actionSet()
	{
		//查看数据库
		$result = yii::$app->db->createCommand("SELECT * FROM rate")->queryAll();

		return $this->renderPartial('rate.php', ['arr'=>$result]);
	}

	//添加利率
	public function  actionAdd()
	{
		return $this->renderPartial('rateadd.php');
	}

	//查询返利表中是否有数据
	public function actionIsrate()
	{
		$result = yii::$app->db->createCommand("SELECT * FROM rate")->queryAll();
		if(empty($result)) {
			echo 2;
		} else {
			echo 1;
		}
	}

	//入库
	public function actionAddsql()
	{
		$rate_str = yii::$app->request->post('rate');
		$rate = explode(',', $rate_str);

		$result = yii::$app->db->createCommand("SELECT * FROM rate")->queryAll();
		if(empty($result)) {
			for($i=0; $i<count($rate); $i++) {
				$bloon = yii::$app->db->createCommand("INSERT INTO rate(r_id,rate) VALUES(NULL, '$rate[$i]')")->execute();
			}
			if($bloon) {
				echo 1;
			}
		} else {
			$truncate = yii::$app->db->createCommand("TRUNCATE rate")->execute();
			if($truncate == 0) {
				for($i=0; $i<count($rate); $i++) {
					$bloon = yii::$app->db->createCommand("INSERT INTO rate(r_id,rate) VALUES(NULL, '$rate[$i]')")->execute();
				}
				if($bloon) {
					echo 1;
				}
			}
		}
	}
}