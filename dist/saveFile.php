<?php
header('Content-type: text/html');
header('Access-Control-Allow-Origin: *');
if($_FILES){
    $name = $_POST['user'].random_int(0, 9999).$_FILES['picture']['name'];
    $name = preg_replace('/\s/', '', $name);
    move_uploaded_file($_FILES['picture']['tmp_name'], "./pictures/$name");
    echo $name;
};
?>