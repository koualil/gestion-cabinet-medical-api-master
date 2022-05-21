<?php

header("Access-Control-Allow-Origin: *");
header("content-type: application/json");


 
 
 
include '../../services/patientService.php';



if (
   isset($_POST['cin']) and
   isset($_POST['nom']) and
   isset($_POST['prenom']) and
   isset($_POST['adresse']) and
   isset($_POST['email']) and 
   isset($_POST['motDePasse']) and 
   isset($_POST['genre']) and
   isset($_POST['situationFamilliale']) and 
   isset($_POST['tel']) and 
   isset($_POST['dateNaissance']) and 
   isset($_FILES['imageProfile'])   
 
   ) {
      if (
         !empty($_POST['nom']) and
         !empty($_POST['prenom']) and
         !empty($_POST['cin']) and
         !empty($_POST['adresse']) and
         !empty($_POST['email']) and 
         !empty($_POST['motDePasse']) and 
         !empty($_POST['genre']) and
         !empty($_POST['situationFamilliale']) and 
         !empty($_POST['tel']) and 
         !empty($_POST['dateNaissance'])   
             

         ){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $cin = $_POST['cin'];
            $adresse = $_POST['adresse'];
            $motDePasse = $_POST['motDePasse'];
            $email = $_POST['email']; 
            $genre = $_POST['genre'];
            $situationFamilliale = $_POST['situationFamilliale']; 
            $tel = $_POST['tel'];
            $dateNaissance = $_POST['dateNaissance'];
            //$groupeSanguin = $_POST['groupeSanguin'];
           // $imageProfile = $_FILES['imageProfile'];
            $imageProfile = 'img';
            $type='patient';
             
            $PostPatient = new Patient ;
             
            $res = $PostPatient->post($cin,$nom,$prenom,$email,$motDePasse,$situationFamilliale,$genre,$tel,$adresse,$imageProfile,$dateNaissance,$type);
            if ($res) {
               // appel get 
               // print_r($res[0]);
               echo json_encode($res[0]);
            }else{
               http_response_code(400);
               echo json_encode('erreur 1');
            }
         }else{
            http_response_code(400);
            echo json_encode('erreur 2');
         }
}else{
   http_response_code(400);
   echo json_encode("form non valide");
}









?>