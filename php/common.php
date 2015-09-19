<!--
  1. common function located here for key pages
  2. process for safety when user exited
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
  function print_apartment($belongto) { // 打印公寓名称
      switch($belongto) {
        case "wj_room": return "望京阳光自如寓"; 
      	case "sd_room": return "上地凌云自如寓"; 
      	case "yy_room": return "亚运村15自如寓"; 
      	case "jf_room": return "将府公园自如寓";
      	case "hl_room": return "欢迎谷7号工场自如寓";
      	case "xz_room": return "西直门梧桐自如寓"; 
      	default:        return "非自如寓项目工作人员"; 
      }  
  }  
  function print_alert($str) {
  	 echo "<html><head><meta charset='GBK'></head><body><script>alert('$str');</script></body></html>"; 
  }
  function print_status($str) {
      switch($str) {
        case "room_idle": return "闲置中"; 
        case "room_rented": return "已出租";
        case "room_decorating": return "装修中";
        case "room_discarded": return "已废弃";
        case "room_occupied": return "已占用";  
        case "room_all": return "请选择";	
  	}
  }
  
  function select_status($str) {
      switch($str) {
      	case "闲置中": return "room_idle";
      	case "已出租": return "room_rented";
      	case "装修中": return "room_decorating";
      	case "已废弃": return "room_discarded";
      	case "已占用": return "room_occupied";      
      	default: echo "房间状态未知错误:"."[".$str."]";	
      }  	
  }
  
  function print_payway($str) {
      switch($str) {
        case "pay_year": return "年付";
        case "pay_halfyear": return "半年付";
        case "pay_season": return "季付";
        case "pay_month": return "月付";	
      }	
  }
  function select_payway($str) {
      switch($str) {
      	case "年付": return "pay_year";
      	case "半年付": return "pay_halfyear";
      	case "季付": return "pay_season";
      	case "月付": return "pay_month";
      }  	
  }
  function print_sex($str) {
      switch($str) {
        case "male": return "男";
        case "female": return "女";	
      }	
  }
  function select_sex($str) {
      switch($str) {
      	case "男": return "male";
      	case "女": return "female";
      }
  }
  
  function calcAge($birthday) {
	    list($by,$bm,$bd)=explode('-',$birthday);
	    $cm = date('n');
	    $cd = date('j');
	    $age = date('Y') - $by - 1;
	    if (($cm > $bm)|| ($cm==$bm && ($cd > $bd))) $age++;
	    return $age;
  }   	

  function isInScope($birthday,$qry_scope) {  	
   	  $date_after_month = date('Y-m-d',strtotime('+30 days')); // after one month
   	  $date_after_halfm = date('Y-m-d',strtotime('+15 days'));  // after half month
   	  $date_after_week = date('Y-m-d',strtotime('+7 days')); // after one week						     
      if( $qry_scope == "scope_fullmonth" )
        $end_date = $date_after_month;
      else if ( $qry_scope == "scope_halfmonth" )
        $end_date = $date_after_halfm;
      else if ( $qry_scope  == "scope_fullweek" )
        $end_date = $date_after_week;
      else
        print_alert("POST参数传递错误！");     	
 	 
   	 // 获得今天的时间戳
   	 $cur_date = date('Y-m-d');   	 
     $cur_ts = strtotime($cur_date);
     // 获得今年生日的时间戳
     $bir_date = date('Y').'-'.$birthday;
     $bir_ts = strtotime($bir_date);     
     // 获得范围内最大日期的时间戳
     $end_ts = strtotime($end_date);
     return ($bir_ts>=$cur_ts && $bir_ts<=$end_ts);
  }
  
  function isInAlarm($cur_elec, $qry_scope) {
  	  switch($qry_scope) {
  	  	case "no_scope": return true;
  	  	case "scope_lvl0":
  	  	                 return (($cur_elec >= 50) && ($cur_elec < 100));
  	  	case "scope_lvl1":
  	  	                 return (($cur_elec >= 20) && ($cur_elec < 50));
  	  	case "scope_lvl2":
  	  	                 return (($cur_elec >= 0) && ($cur_elec < 20));
  	  }  
  }
  
  function isInLvl0($cur_elec) {
  	  return (($cur_elec >= 50) && ($cur_elec < 100));
  }
  function isInLvl1($cur_elec) {
  	  return (($cur_elec >= 20) && ($cur_elec < 50));
  }
  function isInLvl2($cur_elec) {
  	  return (($cur_elec >= 0) && ($cur_elec < 20));
  }
  
  function calcTimestamp($date) {
	    $datey = substr($date,0,4);
	    $datem = substr($date,5,2);       	  	    	   
	    $dated = substr($date,8,2);        	  	    	   
	    return mktime(0,0,0,$datem,$dated,$datey); 	
  }

  function sqlConnect() { // 连接数据库，返回数据库句柄
      $sql_links = new SaeMysql();
      if($sql_links->errno() != 0) // database connection check
        echo "<script>alert('database connection failed.');</script>";	
      $sql_links->setCharset("GBK");  
      return $sql_links;  
  }  
  
  function isInsert($sql_q, $zr_num) {
      $isInsert = true;
      if( sizeof($sql_q) == 0) return $isInsert; 
      foreach($sql_q as $index=>$record) {
        $num = $record['num'];
        if( $num == $zr_num) {
          $isInsert = false;
          break;	
        }	
      }
  	  return $isInsert;
  }
  
  function isUpdate($sql_q,$zr_num) {
  	  $isUpdate = false;
  	  if( sizeof($sql_q) == 0) return $isUpdate;
  	  foreach($sql_q as $index=>$record) {
  	    $num = $record['num'];
  	    $status = $record['status'];
  	    if( $num == $zr_num && $status == "闲置中")	{
  	      $isUpdate = true;
  	      break;	
  	    }
  	  }
  	  return $isUpdate;
  }
  
  function printNotInsert($delItem) {
      $cnt = sizeof($delItem);	
      if( $cnt == 0) {
        echo "<br><p style='color:green;font-family:\"幼圆\";font-size:15px;'><b>表内所有数据均成功插入！</b></p>";
        return;	
      }
      echo "<br><p style='color:red;font-family:\"幼圆\";font-size:15px;'><b>下列房间数据未成功插入：</b></p>";
      echo "<table title='可能由于数据库中已经存在该房间！' style='border-style:solid'>";
      echo "<th style='height:28px;color:red;font-family:\"幼圆\";font-size:14px;background-color:gray;'> 序号 </th>";
      echo "<th style='height:28px;color:red;font-family:\"幼圆\";font-size:14px;background-color:gray;'> 房间号 </th>";
      foreach ( $delItem as $index=>$item) {
        echo "<tr>";
        echo "<td style='width:80px;height:22px;color:red;font-family:\"Calibri\";font-size:12px;border-style:solid'>".($index+1)."</td>";
        echo "<td style='width:120px;height:22px;color:red;font-family:\"Calibri\";font-size:12px;border-style:solid'>".$item."</td>";
        echo "</tr>";
      }
      echo "</table>";
  }
  
  if( empty($_SESSION) ) // 判断是否用户已经退出
     echo "<script language=javascript>location.href='page_timeout.php';</script>"; 
?>