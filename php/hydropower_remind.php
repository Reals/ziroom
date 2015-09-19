<?php  // function page for user information
  session_start();
  require_once("common.php");  
?>

<html>	
<head>
  <link rel="stylesheet" type="text/css" href="../css/logon.css" />
  <link rel="stylesheet" type="text/css" href="../css/hydropower_remind.css" />
  
  <?php 
     require_once("head.php"); // ҳ�������Ϣ
  ?> 

  <script language='javascript' src='../js/common.js'> </script>
  <script language='javascript'>
     function querySubmit() {
     	   var scope_0 = document.getElementById("no_scope");
         var scope_1 = document.getElementsByName("scope");
         if( scope_1.length != 3) {
           alert("SOME ERROR HAPPEN: RADIO COUNT");
           return false;	
         }     
         if( scope_0.checked )
         	 document.getElementById("qry_tag").value = "no_scope";
         else if( scope_1[0].checked )
           document.getElementById("qry_tag").value = "scope_lvl0";
         else if( scope_1[1].checked )
         	 document.getElementById("qry_tag").value = "scope_lvl1";
         else if( scope_1[2].checked )
         	 document.getElementById("qry_tag").value = "scope_lvl2";
         else 
           alert("��ѡ��һ�ֲ�ѯ��ʽ!"); 
         return true;
     }
     function initial_scope() {
         if( document.getElementById("no_scope").checked )	{
           document.getElementsByName("scope")[0].disabled = true;
           document.getElementsByName("scope")[1].disabled = true;           	
           document.getElementsByName("scope")[2].disabled = true;         	
         } else {
           document.getElementsByName("scope")[0].disabled = false;
           document.getElementsByName("scope")[1].disabled = false;           	
           document.getElementsByName("scope")[2].disabled = false;
         	 if(!(document.getElementsByName("scope")[0].checked || // default scope lvl0 selected
         	       document.getElementsByName("scope")[1].checked ||
         	        document.getElementsByName("scope")[2].checked))   
             document.getElementsByName("scope")[0].checked = true;        	
         }
     }
     function checkboxSet() {
     	   initial_scope();
     }
  </script>
</head>	

