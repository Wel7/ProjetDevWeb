<?php
require_once "../modele/infractionDAO.modele.php";
require_once "../modele/delitsDAO.modele.php";

session_start();
if ((!isset($_SESSION["identifiant"])&& isset($_SESSION["admin"]))) {
    header("Location: login.controleur.php");
}
if(!isset($_GET["id"])){
    header("Location: infractionListeAdmin.php");
}

$delit = new DelitsDAO();
$infra = new InfractionDAO();

var_dump($_GET['id']);
if ($infra->idExiste($_GET['id'])) {
    $delit->delete($_GET['id']);
    $infra->delete($_GET['id']);
} else {
    throw new ErrorException("ID d'infraction inexistant ou inaccessible");
}

header("Location: ./infractionListeAdmin.php")
    ?>