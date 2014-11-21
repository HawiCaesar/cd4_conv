<?php
function graphTests($year,$month,$quarter,$biAnn,$dev,$patna,$duration,$from,$to){
				$arr=array(); 
				 $num=0;
			if($duration==4){
	 $sql="SELECT IF( MONTH( `resultDate` ) =01, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =02, COUNT( testID ) ,  '0' ) AS  'Feb',          IF( MONTH( resultDate ) =03, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =04, COUNT( testID ) ,  '0' ) AS  'Apr', IF( MONTH(          resultDate ) =05, COUNT( testID ) ,  '0' ) AS  'May', IF( MONTH( resultDate ) =06, COUNT( testID ) ,  '0' ) AS  'Jun', IF( MONTH( resultDate )          =07, COUNT( testID ) ,  '0' ) AS  'Jul', IF( MONTH( resultDate ) =08, COUNT( testID ) ,  '0' ) AS  'Aug', IF( MONTH( resultDate ) =09, COUNT(          testID ) ,  '0' ) AS  'Sep', IF( MONTH( resultDate ) = 10 , COUNT( testID ) ,  '0' ) AS  'Oct', IF( MONTH( resultDate ) =11, COUNT( testID ) ,          '0' ) AS  'Nov', IF( MONTH( resultDate ) =12, COUNT( testID ) ,  '0' ) AS  'Dec', COUNT(  `testID` ) AS  'Year ".$year."', COUNT( IF(          `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0 ) ) AS  '<350'
          FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());

	while($rs=mysql_fetch_array($query)){
	
	$arr[$num]=$rs["Jan"];	$num++;
	$arr[$num]=$rs["Feb"]; $num++;
	$arr[$num]=$rs["Mar"]; $num++;
	$arr[$num]=$rs["Apr"]; $num++;
	$arr[$num]=$rs["May"]; $num++;
	$arr[$num]=$rs["Jun"]; $num++;
	$arr[$num]=$rs["Jul"]; $num++;
	$arr[$num]=$rs["Aug"]; $num++;
	$arr[$num]=$rs["Sep"]; $num++;
	$arr[$num]=$rs["Oct"]; $num++;
	$arr[$num]=$rs["Nov"]; $num++;
	$arr[$num]=$rs["Dec"];

	}
		}
	else if($duration==1){
		 $sql="SELECT IF( MONTH( `resultDate` ) =".$month.", COUNT( `testID` ) ,  '0' ) AS  'Jan', COUNT(  `testID` ) AS  'Year ".$year."', COUNT( IF(          `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0 ) ) AS  '<350'
          FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]=$rs["Jan"];
	}
	  }	
	else if($duration==2){
		if($quarter==1){
		 $sql="SELECT IF( MONTH( `resultDate` ) =01, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =02, COUNT( testID ) ,  '0' ) AS               'Feb', IF( MONTH( resultDate ) =03, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =04, COUNT( testID ) ,  '0' ) AS  'Apr',                COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350',  NULL , 0 ) ) AS  '<350'
                FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]=$rs["Jan"];	$num++;
	$arr[$num]=$rs["Feb"]; $num++;
	$arr[$num]=$rs["Mar"]; $num++;
	$arr[$num]=$rs["Apr"];
	  }
		}
	  else if($quarter==2){
		 $sql="SELECT IF( MONTH( `resultDate` ) =05, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =06, COUNT( testID ) ,  '0' ) AS               'Feb', IF( MONTH( resultDate ) =07, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =08, COUNT( testID ) ,  '0' ) AS  'Apr',                COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350',  NULL , 0 ) ) AS  '<350'
                FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]=$rs["May"]; $num++;
	$arr[$num]=$rs["Jun"]; $num++;
	$arr[$num]=$rs["Jul"]; $num++;
	$arr[$num]=$rs["Aug"];
	  }
	 }
	 if($quarter==3){
		 $sql="SELECT IF( MONTH( `resultDate` ) =09, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =10, COUNT( testID ) ,  '0' ) AS               'Feb', IF( MONTH( resultDate ) =11, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =12, COUNT( testID ) ,  '0' ) AS  'Apr',                COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350',  NULL , 0 ) ) AS  '<350'
                FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]=$rs["Sep"]; $num++;
	$arr[$num]=$rs["Oct"]; $num++;
	$arr[$num]=$rs["Nov"]; $num++;
	$arr[$num]=$rs["Dec"];
	   }
	  }
	}
	else if($duration==3){
		if($biAnn==1){
		 $sql="SELECT IF( MONTH( `resultDate` ) =01, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =02, COUNT( testID ) ,  '0' ) AS      		   'Feb', IF( MONTH( resultDate ) =03, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =04, COUNT( testID ) ,  '0' ) AS  'Apr',               IF( MONTH( resultDate ) =05, COUNT( testID ) ,  '0' ) AS  'May', IF( MONTH( resultDate ) =06, COUNT( testID ) ,  '0' ) AS  'Jun' , COUNT( IF(          `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0               ) ) AS  '<350'
               FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]=$rs["Jan"];	$num++;
	$arr[$num]=$rs["Feb"]; $num++;
	$arr[$num]=$rs["Mar"]; $num++;
	$arr[$num]=$rs["Apr"]; $num++;
	$arr[$num]=$rs["May"]; $num++;
	$arr[$num]=$rs["Jun"];
	 }
	}
	else if($biAnn==2){
		 $sql="SELECT IF( MONTH( `resultDate` ) =07, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =08, COUNT( testID ) ,  '0' ) AS      		   'Feb', IF( MONTH( resultDate ) =09, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =10, COUNT( testID ) ,  '0' ) AS  'Apr',               IF( MONTH( resultDate ) =11, COUNT( testID ) ,  '0' ) AS  'May', IF( MONTH( resultDate ) =12, COUNT( testID ) ,  '0' ) AS  'Jun' , COUNT(               IF( `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0               ) ) AS  '<350'
               FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]=$rs["Jul"]; $num++;
	$arr[$num]=$rs["Aug"]; $num++;
	$arr[$num]=$rs["Sep"]; $num++;
	$arr[$num]=$rs["Oct"]; $num++;
	$arr[$num]=$rs["Nov"]; $num++;
	$arr[$num]=$rs["Dec"];
	  }
	 }
	}
	else if($duration==5){
		 $sql="SELECT  COUNT( `testID` ) AS  'Jan', COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS 'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0 ) ) AS              '<350' FROM  `test` WHERE partnerID ='".$patna."' AND resultDate BETWEEN '".$from."' AND '".$to."' AND deviceID='".$dev."'";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]=$rs["Jan"];
	}
	}
		return $arr;
		}
				
	
		///errors
