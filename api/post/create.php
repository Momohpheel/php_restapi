<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';


$database = new Database();
$db = $database->connect();

$user = new User($db); 

$data = json_decode(file_get_contents("php://input"));


// $username = isset($_GET['username']) ? $_GET['username'] : null;
// $password = isset($_GET['password']) ? $_GET['password'] : null;
// $email = isset($_GET['email']) ? $_GET['email'] : null;
if ($data){
        
   $user->username = $data->username;
   $user->email = $data->email;
   $user->password = $data->password;

    $result = $user->createUser();

    if ($result){
        echo json_encode(
            array('message' => 'Post Created')
        );
    }
    else{
        echo json_encode(
            array('error' => 'Post Not Created')
        );
    }

}else{
    echo json_encode(
        array('error' => 'No resource found')
    );
}