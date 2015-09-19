<?php>
  session_start();
  require_once("common.php");
?>

<html>
	
<head>
  <?php 
    require_once("head.php"); // 页面标题信息 
  ?>
  <link rel="stylesheet" type="text/css" href="../css/delroom.css" />
  
  <script language='javascript'>
     function mySubmit() {
     	   var r_num = document.getElementById("r_num").value; 
     	   if( r_num == "" ) {
     	     alert("请输入待删除客人所在房间号");
     	     return false;
     	   }
     	   if( isNaN(r_num) || r_num <= 0) {
     	     alert("您输入的房间号有误，房间号不能包含字母或为负数！");	
     	     return false;
     	   }
     	   if( !confirm("您确认删除该房间客人信息吗？") ) return false;
     	   document.getElementById("r_del").value = "do_del";
     	   return true;
     }
     function myCancel() {
         location.href="rent_query.php"; 	
     }     
  </script>
</head>	

<body>
	<div id="set_main" align="center">
	  <h1 id="set_h1" align="center"> 删除客人信息 </h1>
	  <h2 id="set_u"> 当前登陆用户: <?php echo $_SESSION['username']; ?> </h2>
	  <hr id="set_hr">
	  <div id="set_item" align="center">
       <form method="post" onsubmit="return mySubmit()" action="">
       	  <table>
       	  	<tr>
       	  		<td class="set_t"> 请提供待删除客人的房间号: </td>
       	  		<td class="set_p"> <input id="r_num" type="text" name="r_num" /> </td>
       	  		<td class="set_p"> <input id="r_del" type="hidden" name="r_del" value="not_del"/> </td>
       	  	</tr>
          </table>  
          <div id="set_btn" align="center">
  		      <input type="submit" id="delroom_submit" value="删&nbsp除" />&nbsp&nbsp&nbsp
  		      <input type="button" id="delroom_cancel" value="取&nbsp消" onclick="myCancel()" />        	 
          </div>         
       </form>
	  </div>
	  <hr id="set_hr">
  </div>
  
  <?php
    if( $_POST['r_del'] == "do_del") {
    	 $num = $_POST['r_num'];
    	 $status = print_status("room_idle");
		   $sql_links = sqlConnect();
		   $sql_quote0 = "`status`='$status',`renter`='',`sex`='',`born`='',`phone`='',`career`='',`contract`='',`price`='',`payway`='',`elec_ini_amount`='',`elec_cur_amount`='',";
		   $sql_quote1 = "`pay_mfytime`='',`pay_status`='UUUUUUUUUUU',`elec_mfy_time`='',`elec_cur_amount`='',`start`='',`stop`='',`pay_t2`='',`pay_t3`='',`pay_t4`='',`remark`=''";
		   $sql_update = $sql_quote0.$sql_quote1;
			 $sql_quote = "update `zr_roomlist` set $sql_update where `zr_roomlist`.`num`='$num'";   
		   $sql_links->runSql($sql_quote);
		   if ($sql_links->errno() != 0) {
		      die("Error:" . $sql_links->errmsg());
		   }    
		   $sql_links->closeDb();   
		   print_alert('客人信息已经成功删除！');
		   echo "<script>location.href='rent_query.php';</script>";		   
    }  
  ?>
</body>