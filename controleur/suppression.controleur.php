<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once "../modele/infractionDAO.modele.php";
require_once "../modele/delitsDAO.modele.php";

session_start();
if(!isset($_SESSION["identifiant"])){
    header("Location: login.controleur.php");
}

if(!isset($_SESSION["admin"])){
    header("Location: infractionListe.php");
}
if(!isset($_GET["id"])){
    header("Location: infractionListeAdmin.php");
}

$delit = new DelitsDAO();
$infra = new InfractionDAO();

if ($infra->idExiste($_GET['id'])) {
    $delit->delete($_GET['id']);
    $infra->delete($_GET['id']);
} else {
    throw new ErrorException("ID d'infraction inexistant ou inaccessible");
}

header("Location: ./infractionListeAdmin.php");
?>