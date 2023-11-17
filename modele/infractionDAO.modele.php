<?php
require_once "connexion.php";
require_once "infraction.modele.php";

class InfractionDAO
{
    // Declaration des variables
    private $bd;
    private $select;

    // Declaration du construct
    function __construct()
    {
        $this->bd = new Connexion();
        $this->select = "Select * FROM `infraction` ";
    }

    //Fonctionnant transformant un tableau en tableau associatif
    private function loadQuery(array $result): array
    {
        $infractions = [];
        foreach ($result as $row) {
            $infraction = new Infraction();
            $infraction->setIdInf($row['id_inf']);
            $infraction->setDateInf($row['date_inf']);
            $infraction->setNumImmat($row['num_immat']);
            $infraction->setNumPermis($row['num_permis']);
            $infractions[] = $infraction;
        }
        return $infractions;
    }

    // Verifie si l'infraction existe

    function idExiste(string $id_infra): bool
    {
        return count($this->bd->execSQLselect($this->select . " WHERE id_inf=" . $id_infra)) > 0;

    }

    function idDispo():int
    {
        return ($this->bd->execSQLselect("SELECT a.id_inf + 1 AS id
        FROM infraction AS a
        LEFT JOIN infraction AS b ON a.id_inf + 1 = b.id_inf
        WHERE b.id_inf IS NULL
        ORDER BY a.id_inf
        LIMIT 1;"))[0]["id"];
    }

    // Retourne tous les infractions
    function getAll(): array
    {
        return ($this->loadQuery($this->bd->execSQLselect($this->select)));
    }


    // Retourne une infraction d'apres un id
    function byIdInf(string $id_inf): Infraction
    {
        return ($this->loadQuery($this->bd->execSQLselect($this->select . " Where id_inf=" . $id_inf)))[0];
    }



    // Retourne les infractions d'apres un id
    function byIdPermis(string $id_permis): array
    {
        return ($this->loadQuery($this->bd->execSQLselect($this->select . " Where num_permis='" . $id_permis . "'")));
    }

    // Supprime une infraction

    function delete(string $id_inf): void
    {
        $this->bd->execSQL("DELETE FROM infraction 
                WHERE id_inf = :id_inf", [':id_inf' => $id_inf]);
    }

    // Insere dans la Bdd un tableau de délit pour une infraction

    function insert(Infraction $infra): void
    {
        $this->bd->execSQL("INSERT INTO infraction(id_inf, date_inf, num_immat, num_permis ) VALUES
            (" . $infra->getIdInf() . ",'" . $infra->getDateInf() . "','" . $infra->getNumImmat() .
            "','" . $infra->getNumPermis() . "')");
    }

    function insertNoId(Infraction $infra): void
    {
        $this->bd->execSQL("INSERT INTO infraction(date_inf, num_immat, num_permis ) VALUES
            (" . $infra->getDateInf() . "','" . $infra->getNumImmat() .
            "','" . $infra->getNumPermis() . "')");
    }



    // Met à jour une infraction
    function update(Infraction $infra): void
    {
        $this->bd->execSQL("UPDATE infraction SET date_inf = :date_inf, num_immat = :num_immat, num_permis = :num_permis WHERE id_inf = :id_inf", [
            ':id_inf' => $infra->getIdInf(),
            ':date_inf' => $infra->getDateInf(),
            ':num_immat' => $infra->getNumImmat(),
            ':num_permis' => $infra->getNumPermis()
        ]);
    }
}