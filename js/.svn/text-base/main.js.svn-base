 
// 外部JavaScript脚本
 	
  	var username; // current user's name
  	var password; // current user's password
  	var belongto; // current user's workplace
  	var loginnum = 6; // limited login chances, default 6;
  	
  	function mySubmit() { // 主界面用户提交登陆请求处理  		
  	    username = document.getElementById("username").value;
  	    password = document.getElementById("password").value;
  	    belongto = document.getElementById("zr_room").value;
  	    if( username == "" || password == "") {
  	    	alert("请输入用户名和密码！");
  	      return false;
  	    }	
  	    /*
  	    if( belongto == "no_room") {
  	      alert("请选择你所在的公寓!");
  	      return false;
  	    }
  	    */
  	    return true;
  	    
//        --loginnum;
//        if( loginnum == 0) {
//          document.getElementById("login_cnt").innerHTML = "*其实不会限制你的尝试次数的，哈哈!";
//          document.getElementById("login_cnt").style.color = "rgb(0,128,255)";
//        } else if( loginnum < 0 ) {
//        	//document.getElementById("login_cnt").style.visibility = "hidden";
//        	document.getElementById("login_cnt").innerHTML = "<a href=\"mailto:zhnan_jiang@yeah.net\" title=\"点击给zhnan_jiang@yeah.net发邮件\">忘记用户名或密码?通过邮箱联系攻城狮吧!</a>";
//        } else {
//          document.getElementById("login_cnt").innerHTML = "*你还有"+loginnum+"次尝试机会!";	
//          if( loginnum <= 3)
//            document.getElementById("login_cnt").style.color="rgb(213,0,0)";
//        }
  	}
  	
  	function myReset() {  // 主界面用户清空输入处理
  	 	  document.getElementById("username").value = "";
  	 	  document.getElementById("password").value = "";
  	 	  document.getElementById("zr_room").value = "no_room";
  	}
  	
 	
