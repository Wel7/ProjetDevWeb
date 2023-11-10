<?php

class Admin
{
    private int $num_admin;
    private string $nom_admin;
    private string $prenom_admin;
    private string $mdp_admin;
    private string $identifiant_admin;

    function __construct(int $num_admin=-1, string $nom_admin='', string $prenom_admin='', string $mdp_admin='', string $identifiant_admin='')
    {
        $this->num_admin = $num_admin;
        $this->nom_admin = $nom_admin;
        $this->prenom_admin = $prenom_admin;
        $this->mdp_admin = $mdp_admin;
        $this->identifiant_admin = $identifiant_admin;
    }

    function getNumAdmin(): int
    {
        return $this->num_admin;
    }

    function setNumAdmin(int $num_admin): void
    {
        $this->num_admin = $num_admin;
    }

    function getNomAdmin(): string
    {
        return $this->nom_admin;
    }

    function setNomAdmin(string $nom_admin): void
    {
        $this->nom_admin = $nom_admin;
    }

    function getPrenomAdmin(): string
    {
        return $this->prenom_admin;
    }

    function setPrenomAdmin(string $prenom_admin): void
    {
        $this->prenom_admin = $prenom_admin;
    }

    function getMdpAdmin(): string
    {
        return $this->mdp_admin;
    }

    function setMdpAdmin(string $mdp_admin): void
    {
        $this->mdp_admin = $mdp_admin;
    }

    function getIdentifiantAdmin(): string
    {
        return $this->identifiant_admin;
    }

    function setIdentifiantAdmin(string $identifiant_admin): void
    {
        $this->identifiant_admin = $identifiant_admin;
    }
}
?>