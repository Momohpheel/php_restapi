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

    $user->password = $data->password;
    $userid = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $user->changePassword($userid);
    
    
    if ($result){
        echo json_encode(
            array('message' => 'Password has been updated')
        );
    }else{
        echo json_encode(
            array('error' => 'Password couldnt be updated', 'status'=> 404)
        );
    }