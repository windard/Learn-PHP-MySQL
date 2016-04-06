<?php
	$con = @mysqli_connect("localhost","rot","123456") or die("Can't Connect To MySQL <br>".mysqli_connect_error()." Code: ".mysqli_connect_errno());
	echo "Connect Successfully";
?> 