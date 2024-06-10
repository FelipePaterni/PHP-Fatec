<?php

/*
  CREATE TABLE viagem (
  id int AUTO_INCREMENT PRIMARY KEY,
  id_onibus int,
  FOREIGN KEY (id_onibus) REFERENCES onibus (id),
  id_passageiro int,
  FOREIGN KEY (id_passageiro) REFERENCES passageiro (id),
  data_viagem varchar(10)
  );
 
  DELIMITER && 
  CREATE PROCEDURE crud_viagem(IN var_id INT,var_id_onibus int,var_id_passageiro int, var_data_viagem varchar(10),opcao int)
  BEGIN
  IF (EXISTS(SELECT id FROM viagem WHERE id = var_id)) THEN
  IF (opcao = 1) THEN
  UPDATE viagem SET id_onibus = var_id_onibus, id_onibus = var_id_passageiro, data_viagem = var_data_viagem WHERE id = var_id;
  ELSE
  DELETE FROM viagem WHERE id = var_id;
  END IF;
  ELSE
  INSERT INTO viagem VALUES (var_id, var_id_onibus, var_id_passageiro, var_data_viagem);
  END IF;
  END
  &&

  
DELIMITER &&
	CREATE PROCEDURE listar_viagem(IN var_id INT)
    BEGIN    	
        IF (var_id IS NULL) THEN
        	SELECT * FROM viagem ORDER BY id;
        ELSE
        	SELECT * FROM viagem WHERE id = var_id;
        END IF;        
    END
&&

 CREATE VIEW view_viagem AS
  select p.nome, o.modelo , o.destino,v.data_viagem
  FROM viagem v
  INNER JOIN passageiro p
  on p.id = v.id_passageiro
  INNER JOIN onibus o
  on o.id = v.id_onibus;
 */

include_once 'Conectar.php';
class Viagem
{

    private $id;
    private $id_onibus;
    private $id_passageiro;
    private $data_viagem;

    private $con;

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getId_onibus()
    {
        return $this->id_onibus;
    }

    public function getId_passageiro()
    {
        return $this->id_passageiro;
    }

    public function getData_viagem()
    {
        return $this->data_viagem;
    }

    // Setters
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setId_onibus($id_onibus): void
    {
        $this->id_onibus = $id_onibus;
    }

    public function setId_passageiro($id_passageiro): void
    {
        $this->id_passageiro = $id_passageiro;
    }

    public function setData_viagem($data_viagem): void
    {
        $this->data_viagem = $data_viagem;
    }



    public function lista_list($id)
    {
        try {
            $this->con = new Conectar();
            $sql = "CALL listar_viagem (?)";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $id);
            return $executar->execute() == 1 ? $executar->fetchAll() : false;
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }
    public function listar()
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM view_viagem";
            $executar = $this->con->prepare($sql);
            return $executar->execute() == 1 ? $executar->fetchAll() : false;
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }

    public function crud($opcao)
    {
        try {
            $this->con = new Conectar();
            $sql = "CALL crud_viagem(?, ?, ?, ?, ?)";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, $this->id_onibus);
            $executar->bindValue(3, $this->id_passageiro);
            $executar->bindValue(4, $this->data_viagem);
            $executar->bindValue(5, $opcao);
            return $executar->execute() == 1 ? "Procedimento ok" : "Erro";
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }

    //fim do crud
}

//fim da class
