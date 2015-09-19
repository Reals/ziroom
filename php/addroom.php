<?php>
  session_start();
  require_once("common.php");
?>

<html>
	
<head>
  <?php 
    require_once("head.php"); // ҳ�������Ϣ 
  ?>
  <link rel="stylesheet" type="text/css" href="../css/addroom.css" />
  <script language='javascript' src="../js/common.js" > </script>
  
  <script language='javascript'>
     function mySubmit() {
     	   var r_num = document.getElementById("r_num").value; 
     	   if( r_num == "" ) { 
     	     alert("�����������ķ����");
     	     return false;
     	   }
     	   if( isNaN(r_num) || r_num <= 0) {
     	     alert("������ķ�������󣬷���Ų��ܰ�����ĸ��Ϊ������");	
     	     return false;
     	   }
     	   return true;
     }
     function myCancel() {
         location.href="room_status.php"; 	
     }     
  </script>
</head>	

<body onload="initial_cfg()">
	<div id="set_main" align="center">
	  <h1 id="set_h1" align="center"> ������Դ��Ϣ </h1>
	  <h2 id="set_u"> ��ǰ��½�û�: <?php echo $_SESSION['username']; ?> </h2>
	  <hr id="set_hr">
	  <div id="set_item" align="center">
       <form method="post" onsubmit="return mySubmit()" action="addroom_confirm.php">
       	  <table>
       	  	<tr>
       	  		<td class="set_t"> �����: </td> <td class="set_p"> <input id="r_num" type="text" name="r_num" /> </td>
       	  	</tr>
       	  	<tr>
       	  		<td class="set_t"> �� ��: </td> <td class="set_p"> <input id="r_style" type="text" name="r_style" /> </td>  	
            </tr>
       	  	<tr>
       	  		<td class="set_t"> ����״̬: </td> 
       	  		<td class="set_p">   		
       	  			<select id="r_status" name="r_status" onchange="statusChange(this.value)">
  			          <option value="room_idle"> -- ������ --  </option>
  			          <option value="room_rented" disabled="disabled"> -- �ѳ��� -- </option>
  			          <option value="room_decorating" disabled="disabled"> -- װ���� -- </option>
  			          <option value="room_discarded" disabled="disabled"> -- �ѷ��� -- </option>
  			          <option value="room_occupied" disabled="disabled"> -- ��ռ�� -- </option>
  		          </select> 
  		        </td>  	
            </tr> 
       	  	<tr>
       	  		<td class="set_t" id="r_0"> ��ͬ��: </td> <td class="set_p"> <input id="r_contract" type="text" name="r_contract" /> </td>  	
            </tr> 
       	  	<tr>
       	  		<td class="set_t" id="r_1"> �ⷿ��: </td> <td class="set_p"> <input id="r_renter" type="text" name="r_renter" /> </td>  	
            </tr> 
       	  	<tr>
       	  		<td class="set_t" id="r_2"> �ֻ���: </td> <td class="set_p"> <input id="r_phone" type="text" name="r_phone" /> </td>  	
            </tr>
       	  	<tr>
       	  		<td class="set_t" id="r_3"> ������: </td> <td class="set_p"> <input id="r_start" type="date" name="r_start" /> </td>  	
            </tr>
       	  	<tr>
       	  		<td class="set_t" id="r_4"> ������: </td> <td class="set_p"> <input id="r_stop" type="date" name="r_stop" /> </td>  	
            </tr>
       	  	<tr>
       	  		<td class="set_t" id="r_5"> �� ע: </td> <td class="set_p"> <input id="r_remark" type="text" name="r_remark" /> </td>  	
            </tr>
          </table>  
          <div id="set_btn" align="center">
  		      <input type="submit" id="addroom_submit" value="��&nbsp��" />&nbsp&nbsp&nbsp
  		      <input type="button" id="addroom_cancel" value="ȡ&nbsp��" onclick="myCancel()" />        	 
          </div>         
       </form>
	  </div>
	  <hr id="set_hr">
  </div>
</body>