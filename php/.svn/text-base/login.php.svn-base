<?php 
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $belongto = $_POST['zr_room'];
  	$_SESSION['username'] = $username; 
  	$_SESSION['password'] = $password;
    require_once("common.php");    

    if( empty($username) | empty($password) ) 
       echo "<script language=javascript>location.href='page_timeout.php';</script>";              
    // database connection    
    $sql_links = sqlConnect();
    $sql_quote = "select * from `zr_userlist` where username='$username'";
    $sql_query = $sql_links->getData( $sql_quote );    
    //var_dump($sql_query);    
    // idenfication check   
    if( sizeof($sql_query) != 1) { // 用户名不存在，返回父页面
    	  print_alert("您输入的用户名不存在，请重新输入！");
        echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";     
    } else if( $sql_query[0]['password'] != $password ) { // 密码错误，返回父页面
        print_alert('您输入的密码有误，请重新输入！');
        echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    } /*else if( $sql_query[0]['apartment'] != $belongto) {
        echo "<script>alert('您选择的所在公寓有误，请重新选择或与管理员联系，即将返回登录页面！');</script>";
        echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
    }  */else { // identified
  	    $_SESSION['belongto'] = $sql_query[0]['apartment']; 
  	    $_SESSION['nickname'] = $sql_query[0]['nickname'];
      	echo "<script language=javascript>location.href='../php/logon.php';</script>";
    }       
    // database closed 
    $sql_links->closeDb();
?>
