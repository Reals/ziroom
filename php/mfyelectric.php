<?php>
  session_start();
  require_once("common.php");
?>

<html>
	
<head>
  <?php 
    require_once("head.php"); // 页面标题信息 
  ?>
  <link rel="stylesheet" type="text/css" href="../css/mfyelectric.css" />
  
  <script language='javascript'>
     function myQuery() {
     	   var r_num = document.getElementById("r_num").value; 
     	   if( r_num == "no_num" ) {
     	     alert("暂无房间号，请先增加已租房屋信息！");
     	     return false;
     	   }  	
     	   document.getElementById("q_tag").value = "do_qry";   
     	   return true;
     }
     function myModify() {
     	   var new_elec = document.getElementById("r_cur_elec").value;
     	   if( new_elec == "" ) {
     	     alert("请输入此房间最新剩余电量！");
     	     return false;	
     	   }
     	   if( isNaN(new_elec) || (!isNaN(new_elec) && (new_elec < 0) )) {
     	     alert("您输入的最新剩余电量有误");
     	     return false;	
     	   }
     	   if( document.getElementById("r_num").value == "no_num" ) {
     	     alert("请先选择并查询房间剩余电量，或增加已出租的房间！");
     	     return false;	
     	   }
         document.getElementById("m_tag").value = "do_mfy";
         document.getElementById("m_num").value = document.getElementById("r_num").value;
         return true;
     }
     function myCancel() {
         location.href="hydropower_remind.php"; 	
     }     
  </script>
</head>	

<body>
	<div id="set_main" align="center">
	  <h1 id="set_h1" align="center"> 修改房间剩余电量 </h1>
	  <h2 id="set_u"> 当前登陆用户: <?php echo $_SESSION['username']; ?> </h2>
	  <hr id="set_hr">
	  <div id="set_item" align="center">
       <form method="post" onsubmit="return myQuery()" action="">
       	  <table>
       	  	<tr>
       	  		<td class="set_t"> 请提供待修改剩余电量的房间号: </td>  	  
       	  		<td class="set_p"> 
       	  			<?php
							   $sql_links = sqlConnect();
							   $sql_quote = "select `num` from `zr_roomlist` where `status`='已出租'";   
							   $sql_query = $sql_links->getData( $sql_quote );  
								 $sql_links->closeDb();
								 echo "<select id='r_num' name='r_num'>";
								 if( sizeof($sql_query) == 0)  {
								   echo "<option value='no_num' title='无房间信息'> 无房间 </option>";
								 } else {
								   foreach( $sql_query as $index=>$room_num) {
								   	 $num = $room_num['num'];
								     echo "<option value='$num'> $num </option>";	
								   }	
								 }
								 echo "</select>";	  			
       	  			?>
       	  		</td>
       	  		<td>
			          <div>
			  		      <input type="submit" id="mfyelec_query" value="查 询" />
			  		      <input type="hidden" name="q_tag" id="q_tag" value="not_qry" />
			          </div>
		          </td>  
       	  	</tr>
          </table>
       </form>
       <form method="post" onsubmit="return myModify()" action="">
       	  <table>
       	    <tr>
       	      <td class="set_t"> 所选房间上次剩余电量: </td>
       	      <td class="set_p"> <input id="r_pre_elec" name="r_pre_elec" type="text" disabled="disabled" /> </td>	
       	    </tr>	
       	  	<tr>
       	      <td class="set_t"> 房间电量上次修改时间: </td>
       	      <td class="set_p"> <input id="r_pre_time" name="r_pre_time" type="text" disabled="disabled" /> </td>	       	  	  	
       	  	</tr>
       	  	<tr>
       	      <td class="set_t"> 该房间剩余电量修改为: </td>
       	      <td class="set_p"> <input id="r_cur_elec" name="r_cur_elec" type="text" /> </td>
       	  	</tr>
       	  	<?php 
       	  	  if( $_POST['q_tag'] == "do_qry") {
       	  	  	$num = $_POST['r_num'];
       	  	  	$sql_links = sqlConnect();
       	  	  	$sql_quote = "select * from `zr_roomlist` where `num`='$num'";
       	  	  	$sql_query = $sql_links->getData($sql_quote);
       	  	  	$sql_links->closeDb();
       	  	  	$elec_cur_amount = $sql_query[0]['elec_cur_amount'];
       	  	  	$elec_mfy_time = $sql_query[0]['elec_mfy_time'];
       	  	  	echo "<script> document.getElementById('r_num').value = '$num'; </script>";
       	  	  	echo "<script> document.getElementById('r_pre_elec').value = '$elec_cur_amount'; </script>";       	  	  	
       	  	  	echo "<script> document.getElementById('r_pre_time').value = '$elec_mfy_time'; </script>";
       	  	  }       	  	
       	  	?>
       	  </table>
          <div id="set_btn" align="center">
  		      <input type="submit" id="mfyelec_submit" value="修 改" />&nbsp&nbsp&nbsp
  		      <input type="button" id="mfyelec_cancel" value="取 消" onclick="myCancel()" />
  		      <input type="hidden" id="m_tag" name="m_tag" value="not_mfy" />
  		      <input type="hidden" id="m_num" name="m_num" value="no_num" />
          </div>  
          <?php
            if( $_POST['m_tag'] == "do_mfy" ) {
            	$num = $_POST['m_num'];
            	$new_elec = $_POST['r_cur_elec'];
              $new_time = date('Y-m-d H:i:s');
            	$sql_links = sqlConnect();
            	$sql_quot0 = "`elec_cur_amount`='$new_elec',`elec_mfy_time`='$new_time'";
            	$sql_quote = "update `zr_roomlist` set $sql_quot0 where `num`='$num'";
						  $sql_links->runSql($sql_quote);
						  if ($sql_links->errno() != 0) {
						    die("Error:" . $sql_links->errmsg());
						  } 
						  $sql_links->closeDb();   
						  print_alert("房间剩余电量修改成功！");  
       	  	  echo "<script> document.getElementById('r_num').value = '$num'; </script>";
       	  	  echo "<script> document.getElementById('r_pre_elec').value = '$new_elec'; </script>";       	  	  	
       	  	  echo "<script> document.getElementById('r_pre_time').value = '$new_time'; </script>";						              
            }
          ?>       
       </form>
	  </div>
	  <hr id="set_hr">
  </div>
</body>