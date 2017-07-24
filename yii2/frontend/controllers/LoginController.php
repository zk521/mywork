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
class LoginController extends Controller
{
	public $enableCsrfValidation = false;

	

    //登录
	public function actionIndex()
	{
		return $this->renderPartial('log.php');
	}


	//判断登录
	public  function actionCheck_login()
	{
		
		$username = yii::$app->request->post('bussiness_name');
		$pwd = yii::$app->request->post('bussiness_pwd');
		$index = yii::$app->request->post('index');
		//通过用户选择的登录方式查库
		$db = yii::$app->db;
		$result = $db->createCommand("select * from bussiness_admin where $index='$username'")->queryOne();
		
		if($result["$index"] == $username)
		{
			if($result['bussiness_pwd'] == $pwd)
			{
				//存用户ID
				Yii::$app->session['bad_id']=$result['bad_id'];
				
				return 1;
			}
			else
			{
				//密码不正确
				return 2;
			}
		}
		
        
	}
}