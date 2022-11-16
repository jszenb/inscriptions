<?PHP

	class donnesSpecifiques {

	var $nom="";
	var $valeur="";


	function donnesSpecifiques($strNom,$strValeur) {
				$this->setNom($strNom);
				$this->setValeur($strValeur);
	}//fin fct
	
	function setNom($strNom) {
				$this->nom=$strNom;
	}//fin fct
	
	
	function setValeur($strValeur) {
				$this->valeur=$strValeur;
	}//fin fct


}//encadre





?>