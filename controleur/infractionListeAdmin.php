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

    if(!isset($_SESSION["admin"])){
        header("Location: infractionListe.php");
    }

    function printTabInfra(){
        $inf = new InfractionDAO;
        $del = new DelitsDAO;

        $infractions = $inf->getAll();

        for($i=0;$i<count($infractions);$i++)
        {        
            $d = new DateTime($infractions[$i]->getDateInf());
            $date = $d->format("d/m/Y");

            echo "<table>
                    <thead class='infraction'>
                        <tr>
                            <th>".$infractions[$i]->getIdInf()."</th>
                            <th>".$date."</th>
                            <th></th>
                            <th>".$infractions[$i]->getNumImmat()."</th>
                            <th>".$del->getTotalTarif($infractions[$i]->getIdInf())."€ </th>
                            <th class='btn'><input type='button' class='buttonDeroulant'/></th>
                            <th class='btn'><a href='./modification.controleur.php?id=".$infractions[$i]->getIdInf()."'><input type='button' class='buttonModif'/></a></th>
                            <th class='btn'><form method='POST' action='./suppression.controleur.php?id=".$infractions[$i]->getIdInf()."' onclick='return confirmSuppr(".$infractions[$i]->getIdInf().")'>
                                <input type='submit'class='buttonSuppr'/>
                            </form></th>
                        </tr>
                    </thead>";
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
                    <td></td>
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