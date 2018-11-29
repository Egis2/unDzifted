<?php
include("database.php");
include("form.php");
class Session {
    var $useremail;     //Username given on sign-up
    var $userid;       //Random value generated on current login
    var $username;
    var $userlastname;
    var $userphonenumber;
    var $usercode;
    var $useraddress;
    var $userlicense;
    var $userbirthdate;
    var $time;         //Time user was last active (page loaded)
    var $logged_in;    //True if user is logged in, false otherwise
    var $userinfo = array();  //The array holding all user info
    var $url;          //The page url current being viewed
    var $referrer;     //Last recorded site page viewed

    /**
     * Note: referrer should really only be considered the actual
     * page referrer in process.php, any other time it may be
     * inaccurate.
     */
    /* Class constructor */

    function Session() {
        $this->time = time();
        $this->startSession();
    }

    /**
     * startSession - Performs all the actions necessary to 
     * initialize this session object. Tries to determine if the
     * the user has logged in already, and sets the variables 
     * accordingly. Also takes advantage of this page load to
     * update the active visitors tables.
     */
    function startSession() {
        global $database; 
        session_start();
		
        $this->logged_in = $this->checkLogin();

        if (isset($_SESSION['url'])) {
            $this->referrer = $_SESSION['url'];
        } else {
            $this->referrer = "/";
        }
		
        $this->url = $_SESSION['url'] = $_SERVER['PHP_SELF'];
    }

    function checkLogin() {
        global $database;
        if (isset($_COOKIE['cookname']) && isset($_COOKIE['cookid'])) {
            $this->username = $_SESSION['username'] = $_COOKIE['cookname'];
            $this->userid = $_SESSION['userid'] = $_COOKIE['cookid'];
        }

        if (isset($_SESSION['username']) && isset($_SESSION['userid'])) {
            if ($database->confirmUserID($_SESSION['username'], $_SESSION['userid']) != 0) {
                return false;
            }
            return true;
        }

        /* User not logged in */ else {
            return false;
        }
    }

    function login($subemail, $subpassword) {
        global $database, $form;

        $field = "email";
        if (!$subemail || strlen($subemail = trim($subemail)) == 0) {
            $form->setError($field, "* Neįvestas e-pašto adresas");
        } else {
            $regex = "^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*"
                    . "@[a-z0-9-]+(\.[a-z0-9-]{1,})*"
                    . "\.([a-z]{2,}){1}$";
            if (preg_match($regex, $subemail)) {
                $form->setError($field, "* Klaidingas e-pašto adresas");
            }
            $subemail = stripslashes($subemail);
        }

        $field = "password";
        if (!$subpassword) {
            $form->setError($field, "* Neįvestas slaptažodis");
        }

        if ($form->num_errors > 0) {
            return false;
        }

        $subemail = stripslashes($subemail);
        $result = $database->confirmUserPass($subemail, $subpassword);
        if ($result == 1) {
            $field = "email";
            $form->setError($field, "* Vartotojo, su tokiu el. paštu, nėra");
        } else if ($result == 2) {
            $field = "password";
            $form->setError($field, "* Neteisingas slaptažodis");
        }

        if ($form->num_errors > 0) {
            return false;
        }

        /*
            Pildyti $_SESSION CIA, norint gauti info prisijungus
        */
        $this->userinfo = $database->getUserInfo($subemail);
        $_SESSION['prisijunges'] = 1;
        $_SESSION['userType'] = $this->userinfo['typeSelector'];
        $_SESSION['vardas']= $this->userinfo['vardas'];
        $_SESSION['pavarde']= $this->userinfo['pavarde'];
        $_SESSION['id'] = $this->userinfo['id_VARTOTOJAS'];

        if ($subremember) {
            setcookie("cookname", $this->useremail, time() + COOKIE_EXPIRE, COOKIE_PATH);
            setcookie("cookid", $this->userid, time() + COOKIE_EXPIRE, COOKIE_PATH);
        }
        return true;
    }

    function register($subuser, $subpass, $subemail) {
        global $database, $form;

   
        $field = "user"; 
        if (!$subuser || strlen($subuser = trim($subuser)) == 0) {
            $form->setError($field, "* Vartotojas neįvestas");
        } else {
            $subuser = stripslashes($subuser);
            if (strlen($subuser) < 5) {
                $form->setError($field, "* Vartotojo vardas turi mažiau kaip 5 simbolius");
            } else if (strlen($subuser) > 30) {
                $form->setError($field, "* Vartotojo vardas virš 30 simbolių");
            }
            else if (preg_match("^([0-9a-z])+$", $subuser)) {
                $form->setError($field, "* Vartotojo vardas gali būti sudarytas
                    <br>&nbsp;&nbsp;tik iš raidžių ir skaičių");
            }
            else if ($database->usernameTaken($subuser)) {
                $form->setError($field, "* Toks vartotojo vardas jau yra");
            }
        }

        $field = "pass";
        if (!$subpass) {
            $form->setError($field, "* Neįvestas slaptažodis");
        } else {
            $subpass = stripslashes($subpass);
            if (strlen($subpass) < 4) {
                $form->setError($field, "* Ne mažiau kaip 4 simboliai");
            }
             else if (preg_match("^([0-9a-z])+$", ($subpass = trim($subpass)))) {
                $form->setError($field, "* Slaptažodis gali būti sudarytas
                    <br>&nbsp;&nbsp;tik iš raidžių ir skaičių");
            }
        }

        $field = "email";
        if (!$subemail || strlen($subemail = trim($subemail)) == 0) {
            $form->setError($field, "* Neįvestas e-pašto adresas");
        } else {
            $regex = "^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*"
                    . "@[a-z0-9-]+(\.[a-z0-9-]{1,})*"
                    . "\.([a-z]{2,}){1}$";
            if (preg_match($regex, $subemail)) {
                $form->setError($field, "* Klaidingas e-pašto adresas");
            }
            $subemail = stripslashes($subemail);
        }

        if ($form->num_errors > 0) {
            return 1;
        }
        else {
            if ($database->addNewUser($subuser, md5($subpass), $subemail)) {
                return 0;
            } else {
                return 2;
            }
        }
    }

    function isAdmin() {
        return ($_SESSION['userType'] == ADMIN_NAME);
    }

    function isPatient() {
        return ($_SESSION['userType'] == PATIENT_NAME);
    }

    function isFamilyDoctor() {
        return ($_SESSION['userType'] == FAMILY_DOCTOR_NAME);
    }

    function isDoctorSpecialist() {
        return ($_SESSION['userType'] == DOCTOR_SPECIALIST_NAME);
    }

    function generateRandID() {
        return md5($this->generateRandStr(16));
    }

    function generateRandStr($length) {
        $randstr = "";
        for ($i = 0; $i < $length; $i++) {
            $randnum = mt_rand(0, 61);
            if ($randnum < 10) {
                $randstr .= chr($randnum + 48);
            } else if ($randnum < 36) {
                $randstr .= chr($randnum + 55);
            } else {
                $randstr .= chr($randnum + 61);
            }
        }
        return $randstr;
    }

}
$session = new Session;

$form = new Form;
?>