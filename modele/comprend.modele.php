<?php
class Comprend {
    private int $id_inf;
    private int $id_delit;

    public function __construct($id_inf, $id_delit) {
        $this->id_inf = $id_inf;
        $this->id_delit = $id_delit;
    }

    public function getIdInf(): int {
        return $this->id_inf;
    }

    public function getIdDelit(): int {
        return $this->id_delit;
    }
}

?>