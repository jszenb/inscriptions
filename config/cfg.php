<?php

// chemins vers kphplib
define("KPHPLIB_PATH", "/var/www/inscriptions/kphplib5/");
// chemins des librairies
define("KPHPLIB_PATH_CLASSE",           KPHPLIB_PATH."classe/");
define("KPHPLIB_PATH_CLASSE_DATA",      KPHPLIB_PATH."classe/data/");
define("KPHPLIB_PATH_CLASSE_SSO",       KPHPLIB_PATH."classe/sso/");
define("KPHPLIB_PATH_CLASSE_UTIL_XML",  KPHPLIB_PATH."classe/util/xml/");
define("KPHPLIB_PATH_CLASSE_UTIL_HTTP", KPHPLIB_PATH."classe/util/http/");
define("KPHPLIB_PATH_INCLUDE",          KPHPLIB_PATH."include/");

// url du serveur sur lequel tourne K-Portal (ici il tourne sur le même serveur que notre application PHP)
define("SSO_URL_SERVER", "https://portail-preprod.humatheque-condorcet.fr");
define("SSO_HOST_SERVER", "portail-preprod.humatheque-condorcet.fr");
define("SSO_PORT_SERVER", "443");

include_once(KPHPLIB_PATH_INCLUDE."params.php");
?>

