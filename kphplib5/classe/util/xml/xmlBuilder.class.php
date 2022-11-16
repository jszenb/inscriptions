<?PHP
	//*********************************************************************************
	//* xmlBuilder.class.php
	//*********************************************************************************
	/**
	* xmlBuilder.class.php
	*
	*
	*
	*
	*
	* @author philippe Guiomar
	* @version $Revision$
	* @date $Date$
	* @package
	* @param void
	* @return void
	*/


	class xmlBuilder {
		

	//*********************************************************************************
	//* buildProlog
	//*********************************************************************************
	/**
	* buildProlog
	*
	*
	*
	* @author philippe Guiomar [KOSMOS.FR]
	* @version $Revision$
	* @date $Date$
	* @package
	* @param void
	* @return void
	*/
	function buildProlog() {
				$strProlog='<?xml version="1.0" encoding="UTF-8"?>';
				return $strProlog;
	}//fin buildProlog



	//*********************************************************************************
	//* buildElement
	//*********************************************************************************
	/**
	* buildElement
	*
	*
	*
	* @author philippe Guiomar [KOSMOS.FR]
	* @version $Revision$
	* @date $Date$
	* @package
	* @param void
	* @return void
	*/
	function buildElement($cle,$valeur) {
			$strElement="";
			if ($valeur!="") {
						$strElement=sprintf("<%s>%s</%s>",strtoupper($cle),htmlentities($valeur),strtoupper($cle));
			} else {
//*
						$strElement=sprintf("<%s/>",strtoupper($cle));
/*/
						$strElement=sprintf("");
//*/
			}//if
			return $strElement;		 
	}//fin buildElement


	//*********************************************************************************
	//* buildXml
	//*********************************************************************************
	/**
	* buildXml
	*
	*
	*
	* @author philippe Guiomar [KOSMOS.FR]
	* @version $Revision$
	* @date $Date$
	* @package
	* @param void
	* @return void
	*/
	function buildXml($objData) {

				$strXml=$this->buildProlog();
				$strXml.=sprintf("<%s>",strtoupper(get_class($objData)));
				foreach ($objData as $cleElement => $valeurElement) {
				
				if (is_array($valeurElement)) {
							$strXml.=sprintf("<%s>",strtoupper($cleElement));
							foreach ($valeurElement as $cleObjet => $valeurObjet) {
									if (is_object($valeurObjet))  {
											$strXml.=sprintf("<%s>",strtoupper(get_class($valeurObjet)));
											foreach ($valeurObjet as $cleSousElement => $valeurSousElement) {
													$strXml.="".$this->buildElement($cleSousElement , $valeurSousElement);									
											}//foreach
											$strXml.=sprintf("</%s>",strtoupper(get_class($valeurObjet)));
									} else {
											$strXml.=$this->buildElement($cleObjet , $valeurObjet);	
									}//if
							}//foreach
							$strXml.=sprintf("</%s>",strtoupper($cleElement));
					} else {
						if (is_object($valeurElement)) {
							$strXml.=sprintf("<%s>",strtoupper($cleElement));
							foreach ($valeurElement as $cleTab => $valeurTab) {
									if (is_array($valeurTab))  {
											foreach ($valeurTab as $cleSousElement => $valeurSousElement) {
													$strXml.="".$this->buildElement($cleTab , $valeurSousElement);									
											}//foreach							
									}//if
							}//foreach
							$strXml.=sprintf("</%s>",strtoupper($cleElement));
					} else {
						$strXml.="".$this->buildElement($cleElement , $valeurElement);	
						}//if
					}//if
					
					
				}//foreach
				$strXml.=sprintf("</%s>",strtoupper(get_class($objData)));
				return $strXml;

	}//fin buildXml
}//fin xmlBuilder

?>