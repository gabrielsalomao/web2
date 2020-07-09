-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Jul-2020 às 23:56
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
-- Banco de dados: `commando`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comanda`
--

CREATE TABLE `comanda` (
  `id` int(11) NOT NULL,
  `observacao` text DEFAULT NULL,
  `usuarioId` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Novo',
  `mesa` int(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `comanda`
--

INSERT INTO `comanda` (`id`, `observacao`, `usuarioId`, `status`, `mesa`) VALUES
(57, 'Sem açúcar no suco de laranja', 4, 'Novo', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comanda_item`
--

CREATE TABLE `comanda_item` (
  `comandaId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `qnt` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `comanda_item`
--

INSERT INTO `comanda_item` (`comandaId`, `itemId`, `qnt`) VALUES
(57, 48, 1),
(57, 49, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `observacao` text NOT NULL,
  `preco` decimal(10,0) NOT NULL,
  `imagem` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`id`, `nome`, `observacao`, `preco`, `imagem`) VALUES
(48, 'Pastel de carne', '', '55', 'Imagens/1594215894pastel-de-feira-1024x768.jpg'),
(49, 'Suco de laranja', 'Laranjas acabando', '7', 'Imagens/1594215916suco-fruta-acucar-risco-morte-768x512-f107f9a0.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `tipo`) VALUES
(4, 'Admin', 'admin@admin', '@Senha01', 'Admin'),
(7, 'Gabriel', 'gabriel@gabriel', '@Senha01', 'Funcionário');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comanda`
--
ALTER TABLE `comanda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarioId_fk` (`usuarioId`);

--
-- Índices para tabela `comanda_item`
--
ALTER TABLE `comanda_item`
  ADD KEY `comandaId_fk` (`comandaId`),
  ADD KEY `itemId_fk` (`itemId`);

--
-- Índices para tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comanda`
--
ALTER TABLE `comanda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de tabela `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comanda`
--
ALTER TABLE `comanda`
  ADD CONSTRAINT `fk_professor_curso` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `comanda_item`
--
ALTER TABLE `comanda_item`
  ADD CONSTRAINT `comandaId_fk` FOREIGN KEY (`comandaId`) REFERENCES `comanda` (`id`),
  ADD CONSTRAINT `itemId_fk` FOREIGN KEY (`itemId`) REFERENCES `item` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
