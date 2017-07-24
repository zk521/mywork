<!DOCTYPE html>
<html lang="en">
<head>
	<title>个人信息</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="styles/general.css" rel="stylesheet" type="text/css" />
	<link href="styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<center>
	<h3>个人信息</h3>
	<hr>
	<table>
		<tr>
			<td>真实姓名：</td>
			<td><?=$info['b_name']?></td>
		</tr>
		<tr>
			<td>联系方式：</td>
			<td><?=$info['tel']?></td>
		</tr>
		<tr>
			<td>证件号：</td>
			<td><?=$info['id_number']?></td>
		</tr>
		<tr>
			<td>居住地：</td>
			<td><?=$info['b_address']?></td>
		</tr>
		<tr>
			<td>店铺名称：</td>
			<td><?=$info['shopname']?></td>
		</tr>
		<tr>
			<td>店铺主卖：</td>
			<td><?=$info['type']?></td>
		</tr>
		<tr>
			<td>身份证照片：</td>
			<td><a target="_bland" href="<?=$info['id_img']?>"><img title="点击查看原图" height=150 src="<?=$info['id_img']?>" alt=""></a></td>
		</tr>
	</table>
	<a style="margin-left:250px;" href="?r=person/upda&id=<?=$info['id']?>">修改信息</a>
</center>
</body>
</html>