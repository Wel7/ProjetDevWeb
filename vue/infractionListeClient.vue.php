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

        <table id="table_infraction" >
            <thead>
                <tr>
                    <th>Numéro</th>
                    
                    <th>Date</th>
                    <th></th>
                    <th>Immatriculation</th>
                    <th>Montant</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    printTabInfra($numPermis)
                ?>
            </tbody>
        </table>

    </body>
</html>