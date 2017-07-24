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
class CommonController extends Controller
{
	public $enableCsrfValidation = false;
	public function beforeAction($action){
		$db = yii::$app->db;
        $root_id  = Yii::$app->session->get('bad_id');
        
        //判断是否有登录session
        if(!isset($root_id)){
            echo "<script>alert('请先登录');location.href='?r=login/index'</script>";die;
        }
        if (!parent::beforeAction($action)) {
            return false;
        }
        return true;
     }
       

}
