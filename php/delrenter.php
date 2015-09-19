<?php>
  session_start();
  require_once("common.php");
?>

<html>
	
<head>
  <?php 
    require_once("head.php"); // ҳ�������Ϣ 
  ?>
  <link rel="stylesheet" type="text/css" href="../css/delroom.css" />
  
  <script language='javascript'>
     function mySubmit() {
     	   var r_num = document.getElementById("r_num").value; 
     	   if( r_num == "" ) {
     	     alert("�������ɾ���������ڷ����");
     	     return false;
     	   }
     	   if( isNaN(r_num) || r_num <= 0) {
     	     alert("������ķ�������󣬷���Ų��ܰ�����ĸ��Ϊ������");	
     	     return false;
     	   }
     	   if( !confirm("��ȷ��ɾ���÷��������Ϣ��") ) return false;
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
	  <h1 id="set_h1" align="center"> ɾ��������Ϣ </h1>
	  <h2 id="set_u"> ��ǰ��½�û�: <?php echo $_SESSION['username']; ?> </h2>
	  <hr id="set_hr">
	  <div id="set_item" align="center">
       <form method="post" onsubmit="return mySubmit()" action="">
       	  <table>
       	  	<tr>
       	  		<td class="set_t"> ���ṩ��ɾ�����˵ķ����: </td>
       	  		<td class="set_p"> <input id="r_num" type="text" name="r_num" /> </td>
       	  		<td class="set_p"> <input id="r_del" type="hidden" name="r_del" value="not_del"/> </td>
       	  	</tr>
          </table>  
          <div id="set_btn" align="center">
  		      <input type="submit" id="delroom_submit" value="ɾ&nbsp��" />&nbsp&nbsp&nbsp
  		      <input type="button" id="delroom_cancel" value="ȡ&nbsp��" onclick="myCancel()" />        	 
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
		   print_alert('������Ϣ�Ѿ��ɹ�ɾ����');
		   echo "<script>location.href='rent_query.php';</script>";		   
    }  
  ?>
</body>