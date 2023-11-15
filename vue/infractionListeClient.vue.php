<!DOCTYPE html>
<html lang="Fr">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Liste des infractions</title>
        <link type="text/css" rel="stylesheet" href="../vue/css/infraction.css">
    </head>
    <body>
        
        <div id="div_infra_liste_titre" class="divtitre"> Liste des infractions
            <?php printIdentite($conducteur);?>
            <div id="deconnexion">
                <a href="../controleur/login.controleur.php">Deconnexion</a>
            </div>
        </div>

        
        <table>
            <tr>
                <th>Numéro</th>
                    
                <th>Date</th>
                <th></th>
                <th>Immatriculation</th>
                <th>Montant</th>
                <th></th>
            </tr>
        </table>
        <div id="table_infraction" >
                <?php 
                    printTabInfra($numPermis)
                ?>
        </div>

    </body>
</html>