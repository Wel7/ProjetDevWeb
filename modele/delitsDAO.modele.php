<?php
require_once("connexion.php");
require_once("delit.modele.php");

class DelitsDAO
{
    //Déclaration des variables
    private $bd;
    private $select;


    //Déclaration du construcc
    function __construct()
    {
        $this->bd = new Connexion();
        $this->select = 'SELECT * FROM `delit` ';

    }

    //Fonctionnant transformant un tableau en tableau associatif
    private function loadQuery(array $result): array
    {
        $delits = [];
        foreach ($result as $row) {
            $delit = new Delit();
            $delit->setIdDelit($row['id_delit']);
            $delit->setNature($row['nature']);
            $delit->setTarif($row['tarif']);
            $delits[] = $delit;
        }
        return $delits;

    }

    // Retourne tous les délits
    function getAll(): array
    {
        return ($this->loadQuery($this->bd->execSQLselect($this->select)));
    }

    // Retourne le délit d'un id

    function getById(int $id): Delit
    {

        $unDelit = new Delit;
        $lesDelit = $this->loadQuery($this->bd->execSQLselect($this->select . " WHERE
        id_delit=:id", [':id' => $id]));
        if (count($lesDelit) > 0) {
            $unDelit = $lesDelit[0];
        }
        return $unDelit;
    }

    // Retourne les délits d'une infraction à l'aide de son id

    function getByIdInfra(int $id_infra): array
    {

        return $this->loadQuery($this->bd->execSQLselect("SELECT c.id_delit,nature, tarif FROM comprend c, delit d 
        WHERE c.id_delit=d.id_delit AND id_inf =" . $id_infra));
    }

    // Retourne un délit et infraction en fonction de leurs id

    function getByIdInfraDelit(int $id_infra, int $id_delit): array
    {

        return $this->loadQuery($this->bd->execSQLselect("SELECT c.id_delit, nature,tarif 
        FROM comprend c, delit d 
        WHERE c.id_delit=" . $id_delit .
            "AND id_inf =" . $id_infra));
    }


    // Calcule le total de tarif pour une infraction
    function getTotalTarif(int $id_infra): float
    {
        return (($this->bd->execSQLselect("SELECT SUM(tarif) as 'tarif'
        FROM comprend c, delit d 
        WHERE c.id_delit=d.id_delit
        AND id_inf =" . $id_infra))[0]['tarif']);
    }

    // Insere dans la Bdd un tableau d'ID de délit pour une infraction
    function insert(Infraction $infra, Delit $delit): void
    {
        $this->bd->execSQL("INSERT INTO comprend VALUES (".$infra->getIdInf() .",". $delit->getIdDelit() .")");
    }

    // Supprime les délits d'une infraction
    function delete(int $id_inf): void
    {
        $this->bd->execSQL("DELETE FROM comprend 
            WHERE id_inf = :id_inf", [':id_inf' => $id_inf]);
    }

    // Supprime un delit d'une infraction
    function deleteInfraDelit(int $id_inf, int $id_delit): void
    {
        $this->bd->execSQL("DELETE FROM comprend 
            WHERE id_inf = :id_inf AND id_delit = :id_delit", [':id_inf' => $id_inf, ':id_delit' => $id_delit]);
    }
}
?>