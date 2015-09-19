<?php>
  session_start();
  session_destroy(); // 如果用户回退，则自动退出
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<html>
	
<head>
  <?php 
    require_once("php/head.php"); // 页面标题信息 
  ?>
  <script language="javascript" src="js/main.js"> </script>  	            <!-- 登陆界面脚本 -->
</head>	
	
<body>
<!-- 外框架 -->
<div id="framework"> 		
	<!-- 页面头部 -->
  <div id="header">
    <?php  require_once("php/page_title.php");   ?> 
  </div>  
	<!-- 页面主体 -->
	<div id="main">
  	<hr class="foot_line">
  	<div id="dialog" align="center">
  		<form name="u_submit" method="post" onsubmit="return mySubmit()" action="php/login.php">
  		<table id="login">
  		  <tr class="ibox">
  		    <td align="right"><span>用户名:</span></td>
  		    <td><input type="text" id="username" name="username" /></td>
  		  </tr>
  		  <tr class="ibox"> 
  		    <td align="right"><span>密 码:</span></td>
  		    <td><input type="password" id="password" name="password" /></td>
  		  </tr>
  		  <tr>
  		    <td align="right"><span>在哪座公寓:</span></td>
  		    <td>
  		    		<select id="zr_room" name="zr_room" disabled="disabled">
  			        <option value="no_room" selected="true"> 请选择... </option>
  			        <option value="wj_room"> 望京阳光自如寓 </option>
  			        <option value="sd_room"> 上地凌云自如寓 </option>
  			        <option value="yy_room"> 亚运村15自如寓 </option>
  			        <option value="jf_room"> 将府公园自如寓 </option>
  			        <option value="hl_room"> 欢乐谷7号工场自如寓 </option>
  			        <option value="xz_room"> 西直门梧桐自如寓 </option>
  		        </select>
  			  </td>  			  		
  		  </tr>
  		</table>
  		<div id="forget_tip">
  			<a href="mailto:zhnan_jiang@yeah.net" title="点击给zhnan_jiang@yeah.net发邮件">忘记用户名或密码?通过邮箱联系攻城狮吧!</a>
      </div>
  		<div align="center"> 
  		    <input type="submit" id="submit" value="登&nbsp&nbsp陆" />&nbsp&nbsp&nbsp
  		    <input type="button" id="reset" value="重&nbsp&nbsp置" onclick="myReset()" /><br>
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
