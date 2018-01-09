<?php 
		header('Content-Type: application/json');

		// $connection=$_SESSION["CONNECTION"];
		require_once __DIR__ .'/config.php';
		
		//Saving data in variables.
		$pro_id=test_input(mysqli_real_escape_string($_SESSION["CONNECTION"],$_GET['pro_id']) );
		$size=test_input(mysqli_real_escape_string($_SESSION["CONNECTION"],$_GET['size']) );
		$color=test_input(mysqli_real_escape_string($_SESSION["CONNECTION"],$_GET['color']) );
		$quantity=test_input(mysqli_real_escape_string($_SESSION["CONNECTION"],$_GET['quantity']) );
		$price=test_input(mysqli_real_escape_string($_SESSION["CONNECTION"],$_GET['price']) );
		$type=test_input(mysqli_real_escape_string($_SESSION["CONNECTION"],$_GET['type']) );
		$total=$quantity * $price;

		
		function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		//Producing SessionID
				$sessionid=0;
				$Query="SELECT * FROM `cart` where ip='".$_SESSION["ipAddress"]."'";
		if($Result=mysqli_query($_SESSION["CONNECTION"],$Query))
		{
			if ($row = mysqli_fetch_array($Result)) 
			{
					$sessionid = $row["SessionID"];
			}
			
		}
		else
		{
				$Query="SELECT COALESCE(max(cart.SessionID)+1,0) as SessionID FROM `cart`";
				$Result=mysqli_query($connection,$Query);
				if ($row = mysqli_fetch_array($Result)) 
				{
					$sessionid = $row["SessionID"];
				}
		}
		
		$_SESSION["sess_id"]=$sessionid;
		//Adding to the card
	
		$response = array();
		$response["success"] = 0;
		// $response["session_id"]=$_SESSION["sess_id"];
		$response["pro_id"] = $pro_id;
		$response["size"] = $size;
		$response["color"] = $color;
		$response["price"] = $price;
		$response["quantity"]=$quantity;
		$response["total"] = $total;
		$response["type"] = $type;
		
 $Query="INSERT INTO `cart`(`SessionID`, `pro_id`, `size`, `color`, `price`, `Quantity`, `total`, `ip`,`t_id`,`Date`,`Is_transaction`)VALUES (".$_SESSION["sess_id"].",".$pro_id.",'".$size."','".$color."',".$price.",".$quantity.",".$total.",'".$_SESSION["ipAddress"]."',".$type.",'".date("d/m/Y")."',0)";
					 if(($Result=mysqli_query($connection,$Query)))
					 {
						 $response["success"] = 1;
					 }

		echo json_encode($response);
               
	

				
?>