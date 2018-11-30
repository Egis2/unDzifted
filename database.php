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
        $query = "SELECT vardas,pavarde FROM ".TBL_VARTOTOJAS." WHERE id_VARTOTOJAS= ".$id;
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