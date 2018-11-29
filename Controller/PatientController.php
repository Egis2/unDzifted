<?php 
include ("../session.php");

class PatientController {

    function PatientController(){
        if (isset($_POST['submitEdit'])){
            $this->editPatient();
        }
        else {
            header("Location: ../index.php");
        }
    }


    function editPatient()
    {
        global $database;
        $result = $database->getUserInfo($_POST['submitEdit']);
        $registerValue = $_POST;
        $database->updatePatientInfo($_POST);
        header("Location: ../View/Patient/PatientInfo.php?id=".$_POST['submitEdit']);
        $_SESSION['vardas'] = $_POST['pavarde'];
        $_SESSION['pavarde'] = $_POST['pavarde'];
    }
}
$PatientController = new PatientController();
?>