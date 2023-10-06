<?php

/**
* connecteurmgr.php
*
* Cette classe gère le connecteur applicatif pour l'authentification avec Kportal
*/
class connecteurMgr
{
	/**
	 * appel du SSO kportal avec présentation d'un ticket
	 * 
	 * @param request
	 * @return le bean SSO (code retour = '0' si OK)
	 */
	public static function getSSOBeanFromTicket(&$bean)
	{
		$uri = SSO_KTICKET_URL.$_GET["kticket"];
		connecteurMgr::getSSOBeanFromUri($bean,$uri);
		return true;
	}

	/**
	 * appel du SSO kportal 
	 * 
	 * @param _uri
	 * @return le bean SSO (code retour = '0' si OK)
	 */
	public static function getSSOBeanFromUri(&$bean,$uri)
	{
		//*****************************************************
		//ouvrir le flux XML qui contient les données SSO
		//*****************************************************
		$url = SSO_URL_SERVER.$uri;
		$http = new http;
		$fp = $http->http_fopen(SSO_HOST_SERVER, $uri,SSO_PORT_SERVER);

		if (!$fp) {
			$bean->code_retour = "400";
			exit;
		}

		$strXml= "";
		while ($donnees = fread($fp, 8096)) {
			$strXml.= $donnees;
		}

		//*****************************************************
		//analyse du texte XML
		//*****************************************************
		$parser = new XmlParserSSO();
		$arrXmlData = $parser->parseXML($strXml);

		if (!isset($arrXmlData["civilite"]))
			$arrXmlData["civilite"] = "";
		if (!isset($arrXmlData["code_retour"]))
			$arrXmlData["code_retour"] = "";
		if (!isset($arrXmlData["code_utilisateur_gestion"]))
			$arrXmlData["code_utilisateur_gestion"] = "";
		if (!isset($arrXmlData["code_utilisateur_kportal"]))
			$arrXmlData["code_utilisateur_kportal"] = "";
		if (!isset($arrXmlData["email"]))
			$arrXmlData["email"] = "";
		if (!isset($arrXmlData["groupes"]))
			$arrXmlData["groupes"] = "";
		if (!isset($arrXmlData["nom"]))
			$arrXmlData["nom"] = "";
		if (!isset($arrXmlData["prenom"]))
			$arrXmlData["prenom"] = "";
		if (!isset($arrXmlData["profil"]))
			$arrXmlData["profil"] = "";
		if (!isset($arrXmlData["structure"]))
			$arrXmlData["structure"] = "";
		if (!isset($arrXmlData["ksession"]))
			$arrXmlData["ksession"] = "";

		$bean->civilite = $arrXmlData["civilite"];
		$bean->code_retour = $arrXmlData["code_retour"];
		$bean->code_utilisateur_gestion = $arrXmlData["code_utilisateur_gestion"];
		$bean->code_utilisateur_kportal = $arrXmlData["code_utilisateur_kportal"];
		$bean->email = $arrXmlData["email"];
		$bean->groupe = $arrXmlData["groupes"];
		$bean->nom = $arrXmlData["nom"];
		$bean->prenom = $arrXmlData["prenom"];
		$bean->profil = $arrXmlData["profil"];
		$bean->structure = $arrXmlData["structure"];
		$bean->ksession = $arrXmlData["ksession"];

		// Sauvegarde des informations dans la session utilisateur
		connecteurMgr::putInSession($bean);

		return true;
	}

	/**
	 * sauvegarde les informations dans la session de l'utilisateur
	 * 
	 * @param request
	 * @return le bean SSO (code retour = '0' si OK)
	 */
	public static function putInSession(&$bean)
	{
		$_SESSION["SSOBEAN"] = $bean;
		$_SESSION["KSESSION"] = $bean->ksession;

		// récupération du référer
		if( isset($_GET["kportal_host"]) )
			$sKportalHost = $_GET["kportal_host"];
	
		// mode https
		if( isset($_GET["secure"]) )
			$secure = $_GET["secure"];
	
		// Récupération de l'identifiant du service 
		if( isset($_GET["service"]) )
			$idService = $_GET["service"];

		// récupération de la langue
		if( isset($_GET["langue"]) )
			$langue = $_GET["langue"];
		else 
			$langue = "0";
		// Si pas de referer on prend le host par défaut
		if( !isset($sKportalHost) || $sKportalHost == "")
			$sKportalHost = SSO_URL_SERVER;
		
		// si le mode sécurisé est pas précisé on le valorise à 0 (aucun)
		if (!isset($secure) || $secure == "")
			$secure = "0";

		$_SESSION["URL_KPORTAL"]=$sKportalHost;
		$_SESSION["SECURE"]=$secure;
		
		if (isset($idService) && $idService != "") {
			$_SESSION["SERVICE"]= $idService;
		}
		
		if (isset($langue) && $langue != "") {
			$_SESSION["LANGUE"] = $langue;
		}
		return true;
	}

