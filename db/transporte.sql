-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/06/2024 às 19:18
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `transporte`
--
CREATE DATABASE IF NOT EXISTS `transporte` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `transporte`;

DELIMITER $$
--
-- Procedimentos
--
DROP PROCEDURE IF EXISTS `crud_onibus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `crud_onibus` (IN `var_id` INT, `var_modelo` VARCHAR(90), `var_lugares` INT, `var_destino` VARCHAR(255), `opcao` INT)   BEGIN
  IF (EXISTS(SELECT id FROM onibus WHERE id = var_id)) THEN
  IF (opcao = 1) THEN
  UPDATE onibus SET modelo = var_modelo, lugares = var_lugares, destino = var_destino WHERE id = var_id;
  ELSE
  DELETE FROM onibus WHERE id = var_id;
  END IF;
  ELSE
  INSERT INTO onibus VALUES (var_id, var_modelo, var_lugares, var_destino);
  END IF;
  END$$

DROP PROCEDURE IF EXISTS `crud_passageiro`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `crud_passageiro` (IN `var_id` INT, `var_nome` VARCHAR(50), `var_data_nascimento` VARCHAR(10), `opcao` INT)   BEGIN
  IF (EXISTS(SELECT id FROM passageiro WHERE id = var_id)) THEN
  IF (opcao = 1) THEN
  UPDATE passageiro SET nome = var_nome, data_nascimento = var_data_nascimento WHERE id = var_id;
  ELSE
  DELETE FROM passageiro WHERE id = var_id;
  END IF;
  ELSE
  INSERT INTO passageiro VALUES (var_id, var_nome, var_data_nascimento);
  END IF;
  END$$

DROP PROCEDURE IF EXISTS `crud_viagem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `crud_viagem` (IN `var_id` INT, `var_id_onibus` INT, `var_id_passageiro` INT, `var_data_viagem` VARCHAR(10), `opcao` INT)   BEGIN
  IF (EXISTS(SELECT id FROM viagem WHERE id = var_id)) THEN
  IF (opcao = 1) THEN
  UPDATE viagem SET id_onibus = var_id_onibus, id_onibus = var_id_passageiro, data_viagem = var_data_viagem WHERE id = var_id;
  ELSE
  DELETE FROM viagem WHERE id = var_id;
  END IF;
  ELSE
  INSERT INTO viagem VALUES (var_id, var_id_onibus, var_id_passageiro, var_data_viagem);
  END IF;
  END$$

DROP PROCEDURE IF EXISTS `listar_onibus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_onibus` (IN `var_id` INT)   BEGIN    	
        IF (var_id IS NULL) THEN
        	SELECT * FROM onibus ORDER BY modelo;
        ELSE
        	SELECT * FROM onibus WHERE id = var_id;
        END IF;        
    END$$

DROP PROCEDURE IF EXISTS `listar_passageiro`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_passageiro` (IN `var_id` INT)   BEGIN    	
        IF (var_id IS NULL) THEN
        	SELECT * FROM passageiro ORDER BY nome;
        ELSE
        	SELECT * FROM passageiro WHERE id = var_id;
        END IF;        
    END$$

DROP PROCEDURE IF EXISTS `listar_viagem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_viagem` (IN `var_id` INT)   BEGIN    	
        IF (var_id IS NULL) THEN
        	SELECT * FROM viagem ORDER BY id;
        ELSE
        	SELECT * FROM viagem WHERE id = var_id;
        END IF;        
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `onibus`
--

DROP TABLE IF EXISTS `onibus`;
CREATE TABLE `onibus` (
  `id` int(11) NOT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `lugares` int(11) DEFAULT NULL,
  `destino` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `passageiro`
--

DROP TABLE IF EXISTS `passageiro`;
CREATE TABLE `passageiro` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `data_nascimento` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `viagem`
--

DROP TABLE IF EXISTS `viagem`;
CREATE TABLE `viagem` (
  `id` int(11) NOT NULL,
  `id_onibus` int(11) DEFAULT NULL,
  `id_passageiro` int(11) DEFAULT NULL,
  `data_viagem` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Acionadores `viagem`
--
DROP TRIGGER IF EXISTS `T_Delete`;
DELIMITER $$
CREATE TRIGGER `T_Delete` AFTER DELETE ON `viagem` FOR EACH ROW BEGIN
    UPDATE onibus o 
    SET o.lugares = o.lugares + 1 
    WHERE o.id = OLD.id_onibus;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `T_Insert`;
DELIMITER $$
CREATE TRIGGER `T_Insert` AFTER INSERT ON `viagem` FOR EACH ROW BEGIN
    UPDATE onibus o 
    SET o.lugares = o.lugares - 1 
    WHERE o.id = NEW.id_onibus;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_onibus`
