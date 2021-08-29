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

if($_GET['user']){
    $user = $_GET['user'];
    if (file_exists($user.'.json')) {
        $json = file_get_contents($user.'.json');
        echo $json;
    } else {
        echo [];
    }
};
?>