	/**
	 * valide le ticket et recupere les informations de session de l'utilisateur
	 * @param bean
	 */
	public static function validerTicket(&$bean)
	{
		if (session_id() == "")
			session_start();

		$kticket = "";
		if (array_key_exists("kticket", $_GET)) {
			$kticket = $_GET["kticket"];
		}
		if ($kticket != "") {

			// Récupération du bean de session à partir du ticket
			connecteurMgr::getSSOBeanFromTicket($bean);
		}
		if ($bean->ksession == "") {

			// il n'y avait pas de ticket à valider
			$bean->code_retour = "300";
		}

		return true;
	}

	/**
	 * verifie que l'utilisateur est toujours connecte et recupere ses informations de session
	 * @param bean
	 */
	public static function verifierSession(&$bean)
	{
		if (isset($_SESSION["KSESSION"])) {
			$ksession = $_SESSION["KSESSION"];
		}
		if (isset($ksession)) {
			$uri = SSO_KSESSION_URL.$ksession;
		} else {
			$uri = SSO_KSESSION_URL;
		}
		connecteurMgr::getSSOBeanFromUri($bean, $uri);
		return true;
	}

	/**
	 * verifie le code retour du sso et gere les redirections en cas de besoin
	 * @param bean
	 */
	public static function verifierCodeRetour(&$bean)
	{
		// On analyse le code retour du ticket
		if ($bean->code_retour == "100")
			$msgErreur = "Session fermée";
		if ($bean->code_retour == "200")
			$msgErreur = "Session fermée";
		if ($bean->code_retour == "300")
			$msgErreur = "Accès interdit";
		if ($bean->code_retour == "400")
			$msgErreur = "Problème de connexion";
		if ($bean->code_retour == "100" || $bean->code_retour == "200")
		{
			session_destroy();
			unset($_SESSION);
			header("location:".SSO_URL_SERVER.LOGIN_URL);
		}
		else if ($bean->code_retour == "300" || $bean->code_retour == "400")
		{
			session_destroy();
			unset($_SESSION);
			header("location:".SSO_URL_SERVER.ERROR_URL);
		}
	}

	/**
	 * recupere le code html correspondant a l'entete et au pied de page du portail
	 * @param ktemplate (haut ou bas)
	 */
	public static function lireTemplate($ktemplate)
	{
		$sKportalHost = $_SESSION["URL_KPORTAL"];
		if (!isset($sKportalHost))
			return false;
		
		$ksession = $_SESSION["KSESSION"];
		if (!isset($ksession))
		{
			$ksession = "";
		}
		
		// ajout du flux XML lié aux informations spécifiques pour piloter le portail
		$objRequete = $GLOBALS["objRequete"];
		$sGraphBean = "";
		if (isset($objRequete))
		{
			$sGraphBean = $objRequete->genererFluxXML();
		}
		// déterminer le host et port, dans la session on a l'url kportal, on regarde si le host et le port sont là
		// on gère le cas où le port est précisé
		$sKportalHost = $_SESSION["URL_KPORTAL"];
		if (strrpos($sKportalHost, '/'))
			$sKportalHost = substr($sKportalHost,7);

		if (strrpos($sKportalHost, ':'))
		{
			$port = substr($sKportalHost, strrpos($sKportalHost, ':') + 1);
			$host = substr($sKportalHost, 0, strrpos($sKportalHost, ':'));
		} else
		{
			$host = $sKportalHost;
			$port = "";
		}

		$http_client = new k_http(HTTP_V11, false);
		if ($sKportalHost=="")
		{
			$http_client->host = SSO_HOST_SERVER;
			$http_client->port = SSO_PORT_SERVER;
		}
		else
		{
			$http_client->host = $host;
			if ($port>"")
			{
				$http_client->port = $port;
			}
		}
		$arrVariables["graphbean"] = $sGraphBean;

		$sUrl = SSO_URL_SERVER.PATH_HTML_KCONNECT."?ktemplate=".$ktemplate."&ksession=".$ksession."&graphbean=".urlencode($sGraphBean);
		//echo "URL = ".$sUrl."<br/>";

		$cUrl = curl_init();
		curl_setopt($cUrl, CURLOPT_URL, $sUrl);
		curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, 1);
		#curl_setopt($cUrl, CURLOPT_FOLLOWLOCATION, 1);

		echo curl_exec($cUrl);
		curl_close($cUrl);

		return true;
	}

	/**
	 * Invalidation du cache associé à un service
	 * 
	 * Cette méthode appelle l'url correspondante sur le portail
	 * 
	 * le jeton 'KSESSION' est extrait de la requête
	 * 
	  * @param _service
	 * @throws Exception
	 */
	public static function invaliderCache($_service)
	{
		$ksession = $_SESSION["KSESSION"];
		
		if(!isset($_service)||($_service==""))
			return false;

		$uri = SSO_EXPIRATION_CACHE."?ksession=".$ksession."&service=".$_service;

		$url = SSO_URL_SERVER.$uri;
		$http = new http;
		$fp = $http->http_fopen(SSO_HOST_SERVER, $uri,SSO_PORT_SERVER);

		if (!$fp) {
			return false;
		}

		return true;
	}

	/**
	 * Génération d'une url d'activation de service
	 * 
	 * Peut être utilisé dans une vue réduite pour générer un lien vers
	 * la vue maxi.
	 * 
	 * @param _service
	 * @return
	 */
	public static function genererUrlTicket($_service) {
		return SSO_ACTIVATION_SERVICE.$_service;
	}
}
?>
