<!-- 
    页面的基础框架，被各功能PHP所包含
-->

<script language='javascript'>
	  function itemMouseOver(item) {
	  	 item.style.backgroundColor = "rgb(210,210,210)";
	  	 item.style.borderColor = "rgb(210,210,210)";
	  }
	  function itemMouseOut(item) {
	  	 item.style.backgroundColor = "rgb(0,120,216)";
	  	 item.style.borderColor = "rgb(0,120,216)";
	  }	
	  function pageJump(item) {
	  	 switch(item.id) { 
	  	 	 case "user_info": location.href="user_info.php"; break;
	  	 	 case "room_status": location.href="room_status.php"; break;
	  	 	 case "rent_query": location.href="rent_query.php"; break;
	  	 	 case "birthday_remind":location.href="birthday_remind.php"; break;
	  	 	 case "payment_remind": location.href="payment_remind.php"; break;
	  	 	 case "hydropower_remind":location.href="hydropower_remind.php"; break;
	  	 	 case "user_quit":if( confirm("您确定退出登陆吗？")) location.href="user_quit.php";break;
	  	 	 default: alert("Debug Mode Happen."); 
	  	 }
	  }
	  function pageReload() {
	     location.href = "logon.php";	
	  }
</script>

<div id="welcome" onclick="pageReload()">
   <?php 		  
  	 echo "当前登陆用户:&nbsp".$_SESSION['nickname']."『".print_apartment($_SESSION['belongto'])."』";
   ?>
</div>
<hr class="foot_line">
<div id="nav_main">  		 
  <div class="nav_item" id="user_info" onmouseover="itemMouseOver(this)" onmouseout="itemMouseOut(this)" onclick="pageJump(this)">
  	 <p> 用户信息 </p> 
  </div> 
  <div class="nav_item" id="room_status" onmouseover="itemMouseOver(this)" onmouseout="itemMouseOut(this)" onclick="pageJump(this)">
  	 <p> 房间状态 </p> 
  </div> 
  <div class="nav_item" id="rent_query" onmouseover="itemMouseOver(this)" onmouseout="itemMouseOut(this)" onclick="pageJump(this)"> 
  	 <p> 租户资料 </p> 
  </div> 
  <div class="nav_item" id="birthday_remind" onmouseover="itemMouseOver(this)" onmouseout="itemMouseOut(this)" onclick="pageJump(this)">
  	 <p> 生日查询 </p> 
  </div>
  <div class="nav_item" id="hydropower_remind" onmouseover="itemMouseOver(this)" onmouseout="itemMouseOut(this)" onclick="pageJump(this)"> 
  	 <p> 电量查询 </p>
  </div> 
  <div class="nav_item" id="payment_remind" onmouseover="itemMouseOver(this)" onmouseout="itemMouseOut(this)" onclick="pageJump(this)">
  	 <p> 缴租查询 </p> 
  </div> 
  <div class="nav_item" id="user_quit" onmouseover="itemMouseOver(this)" onmouseout="itemMouseOut(this)" onclick="pageJump(this)"> 
  	 <p> 退出登录 </p> 
  </div>
</div>
