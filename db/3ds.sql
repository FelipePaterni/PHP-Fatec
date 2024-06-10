-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 07-Mar-2024 às 11:51
-- Versão do servidor: 5.7.36
-- versão do PHP: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `3ds`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `crud_aluno` (IN `var_id` INT, `var_nome` VARCHAR(50), `var_email` VARCHAR(50), `opcao` INT)   BEGIN
   	IF(EXISTS(SELECT id FROM aluno WHERE id = var_id)) THEN
    	IF(opcao = 1) THEN
        	UPDATE aluno SET nome = var_nome, email = var_email WHERE id = var_id;
        ELSE
        	DELETE FROM aluno WHERE id = var_id;
        END IF;    
    ELSE
    	INSERT INTO aluno VALUES (var_id, var_nome, var_email);
    END IF;
   END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crud_categoria` (IN `var_id` INT, `var_nome` VARCHAR(50), `var_descricao` TEXT, `opcao` INT)   BEGIN
	IF (EXISTS(SELECT id FROM categoria WHERE id = var_id)) THEN
    	IF (opcao = 1) THEN
        	UPDATE categoria SET nome = var_nome, descricao = var_descricao WHERE id = var_id;
        ELSE
        	DELETE FROM categoria WHERE id = var_id;
        END IF;
    ELSE
    	INSERT INTO categoria VALUES (var_id, var_nome, var_descricao);
  	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crud_equipe` (IN `var_id` INT, `var_nome_equipe` VARCHAR(50), `var_nr_membros` INT, `opcao` INT)   BEGIN
   	IF(EXISTS(SELECT id FROM equipe WHERE id = var_id)) THEN
    	IF(opcao = 1) THEN
        	UPDATE equipe SET nome_equipe = var_nome_equipe, nr_membros = var_nr_membros WHERE id = var_id;
        ELSE
        	DELETE FROM equipe WHERE id = var_id;
        END IF;    
    ELSE
    	INSERT INTO equipe VALUES (var_id, var_nome_equipe, var_nr_membros);
    END IF;
   END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_aluno` (IN `var_id` INT)   BEGIN 
      IF(var_id IS NULL) THEN 
        SELECT * FROM aluno ORDER BY nome; 
      ELSE 
        SELECT * FROM aluno where id = var_id;
      END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_categoria` (IN `var_id` INT)   BEGIN
    	IF(var_id IS NULL) THEN
        	SELECT * FROM categoria ORDER BY nome;
        ELSE
        	SELECT * FROM categoria WHERE id = var_id;
        END IF;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_equipe` (IN `var_id` INT)   BEGIN 
      IF(var_id IS NULL) THEN 
        SELECT * FROM equipe ORDER BY nome_equipe; 
      ELSE 
        SELECT * FROM equipe where id = var_id;
      END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id`, `nome`, `email`) VALUES
(1, 'Marcio', 'teste@teste.com'),
(2, 'Jorge', 'teste@itu.com'),
(3, 'Maria', 'itu@teste.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descricao` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `descricao`) VALUES
(1, 'teste', 'teste'),
(2, 'teste b', 'teste do teste'),
(3, 'teste c', 'teste c'),
(4, 'Teste de aula carnaval', 'teste do carnaval'),
(5, 'aula php', 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipe`
--

CREATE TABLE `equipe` (
  `id` int(11) NOT NULL,
  `nome_equipe` varchar(50) DEFAULT NULL,
  `nr_membros` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `equipe`
--

INSERT INTO `equipe` (`id`, `nome_equipe`, `nr_membros`) VALUES
(1, 'Equipe teste A', 0),
(2, 'Equipe Etec', 0),
(3, 'Equipe Fatec', 0),
(4, 'teste', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipe_aluno`
--

CREATE TABLE `equipe_aluno` (
  `fk_equipe_id` int(11) DEFAULT NULL,
  `fk_aluno_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `senha`) VALUES
(1, 'teste@teste.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `equipe_aluno`
--
ALTER TABLE `equipe_aluno`
  ADD KEY `FK_equipe_aluno_1` (`fk_equipe_id`),
  ADD KEY `FK_equipe_aluno_2` (`fk_aluno_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `equipe_aluno`
--
ALTER TABLE `equipe_aluno`
  ADD CONSTRAINT `FK_equipe_aluno_1` FOREIGN KEY (`fk_equipe_id`) REFERENCES `equipe` (`id`),
  ADD CONSTRAINT `FK_equipe_aluno_2` FOREIGN KEY (`fk_aluno_id`) REFERENCES `aluno` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
