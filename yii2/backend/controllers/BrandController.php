<?php
namespace backend\controllers;

//使用核心控制器
use backend\models\Upload;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\Session;
//使用数据库
use db;
//使用核心组件
use yii;

/**
 * Site controller
 */
class BrandController extends Controller
{
    public $enableCsrfValidation = false;


    //品牌管理
    public function actionBrand()
    {
        $sql = 'select * from brand';
        $data = yii::$app->db->createCommand($sql)->queryAll();
        return $this->renderPartial('brand.php',['arr'=>$data]);
    }

    //品牌添加页面
    public function actionBrand_add()
    {
        return $this->renderPartial('brand_add.php');
    }

    //品牌添加
    public function actionAdd_brand()
    {
        if(yii::$app->request->isPost){
            $upload = new Upload();
            $data = yii::$app->request->post();
            $upload->file = UploadedFile::getInstanceByName('file');
            if($upload->file && $upload->validate()){
                $upload->file->saveAs('uploads/' . $upload->file->baseName . '.' . $upload->file->extension);
            }
            $data['brand_logo'] ='uploads/' . $upload->file->baseName . '.' . $upload->file->extension;
            $bool = Yii::$app->db->createCommand()->insert('brand',$data)->execute();
            if($bool){
                echo '<script language="javascript">
                        var con;
                        con=confirm("是否继续添加?");
                        if(con==true){
                        location.href="index.php?r=brand/brand_add"
                        } else{
                        location.href="index.php?r=brand/brand"
                        } ;
                        </script>';
            }
        }
    }

    //品牌修改
    public function actionBrand_edit()
    {
        echo yii::$app->request->get('id');
//        return $this->renderPartial('brand_edit.php');
    }
}