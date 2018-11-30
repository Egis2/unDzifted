<?php 
include ("../session.php");

class PatientController {

    function PatientController(){
        if (isset($_POST['submitEdit'])){
            $this->editPatient();
        }
        if (isset($_POST['addReservation'])){
            $this->addReservation();
        }
        //else {
      //      header("Location: ../index.php");
      //  }
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

    function addReservation(){
        global $database;
        $query = "INSERT INTO " . TBL_REZERVACIJA . " VALUES ('{$_POST['laikas']}', 'PAKEISTI', NULL, '{$_POST['gydytojas']}', '{$_POST['id']}')";
        $database->query($query);
        header("Location: ../View/Patient/PatientReservations.php?id=".$_POST['id']);
    }
}
$PatientController = new PatientController();
?>