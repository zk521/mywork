<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广告-有点</title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/ajaxfileupload.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;广告添加
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTop">
					<span>上传广告</span>
				</div>
				<div class="baBody">
				<?php
					use yii\helpers\Html;
					use yii\widgets\ActiveForm;
				?>
				<?php $form = ActiveForm::begin([
				    'id' => 'login-form',
				    'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
				    'action' => '?r=banner/addsql',
				    'method' =>'post',
				])?>
					<div class="bbD">
						广告名称：<input type="text" name="ad_name" class="input1" />
					</div>
					<div class="bbD">
						链接地址：<input type="text" name="ad_path" class="input1" />
					</div>
					<div class="bbD">
						<!--<input type="file" name="m_path" class="file" />-->
						
						<?= $form->field($model, 'file')->fileInput()->label('上传图片：') ?>

						<!--<a class="bbDDel" href="javascript:;">删除</a>-->
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;地区：<select name="region_id" class="input1">
							<option value="--请选择--">--请选择--</option>
							<?php foreach($region as $k=>$v ) {?>
								<option value="<?=$v['id']?>"><?=$v['region_name']?></option>
							<?php }?>
						</select>
					</div>
					<div class="bbD">
						广告描述：<div class="btext2">
							<textarea name="desc" class="text2"></textarea>
						</div>
					</div>
					<div class="bbD">
						<p class="bbDP">
							<!--<input type="submit" class="btn_ok btn_yes" value="提交">-->
							<?= Html::submitButton('提交', ['class' => 'btn_ok btn_yes']) ?>
							<a class="btn_ok btn_no" href="#">取消</a>
						</p>
					</div>
					
				<?php ActiveForm::end() ?>
				</div>
			</div>

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>