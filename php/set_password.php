<?php>
  session_start();
  require_once("common.php");
?>

<html>
	
<head>
  <?php 
    require_once("head.php"); // ҳ�������Ϣ 
  ?>
  <link rel="stylesheet" type="text/css" href="../css/set_password.css" />
  
  <script language='javascript'>
     function mySubmit() {
         var old_pwd = document.getElementById("old_pwd").value;
         var new_pwd = document.getElementById("new_pwd").value;
         var cfm_pwd = document.getElementById("cfm_pwd").value;
         if( old_pwd == "" || new_pwd == "" || cfm_pwd == "" ) {
           alert("������Ҫ�������������룡");
           return false;	
         }
         if( new_pwd != cfm_pwd) {
           alert("��������������������һ�£�");
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
	  <h1 id="setpwd_h1" align="center"> �û��������� </h1>
	  <h2 id="setpwd_u"> ��ǰ��½�û�: <?php echo $_SESSION['username']; ?> </h2>
	  <hr id="setpwd_hr">
	  <div id="setpwd_item" align="center">
       <form method="post" onsubmit="return mySubmit()" action="setpwd_confirm.php">
       	  <table>
       	  	<tr>
       	  		<td class="setpwd_t"> ԭ����: </td> <td class="setpwd_p"> <input id="old_pwd" type="password" name="old_pwd" /> </td>
       	  	</tr>
       	  	<tr>
       	  		<td class="setpwd_t"> ������: </td> <td class="setpwd_p"> <input id="new_pwd" type="password" name="new_pwd" /> </td>  	
            </tr>
       	  	<tr>
       	  		<td class="setpwd_t"> ȷ������: </td> <td class="setpwd_p"> <input id="cfm_pwd" type="password" name="cfm_pwd" /> </td>  	
            </tr> 
          </table>  
          <div id="setpwd_btn" align="center">
  		      <input type="submit" id="setpwd_submit" value="��&nbsp��" />&nbsp&nbsp&nbsp
  		      <input type="button" id="setpwd_cancel" value="ȡ&nbsp��" onclick="myCancel()" />        	 
          </div>         
       </form>
	  </div>
	  <hr id="setpwd_hr">
  </div>
</body>