<?php>
  session_start();
  require_once("common.php");
?>

<html>
	
<head>
  <?php 
    require_once("head.php"); // 页面标题信息 
  ?>
  <link rel="stylesheet" type="text/css" href="../css/delroom.css" />
  
  <script language='javascript'>
     function mySubmit() {
     	   var r_num = document.getElementById("r_num").value; 
     	   if( r_num == "" ) {
     	     alert("请输入待删除的房间号");
     	     return false;
     	   }
     	   if( isNaN(r_num) || r_num <= 0) {
     	     alert("您输入的房间号有误，房间号不能包含字母或为负数！");	
     	     return false;
     	   }
     	   if( !confirm("您确认删除该房间吗？")) return false;
     	   return true;
     }
     function myCancel() {
         location.href="room_status.php"; 	
     }     
  </script>
</head>	

<body>
	<div id="set_main" align="center">
	  <h1 id="set_h1" align="center"> 删除已存在的房间 </h1>
	  <h2 id="set_u"> 当前登陆用户: <?php echo $_SESSION['username']; ?> </h2>
	  <hr id="set_hr">
	  <div id="set_item" align="center">
       <form method="post" onsubmit="return mySubmit()" action="delroom_confirm.php">
       	  <table>
       	  	<tr>
       	  		<td class="set_t"> 请提供待删除的房间号: </td> 
       	  		<td class="set_p"> <input id="r_num" type="text" name="r_num" /> </td>
       	  	</tr>
          </table>  
          <div id="set_btn" align="center">
  		      <input type="submit" id="delroom_submit" value="删&nbsp除" />&nbsp&nbsp&nbsp
  		      <input type="button" id="delroom_cancel" value="取&nbsp消" onclick="myCancel()" />        	 
          </div>         
       </form>
	  </div>
	  <hr id="set_hr">
  </div>
</body>