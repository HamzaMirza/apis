<?php 
		header('Content-Type: application/json');

		// $connection=$_SESSION["CONNECTION"];
		require_once __DIR__ .'/config.php';
		$URI=test_input(mysqli_real_escape_string($_SESSION["CONNECTION"],$_POST['URI']));
		//ECHO $URI;
		$response = array();
		$response["success"] = 0;
		$response["message"] = "";
		$result = mysqli_query($connection,"SELECT * FROM `color` JOIN product ON COLOR.Color_ID=Product.Color_ID JOIN size ON product.S_ID=size.S_ID JOIN image ON product.I_ID=image.I_ID JOIN category ON product.Category_ID=category.Category_ID WHERE image.I_ID='".$URI."'") or die(mysqli_error());
		if (mysqli_num_rows($result) > 0) 
		{
			$response["clothes"] = array();
			while ($row = mysqli_fetch_array($result)) 
			{
				$clothes = array();
				$clothes["pro_id"] = $row["P_Name"];
				$clothes["size"] = $row["S_Name"];
				$clothes["color"] = $row["Color_Name"];
				$clothes["P_PRICE"] = $row["P_Price"];
				$clothes["I_Url"] = $row["I_Url"];
				array_push($response["clothes"], $clothes);
			}
				$response["success"] = 1;
				$response["message"] = "Clothes: ";
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