	<?php
		header('Content-Type: application/json');
		$tosentResponse=false;
		function test_input($data)
		{
			if($data!='')
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
			}
			return $data;
		}
	    require_once __DIR__ .'/config.php';
				$response = array();
		$response["success"] = 0;
		$response["message"] = "";
	
		$id="none";
		$sms_status="none";
        $updated_at="none";
		foreach($_REQUEST as $key => $item)
		{
			if($key=='id')
				$id=$item;
			else if($key=='sms_status')
				$sms_status=$item;    
			else if($key=='updated_at')
				$updated_at=$item;  
		}
			
			 if($id=="none"&&$sms_status=="none")
			{
				$j="";
				foreach($_REQUEST as $key => $item)
				{
					$j=json_decode($key);
					if($j=="")
						$j=json_decode($item);
				}
			
					foreach($j as $key => $item)
					{
						if($key=='id')
							$id=$item;
						else if($key=='sms_status')
							$sms_status=$item;
						else if($key=='updated_at')
			            	$updated_at=$item; 
					}
		
			}
			else if($id=="none"||$sms_status=="none")
			{
				$response["message"] ="id and sms status are required";
				echo json_encode($response);
				exit();
			}
			
			$query="UPDATE message SET sms_status = $sms_status , `updated_at`='$updated_at' WHERE id = $id";
			$run_qu=mysql_query($query,$connection);
			if($run_qu)
			{
			    
				$response["success"] = 1;
				$response["message"] = "data updated";
			}
			else
			{
				$response["success"] = 0;
				$response["message"] = "failed to update data";
			}
						
		 echo json_encode($response);
		 exit();
		
	?>
