<?php 
		$conn=mysqli_connect('localhost','root','','PopUp_Email');
        if(isset($_POST['Save']))
        {
          if(!empty($_POST['email']))
          {
                $email=$_POST['email'];
            $Query="INSERT INTO `Tb_Email`( `Email`) VALUES ('".$email."')";
            if(mysqli_query($conn,$Query))
                  echo '<script> window.location.href = "https://github.com/";</script> ';
            else if(!(mysqli_query($conn,$Query)))
                 echo '<script> alert("Email Already Exists! );</script> ';
          }
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Pop up Email</title>
	<link rel="stylesheet" href="index.css">
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js?ver=1.4.2'></script>
       <script type="text/javascript" src="login.js">
    </script>
     
</head>
<!-- action=" <?php echo htmlspecialchars($_SERVER[" PHP_SELF "]); ?>" -->

<body>
	<header>
		<h1> Intelli Sense Internship</h1>
	</header>
    <input type="button" name="Login" value="Click to Mail" id="Loginbtn" />
	<div>
        <br>  
        	
        <div  id="LoginForm">  
          
    		<form action=""  method="Post">
                
                <input type="image" name="LoginCancel" src="cross.PNG" id="LoginCancel" />
			    <br><br>
			    <input type="email" name="email" placeholder="Email here"  />
			    <input type="submit" name="Save" />
		    </form>
        </div>
	</div>
  
</body>

</html>