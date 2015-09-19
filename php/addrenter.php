<?php>
  session_start();
  require_once("common.php");
?>

<html>
	
<head>
  <?php 
    require_once("head.php"); // ҳ�������Ϣ 
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
     	   	  alert("�������÷��䣬�������ӷ����ѡ��[ɾ�����]����շ����������ס��Ϣ��");
     	   	  return false; 
     	   }
    	   if( r_name == "" ) {alert("�ͻ���������Ϊ�գ�"); return false;}   
         if( isNaN(r_phone) || ( !isNaN(r_phone) && r_phone.length != 11)) {
           alert("������Ŀ����ֻ�������!");
           return false;	
         }
     	   var r_price = document.getElementById("r_price").value; 
         if( isNaN(r_phone) ) {
           alert("�������ǩԼ�۸�����!");
           return false;	
         } 
     	   var r_elec_ini = document.getElementById("r_elec_ini").value; 
         if( isNaN(r_elec_ini) ) {
           alert("������ĵ���������!");
           return false;	
         } 
         if( r_price == "") {alert("������ǩԼ�۸�"); return false;}
         if( r_elec_ini == "") {alert("�������������"); return false;}    
    	   if( r_born == "" ) {alert("�ͻ��������ڲ���Ϊ�գ�"); return false;}
    	   if( r_contract == "" ) {alert("��ͬ��Ų���Ϊ�գ�"); return false;}
    	   if(r_start == "" ) {alert("��Լ��ʼ���ڲ���Ϊ�գ�"); return false;}  
    	   if(r_stop == "" ) {alert("��Լ�������ڲ���Ϊ�գ�"); return false;}  
    	   if( r_payway == "pay_halfyear" && r_3date == "") {
    	     alert("ѡ����ⷽʽΪ���긶ʱ����3�ν������ڲ���Ϊ�գ�");
    	     return false;	
    	   }        
    	   if( r_payway == "pay_season" && ( r_2date == ""
    	      || r_3date == "" || r_4date == "") ) {
    	     alert("ѡ����ⷽʽΪ����ʱ����3�ν������ڲ���Ϊ�գ�");
    	     return false;   	
    	   }
    	   if( !confirm("���Ƿ�ȷ����Ϣ����") ) return false;
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
	  <h1 id="set_h1" align="center"> ���������Ϣ </h1>
	  <h2 id="set_u"> ��ǰ��½�û�: <?php echo $_SESSION['username']; ?> </h2>
	  <hr id="set_hr">
	  <div id="set_item" align="center">
       <form method="post" onsubmit="return mySubmit()" action="addrenter_confirm.php">
       	  <table>
       	  	<tr>
               <td class="set_t"> ��ѡ�񷿼��: </td>
               <td>
	       	  	 <?php
							   $sql_links = sqlConnect();
							   $sql_quote = "select `num` from `zr_roomlist` where `status`='������' order by `num`";   
							   $sql_query = $sql_links->getData( $sql_quote );  
								 $sql_links->closeDb();
								 echo "<select id='r_num' name='r_num'>";
								 if( sizeof($sql_query) == 0)  {
								   echo "<option value='no_num'> �����÷��� </option>";
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
       	  		<td class="set_t"> ��������: </td> 
       	  		<td class="set_p"> <input id="r_renter" type="text" name="r_renter" /> </td>
       	  		<td class="set_t"> �� ��: </td> 
       	  		<td class="set_p"> 
       	  			 <select id="r_sex" name="r_sex">
       	  			   <option value="male"> -- �� -- </option>	
       	  			   <option value="female"> -- Ů --  </option>
       	  			 </select>
       	  	  </td>
       	  	</tr>
       	  	<tr>
       	  		<td class="set_t"> ��������: </td> 
       	  		<td class="set_p"> <input id="r_born" type="date" name="r_born" /> </td>
       	  		<td class="set_t"> ��ϵ�绰: </td> 
       	  		<td class="set_p"> <input id="r_phone" type="text" name="r_phone" /> </td>       	  		
       	  	</tr>
            <tr>
       	  		<td class="set_t"> ��˾ְҵ: </td> 
       	  		<td class="set_p"> <input id="r_career" type="text" name="r_career" /> </td>   
            </tr> 
       	  	<tr> 
       	  		<td class="set_t"> ��ͬ���: </td> 
       	  		<td class="set_p"> <input id="r_contract" type="text" name="r_contract" /> </td> 
       	  		<td class="set_t"> ǩԼ�۸�: </td> 
       	  		<td class="set_p"> <input id="r_price" type="text" name="r_price" /> </td>        	  			
            </tr> 
            <tr>
       	  		<td class="set_t"> ���ʽ: </td> 
       	  		<td class="set_p"> 
       	  			 <select id="r_payway" name="r_payway" onchange="paywayChange(this.value)">
       	  			   <option value="pay_year"> -- �긶 -- </option>	
       	  			   <option value="pay_season"> -- ���� -- </option>
       	  			   <option value="pay_halfyear"> -- ���긶 -- </option>       	  			 
       	  			   <option value="pay_month"> -- �¸� -- </option>
       	  			 </select>
       	  	  </td> 
       	  		<td class="set_t"> ������: </td>
       	  		<td class="set_p"> <input id="r_elec_ini" type="text" name="r_elec_ini" /> </td>
            </tr>
            <tr>
       	  		<td class="set_t"> ��������: </td> 
       	  		<td class="set_p"> <input id="r_start" type="date" name="r_start" /> </td>  	
       	  		<td class="set_t"> ��ͬ����: </td>
       	  		<td class="set_p"> <input id="r_stop" type="date" name="r_stop" /> </td>             	
            </tr>
            <tr>
       	  		<td class="set_t"> ��2�ν���: </td>
       	  		<td class="set_p"> <input id="r_2date" type="date" name="r_2date" /> </td> 
       	  		<td class="set_t"> �� ע: </td> 
       	  		<td class="set_p"> <input id="r_remark" type="text" name="r_remark" /> </td>
       	    </tr>
       	    <tr>
       	  		<td class="set_t"> ��3�ν���: </td>
       	  		<td class="set_p"> <input id="r_3date" type="date" name="r_3date" /> </td>
       	    </tr>
       	    <tr>
       	  		<td class="set_t"> ��4�ν���: </td>
       	  		<td class="set_p"> <input id="r_4date" type="date" name="r_4date" /> </td>  
       	  		<td class="set_t" colspan="2"><span>��ҳ��Ϣһ�����ú󲻿������޸ģ���ȷ�Ϻ���д��</span></td>      	    	
       	    </tr>      	 
          </table>  
          <div id="set_btn" align="center">
  		      <input type="submit" id="addrenter_submit" value="��&nbsp��" />&nbsp&nbsp&nbsp
  		      <input type="button" id="addrenter_cancel" value="ȡ&nbsp��" onclick="myCancel()" />        	 
          </div>         
       </form>
	  </div>
	  <hr id="set_hr">
  </div>
</body>