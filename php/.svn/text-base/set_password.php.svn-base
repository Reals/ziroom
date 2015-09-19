<?php>
  session_start();
  require_once("common.php");
?>

<html>
	
<head>
  <?php 
    require_once("head.php"); // 页面标题信息 
  ?>
  <link rel="stylesheet" type="text/css" href="../css/set_password.css" />
  
  <script language='javascript'>
     function mySubmit() {
         var old_pwd = document.getElementById("old_pwd").value;
         var new_pwd = document.getElementById("new_pwd").value;
         var cfm_pwd = document.getElementById("cfm_pwd").value;
         if( old_pwd == "" || new_pwd == "" || cfm_pwd == "" ) {
           alert("请您按要求输入所有密码！");
           return false;	
         }
         if( new_pwd != cfm_pwd) {
           alert("您两次输入的新密码必须一致！");
           return false;	
         }
         return true;
     }
     function myCancel() {
         history.back(-1); 	
     }
  </script>
</head>	

<body>
	<div id="setpwd_main" align="center">
	  <h1 id="setpwd_h1" align="center"> 用户密码设置 </h1>
	  <h2 id="setpwd_u"> 当前登陆用户: <?php echo $_SESSION['username']; ?> </h2>
	  <hr id="setpwd_hr">
	  <div id="setpwd_item" align="center">
       <form method="post" onsubmit="return mySubmit()" action="setpwd_confirm.php">
       	  <table>
       	  	<tr>
       	  		<td class="setpwd_t"> 原密码: </td> <td class="setpwd_p"> <input id="old_pwd" type="password" name="old_pwd" /> </td>
       	  	</tr>
       	  	<tr>
       	  		<td class="setpwd_t"> 新密码: </td> <td class="setpwd_p"> <input id="new_pwd" type="password" name="new_pwd" /> </td>  	
            </tr>
       	  	<tr>
       	  		<td class="setpwd_t"> 确认密码: </td> <td class="setpwd_p"> <input id="cfm_pwd" type="password" name="cfm_pwd" /> </td>  	
            </tr> 
          </table>  
          <div id="setpwd_btn" align="center">
  		      <input type="submit" id="setpwd_submit" value="修&nbsp改" />&nbsp&nbsp&nbsp
  		      <input type="button" id="setpwd_cancel" value="取&nbsp消" onclick="myCancel()" />        	 
          </div>         
       </form>
	  </div>
	  <hr id="setpwd_hr">
  </div>
</body>