<?php

include_once '../config/database.php';   // include database and object files
include_once '../objects/user.php';
 
$database = new Database();  // get database connection
$db = $database->getConnection();
 
$user = new User($db);  // prepare user object
$user->username = isset($_GET['username']) ? $_GET['username'] : die();   // set ID property of user to be edited
$user->password = base64_encode(isset($_GET['password']) ? $_GET['password'] : die());

$stmt = $user->login();     // read the details of user to be edited

if($stmt->rowCount() > 0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);    // get retrieved row
   
    $user_arr=array(      // create array
        "status" => true,
        "message" => "Successfully Login!",
        "id" => $row['id'],
        "username" => $row['username']
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Invalid Username or Password!",
    );
}

print_r(json_encode($user_arr));        // make it json format
?>