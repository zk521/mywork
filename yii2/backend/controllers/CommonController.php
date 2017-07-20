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
class CommonController extends Controller
{
	public $enableCsrfValidation = false;
	public function beforeAction($action){
		$db = yii::$app->db;
        $root_id  = Yii::$app->session->get('root');
        $username=yii::$app->session->get('username');
        //判断是否有登录session
        if(!isset($root_id)){
            echo "<script>alert('请先登录');location.href='index.php?r=login/log'</script>";die;
        }
        //设置超级管理员
        if($username=="周可"){
            return true;
        }
        //判断权限
        $ctl=Yii::$app->controller->id;     //获取当前访问的控制器

        $action=Yii::$app->controller->action->id;     //获取当前访问的方法
        
        //当访问后台是首页权限是公共的
        if($ctl=="index" && $action=="index"){
            return true;
        }
        $root_id  = Yii::$app->session->get('root');       //接到用户登录时存的id
        $sql="select role_id from premission where admin_id= $root_id";
            $role_id = $db->createCommand($sql)->queryOne();
            $role_id=$role_id['role_id'];
            $sql1="select node_id from privillage where role_id= '$role_id'";
            $node_id = $db->createCommand($sql1)->queryOne();
            $node_id=$node_id['node_id'];

            $sql2="select controller,action from node where id='$node_id'";
            $res=$db->createCommand($sql2)->queryAll();//查询出该角色的权限
        if($res){
            foreach($res as $key => $val){
                if($val['controller']==$ctl && $val['action']==$action){
                    return true;
                }
             }
            echo "<script>alert('抱歉，您的权限不够');location.href='index.php?r=index/index'</script>";
            return false;
        }
        else{
            echo "<script>alert('抱歉，您的权限不够');location.href='index.php?r=index/index'</script>";
        }
        

        if (!parent::beforeAction($action)) {
            return false;
        }
        return true;
    }
}



