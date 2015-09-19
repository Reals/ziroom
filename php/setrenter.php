<?php>
  session_start();
  require_once("common.php");
?>

<html>
	
<head>
  <?php 
    require_once("head.php"); // ҳ�������Ϣ 
  ?>
  <link rel="stylesheet" type="text/css" href="../css/setrenter.css" />
  <script language='javascript' src="../js/common.js" > </script>
  
  <script language='javascript'>
     function myQuery() {
         document.getElementById("q_tag").value = "do_qry";
         return true;	
     }
     function mySubmit() {
    	   var r_name = document.getElementById("r_renter").value; 
    	   var r_born = document.getElementById("r_born").value; 
     	   var r_phone = document.getElementById("r_phone").value; 
     	   
    	   if( r_name == "" ) {alert("�ͻ���������Ϊ�գ�"); return false;}            
         if( isNaN(r_phone) || ( !isNaN(r_phone) && r_phone.length != 11)) {
           alert("������Ŀ����ֻ�������!");
           return false;	
         }
    	   if( r_born == "" ) {alert("�ͻ��������ڲ���Ϊ�գ�"); return false;}
    	   document.getElementById("m_tag").value = "do_mfy";
    	   document.getElementById("m_num").value = document.getElementById("r_num").value;
     	   return true;
     }
     function myCancel() {
         location.href="rent_query.php"; 	
     }     
  </script>
</head>	

<body">
	<div id="set_main" align="center">
	  <h1 id="set_h1" align="center"> �޸������Ϣ </h1>
	  <h2 id="set_u"> ��ǰ��½�û�: <?php echo $_SESSION['username']; ?> </h2>
	  <hr id="set_hr">
	  <div id="set_item" align="center">
       <form method="post" onsubmit="return myQuery()" action="">
       	  <table>
       	  	<tr>
               <td class="set_t" id="sel_num"> ��ѡ����˷����: </td>
               <td>
	       	  	 <?php
							   $sql_links = sqlConnect();
							   $sql_quote = "select `num` from `zr_roomlist` where `status`='�ѳ���'";   
							   $sql_query = $sql_links->getData( $sql_quote );  
								 $sql_links->closeDb();
								 echo "<select id='r_num' name='r_num'>";
								 if( sizeof($sql_query) == 0)  {
								   echo "<option value='no_num' title='�޷�����Ϣ'> �޷��� </option>";
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
 	       	  		<input type="submit" id="r_qry" name="r_qry" value="�� ѯ" />
 	       	  		<input type="hidden" id="q_tag" name="q_tag" value="not_qry" />
	       	  	</td>
       	  	</tr>
       	  </table>
       </form>
       <form method="post" onsubmit="return mySubmit()" action="">
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
       	  		<input id="m_tag" type="hidden" name="m_tag" value="not_mfy" /> 
       	  		<input id="m_num" type="hidden" name="m_num" value="no_num" />
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
  
  <?php 
     echo "<script> document.getElementById('r_contract').disabled = true;</script>";
     echo "<script> document.getElementById('r_price').disabled = true;</script>";
     echo "<script> document.getElementById('r_payway').disabled = true;</script>";    
     echo "<script> document.getElementById('r_elec_ini').disabled = true;</script>"; 
     echo "<script> document.getElementById('r_start').disabled = true;</script>"; 
     echo "<script> document.getElementById('r_stop').disabled = true;</script>";  
     echo "<script> document.getElementById('r_2date').disabled = true;</script>";                 
     echo "<script> document.getElementById('r_3date').disabled = true;</script>"; 
     echo "<script> document.getElementById('r_4date').disabled = true;</script>"; 
     if( $_POST['q_tag'] == "do_qry" ) { // ������ѡ�񷿺���ʾ��ѯ���
     	 $num = $_POST['r_num'];
		   $sql_links = sqlConnect();
		   $sql_quote = "select * from `zr_roomlist` where `num`='$num'";   
		   $sql_query = $sql_links->getData( $sql_quote );  
			 $sql_links->closeDb();     	 
			 $renter = $sql_query[0]['renter'];
			 $sex = select_sex($sql_query[0]['sex']);
			 $born = $sql_query[0]['born'];
			 $phone = $sql_query[0]['phone'];
			 $career = $sql_query[0]['career'];
			 $contract = $sql_query[0]['contract'];
			 $price = $sql_query[0]['price'];
			 $payway = select_payway($sql_query[0]['payway']);
			 $elec_ini = $sql_query[0]['elec_ini_amount'];
			 $start = $sql_query[0]['start'];
			 $stop = $sql_query[0]['stop'];
			 $r_2date = $sql_query[0]['pay_t2'];
			 $r_3date = $sql_query[0]['pay_t3'];
			 $r_4date = $sql_query[0]['pay_t4'];
			 $remark = $sql_query[0]['remark'];
			 echo "<script> document.getElementById('r_renter').value = '$renter'; </script>";
			 echo "<script> document.getElementById('r_sex').value = '$sex'; </script>";
			 echo "<script> document.getElementById('r_born').value = '$born'; </script>";
			 echo "<script> document.getElementById('r_phone').value = '$phone'; </script>";
			 echo "<script> document.getElementById('r_career').value = '$career'; </script>";
			 echo "<script> document.getElementById('r_contract').value = '$contract'; </script>";
			 echo "<script> document.getElementById('r_price').value = '$price'; </script>";
			 echo "<script> document.getElementById('r_payway').value = '$payway'; </script>";
			 echo "<script> document.getElementById('r_elec_ini').value = '$elec_ini'; </script>";
			 echo "<script> document.getElementById('r_start').value = '$start'; </script>";
			 echo "<script> document.getElementById('r_stop').value = '$stop'; </script>";
			 echo "<script> document.getElementById('r_2date').value = '$r_2date'; </script>";
			 echo "<script> document.getElementById('r_3date').value = '$r_3date'; </script>";
			 echo "<script> document.getElementById('r_4date').value = '$r_4date'; </script>";			 
			 echo "<script> document.getElementById('r_remark').value = '$remark'; </script>";  
			 echo "<script> document.getElementById('r_num').value = '$num'; </script>";   
     }
     if( $_POST['m_tag'] == "do_mfy" ) { // ���޸ĺ����Ϣ���µ����ݿ�
     	 $renter = $_POST['r_renter'];
     	 $num = $_POST['m_num'];
     	 $sex = $_POST['r_sex'];
     	 $born = $_POST['r_born'];
     	 $phone = $_POST['r_phone'];
     	 $career = $_POST['r_career'];
     	 $remark = $_POST['r_remark'];
     	 $sex = print_sex($sex);
		   $sql_links = sqlConnect();
		   $sql_update= "`renter`='$renter',`sex`='$sex',`born`='$born',`phone`='$phone',`career`='$career',`remark`='$remark'";
			 $sql_quote = "update `zr_roomlist` set $sql_update where `zr_roomlist`.`num`='$num'";
			 $sql_links->runSql($sql_quote);
			 if ($sql_links->errno() != 0) {
			    die("Error:" . $sql_links->errmsg());
			 } 
			 $sql_links->closeDb();	     
	     print_alert("������Ϣ�޸ĳɹ���");
	     echo "<script> document.getElementById('r_num').value = '$num'; </script>";     	 
     }  
  ?>
</body>