<?php 
		header('Content-Type: application/json');

		// $connection=$_SESSION["CONNECTION"];
		require_once __DIR__ .'/config.php';
		
		//Saving data in variables.
		$userName=test_input(mysqli_real_escape_string($_SESSION["CONNECTION"],$_GET['C_name']) );
		$Pno=test_input(mysqli_real_escape_string($_SESSION["CONNECTION"],$_GET['C_Pno']) );
		$C_Cno=test_input(mysqli_real_escape_string($_SESSION["CONNECTION"],$_GET['C_Cno']) );
		$Add1=test_input(mysqli_real_escape_string($_SESSION["CONNECTION"],$_GET['C_Add1']) );
	$Add2=test_input(mysqli_real_escape_string($_SESSION["CONNECTION"],$_GET['C_Add2']) );
		$email=test_input(mysqli_real_escape_string($_SESSION["CONNECTION"],$_GET['C_email']) );
		$zip=test_input(mysqli_real_escape_string($_SESSION["CONNECTION"],$_GET['C_Zip']) );
		
		
		function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		

		
		//Query Beginning

		$response = array();
		$response["success"] = 0;
		$Query="select `CNIC` from `customer` where `CNIC`='".$C_Cno."'";
		if($Result=mysqli_query($connection,$Query))
		{
			if(mysqli_num_rows($Result)>0)
			{
				$_SESSION["Message"]="Customer Already Exists";
				$response["Message"]="Customer already added";
				$response["success"] = 1;
			}
			else
			{
					 $Query="INSERT INTO `customer` (`C_Name`, `C_Cell`, `C_Adress1`, `C_Adress2`, `CNIC`, `email`, `C_ZipCode`) VALUES ('".$userName."',".$Pno.",'".$Add1."','".$Add2."','".$C_Cno."','".$email."','".$zip."')";
					 if($Result=mysqli_query($connection,$Query))
					 {
						 $_SESSION["Message"]="Customer inserted";
						 $response["Message"]="Customer added";
						 $response["success"]=1;
					 }
					 else
					 {
						$_SESSION["Message"]="Customer failed to be inserted";
						$response["Message"]="Customer not added";
							echo json_encode($response);
							die();
					 }
			}
		}
		 $c_id;
			
			$t_id=array();
			$p_id=array();
			$quan=array();
			$tot=array();
			$result = mysqli_query($connection,"SELECT * FROM `customer` WHERE `CNIC`='".$C_Cno."'");
			if (mysqli_num_rows($result) > 0) 
			{
				
				if($row = mysqli_fetch_array($result)) 
				{
					$cloth["c_id"] = $row["CID"];
					$c_id=$cloth["c_id"];
				}
			} 
			$i=0;
			$result = mysqli_query($connection,"SELECT * FROM `cart` where SessionID='".$_SESSION["sess_id"]."' and Date='".date("d/m/Y")."' and Selected='Y' and Is_transaction=0");
			if (mysqli_num_rows($result) > 0) 
			{
					$response["clothes"] = array();
					while ($row = mysqli_fetch_array($result)) 
					{
						$clothes = array();
						$clothes["pro_id"] = $row["pro_id"];
						$clothes["t_id"] = $row["t_id"];
						$clothes["Quantity"] = $row["Quantity"];
						$clothes["total"] = $row["total"];
						array_push($response["clothes"], $clothes);
					$r = mysqli_query($connection,"INSERT INTO `transaction` (`quantity`,`type`, `C_ID`, `P_ID`,`TotalperCloth`) VALUES (".$clothes["Quantity"].",".$clothes["t_id"].",".$c_id.",".$clothes["pro_id"].",".$clothes["total"].")");
					$Cartresult = mysqli_query($connection,"UPDATE `cart` SET Is_transaction=1 where Cart_id=".$row["Cart_id"]);	
				}
			}
			else
				$response["Message_Cart"]="No item selected from the cart";
			echo json_encode($response);
            	
?>