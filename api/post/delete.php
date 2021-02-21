<?php  
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';

    $database = new Database();
    $db = $database->connect();

    $user = new User($db);

    
    $userid = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $user->deleteUser($userid);
    
    
    if ($result){
        echo json_encode(
            array('message' => 'User has been deleted')
        );
    }else{
        echo json_encode(
            array('error' => 'User couldnt be deleted', 'status'=> 404)
        );
    }