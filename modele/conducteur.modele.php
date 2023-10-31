<?php
class Conducteur {
    private string $num_permis;
    private string $date_permis;
    private string $nom;
    private string $prenom;
    private string $motDePasse;

    public function __construct($num_permis='', $date_permis='', $nom='', $prenom='', $motDePasse='') {
        $this->num_permis = $num_permis;
        $this->date_permis = $date_permis;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->motDePasse = $motDePasse;
    }
    

    public function getNumPermis(): string {
        return $this->num_permis;
    }

    public function getDatePermis(): string {
        return $this->date_permis;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function getMotDePasse(): string {
        return $this->motDePasse;
    }

    public function setNumPermis(string $num_permis) {
        $this->num_permis = $num_permis;
    }

    public function setDatePermis(string $date_permis) {
        $this->date_permis = $date_permis;
    }

    public function setNom(string $nom) {
        $this->nom = $nom;
    }

    public function setPrenom(string $prenom) {
        $this->prenom = $prenom;
    }

    public function setMotDePasse(string $motDePasse) {
        $this->motDePasse = $motDePasse;
    }
}
?>