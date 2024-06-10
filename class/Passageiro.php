<?php

/*
 CREATE TABLE passageiro (
  id int AUTO_INCREMENT PRIMARY KEY,
  nome varchar(50),
  data_nascimento varchar(10)
  );
  
  DELIMITER && 
  CREATE PROCEDURE crud_passageiro (IN var_id INT, var_nome VARCHAR(50), var_data_nascimento varchar(10), opcao int)
  BEGIN
  IF (EXISTS(SELECT id FROM passageiro WHERE id = var_id)) THEN
  IF (opcao = 1) THEN
  UPDATE passageiro SET nome = var_nome, data_nascimento = var_data_nascimento WHERE id = var_id;
  ELSE
  DELETE FROM passageiro WHERE id = var_id;
  END IF;
  ELSE
  INSERT INTO passageiro VALUES (var_id, var_nome, var_data_nascimento);
  END IF;
  END
  &&
  
DELIMITER &&
	CREATE PROCEDURE listar_passageiro(IN var_id INT)
    BEGIN    	
        IF (var_id IS NULL) THEN
        	SELECT * FROM passageiro ORDER BY nome;
        ELSE
        	SELECT * FROM passageiro WHERE id = var_id;
        END IF;        
    END
&&

 CREATE VIEW view_passageiro AS
  select p.nome,p.data_nascimento,v.data_viagem
  FROM passageiro p
  LEFT JOIN viagem v
  on p.id = v.id_passageiro;

 */

include_once 'Conectar.php';

class Passageiro {

    private $id;
    private $nome;
    private $data_nascimento;
    
    private $con;

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getData_nascimento() {
        return $this->data_nascimento;
    }


    public function setId($id): void {
        $this->id = $id;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setEstoque($data_nascimento): void {
        $this->data_nascimento = $data_nascimento;
    }

 

    public function lista_list($id) {
        try {
            $this->con = new Conectar();
            $sql = "CALL listar_passageiro (?)";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $id);
            return $executar->execute() == 1 ? $executar->fetchAll() : false;
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }
    public function listar() {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM view_passageiro";
            $executar = $this->con->prepare($sql);
            return $executar->execute() == 1 ? $executar->fetchAll() : false;
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }

    

    public function crud($opcao) {
        try {
            $this->con = new Conectar();
            $sql = "CALL crud_passageiro(?, ?, ?, ?)";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, $this->nome);
            $executar->bindValue(3, $this->data_nascimento);
            $executar->bindValue(4, $opcao);
            return $executar->execute() == 1 ? "Procedimento ok" : "Erro";
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }

//fim do crud
}

//fim da class
