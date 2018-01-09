

<?php
header('Content-Type: application/json');
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_config.php';

//connecting to db
//$db = new DB_CONNECT();
//$con = mysqli_connect("localhost", "mobilesiri", "Android6543", "DrugAppDB") or die(mysqli_error());
//get all products from products table
$result = mysqli_query($con,"SELECT * FROM products where pid<=1") or die(mysqli_error());
 
// check for empty result
if (mysqli_num_rows($result) > 0) {

  
  // looping through all results
    // products node
    $response["products"] = array();
 
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $products = array();
        $products["pid"] = $row["pid"];
        $products["name"] = $row["drug_name"];
        $products["formulation"] = $row["drug_formulation"];
        $products["logo"] = $row["logo"];
	$products["dosage"] = $row["dosage"];
        $products["side_effect"] = $row["side_effects"];
$products["cid"]=$row["cid"];

 
        // push single product into final response array
        array_push($response["products"], $products);
    }
    // success
    //$response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
