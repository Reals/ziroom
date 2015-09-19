<?php  // function page for user information
  session_start();
  require_once("common.php");  
?>

<html>	
<head>
  <link rel="stylesheet" type="text/css" href="../css/logon.css" />
  <link rel="stylesheet" type="text/css" href="../css/payment_remind.css" />
  
  <?php 
     require_once("head.php"); // 页面标题信息
  ?> 

  <script language='javascript' src='../js/common.js'> </script>
  <script language='javascript'>
     function querySubmit() {
         var scope = document.getElementsByName("scope");
         if( scope.length != 3) {
           alert("SOME ERROR HAPPEN: RADIO COUNT");
           return false;	
         }         
         if( scope[0].checked ) 
           document.getElementById("qry_tag").value = scope[0].value;
         else if( scope[1].checked ) 
         	 document.getElementById("qry_tag").value = scope[1].value;
         else if( scope[2].checked )
         	 document.getElementById("qry_tag").value = scope[2].value;
         else 
         	 alert("UNKNOW ERROR: RADIO OVERSCOPE!");
         return true;
     }
     function myConfirm() {
//     	   var cfm = document.createElement("DIV");
//     	   cfm.id = "confirm";
//     	   cfm.style.position = "absolute";
//     	   cfm.style.left = "0px";
//     	   cfm.style.top = "0px";
//     	   cfm.style.width = "100%";
//     	   cfm.style.height = document.body.scrollHeight+"px";
//     	   cfm.style.background = "white"; //rgb(0,120,216)";
//         cfm.style.top = "200px";
//         cfm.style.left = "300px";
//         cfm.style.right = "300px";
//         cfm.style.bottom = "200px";
//         cfm.style.borderStyle = "solid";
//         cfm.style.borderWidth = "thin";
//         cfm.style.borderColor = "white";
//     	   cfm.style.textAlign = "center";
//     	   cfm.style.filter = "alpha(opacity=90)";
//     	   cfm.style.opacity = 0.8;
//     	   var in_str = "请输入缴费状态修改授权密码：<br><input type='password' name='auth_pwd' id='auth_pwd' /><br>";
//         in_str += "<input type='button' value='确 定' id='cfm_submit' onclick='cfm_submit()' />&nbsp&nbsp";
//         in_str += "<input type='button' value='取 消' id='cfm_cancel' onclick='cfm_cancel()' />";
//     	   cfm.innerHTML = in_str;
//     	   document.body.appendChild(cfm);
         var mfy_pwd = prompt("请输入缴费状态修改授权密码：","password");	
         if( mfy_pwd == "authority" ) {
         	 location.href = "setpayment.php" ;
         } else {
           alert("您输入的授权密码不正确，无法修改租户缴费状态！");
         }                  
     }
  </script>
</head>	

<body>
	
