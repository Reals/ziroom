<?php 
  session_start(); 
  session_destroy();  // 需要在各个页面中增加检测SESSION是否开启的功能
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<html>
	
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=gbk;" />	
  <title>系统登出!</title> 	
  
  <style type="text/css">
  	body {
  		 background-color:gray;
  	   margin-top:50px;	
  	   text-align:center;
  	  }
  	#remarks {
       font-size:30px;
       font-weight:bold; 
  		 font-family:'幼圆';
       color:red;  		
  	  }
  	#line {
  		 border-style:solid;
  		 border-width:middle;
  		 margin:20px 20px auto 20px;
  		 color:blue;
  	  }
  	.link {
  		 margin-top:20px;
  		 font-size:18px;
  		 font-family:'幼圆';
  		 background-color:rgb(210,210,210);
  		 color:red;  	
  		 border-style:solid;
  		 border-radius:10px;
  		 padding-top:10px;
  		 padding-bottom:10px;	
  		 padding-left:20px;
  		 padding-right:20px;  	
  		 cursor:pointer;	  
  	  }
 /*   
    .link { 
       font-size:14px; 
       font-family:Arial; 
       font-weight:normal; 
       -moz-border-radius:42px; 
       -webkit-border-radius:42px; 
       border-radius:42px; 
       border:1px solid #dcdcdc; 
       padding:9px 18px; 
       text-decoration:none; 
       background:-webkit-gradient( linear, left top, left bottom, color-stop(5%, #ededed), color-stop(100%, #dfdfdf) ); 
       background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% ); 
       background:-ms-linear-gradient( top, #ededed 5%, #dfdfdf 100% ); 
       filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf'); 
       background-color:#ededed; 
       color:#777777; 
       display:inline-block; 
       text-shadow:1px 1px 0px #ffffff; 
       -webkit-box-shadow:inset 1px 1px 0px 0px #ffffff; 
       -moz-box-shadow:inset 1px 1px 0px 0px #ffffff; 
       box-shadow:inset 1px 1px 0px 0px #ffffff; 
      }
   .link:hover { 
       background:-webkit-gradient( linear, left top, left bottom, color-stop(5%, #dfdfdf), color-stop(100%, #ededed) ); 
       background:-moz-linear-gradient( center top, #dfdfdf 5%, #ededed 100% ); 
       background:-ms-linear-gradient( top, #dfdfdf 5%, #ededed 100% ); 
       filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed'); 
       background-color:#dfdfdf; 
      }
   .link:active { 
       position:relative; 
       top:1px; 
      } 	  
  */  
  </style> 
  
  <script language='javascript'>
  	function backHome() {
  	  location.href= "http://ziroom.sinaapp.com";	
  	}
    function closePage() {
    	window.opener=null;
    	window.open('','_self');
    	window.close();
    }	
  </script>  
</head>	
	
<body>
   <div id="remarks">您已成功退出系统 <br></div>
   <hr id="line"><br>
   <input type="button" class="link" onclick="backHome()" value="返回登陆页面" />&nbsp&nbsp&nbsp
   <input type="button" class="link" onclick="closePage()" value="关闭当前页面" />
</body>
	
</html>