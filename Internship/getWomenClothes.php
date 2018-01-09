
<?php 

		header('Content-Type: application/json');

		// $connection=$_SESSION["CONNECTION"];
		require_once __DIR__ .'/config.php';
		  $Id=$_GET['CID'];
		$response = array();
		$response["success"] = 0;
			$response["message"] = "No item in the cart";
		$result = mysqli_query($connection,"SELECT * FROM  `product`  JOIN `color` ON (product.Color_ID=color.Color_ID) JOIN size ON (product.S_ID=size.S_ID ) JOIN image ON (product.I_ID=image.I_ID ) JOIN category ON (product.Category_ID=category.Category_ID ) WHERE (product.Category_ID=".$Id." and product.T_ID=2)");
		if (mysqli_num_rows($result) > 0) 
		{
			$response["clothes"] = array();
			while ($row = mysqli_fetch_array($result)) 
			{
				$clothes = array();
				$clothes["pro_name"] = $row["P_Name"];
				$clothes["size"] = $row["S_Name"];
				$clothes["color"] = $row["Color_Name"];
				$clothes["P_PRICE"] = $row["P_Price"];
				$clothes["I_Url"] = $row["I_Url"];
				array_push($response["clothes"], $clothes);
			}
				$response["success"] = 1;
				$response["message"] = "Clothes: ";
		} 

		
		
			    echo json_encode($response);
		

               
	

				
?>