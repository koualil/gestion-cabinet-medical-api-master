<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Max-Age: 360000");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("content-type: application/json");

include '../../services/patientService.php';
  
$patientService = new Patient;
 
   $patients=$patientService->getAll();
    if ($patients) {
      echo json_encode($patients);
    }else{
      http_response_code(400);
      echo json_encode('erreur');
    }




?>