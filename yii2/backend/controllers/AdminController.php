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
/**
 * admin controller
 * 管理员控制器
 */
class AdminController extends CommonController
{
	public $enableCsrfValidation = false;

	//网站管理-----管理员管理列表
    
    public function actionAdmin()
    {
    	$db = yii::$app->db;
        $result = $db->createCommand("select id,username from admin")->queryAll();
    	return $this->renderPartial('user.php',['result'=>$result]);
    }

    //-----------管理员添加
    public function   actionAdd()
    {
        $username = yii::$app->request->get('username');
		$pwd = yii::$app->request->get('pwd');
	    $db = yii::$app->db;
        $result = $db->createCommand("insert into admin(username,pwd) values('$username','$pwd')")->execute();
        $last_id= Yii::$app->db->getLastInsertID();
        
        if ($result) {
        	echo json_encode(['last_id'=>$last_id,'msg'=>1]);   //添加成功 
        	
        }
		
    }


    //角色管理-----角色列表
    public function actionRole()
    {
        $db = yii::$app->db;
        $result = $db->createCommand("select id,role_name from role")->queryAll();
    	return $this->renderPartial('role.php',['result'=>$result]);
    }

    //--------角色添加
    public   function actionRole_add()
    {
    	$request = YII::$app->request;
        if($request->isPost){
            $role_name=$request->post('role_name');
           
            $role_time=date("Y-m-d H:i:s",time());
            $res=Yii::$app->db->createCommand()->insert('role',['role_name' =>$role_name,'role_time'=>$role_time])->execute();
             $last_id= Yii::$app->db->getLastInsertID();
            if($res){
                echo json_encode(['last_id'=>$last_id,'msg'=>1]);
            }
        }else{
            return $this->renderPartial('role.php');
        }
    
    }


    //--------给用户赋予角色
    public function actionPremission(){
           
        $request = yii::$app->request;
        $db = Yii::$app->db;
        $admin_id = Yii::$app->request->get('admin_id');

            //查询用户拥有角色
            
            $sql1="select * from role"; 
            
            $role=yii::$app->db->createCommand($sql1)->queryAll();
            if ($role) {
            	
            
            	return $this->renderPartial('premission.php',['admin_id'=>$admin_id,'role'=>$role]);
            }
            
    
    }

    public function  actionPremission_add()
    {
    	
        $db = Yii::$app->db;
        $admin_id =yii::$app->request->post('admin_id');
        
        $id =yii::$app->request->post('id');

        $res=Yii::$app->db->createCommand()->insert('premission',['role_id' =>$id,'admin_id'=>$admin_id])->execute();
        if ($res) {
             echo "<script>alert('添加成功');location.href='index.php?r=admin/node_list'</script>";
        }
        
    }


    //权限管理------添加权限 权限列表
    public function actionNode()
    {
         $request = YII::$app->request;
         if($request->isGet){
             $admin_id=yii::$app->request->get('admin_id');
             
         }
             
             $sql1="select * from node"; 
             $node=yii::$app->db->createCommand($sql1)->queryAll();
             return  $this->renderPartial('node.php',['node'=>$node,'admin_id'=>$admin_id]);
        
        
         
    }

    public function actionNode_add()
    {
        $request = YII::$app->request;
        if($request->isPost){
    	 $db = Yii::$app->db;
        $node_name =yii::$app->request->post('node_name');
        $controller =yii::$app->request->post('controller');
        $action =yii::$app->request->post('action');
        $admin_id=yii::$app->request->post('admin_id');

       
    	$res=Yii::$app->db->createCommand()->insert('node',['node_name' =>$node_name,'controller'=>$controller,'action'=>$action])->execute();
         $last_id= Yii::$app->db->getLastInsertID();

        
       
            if($res){
                echo json_encode(['last_id'=>$last_id,'msg'=>1]);
            }
           }

        }



    


}