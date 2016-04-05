<?php 
  $submit = $_POST['submit'];
  // $kemu   = $_POST['kemu'];
  $file   = $_FILES['file'];
  if(isset($submit) && is_array($file)){
    $name = urldecode($file['name']);
	// $encode = mb_detect_encoding($name,array('ASCII','GB2312','GBK','UTF-8'));
	// echo $encode;      
     // $name = iconv('gb2312','UTF-8',$name);
    $type = $file['type'];
    $size = $file['size'];
    $tmp  = $file['tmp_name'];
    // echo $name;
    if($tmp && is_uploaded_file($tmp)){
      $newfile = fopen($tmp,'r');
      $filedata = addslashes(fread($newfile,$size));
      fclose($newfile);
      // echo $name;
      $mysqli = mysqli_connect("localhost","root" ,"123456","test");
      // mysqli_select_db('test',$mysqli);
       // $result = mysql_query("SELECT * FROM `".$kemu."` WHERE tablename REGEXP ".$name);
      if(mysqli_set_charset($mysqli,"utf8")){
        echo "Successful\n";
      }else{
        echo "What fuck!\n";
      }
      // $name = "2014年度年";
      //  $sql = mysqli_query("INSERT INTO  test(name,content) VALUES('$name','$size')");
        $sql = mysqli_query($mysqli,"INSERT INTO  test(name,content) VALUES('$name','$size')");
       //$sql = mysqli_query($mysqli,"INSERT INTO  test(name,content) VALUES('$name','$filedata')");
      if($sql){
        echo "Successful !";
      }else{
        echo "Error One ~";
      }
    }else{
      echo "Error two";
    } 
  }else{
    echo "Error three";
  }
 ?>
