<?PHP
	//*********************************************************************************
	//* encadre.class.php
	//*********************************************************************************
	/**
	* encadre.class.php
	*
	* @author philippe Guiomar
	* @version $Revision$
	* @date $Date$
	* @package
	* @param void
	* @return void
	*/

	class encadre {

	var $titre="";
	var $contenu="";


	//*********************************************************************************
	//* encadre
	//*********************************************************************************
	/**
	* encadre
	*
	* @author philippe Guiomar
	* @version $Revision$
	* @date $Date$
	* @package
	* @param void
	* @return void
	*/
	function encadre($strTitre,$strContenu) {
				$this->setTitre($strTitre);
				$this->setContenu($strContenu);
	}//fin fct
	
	//*********************************************************************************
	//* setTitre
	//*********************************************************************************
	/**
	* setTitre
	*
	* @author philippe Guiomar
	* @version $Revision$
	* @date $Date$
	* @package
	* @param strTitre : String
	* @return void
	*/
	function setTitre($strTitre) {
				$this->titre=$strTitre;
	}//fin fct
	
	
	//*********************************************************************************
	//* setContenu
	//*********************************************************************************
	/**
	* setContenu
	*
	* @author philippe Guiomar
	* @version $Revision$
	* @date $Date$
	* @package
	* @param strContenu : String
	* @return void
	*/
	function setContenu($strContenu) {
				$this->contenu=$strContenu;
	}//fin fct


}//encadre





?>