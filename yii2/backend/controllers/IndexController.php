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
}