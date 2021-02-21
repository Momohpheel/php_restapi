<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';


    $database = new Database();
    $db = $database->connect();

    $user = new User($db);


    $post_id = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $user->getOne($post_id);
    $num = $result->rowCount();

    if ($num > 0){
        $post_arr = array();
        $post_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $post_item = array(
                
                'username' => $username,
                'email' => $email
            );

            array_push($post_arr['data'], $post_item);
        }

        echo json_encode($post_arr);
    }else{
        echo json_encode(
            array('message' => 'No user found')
        );
    }