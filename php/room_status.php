<?php  // function page for user information
  session_start();
  require_once("common.php");  
?>

<html>	
<head>
  <link rel="stylesheet" type="text/css" href="../css/logon.css" />
  <link rel="stylesheet" type="text/css" href="../css/room_status.css" />
  
  <?php 
     require_once("head.php"); // ҳ�������Ϣ
  ?> 

  <script language='javascript' src="../js/common.js" > </script>
  <script language='javascript'>
     function querySubmit() {
     	   var r_num = document.getElementById("r_num").value;
     	   if( r_num != "" && ( isNaN(r_num) || r_num <=0 ) ) {
     	   	  alert("������ķ�������󣬲��ܰ����������ַ���ֻ��Ϊ��������");
     	   	  return false;
     	   }
         document.getElementById("qry_tag").value = "do_qry";
         return true;	
     } 	
     function queryReset() {
     	   document.getElementById("r_num").value = "";
     	   document.getElementById("r_style").value = "";
     	   document.getElementById("r_status").value = "room_idle";
     }      
  </script>

</head>	

<body>
	
<!-- ���� -->
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
              <span class="r_item">�����:</span> <span> <input type="text" id="r_num" name="r_num" />  </span>
              <span class="r_item">�� ��:</span> <span> <input type="text" id="r_style" name="r_style" /> </span>
              <span class="r_item">��ǰ״̬:</span>
              <span> 
              	 <select id="r_status" name="r_status">
	  			          <option value="room_all"> ��ѡ�� </option>
	  			          <option value="room_idle"> ������ </option>
	  			          <option value="room_rented"> �ѳ��� </option>
	  			          <option value="room_decorating"> װ���� </option>
	  			          <option value="room_discarded"> �ѷ��� </option>
	  			          <option value="room_occupied"> ��ռ�� </option>
              	 </select>
              </span>
          	  <span class="r_item"><input type="submit" name="r_query" id="r_query" value="�� ѯ" /></span>
          	  <span class="r_item"><input type="button" name="r_reset" id="r_reset" value="�� ��" onclick="queryReset()" /></span>
          	  <span class="r_item"><input type="hidden" name="qry_tag" id="qry_tag" value="not_qry"/> </span>
    	 	    </div>  
          </form>
    	</div>   	 	 
    	 <hr id="rs_sept">
    	 <div id="rs_query_list">  
    	 	 <table id="qry_list" cellspacing="0" cellpadding="0">
    	 	 	 <thead>
    	 	 	 	 <th class="t_cnt"> �� �� </th>
	    	 	 	 <th class="t_num"> ����� </th>
	    	 	 	 <th class="t_status"> ��ǰ״̬ </th>
	    	 	 	 <th class="t_style"> ��  �� </th>
	    	 	 	 <th class="t_contract"> ��ͬ�� </th>
	    	 	 	 <th class="t_renter"> �������� </th>
	    	 	 	 <th class="t_phone"> �ֻ��� </th>
	    	 	 	 <th class="t_start"> ������ </th>
	    	 	 	 <th class="t_stop"> ������ </th>
	    	 	 	 <th class="t_remark"> �� ע </th>
    	 	   </thead>
    	 	 	 <tbody>    	 	 	 	
    	 	 	 <?php
					   if( $_POST['qry_tag'] == "do_qry" ) {
					   	 $num = $_POST['r_num'];
					   	 $style = $_POST['r_style'];
					   	 $status = $_POST['r_status'];
					     echo "<script>document.getElementById('r_num').value='$num';</script>"; //ʹ��������������ʾ
					     echo "<script>document.getElementById('r_style').value='$style';</script>"; //ʹ��������������ʾ
					     echo "<script>document.getElementById('r_status').value='$status';</script>"; //ʹ��������������ʾ
					     echo "<script>document.getElementById('qry_tag').value='not_qry';</script>";
					     $status = print_status($status); 
						   // ȷ����Ϊ�ؼ��ֵ�����
						   if ( !empty($num) )
						     $cond = "where `zr_roomlist`.`num`='$num'";
						   else if ( !empty($style) )
						     $cond = "where `zr_roomlist`.`style`='$style'";
						   else if ( $_POST['r_status'] == "room_all")
						     $cond = "";		   
						   else
						     $cond = "where `zr_roomlist`.`status`='$status'";							     
						   $sql_links = sqlConnect();
						   $sql_quote = "select * from `zr_roomlist` $cond order by `num`";   
						   $sql_query = $sql_links->getData( $sql_quote );  
							 $sql_links->closeDb();
						   if( sizeof($sql_query) == 0) {
                 echo "<tr><td id='no_record' colspan='9'>û���ҵ��κμ�¼��</td></tr>";
						   } 	else {
							   foreach( $sql_query as $index=>$record) {
							     if( $index%2 == 0) // ������
							       echo "<tr class='odd_line'>";
							      else 
							       echo "<tr class='even_line'>";						     
							     $t_cnt = $index + 1;
							     echo "<td class='t_cnt'>$t_cnt</td>"; 
							     echo "<td class='t_num'>$record[num]</td>";
							     echo "<td class='t_status'>$record[status]</td>"; 
							     echo "<td class='t_style'>$record[style]</td>"; 
							     echo "<td class='t_contract'>$record[contract]</td>"; 
							     echo "<td class='t_renter'>$record[renter]</td>"; 
							     echo "<td class='t_phone'>$record[phone]</td>"; 
							     if( $record['start'] == "0000-00-00" )
							       echo "<td class='t_start'></td>"; 
							     else
							       echo "<td class='t_start'>$record[start]</td>";
							     if( $record['stop'] == "0000-00-00" )
							       echo "<td class='t_stop'></td>"; 
							     else
							       echo "<td class='t_stop'>$record[stop]</td>"; 
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
    		  <input class="rev_btn" type="button" value="��������" onclick="location.href='addroom.php'" />
    		  <input class="rev_btn" type="button" value="ɾ������" onclick="location.href='delroom.php'" />	  
    		  <input class="rev_btn" type="button" value="��Ϣ�޸�" onclick="location.href='setroom.php'" title="�����ѽ���" disabled="disabled"/>    	 	  	 	
    	 </div>
	  </div>	
	</div>
	<div id="footer">	
    <?php  require_once("foot.php");  ?>	
  </div>
</div>

</body>	
</html>