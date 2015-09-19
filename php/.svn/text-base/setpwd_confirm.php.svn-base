<?php
   session_start();
   require_once("common.php");
   $old_pwd_input = $_POST['old_pwd'];
   $new_pwd_input = $_POST['new_pwd'];
   $old_pwd_dbase = $_SESSION['password'];
   if( $old_pwd_input != $old_pwd_dbase ) {
     print_alert('您的旧密码输入有误！');
     echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
     return;
   }
   $username  = $_SESSION['username'];   
   $sql_links = sqlConnect();
   $sql_quote = "update `zr_userlist` set `password`='$new_pwd_input' where `zr_userlist`.`username`='$username'";
   $sql_links->runSql($sql_quote);
   if ($sql_links->errno() != 0) {
      die("Error:" . $sql_links->errmsg());
   } 
   $sql_links->closeDb();   
   print_alert('新密码设置成功，请重新登陆系统！');
   echo "<script language=javascript>location.href='http://ziroom.sinaapp.com';</script>";
   session_destroy();
?>  