<?php
/**
 * Created by PhpStorm.
 * User: papangom
 * Date: 10/22/19
 * Time: 16:50
 */

require_once 'tools.php';


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$echo = $request->echo;

if (strcmp($echo, "") != 0) {
    $requestType = "POST";
    $format = "application - json";
}

$data = allGIE();
echo json_encode(array('errorCode' => 0, 'errorMessage' => '', 'gies' => $data));
exit();