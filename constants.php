<?php
/**
 * Constants.php
 *
 * This file is intended to group all constants to
 * make it easier for the site administrator to tweak
 * the login script.
 *
 * Database Constants - these constants are required
 * in order for there to be a successful connection
 * to the MySQL database. Make sure the information is
 * correct.
 */

 
define("DB_SERVER", "stud.if.ktu.lt");
define("DB_USER", "egikut");
define("DB_PASS", "phah8Ciet8ahquie");
define("DB_NAME", "egikut");

/*
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "projektas");
*/
/**
 * Database Table Constants - these constants
 * hold the names of all the database tables used
 * in the script.
 */
define("TBL_USERS", "users");
define("TBL_MATCHES", "matches");
define("TBL_PARTICIPANTS", "participants");
define("TBL_BETS", "bets");

/**
 * Special Names and Level Constants - the admin
 * page will only be accessible to the user with
 * the admin name and also to those users at the
 * admin user level. Feel free to change the names
 * and level constants as you see fit, you may
 * also add additional level specifications.
 * Levels must be digits between 0-9.
 */
define("ADMIN_NAME", "Administratorius");
define("PATIENT_NAME", "Pacientas");
define("FAMILY_DOCTOR_NAME", "Šeimos gydytojas");
define("DOCTOR_SEPCIALIST_NAME", "Gydytojas specialistas");
/* sutvarkyti lygius */
define("ADMIN_LEVEL", 9);
define("EMPLOYEE_LEVEL", 5);
define("USER_LEVEL", 1);

/**
 * Timeout Constants - these constants refer to
 * the maximum amount of time (in minutes) after
 * their last page fresh that a user and guest
 * are still considered active visitors.
 */
define("USER_TIMEOUT", 10);

/**
 * Cookie Constants - these are the parameters
 * to the setcookie function call, change them
 * if necessary to fit your website. If you need
 * help, visit www.php.net for more info.
 * <http://www.php.net/manual/en/function.setcookie.php>
 */
define("COOKIE_EXPIRE", 60 * 60 * 12);
define("COOKIE_PATH", "/");

/**
 * This constant forces all users to have
 * lowercase usernames, capital letters are
 * converted automatically.
 */
define("ALL_LOWERCASE", false);
?>
