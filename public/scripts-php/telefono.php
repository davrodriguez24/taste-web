<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

//Llamando a los campos//
$jsonDecoded = json_decode(file_get_contents('php://input'), true);
$tel = $jsonDecoded['reqBody']['tel'];
$message = "$tel quiere que lo contacten.";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70, "\r\n");


if($tel){
  require './mailRecipients.php';

  mail($recipients, "$tel quiere que lo contacten", $message);
  echo json_encode("exito");
  // echo json_encode("recaptcha bien: $name envio correo $mail y este mesnaje: $formmessage con $reCaptcha");
} else {
  echo json_encode("error");
  // echo json_encode("Falta recaptcha: $name envio correo $mail y este mesnaje: $formmessage con $reCaptcha");
}
?>