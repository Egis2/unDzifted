<?php 
class FamilyDoctorController{

  function FamilyDoctorController(){
    global $session;

    if (isset($_POST['siuntimas'])){
        $this->postNewSiuntima();
    }
  }

  function postNewSiuntima(){
    echo "?????";
    $registerValue = $_POST;
    global $database;
    $result = $database->getNextUserId();
    var_dump($result);
    
  }

}
$FamilyDoctorController = new FamilyDoctorController();
?>