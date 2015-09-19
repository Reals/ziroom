<?php
    session_start();
    require_once("common.php");
?>

<html>
	
<head>
  <title> Excel导入数据库 </title>	
  <meta http-equiv="Content-Type" content="text/html; charset=gbk" />
  
	<script language='javascript'>
		 function myImport() {
		 	   var sel = document.getElementsByName("im_sel");
		     if( !(sel[0].checked || sel[1].checked) ) {
		       alert("请选择导入的数据类型！"); 
		       return false;
		     }
		     document.getElementById("im_tag").value = "do_im";
		     document.getElementById("myform").submit();		     
		     return true;
		 }
		 function myReturn() {
		    location.href = "user_info.php";	
		 }
		 function removeRoom() {
		 	   if( prompt("请输入清空数据授权码。","password") != "authority" ) {
		 	     alert("授权码输入错误，请重新输入！");
		 	     return false; 	
		 	   }
		 	   document.getElementById("im_tag").value = "do_remroom";
		 	   document.getElementById("myform").submit();
		 	   return true;
		 }
		 function removeRenter() {
		 	   if( prompt("请输入清空数据授权码。","password") != "authority" ) {
		 	     alert("授权码输入错误，请重新输入！");
		 	     return false; 	
		 	   }
		 	   document.getElementById("im_tag").value = "do_remrenter";
		     document.getElementById("myform").submit();	
		 }
	</script>
	
	<style type="text/css">
		body label {
		  font-family:'幼圆';
		  font-size:15px;	
		}
		#im_room,#im_renter {
		  padding-top:10px;
		  padding-bottom:10px;	
		  margin-top:18px;		
		}
	  #import,#export {
	  	font-family:'宋体';
	  	font-size:13px;
	  	padding:6px 15px 6px 15px;
	  	margin-top:18px;
	  }
	  #rem_room,#rem_rent,#return {
	  	font-family:'宋体';
	  	font-size:13px;
	  	padding:6px 15px 6px 15px;
	  	margin-top:18px;
	  	width:135px;
	  }
	</style>
	
</head>	

