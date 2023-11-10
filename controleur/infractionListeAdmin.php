<?php

    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    require_once "../modele/conducteurDAO.modele.php";
    require_once "../modele/infractionDAO.modele.php";
    require_once "../modele/delitsDAO.modele.php";

    function printTabInfra(){
        $inf = new InfractionDAO;
        $del = new DelitsDAO;

        $infractions = $inf->getAll();
        for($i=0;$i<count($infractions);$i++)
        {        
            echo "<table>
                    <tr class='infraction'>
                        <th>".$infractions[$i]->getIdInf()."</th>
                        <th>".$infractions[$i]->getDateInf()."</th>
                        <th></th>
                        <th>".$infractions[$i]->getNumImmat()."</th>
                        <th>".$del->getTotalTarif($infractions[$i]->getIdInf())."€ </th>
                        <th class='btn'>
                        <input type='button' class='buttonDeroulant'/>
                        <a href='./modification.controleur.php?id=".$infractions[$i]->getIdInf()."' class='buttonModif'>
                        <form method='POST' action='./suppression.controleur.php?id=".$infractions[$i]->getIdInf()."' onclick='return confirmSuppr(".$infractions[$i]->getIdInf().")'>
                            <input type='submit'class='buttonSuppr'/>
                        </form>
                    </tr>";
            $delits= $del->getByIdInfra($infractions[$i]->getIdInf());
                echo "<tbody class='delit hidden'>";
                for($j=0;$j<count($delits);$j++){
                    echo "
                <tr>
                    <td></td>
                    <td></td>
                    <td>".$delits[$j]->getNature()."</td>
                    <td></td>
                    <td>".$delits[$j]->getTarif()."€ </td>
                    <td></td>
                </tr>";
                }
            echo "</tbody></table>";
        }
    }

    require_once "../vue/infractionListeAdmin.vue.php"
?>
<script type="module" src="infractionListe.js"></script>
<script>
    function confirmSuppr(id){
        return confirm("Souhaitez-vous réellement supprimer l'infraction "+id);
    }
</script>