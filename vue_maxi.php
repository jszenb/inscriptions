<?php

	session_start();
	setlocale (LC_ALL, "fr");

	include_once("config/cfg.php");

	$bean = new sso();
	// On regarde si la session a déjà été initialisée
	//if (! array_key_exists("SSOBEAN", $_SESSION)) {
	//	$bean = $_SESSION["SSOBEAN"];
	//}
	//echo "ksession = ".$_SESSION["SSOBEAN"]->ksession;
	//print_r($_SESSION);
	if (array_key_exists("kticket", $_GET) && $_SESSION["KSESSION"] == "") {
		connecteurMgr::validerTicket($bean);
	}
	else {
		connecteurMgr::verifierSession($bean);
	}
	connecteurMgr::verifierCodeRetour($bean);

	$user = $bean->code_utilisateur_kportal;

	// effacement du cache
	//$macondition = "";
	//if ($macondition == "")
	//{
	//	connecteurMgr::invaliderCache($_SESSION["SERVICE"]);
	//}

	include("k_integration.php");

	connecteurMgr::lireTemplate("haut");
?>
<h3>Vue maxi</h3>
<table cellspacing="1" cellpadding="1" border="1">
	<tr>
		<th colspan="2">Toutes les informations</th>
	</tr>
	<tr>
		<th width="150">Donnée</th>
		<th width="150">Valeur</th>
	</tr>
	<tr>
		<td>civilité</td>
		<td><?php echo $bean->civilite?></td>
	</tr>
	<tr>
		<td>nom</td>
		<td><?php echo $bean->nom?></td>
	</tr>
	<tr>
		<td>prénom</td>
		<td><?php echo $bean->prenom?></td>
	</tr>
	<tr>
		<td>code utilisateur kportal</td>
		<td><?php echo $bean->code_utilisateur_kportal?></td>
	</tr>
	<tr>
		<td>code utilisateur gestion</td>
		<td><?php echo $bean->code_utilisateur_gestion?></td>
	</tr>
	<tr>
		<td>email</td>
		<td><?php echo $bean->email?></td>
	</tr>
	<tr>
		<td>groupe</td>
		<td><?php echo $bean->groupe?></td>
	</tr>
	<tr>
		<td>profil</td>
		<td><?php echo $bean->profil?></td>
	</tr>
	<tr>
		<td>structure</td>
		<td><?php echo $bean->structure?></td>
	</tr>
	<tr>
		<td>code retour</td>
		<td><?php echo $bean->code_retour?></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><a href="#" onclick="window.back()">Retour</a></td>
	</tr>
</table>
<?
	connecteurMgr::lireTemplate("bas");
?>
