<?php
namespace backend\controllers;

use yii;
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
		return $this->renderPartial('vipadd.php');
	}


	//会员级别展示
	public function actionRanklist(){
		return $this->renderPartial('ranklist.php');
	}
	//会员级别添加
	public function actionRankadd(){
		return $this->renderPartial('rankadd.php');
	}
}
?>