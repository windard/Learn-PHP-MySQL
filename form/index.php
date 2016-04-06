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
			$("select[name=schoolid]").change(function(){
				if($(this).val()=="09"){
					$("input[name=school]").val("");
					$(".hidden").show();
					console.log("H");
				}else{
					$(".hidden").hide();
					schoolid = $(this).val();
					school = $("input[name=school]");
					if(schoolid=="01"){
						school.val("西安电子科技大学");
					}else if(schoolid=="02"){
						school.val("西安建筑科技大学"); 
					}else if(schoolid=="03"){
						school.val("西安体育学院");
					}else if(schoolid=="04"){
						school.val("西安理工大学");
					}else if(schoolid=="05"){
						school.val("陕西科技大学");
					}else if(schoolid=="06"){
						school.val("长安大学");
					}else if(schoolid=="07"){
						school.val("西安邮电大学");
					}else if(schoolid=="08"){
						school.val("西安财经学院");
					}else if(schoolid=="00"){
						school.val("");
					}
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
						sex = $("select[name=sex]").val();
						if(sex=="00"){
							alert("对不起，性别不能为空");
						}else{
							age = $("input[name=age]").val();
							if(age==""||!age.match("^[0-9]{2}$")){
								alert("对不起，年龄必须为两位有效数字");
							}else{
								schoolid = $("select[name=schoolid]").val();
								if(schoolid=="00"){
									alert("对不起，学校不能为空");
								}else{
									school = $("input[name=school]").val();
									if(!school.match("^[\u4e00-\u9fa5]{1,20}$")){
										alert("对不起，学校必须为二十位以内汉字");
									}else{
										stunum = $("input[name=stunum]").val();
										var patt=new RegExp("^[0-9a-zA-Z]{3,15}$");
										if(patt.test(stunum)){
											phone = $("input[name=phone]").val();
											if(phone.match("^[\\d]{11}$")){
												$("#form").submit();
											}else{
												alert("对不起，手机号必须由11位有效数字组成");
											}
											
										}else{
											alert("对不起，学号必须由3到15位数字或字母组成");
										}
									}
								}
							}
						}
					}
				}
			})		})
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
		<h1>请填写资料报名“2016年挑战未登峰活动”</h1>
		<form action=\"index.php\" method=\"post\" id=\"form\">
		<div class=\"center\">
			<label for=\"name\">姓名：</label>
			<input type=\"text\" name=\"name\" id=\"name\" maxlength=\"6\" required>
			<br>
			<label for=\"sex\">性别：</label>
			<select name=\"sex\" id=\"sex\">

				<option value=\"00\" selected=\"selected\">请选择</option>
				<option value=\"男\">男</option>
				<option value=\"女\">女</option>
			</select>
			<br>
			<label for=\"age\">年龄：</label>
			<input type=\"text\" name=\"age\" id=\"age\" required minlength=\"2\" maxlength=\"2\">
			<br>
			<label for=\"schoolid\">学校：</label>
			<select name=\"schoolid\" id=\"schoolid\">
				<option value=\"00\" selected=\"selected\">请选择</option>
				<option value=\"01\">西安电子科技大学</option>
				<option value=\"02\">西安建筑科技大学</option>
				<option value=\"03\">西安体育学院</option>
				<option value=\"04\">西安理工大学</option>
				<option value=\"05\">陕西科技大学</option>
				<option value=\"06\">长安大学</option>
				<option value=\"07\">西安邮电大学</option>
				<option value=\"08\">西安财经学院</option>
				<option value=\"09\">其他学校</option>
			</select>
			<div class=\"hidden\">
				<label for=\"school\">学校：</label>
				<input type=\"text\" name=\"school\" id=\"school\" required maxlength=20>
			</div>
			<br>
			<label for=\"stunum\">学号：</label>
			<input type=\"text\" name=\"stunum\" id=\"stunum\" minlength=\"3\" maxlength=\"15\" required>			
			<br>
			<label for=\"phone\">手机：</label>
			<input type=\"text\" name=\"phone\" id=\"phone\" minlength=\"11\" maxlength=\"11\" required>					
			<input type=\"button\" name=\"button\" value=\"确认报名\">
			<br>
			<a href=\"find.php\">已报名？查询参赛码</a>
		</div>
	</form>";
	if(isset($_POST["stunum"])){
			$con = new mysqli("localhost","XXX","XXX","user");		
			$con->query("SET NAMES 'utf8'");
			$name = mysqli_real_escape_string($con,stripslashes($_POST['name']));
			$sex = mysqli_real_escape_string($con,stripslashes($_POST['sex']));
			$age = mysqli_real_escape_string($con,stripslashes($_POST['age']));
			$schoolid = mysqli_real_escape_string($con,stripslashes($_POST['schoolid']));
			$school = mysqli_real_escape_string($con,stripslashes($_POST['school']));
			$stunum = mysqli_real_escape_string($con,stripslashes($_POST['stunum']));
			$phone= mysqli_real_escape_string($con,stripslashes($_POST['phone']));			
			if($name==""||$age==""||$sex=="00"||$stunum==""||$schoolid=="00"||$phone==""){
				echo "<p style='color:red'>对不起，姓名或年龄或性别或学校或学号或手机不能为空。</p>";
				$name = "";
				$sex = "";
				$age = "";
				$school = "";
				$stunum = "";
				echo $data;				
			}else{
				if(isNumber($age)&&isNumber($phone)){
					$res = $con->query("SELECT * FROM stu WHERE phone='$phone'");
					if($row_cnt = $res->num_rows){
						echo "<br><br><p style='color:red'>您已经报过名啦~可以点击本页超链接查询参赛码哦</p>";
						$name = "";
						$sex = "";
						$age = "";
						$school = "";
						$stunum = "";
						echo "<br><br><a href=\"find.php\">已报名？查询参赛码</a><br><br>";
					}else{
						$res = $con->query("SELECT * FROM stu WHERE schoolid='$schoolid'");
						$codefirst = $res->num_rows+1;
						$codefirst = str_pad($codefirst,4,"0",STR_PAD_LEFT);
						$codefirst = strval($codefirst);
						$code = $codefirst.$schoolid;
						$res = $con->query("SELECT * FROM stu");
						$id = $res->num_rows + 1;
						$result = $con->query("INSERT INTO stu(id,name,sex,age,schoolid,school,stunum,phone,code) VALUES('$id','$name','$sex','$age','$schoolid','$school','$stunum','$phone','$code')");
						echo "<p>
						<br>
						<br>
						<br>
						<br>
							<strong style=\"font-size:large\">您已报名成功，您的参赛码为:<span style=\"color:red;font-size:larger\">$code</span></strong>
						<br>
						<br>
						<div class=\"after\">
							<p style=\"font-weight:lighter;\">注：获得参赛码的小伙们，可以在首页界面下栏“2016年挑战未登峰“，按照各高校报名时间、地点就近选择报名点，现场填写纸质版后，获得参赛资格</p>
						</div>
						<br>
						<br>
						</p>";
					}	
				}else{		
						$name = "";
						$sex = "";
						$age = "";
						$school = "";
						$stunum = "";
						echo $data;
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
					<li>3. 微信报名后获得唯一参赛编码，凭此编码在各高校活动指定报名点领取并填写纸质报名表，各高校报名点请关注公众微信号“雪花勇闯一族”点击下拉菜单选择2016年挑战未登峰进行了解；</li>
					<li>4. 在法律允许范围内，本活动解释权归主办方所有；</li>
					<li>5. 如有任何调整我们将通过微信另行通告，更多活动信息请点击公众微信号“雪花勇闯一族”下拉菜单选择2016年挑战未登峰进行了解；</li>
				</ol>				
			</dd>
		</dl>
		<div style="margin:30px auto 0;text-align:center;color:#0181CA">
			<p>版权归华润雪花啤酒（中国）有限公司</p>
			<p>西安销售分公司所有</p>
		</div>				
	</div>
</body>
</html>