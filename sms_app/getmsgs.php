<?php 
	
		$tosentResponse=false;
		include( __DIR__ .'/config.php');
			
		mysql_set_charset('utf8',$connection);
		$response = array();
		$response["success"] = 0;
		$response["message"] = "No msgs";
		$response["data"] = array();
		if(isset($_REQUEST['campId']))
		{
		    $campid=$_REQUEST['campId'];
    		if($campid[0]=="\"") {
    		    $campid= substr("".$campid,1,strlen($campid)-2);
    		    $campid=preg_replace('/\s+/', '', $campid);
    		}
    		else if($campid[0]=="[") $campid= substr($campid,1,sizeof($campid)-2);
    		$result = mysql_query("SELECT id,message  as message ,contact_no,sms_status,campusId FROM  `message` WHERE sms_status=0 and FIND_IN_SET(message.campusId,'". $campid."') LIMIT 100 ",$connection);
    		if ($result) 
    		{
    			while ($row = mysql_fetch_array($result)) 
    			{
    				$clothes = array();
    				$clothes["id"] = $row["id"];
    				$clothes["message"] = explode('\u', $row["message"])[0] ;
    			
    				$clothes["contact_no"] = $row["contact_no"];
    				$clothes["sms_status"] = $row["sms_status"];
    				array_push($response["data"], $clothes);
    			}
    				$response["success"] = 1;
    				$response["message"] = "msgs recieved";
    		}
		}
		else
		    $response["message"] = "Campus Id not provided";
		echo json_encode($response, JSON_UNESCAPED_UNICODE);	
?>

<?php 
	/*
		$tosentResponse=false;
		include( __DIR__ .'/config.php');
			
		mysql_set_charset('utf8',$connection);
		$response = array();
		$response["success"] = 0;
		$response["message"] = "No msgs";
		
		$result = mysql_query("SELECT id,message  as message ,contact_no,sms_status,campusId FROM  `message` WHERE sms_status=0 LIMIT 100 ",$connection);
		if ($result) 
		{
		    
			$response["data"] = array();
			while ($row = mysql_fetch_array($result)) 
			{
				$clothes = array();
				$clothes["id"] = $row["id"];
				$clothes["message"] = explode('\u', $row["message"])[0] ;
				$clothes["contact_no"] = $row["contact_no"];
				$clothes["sms_status"] = $row["sms_status"];
				array_push($response["data"], $clothes);
			}
				$response["success"] = 1;
				$response["message"] = "msgs recieved";
		} 
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
		*/
?>
