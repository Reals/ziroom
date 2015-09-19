     // 根据房屋状态初始化控制失能/使能状态，页面onload时会调用
     function initial_cfg() {
     	   document.getElementById("r_num").value = "";
     	   document.getElementById("r_style").value = "";
     	   document.getElementById("r_status").value = "room_idle";     	   
//         document.getElementById("r_0").disabled = true;
//         document.getElementById("r_1").disabled = true;
//         document.getElementById("r_2").disabled = true;
//         document.getElementById("r_3").disabled = true;
//         document.getElementById("r_4").disabled = true;
//         document.getElementById("r_5").disabled = true;         
         document.getElementById("r_contract").disabled = true;
         document.getElementById("r_renter").disabled = true;
         document.getElementById("r_phone").disabled = true;
         document.getElementById("r_start").disabled = true;
         document.getElementById("r_stop").disabled = true;
         document.getElementById("r_remark").disabled = true;    
     }     
     
     // 根据房屋状态初始化控制失能/使能状态，房屋状态被改变时调用  
     function statusChange(r_status) {   
         switch(r_status) {
           case "room_rented": // 已出租   
			         document.getElementById("r_contract").disabled = false;
			         document.getElementById("r_renter").disabled = false;
			         document.getElementById("r_phone").disabled = false;
			         document.getElementById("r_start").disabled = false;
			         document.getElementById("r_stop").disabled = false;
			         document.getElementById("r_remark").disabled = false; 
               break;         
           case "room_idle": 
           case "room_decorating":
           case "room_discarded":
           case "room_occupied":  
               document.getElementById("r_contract").disabled = true;
               document.getElementById("r_renter").disabled = true;
               document.getElementById("r_phone").disabled = true;
               document.getElementById("r_start").disabled = true;
               document.getElementById("r_stop").disabled = true;
               document.getElementById("r_remark").disabled = true;
               break;
       	   default : alert("DEBUG MODE: ERROR HAPPENED!");break;
         }	
     }
     
     // 检查用户通过文本框输入的房号是否为正整数
     function numCheck() {
     	   var r_num = document.getElementById("r_num").value; 
     	   if( r_num == "" ) {
     	     alert("请输入待修改信息的房间号");
     	     return false;
     	   }
     	   if( isNaN(r_num) || r_num <= 0) {
     	     alert("您输入的房间号有误，房间号不能包含字母或为非正数！");	
     	     return false;
     	   }    
     	   return true; 	
     }     
     