<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/7/19
 * Time: 19:55
 */

namespace backend\models;


use yii\base\Model;
use yii;
use db;
class Pending extends Model
{
    //待回复评论
    public function getComment(){
        $db = yii::$app->db;
        $res = $this->getStatus('goods_id','comment','parent_id');
        $str = '';
        foreach($res as $k=>$v){
            $str.=','.$v['goods_id'];
        }
        $str = ltrim($str,',');
        //待回复评论的商品货号
        $sq = 'select goods_sn from goods where id in ('.$str.')';
       return $re = $db->createCommand($sq)->queryAll();
    }
    //待处理订单
    public function pendOrder(){
    return $this->getStatus('order_sn','order_info','shipping_status');

    }
    //待审商品
    public function pendGoods(){
      return  $this->getStatus('goods_sn','goods','is_reviewed');
    }
    //待审商家
    public function pendBussiness() {
        return  $this->getStatus('b_name','bussiness','is_audit');
    }
    //查询状态方法
    public function getStatus($feild,$table,$status) {
        $db=yii::$app->db;
        $sql = 'select '.$feild.' from '.$table.' where '.$status.' =0';
        return $res = $db->createCommand($sql)->queryAll();
    }
}