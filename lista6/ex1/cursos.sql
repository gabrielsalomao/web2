-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Jun-2020 às 23:34
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cursos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sexo` char(1) NOT NULL,
  `data_nascimento` date NOT NULL,
  `registro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id`, `nome`, `sexo`, `data_nascimento`, `registro`) VALUES
(1, 'Gabriel', 'M', '2001-03-31', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `professor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id`, `nome`, `professor`) VALUES
(1, 'Lógica em programação', 1),
(2, 'Desenvolvimento Web', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso_aluno`
--

CREATE TABLE `curso_aluno` (
  `curso` int(11) NOT NULL,
  `aluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `curso_aluno`
--

INSERT INTO `curso_aluno` (`curso`, `aluno`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `registro` int(11) NOT NULL,
  `titulacao` varchar(50) NOT NULL,
  `sexo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`id`, `nome`, `registro`, `titulacao`, `sexo`) VALUES
(1, 'Gabriel', 1213123, 'Doutor', 'M');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_professor_curso` (`professor`);

--
-- Índices para tabela `curso_aluno`
--
ALTER TABLE `curso_aluno`
  ADD KEY `fk_curso_curso_aluno` (`curso`),
  ADD KEY `fk_aluno_curso_aluno` (`aluno`);

--
-- Índices para tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_professor_curso` FOREIGN KEY (`professor`) REFERENCES `professor` (`id`);

--
-- Limitadores para a tabela `curso_aluno`
--
ALTER TABLE `curso_aluno`
  ADD CONSTRAINT `fk_aluno_curso_aluno` FOREIGN KEY (`aluno`) REFERENCES `aluno` (`id`),
  ADD CONSTRAINT `fk_curso_curso_aluno` FOREIGN KEY (`curso`) REFERENCES `curso` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