-- (Veja abaixo para a visão atual)
--
DROP VIEW IF EXISTS `view_onibus`;
CREATE TABLE `view_onibus` (
`id` int(11)
,`modelo` varchar(100)
,`lugares` int(11)
,`destino` varchar(255)
,`data_viagem` varchar(10)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_passageiro`
-- (Veja abaixo para a visão atual)
--
DROP VIEW IF EXISTS `view_passageiro`;
CREATE TABLE `view_passageiro` (
`id` int(11)
,`nome` varchar(100)
,`data_nascimento` varchar(10)
,`data_viagem` varchar(10)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_viagem`
-- (Veja abaixo para a visão atual)
--
DROP VIEW IF EXISTS `view_viagem`;
CREATE TABLE `view_viagem` (
`id` int(11)
,`nome` varchar(100)
,`modelo` varchar(100)
,`destino` varchar(255)
,`data_viagem` varchar(10)
);

-- --------------------------------------------------------

--
-- Estrutura para view `view_onibus`
--
DROP TABLE IF EXISTS `view_onibus`;

DROP VIEW IF EXISTS `view_onibus`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_onibus`  AS SELECT `o`.`id` AS `id`, `o`.`modelo` AS `modelo`, `o`.`lugares` AS `lugares`, `o`.`destino` AS `destino`, `v`.`data_viagem` AS `data_viagem` FROM (`onibus` `o` left join `viagem` `v` on(`o`.`id` = `v`.`id_onibus`)) ;

-- --------------------------------------------------------

--
-- Estrutura para view `view_passageiro`
--
DROP TABLE IF EXISTS `view_passageiro`;

DROP VIEW IF EXISTS `view_passageiro`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_passageiro`  AS SELECT `p`.`id` AS `id`, `p`.`nome` AS `nome`, `p`.`data_nascimento` AS `data_nascimento`, `v`.`data_viagem` AS `data_viagem` FROM (`passageiro` `p` left join `viagem` `v` on(`p`.`id` = `v`.`id_passageiro`)) ;

-- --------------------------------------------------------

--
-- Estrutura para view `view_viagem`
--
DROP TABLE IF EXISTS `view_viagem`;

DROP VIEW IF EXISTS `view_viagem`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_viagem`  AS SELECT `v`.`id` AS `id`, `p`.`nome` AS `nome`, `o`.`modelo` AS `modelo`, `o`.`destino` AS `destino`, `v`.`data_viagem` AS `data_viagem` FROM ((`viagem` `v` join `passageiro` `p` on(`p`.`id` = `v`.`id_passageiro`)) join `onibus` `o` on(`o`.`id` = `v`.`id_onibus`)) ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `onibus`
--
ALTER TABLE `onibus`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `passageiro`
--
ALTER TABLE `passageiro`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `viagem`
--
ALTER TABLE `viagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_onibus` (`id_onibus`),
  ADD KEY `id_passageiro` (`id_passageiro`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `onibus`
--
ALTER TABLE `onibus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `passageiro`
--
ALTER TABLE `passageiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `viagem`
--
ALTER TABLE `viagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `viagem`
--
ALTER TABLE `viagem`
  ADD CONSTRAINT `viagem_ibfk_1` FOREIGN KEY (`id_onibus`) REFERENCES `onibus` (`id`),
  ADD CONSTRAINT `viagem_ibfk_2` FOREIGN KEY (`id_passageiro`) REFERENCES `passageiro` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
