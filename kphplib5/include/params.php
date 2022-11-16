<?php
// url d'appel du SSO K-Portal avec validation de ticket
define("SSO_KTICKET_URL", "/validationTicketServlet?kticket=");

// url d'appel du SSO K-Portal et recuperation des infos de session de l'utilisateur
define("SSO_KSESSION_URL", "/ssoInfosServlet?ksession=");

// url d'appel de la vue maxi d'un service
define("SSO_ACTIVATION_SERVICE", "/adminsite/sso/activation_service.jsp?service=");

// url de revocation du cache
define("SSO_EXPIRATION_CACHE", "/adminsite/sso/expiration_cache.jsp");

// url de recuperation des templates haut et bas
define("PATH_HTML_KCONNECT", "/jsp/dsi/kconnect.jsp");

// url de page de login K-Portal
define("LOGIN_URL", "/servlet/com.jsbsoft.jtf.core.SG?PROC=IDENTIFICATION_FRONT&ACTION=CONNECTER&LANGUE=0");

// url de page d'erreur
define("ERROR_URL", "/jsp/page_erreur.jsp");

include_once(KPHPLIB_PATH_CLASSE."k_http.inc");
include_once(KPHPLIB_PATH_CLASSE_DATA."requete.class.php");
include_once(KPHPLIB_PATH_CLASSE_DATA."donnesspec.class.php");
include_once(KPHPLIB_PATH_CLASSE_DATA."encadre.class.php");
include_once(KPHPLIB_PATH_CLASSE_DATA."recherche.class.php");
include_once(KPHPLIB_PATH_CLASSE_SSO."sso.class.php"); 
include_once(KPHPLIB_PATH_CLASSE_UTIL_HTTP."http.class.php");
include_once(KPHPLIB_PATH_CLASSE_UTIL_XML."xmlBuilder.class.php");
include_once(KPHPLIB_PATH_CLASSE_UTIL_XML."xmlParserSSO.class.php");
include_once(KPHPLIB_PATH_INCLUDE."ssoControle.php"); 			
?>
