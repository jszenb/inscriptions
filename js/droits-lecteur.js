//******************************************************************
// FICHIER : droits_lecteur.js
// DESCRIPTION : fonctions javascript pour la page droits_lecteur
// AUTEUR : JCS, CC
//******************************************************************
$( document ).ready(function() {
	hide_all();

	// Constantes utiles pour la suite
	MSG_ACCUEIL = "De par votre inscription à votre établissement, vous êtes aussi inscrit à l'Humathèque Condorcet et vous pouvez retirer votre badge d'accès à l'accueil de la bibliothèque.";
  	MSG_ARCHIVES = "L'accès est possible : vous devez nous contacter pour prendre un rendez-vous pour consulter les archives.";
  	MSG_BADGE_CC = "De par votre inscription à votre établissement, vous êtes aussi inscrit à l'Humathèque Condorcet et votre badge Campus Condorcet vous sert de badge d'accès à la bibliothèque.";
	MSG_CERTIF = "Vous pouvez vous inscrire à l'Humathèque Condorcet en vous présentant à l'accueil de la bibliothèque en vous munissant d'un certificat d'étude et de vos identifiants d'établissement.";
  	MSG_CONTACT = "Veuillez nous contacter pour préciser votre demande d'accès.";
	MSG_ESPACE = "Vous pouvez accéder à l'Open Space, salle de travail située au rez-de-chaussée de l'Humathèque et ouverte de 08 h 00 à 20 h 00 du lundi au vendredi.";
	MSG_ETRANGER = "Vous pouvez vous inscrire à l'Humathèque Condorcet en vous présentant à l'accueil de la bibliothèque et en vous munissant d'une carte d'étudiant ou de votre carte professionnelle.";
	MSG_INTRANET = "Vous devez vous inscrire à l'Humathèque Condorcet en passant par l'intranet de votre établissement. Une fois cela fait, vous pourrez retirer votre badge d'accès à l'accueil de l'Humathèque Condorcet.";
  	MSG_JUSTIF = "Vous pouvez vous inscrire à l'Humathèque Condorcet en vous présentant à l'accueil de la bibliothèque en vous munissant d'un justificatif et de vos identifiants d'établissement.";
	MSG_REFERENT = "Vous devez demander votre inscription à votre unité ou à votre référent laboratoire. Votre badge sera ensuite disponible au PC de Sécurité du Campus Condorcet. Il vous permettra d'accéder à l'Humathèque Condorcet.";
  	MSG_VISITEUR = "Vous pouvez faire une demande d’accès sur justificatif de recherche";
});

function hide_all(){
	$("#divetablissement_master").hide();
	$("#etablissement_master").val("NIL");
	$("#divufr").hide();
	$("#ufr").val("NIL");
	$("#diviheal").hide();
	$("#iheal").val("NIL");
	$("#divetablissement_resident").hide();
	$("#etablissement_resident").val("NIL");
	$("#divacces").hide();
	$("#acces").val("NIL");
	$("#divresident").hide();
	$("#resident").val("NIL");
	$("#divbadge").hide();
	$("#badge").val("NIL");
	$("#divconclusion").hide();
	$("#conclusion").text("");
}

// Gestion de la catégorie du lecteur : chercheur, enseignant, doctorant, etc.
$("#categorie").change(function () { 
	// On réinitialise tout
 	hide_all();   
	ma_categorie = $("#categorie").val();
	switch(ma_categorie){
		case "AUTRES-PUBLICS":
			// Réinitialisation de la select box
			$("#acces").val("NIL");
			$("#divacces").show();
			break;
		case "NIL":
			hide_all();   
			break;
		case "MASTER":
      			$("#divetablissement_master").show();
			break;
		default: // tous les autres cas : doctorants, chercheurs, etc.
      			$("#divresident").show();
			break;
	}
});

$("#resident").change(function(){
	mon_resident = $("#resident").val();
	setConclusion("", "hide");
	$("#badge").val("NIL");
	switch(mon_resident){
		case "OUI":
			$("#divetablissement_resident").hide();
			$("#divbadge").show();
			break;
		case "NON":
      			$("#divetablissement_resident").show();
			$("#divbadge").hide();
			break;
	  	default:
	    		hide_all();
	}
});

$("#etablissement_resident").change(function() {
	mon_etablissement_resident = $("#etablissement_resident").val();
	$("#divbadge").hide();
	$("#badge").val("NIL");
	setConclusion("", "hide");
	switch(mon_etablissement_resident){
		case "NIL":
			setConclusion("", "hide");
	  		break;
		case "P1":
			//setConclusion(MSG_ACCUEIL, "show");
			setConclusion(MSG_INTRANET, "show");
	  		break;
		case "EHESS":
		case "EPHE":
		case "INED":
		case "FMSH":
			$("#divbadge").show();
      			break;
		case "CNRS":
		case "ENC":
		case "P3":
		case "P8":
		case "P10":
		case "P13":
			setConclusion(MSG_JUSTIF, "show");
	  		break;
		case "AUTFR":
			//setConclusion(MSG_JUSTIF, "show");
			setConclusion(MSG_ETRANGER, "show");
	  		break;
		case "AUT":
			//setConclusion(MSG_CONTACT, "show");
			setConclusion(MSG_ETRANGER, "show");
	  		break;
		default:
			hide_all();
	}
});

