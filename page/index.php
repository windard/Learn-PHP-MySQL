<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
li{width:100%; overflow:hidden; margin-top:20px; list-style:none;}
a{display:block; height:30px; min-width:30px; text-align:center; font-size:14px; border:1px solid #d6d6d6; float:left; margin-left:10px; padding:3px 5px; line-height:30px; text-decoration:none; color:#666;}
a:hover,a.here{background:#FF4500; border-color:#FF4500; color:#FFF;}

</style>
</head>

<body>

<?php
require_once('/page.php');

$param = array('totalRows'=>'100','pageSize'=>'2','currentPage'=>@$_GET['p'],'baseUrl'=>'/page_index.php?id=3');


$page1 = new Page($param);
$page2 = new Page($param);
$page3 = new Page($param);
$page4 = new Page($param);
$page5 = new Page($param);

echo '总记录数：100';
echo '<hr />';
echo '每页记录2条<hr/ >';
echo '当前页码：'.$page1->getCurrentPage().'<hr />';
echo '共计'.$page1->pageAmount().'页<hr />';
echo '<li>'.$page1->pagination().'</li>';
echo '<li>'.$page2->pagination('1').'</li>'; //默认为1，所以和不填写效果一样
echo '<li>'.$page3->pagination('2').'</li>';
echo '<li>'.$page4->pagination('3').'</li>';
echo '<li>'.$page5->pagination('4').'</li>';
?>
</body>
</html>