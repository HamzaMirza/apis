<?php 
		header('Content-Type: application/json');

		// $connection=$_SESSION["CONNECTION"];
		require_once __DIR__ .'/config.php';
		
		//Saving data in variables.
		$Cart_id=test_input(mysqli_real_escape_string($_SESSION["CONNECTION"],$_GET['Cart_id']) );

		
		function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		

		
		//Query Beginning
		$response["success"] = 0;
			if($result = mysqli_query($connection,"UPDATE `cart` SET Selected='N' where SessionID='".$_SESSION["sess_id"]."' and Date='".date("d/m/Y")."' and Cart_id=".$Cart_id))
				$response["success"] = 1;

		echo json_encode($response);
               
	

				
?>+