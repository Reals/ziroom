<?php  // function page for user information
  session_start();
  require_once("common.php");
?>

<html>	
<head>
  <?php 
     require_once("head.php"); // ҳ�������Ϣ
  ?>
  <script language='javascript'>
  	 function setPwd() {
  	 	   location.href = "set_password.php";
  	 }
  	 function setInf() {
  	 	   //location.href = "set_userinfo.php";
  	 }
  	 function importDB() {
  	 	   var pwd = prompt("���������ݵ�����Ȩ�룡", "password" );
  	 	   if( pwd != "authority" ) {
  	 	     alert("���������Ȩ�������Ϊ�գ�");
  	 	     return false;
  	 	   }
  	     location.href= "import_db.php";
  	 }
  </script>
  <link rel="stylesheet" type="text/css" href="../css/logon.css" />
  <link rel="stylesheet" type="text/css" href="../css/user_info.css" />
</head>	

<body>
<!-- ���� -->
<div id="framework">
	<div id="header"> 		
    <?php  require_once("page_title.php");  ?> 
  </div>
	<div id="main">
    <?php  require_once("logon_base.php");  ?>
    <div id="inf_main"> 
    	<?php  // get user infortaion
    	   $username  = $_SESSION['username'];
         $sql_links = sqlConnect();  
         $sql_quote = "select * from `zr_userlist` where username='$username'";
         $sql_query = $sql_links->getData( $sql_quote ); 
         $password = $sql_query[0]['password']; 
         $nickname = $sql_query[0]['nickname'];
         $mysex    = $sql_query[0]['sex'];
         $myplace  = $sql_query[0]['place'];         
         $myborn   = $sql_query[0]['born'];
         $mygroup  = $sql_query[0]['group'];
         $mypic    = $sql_query[0]['picture'];
         $myphone  = $sql_query[0]['phone'];
         $mymail   = $sql_query[0]['mailbox'];
         $myapart  = $sql_query[0]['apartment'];
         $mytime   = $sql_query[0]['reg_time'];
         $myleader = $sql_query[0]['leader'];
         $myauth   = $sql_query[0]['authority'];
         $myremark = $sql_query[0]['remark'];  
         $myduty   = $sql_query[0]['duty'];   
         $myteam   = $sql_query[0]['team'];    
    	?>
    	<div id="item_self">
    		<table id="info_self">
    		  <tr>
    		    <td class="t_name" id="t1_r1_c1"> �� &nbsp��: </td>
    		    <td class="t_info" id="t1_r1_c2"> <?php echo $nickname; ?></td>	
    		    <td class="t_name" id="t1_r1_c3"> �� &nbsp��: </td>
    		    <td class="t_info" id="t1_r1_c4"> <?php echo $mysex; ?></td>
    		    <td class="t_name" id="t1_r1_c5"> �� &nbsp��: </td>
    		    <td class="t_info" id="t1_r1_c6"> <?php echo $mygroup; ?> </td>  
    		  </tr>	
    		  <tr>
    		    <td class="t_name" id="t1_r2_c1"> �� Դ ��: </td>
    		    <td class="t_info" id="t1_r2_c2"> <?php echo $myplace; ?></td>	
    		    <td class="t_name" id="t1_r2_c3"> ��������: </td>
    		    <td class="t_info" id="t1_r2_c4"> <?php echo $myborn; ?></td> 
    		    <td class="t_name" id="t1_r2_c5"> ����ʱ��: </td>
    		    <td class="t_info" id="t1_r2_c6"> <?php echo $mytime; ?></td>        		    
    		  </tr>
    		  <tr>	
    		    <td class="t_name" id="t1_r3_c1"> ��ϵ�绰: </td>
    		    <td class="t_info" id="t1_r3_c2"> <?php echo $myphone; ?></td>  
    		    <td class="t_name" id="t1_r3_c3"> �ڲ�����: </td>
    		    <td class="t_info" id="t1_r3_c4"> <?php echo $mymail; ?></td>	
    		  </tr>			
    		</table>    		
    	</div>
    	<div id="item_pic">  
    		<?php
    	  	$pic_path = "../img/weixin/".$username.".jpg";
    	  	if( !file_exists($pic_path) ) {
    	      $pic_path = "../img/weixin/ziruyu.jpg";
    	      $title_str= "ɨɨ����Ԣ��΢�Ű�!";
    	      echo "<img src=$pic_path alt='ɨ��΢�Ű�' width='100%' height='100%' title=$title_str />";
    	    } else {
    	    	$title_str = "ɨɨ".$nickname."��΢�Ű�!";
    	      echo "<img src=$pic_path alt='ɨ��΢�Ű�' width='100%' height='100%' title=$title_str />";
    	    }
    	  ?>
    	</div>
    	
    	<div id="tips_pic">
    	   <p> ΢�Ŷ�ά�� </p>
    	</div>
    	
    	<div id="item_work">
    		<table id="info_work">
    		  <tr>
    		    <td class="t_name" id="t2_r1_c1"> ���ڹ�Ԣ: </td>
    		    <td class="t_info" id="t2_r1_c2"> <?php echo print_apartment($myapart); ?></td>	
    		    <td class="t_name" id="t2_r1_c3"> ��������: </td>
    		    <td class="t_info" id="t2_r1_c4"> <?php echo $myteam; ?></td>
    		    <td class="t_name" id="t2_r1_c5"> �㱨����: </td>
    		    <td class="t_info" id="t2_r1_c6"> <?php echo $myleader; ?> </td>  
    		  </tr>	
    		  <tr>
    		    <td class="t_name" id="t2_r2_c1"> �û�����: </td>
    		    <td class="t_info" id="t2_r2_c2"> <?php echo $myauth; ?></td>	
    		    <td class="t_name" id="t2_r2_c3"> ����ְ��: </td>
    		    <td class="t_info" id="t2_r2_c4" colspan="4"> <?php echo $myduty; ?></td>  
    		  </tr>
    		  <tr>	
    		    <td class="t_name" id="t2_r3_c1"> ע������: </td>
    		    <td class="t_info" id="t2_r3_c2"> <?php echo $username; ?></td>     		
    		    <td class="t_name" id="t2_r3_c3"> ��ע˵��: </td>
    		    <td class="t_info" id="t2_r3_c4" colspan="4"> <?php echo $myremark; ?></td> 		    		  	
    		  </tr>			
    		</table>     		  
    	</div>
    	<div id="item_ctrl">
    		  <input class="rev_btn" type="button" value="��������" onclick="setPwd()" />
    		  <input class="rev_btn" type="button" value="���ϸ���" onclick="setInf()" disabled="disabled" />
    		  <input class="rev_btn" type="button" value="���ݵ���" onclick="importDB()" />
    	</div>
    </div>
	</div>	
	<div id="footer">	
    <?php  require_once("foot.php");  ?>	
  </div>
</div>
</body>	
</html>