<!--
  1. common function located here for key pages
  2. process for safety when user exited
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
  function print_apartment($belongto) { // ��ӡ��Ԣ����
      switch($belongto) {
        case "wj_room": return "������������Ԣ"; 
      	case "sd_room": return "�ϵ���������Ԣ"; 
      	case "yy_room": return "���˴�15����Ԣ"; 
      	case "jf_room": return "������԰����Ԣ";
      	case "hl_room": return "��ӭ��7�Ź�������Ԣ";
      	case "xz_room": return "��ֱ����ͩ����Ԣ"; 
      	default:        return "������Ԣ��Ŀ������Ա"; 
      }  
  }  
  function print_alert($str) {
  	 echo "<html><head><meta charset='GBK'></head><body><script>alert('$str');</script></body></html>"; 
  }
  function print_status($str) {
      switch($str) {
        case "room_idle": return "������"; 
        case "room_rented": return "�ѳ���";
        case "room_decorating": return "װ����";
        case "room_discarded": return "�ѷ���";
        case "room_occupied": return "��ռ��";  
        case "room_all": return "��ѡ��";	
  	}
  }
  
  function select_status($str) {
      switch($str) {
      	case "������": return "room_idle";
      	case "�ѳ���": return "room_rented";
      	case "װ����": return "room_decorating";
      	case "�ѷ���": return "room_discarded";
      	case "��ռ��": return "room_occupied";      
      	default: echo "����״̬δ֪����:"."[".$str."]";	
      }  	
  }
  
  function print_payway($str) {
      switch($str) {
        case "pay_year": return "�긶";
        case "pay_halfyear": return "���긶";
        case "pay_season": return "����";
        case "pay_month": return "�¸�";	
      }	
  }
  function select_payway($str) {
      switch($str) {
      	case "�긶": return "pay_year";
      	case "���긶": return "pay_halfyear";
      	case "����": return "pay_season";
      	case "�¸�": return "pay_month";
      }  	
  }
  function print_sex($str) {
      switch($str) {
        case "male": return "��";
        case "female": return "Ů";	
      }	
  }
  function select_sex($str) {
      switch($str) {
      	case "��": return "male";
      	case "Ů": return "female";
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
        print_alert("POST�������ݴ���");     	
 	 
   	 // ��ý����ʱ���
   	 $cur_date = date('Y-m-d');   	 
     $cur_ts = strtotime($cur_date);
     // ��ý������յ�ʱ���
     $bir_date = date('Y').'-'.$birthday;
     $bir_ts = strtotime($bir_date);     
     // ��÷�Χ��������ڵ�ʱ���
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

  function sqlConnect() { // �������ݿ⣬�������ݿ���
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
  	    if( $num == $zr_num && $status == "������")	{
  	      $isUpdate = true;
  	      break;	
  	    }
  	  }
  	  return $isUpdate;
  }
  
  function printNotInsert($delItem) {
      $cnt = sizeof($delItem);	
      if( $cnt == 0) {
        echo "<br><p style='color:green;font-family:\"��Բ\";font-size:15px;'><b>�����������ݾ��ɹ����룡</b></p>";
        return;	
      }
      echo "<br><p style='color:red;font-family:\"��Բ\";font-size:15px;'><b>���з�������δ�ɹ����룺</b></p>";
      echo "<table title='�����������ݿ����Ѿ����ڸ÷��䣡' style='border-style:solid'>";
      echo "<th style='height:28px;color:red;font-family:\"��Բ\";font-size:14px;background-color:gray;'> ��� </th>";
      echo "<th style='height:28px;color:red;font-family:\"��Բ\";font-size:14px;background-color:gray;'> ����� </th>";
      foreach ( $delItem as $index=>$item) {
        echo "<tr>";
        echo "<td style='width:80px;height:22px;color:red;font-family:\"Calibri\";font-size:12px;border-style:solid'>".($index+1)."</td>";
        echo "<td style='width:120px;height:22px;color:red;font-family:\"Calibri\";font-size:12px;border-style:solid'>".$item."</td>";
        echo "</tr>";
      }
      echo "</table>";
  }
  
  if( empty($_SESSION) ) // �ж��Ƿ��û��Ѿ��˳�
     echo "<script language=javascript>location.href='page_timeout.php';</script>"; 
?>