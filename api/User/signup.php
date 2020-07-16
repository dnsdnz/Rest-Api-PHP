<?php
 
include_once '../config/database.php';   // get database connection

include_once '../objects/user.php';  // instantiate user object
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
 
$user->username = $_POST['username'];    // set user property values
$user->password = base64_encode($_POST['password']);
$user->created = date('Y-m-d H:i:s');
 
if($user->signup()){        // create the user
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $user->id,
        "username" => $user->username
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Username already exists!"
    );
}

print_r(json_encode($user_arr));
?>