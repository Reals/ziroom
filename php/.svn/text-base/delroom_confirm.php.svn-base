<?php
   session_start();
   require_once("common.php");
   
   $num = $_POST['r_num'];

   $sql_links = sqlConnect();
   $sql_quote = "select * from `zr_roomlist` where `zr_roomlist`.`num`='$num'";   
   $sql_query = $sql_links->getData( $sql_quote );   
   if( sizeof($sql_query) == 0) {
   	  print_alert("您输入的待删除房间号不存在！");
      echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
   	  return;
   }  
   
   $sql_quote  = "delete from `zr_roomlist` where `num`='$num'";
   $sql_links->runSql($sql_quote);
   if ($sql_links->errno() != 0) {
      die("Error:" . $sql_links->errmsg());
   }    
   $sql_links->closeDb();   
   print_alert('待删除的房间已经成功删除！');
   echo "<script>location.href='room_status.php';</script>";
?>  