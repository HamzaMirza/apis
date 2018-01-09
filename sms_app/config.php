
<?php
             $response = array();
          $response["success"] = 0;
          $response["message"] = "Not Connected to";
          
          $dbname = 'faranorg_connectdbs';
		  $dbhost = 'localhost:3036';
          $dbuser = 'faranorg_connectdbs';
          $dbpass = 'pass789';
          $dbcode = $_REQUEST['code'];
         
         $connection_main = mysql_connect($dbhost, $dbuser, $dbpass);
         if(!$connection_main ) 
         {
             $response["message"] = 'Could not connect: ' . mysql_error();
            
         }
         
         $conn_status_main=mysql_select_db($dbname);
        
            if($conn_status_main)
            {
               
              if(isset($dbcode))
              {
                   $result = mysql_query("SELECT * FROM  `db_info` WHERE id=$dbcode",$connection_main);
                  if ($result) 
                  {
                      while ($row = mysql_fetch_array($result)) 
                     {
                        $connection = mysql_connect($dbhost, $row["dbuser"], $row["dbpass"]);
                        
                          if(!$connection ) 
                          {
                               $response["message"] ='Could not connect: ' . mysql_error();
                              
                          }
                          else
                          {
                              
                                    $conn_status=mysql_select_db($row["dbname"]);
                        			$response["success"] = 0;
                        			$response["message"] = "Not connected to ".$row['dbname'];
                                    if($conn_status)
                                    {
                                       $response["success"] = 1;
                        			   $response["message"] = "Connected to ".$row['dbname']; 
                                    }
                                
                          } 
                     }
                       if(mysql_num_rows($result)<1)  $response["message"] = "db not found from code : ".$dbcode; 
                  }
                  else  $response["message"] = "db not found from code : ".$dbcode; 
              }
            }
            else
             $response["message"] = "db connect failed ".$conn_status_main;
            
            if(!isset($tosentResponse))
           {
                echo json_encode($response);
           } 

		/*  $dbname = $_REQUEST['db'];
		  $dbhost = 'localhost:3036';
          $dbuser = $_REQUEST['user'];
          $dbpass = $_REQUEST['pass'];
          //$dbpass = 'Pass123@';
          
         $connection = mysql_connect($dbhost, $dbuser, $dbpass);
         if(! $connection ) 
         {
            die('Could not connect: ' . mysql_error());
         }
         
        
    $conn_status=mysql_select_db($dbname);
 
      if(!isset($tosentResponse))
      {
            $response = array();
			$response["success"] = 0;
			$response["message"] = "Not Connected to $dbname";
            if($conn_status)
            {
               $response["success"] = 1;
			   $response["message"] = "Connected to $dbname"; 
            }
            echo json_encode($response);
      }
        */
?>