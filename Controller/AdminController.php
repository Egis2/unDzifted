<?php 
include ("../session.php");
class AdminController{

  function AdminController(){
    global $session;
    if (isset($_POST['assignCabinet'])){
      $this->assignCabinet();
    }

    //else if (){

    //}
  }

  function assignCabinet(){
    global $database;
    if (strtotime($_POST['uzimta_nuo']) >= strtotime($_POST['uzimta_iki'])){
      $_SESSION['success'] = false;
      $_SESSION['message'] = "Blogai įvesti laikai.";
      header("Location: ../View/Admin/CabinetList.php");
      return;
    } 

    else{
      if ($database->isCabinetFreeAt($_POST['kabinetas'], $_POST['uzimta_nuo'], $_POST['uzimta_iki']))
      {
        $dalys = explode(" ", $_POST['gydytojas']);
        if ($database->addCabinet($_POST['kabinetas'], $_POST['skyrius'], $_POST['irangos_aprasymas'], $_POST['uzimta_nuo'], $_POST['uzimta_iki'], $dalys['2'])){
          $_SESSION['success'] = true;
          $_SESSION['message'] = "Paskirtas kabinetas ".$_POST['kabinetas']." nuo " . $_POST['uzimta_nuo'] . " iki ". $_POST['uzimta_iki'];
        }
        else{
          $_SESSION['success'] = false;
          $_SESSION['message'] = "Nepavyko įkelti į duombazę.";
        }
      }
      else
      {
        $_SESSION['success'] = false;
        $_SESSION['message'] = $_POST['kabinetas'] . " kabinetas jau yra užimtas tarp " . $_POST['uzimta_nuo'] . " ir " . $_POST['uzimta_iki'];
      }
    }
    //$database->addCabinet();
    header("Location: ../View/Admin/CabinetList.php");
  }

}
$AdminController = new AdminController();
?>