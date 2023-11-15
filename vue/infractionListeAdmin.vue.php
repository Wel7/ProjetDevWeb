<!DOCTYPE html>
<html lang="Fr">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Liste des infractions</title>
        <link type="text/css" rel="stylesheet" href="../vue/css/infraction.css">
    </head>
    <body>
        
        <div id="div_infra_liste_titre" class="divtitre"> Liste des infractions
            <div id="btnTitre">
                <div id="ajout">
                    <a href="../controleur/ajout.controleur.php">Ajout</a>
                </div>
                <div id="deconnexion">
                    <a href="../controleur/login.controleur.php">Deconnexion</a>
                </div>
            </div>
        </div>

        <table>
            <tr>
                <th>Identifiant d'infraction</th>
                <th>Date</th>
                <th></th>
                <th>Immatriculation</th>
                <th>Montant</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </table>
        <div id="table_infraction">
            <?php 
                printTabInfra();
            ?>
        </div>
    </body>
</html>