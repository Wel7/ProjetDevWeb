<?php

require_once 'connexion.php';
require_once 'admin.modele.php';

class AdminDAO
{

    public $bd;

    private $select;

    function __construct()
    {
        $this->bd = new Connexion();
        $this->select = 'SELECT num_admin, nom_admin, prenom_admin, mdp_admin, identifiant_admin FROM `admin` ';
    }

    /**
     * Insère un nouvel objet Admin dans la base de données.
     */
    function insert(Admin $admin): void
    {
        $this->bd->execSQL("INSERT INTO admin (nom_admin, prenom_admin, mdp_admin, identifiant_admin)
                            VALUES (:nom_admin, :prenom_admin, :mdp_admin, :identifiant_admin)"
            ,
            [':nom_admin' => $admin->getNomAdmin(), ':prenom_admin' => $admin->getPrenomAdmin(), ':mdp_admin' => $admin->getMdpAdmin(), ':identifiant_admin' => $admin->getIdentifiantAdmin()]
        );
    }

    /**
     * Supprime un objet Admin de la base de données.
     */
    function delete(int $num_admin): void
    {
        $this->bd->execSQL("DELETE FROM admin 
                            WHERE num_admin = :num_admin", [':num_admin' => $num_admin]);
    }

    /**
     * Met à jour un objet Admin dans la base de données.
     */
    function update(Admin $admin): void
    {
        $this->bd->execSQL("UPDATE admin 
                            SET nom_admin = :nom_admin, prenom_admin = :prenom_admin, mdp_admin = :mdp_admin, identifiant_admin = :identifiant_admin
                            WHERE num_admin = :num_admin"
            ,
            [':num_admin' => $admin->getNumAdmin(), ':nom_admin' => $admin->getNomAdmin(), ':prenom_admin' => $admin->getPrenomAdmin(), ':mdp_admin' => $admin->getMdpAdmin(), ':identifiant_admin' => $admin->getIdentifiantAdmin()]
        );
    }

    /**
     * Charge les objets Admin à partir du résultat de la requête de la base de données.
     */
    private function loadQuery(array $result): array
    {
        $admins = [];
        foreach ($result as $row) {
            $admin = new Admin();
            $admin->setNumAdmin($row['num_admin']);
            $admin->setNomAdmin($row['nom_admin']);
            $admin->setPrenomAdmin($row['prenom_admin']);
            $admin->setMdpAdmin($row['mdp_admin']);
            $admin->setIdentifiantAdmin($row['identifiant_admin']);
            $admins[] = $admin;
        }
        return $admins;
    }


    /**
     * Vérifie si un objet Admin existe dans la base de données par son identifiant_admin et mdp_admin.
     */
    function verifAdmin(string $identifiant_admin, string $mdp_admin): bool
    {   
        $i = 0;
        $req = $this->select . " WHERE identifiant_admin = :identifiant_admin";
        $res = ($this->loadQuery($this->bd->execSQLselect($req, [':identifiant_admin' => $identifiant_admin]))); 
        if(count($res) != 0)     
            return (password_verify($mdp_admin,$res[0]->getMdpAdmin()));
        return false;

    }
}

?>