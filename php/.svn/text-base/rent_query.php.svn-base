<?php  // function page for user information
  session_start();
  require_once("common.php");  
?>

<html>	
<head>
  <link rel="stylesheet" type="text/css" href="../css/logon.css" />
  <link rel="stylesheet" type="text/css" href="../css/rent_query.css" />
  
  <?php 
     require_once("head.php"); // 页面标题信息
  ?> 

  <script language='javascript' src='../js/common.js'> </script>
  <script language='javascript'>
     function querySubmit() {
     	   var r_num = document.getElementById("r_num").value;
     	   var r_phone = document.getElementById("r_phone").value;
     	   if( r_num != "" && ( isNaN(r_num) || r_num <=0 ) ) {
     	   	  alert("您输入的房间号有误，不能包含非数字字符且只可为正整数！");
     	   	  return false;
     	   }
     	   if( r_phone != "" && ( isNaN(r_phone) || r_phone <=0 ) ) {
     	   	  alert("您输入的手机号格式有误！");
     	   	  return false;
     	   }
     	   if( r_phone.length != 11 && r_phone !="" ) {
     	      alert("您输入的手机号长度错误！");
     	      return false;	
     	   }     	   
         document.getElementById("qry_tag").value = "do_qry";
         return true;	
     } 	
     function queryReset() {
     	   document.getElementById("r_num").value = "";
     	   document.getElementById("r_renter").value = "";
     	   document.getElementById("r_phone").value = "";
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
              <span class="r_item">房间号:</span> <span> <input type="text" id="r_num" name="r_num" />  </span>
              <span class="r_item">客人姓名:</span> <span> <input type="text" id="r_renter" name="r_renter" /> </span>
              <span class="r_item">手机号:</span> <span> <input type="text" id="r_phone" name="r_phone" /> </span>
          	  <span class="r_item"><input type="submit" name="r_query" id="r_query" value="查 询" /></span>
          	  <span class="r_item"><input type="button" name="r_reset" id="r_reset" value="重 置" onclick="queryReset()" /></span>
          	  <span class="r_item"><input type="hidden" name="qry_tag" id="qry_tag" value="not_qry"/> </span>
    	 	    </div>  
          </form>
    	 </div>   	 	 
    	 <hr id="rs_sept">
    	 <div id="rs_query_list">  
    	 	 <table id="qry_list" cellspacing="0" cellpadding="0">
    	 	 	 <thead>
    	 	 	 	 <th class="t_cnt"> 序 号 </th>
	    	 	 	 <th class="t_num"> 房间号 </th>
	    	 	 	 <th class="t_contract"> 合同号 </th>
	    	 	 	 <th class="t_renter"> 姓 名 </th>
	    	 	 	 <th class="t_sex"> 性 别 </th>
	    	 	 	 <th class="t_born"> 出生日期 </th>
	    	 	 	 <th class="t_phone"> 手机号 </th>
	    	 	 	 <th class="t_career"> 公司或职业 </th>
	    	 	 	 <th class="t_payway"> 缴费周期 </th>
	    	 	 	 <th class="t_price"> 价 格 </th>
	    	 	 	 <th class="t_start"> 起租日 </th>
	    	 	 	 <th class="t_stop"> 退租日 </th>
	    	 	 	 <th class="t_paytime"> 第2次缴租日 </th>
	    	 	 	 <th class="t_paytime"> 第3次缴租日 </th>
	    	 	 	 <th class="t_paytime"> 第4次缴租日 </th>
	    	 	   <th class="t_elec"> 初始电量 </th>      
	    	 	   <th class="t_elec"> 当前电量 </th>
	    	 	   <th class="t_elec_t"> 电量更新时间 </th>
	    	 	 	 <th class="t_remark"> 备 注 </th>
    	 	   </thead>
    	 	 	 <tbody>    	 	 	 	
    	 	 	 <?php
					   if( $_POST['qry_tag'] == "do_qry" ) {
					   	 $num = $_POST['r_num'];
					   	 $renter = $_POST['r_renter'];
					   	 $phone = $_POST['r_phone'];
					     echo "<script>document.getElementById('r_num').value='$num';</script>"; //使检索条件保持显示
					     echo "<script>document.getElementById('r_renter').value='$renter';</script>"; //使检索条件保持显示
					     echo "<script>document.getElementById('r_phone').value='$phone';</script>"; //使检索条件保持显示

						   // 确定作为关键字的条件
						   if ( !empty($num) )
						     $cond = "where `zr_roomlist`.`num`='$num' and ";
						   else if ( !empty($renter) )
						     $cond = "where `zr_roomlist`.`renter`='$renter' and ";
						   else if ( !empty($phone) )
						     $cond = "where `zr_roomlist`.`phone`='$phone' and ";
						   else
						     $cond = "where ";
						   $sql_links = sqlConnect();
						   $sql_quote = "select * from `zr_roomlist` $cond `status`='已出租' order by `num`";   
						   $sql_query = $sql_links->getData( $sql_quote );  
							 $sql_links->closeDb();  
						   if( sizeof($sql_query) == 0) {
                 echo "<tr><td id='no_record' colspan='9'>没有找到任何记录！</td></tr>";
						   } else {
							   foreach( $sql_query as $index=>$record) {
							   	 $num = $record['num'];
							     if( $index%2 == 0) // 奇数行
							       echo "<tr class='odd_line' title='房号$num'>";
							     else 
							       echo "<tr class='even_line' title='房号$num'>";
							     $cnt = $index + 1;
							     echo "<td class='t_cnt'>$cnt</td>";
							     echo "<td class='t_num'>$num</td>";
							     echo "<td class='t_contract'>$record[contract]</td>"; 
							     echo "<td class='t_renter'>$record[renter]</td>"; 
							     echo "<td class='t_sex'>$record[sex]</td>";
							     if( $record['born'] == "0000-00-00" )
							       echo "<td class='t_born'></td>"; 
							     else 
							       echo "<td class='t_born'>$record[born]</td>"; 
							     echo "<td class='t_phone'>$record[phone]</td>"; 
							     echo "<td class='t_career'>$record[career]</td>"; 
							     echo "<td class='t_payway'>$record[payway]</td>"; 
							     echo "<td class='t_price'>$record[price]</td>"; 
							     echo "<td class='t_start'>$record[start]</td>"; 
							     echo "<td class='t_stop'>$record[stop]</td>"; 
							     if( $record['pay_t2'] == "0000-00-00")
							       echo "<td class='t_paytime'></td>";
							     else 
							       echo "<td class='t_paytime'>$record[pay_t2]</td>"; 						     
							     if( $record['pay_t3'] == "0000-00-00")
							       echo "<td class='t_paytime'></td>";
							     else 
							       echo "<td class='t_paytime'>$record[pay_t3]</td>";	
							     if( $record['pay_t4'] == "0000-00-00")
							       echo "<td class='t_paytime'></td>";
							     else 
							       echo "<td class='t_paytime'>$record[pay_t4]</td>";		
	   	             echo "<td class='t_elec'>$record[elec_ini_amount]</td>"; 
	   	             echo "<td class='t_elec'>$record[elec_cur_amount]</td>";
	   	             if( $record['elec_mfy_time'] == "0000-00-00 00:00:00") 
							       echo "<td class='t_elec_t'></td>";	
	   	             else
							       echo "<td class='t_elec_t'>$record[elec_mfy_time]</td>";	   	             
							     echo "<td class='t_remark'>$record[remark]</td>";
							     echo "</tr>";			     						      
							   }
							 }			     
					   }
					 ?>
					</tbody>
    	 	 </table>    	 	  	 	
    	 </div>
    	 <hr id="rs_sept">
    	 <div id="rs_query_ctrl">   
    		  <input class="rev_btn" type="button" value="新增租客" onclick="location.href='addrenter.php'" />
    		  <input class="rev_btn" type="button" value="删除租客" onclick="location.href='delrenter.php'" />	  
    		  <input class="rev_btn" type="button" value="资料修改" onclick="location.href='setrenter.php'" />    	 	  	 	
    	 </div>
	  </div>	
	</div>
	<div id="footer">	
    <?php  require_once("foot.php");  ?>	
  </div>
</div>
</body>	
</html>