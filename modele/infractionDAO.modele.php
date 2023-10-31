<?php
    require_once "connexion.php";
    require_once "infraction.modele.php";

    class InfractionDAO {
        // Declaration des variables
        private $bd;
        private $select;

        // Declaration du construct
        function __construct(){
            $this->bd = new Connexion();
            $this->select = "Select * FROM `infraction` ";
        }

        //Fonctionnant transformant un tableau en tableau associatif
        private function loadQuery(array $result) : array{
            $infractions = [];
            foreach($result as $row){
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

        function idExiste(string $id_infra) : bool{
            return count($this->bd->execSQLselect($this->select." WHERE id_inf=".$id_infra)) > 0;

        }

        // Retourne tous les infractions
        function getAll(): array{
            return ($this->loadQuery($this->bd->execSQLselect($this->select)));
        }


        // Retourne une infraction d'apres un id
        function byIdInf(string $id_inf) : Infraction{
            return ($this->loadQuery($this->bd->execSQLselect($this->select." Where id_inf=".$id_inf)))[0];
        }

        // Supprime une infraction
        

        // Retourne les infractions d'apres un id
        function byIdPermis(string $id_permis) : array {
            return ($this->loadQuery($this->bd->execSQLselect($this->select." Where num_permis='".$id_permis."'")));
        }
      function delete(string $id_infr) : void {
            $this->bd->execSQL("DELETE FROM infraction 
                WHERE id_infr = :id_infr", [':id_infr'=>$id_infr ] );
        } 

        // Insere dans la Bdd un tableau de délit pour une infraction

        function insert(Infraction $infra): void {
            $this->bd->execSQL("INSERT INTO infraction(id_inf, date_inf, num_immat, num_permis ) VALUES
            (".$infra->getIdInf().",".$infra->getDateInf().",".$infra->getNumImmat().
            ",".$infra->getNumPermis().")");
        }

    }
?>