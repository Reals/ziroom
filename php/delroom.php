<?php>
  session_start();
  require_once("common.php");
?>

<html>
	
<head>
  <?php 
    require_once("head.php"); // ҳ�������Ϣ 
  ?>
  <link rel="stylesheet" type="text/css" href="../css/delroom.css" />
  
  <script language='javascript'>
     function mySubmit() {
     	   var r_num = document.getElementById("r_num").value; 
     	   if( r_num == "" ) {
     	     alert("�������ɾ���ķ����");
     	     return false;
     	   }
     	   if( isNaN(r_num) || r_num <= 0) {
     	     alert("������ķ�������󣬷���Ų��ܰ�����ĸ��Ϊ������");	
     	     return false;
     	   }
     	   if( !confirm("��ȷ��ɾ���÷�����")) return false;
     	   return true;
     }
     function myCancel() {
         location.href="room_status.php"; 	
     }     
  </script>
</head>	

<body>
	<div id="set_main" align="center">
	  <h1 id="set_h1" align="center"> ɾ���Ѵ��ڵķ��� </h1>
	  <h2 id="set_u"> ��ǰ��½�û�: <?php echo $_SESSION['username']; ?> </h2>
	  <hr id="set_hr">
	  <div id="set_item" align="center">
       <form method="post" onsubmit="return mySubmit()" action="delroom_confirm.php">
       	  <table>
       	  	<tr>
       	  		<td class="set_t"> ���ṩ��ɾ���ķ����: </td> 
       	  		<td class="set_p"> <input id="r_num" type="text" name="r_num" /> </td>
       	  	</tr>
          </table>  
          <div id="set_btn" align="center">
  		      <input type="submit" id="delroom_submit" value="ɾ&nbsp��" />&nbsp&nbsp&nbsp
  		      <input type="button" id="delroom_cancel" value="ȡ&nbsp��" onclick="myCancel()" />        	 
          </div>         
       </form>
	  </div>
	  <hr id="set_hr">
  </div>
</body>