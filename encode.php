<?php 
header("content-Type: text/html; charset=Utf-8"); 
$encode = "中文";
$result = mb_detect_encoding($encode,array('ASCII','GB2312','GBK','UTF-8','CP936'));
echo $result;
echo $encode;
#$encode = iconv("cp936","UTF-8", $encode);
#$encode = mb_convert_encoding($encode,"UTF-8","CP936");
$encode = mb_convert_encoding($encode,"UTF-8",array('UTF-8','ASCII','EUC-CN','CP936','BIG-5','GB2312','GBK'));
$result = mb_detect_encoding($encode,array('ASCII','GB2312','GBK','UTF-8','CP936'));
echo $result;
echo $encode;
 ?>
