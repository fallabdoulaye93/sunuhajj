<?php
/**
 * Created by PhpStorm.
 * User: papangom
 * Date: 10/22/19
 * Time: 12:52
 */

require_once 'tools.php';



$postdata = $_POST;

$request = $postdata;
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$echo = $request->echo;

if (strcmp($echo, "") != 0) {
    $requestType = "POST";
    $format = "application - json";
}

$login = trim(securite_xss($request->login));
$password = trim(securite_xss($request->password));
$uuid = trim(securite_xss($request->uuid));
$manufacture = trim(securite_xss($request->manufacture));
$model = trim(securite_xss($request->model));
$platform = trim(securite_xss($request->platform));
$idbus = trim(securite_xss($request->idbus));

/*$login = $request["login"];
$password = $request["password"];
$uuid = $request["uuid"];
$manufacture = $request["manufacture"];
$model = $request["model"];
$platform = $request["platform"];
$idbus = $request["idbus"];*/

if($login != '' && $password != '' && $uuid != '' && $manufacture != '' && $model != '' && $platform != '' && $idbus != ''){
    echo login($login, $password, $uuid, $model, $manufacture, $platform, $idbus);
    //echo "succes";
    exit();
}
else{
    echo json_encode(array('errorCode' => 7, 'errorMessage' => $uuid));
    exit();
}