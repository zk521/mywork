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
use yii\db\Query;

class CommonController extends Controller
{
	public $enableCsrfValidation = false;
	public function beforeAction($action){
		$db = yii::$app->db;
        $root_id  = Yii::$app->session->get('root');
        $username=yii::$app->session->get('username');

        //判断是否有登录session
        if(!isset($root_id)){
            echo "<script>alert('请先登录');location.href='index.php?r=login/index'</script>";die;
        }   
        //判断权限
        $ctl=Yii::$app->controller->id;     //获取当前访问的控制器

        $action=Yii::$app->controller->action->id;     //获取当前访问的方法
        $aa = $ctl.','.$action;
        $bb=['index,index','index,main','index,head'];
        //当访问后台是首页权限是公共的
        if(in_array($aa,$bb)){
            return true;
        }else{
            //设置超级管理员
            $query = new Query();
            $data = $query
                ->select('r.role_name,n.controller,n.action')
                ->from('admin')
                ->join('LEFT JOIN','premission p_a','p_a.admin_id=admin.id')
                ->join('LEFT JOIN','role r','r.id=p_a.role_id')
                ->join('LEFT JOIN','privillage p_n','p_n.role_id=r.id')
                ->join('LEFT JOIN','node n','n.id=p_n.node_id')
                ->where('admin.id='.$root_id)
                ->all();
            $role=[];
            $c_a =[];
            foreach ($data as $key => $value) {
                $role[] = $value['role_name'];
                $c_a[] = $value['controller'].','.$value['action'];
            }
            if(in_array("超级管理员", $role)){
                return true;
            }else if(in_array($aa, $c_a)){
                return true;
            }else{
                echo "<script>alert('抱歉，您的权限不够');location.href='index.php?r=index/main'</script>";
            }
        }
        if (!parent::beforeAction($action)) {
            return false;
        }
        return true;
    }
}



