-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/10/2024 às 01:21
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
-- Banco de dados: `restaurante`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbatendimento`
--

CREATE TABLE `tbatendimento` (
  `atendimento_id` int(11) NOT NULL,
  `num_mesa` int(11) DEFAULT NULL,
  `codFun` int(11) DEFAULT NULL,
  `data_atendimento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbfuncionarios`
--

CREATE TABLE `tbfuncionarios` (
  `codFun` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `senha` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbfuncionarios`
--

INSERT INTO `tbfuncionarios` (`codFun`, `nome`, `cargo`, `usuario`, `senha`) VALUES
(2, 'Administrador', 'Dono', 'admin', '$2y$10$1kOVxw2PVB5kcxabPHyFweLs0wzqzR6yI8ojZdh0VWrjCuRbzxrxq');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbmesas`
--

CREATE TABLE `tbmesas` (
  `num_mesa` int(11) NOT NULL,
  `solicitado` tinyint(4) DEFAULT NULL,
  `data_solicitado` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbmesas`
--

INSERT INTO `tbmesas` (`num_mesa`, `solicitado`, `data_solicitado`) VALUES
(1, 0, '2024-10-17 22:00:55'),
(2, 0, '2024-10-17 22:02:59'),
(3, 1, '2024-10-22 20:06:21'),
(4, 1, '2024-10-17 22:01:33');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbatendimento`
--
ALTER TABLE `tbatendimento`
  ADD PRIMARY KEY (`atendimento_id`),
  ADD KEY `num_mesa` (`num_mesa`),
  ADD KEY `codFun` (`codFun`);

--
-- Índices de tabela `tbfuncionarios`
--
ALTER TABLE `tbfuncionarios`
  ADD PRIMARY KEY (`codFun`);

--
-- Índices de tabela `tbmesas`
--
ALTER TABLE `tbmesas`
  ADD PRIMARY KEY (`num_mesa`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbatendimento`
--
ALTER TABLE `tbatendimento`
  MODIFY `atendimento_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbfuncionarios`
--
ALTER TABLE `tbfuncionarios`
  MODIFY `codFun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbatendimento`
--
ALTER TABLE `tbatendimento`
  ADD CONSTRAINT `tbatendimento_ibfk_1` FOREIGN KEY (`num_mesa`) REFERENCES `tbmesas` (`num_mesa`),
  ADD CONSTRAINT `tbatendimento_ibfk_2` FOREIGN KEY (`codFun`) REFERENCES `tbfuncionarios` (`codFun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
