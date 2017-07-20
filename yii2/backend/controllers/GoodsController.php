<?php
namespace backend\controllers;

//使用核心控制器
use yii\web\Controller;
use yii\web\Tel;
use yii\web\Session;
use yii\web\UploadedFile;
use backend\models\Upload;
use yii\db\Query;
//使用数据库
use db;
//使用核心组件
use yii;

/**
 * Site controller
 */
class GoodsController extends Controller
{
    public $enableCsrfValidation = false;


    public function actionGoods2(){
        return $this->renderPartial('goods_info.php');
    }
    //无限极下拉
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




    //商品管理
    public function actionGoods()
    {
        $sql = 'select * from goods';
        $goods = yii::$app->db->createCommand($sql)->queryAll();
        $sql = 'select * from brand';
        $brand = yii::$app->db->createCommand($sql)->queryAll();
        $sql = 'select * from category';
        $cat = yii::$app->db->createCommand($sql)->queryAll();
        $cats = $this->Infinite($cat);
        foreach($cats as $k=>$v){
            $cats[$k]['kong'] = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$v['lever']);
        }
        $sql = "SELECT COUNT(*) as num FROM goods";
        $count = yii::$app->db->createCommand($sql)->queryOne();
        return $this->renderPartial('goods_list.php',['goods'=>$goods,'brand'=>$brand,'cat'=>$cats,'num'=>$count]);
    }

    //商品添加
    public function actionGoods_add()
    {
        $sql = 'select * from category';
        $data = yii::$app->db->createCommand($sql)->queryAll();
        $cat = $this->Infinite($data);

        $sql2 = 'select * from brand';
        $brand = yii::$app->db->createCommand($sql2)->queryAll();

        foreach($cat as $k=>$v){
            $cat[$k]['kong'] = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$v['lever']);
        }

        return $this->renderPartial('goods_add.php',['cat'=>$cat,'brand'=>$brand]);
    }

    //获取商品属性
    public function actionAttr_show(){
        $id = yii::$app->request->post('id');

        $sql = 'select * from attribute where cat_attr_id = '.$id;
        $attr1 = yii::$app->db->createCommand($sql)->queryAll();
        $sql2 = 'select * from attribute where cat_attr_id = (select parent_id from category where id = '.$id.')';
        $attr2 = yii::$app->db->createCommand($sql2)->queryAll();
        $attr = array_merge($attr1,$attr2);
        echo json_encode($attr);
    }

    //添加商品
    public function actionAdd_goods()
    {
        $upload = new Upload();
        $info = yii::$app->request->post();
        $img_id = '';

        //单文件上传
        $upload->file = UploadedFile::getInstanceByName('goods_img');
        if($upload->file && $upload->validate()){
            $upload->file->saveAs('uploads/' . $upload->file->baseName . '.' . $upload->file->extension);
        }

        $goods['goods_img'] ='uploads/' . $upload->file->baseName . '.' . $upload->file->extension;
        $goods['goods_name'] = $info['goods_name'];
        $goods['goods_sn'] = $info['goods_sn'];
        $goods['category_id'] = $info['cat_id'];
        $goods['brand_id'] = $info['brand_id'];
        $goods['goods_price'] = $info['shop_price'];
        $goods['is_on_sale'] = $info['is_on_sale'];
        $goods['goods_number'] = $info['goods_number'];
        $goods['goods_desc'] = htmlspecialchars($info['goods_desc']);
        Yii::$app->db->createCommand()->insert('goods',$goods)->execute();
        $goods_id = yii::$app->db->getLastInsertID();

        //多文件上传
        foreach($_FILES['img_url'] as $k=>$v){
            foreach($v as $k1=>$v1){
                $imgs[$k1][$k] = $v1;
            }
        }

        foreach($imgs as $k=>$v){
            $img['m_path'] = "uploads/" . $v["name"];
            $img['goods_id'] = $goods_id;
            $img['img_desc'] = $info['img_desc'][$k];
            Yii::$app->db->createCommand()->insert('images',$img)->execute();
            $img_id .= ','.yii::$app->db->getLastInsertID();
            move_uploaded_file($v["tmp_name"], "uploads/" . $v["name"]);
        }
        $img_id = substr($img_id,1);
        Yii::$app->db->createCommand()->update('goods', ['images_id' => $img_id], 'id = '.$goods_id)->execute();


        $attr['id'] = $info['attr_value_id'];
        $attr['values'] = $info['attr_value_list'];
        foreach($attr as $k=>$v){
            foreach($v as $k1=>$v1){
                $attrs[$k1][$k] = $v1;
                $attrs[$k1]['goods_id'] = $goods_id;
            }
        }
        $attr_name = ['attr_id','goods_id','attr_values'];

        $re = Yii::$app->db->createCommand()->batchInsert('goods_attr',$attr_name,$attrs)->execute();

        if($re){
            $this->redirect('index.php?r=goods/goods');
        }
    }

    //商品修改
    public function actionGoods_sku()
    {
        $goods_id = yii::$app->request->get('id');
        $query = new Query();
        $query->select([
            'category.id AS cat_id'])
            ->from('goods')
            ->join('left join','category','category.id  = goods.category_id')
            ->where('goods.id='.$goods_id);
        $info = $query->createCommand()->queryOne();
        $sql = 'select * from attribute where cat_attr_id = '.$info['cat_id'];
        $data = yii::$app->db->createCommand($sql)->queryAll();
        return $this->renderPartial('goods_sku.php',['data'=>$data,'goods_id'=>$goods_id]);
    }

    //商品规格值展示
    public function actionAttrshow()
    {
        $attr_id = yii::$app->request->post('attr_id');
        $goods_id = yii::$app->request->post('goods_id');
        $sql = 'select * from goods_attr where attr_id='.$attr_id .' and goods_id = '.$goods_id;
//        echo $sql;die;
        $data = yii::$app->db->createCommand($sql)->queryOne();
        $data['attr_values'] = explode('，',$data['attr_values']);
        echo json_encode($data);
    }

    //接收规格值
    public function actionAdd_sku(){

        $info = yii::$app->request->post('info');
        $info = substr($info,1);
        $info = explode('|',$info);
        foreach($info as $k=>$v){
            $info_sku[] =explode('-',$v);
        }
        foreach($info_sku as $kk=>$vv){
            $data[$vv[0]][]  = $vv[1];
        }
        foreach($data as $k=>$v){
            $datas[] = $v;
        }

        $arr = $this->sku($datas);
        echo json_encode($arr);
    }
    //生成sku
    private function sku($data){
        $arr = array();
        foreach($data[0] as $k=>$v){
            $arr[] = array($v);
        }
        for($i=1;$i<count($data);$i++){
            $arr2 = array();
            foreach($arr as $k1=>$v1){
                foreach($data[$i] as $kk=>$vv){
                    $info = $v1;
                    $info[] = $vv;
                    $arr2[] = $info;
                }
            }
            $arr = $arr2;
        }
        return $arr;
    }

    //sku入库
    public function actionSku_add(){
        $data = yii::$app->request->post();
        foreach($data as $k=>$v){
            foreach($v as $k1=>$v1){
                $arr[$k1][$k] = $v1;
            }
        }
        foreach($arr as $k=>$v){
            $arr[$k]['product_sn'] = $this->sn($v['product_sn']);
        }
        $name = ['goods_id','product_sn','attr_list_value','goods_price','store_num'];

        $re = Yii::$app->db->createCommand()->batchInsert('products',$name,$arr)->execute();
        if($re){
          $this->redirect('index.php?r=goods/goods');
        }
    }

    private function sn($product_sn){
        if(empty($product_sn)){
            $product_sn = '03C'.time().ceil(rand(1000,9999));
        }
        $sql = "SELECT product_sn FROM products WHERE product_sn='$product_sn'";
        $bool = Yii::$app->db->createCommand($sql)->queryOne();
        if($bool){
            $product_sn = '03C'.time().ceil(rand(1000,9999));
            $this->sn($product_sn);
        }
        return $product_sn;
    }

    //删除商品
    public function actionDel_goods(){
        $goods_id = yii::$app->request->post('goods_id');
        $sql = 'select category_id,images_id,goods_img from goods WHERE id ='.$goods_id;
        $data = yii::$app->db->createCommand($sql)->queryOne();
        //删除商品文件
        if (file_exists($data['goods_img'])){
            unlink($data['goods_img']);
        }
        //删除文件相册图片
        $sql = 'select m_path from images where goods_id='.$goods_id;
        $path = yii::$app->db->createCommand($sql)->queryAll();
        foreach($path as $v){
            if (file_exists($v['m_path'])){
                unlink($v['m_path']);
            }
        }

        //删除商品属性
        Yii::$app->db->createCommand()->delete('goods_attr', 'goods_id = '.$goods_id)->execute();
        //删除商品SKU
        Yii::$app->db->createCommand()->delete('products', 'goods_id = '.$goods_id)->execute();
        //删除图片相册图片
        Yii::$app->db->createCommand()->delete('images', 'goods_id = '.$goods_id)->execute();
        //删除商品信息
        Yii::$app->db->createCommand()->delete('goods', 'id = '.$goods_id)->execute();

        echo 1;
    }
    //商品修改
    public function actionGoods_alter()
    {
        return $this->renderPartial('goods_add.php');
    }

    //商品搜索
    public function actionSou(){
        yii::$app->request->post('');
    }

}
