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
class BussinessController extends CommonController
{
	public $enableCsrfValidation = false;

	//商家管理----
	public function actionBussiness()
	{
        $sql="select * from bussiness inner join qq_region on bussiness.b_address=qq_region.region_id";
        
        $db=yii::$app->db;
        $data=$db->createCommand($sql)->queryAll();
     
        return $this->renderPartial('bussiness.php',['data'=>$data]);
	} 


	//商家管理添加
	public function actionBussiness_add()
	{
		return $this->renderPartial('bussiness_add');
	}


	//地址管理
	public function actionGet_region()
   {
     $region_id=yii::$app->request->get('region_id');

     $sql="select * from qq_region where parent_id='$region_id'";
     $db=yii::$app->db;
     $data=$db->createCommand($sql)->queryAll();
     
     // print_r($arr);
     if(!empty($data)){
            echo json_encode($data);
        }

   }


   //添加商家入库
   public function actionAdd_pro()
   {
   	   $data=yii::$app->request->post();
   	   $data['b_address']=implode(',',$data['region']);

       unset($data['region']);
       

        
         
         $res=Yii::$app->db->createCommand()->insert('bussiness',$data)->execute();

       // 
       if ($res) {
       	   echo "<script>alert('添加成功');location.href='index.php?r=bussiness/bussiness'</script>";
       }
   	   
   }
}