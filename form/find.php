<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<title>2016年挑战未登峰活动报名</title>
	<link rel="stylesheet" href="css/index.css">
	<script src="js/jquery-2.1.1.min.js"></script>
	<script>
		$(document).ready(function(){
			$("select[name=school]").change(function(){
				if($(this).val()=="09"){
					$(this).after('');
					$(this).hide();
				}
			})
			$("input[type=button]").click(function(){
				name = $("input[name=name]").val();
				if(name==""){
					alert("对不起，姓名不能为空");
				}else{
					if(!name.match("^[\u4e00-\u9fa5]{1,6}$")){
						alert("对不起，姓名必须为六位以内汉字");
					}else{
						stunum = $("input[name=stunum]").val();
						var patt=new RegExp("^[\\d]{11}$");
						if(patt.test(stunum)){
							$("#form").submit();
						}else{
							alert("对不起，手机号必须为11为有效数字");
						}
					}
				}
			})			
		})
	</script>
</head>
<body>
	<div class="content">
		<img src="images/poster.jpg" alt="poster">
<?php 
	ob_start();
	@session_start();
	function isNumber($val) 
	{ 
		if(preg_match('/^[\d]+$/', $val)) 
			return true; 
		return false; 
	} 	
	$data = "	
		<form action=\"find.php\" method=\"post\" id=\"form\">
		<div class=\"center\">
			<label for=\"name\">姓名：</label>
			<input type=\"text\" name=\"name\" id=\"name\" maxlength=\"6\" required>
			<br>
			<label for=\"name\">手机：</label>
			<input type=\"text\" name=\"stunum\" id=\"stunum\" minlength=\"11\" maxlength=\"11\" required>			
			<input type=\"button\" value=\"查询参赛码\">
			<br>
		</div>
	</form>";
	if(isset($_POST["stunum"])){
			$con = new mysqli("localhost","fenchico_admin","admin_2016","fenchico_user");		
			$con->query("SET NAMES 'utf8'");
			$name = mysqli_real_escape_string($con,stripslashes($_POST['name']));
			$stunum = mysqli_real_escape_string($con,stripslashes($_POST['stunum']));
			if($name==""){
				echo "<p style='color:red'>对不起，姓名不能为空。</p>";
				$name = "";
				$stunum = "";
				echo $data;				
			}else{
					$res = $con->query("SELECT * FROM stu WHERE phone='$stunum' AND name='$name'");
					if($row_cnt = $res->num_rows){
						$code = $res->fetch_array();
						$code = $code['code'];
						echo "<br><br><br><p>您的参赛码为$code</p><br><br><br>";
					}else{
						echo "<p>
						<br>
						<br>
						<br>
							您还没有报名，可以点击本页超链接参与报名哦
						<br>
						<br>
						<br>
						</p>";
						echo "<a href=\"index.php\">还没报名？赶快来报名吧</a>";
					}	

			}
	}else{
		echo $data;
	}
 ?>
	</div>
	<div class="notes">
		<dl>
			<dt>
				<strong>报名须知：</strong>
			</dt>
			<dd>
				<ol>
					<li>1. 本次活动仅限陕西省高校在校大学生个人报名，</li>
					<li>2. 微信报名时正确完整填写相关信息；</li>
					<li>3. 微信报名后获得唯一参赛编码，凭此编码在各高校活动指定报名点领取并填写纸质报名表，各高校报名点请关注公众微信号“雪花勇闯天涯”点击下拉菜单选择2016年挑战未登峰进行了解；</li>
					<li>4. 在法律允许范围内，本活动解释权归主办方所有；</li>
					<li>5. 如有任何调整我们将通过微信另行通告，更多活动信息请点击公众微信号“雪花勇闯天涯”下拉菜单选择2016年挑战未登峰进行了解；</li>
				</ol>				
			</dd>
		</dl>
		<div style="margin:30px auto 0;text-align:center;color:#0181CA">
			<p>版权归华润雪花啤酒（中国）有限公司所有</p>
		</div>		
		
	</div>
</body>
</html>