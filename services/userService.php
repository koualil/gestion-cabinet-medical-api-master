   <?php
 

include '../../database/connectionPDO.php';
$GLOBALS =$conn;

abstract class Utilisateur{

   
   protected $cin;
   protected $nom;
   protected $prenom;
   protected $email; 
   protected $situationFamilliale; 
   protected $genre;
   protected $tel;
   protected $adresse;
   protected $imageProfile; 
   protected $dateNaissance; 
   protected $type;
  
   
   abstract function getAll();
   abstract function delete($id);
   abstract function get($id);
   
   abstract function post($cin,$nom,$prenom,$email,$motDePasse,$situationFamilliale,$genre,$tel,$adresse,$imageProfile,$dateNaissance,$type);
                

   abstract function put();

   
} 



?>