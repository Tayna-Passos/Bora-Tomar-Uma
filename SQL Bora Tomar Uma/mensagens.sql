-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 01/04/2026 às 18:58
-- Versão do servidor: 8.0.45
-- Versão do PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `app_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `assunto` varchar(200) DEFAULT NULL,
  `mensagem` text NOT NULL,
  `data_envio` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `mensagens`
--

INSERT INTO `mensagens` (`id`, `nome`, `email`, `assunto`, `mensagem`, `data_envio`) VALUES
(1, 'Tayná', 'taynacosta@uni9.edu.br', 'dolly', 'kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', '2026-03-25 12:05:21'),
(2, 'TAYNÁ CRISTINA PASSOS DA COSTA', 'taynacosta@uni9.edu.br', 'bjbknknhhkkjl', 'mmmmmmmmmmmmmmmmmmmmmmmmm', '2026-03-25 12:07:09'),
(3, 'samara', 'taynacosta@uni9.edu.br', 'paparazita', 'babbabbabba', '2026-03-25 12:12:55'),
(4, 'dudaaaaaaaaa', 'tayna.cristina215@gmail.com', 'paparapa', 'vai funcionar', '2026-03-25 13:20:18'),
(5, 'TAYNÁ CRISTINA PASSOS DA COSTA', 'taynacosta@uni9.edu.br', 'dolly', 'llllllllllllllllllllllllllllllllll', '2026-03-26 14:34:06'),
(6, 'samara', 'taynacosta@uni9.edu.br', 'paparapa', 'çççççççççççççç', '2026-03-27 20:24:49');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
