<?php 
header("Access-Control-Allow-Origin: *");
header("content-type: application/json");

include '../../../database/connectionPDO.php';

if(isset($_POST["nom"]) and isset($_POST['description']) and isset($_POST['type'])  and isset($_POST['idPatient']))
  {
      if(!empty($_POST["nom"]) and !empty($_POST['description']) and !empty($_POST['type'])  and !empty($_POST['idPatient']))
        {
            
            $nom = $_POST["nom"];
            $description = $_POST["description"];
            $type = $_POST["type"];
            $idPatient = $_POST["idPatient"];

            $sql= "INSERT into antecedent values(null,'$nom','$description','$type',now(),$idPatient) ";
            $res = $conn->query($sql);
            if($res){
                //SELECT * FROM Table ORDER BY ID DESC LIMIT 1 : Selection dernier linge 
              $rep = $conn->query("SELECT * from antecedent ORDER BY idAntecedent DESC LIMIT 1");
              $reponse = $rep->fetch(PDO::FETCH_ASSOC);
              if($reponse){
                    echo json_encode($reponse);
                }
             }
            else{
                echo "erreur insertion!";
            }
       }
  }
else{
    echo "Erreur";
}

?>