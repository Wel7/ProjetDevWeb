<?php
class Delit {
    private int $id_delit;
    private string $nature;
    private float $tarif;


    

    public function __construct($id_delit=0, $nature='', $tarif=0.) {

        $this->id_delit = $id_delit;
        $this->nature = $nature;
        $this->tarif = $tarif;
    }

    //Définition des Getters et Setters
    public function getIdDelit(): int {
        return $this->id_delit;
    }

    public function getNature(): string {
        return $this->nature;
    }

    public function getTarif(): float {
        return $this->tarif;
    }

    public function setIdDelit(int $id_delit) {
        $this->id_delit = $id_delit;
    }

    public function setNature(string $nature) {
        $this->nature = $nature;
    }

    public function setTarif(float $tarif) {
        $this->tarif = $tarif;
    }
}
?>