<?php
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
class xmlParser  {
	var $hdlParser;

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
	function xmlParser() {
		$this->hdlParser = xml_parser_create("UTF-8");
		xml_set_object($this->hdlParser, $this);
		xml_set_character_data_handler ( $this->hdlParser, "contentTag");
		xml_set_default_handler ( $this->hdlParser, "defaultTag");
		xml_set_element_handler ( $this->hdlParser, "openTag", "closeTag");
	}

	/**
	* openTag
	*
	* @author philippe Guiomar [KOSMOS.FR]
	* @version $Revision$
	* @date $Date$
	* @package include
	* @param void
	* @return void
	*/
	function openTag($parser, $strTagName, $arrAttribs) {
		$GLOBALS['currentTagName']=$strTagName;
	}

	/**
	* closeTag
	*
	* @author philippe Guiomar [KOSMOS.FR]
	* @version $Revision$
	* @date $Date$
	* @package include
	* @param void
	* @return void
	*/
	function closeTag($parser, $strTagName) {
		$GLOBALS['currentTagName']="";
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

	}

	/**
	* defaultTag
	*
	* @author philippe Guiomar [KOSMOS.FR]
	* @version $Revision$
	* @date $Date$
	* @package include
	* @param void
	* @return void
	*/
	function defaultTag($parser, $name) {

	}

}
?>
