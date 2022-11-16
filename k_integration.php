<?php
	// on peut piloter le code rubrique, la langue et le mode https
  
	$strRubrique = "ACCUEIL";
	$objRequete = new requete($strRubrique);
	$langue = $_SESSION["LANGUE"];
	$secure = $_SESSION["SECURE"];
	if (isset($langue))
		$objRequete->setLangue($langue);
	if (isset($secure))
		$objRequete->setSecure("1" == $secure);

	/*
	// ajout d'encadrés (contenu, controles, menus, ...)
	$strTitre = "Encadré 1";
	$strContenu = "Contenu_encadré 1";
	$objEncadre1 = new encadre($strTitre,$strContenu);
	$objRequete->addEncadre($objEncadre1);
	$strTitre = "Encadré 2";
	$strContenu = "Contenu encadré 2";
	$objEncadre2 = new encadre($strTitre,$strContenu);
	$objRequete->addEncadre($objEncadre2);

	// ajout d'encadrés de recherche
	$objEncadreRecherche=new liste_encadres_recherche();		
	$objEncadreRecherche->addEncadre_recherche("0002");
	$objRequete->addEncadreRecherche($objEncadreRecherche);	
	 */

	$objDonneesSpecifiques = new donnesSpecifiques("TITLE", "Catégorie du lecteur");
	$objRequete->addDonneesSpecifiques($objDonneesSpecifiques);

	//$includeHead = "<script type=\"text/javascript\" src=\"./js/fonctions.js\"></script>\r\n";
	//$includeHead.= "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/css/styles.css\" title=\"defaut\" />\r\n";
	//$objDonneesSpecifiques = new donnesSpecifiques("INCLUDE_HEAD", $includeHead);
	//$objRequete->addDonneesSpecifiques($objDonneesSpecifiques);

	$GLOBALS["objRequete"] = $objRequete;
?>
