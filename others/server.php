<?php

// echo stristr("Hello world!","HH");


 echo  $_SERVER [ 'SERVER_NAME' ]; 
 echo  "<br>";
 echo  $_SERVER [ 'PHP_SELF' ];
// echo  "<br>";
// echo  $_SERVER['HTTPS'];
 echo  "<br>";
 echo  $_SERVER ['HTTP_HOST'];
 echo  "<br>";
 echo  $_SERVER ['GATEWAY_INTERFACE'];
 // echo  "<br>";
 // echo  $_SERVER [' REMOTE_ADDR '];
 // echo  "<br>";
 // echo  $_SERVER [' SERVER_NAME '];
 echo  "<br>";
 echo  "<br>";
 echo  "<br>";
 echo  "<br>";
 echo  "<br>";
 echo  "<br>";
 // echo  $_SERVER [' SERVER_SOFTWARE '];
 // echo  $_SERVER [' SERVER_PROTOCOL '];
 // echo  $_SERVER [' REQUEST_METHOD '];


echo	$_SERVER['PHP_SELF']."<br>"; #当前正在执行脚本的文件名，与 document root相关。
//echo	$_SERVER['argv']."<br>"; #传递给该脚本的参数。
//echo	$_SERVER['argc']."<br>"; #包含传递给程序的命令行参数的个数（如果运行在命令行模式）。
echo	$_SERVER['GATEWAY_INTERFACE']."<br>"; #服务器使用的 CGI 规范的版本。例如，“CGI/1.1”。
echo	$_SERVER['SERVER_NAME']."<br>"; #当前运行脚本所在服务器主机的名称。
echo	$_SERVER['SERVER_SOFTWARE']."<br>"; #服务器标识的字串，在响应请求时的头部中给出。
echo	$_SERVER['SERVER_PROTOCOL']."<br>"; #请求页面时通信协议的名称和版本。例如，“HTTP/1.0”。
echo	$_SERVER['REQUEST_METHOD']."<br>"; #访问页面时的请求方法。例如：“GET”、“HEAD”，“POST”，“PUT”。
echo	$_SERVER['QUERY_STRING']."<br>"; #查询(query)的字符串。
echo	$_SERVER['DOCUMENT_ROOT']."<br>"; #当前运行脚本所在的文档根目录。在服务器配置文件中定义。
echo	$_SERVER['HTTP_ACCEPT']."<br>"; #当前请求的 Accept: 头部的内容。
//echo	$_SERVER['HTTP_ACCEPT_CHARSET']."<br>"; #当前请求的 Accept-Charset: 头部的内容。例如：“iso-8859-1,*,utf-8”。
echo	$_SERVER['HTTP_ACCEPT_ENCODING']."<br>"; #当前请求的 Accept-Encoding: 头部的内容。例如：“gzip”。
echo	$_SERVER['HTTP_ACCEPT_LANGUAGE']."<br>";#当前请求的 Accept-Language: 头部的内容。例如：“en”。
echo	$_SERVER['HTTP_CONNECTION']."<br>"; #当前请求的 Connection: 头部的内容。例如：“Keep-Alive”。
echo	$_SERVER['HTTP_HOST']."<br>"; #当前请求的 Host: 头部的内容。
//echo	$_SERVER['HTTP_REFERER']."<br>"; #链接到当前页面的前一页面的 URL 地址。
echo	$_SERVER['HTTP_USER_AGENT']."<br>"; #当前请求的 User_Agent: 头部的内容。
//echo	$_SERVER['HTTPS']."<br>"; # 如果通过https访问,则被设为一个非空的值(on)，否则返回off
echo	$_SERVER['REMOTE_ADDR']."<br>"; #正在浏览当前页面用户的 IP 地址。
echo	$_SERVER['REMOTE_HOST']."<br>"; #正在浏览当前页面用户的主机名。
echo	$_SERVER['REMOTE_PORT']."<br>"; #用户连接到服务器时所使用的端口。
echo	$_SERVER['SCRIPT_FILENAME']."<br>"; #当前执行脚本的绝对路径名。
echo	$_SERVER['SERVER_ADMIN']."<br>"; #管理员信息
echo	$_SERVER['SERVER_PORT']."<br>"; #服务器所使用的端口
echo	$_SERVER['SERVER_SIGNATURE']."<br>"; #包含服务器版本和虚拟主机名的字符串。
//echo	$_SERVER['PATH_TRANSLATED']."<br>"; #当前脚本所在文件系统（不是文档根目录）的基本路径。
echo	$_SERVER['SCRIPT_NAME']."<br>"; #包含当前脚本的路径。这在页面需要指向自己时非常有用。
echo	$_SERVER['REQUEST_URI']."<br>"; #访问此页面所需的 URI。例如，“/index.html”。
//echo	$_SERVER['PHP_AUTH_USER']."<br>"; #当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是用户输入的用户名。
//echo	$_SERVER['PHP_AUTH_PW']."<br>"; #当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是用户输入的密码。
//echo	$_SERVER['AUTH_TYPE']."<br>"; #当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是认证的类型。





/**********PHP 判断协议是否为HTTPS**************/
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		// $uri = 'https://';
	    echo "This is not HTTPS";

	} else {
		// $uri = 'http://';
  	  echo "This is HTTP";

	}
	echo  "<br>";
	if(isset($_SERVER['HTTPS'])){
		echo "YEA";
	}else{
		echo "NO";
	}
 ?> 