<!-- 外框架 -->
<div id="framework">
	<div id="header"> 		
    <?php  require_once("page_title.php");  ?> 
  </div>
	<div id="main">
    <?php  require_once("logon_base.php");  ?>
    <div id="inf_main"> 
    	 <div id="rs_query_cond">   
          <form name="query" method="post" action="" onsubmit="return querySubmit()">        	 
    	    	<div id="rs_query_cond_top">    	    	
              <span><input type="radio" name="scope" value="scope_fullmonth" checked="checked"/>查询一个月内需缴租客人 </span>&nbsp&nbsp&nbsp
              <span><input type="radio" name="scope" value="scope_halfmonth" />查询半个月内需缴租客人 </span>&nbsp&nbsp&nbsp
              <span><input type="radio" name="scope" value="scope_fullweek" />查询一周以内需缴租客人 </span>&nbsp&nbsp&nbsp
              <span class="r_item"> <input type="submit" id="r_query" value="查 询" /> </span>
              <input type="hidden" id="qry_tag" name="qry_tag" value="not_qry" />
    	 	    </div>
          </form>
    	 </div>
    	 <hr id="rs_sept">
    	 <div id="rs_query_list">
    	 	 <table id="qry_list" cellspacing="0" cellpadding="0">
    	 	 	 <thead>
    	 	 	 	 <th class="t_cnt"> 序 号 </th>
	    	 	 	 <th class="t_num"> 房间号 </th>
	    	 	 	 <th class="t_price"> 价 格 </th>
	    	 	 	 <th class="t_payway"> 缴费周期 </th>
	    	 	 	 <th class="t_start"> 应缴日 </th>
	    	 	 	 <th class="t_price"> 应缴额 </th>
	    	 	 	 <th class="t_payway"> 缴费状态 </th>
	    	 	 	 <th class="t_paytime"> 缴纳时间 </th> 
	    	 	 	 <th class="t_start"> 起租日 </th>
	    	 	 	 <th class="t_stop"> 退租日 </th>
	    	 	 	 <th class="t_payway"> 历史欠缴 </th>
      	 	 	 <th class="t_remark"> 备 注 </th>
    	 	   </thead>
    	 	 	 <tbody>    	 	 	 	
    	 	 	 <?php
    	 	 	   $qry_scope = $_POST['qry_tag'];
             if( $qry_scope == "scope_fullmonth" || $qry_scope == "scope_halfmonth"
              || $qry_scope == "scope_fullweek" ) {
						   $sql_links = sqlConnect();
						   $sql_quote = "select * from `zr_roomlist` where `status`='已出租' order by `num`";   
						   $sql_query = $sql_links->getData( $sql_quote );  
							 $sql_links->closeDb();  
						   if( sizeof($sql_query) == 0) {
                 echo "<tr><td id='no_record' colspan='9'>没有找到任何记录！</td></tr>";
						   } else {
							   $record_cnt = 0; 		
							   switch( $qry_scope ) {
							     case "scope_fullmonth": $end_date = date('Y-m-d', strtotime('+30 days')); break;
							     case "scope_halfmonth": $end_date = date('Y-m-d', strtotime('+15 days')); break;
							     case "scope_fullweek": $end_date = date('Y-m-d', strtotime('+7 days')); break;	
							   }
							   $this_date = calcTimestamp(date('Y-m-d')); // 计算当前日期的时间戳
							   $end_date = calcTimestamp($end_date);      // 计算所选范围最后一天的时间戳
							   foreach( $sql_query as $index=>$record) {
							   	 $isOutScope = true;		   
							   	 switch($record['payway']) {
							   	   case "年付": $isOutScope = true; break;	
							   	 	 case "半年付": 
							   	 	   $pay_date = $record['pay_t3'];
							   	 	   $pay_date_ts = calcTimestamp($pay_date);
							   	 	   $isOutScope = !(($pay_date_ts >= $this_date) && ($pay_date_ts <= $end_date));
							   	 	   $pay_amount = $record['price']*6; // 半年付，按6个月算
							   	 	   $pay_status = ( substr($record['pay_status'],6-1,1) == 'P' ) ? "已缴" : "欠缴";
							   	 	   $pay_time = ( substr($record['pay_status'],6-1,1) == 'P' ) ? $record['pay_mfytime'] : "";
							   	 	   $pay_history = "无欠缴";
	 					   	 	     break;
							   	 	 case "季付": 
							   	 	   $pay_date2 = $record['pay_t2'];
							   	 	   $pay_date3 = $record['pay_t3'];
							   	 	   $pay_date4 = $record['pay_t4'];
							   	 	   $pay_date2_ts = calcTimestamp($pay_date2);
							   	 	   $pay_date3_ts = calcTimestamp($pay_date3);
							   	 	   $pay_date4_ts = calcTimestamp($pay_date4);
							   	 	   $pay_hit_cnt = 0;
							   	 	   if( ($pay_date2_ts >= $this_date) && ($pay_date2_ts <= $end_date)) $pay_hit_cnt = 3;
							   	 	   else if( ($pay_date3_ts >= $this_date) && ($pay_date3_ts <= $end_date)) $pay_hit_cnt = 6;
							   	 	   else if( ($pay_date4_ts >= $this_date) && ($pay_date4_ts <= $end_date)) $pay_hit_cnt = 9;
							   	 	   $isOutScope = ($pay_hit_cnt == 0);
							   	 	   $pay_date = ($pay_hit_cnt == 3) ? $record['pay_t2'] : (($pay_hit_cnt == 6) ? $record['pay_t3'] : $record['pay_t4']);
							   	 	   $pay_amount = $record['price']*3; // 季付，按3个月算
							   	 	   $pay_status = ( substr($record['pay_status'],$pay_hit_cnt-1,1) == 'P' ) ? "已缴" : "欠缴";
							   	 	   $pay_time = ( substr($record['pay_status'],$pay_hit_cnt-1,1) == 'P' ) ? $record['pay_mfytime'] : "";
							   	 	   if( $pay_hit_cnt == 3) 
							   	 	     $pay_history = "无欠缴";
							   	 	   else if( $pay_hit_cnt == 6) 
							   	 	     $pay_history = ( substr($record['pay_status'],3-1,1) != 'P' ) ? "有欠缴" : "无欠缴"; 
							   	 	   else if( $pay_hit_cnt == 9)
							   	 	     $pay_history = ( substr($record['pay_status'],3-1,1) != 'P' || substr($record['pay_status'],6-1,1) != 'P') ? "有欠缴" : "无欠缴";
							   	 	   break;
							   	 	 case "月付":
							   	 	   $pay_hit_cnt = 0;
							   	 	   $pay_date_ts = calcTimestamp($record['start']);
							   	 	   for($month=1;$month < 12; $month++) {
	       	  	    	     $day30_cnt = $month*30;
	       	  	    	     $day30_str = "+".$day30_cnt." days";
	       	  	    	     $date_ts = strtotime($day30_str,$pay_date_ts);
	                       if( ($date_ts >= $this_date) && ($date_ts <= $end_date)) {
	                         $pay_hit_cnt = $month;
	                         break;	
	                       } 
							   	 	   }
							   	 	   $isOutScope = ($pay_hit_cnt == 0); 
							   	 	   $pay_date = date('Y-m-d', $date_ts);
							   	 	   $pay_amount = $record['price']*1; // 月付，按1个月算
							   	 	   $pay_status = ( substr($record['pay_status'],$pay_hit_cnt-1,1) == 'P')  ? "已缴" : "欠缴";
							   	 	   $pay_time = ( substr($record['pay_status'],$pay_hit_cnt-1,1) == 'P' ) ? $record['pay_mfytime'] : "";
							   	 	   for($month=1;$month < $pay_hit_cnt; $month++) {
							   	 	     if( substr($record['pay_status'],$month-1,1) != 'P' ) {
							   	 	       $pay_history = "有欠缴";	
							   	 	       break;
							   	 	     }
							   	 	   }
							   	 	   if( $pay_history == "" ) $pay_history = "无欠缴";
							   	 	   break;
							   	 	 default: break;
							   	 }
							   	
		               if( $isOutScope ) continue;	               
							     $record_num = $record['num'];			     
							     if( $record_cnt%2 == 0) // 奇数行
							       echo "<tr class='odd_line' title='房号$record_num'>";
							     else
							       echo "<tr class='even_line' title='房号$record_num'>";
							     $record_cnt = $record_cnt + 1;							     			     
							     echo "<td class='t_cnt'>$record_cnt</td>";
							     echo "<td class='t_num'>$record_num</td>";
							     echo "<td class='t_price'>$record[price]</td>";
							     echo "<td class='t_payway'>$record[payway]</td>";  
							     echo "<td class='t_start'>$pay_date</td>";
							     echo "<td class='t_price'>$pay_amount</td>";
							     if( $pay_status == "欠缴" )
							       echo "<td class='t_payway' style='color:red'><b>$pay_status</b></td>";						     
							     else
							       echo "<td class='t_payway'>$pay_status</td>";
							     echo "<td class='t_paytime'>$pay_time</td>";
							     echo "<td class='t_start'>$record[start]</td>"; 
							     echo "<td class='t_stop'>$record[stop]</td>";
							     if( $pay_history == "有欠缴" )
							       echo "<td class='t_payway' style='color:red'>$pay_history</td>";
							     else
							       echo "<td class='t_payway'>$pay_history</td>";					     
							     echo "<td class='t_remark'>$record[remark]</td>";
							     echo "</tr>";			     						      
							   }									   
	               if( $record_cnt == 0)  
	                 echo "<tr><td id='no_record' colspan='9'>没有找到任何记录！</td></tr>";						   
							   switch($qry_scope) {
							     case "scope_fullmonth":
							       echo "<script> document.getElementsByName('scope')[0].checked = true ;</script>";	
							       break;						        
							     case "scope_halfmonth":
							       echo "<script> document.getElementsByName('scope')[1].checked = true ;</script>";	
							       break;
							     case "scope_fullweek":	
							       echo "<script> document.getElementsByName('scope')[2].checked = true ;</script>";
							       break;
								 }	
							 }
							}
		         $qry_scope = "not_qry";
					   echo "<script> document.getElementById('qry_tag').value = 'not_qry'; </script>";
					 ?>
					</tbody>
    	 	 </table>    	 	  	 	
    	 </div>
    	 <hr id="rs_sept">
    	 <div id="rs_query_ctrl">   
    		  <input class="rev_btn" type="button" value="修改缴租状态" onclick="myConfirm()" />
    		  <input class="rev_btn" type="button" value="功能预留" onclick="location.href='#'" disabled="disabled" />	  
    		  <input class="rev_btn" type="button" value="功能预留" onclick="location.href='#'" disabled="disabled" />    	 	  	 	
    	 </div>
	  </div>	
	</div>
	<div id="footer">	
    <?php  require_once("foot.php");  ?>	
  </div>
</div>
</body>	
</html>