<?php>
  session_start();
  require_once("common.php");
?>

<html>
	
<head>
  <?php 
    require_once("head.php"); // 页面标题信息 
  ?>
  <link rel="stylesheet" type="text/css" href="../css/setpayment.css" />
  
  <script language='javascript'>
     function myQuery() {
     	   var r_num = document.getElementById("r_num").value; 
     	   if( r_num == "no_num" ) {
     	     alert("请先选择房间号并查询！");
     	     return false;
     	   } 	
     	   document.getElementById("q_tag").value = "do_qry"; 
     	   return true;
     }
     function myModify() {
     	   if( document.getElementById("r_num").value == "no_num") {
     	     alert("请先选择房间号并查询!");
     	     return false;	
     	   }
         if( document.getElementById("r_payway").value == "年付") {
           alert("该房间客人选择缴费周期为年付，已付清所有房款，无须设置！");
           return ;	
         }

         var cb_set = new Array(); // stands for whether checkbox(bit11-bit1) is selected
         var st_set = new Array(); // stands for whether payment(bit11-bit1) is paied
         for(var month=1; month < 12; month++) {
           cb_set[month-1] = 'U';
           st_set[month-1] = 'U';	
         }
         var isModified = false;
         var cb_id;
         var st_id;
         for(var month=1; month < 12; month++) {
           cb_id = "r_paycnt"+month+"c";
           st_id = "r_paycnt"+month+"s";
           if( document.getElementById(cb_id).checked ) {
           	 isModified = true;
          	 cb_set[month-1] = 'S';
          	 if( document.getElementById(st_id).value == "had_payed" )
          	   st_set[month-1] = "P";
           }                     	
         }
         if( !isModified ) {
           alert("您未对该房间缴费状态作任何修改！");
           return false;	
         }
         if( !confirm("您确认修改此房间缴费状态吗？") )
         	  return false;
         cb_tag = cb_set.join("");
         st_tag = st_set.join("");         
     	   document.getElementById("m_tag").value = "do_mfy";
     	   document.getElementById("m_num").value = document.getElementById("r_num").value;
         document.getElementById("m_set").value = cb_tag;
         document.getElementById("m_status").value = st_tag;
     }
     
     function myCancel() {
         location.href="payment_remind.php"; 	
     }  
     
     function setChange($str) {
     	   var prefix = $str.substr(0, $str.length-1);
     	   var cb_id = prefix+"c";
     	   var st_id = prefix+"s";
     	   if( !document.getElementById(cb_id).checked )
     	     document.getElementById(st_id).disabled = true;
     	   else if( document.getElementById(cb_id).checked )
     	   	 document.getElementById(st_id).disabled = false;    	   	 
     }   
     
     function initial_setpay() {         
         for( var month=1; month<=12; month++) {
         	 var cb_id = "r_paycnt"+month+"c";
         	 var st_id = "r_paycnt"+month+"s";
         	 document.getElementById(cb_id).checked = false;
         	 document.getElementById(st_id).disabled = true;
         }     	
     }
     
  </script>
</head>	

