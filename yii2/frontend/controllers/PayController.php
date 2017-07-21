<?php
namespace frontend\controllers;

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

 
class PayController extends Controller
{
	public $enableCsrfValidation = false;

	public function actionPay(){
		$sql = 'select * from pay_method';
		$pays = yii::$app->db->createCommand($sql)->queryAll();
		return $this->renderPartial('pay.php',['pays'=>$pays]);
	}

	public function actionPay_add(){
		$info = yii::$app->request->post();
		Yii::$app->db->createCommand()->insert('pay_price',$info)->execute();
		$this->redirect('index.php?r=pay/pay_list');
		
	}

	public function actionPay_list(){
		$info = array();
		$query = new Query();
        $query->select('*')
            ->from('pay_method')
            ->join('right join','pay_price','pay_price.pay_id  = pay_method.pay_id');
           
        $info = $query->createCommand()->queryAll();

		return $this->renderPartial('pay_list.php',['pays'=>$info]);
	}

	public function actionPay_del(){
		$pay_id = yii::$app->request->get('pay_id');
		$id = yii::$app->request->get('id');
		Yii::$app->db->createCommand()->delete('pay_price', 'pay_id = '.$pay_id .' and id ='.$id)->execute();
		$this->redirect('index.php?r=pay/pay_list');
		
	}

	public function actionPay_up(){
		$pay_id = yii::$app->request->get('pay_id');
		$id = yii::$app->request->get('id');

		$query = new Query();
        $query->select('*')
            ->from('pay_method')
            ->join('right join','pay_price','pay_price.pay_id  = pay_method.pay_id')
           	->where('pay_price.pay_id = '.$pay_id .' and pay_price.id ='.$id);
        $info = $query->createCommand()->queryOne();

        $sql = 'select * from pay_method';
		$pays = yii::$app->db->createCommand($sql)->queryAll();
        return $this->renderPartial('pay_up.php',['pays'=>$pays,'info'=>$info]);
	
	}

	public function actionUp_pay(){
		$id = yii::$app->request->post('id');
		$pay_id = yii::$app->request->post('pay_id');
		$pay_price = yii::$app->request->post('pay_price');
		$sql = 'UPDATE pay_price SET pay_price='.$pay_price.',pay_id='.$pay_id.' WHERE id='.$id;

		Yii::$app->db->createCommand($sql)->execute();
		$this->redirect('index.php?r=pay/pay_list');
	}
}
