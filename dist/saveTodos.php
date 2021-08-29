<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    die();
}
// allow every url
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
// allow content type !!IMPORTANT
header('Content-Type: application/json');


$json = file_get_contents('php://input');
$json = json_decode($json);


if ($json->user) {
    $user = $json->user;
    $todos = json_encode($json->todos);
    if (file_exists($user.'.json')) {
        file_put_contents($user.'.json', $todos);
    } else {
        file_put_contents($user.'.json', $todos);
    }
} 
    
?>