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

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "egikut");
/*
define("DB_SERVER", "stud.if.ktu.lt");
define("DB_USER", "egikut");
define("DB_PASS", "phah8Ciet8ahquie");
define("DB_NAME", "egikut");
*/
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
define("TBL_ALGA", "ALGA");
define("TBL_BIULETENIS", "BIULETENIS");
define("TBL_DARBO_STATISTIKA", "DARBO_STATISTIKA");
define("TBL_GYDIMAS", "GYDYMAS");
define("TBL_KABINETAS", "KABINETAS");
define("TBL_LIGA","LIGA");
define("TBL_LIGOS_APRASAS","LIGOS_APRASAS");
define("TBL_NURODYMAS","NURODYMAS");
define("TBL_PACIENTO_LIGOS","PACIENTO_LIGOS");
define("TBL_PROCEDURA","PROCEDURA");
define("TBL_RECEPTAS","RECEPTAS");
define("TBL_REZERVACIJA","REZERVACIJA");
define("TBL_SEIMOS_GYDYTOJAS","SEIMOS_GYDYTOJAS");
define("TBL_SIUNTIMAS"," SIUNTIMAS");
define("TBL_SPECIALISTAS"," SPECIALISTAS");
define("TBL_TYRIMAS"," TYRIMAS");
define("TBL_UZIMTUMAS","UZIMTUMAS");
define("TBL_VAISTAS"," VAISTAS");
define("TBL_VAISTU_ISRASAS"," VAISTU_ISRASAS");
define("TBL_VARTOTOJAS"," vartotojas");


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
define("FAMILY_DOCTOR_NAME", "Šeimos_gydytojas");
define("DOCTOR_SPECIALIST_NAME", "Gydytojas_specialistas");
/* sutvarkyti lygius */
define("ADMIN_LEVEL", 4);
define("FAMILY_DOCTOR_LEVEL", 3);
define("DOCTOR_SEPCIALIST_LEVEL", 2);
define("PATIENT_LEVEL", 1);

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
