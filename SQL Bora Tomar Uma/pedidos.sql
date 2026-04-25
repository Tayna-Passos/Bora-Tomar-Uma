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
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int NOT NULL,
  `itens` text NOT NULL,
  `endereco` text NOT NULL,
  `observacoes` text,
  `gorjeta` decimal(10,2) DEFAULT NULL,
  `pagamento` varchar(50) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `troco_para` decimal(10,2) DEFAULT NULL,
  `data_pedido` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `itens`, `endereco`, `observacoes`, `gorjeta`, `pagamento`, `total`, `troco_para`, `data_pedido`) VALUES
(1, '[{\"id\":1,\"name\":\"Cerveja Itaipava\",\"price\":7.5,\"img\":\".\\/img\\/itaipava.jpg\",\"categoryKey\":\"mais-vendidos\",\"qty\":1}]', 'Travessa Carnauba n78', 'casa 02', 20.00, 'credito', 27.50, NULL, '2026-03-28 23:01:25'),
(2, '[{\"id\":1,\"name\":\"Cerveja Itaipava\",\"price\":7.5,\"img\":\".\\/img\\/itaipava.jpg\",\"categoryKey\":\"mais-vendidos\",\"qty\":1}]', 'travessa carnauba n18', 'casa 02', 10.00, 'credito', 17.50, NULL, '2026-03-29 01:11:38'),
(3, '[{\"id\":2,\"name\":\"Vinho Tinto Malbec\",\"price\":59.9,\"img\":\".\\/img\\/vinho.webp\",\"categoryKey\":\"mais-vendidos\",\"qty\":1}]', 'travessa carnauba n78', 'casa 02', 20.00, 'pix', 79.90, NULL, '2026-03-29 01:42:13'),
(4, '[{\"id\":3,\"name\":\"Vodka Smirnoff\",\"price\":65,\"img\":\".\\/img\\/vodkas.webp\",\"categoryKey\":\"mais-vendidos\",\"qty\":1}]', 'caranda n55', 'casa 03', 500.00, 'dinheiro', 565.00, NULL, '2026-03-29 01:46:23'),
(5, '[{\"id\":3,\"name\":\"Vodka Smirnoff\",\"price\":65,\"img\":\".\\/img\\/vodkas.webp\",\"categoryKey\":\"mais-vendidos\",\"qty\":1}]', 'caranda n55', 'casa 03', 500.00, 'dinheiro', 565.00, NULL, '2026-03-29 01:48:11'),
(6, '[{\"id\":3,\"name\":\"Vodka Smirnoff\",\"price\":65,\"img\":\".\\/img\\/vodkas.webp\",\"categoryKey\":\"mais-vendidos\",\"qty\":1}]', 'caranda n55', 'casa 03', 500.00, 'dinheiro', 565.00, NULL, '2026-03-29 01:49:03'),
(7, '[{\"id\":3,\"name\":\"Vodka Smirnoff\",\"price\":65,\"img\":\".\\/img\\/vodkas.webp\",\"categoryKey\":\"mais-vendidos\",\"qty\":1}]', 'caranda n55', 'casa 03', 500.00, 'dinheiro', 565.00, NULL, '2026-03-29 01:49:45'),
(8, '[{\"id\":4,\"name\":\"Energético Red Bull\",\"price\":12,\"img\":\".\\/img\\/redbull.webp\",\"categoryKey\":\"mais-vendidos\",\"qty\":1}]', 'avenida', '55', 66.66, 'dinheiro', 78.66, 55.55, '2026-03-29 02:07:14'),
(9, '[{\"name\":\"Suco Natural Laranja 1,5L\",\"price\":10,\"img\":\"img\\/suco.webp\",\"id\":161,\"categoryKey\":\"nao-alcoolicas\",\"qty\":1}]', 'brasilia 88', 'avenida', 9.99, 'dinheiro', 19.99, 70.00, '2026-03-29 02:13:41'),
(10, '[{\"name\":\"Suco Natural Laranja 1,5L\",\"price\":10,\"img\":\"img\\/suco.webp\",\"id\":161,\"categoryKey\":\"nao-alcoolicas\",\"qty\":1}]', 'brasilia 88', 'avenida', 9.99, 'dinheiro', 19.99, 70.00, '2026-03-29 02:14:19'),
(11, '[{\"id\":6,\"name\":\"Whisky Ballantines Finest\",\"price\":89.9,\"img\":\".\\/img\\/whisky.webp\",\"categoryKey\":\"mais-vendidos\",\"qty\":1}]', 'uiiiiii', 'kkkkkkkkkkkk', 0.00, 'pix', 89.90, NULL, '2026-03-29 02:24:10');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
