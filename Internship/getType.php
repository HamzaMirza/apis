
<?php 
		header('Content-Type: application/json');

		// $connection=$_SESSION["CONNECTION"];
		require_once __DIR__ .'/config.php';
		$response = array();
		
		$result = mysqli_query($connection,"SELECT * FROM type");
		if (mysqli_num_rows($result) > 0) 
		{
			$response["clothes"] = array();
			while ($row = mysqli_fetch_array($result)) 
			{
				$clothes = array();
				$clothes["T_ID"] = $row["T_ID"];
				$clothes["T_NAME"] = $row["T_Name"];
				array_push($response["clothes"], $clothes);
			}
			$response["success"] = 1;
		} 
		else 
		{
			$response["success"] = 0;
			$response["message"] = "No item in the cart";
		}
		
				
			    echo json_encode($response);
		
		

               
	

				
?>