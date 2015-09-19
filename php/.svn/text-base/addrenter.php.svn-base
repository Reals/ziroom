<?php>
  session_start();
  require_once("common.php");
?>

<html>
	
<head>
  <?php 
    require_once("head.php"); // 页面标题信息 
  ?>
  <link rel="stylesheet" type="text/css" href="../css/addrenter.css" />
  <script language='javascript' src="../js/common.js" > </script>
  
  <script language='javascript'>
     function mySubmit() {
     	   var r_num  = document.getElementById("r_num").value;
    	   var r_name = document.getElementById("r_renter").value; 
    	   var r_born = document.getElementById("r_born").value; 
    	   var r_contract = document.getElementById("r_contract").value; 
    	   var r_start = document.getElementById("r_start").value; 
    	   var r_stop = document.getElementById("r_stop").value; 
    	   var r_payway = document.getElementById("r_payway").value;
    	   var r_2date = document.getElementById("r_2date").value; 
    	   var r_3date = document.getElementById("r_3date").value; 
    	   var r_4date = document.getElementById("r_4date").value;  
     	   var r_phone = document.getElementById("r_phone").value; 
     	   if( r_num == "no_num" ) {
     	   	  alert("已无闲置房间，请先增加房间或选择[删除租客]来清空房间内租客入住信息！");
     	   	  return false; 
     	   }
    	   if( r_name == "" ) {alert("客户姓名不能为空！"); return false;}   
         if( isNaN(r_phone) || ( !isNaN(r_phone) && r_phone.length != 11)) {
           alert("您输入的客人手机号有误!");
           return false;	
         }
     	   var r_price = document.getElementById("r_price").value; 
         if( isNaN(r_phone) ) {
           alert("您输入的签约价格有误!");
           return false;	
         } 
     	   var r_elec_ini = document.getElementById("r_elec_ini").value; 
         if( isNaN(r_elec_ini) ) {
           alert("您输入的电表底数有误!");
           return false;	
         } 
         if( r_price == "") {alert("请输入签约价格！"); return false;}
         if( r_elec_ini == "") {alert("请输入电表底数！"); return false;}    
    	   if( r_born == "" ) {alert("客户出生日期不能为空！"); return false;}
    	   if( r_contract == "" ) {alert("合同编号不能为空！"); return false;}
    	   if(r_start == "" ) {alert("租约起始日期不能为空！"); return false;}  
    	   if(r_stop == "" ) {alert("租约结束日期不能为空！"); return false;}  
    	   if( r_payway == "pay_halfyear" && r_3date == "") {
    	     alert("选择缴租方式为半年付时，第3次缴租日期不能为空！");
    	     return false;	
    	   }        
    	   if( r_payway == "pay_season" && ( r_2date == ""
    	      || r_3date == "" || r_4date == "") ) {
    	     alert("选择缴租方式为季付时，后3次缴租日期不能为空！");
    	     return false;   	
    	   }
    	   if( !confirm("您是否确认信息无误？") ) return false;
     	   return true;
     }
     function myCancel() {
         location.href="rent_query.php"; 	
     }     
     function paywayChange(payway) {
         document.getElementById("r_2date").disabled = true;
         document.getElementById("r_3date").disabled = true;
         document.getElementById("r_4date").disabled = true;              	   
         switch(payway)  {
           case "pay_year": break;
           case "pay_month": break;
           case "pay_season":
					         document.getElementById("r_2date").disabled = false;
					         document.getElementById("r_3date").disabled = false;
					         document.getElementById("r_4date").disabled = false; 
					         break;            
           case "pay_halfyear":             
					         document.getElementById("r_3date").disabled = false;
					         break;
         	 default: alert("ERROR PAY WAY HAPPEN!");
         }
     }
  </script>
</head>	

