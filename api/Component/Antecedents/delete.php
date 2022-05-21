<?php


header("Access-Control-Allow-Origin: *");
header("content-type: application/json");

include '../../../database/connectionPDO.php';

$id = $_GET["id"];

try {
   $reqeute = $conn->query("SELECT * from antecedent where $id=idAntecedent");
   $ligneSupprimer=$reqeute->fetch(PDO::FETCH_ASSOC);
   echo json_encode($ligneSupprimer);

   $res = $conn->query("DELETE from antecedent where $id=idAntecedent");

} catch (PDOException $e) {
   http_response_code(400);
   echo json_encode($e->getMessage() );
}

?>