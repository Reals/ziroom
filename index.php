<?php>
  session_start();
  session_destroy(); // ����û����ˣ����Զ��˳�
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<html>
	
<head>
  <?php 
    require_once("php/head.php"); // ҳ�������Ϣ 
  ?>
  <script language="javascript" src="js/main.js"> </script>  	            <!-- ��½����ű� -->
</head>	
	
<body>
<!-- ���� -->
<div id="framework"> 		
	<!-- ҳ��ͷ�� -->
  <div id="header">
    <?php  require_once("php/page_title.php");   ?> 
  </div>  
	<!-- ҳ������ -->
	<div id="main">
  	<hr class="foot_line">
  	<div id="dialog" align="center">
  		<form name="u_submit" method="post" onsubmit="return mySubmit()" action="php/login.php">
  		<table id="login">
  		  <tr class="ibox">
  		    <td align="right"><span>�û���:</span></td>
  		    <td><input type="text" id="username" name="username" /></td>
  		  </tr>
  		  <tr class="ibox"> 
  		    <td align="right"><span>�� ��:</span></td>
  		    <td><input type="password" id="password" name="password" /></td>
  		  </tr>
  		  <tr>
  		    <td align="right"><span>��������Ԣ:</span></td>
  		    <td>
  		    		<select id="zr_room" name="zr_room" disabled="disabled">
  			        <option value="no_room" selected="true"> ��ѡ��... </option>
  			        <option value="wj_room"> ������������Ԣ </option>
  			        <option value="sd_room"> �ϵ���������Ԣ </option>
  			        <option value="yy_room"> ���˴�15����Ԣ </option>
  			        <option value="jf_room"> ������԰����Ԣ </option>
  			        <option value="hl_room"> ���ֹ�7�Ź�������Ԣ </option>
  			        <option value="xz_room"> ��ֱ����ͩ����Ԣ </option>
  		        </select>
  			  </td>  			  		
  		  </tr>
  		</table>
  		<div id="forget_tip">
  			<a href="mailto:zhnan_jiang@yeah.net" title="�����zhnan_jiang@yeah.net���ʼ�">�����û���������?ͨ��������ϵ����ʨ��!</a>
      </div>
  		<div align="center"> 
  		    <input type="submit" id="submit" value="��&nbsp&nbsp½" />&nbsp&nbsp&nbsp
  		    <input type="button" id="reset" value="��&nbsp&nbsp��" onclick="myReset()" /><br>
  		</div>  		  		
      </form>
  	</div>
	</div>		
	<div id="footer.php">
    <?php require_once("php/foot.php");  ?>	
  </div>
</div>
</body>
	
</html>
