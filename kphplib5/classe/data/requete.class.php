<?php

/**
* requete.class.php
*
* contient les donnees sur la rubrique et la structure qui vont afficher les donnees
*
*
* @author philippe Guiomar
* @version $Revision$
* @date $Date$
* @package
* @param void
* @return void
*/
class requete {

	var $rubrique="";
	var $langue="";
	var $secure="";
	var $donnees_specifiques;
	var $liste_encadres; //obj Encadre
	var $liste_encadres_recherche; //obj liste_encadres_recherche

	/**
	* requete
	*
	* @author philippe Guiomar
	* @version $Revision$
	* @date $Date$
	* @package
	* @param strRubrique : String, strStructure : String
	* @return void
	*/
	function requete($strRubrique="") {
		$this->setRubrique($strRubrique);
	}

	function setRubrique($strRubrique) {
		$this->rubrique=$strRubrique;
	}

	function setLangue($strLangue) {
		$this->langue=$strLangue;
	}

	function setSecure($strSecure) {
		$this->secure=$strSecure;
	}

	function addEncadre($objEncadre) {
		$this->liste_encadres[]=$objEncadre;
	}
	
	function addDonneesSpecifiques($objDonneesSpec) {
		$this->donnees_specifiques[]=$objDonneesSpec;
	}

	function addEncadreRecherche($objEncadreRecherche) {
		$this->liste_encadres_recherche=$objEncadreRecherche;		 
	}
	
	function genererFluxXML()
	{
		$strXml = "<REQUETE>";
		if (! empty($this->rubrique)) {
			$strXml .= "<RUBRIQUE>".$this->rubrique."</RUBRIQUE>";
		}
		if (! empty($this->langue)) {
			$strXml .= "<LANGUE>".$this->langue."</LANGUE>";
		}
		if (! empty($this->secure)) {
			$strXml .= "<SECURE>".$this->secure."</SECURE>";
		}
		if (is_array($this->liste_encadres)) {
			$strXml .= "<LISTE_ENCADRES>";
			foreach ($this->liste_encadres as $encadre) {
				if (! empty($encadre->titre) || ! empty($encadre->contenu)) {
					$strXml .= "<ENCADRE>";
					if (! empty($encadre->titre)) {
						$strXml .= "<TITRE>".$encadre->titre."</TITRE>";
					}
					if (! empty($encadre->contenu)) {
						$strXml .= "<CONTENU>".$encadre->contenu."</CONTENU>";
					}
					$strXml .= "</ENCADRE>";
				}
			}
			$strXml .= "</LISTE_ENCADRES>";
		}
		if (is_array($this->liste_encadres_recherche)) {
			$strXml .= "<LISTE_ENCADRES_RECHERCHE>";
			foreach ($this->liste_encadres_recherche->encadre_recherche as $encadre) {
				if (! empty($encadre)) {
					$strXml .= "<ENCADRE_RECHERCHE>".$encadre."</ENCADRE_RECHERCHE>";
				}
			}
			$strXml .= "</LISTE_ENCADRES_RECHERCHE>";
		}
		if (is_array($this->donnees_specifiques)) {
			$strXml .= "<DONNEES_SPECIFIQUES>";
			foreach ($this->donnees_specifiques as $donneeSpecifique) {
				if (! empty($donneeSpecifique->nom) || ! empty($donneeSpecifique->valeur)) {
					$strXml .= "<DONNEE>";
					if (! empty($donneeSpecifique->nom)) {
						$strXml .= "<NOM>".$donneeSpecifique->nom."</NOM>";
					}
					if (! empty($donneeSpecifique->valeur)) {
						$strXml .= "<VALEUR>".$donneeSpecifique->valeur."</VALEUR>";
					}
					$strXml .= "</DONNEE>";
				}
			}
			$strXml .= "</DONNEES_SPECIFIQUES>";
		}
		$strXml .= "</REQUETE>";
		return $strXml;
	}
}
?>
