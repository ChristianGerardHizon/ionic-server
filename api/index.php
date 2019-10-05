<?php

header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

// body of request
$requestBody = file_get_contents('php://input');

// this is a simple object
$response = new stdClass();
$response = (object) [
    'message' => 'hello world',
    'method' => $method,
    'body' => $requestBody
];
// output server response as json format
echo json_encode($response);