<?php
namespace backend\controllers;

use yii;
use db;
use yii\web\controller;
use backend\models\Bussiness;
use yii\db\Query;
use yii\data\Pagination;

class MoneyController extends controller
{
	public $enableCsrfValidation = false;
	public function actionIndex(){
		//查询商家
		$sql = "select id,b_name from bussiness order by id";
		$buss =  yii::$app->db->createCommand($sql)->queryAll();
        //查询商家提现情况
        $arr = $this->orderInfo();
        $data = $arr['data'];
        $pagination = $arr['pagination'];
		return $this->renderPartial('index',['buss'=>$buss,'money'=>$data, 'pagination' => $pagination]);
	}
	//修改状态
	public function actionStatus(){
		$data = yii::$app->request->post();
		$money = $data['money'];
		$new_money = $money * 0.99;
		if($data['account_status'] == 1){
			$account_status = 2;
		}else{
			$account_status = 1;
		}
		$sql = "update  money set account_status='{$account_status}' where m_id='{$data['id']}'";
		$arr = yii::$app->db->createCommand($sql)->execute();
		if($arr){
			echo 1;
		}else{
			echo 0;
		}
	}

	//搜索
	public function actionSearch(){
		$data = yii::$app->request->post();
		foreach ($data as $key => $value) {
			if(empty($value)){
				unset($data[$key]);
			}	
		}
		$where = '1=1 '; 
		if(!empty($data['start_time'])){
			$where .= ' and `m_time` >=' . strtotime($data['start_time']);
		}
		if(!empty($data['stop_time'])){
			$where .= '  and  `m_time` <= ' . strtotime($data['stop_time']);
		}
		if(!empty($data['bussiness_id'])){
			$where .= '  and  `u_name` = '.$data['bussiness_id'];
		}
		$arr = $this->orderInfo($where);
		$success = '查询成功';
		$error = '暂无数据';
		if(empty($arr['data'])){
			echo json_encode(['status'=>0, 'msg'=>$error]);
		}else{
			$data = $arr['data'];
        	$pagination = $arr['pagination'];
			echo json_encode(['status'=>1, 'msg'=>$success, 'money'=>$data, 'pagination' => $pagination]);
		}
	}

##################################################################################################################################
	public function orderInfo($where= '1=1 ', $table='money'){
		$query = new Query();
    	$money = $query->from($table)->where($where)->all();
    	 //统计数据个数
        $count = count($money);
        $pagination = new Pagination([
            "defaultPageSize"=>10,
            "totalCount"=>$query->count(),
        ]);
        $data = $query
        	->join('LEFT JOIN','bussiness b','b.id=money.u_name')
        	->orderBy('account_status')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $arr = ['pagination'=>$pagination,'data'=>$data];
        return 	$arr;
	}
}