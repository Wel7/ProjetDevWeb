
<?php
require_once('connexion.php');
require_once('vehicule.modele.php');

class VehiculeDAO
{

    public $bd;
    private $select;

    function __construct()
    {
        $this->bd = new Connexion();
        $this->select = 'SELECT num_immat, date_immat, modele, marque, num_permis FROM `vehicule` ';
    }

    /**
     * Insère un nouvel objet Vehicule dans la base de données.
     */
    function insert(Vehicule $vehicule): void
    {
        $this->bd->execSQL("INSERT INTO vehicule (num_immat, date_immat, modele, marque, num_permis)
                                VALUES (:num_immat, :date_immat, :modele, :marque, :num_permis)"
            ,
            [':num_immat' => $vehicule->getNumImmat(), ':date_immat' => $vehicule->getDateImmat(), ':modele' => $vehicule->getModele(), ':marque' => $vehicule->getMarque(), ':num_permis' => $vehicule->getNumPermis()]
        );
    }

    /**
     * Supprime un véhicule de la base de données en utilisant son numéro d'immatriculation.
     */
    function delete(string $num_immat): void
    {
        $this->bd->execSQL("DELETE FROM vehicule 
                            WHERE num_immat = :num_immat", [':num_immat' => $num_immat]);
    }

    /**
     * Met à jour les informations d'un véhicule dans la base de données.
     */
    function update(Vehicule $vehicule): void
    {
        $this->bd->execSQL("UPDATE vehicule 
                            SET date_immat = :date_immat, modele = :modele, marque = :marque, num_permis = :num_permis
                            WHERE num_immat = :num_immat"
            ,
            [':num_immat' => $vehicule->getNumImmat(), ':date_immat' => $vehicule->getDateImmat(), ':modele' => $vehicule->getModele(), ':marque' => $vehicule->getMarque(), ':num_permis' => $vehicule->getNumPermis()]
        );
    }

    /**
     * Charge les informations de tous les véhicules de la base de données.
     */

    private function loadQuery(array $result): array
    {
        $vehicules = [];
        foreach ($result as $row) {
            $vehicule = new Vehicule();
            $vehicule->setNumImmat($row['num_immat']);
            $vehicule->setDateImmat($row['date_immat']);
            $vehicule->setModele($row['modele']);
            $vehicule->setMarque($row['marque']);
            $vehicule->setNumPermis($row['num_permis']);
            $vehicules[] = $vehicule;
        }
        return $vehicules;
    }

    /**
     * Renvoie les informations de tous les véhicules de la base de données.
     */
    function getAll(): array
    {
        return ($this->loadQuery($this->bd->execSQLselect($this->select)));
    }

    /**
     * Retrouve les informations d'un véhicule de la base de données en utilisant son numéro d'immatriculation.
     */
    function getByNumImmat(string $num_immat): Vehicule
    {

        $unVehicule = new Vehicule();
        $lesVehicules = $this->loadQuery($this->bd->execSQLselect($this->select . " WHERE
        num_immat=:num_immat", [':num_immat' => $num_immat]));
        if (count($lesVehicules) > 0) {
            $unVehicule = $lesVehicules[0];
        }
        return $unVehicule;
    }

    /**
     * Vérifie si un véhicule existe dans la base de données en utilisant son numéro d'immatriculation.
     */
    function existe(string $num_immat): bool
    {
        $req = $this->select . " WHERE num_immat = :num_immat";
        $res = ($this->loadQuery($this->bd->execSQLselect($req, [':num_immat' => $num_immat])));
        return ($res != []);
    }

    /**
     * Retrouve les véhicule à permis du numéro de permis de son conducteur.
     */

    function getByNumPermis(string $num_permis): array
    {
        $req = $this->select . " WHERE num_permis = :num_permis";
        return ($this->loadQuery($this->bd->execSQLselect($req, [':num_permis' => $num_permis])));

    }
}
?>