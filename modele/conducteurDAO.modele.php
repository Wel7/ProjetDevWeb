<?php

require_once 'connexion.php';
require_once 'conducteur.modele.php';

class ConducteurDAO
{

    public $bd;

    private $select;

    function __construct()
    {
        $this->bd = new Connexion();
        $this->select = 'SELECT num_permis, date_permis, nom, prenom, motDePasse FROM `conducteur` ';
    }

    /**
     * Insère un nouvel objet Conducteur dans la base de données.
     */
    function insert(Conducteur $conducteur): void
    {
        $this->bd->execSQL("INSERT INTO conducteur (num_permis, date_permis, nom, prenom, motDePasse)
                            VALUES (:num_permis, :date_permis, :nom, :prenom, :motDePasse)"
            ,
            [':num_permis' => $conducteur->getNumPermis(), ':date_permis' => $conducteur->getDatePermis(), ':nom' => $conducteur->getNom(), ':prenom' => $conducteur->getPrenom(), ':motDePasse' => $conducteur->getMotDePasse()]
        );
    }

    /**
     * Supprime un objet Conducteur de la base de données.
     */
    function delete(string $num_permis): void
    {
        $this->bd->execSQL("DELETE FROM conducteur 
                            WHERE num_permis = :num_permis", [':num_permis' => $num_permis]);
    }

    /**
     * Met à jour un objet Conducteur dans la base de données.
     */
    function update(Conducteur $conducteur): void
    {
        $this->bd->execSQL("UPDATE conducteur 
                            SET date_permis = :date_permis, nom = :nom, prenom = :prenom, motDePasse = :motDePasse
                            WHERE num_permis = :num_permis"
            ,
            [':num_permis' => $conducteur->getNumPermis(), ':date_permis' => $conducteur->getDatePermis(), ':nom' => $conducteur->getNom(), ':prenom' => $conducteur->getPrenom(), ':motDePasse' => $conducteur->getMotDePasse()]
        );
    }

    /**
     * Charge les objets Conducteur à partir du résultat de la requête de la base de données.
     */
    private function loadQuery(array $result): array
    {
        $conducteurs = [];
        foreach ($result as $row) {
            $conducteur = new Conducteur();
            $conducteur->setNumPermis($row['num_permis']);
            $conducteur->setDatePermis($row['date_permis']);
            $conducteur->setNom($row['nom']);
            $conducteur->setPrenom($row['prenom']);
            $conducteur->setMotDePasse($row['motDePasse']);
            $conducteurs[] = $conducteur;
        }
        return $conducteurs;
    }

    /**
     * Récupère tous les objets Conducteur de la base de données.
     */
    function getAll(): array
    {
        return ($this->loadQuery($this->bd->execSQLselect($this->select)));
    }

    /**
     * Récupère un objet Conducteur de la base de données par son num_permis.
     */
    function getByNumPermis(string $num_permis): Conducteur
    {

        $unConducteur = new Conducteur();
        $lesConducteurs = $this->loadQuery($this->bd->execSQLselect($this->select . " WHERE
        num_permis=:num_permis", [':num_permis' => $num_permis]));
        if (count($lesConducteurs) > 0) {
            $unConducteur = $lesConducteurs[0];
        }
        return $unConducteur;
    }

    /**
     * Vérifie si un objet Conducteur existe dans la base de données par son num_permis.
     */
    function existe(string $num_permis): bool
    {
        $req = $this->select . " WHERE num_permis = :num_permis";
        $res = ($this->loadQuery($this->bd->execSQLselect($req, [':num_permis' => $num_permis])));
        return ($res != []);
    }

    /**
     * Vérifie si un objet Conducteur existe dans la base de données par son num_permis et son motDePasse.
     */
    function verifCon(string $num_permis, string $motDePasse): bool
    {
        $req = $this->select . " WHERE num_permis = :num_permis";
        $res = ($this->loadQuery($this->bd->execSQLselect($req, [':num_permis' => $num_permis])));
        return (password_verify($motDePasse,$res[0]->getMotDePasse()));
    }
}

?>