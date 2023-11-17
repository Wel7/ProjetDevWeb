<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

include_once("../modele/infractionDAO.modele.php");
include_once("../modele/conducteurDAO.modele.php");
include_once("../modele/vehiculeDAO.modele.php");
include_once("../modele/delitsDAO.modele.php");
session_start();
if(!isset($_SESSION["identifiant"])){
    header("Location: login.controleur.php");
}

if(!isset($_SESSION["admin"])){
    header("Location: infractionListe.php");
}
//Récupères l'ID de l'infraction
$valide = isset($_POST["date"]);

//Récupère les différentes informations nécessaires pour la page
$infDao = new infractionDAO();
$conDAO = new ConducteurDAO();
$vehDao = new VehiculeDAO();


$delDAO = new DelitsDAO();
$listeDelit = $delDAO->getAll();

//Génére les informations qui seront affichés sur la page
$idInf = $_POST["id"] ?? $infDao->idDispo();
$dateInf = $_POST["date"] ?? date("Y-m-d");
$immatInf = $_POST["immat"] ?? "";
$permisInf = $_POST["permis"] ?? "";
$delitCocher = $_POST["delit"] ?? [];

include("../vue/ajoutInfraction.view.php");



//Génère les différents messages d'erreurs
if (isset($_POST["id"])) {
    if ($infDao->idExiste($_POST["id"])) {
        echo "<p id = 'erreur'>L'ID est déjà pris</p>";
        $valide = false;
    }
}

if (isset($_POST["date"])) {
    if (strtotime($_POST["date"]) > time()) {
        echo "<p id = 'erreur'>La date doit être antérieure ou égale à aujourd'hui.</p>";
        $valide = false;
    }
    $datePermis = "";
    if (isset($_POST["permis"])) {
        $datePermis = strtotime($conDAO->getByNumPermis($_POST["permis"])->getDatePermis());
    }
    if ($datePermis == 0 && $permisInf != "") {
        echo "<p id = 'erreur'>Le numéro du permis n'est pas valide.</p>";
        $valide = false;
    } else if (strtotime($_POST["date"]) < $datePermis) {
        echo "<p id = 'erreur'>La date doit être après la date d'optention du permis.</p>";
        $valide = false;
    }
}
if (isset($_POST["immat"])) {
    if (!$vehDao->existe($_POST["immat"])) {
        echo "<p id = 'erreur'>La plaque d'immatriculation n'existe pas.</p>";
        $valide = false;
    } else {
        $voiture = $vehDao->getByNumImmat($_POST["immat"]);
        $voiture->getDateImmat();
        if (strtotime($_POST["date"]) > $voiture->getDateImmat()) {
            echo "<p id = 'erreur'>La date d'immatriculation de la voiture est après la date de l'infraction. Donc plaque d'immatriculation non valide.</p>";
            $valide = false;
        }
    }
}
if (!isset($_POST["delit"]) && isset($_POST["date"])) {
    echo "<p id = 'erreur'>Vous ne pouvez pas mettre aucun délit à une infraction.</p>";
    $valide = false;
}

if ($valide) {
    $infraction = new Infraction($_POST["id"], $_POST["date"], $_POST["immat"], $_POST["permis"]);
    $infDao->insert($infraction);

    foreach ($_POST["delit"] as $delitID) {
        $delDAO->insert($infraction, $delDAO->getById($delitID));
    }



    header('Location: infractionListeAdmin.php');
}


?>