<body onload="initial_setpay()">
	<div id="set_main" align="center">
	  <h1 id="set_h1" align="center"> 修改租户缴租状态 </h1>
	  <h2 id="set_u"> 当前登陆用户: <?php echo $_SESSION['username']; ?> </h2>
	  <hr id="set_hr">
	  <div id="set_item" align="center">
       <form method="post" onsubmit="return myQuery()" action="">
       	  <table>
       	  	<tr>
       	  		<td class="set_t"> 请提供待修改缴租状态的房间号: </td>  	  
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
								 	 echo "<option value='no_num' > 请选择 </option>"; 
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
       	      <td class="set_t"> 缴费周期: </td>
       	      <td class="set_p"> <input type="text" id="r_payway" name="r_payway" disabled="disabled" /> </td>	
       	      <td class="set_t"> &nbsp上次修改时间: </td>
       	      <td class="set_p"> <input type="text" id="r_pre_time" name="r_pre_time" disabled="disabled" /> </td>	
       	    </tr>	
      	  	<tr>
       	      <td class="set_t" colspan="4" style="padding-top:10px;text-align:center"> 请设置该房间的缴费状态 </td>
       	    </tr>
       	  </table>
       	  <table id="set_pay">
       	    <tr> <!-- 第1季度 -->
       	      <td class="set_p"> 
       	         <input type="checkbox" class="r_paycntc" name="r_paycnt1c" id="r_paycnt1c" onclick="setChange(this.name)" />  
       	         <select class="r_paycnts" name="r_paycnt1s" id="r_paycnt1s" title="第1个月缴费状态"> 
       	           <option value="not_payed" > 欠缴 </option>
       	           <option value="had_payed" > 已缴 </option>	
       	         </select>  
   	          </td>
       	      <td class="set_p">
       	         <input type="checkbox" class="r_paycntc" name="r_paycnt2c" id="r_paycnt2c" onclick="setChange(this.name)" />  
       	         <select class="r_paycnts" name="r_paycnt2s" id="r_paycnt2s" title="第2个月缴费状态"> 
       	           <option value="not_payed" > 欠缴 </option>
       	           <option value="had_payed" > 已缴 </option>	
       	         </select>       	      	
       	      </td>
       	      <td class="set_p">
       	         <input type="checkbox" class="r_paycntc" name="r_paycnt3c" id="r_paycnt3c" onclick="setChange(this.name)" />  
       	         <select class="r_paycnts" name="r_paycnt3s" id="r_paycnt3s" title="第3个月(第1季）缴费状态"> 
       	           <option value="not_payed" > 欠缴 </option>
       	           <option value="had_payed" > 已缴 </option>	
       	         </select>       	      	
       	      </td>  
       	    </tr>
       	    <tr>  <!-- 第2季度 -->
       	      <td class="set_p"> 
       	         <input type="checkbox" class="r_paycntc" name="r_paycnt4c" id="r_paycnt4c" onclick="setChange(this.name)"/>  
       	         <select class="r_paycnts" name="r_paycnt4s" id="r_paycnt4s" title="第4个月缴费状态"> 
       	           <option value="not_payed" > 欠缴 </option>
       	           <option value="had_payed" > 已缴 </option>	
       	         </select>  
   	          </td>
       	      <td class="set_p">
       	         <input type="checkbox" class="r_paycntc" name="r_paycnt5c" id="r_paycnt5c" onclick="setChange(this.name)"/>  
       	         <select class="r_paycnts" name="r_paycnt5s" id="r_paycnt5s" title="第5个月缴费状态"> 
       	           <option value="not_payed" > 欠缴 </option>
       	           <option value="had_payed" > 已缴 </option>	
       	         </select>       	      	
       	      </td>
       	      <td class="set_p">
       	         <input type="checkbox" class="r_paycntc" name="r_paycnt6c" id="r_paycnt6c" onclick="setChange(this.name)" />  
       	         <select class="r_paycnts" name="r_paycnt6s" id="r_paycnt6s" title="第6个月(第2季/半年)缴费状态"> 
       	           <option value="not_payed" > 欠缴 </option>
       	           <option value="had_payed" > 已缴 </option>	
       	         </select>       	      	
       	      </td>
       	  	</tr>
       	    <tr>  <!-- 第3季度 -->
       	      <td class="set_p"> 
       	         <input type="checkbox" class="r_paycntc" name="r_paycnt7c" id="r_paycnt7c" onclick="setChange(this.name)" />  
       	         <select class="r_paycnts" name="r_paycnt7s" id="r_paycnt7s" title="第7个月缴费状态"> 
       	           <option value="not_payed" > 欠缴 </option>
       	           <option value="had_payed" > 已缴 </option>	
       	         </select>  
   	          </td>
       	      <td class="set_p">
       	         <input type="checkbox" class="r_paycntc" name="r_paycnt8c" id="r_paycnt8c" onclick="setChange(this.name)"/>  
       	         <select class="r_paycnts" name="r_paycnt8s" id="r_paycnt8s" title="第8个月缴费状态"> 
       	           <option value="not_payed" > 欠缴 </option>
       	           <option value="had_payed" > 已缴 </option>	
       	         </select>       	      	
       	      </td>
       	      <td class="set_p">
       	         <input type="checkbox" class="r_paycntc" name="r_paycnt9c" id="r_paycnt9c" onclick="setChange(this.name)" />  
       	         <select class="r_paycnts" name="r_paycnt9s" id="r_paycnt9s" title="第9个月(第3季)缴费状态"> 
       	           <option value="not_payed" > 欠缴 </option>
       	           <option value="had_payed" > 已缴 </option>	
       	         </select>       	      	
       	      </td>
       	  	</tr>
       	    <tr>  <!-- 第4季度 -->
       	      <td class="set_p"> 
       	         <input type="checkbox" class="r_paycntc" name="r_paycnt10c" id="r_paycnt10c" onclick="setChange(this.name)"/>  
       	         <select class="r_paycnts" name="r_paycnt10s" id="r_paycnt10s" title="第10个月缴费状态"> 
       	           <option value="not_payed" > 欠缴 </option>
       	           <option value="had_payed" > 已缴 </option>	
       	         </select>  
   	          </td>
       	      <td class="set_p">
       	         <input type="checkbox" class="r_paycntc" name="r_paycnt11c" id="r_paycnt11c" onclick="setChange(this.name)"/>  
       	         <select class="r_paycnts" name="r_paycnt11s" id="r_paycnt11s" title="第11个月缴费状态"> 
       	           <option value="not_payed" > 欠缴 </option>
       	           <option value="had_payed" > 已缴 </option>	
       	         </select>       	      	
       	      </td>
       	      <td class="set_p">
       	         <input type="checkbox" class="r_paycntc" name="r_paycnt12c" id="r_paycnt12c" onclick="setChange(this.name)" />  
       	         <select class="r_paycnts" name="r_paycnt12s" id="r_paycnt12s" title="第12个月(第4季)缴费状态"> 
       	           <option value="not_payed" > 欠缴 </option>
       	           <option value="had_payed" > 已缴 </option>	
       	         </select>       	      	
       	      </td>
       	  	</tr>
       	  	<?php 
       	  	  if( $_POST['q_tag'] == "do_qry") {
       	  	  	$num = $_POST['r_num'];
       	  	  	$sql_links = sqlConnect();
       	  	  	$sql_quote = "select * from `zr_roomlist` where `num`='$num'";
       	  	  	$sql_query = $sql_links->getData($sql_quote);
       	  	  	$sql_links->closeDb();
       	  	  	$payway = $sql_query[0]['payway'];
       	  	  	$pay_mfytime = $sql_query[0]['pay_mfytime'];
       	  	  	echo "<script> document.getElementById('r_num').value = '$num'; </script>";
       	  	  	echo "<script> document.getElementById('r_payway').value = '$payway'; </script>";
       	  	  	echo "<script> document.getElementById('r_pre_time').value = '$pay_mfytime'; </script>";       	  	  	

 	  	    	    for($index=1;$index<=12;$index++) {
 	  	    	   	  $cb_id = "r_paycnt".$index."c";
 	  	    	      $st_id = "r_paycnt".$index."s";
 	  	    	      echo "<script> document.getElementById('$cb_id').disabled = true; </script>";
 	  	    	      echo "<script> document.getElementById('$st_id').disabled = true; </script>";       	  	    	   	
 	  	    	    }
       	  	    switch($payway) {
       	  	    	case "年付": 
       	  	    	   break;
       	  	    	case "半年付":
       	  	    	   $pay_date = $sql_query[0]['pay_t3'];
		 	  	    	     echo "<script> document.getElementById('r_paycnt6c').disabled = false; </script>";
		 	  	    	     echo "<script> document.getElementById('r_paycnt6c').title = '缴费日期:$pay_date'; </script>";
		 	  	    	     if( substr($sql_query[0]['pay_status'],6-1,1) == 'P' ) // P-Payed, U-Unpayed 
		 	  	    	       echo "<script> document.getElementById('r_paycnt6s').value = 'had_payed'; </script>";
		 	  	    	     else
		 	  	    	       echo "<script> document.getElementById('r_paycnt6s').value = 'not_payed'; </script>";
       	  	    	   break;
       	  	    	case "季付": 
       	  	    	   $pay_date2 = $sql_query[0]['pay_t2'];
       	  	    	   $pay_date3 = $sql_query[0]['pay_t3'];
       	  	    	   $pay_date4 = $sql_query[0]['pay_t4'];
       	  	    	   echo "<script> document.getElementById('r_paycnt3c').disabled = false; </script>";
       	  	    	   echo "<script> document.getElementById('r_paycnt6c').disabled = false; </script>";
       	  	    	   echo "<script> document.getElementById('r_paycnt9c').disabled = false; </script>";       	  	    	   
       	  	    	   echo "<script> document.getElementById('r_paycnt3c').title = '缴费日期:$pay_date2'; </script>";
       	  	    	   echo "<script> document.getElementById('r_paycnt6c').title = '缴费日期:$pay_date3'; </script>";
       	  	    	   echo "<script> document.getElementById('r_paycnt9c').title = '缴费日期:$pay_date4'; </script>";
       	  	    	   if( substr($sql_query[0]['pay_status'],3-1,1) == 'P')
		 	  	    	       echo "<script> document.getElementById('r_paycnt3s').value = 'had_payed'; </script>";
		 	  	    	     else
		 	  	    	       echo "<script> document.getElementById('r_paycnt3s').value = 'not_payed'; </script>";       	  	    	        
       	  	    	   if( substr($sql_query[0]['pay_status'],6-1,1) == 'P')
		 	  	    	       echo "<script> document.getElementById('r_paycnt6s').value = 'had_payed'; </script>";
		 	  	    	     else
		 	  	    	       echo "<script> document.getElementById('r_paycnt6s').value = 'not_payed'; </script>";   
       	  	    	   if( substr($sql_query[0]['pay_status'],9-1,1) == 'P')
		 	  	    	       echo "<script> document.getElementById('r_paycnt9s').value = 'had_payed'; </script>";
		 	  	    	     else
		 	  	    	       echo "<script> document.getElementById('r_paycnt9s').value = 'not_payed'; </script>";   
        	  	    	 break;
       	  	    	case "月付":
       	  	    	   date_default_timezone_set('PRC'); // seems to be useless
       	  	    	   $pay_datey = substr($sql_query[0]['start'],0,4);
       	  	    	   $pay_datem = substr($sql_query[0]['start'],5,2);       	  	    	   
       	  	    	   $pay_dated = substr($sql_query[0]['start'],8,2);        	  	    	   
       	  	    	   $pay_date_ts = mktime(0,0,0,$pay_datem,$pay_dated,$pay_datey);
       	  	    	   for($month=1; $month< 12; $month++) {
       	  	    	     $day30_cnt = $month*30;
       	  	    	     $day30_str = "+".$day30_cnt." days";
       	  	    	     $date_ts = strtotime($day30_str,$pay_date_ts);   
       	  	    	   	 $pay_date = date('Y-m-d',$date_ts);
       	  	    	   	 $cb_id = "r_paycnt".$month."c";
       	  	    	   	 $st_id = "r_paycnt".$month."s";
       	  	    	     echo "<script> document.getElementById('$cb_id').disabled = false; </script>";                       
       	  	    	     echo "<script> document.getElementById('$cb_id').title = '缴费日期:$pay_date'; </script>";
	       	  	    	   if( substr($sql_query[0]['pay_status'],$month-1,1) == 'P')
			 	  	    	       echo "<script> document.getElementById('$st_id').value = 'had_payed'; </script>";
			 	  	    	     else
			 	  	    	       echo "<script> document.getElementById('$st_id').value = 'not_payed'; </script>";        	  	    	     
       	  	    	   }
       	  	    	  break;
       	  	    	default: print_alert("未知缴费周期！"); break;	    	
       	  	    }  	  
       	  	  }       	  	
       	  	?>
       	  </table>
          <div id="set_btn" align="center">
  		      <input type="submit" id="setpay_submit" value="修 改" />&nbsp&nbsp&nbsp
  		      <input type="button" id="setpay_cancel" value="取 消" onclick="myCancel()" />
  		      <input type="hidden" id="m_tag" name="m_tag" value="not_mfy" />
  		      <input type="hidden" id="m_num" name="m_num" value="no_num" />
  		      <input type="hidden" id="m_set" name="m_set" value="no_set" />
  		      <input type="hidden" id="m_status" name="m_status" value="no_status" />
          </div>  
          <?php
            if( $_POST['m_tag'] == "do_mfy" ) {
            	$num = $_POST['m_num'];
              $sel_status = $_POST['m_set'];
              $set_status = $_POST['m_status'];
   
              $new_time = date('Y-m-d H:i:s');
//       	  	  echo "<script> document.getElementById('r_num').value = '$num'; </script>";
//       	  	  echo "<script> document.getElementById('r_pre_time').value = '$new_time'; </script>";  	  	  	
              
      	      $sql_links = sqlConnect();
            	$sql_quote = "select * from `zr_roomlist` where `num`='$num'";
            	$sql_query = $sql_links->getData( $sql_quote );
            	$pre_status = $sql_query[0]['pay_status'];
              $status_array = str_split($pre_status); // 拆成字符数组，以便于后续按位修改   
              for($index=1;$index < 12; $index++) {
            		if( substr($sel_status,$index-1,1) == 'S' ) 
            		  $status_array[$index-1] = substr($set_status,$index-1,1);	
            		else if( (substr($set_status,$index-1,1) != 'U' && substr($set_status,$index-1,1) != 'P' ) )
            		  $status_array[$index-1] = 'U';
            		else 
            		  $status_array[$index-1] = 'U';
            	}            	
            	$new_status = implode($status_array);
            	$sql_quot0 = "`pay_status`='$new_status',`pay_mfytime`='$new_time'";
            	$sql_quote = "update `zr_roomlist` set $sql_quot0 where `num`='$num'";
						  $sql_links->runSql($sql_quote);
						  if ($sql_links->errno() != 0) {
						    die("Error:" . $sql_links->errmsg());
						  } 
						  $sql_links->closeDb();   
//						  print_alert("此房缴费状态已经成功修改！");
//						  echo "<script> document.getElementById('q_tag').value = 'not_qry'; </script>";
//						  echo "<script> document.getElementById('m_tag').value = 'not_mfy'; </script>"; 
//						  echo "<script> document.getElementById('m_num').value = 'no_num'; </script>";
//						  echo "<script> document.getElementById('m_set').value = 'no_set'; </script>";
//						  echo "<script> document.getElementById('m_status').value = 'no_status'; </script>";	
						  echo "<script> document.getElementById('r_num').value = 'no_num'; </script>";		
            }
          ?>       
       </form>
	  </div>
	  <hr id="set_hr">
  </div>
</body>