<body onload="paywayChange('pay_year')">
	<div id="set_main" align="center">
	  <h1 id="set_h1" align="center"> 新增租客信息 </h1>
	  <h2 id="set_u"> 当前登陆用户: <?php echo $_SESSION['username']; ?> </h2>
	  <hr id="set_hr">
	  <div id="set_item" align="center">
       <form method="post" onsubmit="return mySubmit()" action="addrenter_confirm.php">
       	  <table>
       	  	<tr>
               <td class="set_t"> 请选择房间号: </td>
               <td>
	       	  	 <?php
							   $sql_links = sqlConnect();
							   $sql_quote = "select `num` from `zr_roomlist` where `status`='闲置中' order by `num`";   
							   $sql_query = $sql_links->getData( $sql_quote );  
								 $sql_links->closeDb();
								 echo "<select id='r_num' name='r_num'>";
								 if( sizeof($sql_query) == 0)  {
								   echo "<option value='no_num'> 无闲置房间 </option>";
								 } else {
								   foreach( $sql_query as $index=>$room_num) {
								   	 $num = $room_num['num'];
								     echo "<option value='$num'> $num </option>";	
								   }	
								 }
	       	  	 ?>
	       	  	</td>	
       	  	</tr>
       	  </table>
       	  <table>
       	  	<tr>
       	  		<td class="set_t"> 客人姓名: </td> 
       	  		<td class="set_p"> <input id="r_renter" type="text" name="r_renter" /> </td>
       	  		<td class="set_t"> 性 别: </td> 
       	  		<td class="set_p"> 
       	  			 <select id="r_sex" name="r_sex">
       	  			   <option value="male"> -- 男 -- </option>	
       	  			   <option value="female"> -- 女 --  </option>
       	  			 </select>
       	  	  </td>
       	  	</tr>
       	  	<tr>
       	  		<td class="set_t"> 出生日期: </td> 
       	  		<td class="set_p"> <input id="r_born" type="date" name="r_born" /> </td>
       	  		<td class="set_t"> 联系电话: </td> 
       	  		<td class="set_p"> <input id="r_phone" type="text" name="r_phone" /> </td>       	  		
       	  	</tr>
            <tr>
       	  		<td class="set_t"> 公司职业: </td> 
       	  		<td class="set_p"> <input id="r_career" type="text" name="r_career" /> </td>   
            </tr> 
       	  	<tr> 
       	  		<td class="set_t"> 合同编号: </td> 
       	  		<td class="set_p"> <input id="r_contract" type="text" name="r_contract" /> </td> 
       	  		<td class="set_t"> 签约价格: </td> 
       	  		<td class="set_p"> <input id="r_price" type="text" name="r_price" /> </td>        	  			
            </tr> 
            <tr>
       	  		<td class="set_t"> 付款方式: </td> 
       	  		<td class="set_p"> 
       	  			 <select id="r_payway" name="r_payway" onchange="paywayChange(this.value)">
       	  			   <option value="pay_year"> -- 年付 -- </option>	
       	  			   <option value="pay_season"> -- 季付 -- </option>
       	  			   <option value="pay_halfyear"> -- 半年付 -- </option>       	  			 
       	  			   <option value="pay_month"> -- 月付 -- </option>
       	  			 </select>
       	  	  </td> 
       	  		<td class="set_t"> 电表底数: </td>
       	  		<td class="set_p"> <input id="r_elec_ini" type="text" name="r_elec_ini" /> </td>
            </tr>
            <tr>
       	  		<td class="set_t"> 起租日期: </td> 
       	  		<td class="set_p"> <input id="r_start" type="date" name="r_start" /> </td>  	
       	  		<td class="set_t"> 合同到期: </td>
       	  		<td class="set_p"> <input id="r_stop" type="date" name="r_stop" /> </td>             	
            </tr>
            <tr>
       	  		<td class="set_t"> 第2次缴租: </td>
       	  		<td class="set_p"> <input id="r_2date" type="date" name="r_2date" /> </td> 
       	  		<td class="set_t"> 备 注: </td> 
       	  		<td class="set_p"> <input id="r_remark" type="text" name="r_remark" /> </td>
       	    </tr>
       	    <tr>
       	  		<td class="set_t"> 第3次缴租: </td>
       	  		<td class="set_p"> <input id="r_3date" type="date" name="r_3date" /> </td>
       	    </tr>
       	    <tr>
       	  		<td class="set_t"> 第4次缴租: </td>
       	  		<td class="set_p"> <input id="r_4date" type="date" name="r_4date" /> </td>  
       	  		<td class="set_t" colspan="2"><span>本页信息一旦设置后不可随意修改，请确认后填写！</span></td>      	    	
       	    </tr>      	 
          </table>  
          <div id="set_btn" align="center">
  		      <input type="submit" id="addrenter_submit" value="新&nbsp增" />&nbsp&nbsp&nbsp
  		      <input type="button" id="addrenter_cancel" value="取&nbsp消" onclick="myCancel()" />        	 
          </div>         
       </form>
	  </div>
	  <hr id="set_hr">
  </div>
</body>