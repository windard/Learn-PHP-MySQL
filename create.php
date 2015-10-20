<?php 	
// $filename = iconv('utf-8', 'gbk','测试文档.txt');
// $file2 = fopen($filename, 'w');
// fwrite($file2,"这是测试文件");
// fclose($file2);
$filename=iconv('utf-8','gbk',"测试文档.txt");
// $filename = "测试文档.txt";
$file3 = fopen($filename,'r');
$content = fread($file3,filesize($filename));
echo $content;
fclose($file3);
 ?>