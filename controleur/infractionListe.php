<?php
    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    require_once "../modele/conducteurDAO.modele.php";
    require_once "../modele/infractionDAO.modele.php";
    require_once "../modele/delitsDAO.modele.php";

    session_start();

    $numPermis = $_SESSION["identifiant"];
    $cond = new ConducteurDAO;
    $conducteur = $cond->getByNumPermis($numPermis);

    $inf = new InfractionDAO;

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
            echo "
            <tr>
                <td></td>
                <td>".($i+1)."</td>
                <td></td>
                <td>".$infractions[$i]->getDateInf()."</td>
                <td>".$infractions[$i]->getNumImmat()."</td>
                <td>".$del->getTotalTarif($infractions[$i]->getIdInf())."€ </td>
                <td><input type='button' class='buttonDeroulant' id='inf".$infractions[$i]->getIdInf()."'/>
            </tr>
            ";
            $delits= $del->getByIdInfra($infractions[$i]->getIdInf());
            echo "
                <tr class='tab_delits inf".$infractions[$i]->getIdInf()."'>
                    <th></th>
                    <th>Numéro</th>
                    <th></th>
                    <th>Nature</th>
                    <th>Tarif</th>
                    <th></th>
                    <th></th>
                </tr>";
                for($j=0;$j<count($delits);$j++)
                {
                    echo "
                <tr class='tab_delits inf".$infractions[$i]->getIdInf()."'>
                    <td></td>
                    <td>".($i+1).'.'.($j+1)."</td>
                    <td></td>
                    <td>".$delits[$j]->getNature()."</td>
                    <td>".$delits[$j]->getTarif()."€ </td>
                    <td></td>
                    <td></td>
                    </tr>
                        ";
                }
                echo "
            </div>";
        }
    }

    require_once "../vue/infractionListe.vue.php"
?>