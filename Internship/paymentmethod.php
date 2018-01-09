<?php 
		header('Content-Type: application/json');

		// $connection=$_SESSION["CONNECTION"];
		require_once __DIR__ .'/config.php';

		$response = array();
		$response["success"] = 0;
		$response["message"] = "";
		$response["grandTotal"] = 0;
		$response["message"] = "Payment method";
		$result = mysqli_query($connection,"SELECT * FROM `cart` where SessionID='".$_SESSION["sess_id"]."' and Date='".date("d/m/Y")."' and Selected='Y' and Is_transaction=0") or die(mysqli_error());
		if (mysqli_num_rows($result) > 0) 
		{
			while ($row = mysqli_fetch_array($result)) 
			{
				$response["grandTotal"] +=$row["total"];
			}
				$response["success"] = 1;
				
		} 
		else 
		{
			$response["success"] = 0;
		}
		
		
			    echo json_encode($response);
		
		

               
	

				
?>