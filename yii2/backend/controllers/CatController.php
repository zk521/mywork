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
class CatController extends Controller
{
    public $enableCsrfValidation = false;


    //商品分类管理页面
    public function actionCat()
    {
        $sql = 'select * from category';
        $data = yii::$app->db->createCommand($sql)->queryAll();
        $arr = $this->Infinite($data);
        foreach($arr as $k=>$v){
            $arr[$k]['kong'] = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$v['lever']);
        }
        return $this->renderPartial('cat.php',['arr'=>$arr]);
    }

    //无限极
    private function Infinite($data,$num=0,$lever=0){
        static $tree  = array();
        foreach($data as $k=>$v){
            if($v['parent_id']==$num){
                $v['lever'] = $lever;
                $tree[]=$v;
                $this->Infinite($data,$v['id'],$lever+1);
            }
        }
        return $tree;
    }

    //商品添加分类页面
    public function actionCat_add()
    {
        $sql = 'select * from category';
        $data = yii::$app->db->createCommand($sql)->queryAll();
        $arr = $this->Infinite($data);
        foreach($arr as $k=>$v){
            $arr[$k]['kong'] = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$v['lever']);
        }
        return $this->renderPartial('cat_add.php',['arr'=>$arr]);
    }

    //商品添加分类
    public function actionAdd_cat()
    {
        if(yii::$app->request->isPost){
            $data = yii::$app->request->post();
            $attr_group = $data['attr_group'];
            unset($data['attr_group']);
            $bool = Yii::$app->db->createCommand()->insert('category',$data)->execute();
            $bool2 = true;
            if(!empty($attr_group)){
                $attr = explode("\n",$attr_group);
                $cat_id =  yii::$app->db->getLastInsertID();
                $attr_name = ['attr_values','cat_attr_id'];
                foreach($attr as $k=>$v){
                    $attrs[$k][] = $v;
                    $attrs[$k][] = $cat_id;
                }
                $bool2 = Yii::$app->db->createCommand()->batchInsert('attribute',$attr_name,$attrs)->execute();
            }
            if($bool&&$bool2){
                echo '<script language="javascript">
                        var con;
                        con=confirm("是否继续添加?");
                        if(con==true){
                        location.href="index.php?r=cat/cat_add"
                        } else{
                        location.href="index.php?r=cat/cat"
                        } ;
                        </script>';
            }else{
                echo '<script>alert("添加失败");location.href="index.php?r=cat/cat"</script>';
            }
        }
    }

    //商品删除分类
    public function actionDel_cat()
    {
        if(yii::$app->request->isPost){
            $id = yii::$app->request->post('id');
            echo $id;
        }
    }

    //商品规格添加
    public function actionCat_attr(){

    }

    //商品修改分类页面
    public function actionCat_edit()
    {
        return $this->renderPartial('cat_add.php');
    }

}