function graphErrs($year,$month,$quarter,$biAnn,$dev,$patna,$duration,$from,$to){
				$arr=array(); 
				 $num=0;
			if($duration==4){
	 $sql="SELECT IF( MONTH( `resultDate` ) =01, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =02, COUNT( testID ) ,  '0' ) AS  'Feb',          IF( MONTH( resultDate ) =03, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =04, COUNT( testID ) ,  '0' ) AS  'Apr', IF( MONTH(          resultDate ) =05, COUNT( testID ) ,  '0' ) AS  'May', IF( MONTH( resultDate ) =06, COUNT( testID ) ,  '0' ) AS  'Jun', IF( MONTH( resultDate )          =07, COUNT( testID ) ,  '0' ) AS  'Jul', IF( MONTH( resultDate ) =08, COUNT( testID ) ,  '0' ) AS  'Aug', IF( MONTH( resultDate ) =09, COUNT(          testID ) ,  '0' ) AS  'Sep', IF( MONTH( resultDate ) = 10 , COUNT( testID ) ,  '0' ) AS  'Oct', IF( MONTH( resultDate ) =11, COUNT( testID ) ,          '0' ) AS  'Nov', IF( MONTH( resultDate ) =12, COUNT( testID ) ,  '0' ) AS  'Dec', COUNT(  `testID` ) AS  'Year ".$year."', COUNT( IF(          `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0 ) ) AS  '<350'
          FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());

	while($rs=mysql_fetch_array($query)){
	
	$arr[$num]=$rs["Jan"];	$num++;
	$arr[$num]=$rs["Feb"]; $num++;
	$arr[$num]=$rs["Mar"]; $num++;
	$arr[$num]=$rs["Apr"]; $num++;
	$arr[$num]=$rs["May"]; $num++;
	$arr[$num]=$rs["Jun"]; $num++;
	$arr[$num]=$rs["Jul"]; $num++;
	$arr[$num]=$rs["Aug"]; $num++;
	$arr[$num]=$rs["Sep"]; $num++;
	$arr[$num]=$rs["Oct"]; $num++;
	$arr[$num]=$rs["Nov"]; $num++;
	$arr[$num]=$rs["Dec"];

	}
		}
	else if($duration==1){
		 $sql="SELECT IF( MONTH( `resultDate` ) =".$month.", COUNT( `testID` ) ,  '0' ) AS  'Jan', COUNT(  `testID` ) AS  'Year ".$year."', COUNT( IF(          `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0 ) ) AS  '<350'
          FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]=$rs["Jan"];
	}
	  }	
	else if($duration==2){
		if($quarter==1){
		 $sql="SELECT IF( MONTH( `resultDate` ) =01, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =02, COUNT( testID ) ,  '0' ) AS               'Feb', IF( MONTH( resultDate ) =03, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =04, COUNT( testID ) ,  '0' ) AS  'Apr',                COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350',  NULL , 0 ) ) AS  '<350'
                FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]=$rs["Jan"];	$num++;
	$arr[$num]=$rs["Feb"]; $num++;
	$arr[$num]=$rs["Mar"]; $num++;
	$arr[$num]=$rs["Apr"];
	  }
		}
	  else if($quarter==2){
		 $sql="SELECT IF( MONTH( `resultDate` ) =05, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =06, COUNT( testID ) ,  '0' ) AS               'Feb', IF( MONTH( resultDate ) =07, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =08, COUNT( testID ) ,  '0' ) AS  'Apr',                COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350',  NULL , 0 ) ) AS  '<350'
                FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]=$rs["May"]; $num++;
	$arr[$num]=$rs["Jun"]; $num++;
	$arr[$num]=$rs["Jul"]; $num++;
	$arr[$num]=$rs["Aug"];
	  }
	 }
	 if($quarter==3){
		 $sql="SELECT IF( MONTH( `resultDate` ) =09, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =10, COUNT( testID ) ,  '0' ) AS               'Feb', IF( MONTH( resultDate ) =11, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =12, COUNT( testID ) ,  '0' ) AS  'Apr',                COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350',  NULL , 0 ) ) AS  '<350'
                FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]=$rs["Sep"]; $num++;
	$arr[$num]=$rs["Oct"]; $num++;
	$arr[$num]=$rs["Nov"]; $num++;
	$arr[$num]=$rs["Dec"];
	   }
	  }
	}
	else if($duration==3){
		if($biAnn==1){
		 $sql="SELECT IF( MONTH( `resultDate` ) =01, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =02, COUNT( testID ) ,  '0' ) AS      		   'Feb', IF( MONTH( resultDate ) =03, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =04, COUNT( testID ) ,  '0' ) AS  'Apr',               IF( MONTH( resultDate ) =05, COUNT( testID ) ,  '0' ) AS  'May', IF( MONTH( resultDate ) =06, COUNT( testID ) ,  '0' ) AS  'Jun' , COUNT( IF(          `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0               ) ) AS  '<350'
               FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]=$rs["Jan"];	$num++;
	$arr[$num]=$rs["Feb"]; $num++;
	$arr[$num]=$rs["Mar"]; $num++;
	$arr[$num]=$rs["Apr"]; $num++;
	$arr[$num]=$rs["May"]; $num++;
	$arr[$num]=$rs["Jun"];
	 }
	}
	else if($biAnn==2){
		 $sql="SELECT IF( MONTH( `resultDate` ) =07, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =08, COUNT( testID ) ,  '0' ) AS      		   'Feb', IF( MONTH( resultDate ) =09, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =10, COUNT( testID ) ,  '0' ) AS  'Apr',               IF( MONTH( resultDate ) =11, COUNT( testID ) ,  '0' ) AS  'May', IF( MONTH( resultDate ) =12, COUNT( testID ) ,  '0' ) AS  'Jun' , COUNT(               IF( `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0               ) ) AS  '<350'
               FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]=$rs["Jul"]; $num++;
	$arr[$num]=$rs["Aug"]; $num++;
	$arr[$num]=$rs["Sep"]; $num++;
	$arr[$num]=$rs["Oct"]; $num++;
	$arr[$num]=$rs["Nov"]; $num++;
	$arr[$num]=$rs["Dec"];
	  }
	 }
	}
	else if($duration==5){
		 $sql="SELECT  COUNT( `testID` ) AS  'Jan', COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS 'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0 ) ) AS              '<350' FROM  `test` WHERE partnerID ='".$patna."' AND resultDate BETWEEN '".$from."' AND '".$to."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]=$rs["Jan"];
	}
	}
		return $arr;
		}
	
	
		
