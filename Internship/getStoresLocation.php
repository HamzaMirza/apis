
<?php 
header('Content-Type: application/json');

		// $connection=$_SESSION["CONNECTION"];
		require_once __DIR__ .'/config.php';
		$response = array();
		$result = mysqli_query($connection,"SELECT * FROM storeslocation");
		if (mysqli_num_rows($result) > 0) 
		{
			$response["clothes"] = array();
			while ($row = mysqli_fetch_array($result)) 
			{
				$clothes = array();
				$clothes["store_id"] = $row["store_id"];
				$clothes["store_name"] = $row["store_name"];
				$clothes["store_latitude"] = $row["store_latitude"];
				$clothes["store_longitude"] = $row["store_longitude"];
				array_push($response["clothes"], $clothes);
			}

		} 
		else 
		{
			$response["success"] = 0;
			$response["message"] = "No item in the cart";
		}
		
		
			    echo json_encode($response);
		
		
		function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		

               
	

				
?>