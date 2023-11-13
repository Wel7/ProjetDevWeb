<?php

    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    require_once "../modele/conducteurDAO.modele.php";
    require_once "../modele/infractionDAO.modele.php";
    require_once "../modele/delitsDAO.modele.php";

    session_start();
    if(!isset($_SESSION["identifiant"])){
        header("Location: login.controleur.php");
    }

    $numPermis = "AZ67";
    $cond = new ConducteurDAO;
    $inf = new InfractionDAO;

    $conducteur = $cond->getByNumPermis($numPermis);

    function printIdentite(Conducteur $conducteur){
        $reg = '/^[aeiouy]/i';
        if(preg_match($reg,$conducteur->getNom())) {echo " d'";}
        else{echo " de ";}
        echo $conducteur->getNom()." ".$conducteur->getPrenom(); 
    }

    function printTabInfra($numPermis){
        $inf = new InfractionDAO;
        $del = new DelitsDAO;

        $infractions = $inf->byIdPermis($numPermis);
        for($i=0;$i<count($infractions);$i++)
        {   
            $d = new DateTime($infractions[$i]->getDateInf());
            $date = $d->format("d/m/Y"); 

            echo "<table>
                    <tr class='infraction'>
                        <th>".($i+1)."</th>
                        
                        <th>".$date."</th>
                        <th></th>
                        <th>".$infractions[$i]->getNumImmat()."</th>
                        <th>".$del->getTotalTarif($infractions[$i]->getIdInf())."€ </th>
                        <th><input type='button' class='buttonDeroulant'/></th>
                    </tr>
            ";
            $delits= $del->getByIdInfra($infractions[$i]->getIdInf());
                echo "<tbody class='delit hidden'>";
                for($j=0;$j<count($delits);$j++)
                {
                    echo "
                <tr>

                    <td></td>
                    <td></td>
                    <td>".$delits[$j]->getNature()."</td>
                    <td></td>
                    <td>".$delits[$j]->getTarif()."€ </td>
                    <td></td>
                    </tr>
                        ";
                }
            echo "</tbody></table>";
        }
    }

    require_once "../vue/infractionListeClient.vue.php"
?>
<script type="module" src="infractionListe.js"></script>