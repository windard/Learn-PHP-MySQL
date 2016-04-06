<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>2016未登峰活动报名</title>
	<style>
		*{
			padding: 0;
			margin:0;
			font-family: "Source Sans Pro","MicroSoft YaHei", Arial, "Helvetica Neue", Helvetica, sans-serif;
			font-size: 16px;
		}
		.content{
			padding: 20px 30px;
			width:900px;
			border:1px solid #ddd;
			border-radius: 6px;
			margin:100px auto;
		}
		table{
			margin: 0 auto 0;
			border-collapse: collapse;
		}
		table tr td,table tr th{
			padding: 5px 10px ;
			border-left:1px solid #ddd;
			border-bottom:1px solid #ddd;
		}
		table tr th{
			border-top:1px solid #ddd;
		}
		table tr th:last-child{
			border-right:1px solid #ddd;
		}
		table tr td:last-child{
			border-right:1px solid #ddd;
		}
	</style>
</head>
<body>
	<div class="content">

	<?php 
	ob_start();
	@session_start();
	$data = "		<form action=\"admin.php\" method=\"post\">
			<label for=\"password\">密码</label>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type=\"password\" name=\"password\" id=\"password\">
			<br>
			<br>
			<input type=\"submit\" value=\"submit\" name=\"submit\">
		</form>";
	$con = new mysqli("localhost","XXX","XXX","user");		
	$con->query("SET NAMES 'utf8'");
	if(isset($_SESSION['admin'])&&$_SESSION['admin']){
		echo "<h1><center>Wlecome Admin</center></h1><br><br>";
		echo "
		<table>
			<caption><strong>报名人数</strong> </caption>
			<thead>
				<tr>
					<th>序号</th>
					<th>姓名</th>
					<th>性别</th>
					<th>年龄</th>
					<th>学校</th>
					<th>学号</th>
					<th>手机</th>
					<th>参赛码</th>
				</tr>
			</thead>
			<tbody>";
			$result = $con->query("SELECT * FROM stu");
			while($row = $result->fetch_array()){
				$id = $row['id'];
				$name = $row['name'];
				$age = $row['age'];
				$sex = $row['sex'];
				$school = $row['school'];
				$stunum = $row['stunum'];
				$phone = $row['phone'];
				$code = $row['code'];
				echo "<tr>
					<td>$id</td>
					<td>$name</td>
					<td>$sex</td>
					<td>$age</td>
					<td>$school</td>
					<td>$stunum</td>
					<td>$phone</td>
					<td>$code</td>
				</tr>";
			}
			echo "
			</tbody>
		</table>";
	}else{
		if(isset($_POST["submit"])){
			$password = mysqli_real_escape_string($con,stripslashes($_POST['password']));
			$res = $con->query("SELECT * FROM admin WHERE password='$password'");
			if($row_cnt = $res->num_rows){
				$_SESSION['admin']=true;
				echo "<h1><center>Wlecome Admin</center></h1><br><br>";
				echo "
				<table>
					<caption><strong>报名人数</strong> </caption>
					<thead>
						<tr>
							<th>序号</th>
							<th>姓名</th>
							<th>性别</th>
							<th>年龄</th>
							<th>学校</th>
							<th>学号</th>
							<th>手机</th>
							<th>参与码</th>
						</tr>
					</thead>
					<tbody>";
					$result = $con->query("SELECT * FROM stu ORDER BY id");
					while($row = $result->fetch_array()){
						$id = $row['id'];
						$name = $row['name'];
						$age = $row['age'];
						$sex = $row['sex'];
						$school = $row['school'];
						$stunum = $row['stunum'];
						$phone = $row['phone'];
						$code = $row['code'];
						echo "<tr>
							<td>$id</td>
							<td>$name</td>
							<td>$sex</td>
							<td>$age</td>
							<td>$school</td>
							<td>$stunum</td>
							<td>$phone</td>
							<td>$code</td>
						</tr>";
					}
				echo "
					</tbody>
				</table>
				<br/><br/>
				<a href=\"transform.php\" target=\"_blank\">保存为xls</a>
				<br/><br/>
				";			

			}else{
				$password="";
				echo $data;
			}	

		}else{
			echo $data;
		}		
	}

		 ?>
	</div>
		<div style="margin:30px auto 0;text-align:center;color:#0181CA">
			<p>版权归华润雪花啤酒（中国）有限公司</p>
			<p>西安销售分公司所有</p>
		</div>				
</body>
</html>