<?php
// Template haut connecteur K-Php
session_start();
setlocale (LC_ALL, "fr");
include_once("config/cfg.php");
$bean = new sso();
if (array_key_exists("kticket", $_GET) && $_SESSION["KSESSION"] == "") {
 connecteurMgr::validerTicket($bean);
}
else {
 connecteurMgr::verifierSession($bean);
}
include("k_integration.php");    
#connecteurMgr::lireTemplate("haut");
// Fin - Template haut connecteur K-Php
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Humathèque Condorcet - droits d'accès du lecteur</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light"  style="background-color: #006271;">
           <div class="container-fluid">
               <a class="navbar-brand" href="#"><img src="img/CC-LogoHumatheque-VsCarree-Blanc.png" width="10%"><span class="text-white">Procédure d'inscription et de récupération de badge lecteur</span></a>
           </div>
        </nav>
        <br>
        <div class="container">
            <p>Pour consulter sur place et/ou pour emprunter des documents, une inscription est nécessaire. 
            <p>Vous pouvez déterminer vos modalités d'inscription à l'Humathèque Condorcet en utilisant le formulaire ci-dessous.
    
            <form action="">
                  <div id="divcategorie">
                        <p>Vous êtes :
                               <select class="form-select" id="categorie">
                                      <option value="NIL">
                                      <option value="CHERCHEUR">Chercheur
                                      <option value="DOCTORANT">Doctorant
                                      <option value="ENSEIGNANT-CHERCHEUR">Enseignant-chercheur
                                      <option value="MASTER">Etudiant en master
                                      <option value="PERSONNEL-ESR">Personnel de l'enseignement supérieur
                                      <option value="AUTRES-PUBLICS">Autres publics
                               </select>
                  </div>
                  <div id="divacces">
                        <p>Vous souhaitez :
    			                     <select class="form-select" id="acces">
                                      <option value="NIL">
                                      <option value="ARC">Accéder aux archives
                                      <option value="DOC">Accéder aux collections documentaires
                                      <option value="ESP">Accéder aux espaces de travail
                                      <option value="AUT">Autre cas
                               </select>
                  </div>
                  <div id="divetablissement_master">
                        <p>Votre établissement de rattachement est : 
                               <select class="form-select" id="etablissement_master">
                                      <option value="NIL">
                                      <option value="ENC">Ecole nationale des chartes
                                      <option value="EHESS">EHESS
                                      <option value="EPHE">EPHE
                                      <option value="P1">Université Paris 1 Panthéon Sorbonne
                                      <option value="P3">Université Paris 3 Sorbonne Nouvelle
                                      <option value="P8">Université Paris 8 
                                      <option value="P10">Université Paris 10 Paris Nanterre
                                      <option value="P13">Université Paris 13 Sorbonne Paris Nord
                                      <option value="AUTESR">Autre établissement français d'enseignement supérieur
                                      <option value="AUT">Autre cas
                               </select>
                  </div>
                  <div id="divufr">
                        <p>Quelles études poursuivez-vous à l'université Paris 1 ?
                               <select class="form-select" id="ufr">
                                      <option value="NIL">
                                      <option value="HIS">Histoire
                                      <option value="GEO">Géographique
                                      <option value="GEN">Etudes de genre
                                      <option value="IDU">IDUP
                                      <option value="AUT">Autre
                               </select>
                  </div>
                  <div id="diviheal">
                        <p>Êtes-vous étudiant à l'IHEAL ?
                               <select class="form-select" id="iheal">
                                       <option value="NIL">
                                       <option value="OUI">Oui
                                       <option value="NON">Non
                               </select>
                  </div>
                  <div id="divresident">
                        <p>Êtes-vous résident au Campus Condorcet ?
                               <select class="form-select" id="resident">
                                       <option value="OUI">Oui
                                       <option value="NON">Non
                               </select>
                  </div>
                  <div id="divetablissement_resident">
                        <p>Votre établissement de rattachement est : 
                               <select class="form-select" id="etablissement_resident">
                                      <option value="NIL">
                                      <option value="CNRS">CNRS
                                      <option value="ENC">Ecole nationale des chartes
                                      <option value="EHESS">EHESS
                                      <option value="EPHE">EPHE
                                      <option value="FMSH">FMSH
                                      <option value="INED">INED
                                      <option value="P1">Université Paris 1 Panthéon Sorbonne
                                      <option value="P3">Université Paris 3 Sorbonne Nouvelle
                                      <option value="P8">Université Paris 8 
                                      <option value="P10">Université Paris 10 Paris Nanterre
                                      <option value="P13">Université Paris 13 Sorbonne Paris Nord
                                      <option value="AUTFR">Autre établissement français
                                      <option value="AUT">Autre cas
                                </select>
                  </div>
                  <div id="divbadge">
                        <p>Disposez-vous d'un badge Campus Condorcet ?
                               <select class="form-select" id="badge">
                                       <option value="NIL">
                                       <option value="OUI">Oui
                                       <option value="NON">Non
                               </select>
                  </div>
                  <div id="divconclusion">
                        <p class="text-success fs-3 d-block" id="conclusion"></p>
                  </div>
            </form>
        </div>

    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/droits-lecteur.js"></script>

</html>
<?php
// Connecteur bas
#connecteurMgr::lireTemplate("bas");
// Fin - Connecteur bas
?>