//Names  to be displayed
function graphLbls($year,$month,$quarter,$biAnn,$dev,$patna,$duration,$from,$to){
				$arr=array(); 
				 $num=0;
			if($duration==4){
	 $sql="SELECT IF( MONTH( `resultDate` ) =01, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =02, COUNT( testID ) ,  '0' ) AS  'Feb',          IF( MONTH( resultDate ) =03, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =04, COUNT( testID ) ,  '0' ) AS  'Apr', IF( MONTH(          resultDate ) =05, COUNT( testID ) ,  '0' ) AS  'May', IF( MONTH( resultDate ) =06, COUNT( testID ) ,  '0' ) AS  'Jun', IF( MONTH( resultDate )          =07, COUNT( testID ) ,  '0' ) AS  'Jul', IF( MONTH( resultDate ) =08, COUNT( testID ) ,  '0' ) AS  'Aug', IF( MONTH( resultDate ) =09, COUNT(          testID ) ,  '0' ) AS  'Sep', IF( MONTH( resultDate ) = 10 , COUNT( testID ) ,  '0' ) AS  'Oct', IF( MONTH( resultDate ) =11, COUNT( testID ) ,          '0' ) AS  'Nov', IF( MONTH( resultDate ) =12, COUNT( testID ) ,  '0' ) AS  'Dec', COUNT(  `testID` ) AS  'Year ".$year."', COUNT( IF(          `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0 ) ) AS  '<350'
          FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());

	while($rs=mysql_fetch_array($query)){
	
	$arr[$num]="Jan";	$num++;
	$arr[$num]="Feb"; $num++;
	$arr[$num]="Mar"; $num++;
	$arr[$num]="Apr"; $num++;
	$arr[$num]="May"; $num++;
	$arr[$num]="Jun"; $num++;
	$arr[$num]="Jul"; $num++;
	$arr[$num]="Aug"; $num++;
	$arr[$num]="Sep"; $num++;
	$arr[$num]="Oct"; $num++;
	$arr[$num]="Nov"; $num++;
	$arr[$num]="Dec";

	}
		}
	else if($duration==1){
		 $sql="SELECT IF( MONTH( `resultDate` ) =".$month.", COUNT( `testID` ) ,  '0' ) AS  'Jan', COUNT(  `testID` ) AS  'Year ".$year."', COUNT( IF(          `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0 ) ) AS  '<350'
          FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]="Jan";
	}
	  }	
	else if($duration==2){
		if($quarter==1){
		 $sql="SELECT IF( MONTH( `resultDate` ) =01, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =02, COUNT( testID ) ,  '0' ) AS               'Feb', IF( MONTH( resultDate ) =03, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =04, COUNT( testID ) ,  '0' ) AS  'Apr',                COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350',  NULL , 0 ) ) AS  '<350'
                FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]="Jan";	$num++;
	$arr[$num]="Feb"; $num++;
	$arr[$num]="Mar"; $num++;
	$arr[$num]="Apr";
	  }
		}
	  else if($quarter==2){
		 $sql="SELECT IF( MONTH( `resultDate` ) =05, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =06, COUNT( testID ) ,  '0' ) AS               'Feb', IF( MONTH( resultDate ) =07, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =08, COUNT( testID ) ,  '0' ) AS  'Apr',                COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350',  NULL , 0 ) ) AS  '<350'
                FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]="May"; $num++;
	$arr[$num]="Jun"; $num++;
	$arr[$num]="Jul"; $num++;
	$arr[$num]="Aug";
	  }
	 }
	 if($quarter==3){
		 $sql="SELECT IF( MONTH( `resultDate` ) =09, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =10, COUNT( testID ) ,  '0' ) AS               'Feb', IF( MONTH( resultDate ) =11, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =12, COUNT( testID ) ,  '0' ) AS  'Apr',                COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350',  NULL , 0 ) ) AS  '<350'
                FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]="Sep"; $num++;
	$arr[$num]="Oct"; $num++;
	$arr[$num]="Nov"; $num++;
	$arr[$num]="Dec";
	   }
	  }
	}
	else if($duration==3){
		if($biAnn==1){
		 $sql="SELECT IF( MONTH( `resultDate` ) =01, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =02, COUNT( testID ) ,  '0' ) AS      		   'Feb', IF( MONTH( resultDate ) =03, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =04, COUNT( testID ) ,  '0' ) AS  'Apr',               IF( MONTH( resultDate ) =05, COUNT( testID ) ,  '0' ) AS  'May', IF( MONTH( resultDate ) =06, COUNT( testID ) ,  '0' ) AS  'Jun' , COUNT( IF(          `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0               ) ) AS  '<350'
               FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]="Jan";$num++;
	$arr[$num]="Feb"; $num++;
	$arr[$num]="Mar"; $num++;
	$arr[$num]="Apr"; $num++;
	$arr[$num]="May"; $num++;
	$arr[$num]="Jun";
	 }
	}
	else if($biAnn==2){
		 $sql="SELECT IF( MONTH( `resultDate` ) =07, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =08, COUNT( testID ) ,  '0' ) AS      		   'Feb', IF( MONTH( resultDate ) =09, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =10, COUNT( testID ) ,  '0' ) AS  'Apr',               IF( MONTH( resultDate ) =11, COUNT( testID ) ,  '0' ) AS  'May', IF( MONTH( resultDate ) =12, COUNT( testID ) ,  '0' ) AS  'Jun' , COUNT(               IF( `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0               ) ) AS  '<350'
               FROM  `test` WHERE partnerID ='".$patna."' AND year(resultDate)='".$year."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]="Jul"; $num++;
	$arr[$num]="Aug"; $num++;
	$arr[$num]="Sep"; $num++;
	$arr[$num]="Oct"; $num++;
	$arr[$num]="Nov"; $num++;
	$arr[$num]="Dec";
	  }
	 }
	}
	else if($duration==5){
		 $sql="SELECT  COUNT( `testID` ) AS  'Jan', COUNT( IF(`errorID` > '0', NULL , 0 ) ) AS 'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0 ) ) AS              '<350' FROM  `test` WHERE partnerID ='".$patna."' AND resultDate BETWEEN '".$from."' AND '".$to."' AND deviceID='".$dev."'AND errorID>0";
    $query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
	$arr[$num]=$to;
	}
	}
		return $arr;
		}
						

?>
