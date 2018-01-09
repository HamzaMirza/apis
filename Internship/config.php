<?php
		session_start();
		// $connection = mysqli_connect("localhost", "ShoppingAppDB", "ShoppingAppDB", "ShoppingAppDB") or die(mysqli_error());
		 $connection = mysqli_connect("localhost", "root", "", "shopping") or die(mysqli_error());
		$_SESSION["CONNECTION"]=$connection;
		
	
		$_SESSION["ipAddress"] =$_SERVER['REMOTE_ADDR'];
		$_SESSION["sess_id"]=0;
		
		
		// echo $_SESSION["sess_id"]."\n";
?>
