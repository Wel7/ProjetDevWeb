<?php
class Infraction {
    private int $id_inf;
    private string $date_inf;
    private string $num_immat;
    private string $num_permis;

    public function __construct($id_inf=0, $date_inf='', $num_immat='', $num_permis='') {
        $this->id_inf = $id_inf;
        $this->date_inf = $date_inf;
        $this->num_immat = $num_immat;
        $this->num_permis = $num_permis;
    }

    public function getIdInf(): int {
        return $this->id_inf;
    }

    public function getDateInf(): string {
        return $this->date_inf;
    }

    public function getNumImmat(): string {
        return $this->num_immat;
    }

    public function getNumPermis(): string {
        return $this->num_permis;
    }

    public function setIdInf(int $id_inf) {
        $this->id_inf = $id_inf;
    }

    public function setDateInf(string $date_inf) {
        $this->date_inf = $date_inf;
    }

    public function setNumImmat(string $num_immat) {
        $this->num_immat = $num_immat;
    }

    public function setNumPermis(string $num_permis) {
        $this->num_permis = $num_permis;
    }
}
?>