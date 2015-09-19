<?php
   session_start();
   require_once("common.php");
   
   $num = $_POST['r_num'];
   $status = print_status($_POST['r_status']);
   $style = $_POST['r_style'];
   $contract = $_POST['r_contract'];
   $renter = $_POST['r_renter'];
   $phone = $_POST['r_phone'];
   $start = $_POST['r_start'];
   $stop = $_POST['r_stop'];
   $remark = $_POST['r_remark'];

   $sql_links = sqlConnect();
   $sql_quote = "select * from `zr_roomlist` where `zr_roomlist`.`num`='$num'";   
   $sql_query = $sql_links->getData( $sql_quote );   
   if( sizeof($sql_query) > 0) {
   	  print_alert("您新增的房间号已经存在！");
      echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
   	  return;
   }  
   
   $sub_quote0 = "(`num`,`style`,`status`,`contract`,`renter`,`phone`,`start`,`stop`,`remark`)";
   $sub_quote1 = "('$num','$style','$status','$contract','$renter','$phone','$start','$stop','$remark')"; 
   $sql_quote  = "insert into `zr_roomlist` $sub_quote0 values $sub_quote1";
   $sql_links->runSql($sql_quote);
   if ($sql_links->errno() != 0) {
      die("Error:" . $sql_links->errmsg());
   }    
   $sql_links->closeDb();   
   print_alert('新房间信息已经成功添加！');
   echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
?>  