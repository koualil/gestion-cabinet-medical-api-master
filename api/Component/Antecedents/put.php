<?php 
header("Access-Control-Allow-Origin: *");
header("content-type: application/json");

include '../../../database/connectionPDO.php';
 
if( isset($_POST['nom']) and isset($_POST['idAntecedent']) ){
    $idAntecedent = $_POST['idAntecedent'];
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $type = $_POST["type"];

    if(!empty($nom) and !empty($description) and !empty($type)){
        $sql ="UPDATE antecedent set nom='$nom' , description='$description' , type='$type' where idAntecedent=$idAntecedent ";
        $res =$conn->query($sql);


        if($sql){
        // recuperer
        $reponse =$conn->query("SELECT * from antecedent where idantecedent = $idAntecedent");
        $reponse = $reponse->fetch(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
        }
    }
    else{
        echo "Saisir tous les champs!";
    }
     
}
else{
    echo "erreur!";
}


?>