<?php

require_once 'user.class.php';
require_once 'headers.php';

$user = new User();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    // POST -> used for input of data.
    case 'POST':
        $requestBody = file_get_contents('php://input'); // parse body
        $body = json_decode($requestBody, true); // convert to object
        $res = $user->add($body['name'], $body['lastname'], $body['image'], $body['birthday']);
        echo json_encode($res);
        break;

    // GET -> used for fetching information.
    case 'GET':
        echo json_encode($user->getAll());
        break;
}

