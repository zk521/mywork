<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/7/19
 * Time: 19:07
 */

namespace backend\controllers;
use yii\web\Controller;
use backend\models\Pending;
use db;
use yii;
class PendingController extends Controller
{
    public function actionIndex() {
        $model = new Pending();
        //待回复评论的商品货号
        $num['comment'] = count($model->getComment());
        //待处理订单
        $num['order'] = count($model->pendOrder());
        //待审商品
        $num['goods'] = count($model->pendGoods());
        //待审商家
        $num['bussiness'] = count($model->pendBussiness());
        return $this->renderPartial('pending',['num'=>$num,]);
    }
    public function actionOrder(){
        $model = new Pending();
        $order = $model->pendOrder();
        return $this->renderPartial('getorder',['order'=>$order]);

    }
    public function actionComment(){
        $model = new Pending();
        $comment = $model->getComment();
        return $this->renderPartial('getcomment',['comment'=>$comment]);

    }
    public function actionGoods(){
        $model = new Pending();
        $goods = $model->pendGoods();
        return $this->renderPartial('getgoods',['goods'=>$goods]);

    }
    public function actionBussiness(){
        $model = new Pending();
        $bussiness = $model->pendBussiness();
        return $this->renderPartial('getbuss',['bussiness'=>$bussiness]);

    }
}