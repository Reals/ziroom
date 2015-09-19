<?php>
  session_start();
  require_once("common.php");
?>

<html>
	
<head>
  <?php 
    require_once("head.php"); // 页面标题信息 
  ?>
  <link rel="stylesheet" type="text/css" href="../css/addroom.css" />
  <script language='javascript' src="../js/common.js" > </script>
  
  <script language='javascript'>
     function mySubmit() {
     	   var r_num = document.getElementById("r_num").value; 
     	   if( r_num == "" ) { 
     	     alert("请输入新增的房间号");
     	     return false;
     	   }
     	   if( isNaN(r_num) || r_num <= 0) {
     	     alert("您输入的房间号有误，房间号不能包含字母或为负数！");	
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
	  <h1 id="set_h1" align="center"> 新增房源信息 </h1>
	  <h2 id="set_u"> 当前登陆用户: <?php echo $_SESSION['username']; ?> </h2>
	  <hr id="set_hr">
	  <div id="set_item" align="center">
       <form method="post" onsubmit="return mySubmit()" action="addroom_confirm.php">
       	  <table>
       	  	<tr>
       	  		<td class="set_t"> 房间号: </td> <td class="set_p"> <input id="r_num" type="text" name="r_num" /> </td>
       	  	</tr>
       	  	<tr>
       	  		<td class="set_t"> 户 型: </td> <td class="set_p"> <input id="r_style" type="text" name="r_style" /> </td>  	
            </tr>
       	  	<tr>
       	  		<td class="set_t"> 房间状态: </td> 
       	  		<td class="set_p">   		
       	  			<select id="r_status" name="r_status" onchange="statusChange(this.value)">
  			          <option value="room_idle"> -- 闲置中 --  </option>
  			          <option value="room_rented" disabled="disabled"> -- 已出租 -- </option>
  			          <option value="room_decorating" disabled="disabled"> -- 装修中 -- </option>
  			          <option value="room_discarded" disabled="disabled"> -- 已废弃 -- </option>
  			          <option value="room_occupied" disabled="disabled"> -- 已占用 -- </option>
  		          </select> 
  		        </td>  	
            </tr> 
       	  	<tr>
       	  		<td class="set_t" id="r_0"> 合同号: </td> <td class="set_p"> <input id="r_contract" type="text" name="r_contract" /> </td>  	
            </tr> 
       	  	<tr>
       	  		<td class="set_t" id="r_1"> 租房人: </td> <td class="set_p"> <input id="r_renter" type="text" name="r_renter" /> </td>  	
            </tr> 
       	  	<tr>
       	  		<td class="set_t" id="r_2"> 手机号: </td> <td class="set_p"> <input id="r_phone" type="text" name="r_phone" /> </td>  	
            </tr>
       	  	<tr>
       	  		<td class="set_t" id="r_3"> 起租日: </td> <td class="set_p"> <input id="r_start" type="date" name="r_start" /> </td>  	
            </tr>
       	  	<tr>
       	  		<td class="set_t" id="r_4"> 到期日: </td> <td class="set_p"> <input id="r_stop" type="date" name="r_stop" /> </td>  	
            </tr>
       	  	<tr>
       	  		<td class="set_t" id="r_5"> 备 注: </td> <td class="set_p"> <input id="r_remark" type="text" name="r_remark" /> </td>  	
            </tr>
          </table>  
          <div id="set_btn" align="center">
  		      <input type="submit" id="addroom_submit" value="新&nbsp增" />&nbsp&nbsp&nbsp
  		      <input type="button" id="addroom_cancel" value="取&nbsp消" onclick="myCancel()" />        	 
          </div>         
       </form>
	  </div>
	  <hr id="set_hr">
  </div>
</body>