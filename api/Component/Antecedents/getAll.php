<?php 
header("Access-Control-Allow-Origin: *");
header("content-type: application/json");

include '../../../database/connectionPDO.php';
    $sql= "SELECT * from  antecedent ";
    $res = $conn->query($sql);

    if($res){
        $Arr = array();
        while($reponse = $res->fetch(PDO::FETCH_ASSOC)){
             array_push($Arr , $reponse); 
        }  
        echo json_encode($Arr);
    }
    else {
        echo "Erreur!";
    }
?>