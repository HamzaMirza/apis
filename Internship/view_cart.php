<?php 
		header('Content-Type: application/json');

		// $connection=$_SESSION["CONNECTION"];
		require_once __DIR__ .'/config.php';
		$sid=$_GET['sid'];
		$response = array();
		$response["success"] = 0;
		$response["message"] = "";
		$response["grandTotal"] = 0;
		$result = mysqli_query($connection,"SELECT * FROM `cart` where SessionID='".$sid."'");
		if (mysqli_num_rows($result) > 0) 
		{
			$response["clothes"] = array();
			while ($row = mysqli_fetch_array($result)) 
			{
				$clothes = array();
				$clothes["pro_id"] = $row["pro_id"];
				$clothes["size"] = $row["size"];
				$clothes["color"] = $row["color"];
				$clothes["total"] = $row["total"];
				$clothes["selected"] = $row["Selected"];
				$clothes["cart_ID"] = $row["Cart_id"];
				$response["grandTotal"] +=$row["total"];
			
				array_push($response["clothes"], $clothes);
			}
				$response["success"] = 1;
				$response["message"] = "Clothes added in the cart: ";
		} 
		else 
		{
			$response["success"] = 0;
			$response["message"] = "No item in the cart";
		}
		
			    echo json_encode($response);
		
		

               
	

				
?>