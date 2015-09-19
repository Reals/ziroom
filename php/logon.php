<?php // function top level page
  session_start();
  require_once("common.php"); // common function
?>

<html>	
<head>
  <?php 
    require_once("head.php"); // 页面标题信息
  ?>
  <link rel="stylesheet" type="text/css" href="../css/logon.css" />
  <link rel="stylesheet" type="text/css" href="../css/logon_default.css" />
</head>	

<body>
<!-- 外框架 -->
<div id="framework">
	<div id="header"> 		
    <?php  require_once("page_title.php");  ?> 
  </div>
	<div id="main">
    <?php  require_once("logon_base.php");  ?>
    <div id="inf_main"> 
       <h4 id="list_title"> 功能说明 </h4>
       <hr id="list_sept">
       <ul>
         <li class="list_item"> 用户信息: <span> 查询当前登陆用户的所有信息，包含姓名，性别，所服务的公寓，联系方式等。 </span> </li>
         <li class="list_item"> 房间状态: <span> 查询房间基本信息及出租状态，目前支持根据房号，户型或出租状态进行查询。 </span></li>
         <li class="list_item"> 租户资料: <span> 查询与修改租户信息，根据房号，姓名，手机号进行查询条件。 </span></li>
         <li class="list_item"> 生日查询: <span> 查询近期将过生日的租户，提供按月，按半月或按周查询功能。 </span></li>
         <li class="list_item"> 电量查询: <span> 查询最新的电表底数，提供三档购电预警（查询结果高亮）。 </span></li>         
         <li class="list_item"> 缴租查询: <span> 查询近期需缴纳房租的租户，提供按月，按半月或按周查询功能。 </span></li>     	
       </ul>
    </div>
	</div>	
	<div id="footer">	
    <?php  require_once("foot.php");  ?>	
  </div>
</div>
</body>	
</html>