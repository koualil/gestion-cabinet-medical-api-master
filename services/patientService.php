<?php
include 'userService.php';

class Patient extends Utilisateur{
   // public $hauteur = 'NULL';//  
   // public $poid = 'NULL';
   public $groupeSanguin ;
  
    public function getAll(){

      $sql = "SELECT p.idUtilisateur, cin, nom, prenom, email, situationFamilliale, genre, tel, adresse, imageProfile, dateNaissance,groupeSanguin , type 
      FROM Utilisateur u, patient p
      WHERE type='patient' and u.idUtilisateur=p.idUtilisateur";
      
      $res = $GLOBALS->query($sql);  
      if ($res) {
      $Arr = array();
      while($row = $res->fetch(PDO::FETCH_ASSOC)){
         array_push($Arr, $row); 
      }
      return $Arr;

      }else{
      return false;
    
}

}
public function delete($id){
           
               $res1 = $GLOBALS->query("SELECT idUtilisateur FROM Patient WHERE idUtilisateur=$id");
               if ($res1->fetchColumn() > 0) {
                   
                  
                  $res2 = $GLOBALS->query("DELETE FROM Patient WHERE idUtilisateur=$id");
      
                  $res3 = $GLOBALS->query("DELETE FROM Utilisateur WHERE idUtilisateur=$id");
      
                  if ($res3) {
                     return true;
                  }
               }
               return false;
} 

 


public function get($id){
   $sql = "SELECT u.idUtilisateur, cin, nom, prenom, email, situationFamilliale, genre, tel, adresse, imageProfile, dateNaissance , type
            FROM utilisateur u , patient p  where u.idUtilisateur = p.idUtilisateur and u.idUtilisateur=$id ";
             
   $res = $GLOBALS->query($sql);
    
   $reponse = $res->fetchAll(PDO::FETCH_ASSOC);
    
   if($reponse)
   return $reponse;
   else{
      return false ;
   }
}  

public function post($cin,$nom,$prenom,$email,$motDePasse,$situationFamilliale,$genre,$tel,$adresse,$imageProfile,$dateNaissance,$type)
 {
 
   $sql= "insert into utilisateur values(null,'$cin','$nom','$prenom','$email','$motDePasse','$situationFamilliale','$genre',$tel,'$adresse','$imageProfile','$dateNaissance','$type')";
     
   $res = $GLOBALS->query($sql);
    
   if($res) { 
      $sqlid = "select idUtilisateur from utilisateur where cin='$cin'";
      $res = $GLOBALS->query($sqlid);
      $idUtilisateur = $res->fetch(PDO::FETCH_ASSOC);
      $idUtilisateur = $idUtilisateur['idUtilisateur'];
      
      $groupeSanguin = null;
      $sql2 = "insert into patient values($idUtilisateur , null , 0)";
      $GLOBALS->query($sql2);

      $patient = Patient::get($idUtilisateur);
       
      return $patient;
    

   }
   else return false;
   
   
}  
public function put(){
   
}   
  
   
 

}









//------------------------------------------------------


// require '../../services/userService.php';

// require $_SERVER['DOCUMENT_ROOT'].'/gestion-cabinet-medical-server/services/userService.php'; 

// class Patient{
//    public $idUtilisateur;    
//    public $idPatient;
//    public $nom;
//    public $prenom;
//    public $cne;
//    public $adresse;
//    public $email; 
//    public $genre;
//    public $tel;
//    public $situationFamilliale ; 
//    public $hauteur = 'NULL';
//    public $imageProfile; 
//    public $poid = 'NULL';
//    public $groupeSanguin ;
// }


// class PatientService extends UserService{

//    public function __construct($conn){
//       parent::__construct($conn, 'patient', 'Patient');
//    }

//    // function get($id){
     
//    //    $res = $this->conn->query("CALL getPatientById($id)");
//    //    if ($res) {
//    //       if (mysqli_num_rows($res) > 0) {
//    //          $row = mysqli_fetch_assoc($res);
//    //          return $row;
//    //       }else{
//    //          return false;
//    //       }
//    //    }else{
//    //       return false;
//    //    }
//    // }
   
//    function getAll(){
//       $query = "SELECT u.idUtilisateur, u.cin, u.nom, u.prenom, u.email, u.situationFamilliale, u.genre, u.tel, u.adresse, u.imageProfile, u.dateNaissance, u.type, p.groupeSanguin, p.decede
//       FROM Utilisateur u, Patient p
//       WHERE u.type='$this->type' AND u.idUtilisateur=p.idUtilisateur" ;

//       $res = $this->conn->query($query);
//       if ($res) {
//          if (mysqli_num_rows($res) > 0) {
//             $patientArr = array();
//             while($row = mysqli_fetch_assoc($res)){
//                array_push($patientArr, $row); 
//             }
//             return $patientArr;
//          }else{
//             return array();
//          }
//       }else{
//          return false;
//       }
//    }


//    // function delete($id){

//    //    try {     
//    //       $res1 = $this->conn->query("SELECT idUtilisateur FROM Patient WHERE idPatient=$id");
//    //       if ($res1 AND mysqli_num_rows($res1) > 0) {
//    //          $idUtilisateur = mysqli_fetch_assoc($res1)['idUtilisateur'];

//    //          $res2 = $this->conn->query("DELETE FROM Patient WHERE idPatient=$id");

//    //          $res3 = $this->conn->query("DELETE FROM Utilisateur WHERE idUtilisateur=$idUtilisateur");

//    //          if ($res3) {
//    //             return true;
//    //          }
//    //       }
//    //       return false;

//    //    } catch (Exception $e) {
//    //       return false;
//    //    }
//    // }


// }


?>