<body onload="initial_scope()">
	
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
    	    		<span><input type="checkbox" name="no_scope" checked="checked" id="no_scope" onclick="checkboxSet()" /></span><label for="no_scope">��ѯ��������ס���� </label>&nbsp&nbsp&nbsp    	
              <span><input type="radio" name="scope" value="scope_lvl0" id="scope_lvl0" title="ʣ�����50-100��"/></span><label for="scope_lvl0"><span style='color:rgb(138,138,0)'> ���������ѯ </span></label>&nbsp&nbsp&nbsp
              <span><input type="radio" name="scope" value="scope_lvl1" id="scope_lvl1" title="ʣ�����20-50��" /></span><label for="scope_lvl1"><span style='color:rgb(255,128,0)'> �м������ѯ </span></label>&nbsp&nbsp&nbsp
              <span><input type="radio" name="scope" value="scope_lvl2" id="scope_lvl2" title="ʣ�����20������" /></span><label for="scope_lvl2"><span style='color:rgb(255,0,0)'> ���������ѯ </span></label>&nbsp&nbsp&nbsp
              <span class="r_item"> <input type="submit" id="r_query" value="�� ѯ" /> </span>
              <input type="hidden" id="qry_tag" name="qry_tag" value="not_qry" />
    	 	    </div>  
          </form>
    	 </div>
    	 <hr id="rs_sept">
    	 <div id="rs_query_list">  
    	 	 <table id="qry_list" cellspacing="0" cellpadding="0">
    	 	 	 <thead>
    	 	 	 	 <th class="t_cnt"> �� �� </th>
	    	 	 	 <th class="t_num"> ����� </th>
	    	 	 	 <th class="t_renter"> �� �� </th>
	    	 	 	 <th class="t_phone"> �ֻ��� </th>
	    	 	 	 <th class="t_elec_a"> ��ʼ���� </th>
	    	 	 	 <th class="t_elec_a"> ʣ����� </th>
	    	 	 	 <th class="t_elec_r"> ���¼�¼ʱ�� </th>
	    	 	 	 <th class="t_remark"> �� ע </th>
    	 	   </thead>
    	 	 	 <tbody>    	 	 	 	
    	 	 	 <?php
    	 	 	   $qry_scope = $_POST['qry_tag'];
             if( $qry_scope == "no_scope" || $qry_scope == "scope_lvl0"
              || $qry_scope == "scope_lvl1" || $qry_scope == "scope_lvl2") {
						   $sql_links = sqlConnect();
						   $sql_quote = "select * from `zr_roomlist` where `status`='�ѳ���' order by `num`";   
						   $sql_query = $sql_links->getData( $sql_quote );  
							 $sql_links->closeDb();  
						   if( sizeof($sql_query) == 0) {
                 echo "<tr><td id='no_record' colspan='9'>û���ҵ��κμ�¼��</td></tr>";
						   } else {				   
							   $record_cnt = 0; 		
							   foreach( $sql_query as $index=>$record) {
	                 $cur_elec = $record['elec_cur_amount'];   
	    				     if( !isInAlarm($cur_elec, $qry_scope) ) 
							       continue; 						     
							     $record_num = $record['num'];
							     if( $record_cnt%2 == 0) // ������
							       echo "<tr class='odd_line' title='����$record_num'>";
							     else
							       echo "<tr class='even_line' title='����$record_num'>";			     
							     $record_cnt = $record_cnt + 1;
							     echo "<td class='t_cnt'>$record_cnt</td>";
							     echo "<td class='t_num'>$record_num</td>";
							     echo "<td class='t_renter'>$record[renter]</td>"; 
							     echo "<td class='t_phone'>$record[phone]</td>"; 
		               echo "<td class='t_elec_a'>$record[elec_ini_amount]</td>";
		               if( isInLvl0($record['elec_cur_amount']) )
		                 echo "<td class='t_elec_a' style='color:rgb(138,138,0)'>$record[elec_cur_amount]</td>";
		               else if ( isInLvl1($record['elec_cur_amount']) )
		                 echo "<td class='t_elec_a' style='color:rgb(255,128,0)'>$record[elec_cur_amount]</td>";
		               else if ( isInLvl2($record['elec_cur_amount']) )
		                 echo "<td class='t_elec_a' style='color:rgb(255,  0,0)'>$record[elec_cur_amount]</td>";
		               else 
		                 echo "<td class='t_elec_a' style='color:rgb( 0, 0,255)'>$record[elec_cur_amount]</td>";
		               
		               if( $record['elec_mfy_time'] == "0000-00-00 00:00:00")
		                echo "<td class='t_elec_r'></td>"; 	               
		               else
		                echo "<td class='t_elec_r'>$record[elec_mfy_time]</td>";          
							     echo "<td class='t_remark'>$record[remark]</td>";
							     echo "</tr>";			     						      
							   }	
	               if( $record_cnt == 0)  
	                 echo "<tr><td id='no_record' colspan='9'>û���ҵ��κμ�¼��</td></tr>";				   
							   switch($qry_scope) {
							     case "no_scope":
							       echo "<script> document.getElementById('no_scope').checked = true; </script>";
							       echo "<script> document.getElementsByName('scope')[0].disabled = true ;</script>";	
							       echo "<script> document.getElementsByName('scope')[1].disabled = true ;</script>";	
							       echo "<script> document.getElementsByName('scope')[2].disabled = true ;</script>";	
							       break;
							     case "scope_lvl0":
							       echo "<script> document.getElementById('no_scope').checked = false; </script>";
							       echo "<script> document.getElementsByName('scope')[0].disabled = false ;</script>";	
							       echo "<script> document.getElementsByName('scope')[1].disabled = false ;</script>";	
							       echo "<script> document.getElementsByName('scope')[2].disabled = false ;</script>";		
							       echo "<script> document.getElementsByName('scope')[0].checked = true ;</script>";	
							       break;
							     case "scope_lvl1":	
							       echo "<script> document.getElementById('no_scope').checked = false; </script>";
							       echo "<script> document.getElementsByName('scope')[0].disabled = false ;</script>";	
							       echo "<script> document.getElementsByName('scope')[1].disabled = false ;</script>";	
							       echo "<script> document.getElementsByName('scope')[2].disabled = false ;</script>";		
							       echo "<script> document.getElementsByName('scope')[1].checked = true ;</script>";	
							       break;
							     case "scope_lvl2":	
							       echo "<script> document.getElementById('no_scope').checked = false; </script>";
							       echo "<script> document.getElementsByName('scope')[0].disabled = false ;</script>";	
							       echo "<script> document.getElementsByName('scope')[1].disabled = false ;</script>";	
							       echo "<script> document.getElementsByName('scope')[2].disabled = false ;</script>";		
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
    		  <input class="rev_btn" type="button" value="�޸ĵ���" title="�޸�ʣ�����" onclick="location.href='mfyelectric.php'" />
    		  <input class="rev_btn" type="button" value="����Ԥ��" onclick="location.href='delrenter.php'" disabled="disabled" />	  
    		  <input class="rev_btn" type="button" value="����Ԥ��" onclick="location.href='setrenter.php'" disabled="disabled" />   
    	 </div>
	  </div>	
	</div>
	<div id="footer">	
    <?php  require_once("foot.php");  ?>	
  </div>
</div>
</body>	
</html>