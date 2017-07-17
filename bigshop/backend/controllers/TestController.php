<?php
namespace frontend\controllers;

//使用核心控制器
use yii\web\Controller;
//使用数据库
use db;
//使用核心组件
use yii;

/**
 * Index controller
 */
class BacketballController extends Controller
{
	public $enableCsrfValidation = false;

	static $n_id = 3;

	//展示主题
	public function actionIndex()
	{
		//判断是否为post传值
		if(Yii::$app->request->isPost)
		{
			//接收队伍ID
			$team_id = yii::$app->request->post('team_id');
			$db = yii::$app->db;
			$result = $db->createCommand("select * from backetball where team_id='$team_id'")->queryAll();
			$arr = json_encode($result);
			return $arr;
		}
		else
		{
			$db = yii::$app->db;
			$result = $db->createCommand("select * from b_team")->queryAll();
			$arr_n = $db->createCommand("select * from backetball where is_show=1")->queryAll();
			$num = count($arr_n);
			return $this->render('show', ['arr'=>$result, 'num'=>$num]);
		}
	}

	//修改上场队员状态
	public function actionGopeople()
	{
		//接收队伍ID
		$id = yii::$app->request->post('id');
		$db = yii::$app->db;
		$bloon = $db->createCommand("update backetball set is_show=1 where id in ($id)")->execute();
		if($bloon)
		{
			echo 1;
		}
	}

	//比赛页面
	public function actionMatch()
	{
		$db = yii::$app->db;
		$peo = $db->createCommand("select * from backetball where is_show=1")->queryAll();
		$tem = $db->createCommand("select * from b_team where is_showmatch=1")->queryAll();
		$c_grade = $db->createCommand("select * from backetball")->queryAll();

		$arr = array();
		$grade = array();
		foreach($tem as $k=>$v)
		{
			foreach($peo as $key=>$val)
			{
				if($v['team_id'] == $val['team_id'])
				{
					$arr[$v['team_name']]['people'][] = $val;
				}
			}
			foreach($c_grade as $kk=>$vv)
			{
				if($v['team_id'] == $vv['team_id'])
				{
					$grade[$v['team_name']][] = $vv['grade'];
				}
			}
		}

		foreach($grade as $k=>$v)
		{
			$data[$k] = array_sum($v);
		}

		foreach($arr as $k=>$v)
		{
			foreach($data as $key=>$val)
			{
				if($k == $key)
				{
					$arr[$k]['c_grade'] = $val;
				}
			}
		}
		// echo "<pre>";
		// print_r($arr);die;
		return $this->renderAjax('match', ['arr'=>$arr]);
	}

	//修改个人分数
	public function actionUpgrade()
	{
		//接收分数和球员ID
		$id = yii::$app->request->post('id');
		$grade = yii::$app->request->post('grade');

		$db = yii::$app->db;
		$result = $db->createCommand("select * from backetball where id='$id'")->queryOne();
		$new_grade = $result['grade']+$grade;
		$bloon = $db->createCommand("update backetball set grade='$new_grade' where  id='$id'")->execute();
		if($bloon)
		{
			return 1;
		}
	}

	//换人
	public function actionChange()
	{
		//接收分数和球员ID
		$id = yii::$app->request->post('id');
		$db = yii::$app->db;
		$arr = $db->createCommand("select * from backetball where id='$id'")->queryOne();
		$result = $db->createCommand("select * from backetball where is_show=0 and team_id='$arr[team_id]'")->queryAll();
		$bloon = $db->createCommand("update backetball set is_show=0 where id='$id'")->execute();
		if($bloon)
		{
			return json_encode($result);
		}
	}

	//上人
	public function actionChangeup()
	{
		//接收分数和球员ID
		$id = yii::$app->request->post('id');
		$db = yii::$app->db;
		$bloon = $db->createCommand("update backetball set is_show=1 where id='$id'")->execute();
		if($bloon)
		{
			return 1;
		}
	}
}
?>