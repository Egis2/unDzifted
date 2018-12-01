<?php 
include ("../session.php");
class AdminController{

  function AdminController(){
    global $session;
    if (isset($_POST['assignCabinet'])){
      $this->assignCabinet();
    }
    else if (isset($_POST['addDoctor'])){
      $this->newDoctor();
    }
    else if (isset($_POST['removeDoctor'])){
      $this->removeDoctor();
    }
    else if (isset($_POST['editDoctor'])){
      $this->editDoctor();
    }
    else if (isset($_POST['setSallary'])){
      $this->setSallary();
    }
  }

  function editDoctor(){
    global $database;
    if($database->updateDoctorInfo($_POST['id'], $_POST['vardas'], $_POST['pavarde'], $_POST['asmens_kodas'], $_POST['el_pastas'], $_POST['slaptazodis'], $_POST['telefonas'], $_POST['gimimo_data'], $_POST['licencija_iki'])){
        $_SESSION['success'] = true;
        $_SESSION['message'] = "Daktaro informacija buvo pakeista.";
    }
    else{
        $_SESSION['success'] = false;
        $_SESSION['message'] = "Operacija nebuvo sėkminga.";
    }
    header("Location: ../View/Admin/doctorList.php");
  }

  function removeDoctor(){
    global $database;
    $result = $database->getUserInfo($_POST['id']);
    if ($result['typeSelector'] == FAMILY_DOCTOR_NAME || $result['typeSelector'] == DOCTOR_SPECIALIST_NAME)
    {
      $query = "UPDATE " . TBL_VARTOTOJAS . " SET dirba='0' WHERE id_VARTOTOJAS='{$_POST['id']}'";
      if ($database->query($query)){
        $_SESSION['success'] = true;
        $_SESSION['message'] = "Daktaras dabar bedarbis";
      }
      else{
        $_SESSION['success'] = false;
        $_SESSION['message'] = "Nepavyko padaryti daktaro bedarbiu";
      }
    }
    else{
      $_SESSION['success'] = false;
      $_SESSION['message'] = "Šalinamas ne daktaras";
    }

    header("Location: ../View/Admin/doctorList.php");
  }

  function newDoctor(){
    global $database;
    
    if ($database->emailTaken($_POST['el_pastas']))
    {
      $_SESSION['success'] = false;
      $_SESSION['message'] = "El. paštas '".$_POST['el_pastas']." užimtas";
    }
    else
    {
      /* Seimos gydytojo blokas. */
      if ($_POST['specializacija'] == 'Seimos_gydytojas')
      {
          if ($database->newFamilyDoctor($_POST['vardas'], $_POST['pavarde'], $_POST['asmens_kodas'], $_POST['el_pastas'], $_POST['slaptazodis'], $_POST['telefonas'], $_POST['gimimo_data'], $_POST['licencija_iki']))
          {
            $result = $database->getUserInfoByEmail($_POST['el_pastas']);
            $database->setAsFamilyDoctor($result['id_VARTOTOJAS']);

            $_SESSION['success'] = true;
            $_SESSION['message'] = "Šeimos gydytojo užregistruotas. El. Paštas - '". $_POST['el_pastas']."', slaptažodis - '".$_POST['slaptazodis']."'.";
          }
          else
          {
            $_SESSION['success'] = false;
            $_SESSION['message'] = "Šeimos gydytojo nepavyko įkelti į duombazę.";
          }
      }
      /* specialisto blokas */
      else
      {
        if ($database->newSpecialistDoctor($_POST['vardas'], $_POST['pavarde'], $_POST['asmens_kodas'], $_POST['el_pastas'], $_POST['slaptazodis'], $_POST['telefonas'], $_POST['gimimo_data'], $_POST['licencija_iki'], $_POST['specializacija']))
        {
          $result = $database->getUserInfoByEmail($_POST['el_pastas']);
          $database->setAsSpecialistDoctor($result['id_VARTOTOJAS'], $_POST['specializacija']);

          $_SESSION['success'] = true;
          $_SESSION['message'] = $result['id_VARTOTOJAS'] . " Gydytojas specialistas užregistruotas. El. Paštas - '". $_POST['el_pastas']."', slaptažodis - '".$_POST['slaptazodis']."'. Specialybė - ". $_POST['specializacija'];
        }
        else{
          $_SESSION['success'] = false;
          $_SESSION['message'] = "Gydytojo specialisto nepavyko įkelti į duombazę.";
        }
      }
    }

    header("Location: ../View/Admin/doctorList.php");
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
        if ($database->addCabinet($_POST['kabinetas'], $_POST['skyrius'], $_POST['irangos_aprasymas'], $_POST['uzimta_nuo'], $_POST['uzimta_iki'], $_POST['gydytojas'])){
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
    header("Location: ../View/Admin/CabinetList.php");
  }

  function setSallary(){
    global $database;
    if($database -> setSallary($_POST['alga'], $_POST['ismokejimo_data'], $_POST['id'])){
      $_SESSION['success'] = true;
      $_SESSION['message'] = "Išmokėta alga";
    }
    else{
      $_SESSION['success'] = true;
      $_SESSION['message'] = "Alga nebuvo išmokėta";
    }
    header("Location: ../View/Admin/doctorList.php");
  }

}
$AdminController = new AdminController();
?>