<?php 
	echo "This site will back to localhost";
	Header("HTTP/1.1 301 Moved Permanently");
	// Header("Location: http://localhost");
 	// exit;
	header('Refresh: 3; url=http://localhost');
	exit;
 ?>