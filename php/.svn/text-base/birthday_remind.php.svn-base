<?php  // function page for user information
  session_start();
  require_once("common.php");  
?>

<html>	
<head>
  <link rel="stylesheet" type="text/css" href="../css/logon.css" />
  <link rel="stylesheet" type="text/css" href="../css/birthday_remind.css" />
  
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
              <span><input type="radio" name="scope" value="scope_fullmonth" checked="checked"/>查询一个月内生日的客人 </span>&nbsp&nbsp&nbsp
              <span><input type="radio" name="scope" value="scope_halfmonth" />查询半个月内生日的客人 </span>&nbsp&nbsp&nbsp
              <span><input type="radio" name="scope" value="scope_fullweek" />查询一周以内生日的客人 </span>&nbsp&nbsp&nbsp
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
	    	 	 	 <th class="t_renter"> 姓 名 </th>
	    	 	 	 <th class="t_sex"> 性 别 </th>
	    	 	 	 <th class="t_age"> 年 龄 </th>
	    	 	 	 <th class="t_birthday"> 生 日 </th>
	    	 	 	 <th class="t_phone"> 手机号 </th>
	    	 	 	 <th class="t_career"> 公司或职业 </th>
	    	 	 	 <th class="t_start"> 起租日 </th>
	    	 	 	 <th class="t_stop"> 退租日 </th>
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
							   foreach( $sql_query as $index=>$record) {
	                 $birthday = substr($record['born'],5);
	                 $age = calcAge($record['born']);
	    				     if( !isInScope($birthday, $qry_scope) ) 
							       continue; 			
							     $record_num = $record['num'];			     
							     if( $record_cnt%2 == 0) // 奇数行
							       echo "<tr class='odd_line' title='房号$record_num'>";
							     else
							       echo "<tr class='even_line' title='房号$record_num'>";
							     $record_cnt = $record_cnt + 1;
							     echo "<td class='t_cnt'>$record_cnt</td>";
							     echo "<td class='t_num'>$record_num</td>";
							     echo "<td class='t_renter'>$record[renter]</td>"; 
							     echo "<td class='t_sex'>$record[sex]</td>";
							     echo "<td class='t_age'>$age</td>"; 
							     echo "<td class='t_birthday'>$birthday </td>"; 
							     echo "<td class='t_phone'>$record[phone]</td>"; 
							     echo "<td class='t_career'>$record[career]</td>"; 
							     echo "<td class='t_start'>$record[start]</td>"; 
							     echo "<td class='t_stop'>$record[stop]</td>";            
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
               $qry_scope = "not_qry";
					   }
					 ?>
					</tbody>
    	 	 </table>    	 	  	 	
    	 </div>
    	 <hr id="rs_sept">
    	 <div id="rs_query_ctrl">   
    		  <input class="rev_btn" type="button" value="功能预留" onclick="" disabled="disabled" />
    		  <input class="rev_btn" type="button" value="功能预留" onclick="" disabled="disabled" />	  
    		  <input class="rev_btn" type="button" value="功能预留" onclick="" disabled="disabled" />    	 	  	 	
    	 </div>
	  </div>	
	</div>
	<div id="footer">	
    <?php  require_once("foot.php");  ?>	
  </div>
</div>
</body>	
</html>