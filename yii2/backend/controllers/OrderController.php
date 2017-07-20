<?php
namespace backend\controllers;

//使用核心控制器
use yii\web\Controller;
use yii\web\Session;
//使用数据库
use db;
//使用核心组件
use yii;
//使用model层
use backend\models\Bussiness;
use backend\models\OrderInfo;
use backend\models\User;
use yii\data\Pagination;
use yii\db\Query;

/**
 * Site controller
 */
class OrderController extends Controller
{
	public $enableCsrfValidation = false;

	//展示主题
	public function actionIndex()
	{
		//商家信息
		$sql = "select id,b_name from bussiness order by id";
		$buss =  yii::$app->db->createCommand($sql)->queryAll();
  		
  		//订单详情
  		$arr = $this->orderInfo();
		return $this->renderPartial('appointment.php', ['buss'=>$buss, 'orderInfo'=>$arr['orderInfo'], 'pagination' => $arr['pagination'] ]);
	}

	/**
	 * search 搜索
	 */
	public function actionSearch(){
		$data = yii::$app->request->post();
		$where = '1=1 '; 
		if(!empty($data['start_time'])){
			$where .= ' and `add_time` >=' . strtotime($data['start_time']);
			unset($data['start_time']);
		}
		if(!empty($data['stop_time'])){
			$where .= '  and  `add_time` <= ' . strtotime($data['stop_time']);
			unset($data['stop_time']);
		}
		if(!empty($data['order_sn'])){
			$order_sn = trim($data["order_sn"]);
			$where .= '  and  `order_sn` like "%'.$order_sn.'%"';
			unset($data['order_sn']);
		}
		$where .= $this->formatUpdate($data);
		$arr = $this->orderInfo($where);
		$success = '查询成功';
		$error = '暂无数据';
		if(empty($arr['orderInfo'])){
			echo json_encode(['status'=>0, 'msg'=>$error]);
		}else{
			echo json_encode(['status'=>1, 'msg'=>$success, 'orderInfo'=>$arr['orderInfo'], 'pagination' => $arr['pagination'] ]);
		}
	}

	/**
	 * 删除
	 */
	public function actionDelete(){
		$id = yii::$app->request->get('id');
		$arr = Yii::$app->db->createCommand()->delete('order_info', 'id = '.$id)->execute();
		if($arr){
			echo 1;
		}
	}

	/**
	 * 批量删除
	 */
	public function actionDel(){
		$data = yii::$app->request->post();
		$ids = $data['ids'];
		$ids = rtrim($ids, ',');
		$sql = "DELETE from order_info where id in ($ids)";
       	$arr = yii::$app->db->createCommand($sql)->execute();
       	if($arr){
       		echo 1;
       	}
	}

	/**
	 * details 详情
	 */
	public function actionDetails(){
		$order_info_id = yii::$app->request->post('order_info_id');
		$arr = yii::$app->db->createcommand("select * from {{order_goods}} where order_info_id=:id", [':id' => $order_info_id])->queryOne();
		$success = '查询成功';
		$error = '暂无数据';
		if(empty($arr)){
			echo json_encode(['status'=>0, 'msg'=>$error]);
		}else{
			echo json_encode(['status'=>1, 'msg'=>$success, 'arr'=>$arr]);
		}
	}

	/**
	 * update 修改
	 */
	public function actionUpdate(){
		$id = yii::$app->request->post('id');
		$stype = yii::$app->request->post('index');
		$status = yii::$app->request->post('new_status');
		$sql = "UPDATE order_info SET `$stype` = '$status' WHERE `id` = '$id'";
		$arr = yii::$app->db->createCommand($sql)->execute();
		if($arr){
			echo 1;
		}else{
			echo 0;
		}
	}
#------------------------------------------------------------------------------------------#
	//拼接where
	public function formatUpdate($data)
    {
		foreach ($data as $key => $value) {
			if(empty($value)){
				unset($data[$key]);
			}	
		}
        $fields = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s` = '%s'", $key, $value);
        }
        $where =' ';
        if(!empty($fields)){
	        $where .= ' and '.implode(' and ', $fields);
        }
        return $where;
    }

    //查询订单详情表
    public function orderInfo($where= '1=1 ', $table='order_info'){
    	//调取分页
    	$arr = $this->limit($where, $table);
    	$orderInfo = $arr['data'];
		foreach ($orderInfo as $key => $value) {
			//收件人电话
			$sql = "select tel from user where id = ". $value['user_id'];
			$tel = yii::$app->db->createCommand($sql)->queryOne();
			$orderInfo[$key]['tel'] = $tel['tel'];
			//每个订单的来源商家
			$sql = "select b_name from Bussiness where id = ". $value['bussiness_id'];
			$Bussiness = yii::$app->db->createCommand($sql)->queryOne();
			$orderInfo[$key]['Bussiness'] = $Bussiness['b_name'];
			//收件人地址
			$sql = "select region_name from region where id in (".$value['country'].",".$value['province'].",".$value['city'].")";
			$path = yii::$app->db->createCommand($sql)->queryAll();
			$orderInfo[$key]['path'] = $path[0]['region_name'].$path[1]['region_name'].$path[2]['region_name'];
		}
		$row=['orderInfo'=>$orderInfo, 'pagination' => $arr['pagination']];
		return $row;
    }

    /**
     * 分页
     */
    public function limit($where, $table){
        $query = new Query();
        //查询出所有的数据
        $orderInfo = $query->from($table)->where($where)->all();

        //统计数据个数
        $count = count($orderInfo);

        //实例化分页类
        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>5]);

        $data = $query->where($where)->offset($pagination->offset)->limit($pagination->limit)->all();
        // print_r($pagination);

        $arr = ['data' => $data, 'pagination' => $pagination];
        return $arr;
    }
}