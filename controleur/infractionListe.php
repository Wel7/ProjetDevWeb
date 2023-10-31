<?php

    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    require_once "../modele/conducteurDAO.modele.php";
    require_once "../modele/infractionDAO.modele.php";
    require_once "../modele/delitsDAO.modele.php";

    $numPermis = "AZ67";
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
                <td>".$del->getTotalTarif($infractions[$i]->getIdInf())."</td>
                
            </tr>
            ";
        }
    }

    require_once "../vue/infractionListe.vue.php"
?>