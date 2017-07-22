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
class IndexController extends CommonController
{
	public $enableCsrfValidation = false;

	//展示主题
	public function actionIndex()
	{
		return $this->renderPartial('index.php');
	}
	/**
	 * 退出
	 */
	public function actionMain()
	{
		return $this->renderPartial('main.php');
	}

	public function actionHead()
	{
		//提取存入的session值
		$name = yii::$app->session->get('username');

		return $this->renderPartial('head.php', ['username'=>$name]);
	}

	//退出删除session
	public function actionLogout()
	{
		$bloon = yii::$app->session->remove('root');
		if($bloon) {
			return $this->redirect('?r=login/index');
		}
	}
}