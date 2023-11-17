<head>
    <title>Dépot du JSON</title>
    <link href="../vue/css/dropjson.css" rel="stylesheet" />
</head>


<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

include_once("../vue/dropjson.php");

include_once("../modele/conducteurDAO.modele.php");
include_once("../modele/delitsDAO.modele.php");
include_once("../modele/infractionDAO.modele.php");
include_once("../modele/vehiculeDAO.modele.php");

$conDAO = new ConducteurDAO();
$delDAO = new DelitsDAO();
$infDao = new InfractionDAO();
$vehDao = new VehiculeDAO();

if ($_FILES == [] ) {
    exit();
}


if ($_FILES["file"]["name"] == "") {
    exit();
}

$fichierJson = file_get_contents($_FILES['file']['tmp_name']);
$fichierJson = json_decode($fichierJson, true);

foreach ($fichierJson as $infraction) {
    if (!isset($infraction['date_inf']) || !isset($infraction['num_immat']) || !isset($infraction['num_permis']) || !isset($infraction['delits'])) {
        echo "<p  id = 'erreur'>Il y a un problème avec le fichier JSON. Assurez-vous que les clés 'date_inf', 'num_mmat', 'num_permis' et 'delit' sont présentes dans chaque infraction.</p>";
        exit();
    }

    if (strtotime($infraction['date_inf']) > time()) {
        echo "<p  id = 'erreur'>Il y a un problème avec les dates dans le fichier JSON.</p>";
        exit();
    }
    if (!$vehDao->existe($infraction["num_immat"])) {
        var_dump($infraction["num_immat"]);
        echo "<p  id = 'erreur'>Il y a un problème avec les numéros d'immatriculations dans le fichier JSON.</p>";
        exit();
    }
    if ($infraction["num_permis"] != "" && !$conDAO->existe($infraction["num_permis"])) {
        echo "<p  id = 'erreur'>Il y a un problème avec les conducteurs dans le fichier JSON.</p>";
        exit();
    }
    if($infraction["delits"] == []){
        echo "<p  id = 'erreur'>Il y a un problème avec les délits dans le fichier JSON.</p>";
        exit();
    }
    foreach ($infraction["delits"] as $id_delit) {
        if (!$delDAO->existe($id_delit)) {
            echo "<p  id = 'erreur'>Il y a un problème avec les délits dans le fichier JSON.</p>";
            exit();
        }
    }
}


foreach ($fichierJson as $infraction) {
    $id_infra = $infDao->idDispo();
    $infra = new Infraction($id_infra, date("Y-m-d",strtotime(str_replace("/", "-", $infraction["date_inf"]))), $infraction["num_immat"], $infraction["num_permis"]);
    
    $infDao->insert($infra);
    foreach ($infraction["delits"] as $id_delit) {
        $delDAO->insert($infra, $delDAO->getById($id_delit));
    }    
}

$_FILES = [];
echo "<p  id = 'reussi'>Les données ont été ajouté à la base de donnée !</p>";
?>