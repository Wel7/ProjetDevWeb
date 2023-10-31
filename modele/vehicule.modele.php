<?php
class Vehicule {
    private string $num_immat;
    private string $date_immat;
    private string $modele;
    private string $marque;
    private string $num_permis;

    public function __construct($num_immat='', $date_immat='', $modele='', $marque='', $num_permis='') {
        $this->num_immat = $num_immat;
        $this->date_immat = $date_immat;
        $this->modele = $modele;
        $this->marque = $marque;
        $this->num_permis = $num_permis;
    }

    public function getNumImmat(): string {
        return $this->num_immat;
    }

    public function getDateImmat(): string {
        return $this->date_immat;
    }

    public function getModele(): string {
        return $this->modele;
    }

    public function getMarque(): string {
        return $this->marque;
    }

    public function getNumPermis(): string {
        return $this->num_permis;
    }

    public function setNumImmat(string $num_immat) {
        $this->num_immat = $num_immat;
    }

    public function setDateImmat(string $date_immat) {
        $this->date_immat = $date_immat;
    }

    public function setModele(string $modele) {
        $this->modele = $modele;
    }

    public function setMarque(string $marque) {
        $this->marque = $marque;
    }

    public function setNumPermis(string $num_permis) {
        $this->num_permis = $num_permis;
    }
}
?>