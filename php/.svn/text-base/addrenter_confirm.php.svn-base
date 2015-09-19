<?php
   session_start();
   require_once("common.php");
   
   $num = $_POST['r_num'];
   $renter = $_POST['r_renter'];
   $sex = $_POST['r_sex'];
   $born = $_POST['r_born'];
   $phone = $_POST['r_phone'];
   $career = $_POST['r_career'];   
   $contract = $_POST['r_contract'];
   $price = $_POST['r_price'];
   $payway = $_POST['r_payway'];
   $elec_ini = $_POST['r_elec_ini'];
   $start = $_POST['r_start'];
   $stop = $_POST['r_stop'];
   $r_2date = empty($_POST['r_2date']) ? "" : $_POST['r_2date'];
   $r_3date = empty($_POST['r_3date']) ? "" : $_POST['r_3date'];
   $r_4date = empty($_POST['r_4date']) ? "" : $_POST['r_4date'];
   $remark = $_POST['r_remark'];
   
   $s_status = print_status("room_rented");
   $s_payway = print_payway($payway);
   $s_sex = print_sex($sex);

   $sql_links = sqlConnect();
   $sql_quote0 = "`status`='$s_status',`renter`='$renter',`sex`='$s_sex',`born`='$born',`phone`='$phone',`career`='$career',`contract`='$contract',`price`='$price',`payway`='$s_payway',`elec_ini_amount`='$elec_ini',";
   $sql_quote1 = "`pay_status`='UUUUUUUUUUUU',`pay_mfytime`='',	`elec_cur_amount`='',`elec_mfy_time`='',`start`='$start',`stop`='$stop',`pay_t2`='$r_2date',`pay_t3`='$r_3date',`pay_t4`='$r_4date',`remark`='$remark'";
   $sql_update = $sql_quote0.$sql_quote1;
	 $sql_quote = "update `zr_roomlist` set $sql_update where `zr_roomlist`.`num`='$num'";   
   $sql_links->runSql($sql_quote);
   if ($sql_links->errno() != 0) {
      die("Error:" . $sql_links->errmsg());
   }    
   $sql_links->closeDb();   
   print_alert('新客户信息已经成功添加！');
   echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
?>  