$("#badge").change(function(){
	mon_badge = $("#badge").val();
	switch(mon_badge){
	  case "OUI":
			setConclusion(MSG_BADGE_CC, "show");
			break;
	  case "NON":
			setConclusion(MSG_REFERENT, "show");
			break;
	  default:
	    		hide_all();
	}
});

$("#etablissement_master").change(function(){
	mon_etablissement_master = $("#etablissement_master").val();
	$("#divufr").hide();
	$("#diviheal").hide();
	$("#ufr").val("NIL");
	$("#iheal").val("NIL");
	setConclusion("", "hide");
	switch(mon_etablissement_master){
	  	case "NIL":
			setConclusion("", "hide");
	  		break;
	  	case "EHESS":
			setConclusion(MSG_ACCUEIL, "show");
	  		break;
	  	case "EPHE":
			setConclusion(MSG_INTRANET, "show");
	  		break;
	  	case "NIL":
	    		hide_all();
			break;
		case "P1":
			$("#divufr").show();
			break;
		case "P3":
			$("#diviheal").show();
			break;
		case "P8": // Voir ENC
		case "P10": // Voir ENC
		case "P13": // Voir ENC
		case "AUTESR": // Voir ENC
		case "ENC":
			setConclusion(MSG_CERTIF, "show");
	  		break;
		case "AUT": 
			//setConclusion(MSG_CONTACT, "show");
			setConclusion(MSG_ETRANGER, "show");
			break;
	  default:
	    hide_all();
	}
});

$("#ufr").change(function() {
	setConclusion("", "hide");
	mon_ufr = $("#ufr").val();
	switch(mon_ufr){
	  	case "NIL":
			setConclusion("", "hide");
	  		break;
	  	case "HIS": // Voir IDU
	  	case "GEO": // Voir IDU
	  	case "GEN": // Voir IDU
	  	case "IDU":
			setConclusion(MSG_ACCUEIL, "show");
	  		break;
	  	case "AUT":
			setConclusion(MSG_INTRANET, "show");
	  		break;
	  	default:
	    		hide_all();
	}
});

$("#iheal").change(function() {
	setConclusion("", "hide");
	mon_iheal = $("#iheal").val();
	switch(mon_iheal){
	  case "NIL":
		setConclusion("", "hide");
	  	break;
	  case "OUI":
		setConclusion(MSG_BADGE_CC, "show");
	  	break;
	  case "NON":
		setConclusion(MSG_CERTIF, "show");
	  	break;
	  default:
	    	hide_all();
	}
});
// Le lecteur potentiel n'est pas d'une catégorie académique : que veut-il faire au GED ?
$("#acces").change(function () {
	setConclusion("", "hide");
	mon_acces = $("#acces").val();
	switch(mon_acces){
		case "ARC":
			setConclusion(MSG_ARCHIVES, "show");
	  		break;
	  	case "DOC":
			setConclusion(MSG_VISITEUR, "show");
	  		break;
		case "AUT":
			setConclusion(MSG_CONTACT, "show");
			break;
		case "ESP":
			setConclusion(MSG_ESPACE, "show");
			$("#conclusion").append(" <a href='https://www.humatheque-condorcet.fr/fr/pour-tous/lopen-sapce'>Plus d'informations.</a>");
			break;
		case "NIL":
			setConclusion("", "hide");
	  	default:
			break;
	}
});

// Détermination de la consigne à donner au lecteur potentiel
function setConclusion(value, status) {
  	$("#conclusion").text(value);
	switch(value){
	 case MSG_CONTACT: 
		$("#conclusion").append(" Vous trouverez <a href='https://www.humatheque-condorcet.fr/fr/contacts'>ici toutes les informations pour nous contacter</a>");
		break;
	case MSG_ARCHIVES:
		$("#conclusion").append(" Vous trouverez <a href='https://www.humatheque-condorcet.fr/fr/collections-et-archives/archives/contacter-le-service-des-archives'>ici toutes les informations pour nous contacter</a>");
		break;
	case MSG_VISITEUR:
		$("#conclusion").append(" <a href='https://www.humatheque-condorcet.fr/fr/pour-le-quotidien/sinscrire/inscription-sur-justification-de-recherches'>en remplissant le formulaire suivant</a>");
		break;
	default:
		break;
	}

	if (status == "show")
    		$("#divconclusion").show();
	else
    		$("#divconclusion").hide();
};
