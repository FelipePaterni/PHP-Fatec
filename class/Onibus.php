<?php

/*
 * CREATE TABLE onibus (
  id int AUTO_INCREMENT PRIMARY KEY,
  modelo varchar(90),
  lugares int, 
  destino varchar(255)
  );
 
 DELIMITER && 
  CREATE PROCEDURE crud_onibus (IN var_id INT, var_modelo VARCHAR(90), var_lugares int, var_destino varchar(255), opcao int)
  BEGIN
  IF (EXISTS(SELECT id FROM onibus WHERE id = var_id)) THEN
  IF (opcao = 1) THEN
  UPDATE onibus SET modelo = var_modelo, lugares = var_lugares, destino = var_destino WHERE id = var_id;
  ELSE
  DELETE FROM onibus WHERE id = var_id;
  END IF;
  ELSE
  INSERT INTO onibus VALUES (var_id, var_modelo, var_lugares, var_destino);
  END IF;
  END
  &&

  
DELIMITER &&

	CREATE PROCEDURE listar_onibus(IN var_id INT)
    BEGIN    	
        IF (var_id IS NULL) THEN
        	SELECT * FROM onibus ORDER BY modelo;
        ELSE
        	SELECT * FROM onibus WHERE id = var_id;
        END IF;        
    END
&&

  CREATE VIEW view_onibus AS
  select o.id, o.modelo ,o.lugares, o.destino,v.data_viagem
  FROM onibus o
  LEFT JOIN viagem v
  on o.id = v.id_onibus;
  
 */

include_once 'Conectar.php';
class Onibus
{

    private $id;
    private $modelo;
    private $lugares;
    private $destino;

    private $con;

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function getLugares()
    {
        return $this->lugares;
    }

    public function getDestino()
    {
        return $this->destino;
    }

    // Setters
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setModelo($modelo): void
    {
        $this->modelo = $modelo;
    }

    public function setLugares($lugares): void
    {
        $this->lugares = $lugares;
    }

    public function setDestino($destino): void
    {
        $this->destino = $destino;
    }


    public function lista_list($id)
    {
        try {
            $this->con = new Conectar();
            $sql = "CALL listar_onibus (?)";
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
            $sql = "SELECT * FROM view_onibus";
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
            $sql = "CALL crud_onibus(?, ?, ?, ?, ?)";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, $this->modelo);
            $executar->bindValue(3, $this->lugares);
            $executar->bindValue(4, $this->destino);
            $executar->bindValue(5, $opcao);
            return $executar->execute() == 1 ? "Procedimento ok" : "Erro";
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }

    //fim do crud
}

//fim da class
