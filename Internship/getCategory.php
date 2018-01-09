
<?php 
		header('Content-Type: application/json');
		require_once __DIR__ .'/config.php';
		$response = array();
		$result = mysqli_query($connection,"select * from category");
		if (mysqli_num_rows($result) > 0) 
		{
			$response["clothes"] = array();
			while ($row = mysqli_fetch_array($result)) 
			{
				$clothes = array();
				$clothes["C_ID"] = $row["Category_ID"];
				$clothes["C_NAME"] = $row["Category_Name"];
				$clothes["MF"] = $row["MF"];
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