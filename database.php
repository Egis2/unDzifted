<?php

include("constants.php");

class MySQLDB {

    var $connection;         //The MySQL database connection
    var $num_members;        //Number of signed-up users
    /* Note: call getNumMembers() to access $num_members! */

    function MySQLDB() {
        /* Make connection to database */
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME)
                or die(mysql_error() . '<br><h1>Faile include/constants.php suveskite savo MySQLDB duomenis.</h1>');
                $this->connection->set_charset("Utf8");
    }
	
    function confirmUserPass($useremail, $password) {
        /* Add slashes if necessary (for query) */
        if (!get_magic_quotes_gpc()) {
            $useremail = addslashes($useremail);
        }

        /* Verify that user is in database */
        $q = "SELECT slaptazodis FROM " . TBL_VARTOTOJAS . " WHERE " .  TBL_VARTOTOJAS .".el_pastas= '$useremail'";
        $result = mysqli_query($this->connection, $q);
        if (!$result || (mysqli_num_rows($result) < 1)) {
            return 1; //Indicates username failure
        }

        /* Retrieve password from result, strip slashes */
        $dbarray = mysqli_fetch_array($result);
        $dbarray['slaptazodis'] = stripslashes($dbarray['slaptazodis']);
        $password = stripslashes($password);

        /* Validate that password is correct */
        if ($password === $dbarray['slaptazodis']) {
            return 0; //Success! Username and password confirmed
        } else {
            return 2; //Indicates password failure
        }
    }

    function confirmUserID($username, $userid) {
        /* Add slashes if necessary (for query) */
        if (!get_magic_quotes_gpc()) {
            $username = addslashes($username);
        }

        /* Verify that user is in database */
        $q = "SELECT userid FROM " . TBL_USERS . " WHERE username = '$username'";
        $result = mysqli_query($this->connection, $q);
        if (!$result || (mysqli_num_rows($result) < 1)) {
            return 1; //Indicates username failure
        }

        /* Retrieve userid from result, strip slashes */
        $dbarray = mysqli_fetch_array($result);
        $dbarray['userid'] = stripslashes($dbarray['userid']);
        $userid = stripslashes($userid);

        /* Validate that userid is correct */
        if ($userid == $dbarray['userid']) {
            return 0; //Success! Username and userid confirmed
        } else {
            return 2; //Indicates userid invalid
        }
    }

 
    function emailTaken($useremail) {
        if (!get_magic_quotes_gpc()) {
            $useremail = addslashes($useruseremailname);
        }
        $q = "SELECT username FROM " . TBL_USERS . " WHERE el_pastas = '$useremail'";
        $result = mysqli_query($this->connection, $q);
        return (mysqli_num_rows($result) > 0);
    }
	


    function updateUserField($username, $field, $value) {
        $q = "UPDATE " . TBL_USERS . " SET " . $field . " = '$value' WHERE username = '$username'";
        return mysqli_query($this->connection, $q);
    }

    
    function getUserInfoByEmail($email) {
        $q = "SELECT * FROM " . TBL_VARTOTOJAS . " WHERE el_pastas = '$email'";
        $result = mysqli_query($this->connection, $q);
        /* Error occurred, return given name by default */
        if (!$result || (mysqli_num_rows($result) < 1)) {
            return NULL;
        }
        /* Return result array */
        $dbarray = mysqli_fetch_array($result);
        return $dbarray;
    }

    function getUserInfo($id) {
        $q = "SELECT * FROM " . TBL_VARTOTOJAS . " WHERE id_VARTOTOJAS = '$id'";
        $result = mysqli_query($this->connection, $q);
        /* Error occurred, return given name by default */
        if (!$result || (mysqli_num_rows($result) < 1)) {
            return NULL;
        }
        /* Return result array */
        $dbarray = mysqli_fetch_array($result);
        return $dbarray;
    }

    function getNumMembers() {
        if ($this->num_members < 0) {
            $q = "SELECT * FROM " . TBL_USERS;
            $result = mysqli_query($this->connection, $q);
            $this->num_members = mysqli_num_rows($result);
        }
        return $this->num_members;
    }


    function getNextUserId(){
        $query = "SELECT count(".TBL_VARTOTOJAS.".id_VARTOTOJAS)+1 FROM ". TBL_VARTOTOJAS;
        $getCountOfUsers = mysqli_query($this->connection, $query);
        return $getCountOfUsers;
    }

    function addNewUser($userId, $registerValue, $userType){
        $query = "INSERT INTO vartotojas(vardas, pavarde,asmens_kodas, el_pastas,
         slaptazodis, telefonas, id_VARTOTOJAS, gimimo_data, adresas, licencija_iki, typeSelector)
          VALUES ('".$registerValue['vardas']."','".$registerValue['pavarde']."',".$registerValue['asmens_kodas'].",'".$registerValue['el_pastas']."',
           '".$registerValue['slaptazodis']."', ".$registerValue['telefonas'].", ".$userId.",null,null,null,'".$userType."')";
        return mysqli_query($this->connection, $query);
    }

    function updatePatientInfo($registerValue){
        $query = "UPDATE ". TBL_VARTOTOJAS . " SET vardas='".$registerValue['vardas']."' , pavarde='".$registerValue['pavarde'].
        "' , asmens_kodas='".$registerValue['asmens_kodas']."', el_pastas='".$registerValue['el_pastas']."' , telefonas='".
        $registerValue['telefonas']. "', gimimo_data='".$registerValue['gimimo_data']."' , slaptazodis='".$registerValue['slaptazodis']."' WHERE id_VARTOTOJAS='".$registerValue['submitEdit']."'";
        return  mysqli_query($this->connection, $query);
    }

    function getAllPatients(){
        $getAllPatientsQuery = "SELECT * FROM ".TBL_VARTOTOJAS." where typeSelector = '".PATIENT_NAME."'";
        $result= mysqli_query($this->connection, $getAllPatientsQuery);
        return $result;
    }

    function getPatientReservations($id){
        $query = "SELECT * FROM ".TBL_REZERVACIJA." WHERE fk_PACIENTASid_VARTOTOJAS='{$id}'"; 
        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    function getNameAndSurname($id){
        $query = "SELECT CONCAT(vardas,' ', pavarde) AS fullName FROM ".TBL_VARTOTOJAS." WHERE id_VARTOTOJAS= ".$id;
        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    function getAllSpecialists(){
        $query = "Select CONCAT(vardas,' ', pavarde) AS specialistFullName from ".TBL_VARTOTOJAS." Where typeSelector = '".DOCTOR_SPECIALIST_NAME."'";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    function getAllIlnesses(){
        $query = "Select CONCAT(pavadinimas,' ', ligos_kodas) AS liga from ".TBL_LIGA."";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    function getId($id){
        $query = "SELECT id_VARTOTOJAS FROM ".TBL_VARTOTOJAS." WHERE id_VARTOTOJAS= ".$id;
        $result = mysqli_query($this->connection, $query);

        return $result;
    }

    function getConsultations($id){
        $query = "SELECT priezastis, komentaras, fk_SPECIALISTASid_SPECIALISTAS FROM ".TBL_SIUNTIMAS." WHERE fk_PACIENTASid_VARTOTOJAS= ".$id;
        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    function getSickList($id){
        $query = "SELECT data_pradzios, data_pabaigos, priezastis, diagnozes_kodas FROM ".TBL_BIULETENIS." WHERE fk_PACIENTASid_VARTOTOJAS= ".$id;
        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    function getTests($id){
        $query = "SELECT * FROM ".TBL_TYRIMAS." WHERE send = '1' AND fk_PACIENTASid_VARTOTOJAS= ".$id;
        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    function addNewSending($comment, $reason, $patientName, $patientSurname,$specialistName, $specialistSurname, $familyDoctorName, $familyDoctorSurname){

        $query = "INSERT INTO siuntimas(priezastis, komentaras, fk_PACIENTASid_VARTOTOJAS, fk_SEIMOS_GYDYTOJASid_SEIMOS_GYDYTOJAS, fk_SPECIALISTASid_SPECIALISTAS) 
        VALUES ('".$reason."','".$comment."',
    (SELECT ".TBL_VARTOTOJAS.".id_VARTOTOJAS from ".TBL_VARTOTOJAS." WHERE vartotojas.vardas = '".$patientName."' and vartotojas.pavarde = '".$patientSurname."'),
    (SELECT ".TBL_VARTOTOJAS.".id_VARTOTOJAS from ".TBL_VARTOTOJAS." WHERE vartotojas.vardas = '".$familyDoctorName."' and vartotojas.pavarde = '".$familyDoctorSurname."'),
    (SELECT ".TBL_VARTOTOJAS.".id_VARTOTOJAS from ".TBL_VARTOTOJAS." WHERE vartotojas.vardas = '".$specialistName."' and vartotojas.pavarde = '".$specialistSurname."'))";
    $result = mysqli_query($this->connection, $query);
        return $result;
    }

    function addNewMedicine($nameOfMedicine, $instruction, $mg, $haveRecept){
        $query = "INSERT INTO vaistas(pavadinimas, vartojimo_instrukcija, kiekis_mg, receptinis) 
        VALUES ('".$nameOfMedicine."','".$instruction."',".$mg.",".$haveRecept.")";
         $result = mysqli_query($this->connection, $query);
         return $result;
    }

    function MedicineExtract($data, $patientName, $patientSurname,$familyDoctorName, $familyDoctorSurname){
        $query = "INSERT INTO vaistu_israsas(israsymo_data, fk_GYDYTOJASid_VARTOTOJAS, fk_PACIENTASid_VARTOTOJAS) 
        VALUES ('".$data."',
        (SELECT ".TBL_VARTOTOJAS.".id_VARTOTOJAS from ".TBL_VARTOTOJAS." where ".TBL_VARTOTOJAS.".vardas = '".$familyDoctorName."' and vartotojas.pavarde = '".$familyDoctorSurname."'),
        (SELECT ".TBL_VARTOTOJAS.".id_VARTOTOJAS from ".TBL_VARTOTOJAS." where ".TBL_VARTOTOJAS.".vardas = '".$patientName."' and vartotojas.pavarde = '".$patientSurname."'))";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }

    function getInfoAboutSpecialist($userID){
        $query ="SELECT id_VARTOTOJAS, concat(vardas,'  ' ,pavarde)as fullName FROM ".TBL_VARTOTOJAS." WHERE vartotojas.id_VARTOTOJAS =".$userID;
         $result = mysqli_query($this->connection, $query);
        return $result;
    }

    function sendFromSpecialistToFamilyDoctor($id){
        $query = "UPDATE " . TBL_TYRIMAS . " SET " . TBL_TYRIMAS .".send='1' WHERE id_TYRIMAS='$id'";
        return mysqli_query($this->connection, $query);
    }

    function newPatientTest($patientId, $specialistId, $date, $description, $result){
        $query = "INSERT INTO " . TBL_TYRIMAS . " VALUES ('$date', '0', '$description', '$result', NULL, '$specialistId', '$patientId')";
        return mysqli_query($this->connection, $query);
    }

    function newProcedure($patientId, $specialistId, $date, $place, $description){
        $query = "INSERT INTO " . TBL_PROCEDURA . " VALUES('$date', '$place', '$description', NULL, '$patientId', '$specialistId')";
        return mysqli_query($this->connection, $query);
    }

    function getSpecialisation($id){
        $query = "SELECT fk_SPECIALISTASid_SPECIALISTAS as spec FROM ".TBL_SIUNTIMAS." WHERE fk_PACIENTASid_VARTOTOJAS =".$id;
        return mysqli_query($this->connection, $query);
        //return $query;
    }

    function specialistSpecialization($id){
        $query ="SELECT specialybe FROM ".TBL_SPECIALISTAS." where id_SPECIALISTAS =".$id;
        return mysqli_query($this->connection, $query);
    }

    function getMaxId(){
        $query = "SELECT MAX(id_VAISTU_ISRASAS) FROM ".TBL_VAISTU_ISRASAS;
        return mysqli_query($this->connection, $query);
    }
    function insertNewRecipe($date, $id){
        $query = "INSERT INTO ".TBL_RECEPTAS."(galioja_iki, fk_VAISTU_ISRASASid_VAISTU_ISRASAS) VALUES ('".$date."',".$id.")";
        return mysqli_query($this->connection, $query);
    }

    

    /**
     * query - Performs the given query on the database and
     * returns the result, which may be false, true or a
     * resource identifier.
     */
    function query($query) {
        return mysqli_query($this->connection, $query);
    }

}

/* Create database connection */
$database = new MySQLDB;
?>