<?php

include_once 'Conectar.php';

class EquipeAluno {

    private $id;
    private $id_equipe;
    private $id_aluno;
    private $con;

    public function getId() {
        return $this->id;
    }

    public function getId_equipe() {
        return $this->id_equipe;
    }

    public function getId_aluno() {
        return $this->id_aluno;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setId_equipe($id_equipe): void {
        $this->id_equipe = $id_equipe;
    }

    public function setId_aluno($id_aluno): void {
        $this->id_aluno = $id_aluno;
    }

  

    public function listar($id) {
        try {
            $this->con = new Conectar();
            //$sql = "CALL listar_categoria (?)";
            $sql = "SELECT * FROM view_equipealuno;";
            $executar = $this->con->prepare($sql);
            //$executar->bindValue(1, $id);
            return $executar->execute() == 1 ? $executar->fetchAll() : false;
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }

//fim do crud
}

//fim da class
