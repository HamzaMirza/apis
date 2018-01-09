
<?php
header('Content-Type: application/json');

/*
 * Following code will list all the category
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_config.php';

// connecting to db
//$db = new DB_CONNECT();
 //$con = mysqli_connect("localhost", "mobilesiri", "Android6543", "DrugAppDB") or die(mysqli_error());
// get all products from products table
$result = mysqli_query($con,"SELECT * FROM categories") or die(mysqli_error());
 
// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // categories node
    $response["category"] = array();
 
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $category = array();
        $category["cid"] = $row["cid"];
        $category["name"] = $row["disease"];
        
		
        // push single category into final response array
        array_push($response["category"], $category);
    }
    // success
     
    // echoing JSON response
    echo json_encode($response);
} else {
    // no category found
    $response["success"] = 0;
    $response["message"] = "No category found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
