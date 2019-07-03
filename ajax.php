<?php
header("Access-Control-Allow-Origin: *");
# Get JSON as a string
/*
$data = file_get_contents('php://input');
# Get as an object
$json = json_decode($data);

$first_name = $json->{'first_name'};
$last_name = $json->{'last_name'};
$birthdate = $json->{'birthdate'};
$email = $json->{'email'};
$password = $json->{'password'};
*/
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
/* $birthdate = $_POST['birthdate']; */
$email = $_POST['email'];
$category = $_POST['category'];
$subCat = $_POST['subcat'];

require 'tools/common.php';
$response = new stdClass();

if ($first_name == '' || $last_name == '' || /* $birthdate == '' || */ $email == '' || $category == '' || $subCat == '' ||) {
    $response->type = 0;
    $response->msg = "Aucun utilisteur n'a pu être enregistré en base";
    echo json_encode($response);
}
else {
    $query_user = $db->prepare('INSERT INTO user (first_name, last_name, email, category, subCat) VALUES (?, ?, ?, ?, ?)');
    $query_user->execute(
        array(
            $email,
            $category,
            $subCat,
            // $birthdate,
            $first_name,
            $last_name
        ));
    $last_insert = $db->lastInsertId();

    $query_select = $db->prepare('SELECT * FROM user WHERE id = ?');
    $query_select->execute(array($last_insert));

    echo json_encode($query_select->fetch(PDO::FETCH_ASSOC));


    //$response->type = 1
    //$response->msg = "L'utilisateur n°".$last_insert." a bien été enregistré en base.";
    //echo json_encode($response);
}