<body>
	<form method="post" action="" id="myform"> 
     <input type="radio" id="im_room" name="im_sel" value="sel_room" />
     <label for="im_room" title="from import_room.xlsx"> 导入房间信息 </label><br>
     <input type="radio" id="im_renter" name="im_sel" value="sel_renter" />
     <label for="im_renter" title="from import_renter.xlsx"> 导入客人信息 </label><br>
     <input type="submit" value="导入" id="import" onclick="myImport()" />
     <input type="button" value="导出" id="export" onclick="myExport()" disabled="disabled" /><br>
     <input type="button" value="清空房间数据" id="rem_room" onclick="removeRoom()" title="客人信息也将一并清空" /> <br>
     <input type="button" value="清空客人数据" id="rem_rent" onclick="removeRenter()" title="房间信息不会被清空" /> <br>
     <input type="button" value="返回上级页面" id="return" onclick="myReturn()" /> 
     <input type="hidden" id="im_tag" name="im_tag" value="not_im" />
  </form>
  
  <?php // 本程序用于解析xlsx文件格式并导入到ziroom应用中相应数据
    if( $_POST['im_tag'] == 'do_im' ) {
      $sel_type = $_POST['im_sel'];
      echo "<script> document.getElementById('im_tag').value = 'not_im'; </script>";
      if($sel_type == "sel_room") {
        $file_path = "../database/info_room.xls";
        echo "<script> document.getElementById('im_room').checked = true; </script>";
      } else if($sel_type == "sel_renter") {
        $file_path = "../database/info_renter.xls"; 
        echo "<script> document.getElementById('im_renter').checked = true; </script>";
      }
      if( !file_exists($file_path) ) {
        print_alert("请将待导入的数据文件上传到服务器，且保持文件命名正确！");
        return;
      }      
      require_once("../classes/phpExcelReader/oleread.inc");
      require_once("../classes/phpExcelReader/reader.php");
      $zr_list = new Spreadsheet_Excel_Reader();
      $zr_list->setOutputEncoding('GBK'); 
      $zr_list->read($file_path);
      
      $sql_links = sqlConnect();
      $sql_quote = "select `num`,`status` from `zr_roomlist`"; 
      $sql_query = $sql_links->getData( $sql_quote );
      
      switch( $sel_type ) {
        case "sel_room": // 操作房间信息，如果房间存在，则不会再执行插入
          $rowsCnt = $zr_list->sheets[0]['numRows'];
          $colsCnt = $zr_list->sheets[0]['numCols'];
          $delItem = array();
          if( $colsCnt > 3) { 
          	print_alert("[ERROR] info_room.xls数据表超过3列！");
            return;
          }
          if( $rowsCnt < 2) {
            print_alert("[ERROR] info_room.xls数据表无任何有效记录！");
            return;
          }
          if( $zr_list->sheets[0]['cells'][1][1] != 'num' ||
               $zr_list->sheets[0]['cells'][1][2] != 'style' || 
                $zr_list->sheets[0]['cells'][1][3] != 'status' ) {
            print_alert("[ERROR] info_room.xls数据表列名或列序有误!");
            return;
          }
          for( $idx = 2; $idx <= $rowsCnt; $idx ++) {
	          $num = $zr_list->sheets[0]['cells'][$idx][1];
	          $style = $zr_list->sheets[0]['cells'][$idx][2];
	          $status = $zr_list->sheets[0]['cells'][$idx][3];             
            if( isInsert($sql_query, $num) == false ) {
            	$delItem[] = $num;
              continue;
            }
            $sql_quot0 = "(`num`,`style`,`status`)";
            $sql_quot1 = "('$num','$style','$status')";
            $sql_quote = "insert into `zr_roomlist` $sql_quot0 values $sql_quot1";
					  $sql_links->runSql($sql_quote);
					  if($sql_links->errno() != 0) {
					    die("Error:" . $sql_links->errmsg());
					  }    
          }
          printNotInsert($delItem);
          break;
        case "sel_renter": // 操作客人信息，如果房间存在但不为闲置状态则不插入，其他情况均执行插入
          $rowsCnt = $zr_list->sheets[0]['numRows'];
          $colsCnt = $zr_list->sheets[0]['numCols'];
          $delItem = array();
          if( $colsCnt > 16) { 
          	print_alert("[ERROR] info_renter.xls数据表超过16列！");
            return;
          }
          if( $rowsCnt < 2) {
            print_alert("[ERROR] info_renter.xls数据表无任何有效记录！");
            return;
          }
          if( $zr_list->sheets[0]['cells'][1][1] != 'num' ||
               $zr_list->sheets[0]['cells'][1][2] != 'renter' || 
                $zr_list->sheets[0]['cells'][1][3] != 'born' ||
                $zr_list->sheets[0]['cells'][1][4] != 'sex' || 
                $zr_list->sheets[0]['cells'][1][5] != 'phone' || 
                $zr_list->sheets[0]['cells'][1][6] != 'career' ||
                $zr_list->sheets[0]['cells'][1][7] != 'contract' ||
                $zr_list->sheets[0]['cells'][1][8] != 'price' ||
                $zr_list->sheets[0]['cells'][1][9] != 'payway' ||
                $zr_list->sheets[0]['cells'][1][10] !='elec_ini_amount' ||
                $zr_list->sheets[0]['cells'][1][11] != 'start' ||
                $zr_list->sheets[0]['cells'][1][12] != 'stop' ||
                $zr_list->sheets[0]['cells'][1][13] != 'pay_t2' ||
                $zr_list->sheets[0]['cells'][1][14] != 'pay_t3' ||
                $zr_list->sheets[0]['cells'][1][15] != 'pay_t4' ||
                $zr_list->sheets[0]['cells'][1][16] != 'remark' ) {
            print_alert("[ERROR] info_room.xls数据表列名或列序有误!");
            return;
          }
          for( $idx = 2; $idx <= $rowsCnt; $idx ++) {
	          $num = $zr_list->sheets[0]['cells'][$idx][1];
	          $renter = $zr_list->sheets[0]['cells'][$idx][2];
	          $born = $zr_list->sheets[0]['cells'][$idx][3];  
	          $sex = $zr_list->sheets[0]['cells'][$idx][4];           
            $phone = $zr_list->sheets[0]['cells'][$idx][5]; 
            $career = $zr_list->sheets[0]['cells'][$idx][6];
            $contract = $zr_list->sheets[0]['cells'][$idx][7];
            $price = $zr_list->sheets[0]['cells'][$idx][8];
            $payway = $zr_list->sheets[0]['cells'][$idx][9];
            $elec_ini_amount = ($zr_list->sheets[0]['cells'][$idx][10] == "null") ? 0 : $zr_list->sheets[0]['cells'][$idx][10];
            $start = $zr_list->sheets[0]['cells'][$idx][11];
            $stop = $zr_list->sheets[0]['cells'][$idx][12];
            $pay_t2 =($zr_list->sheets[0]['cells'][$idx][13] == "null") ? "" : $zr_list->sheets[0]['cells'][$idx][13];
            $pay_t3 =($zr_list->sheets[0]['cells'][$idx][14] == "null") ? "" : $zr_list->sheets[0]['cells'][$idx][14];
            $pay_t4 =($zr_list->sheets[0]['cells'][$idx][15] == "null") ? "" : $zr_list->sheets[0]['cells'][$idx][15];
            $remark =($zr_list->sheets[0]['cells'][$idx][16] == "null") ? "" : $zr_list->sheets[0]['cells'][$idx][16];	          
//	          str_replace('/','-',$born);
//	          str_replace('/','-',$start);
//	          str_replace('/','-',$stop);
//	          str_replace('/','-',$pay_t2);
//	          str_replace('/','-',$pay_t3);
//	          str_replace('/','-',$pay_t4);
	          $status = "已出租";
            if( isUpdate($sql_query, $num) == false ) {
            	$delItem[] = $num;
              continue;
            }
					  $sql_updt0 = "`status`='$status',`renter`='$renter',`sex`='$sex',`born`='$born',`phone`='$phone',`career`='$career',`remark`='$remark',";
						$sql_updt1 = "`contract`='$contract',`price`='$price',`payway`='$payway',`elec_ini_amount`='$elec_ini_amount',`start`='$start',`stop`='$stop',";
						$sql_updt2 = "`pay_t2`='$pay_t2',`pay_t3`='$pay_t3',`pay_t4`='$pay_t4'";
						$sql_update= $sql_updt0.$sql_updt1.$sql_updt2;
						$sql_quote = "update `zr_roomlist` set $sql_update where `zr_roomlist`.`num`='$num'";
						$sql_links->runSql($sql_quote);
						if ($sql_links->errno() != 0) {
						   die("Error:" . $sql_links->errmsg());
						} 
          }
          printNotInsert($delItem);                          
          break;	
        default: print_alert("ERROR HAPPEN: NO AVAILABLE SELECTED TYPE!");
      }
			$sql_links->closeDb();        
    } else if( $_POST['im_tag'] == 'do_remroom' ) {
    	$sql_links = sqlConnect();
    	$sql_quote = "delete from `zr_roomlist`";
    	$sql_links->runSql($sql_quote);
      if ($sql_links->errno() != 0) {
        die("Error:" . $sql_links->errmsg());
      }
      $sql_links->closeDb();
      print_alert("数据库中所有房间连同客人信息已被您清空！");	
    } else if( $_POST['im_tag'] == 'do_remrenter' ) {
    	$sql_links = sqlConnect();
    	//$sql_quote = "select * from `zr_roomlist` where `status`='已出租'";
    	//$sql_query = $sql_links->getData($sql_quote);
		  $sql_updt0 = "`status`='闲置中',`renter`='',`sex`='',`born`='',`phone`='',`career`='',`remark`='',";
			$sql_updt1 = "`contract`='',`price`='',`payway`='',`elec_ini_amount`='',`start`='',`stop`='',";
			$sql_updt2 = "`pay_t2`='',`pay_t3`='',`pay_t4`='',`elec_cur_amount`='',`pay_status`='UUUUUUUUUUUU',`pay_mfytime`=''";
			$sql_update= $sql_updt0.$sql_updt1.$sql_updt2;
			$sql_quote = "update `zr_roomlist` set $sql_update where `zr_roomlist`.`status`='已出租'";
			$sql_links->runSql($sql_quote);
			if ($sql_links->errno() != 0) {
			   die("Error:" . $sql_links->errmsg());
			} 
			$sql_links->closeDb();  	
      print_alert("数据库中所有已出租房间的客人信息已被您清空！");	
    }    
  ?>
	
</body>

</html>