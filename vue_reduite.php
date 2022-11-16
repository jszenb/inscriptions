<?php
	session_start();

	setlocale (LC_ALL, "fr");
	include_once("config/cfg.php");

	$bean = new sso();
	connecteurMgr::validerTicket($bean);
	connecteurMgr::verifierCodeRetour($bean);

	$user=$bean->code_utilisateur_kportal;
	$nom=$bean->nom;

	// Sélection par date des évènements ayant le status nouveau / en cours / etc
?>
<table cellspacing="1" cellpadding="1" border="1">
	<tr>
		<th colspan="2">Bienvenue...</th>
	</tr>
	<tr>
		<th width="80"><?php echo $nom?></th>
		<th width="80">(<?php echo $user?>)</th>
	</tr>
	<tr>
		<th colspan="2"><a href="<?php echo connecteurMgr::genererUrlTicket($_SESSION["SERVICE"])?>">Vue maxi</a></th>
	</tr>
</table>
