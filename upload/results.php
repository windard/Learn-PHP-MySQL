 <?php
//header("Content-type: text/html; charset=utf-8"); 
$link=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
//if(mysql_set_charset('utf8',$link)){
//echo "SSSSSSSSSSSSSSSSSSSSSSS";
//}else{
//echo "FFFFFFFFFFFFFFFFFFFFFFFFFFF";
//}
if($link)
{
    mysql_select_db('app_tablegather',$link);
    $search = trim($_GET['search']);
    //$search='"%'.$search.'%"';
    //echo $search;
    //$search = iconv("GB2312", "UTF-8", $search);
    $table  = $_GET['tablename'];
    $response = array();
    mysql_query("SET NAMES 'UTF8'"); 
    $result = mysql_query("SELECT * FROM `".$table."` WHERE tablename REGEXP \"".$search.'"');
	// $encode = mb_detect_encoding($search,array('ASCII','GB2312','GBK','UTF-8','CP936'));
	// echo $encode;
    //if( $encode == "CP936"){
    //echo "专门";
        // $search = mb_convert_encoding($search,"UTF-8","CP936");
    //  echo $search;
    //}else{
    // echo "不是";
    //}
	// $encode = mb_detect_encoding($search,array('ASCII','GB2312','GBK','UTF-8','CP936'));
	// echo $encode;    
    if(!$result){
        echo "<tr><td colspan='4' align='center'>对不起，您输入的信息有误。</td></tr>";
        echo $search;

    }else{
        // echo "<br>";
    class responseData{
		public $length = "";
		public $data   = array();
	}
	$response = new responseData();
        //array_push($response->data,"<a href='#'>这是一个来接</a>");
        //array_push($response->data,"<a href='#'>这是从四渡赤水</a>");
	// echo $response
        //$size = count($response->data);
        //$response->length = $size;
        //echo json_encode($response);
        //    $response = array();
        while($row=mysql_fetch_array($result)){
            // echo "<br>";
            //array_push($response,"<a href='/upload/".$table."/".$row['tablename']."'>".$row['tablename']."</a>");
            array_push($response->data,"<a href='/upload/".$table."/".$row['tablename']."'>".$row['tablename']."</a>");
            //array_push($response,"heheheh");
        }
        //echo json_encode($response);
        //echo $response;
        $size = count($response->data);
        $response->length = $size;
        echo json_encode($response);
    }
    mysql_close($link);
}             
?>
        
   
