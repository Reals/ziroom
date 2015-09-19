<?php>
  session_start();
  require_once("common.php");
?>

<html>
	
<head>
  <?php 
    require_once("head.php"); // 页面标题信息 
  ?>
  <link rel="stylesheet" type="text/css" href="../css/setroom.css" />
  <script language='javascript' src="../js/common.js" > </script>
    
  <script language='javascript'>
     function myQuery() {
         if( numCheck() == false ) return false;
     	   document.getElementById("r_tag").value = "do_qry";
     	   return true;
     }
     function myCancel() {
         location.href="room_status.php"; 	
     } 
     function mySubmit() {
     	   if( numCheck() == false ) return false;
     	   document.getElementById("r_mfy").value = "do_mfy"; 
     	   document.getElementById("r_room").value = document.getElementById("r_num").value;
     	   return true;
     }    
  </script>
</head>	

<body>
	<div id="set_main" align="center">
	  <h1 id="set_h1" align="center"> 修改房间信息 </h1>
	  <h2 id="set_u"> 当前登陆用户: <?php echo $_SESSION['username']; ?> </h2>
	  <hr id="set_hr">
	  <div id="set_item" align="center">
  		 <form method="post" onsubmit="return myQuery()" action="">
       	  <table>
       	  	<tr>
       	  		  <td class="set_t"> 待修改信息的房间号: </td> 
       	  		  <td class="set_p"> <input id="r_num" type="text" name="r_num" /> </td>
       	  		  <td> <input id="r_qry" type="submit" value="查&nbsp询" /></td>   
       	  		  <td> <input id="r_tag" type="hidden" value="not_qry" name="r_tag" /> </td>   	 
       	  	</tr>
          </table>  
       </form>
       <hr id="r_qry_hr">    
       <form method="post" onsubmit="return mySubmit()" action="">
 	        <div id="r_qry_room">
 	        	 <table>
 	        	   <tr>
 	        	     <td class="set_t"> 户 型:</td> 
 	        	     <td class="set_p"> <input id="r_style" type="text" name="r_style" /> </td>
 	        	     <td class="set_t"> 状 态:</td>
 	        	     <td class="set_p"> 
		       	  			<select id="r_status" name="r_status">
		  			          <option value="room_idle"> -- 闲置中 --  </option>
		  			          <option value="room_rented"> -- 已出租 -- </option>
		  			          <option value="room_decorating"> -- 装修中 -- </option>
		  			          <option value="room_discarded"> -- 已废弃 -- </option>
		  			          <option value="room_occupied"> -- 已占用 -- </option>
		 	        	    </select>	
 	        	     </td>
 	        	   </tr>
 	        	   <tr>	
 	        	     <td class="set_t"> 合 同:</td>
 	        	     <td class="set_p"> <input id="r_contract" type="text" name="r_contract" /> </td>
 	        	     <td class="set_t"> 租 户:</td>
 	        	     <td class="set_p"> <input id="r_renter" type="text" name="r_renter" /> </td>
 	        	   </tr>	
 	        	   <tr>
 	        	     <td class="set_t"> 起 租:</td>
 	        	     <td class="set_p"> <input id="r_start" type="date" name="r_start" /> </td>
	               <td class="set_t"> 手 机:</td>
	               <td class="set_p"> <input id="r_phone" type="text" name="r_phone" />  </td>
 	        	   </tr>
 	        	   <tr>
 	        	     <td class="set_t"> 退 租:</td> 	        	     
 	        	     <td class="set_p"> <input id="r_stop" type="date" name="r_stop" /> </td>
	               <td class="set_t"> 备 注:</td>
	               <td class="set_p"> <input id="r_remark" type="text" name="r_remark" />  </td>
 	        	   </tr> 	        	
 	        	 </table>	        	 
 	        </div>   
          <div id="set_btn" align="center">
  		      <input type="submit" id="setroom_submit" value="修&nbsp改" /> &nbsp&nbsp&nbsp
  		      <input type="button" id="setroom_cancel" value="取&nbsp消" onclick="myCancel()" />        	 
  		      <input type="hidden" id="r_mfy" name="r_mfy" value="not_mfy" />
            <input type="hidden" id="r_room" name="r_room" value="no_num" />
          </div>         
       </form>
	  </div>
	  <hr id="set_hr">
  </div>
  
  <?php  
    if( $_POST['r_tag'] == 'do_qry') { // 页内查询事件处理
    	$num = $_POST['r_num'];
	    $sql_links = sqlConnect();
	    $sql_quote = "select * from `zr_roomlist` where `zr_roomlist`.`num`='$num'";   
	    $sql_query = $sql_links->getData( $sql_quote );  
		  $sql_links->closeDb();  
	    if( sizeof($sql_query) == 0) {
	   	  print_alert("您输入的房间号不存在！");
	      echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	      $_POST['r_num'] = "";
    	  return;
	    }  
      $status = select_Status($sql_query[0]['status']);
      $style = $sql_query[0]['style'];
      $contract = $sql_query[0]['contract'];
      $renter = $sql_query[0]['renter'];
      $phone =  $sql_query[0]['phone'];
      $start = $sql_query[0]['start'];
      $stop = $sql_query[0]['stop'];
      $remark = $sql_query[0]['remark'];
      echo "<script>document.getElementById('r_num').value='$num';</script>";
      echo "<script>document.getElementById('r_style').value='$style';</script>";
      echo "<script>document.getElementById('r_status').value='$status';</script>";
      echo "<script>document.getElementById('r_contract').value='$contract';</script>";
      echo "<script>document.getElementById('r_renter').value='$renter';</script>";
      echo "<script>document.getElementById('r_phone').value='$phone';</script>";
      echo "<script>document.getElementById('r_start').value='$start';</script>";
      echo "<script>document.getElementById('r_stop').value='$stop';</script>";
      echo "<script>document.getElementById('r_remark').value='$remark';</script>";
      echo "<script>document.getElementById('r_tag').value='not_qry';</script>";
    }  
    
    if( $_POST['r_mfy'] == 'do_mfy' ) { // 页内修改事件触发处理
    	$r_mfy = $_POST['r_mfy']; // 标志，通过POST传递到本页，用于在页内响应用户按钮事件
    	$r_num = $_POST['r_room']; // 将其他form的值传到这里以便使用
//	    $sql_links = sqlConnect(); // 如果用户未填写，需要跟以前保持一样
//	    $sql_quote = "select * from `zr_roomlist` where `zr_roomlist`.`num`='$r_num'";   
//	    $sql_query = $sql_links->getData( $sql_quote );   
      $status = print_status($_POST['r_status']);
      $style = $_POST['r_style'];
      $renter = $_POST['r_renter'];
      $contract = $_POST['r_contract'];
      $phone = $_POST['r_phone'];
      $start = $_POST['r_start'];
      $stop = $_POST['r_stop'];
      $remark = $_POST['r_remark'];
      if( $_POST['r_status'] != "room_rented") { // processed for default occasion
      	$renter = '';
      	$contract = '';
      	$phone = '';
      	$start = ''; // 0000-00-00 stored in mysql.zr_roomlist
      	$stop = ''; // 0000-00-00 stored in mysql.zr_roomlist      	
      }      
	    $sql_links = sqlConnect();
	    $sql_update= "`status`='$status',`style`='$style',`renter`='$renter',`phone`='$phone',`contract`='$contract',`start`='$start',`stop`='$stop',`remark`='$remark'";
		  $sql_quote = "update `zr_roomlist` set $sql_update where `zr_roomlist`.`num`='$r_num'";
		  $sql_links->runSql($sql_quote);
		  if ($sql_links->errno() != 0) {
		    die("Error:" . $sql_links->errmsg());
		  } 
		  $sql_links->closeDb();         
     
      echo "<script>document.getElementById('r_mfy').value='not_mfy';</script>";
      echo "<script>document.getElementById('r_room').value='no_room';</script>";
      echo print_alert("房间信息修改成功！");
    }    
  ?>  
  
</body>