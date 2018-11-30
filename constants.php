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
define("TBL_ALGA", "alga");
define("TBL_BIULETENIS", "biuletenis");
define("TBL_DARBO_STATISTIKA", "darbo_statistika");
define("TBL_GYDYMAS", "gydymas");
define("TBL_KABINETAS", "kabinetas");
define("TBL_LIGA","liga");
define("TBL_LIGOS_APRASAS","ligos_aprasas");
define("TBL_NURODYMAS","nurodymas");
define("TBL_PACIENTO_LIGOS","paciento_ligos");
define("TBL_PROCEDURA","procedura");
define("TBL_RECEPTAS","receptas");
define("TBL_REZERVACIJA","rezervacija");
define("TBL_SEIMOS_GYDYTOJAS","seimos_gydytojas");
define("TBL_SIUNTIMAS","siuntimas");
define("TBL_SPECIALISTAS","specialistas");
define("TBL_TYRIMAS","tyrimas");
define("TBL_UZIMTUMAS","uzimtumas");
define("TBL_VAISTAS","vaistas");
define("TBL_VAISTU_ISRASAS","vaistu_israsas");
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
define("FAMILY_DOCTOR_NAME", "Seimos_gydytojas");
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
