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
use backend\models\Uploadbanner;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class BannerController extends Controller
{
	public $enableCsrfValidation = false;

	//展示主题
	public function actionShow()
	{
		$result = yii::$app->db->createCommand("SELECT * FROM advertice AS a INNER JOIN advertice_img AS i ON a.id=i.advertice_id")->queryAll();

		return $this->renderPartial('banner.php', ['img'=>$result]);
	}

	//添加广告
	public function actionAdd()
	{
		//地区
		$region = yii::$app->db->createCommand("SELECT * FROM region WHERE parent_id=1")->queryAll();

		$m = new Uploadbanner();

		return $this->renderPartial('banneradd.php', ['region'=>$region, 'model'=>$m]);
	}

	//文件上传
	public function actionAddsql()
	{
		$data = yii::$app->request->post();
		$data['addtime'] = date('Y-m-d H:i:s');

		$model = new Uploadbanner();
        $file = $model->file = UploadedFile::getInstance($model, 'file');

        $bl_upld = $model->upload();
        if($bl_upld) {
        	$db = yii::$app->db;
        	$url = 'ad_img/'.$model['file']->name;

        	$bl_adver = $db->createCommand("INSERT INTO advertice(id,ad_name,`desc`,addtime,ad_path,region_id) VALUES(NULL, '$data[ad_name]', '$data[desc]', '$data[addtime]','$data[ad_path]', '$data[region_id]')")->execute();
        	if($bl_adver) {
        		$id = $db->getLastInsertId();
	        	$bl_adim = $db->createCommand("INSERT INTO advertice_img(id,m_path,advertice_id) VALUES(NULL, '$url', '$id')")->execute();
	        	if($bl_adver) {
	        		return $this->redirect('?r=banner/show');
	        	}
        	}
        }

	}

	//删除广告
	public function actionDel()
	{
		$id = yii::$app->request->post('id');

		$db = yii::$app->db;
		$bl_img = $db->createCommand("DELETE FROM advertice_img WHERE advertice_id='$id'")->execute();
		if($bl_img) {
			$bl_ad = $db->createCommand("DELETE FROM advertice WHERE id='$id'")->execute();
			if($bl_ad) {
				echo "1";
			}
		}
	}

	//修改页面
	public function actionUpdaview()
	{
		//地区
		$region = yii::$app->db->createCommand("SELECT * FROM region WHERE parent_id=1")->queryAll();

		//内容
		$id = yii::$app->request->get('id');
		$result = yii::$app->db->createCommand("SELECT * FROM advertice AS a INNER JOIN advertice_img AS i ON a.id=i.advertice_id WHERE a.id='$id'")->queryOne();

		$m = new Uploadbanner();

		return $this->renderPartial('bannerupd.php', ['img'=>$result, 'region'=>$region, 'model'=>$m]);
	}

	//修改
	public function actionUpdasql()
	{
		$data = yii::$app->request->post();
		$data['addtime'] = date('Y-m-d H:i:s');

		$model = new Uploadbanner();
        $file = $model->file = UploadedFile::getInstance($model, 'file');

        if(empty($file)) {
	        $bl_adver = yii::$app->db->createCommand("UPDATE advertice SET ad_name = '$data[ad_name]', `desc`='$data[desc]', addtime='$data[addtime]', ad_path='$data[ad_path]', region_id='$data[region_id]' WHERE id='$data[id]'")->execute();
	        if($bl_adver) {
	        	return $this->redirect('?r=banner/show');
	        }
        } else {
        	//原图片
        	$file = $data['img']; 

        	$bl_upld = $model->upload($file);
	        if($bl_upld) {
	        	$db = yii::$app->db;
	        	$url = 'ad_img/'.$model['file']->name;
	        	$bl_adver = $db->createCommand("UPDATE advertice SET ad_name = '$data[ad_name]', `desc`='$data[desc]', addtime='$data[addtime]', ad_path='$data[ad_path]', region_id='$data[region_id]' WHERE id='$data[id]'")->execute();
		        if($bl_adver) {
		        	$bl_adim = $db->createCommand("UPDATE advertice_img SET m_path='$url' WHERE advertice_id='$data[id]'")->execute();
		        	if($bl_adim) {
		        		return $this->redirect('?r=banner/show');
		        	}
		        }
	        }
        }
	}
}