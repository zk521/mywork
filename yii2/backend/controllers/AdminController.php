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
     /*
          *1,根据传过来的管理员Id查询出拥有的角色 
          *2,如果管理员已经拥有角色 得到已经有的角色名字
          *3，如果管理员没有角色  选择角色名称
          *2，同时将角色表传递过去写成下拉框方便选择
     */
    public function actionPremission(){

         
           $request = YII::$app->request;
           $db = Yii::$app->db;
           $admin_id = Yii::$app->request->get('admin_id');
           $sql="select * from admin inner join premission on admin.id=premission.admin_id where id='$admin_id'";
           $res=yii::$app->db->createCommand($sql)->queryAll();
           if ($res) {
            //查询用户拥有角色
            $arr="";
            foreach ($res as $k => $v) {
                 $arr.=$v['role_id'].',';
            }
            $role_id=rtrim($arr,',');
            $sql1="select * from role where id in ($role_id)"; 
            
            $role=yii::$app->db->createCommand($sql1)->queryAll();
            $data="";
            foreach ($role as $key => $value) {
                $data.=$value['role_name'].',';
            }
            $role_name=rtrim($data,',');
            $role_list=yii::$app->db->createCommand("select * from role")->queryAll();
            return $this->renderPartial('premission.php',['admin_id'=>$admin_id,'role_name'=>$role_name,'role_list'=>$role_list]);
            
           }else{
            $role_list=yii::$app->db->createCommand("select * from role")->queryAll();
            $role_name="暂时未绑定角色";
            return $this->renderPartial('premission.php',['admin_id'=>$admin_id,'role_name'=>$role_name,'role_list'=>$role_list]);
            
           }
            
       
    
    }


    //----------绑定角色添加
    public function  actionPremission_add()
    {
    	
        $db = Yii::$app->db;
        $admin_id =yii::$app->request->post('admin_id');
        
        $id =yii::$app->request->post('id');

        $res=Yii::$app->db->createCommand()->insert('premission',['role_id' =>$id,'admin_id'=>$admin_id])->execute();
        if ($res) {
             echo "<script>alert('添加成功');location.href='index.php?r=admin/privillage&role_id=$id'</script>";
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





    //-------角色赋权
    public   function actionPrivillage()
    {
         $request = yii::$app->request;
         $db = Yii::$app->db;
         $role_id = Yii::$app->request->get('role_id');
         $sql="select * from node";
         $node_list=yii::$app->db->createCommand($sql)->queryAll();
            
    return $this->renderPartial('privillage.php',['node_list'=>$node_list,'role_id'=>$role_id]);
          
            
    }

    //角色赋权添加
    public function actionPrivillage_add()
    {
        
         $request = yii::$app->request;
         $db = Yii::$app->db;
         
         $data =Yii::$app->request->post();

         $controller=implode(',',$data['controller']);
         $action=implode(',',$data['action']);
         $role_id=$data['role_id'];
         $sql="select  * from node where id in($controller) or id in($action)";
         $node=yii::$app->db->createCommand($sql)->queryAll();
         $arr="";
         foreach ($node as $key => $value) {
            
              $arr.="(".$value['id'].",".$role_id."),";
              
             
        }
            $arr=rtrim($arr,',');
            $sql1="insert into privillage(node_id,role_id) values $arr";
            $res=yii::$app->db->createCommand($sql1)->execute();
              if ($res) {
                  echo "<script>alert('添加成功');location.href='index.php?r=admin/role'</script>";
              }
         
         
    }
    


}