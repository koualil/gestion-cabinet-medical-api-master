<?php

header("Access-Control-Allow-Origin: *");

include_once '../../utils/functions.php';
include '../../database/connectionPDO.php';
include '../../services/userService.php';



if (isset($_POST['nom'])) {
   if (!empty($_POST['nom'])){
      $nom = $_POST['nom'];

      try {
         
         $res = $conn->query("INSERT INTO Service(nom) values('$nom')");
         // selectionner le dernier element
         $res2 = $conn->query("SELECT * FROM Service ORDER BY idService DESC LIMIT 1;");
         $service = $res2->fetch(PDO::FETCH_ASSOC);

         echo json_encode($service);

      } catch (Throwable $th) {
         http_response_code(400);
         echo json_encode('erreur');
      }
   }else{
      http_response_code(400);
      echo json_encode('le nom est vide');
   }
}else{
   http_response_code(400);
   echo json_encode("form non valide");
}









?>