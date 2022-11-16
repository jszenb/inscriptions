<?PHP
	//*********************************************************************************
	//* recherche.class.php
	//*********************************************************************************
	/**
	* recherche.class.php
	*
	* encadre de recherche
	*
	*
	* @author philippe Guiomar
	* @version $Revision$
	* @date $Date$
	* @package
	* @param void
	* @return void
	*/

class liste_encadres_recherche  {

var  $encadre_recherche="";
	
	//*********************************************************************************
	//* addEncadre_recherche
	//*********************************************************************************
	/**
	* addEncadre_recherche
	*
	*
	* @author philippe Guiomar [KOSMOS.FR]
	* @version $Revision$
	* @date $Date$
	* @package
	* @param strEncadreRecherche : String
	* @return void
	*/
	function addEncadre_recherche($strEncadreRecherche) {
		 		//$this->encadre_recherche[]=$strEncadreRecherche; 
		 		$this->encadre_recherche=$strEncadreRecherche; 
	}//fin addEncadre_recherche

}//fin recherche

?>
