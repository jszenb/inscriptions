<?php

require("xmlParser.class.php"); 

/**
* xmlParser.php
*
* @author philippe Guiomar [KOSMOS.FR]
* @version $Revision$
* @date $Date$
* @package include
* @param void
* @return void
*/
class xmlParserSSO extends xmlParser {

	var $xmlData;

	/**
	* xmlParserSSO
	*
	* @author philippe Guiomar [KOSMOS.FR]
	* @version $Revision$
	* @date $Date$
	* @package include
	* @param void
	* @return void
	*/
	function xmlParserSSO() {
		xmlParser::xmlParser();
	}

	/**
	* contentTag
	*
	* @author philippe Guiomar [KOSMOS.FR]
	* @version $Revision$
	* @date $Date$
	* @package include
	* @param void
	* @return void
	*/
	function contentTag($parser, $strContent) {
		$this->xmlData[strtolower($GLOBALS['currentTagName'])]=$strContent;	
	}

	/**
	* parseXML
	*
	* @author philippe Guiomar [KOSMOS.FR]
	* @version $Revision$
	* @date $Date$
	* @package include
	* @param $strXml : flux Xml à analyser
	* @return $xmlData tableau;
	*/
	function parseXML($strXml) {
		xml_parse($this->hdlParser, $strXml);
		xml_parser_free($this->hdlParser);			
		return $this->xmlData;
	}
}
?>
