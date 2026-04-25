-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 01/04/2026 às 18:59
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
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int NOT NULL,
  `nome_produto` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `imagem_url` varchar(255) DEFAULT NULL
) ;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome_produto`, `preco`, `categoria`, `imagem_url`) VALUES
(1, 'Cerveja Itaipava 600ml', 7.50, 'Fermentadas', 'img/itaipava.jpg'),
(2, 'Vinho Tinto Malbec 750ml', 59.90, 'Fermentadas', 'img/vinho.webp'),
(3, 'Sidra Cereser 660ml', 15.00, 'Fermentadas', 'img/cereser.jpg'),
(4, 'Cerveja Artesanal Baden 600ml', 22.00, 'Fermentadas', 'img/baden.png'),
(5, 'Cerveja Pilsen Lata 350ml', 5.50, 'Fermentadas', 'img/pilsen.webp'),
(6, 'Vinho Tinto Bordô Suave Góes 750ml', 29.90, 'Fermentadas', 'img/goes.jpg'),
(7, 'Casillero Del Diablo Cabernet Sauvignon 750ml', 38.00, 'Fermentadas', 'img/concha.jpg'),
(8, 'Cerveja Corona 330ml', 6.79, 'Fermentadas', 'img/corona.webp'),
(9, 'Vinho Tinto Suave Pérgola 1L', 23.07, 'Fermentadas', 'img/pergola.jpg'),
(10, 'Sidra Bfiver 750ml', 96.00, 'Fermentadas', 'img/bfiver.webp'),
(11, 'Vinho Tinto Gato Negro Cabernet Sauvignon 750 Ml', 41.21, 'Fermentadas', 'img/gato.webp'),
(12, 'Cerveja Heineken Long Neck 330ml', 6.49, 'Fermentadas', 'img/heineken.webp'),
(13, 'Cerveja Spaten 600ml', 8.90, 'Fermentadas', 'img/spaten.webp'),
(14, 'Vinho Rosé Piscine 750ml', 95.00, 'Fermentadas', 'img/rose.webp'),
(15, 'Espumante Chandon Passion 750ml', 89.90, 'Fermentadas', 'img/chandon.jpg'),
(16, 'Cerveja Skol 600ml', 7.90, 'Fermentadas', 'img/skol.jpg'),
(17, 'Cerveja Brahma 600ml', 7.50, 'Fermentadas', 'img/brahma.jpg'),
(18, 'Vinho Goes Tinto Suave 750ml', 29.90, 'Fermentadas', 'img/goest.webp'),
(19, 'Espumante Veuve Clicquot 750ml', 120.00, 'Fermentadas', 'img/veuve.jpg'),
(20, 'Cerveja Antarctica 600ml', 7.50, 'Fermentadas', 'img/antarctica.jpg'),
(21, 'Cachaça Prata Seleta 1L', 25.00, 'Destiladas', 'img/cachaca.webp'),
(22, 'Whisky Ballantines Finest 8 anos 1 Litro', 89.90, 'Destiladas', 'img/whisky.webp'),
(23, 'Gin Tônica Ready-to-Drink 269ml', 18.00, 'Destiladas', 'img/gint.avif'),
(24, 'Tequila Jose Cuervo Ouro 750ml', 120.00, 'Destiladas', 'img/tequilao.webp'),
(25, 'Vodka Smirnoff 1L', 65.00, 'Destiladas', 'img/vodkas.webp'),
(26, 'Rum Bacardi', 55.00, 'Destiladas', 'img/rum.jpg'),
(27, 'White Horse Whisky 1L', 69.90, 'Destiladas', 'img/white.webp'),
(28, 'Absolut Vodka 750Ml', 72.90, 'Destiladas', 'img/absolut.jpg'),
(29, 'Gin Tanqueray London Dry, 750ml', 99.97, 'Destiladas', 'img/london.png'),
(30, 'Vodka Natasha 900ml', 21.99, 'Destiladas', 'img/natasha.webp'),
(31, 'Cachaça Velho Barreiro 910ml', 14.99, 'Destiladas', 'img/velho.webp'),
(32, 'Whisky Johnnie Walker Black Label 1L', 159.90, 'Destiladas', 'img/johnnie.webp'),
(33, 'Gin Bombay Sapphire 750ml', 105.00, 'Destiladas', 'img/bombay.jpg'),
(34, 'Cachaça Cabaré Extra Premium 700ml', 180.00, 'Destiladas', 'img/cabare.webp'),
(35, 'Vodka Grey Goose 750ml', 135.00, 'Destiladas', 'img/grey.webp'),
(36, 'Rum Havana Club Añejo 7 Años 750ml', 120.00, 'Destiladas', 'img/havana.avif'),
(37, 'Whisky Chivas Regal 12 Anos 1L', 149.90, 'Destiladas', 'img/chivas.jpg'),
(38, 'Gin Hendrick\'s 750ml', 110.00, 'Destiladas', 'img/ginh.webp'),
(39, 'Cachaça Ypióca Ouro 1L', 28.00, 'Destiladas', 'img/ypioca.webp'),
(40, 'Vodka Absolut Elyx 750ml', 150.00, 'Destiladas', 'img/elyx.jpg'),
(41, 'Licor 43 Chocolate 700ml', 45.00, 'Licorosas', 'img/licor.webp'),
(42, 'Vermute Tinto Martini 750ml', 32.50, 'Licorosas', 'img/vermute.jpg'),
(43, 'Aperitivo Amargo Campari 900ml', 55.00, 'Licorosas', 'img/aperitivo.webp'),
(44, 'Licor de Café e Creme Sheridan\'s 700ml', 160.00, 'Licorosas', 'img/cafe.webp'),
(45, 'Ballena Licor Morango com Tequila 750ml', 115.71, 'Licorosas', 'img/ballena.jpg'),
(46, 'Aperitivo Aperol 750ml', 59.90, 'Licorosas', 'img/aperol.jpg'),
(47, 'Amarula Licor 750ml', 65.00, 'Licorosas', 'img/amarula.jpg'),
(48, 'Licor de Chocolate Stock 720ml', 42.70, 'Licorosas', 'img/stock.webp'),
(49, 'Aperitivo De Ervas Schluck 750ml', 99.90, 'Licorosas', 'img/ervas.avif'),
(50, 'Vermute Dry Schluck 700ml', 95.00, 'Licorosas', 'img/vermuted.webp'),
(51, 'Licor Tia Maria 700ml', 144.90, 'Licorosas', 'img/maria.webp'),
(52, 'Licor Cointreau 700ml', 125.00, 'Licorosas', 'img/licorc.webp'),
(53, 'Licor Amarula Raspberry 750ml', 54.90, 'Licorosas', 'img/amarulac.webp'),
(54, 'Licor de Doce de Leite Don Luiz 750ml', 89.00, 'Licorosas', 'img/don.webp'),
(55, 'Vinho do Porto Ferreira Tawny 750ml', 79.90, 'Licorosas', 'img/ferreira.jpg'),
(56, 'Licor de Maracujá Casa Petro - 500ml', 120.00, 'Licorosas', 'img/maracuja.jpg'),
(57, 'Licor de Amêndoas Amaretto Disaronno 750ml', 110.00, 'Licorosas', 'img/disa.webp'),
(58, 'Licor de Chocolate e Café Kahlúa 750ml', 130.00, 'Licorosas', 'img/cafel.webp'),
(59, 'Licor de Frutas Vermelhas Smirnoff 700ml', 105.00, 'Licorosas', 'img/frutas.jpg'),
(60, 'Licor de Laranja e Gin Tanqueray 750ml', 105.00, 'Licorosas', 'img/laranja.jpg'),
(61, 'Red Bull Energy Drink 250ml', 12.00, 'Não Alcoólicas', 'img/redbull.webp'),
(62, 'Suco Natural Laranja 1,5L', 10.00, 'Não Alcoólicas', 'img/suco.webp'),
(63, 'Água Mineral com Gás Crystal 500ml', 3.50, 'Não Alcoólicas', 'img/agua.webp'),
(64, 'Gatorade Isotônico 500ml', 5.90, 'Não Alcoólicas', 'img/gatorade.webp'),
(65, 'Energético Zero Monster 473ml', 8.99, 'Não Alcoólicas', 'img/monsterzero.webp'),
(66, 'Isotônico Powerade 500ml', 4.30, 'Não Alcoólicas', 'img/poweradetropicais.webp'),
(67, 'Del Valle Suco Uva 1L', 11.50, 'Não Alcoólicas', 'img/delvalleuva.webp'),
(68, 'Energético Baly Melancia', 6.00, 'Não Alcoólicas', 'img/energeticobalymelancia.webp'),
(69, 'Ducoco Água de Coco 200ml', 2.65, 'Não Alcoólicas', 'img/ducocoaguacoco.webp'),
(70, 'Água Mineral Sem Gás Minalba 510ml', 2.19, 'Não Alcoólicas', 'img/minalbanatural.webp'),
(71, 'Energético Reign Melon 473ml', 8.95, 'Não Alcoólicas', 'img/reignmelon.webp'),
(72, 'Refrigerante Coca-Cola Original 2L', 9.50, 'Não Alcoólicas', 'img/cocacola.png'),
(73, 'Água de Coco Obrigado 1L', 12.90, 'Não Alcoólicas', 'img/aguacocoobrigado.webp'),
(74, 'H2OH! Limão 500ml', 4.50, 'Não Alcoólicas', 'img/h2olimao.webp'),
(75, 'Suco Prats Laranja 900ml', 14.00, 'Não Alcoólicas', 'img/pratslaranja.webp'),
(76, 'Energético Monster Ultra 473ml', 9.99, 'Não Alcoólicas', 'img/monsterultra.jpg'),
(77, 'Isotônico Gatorade Laranja 500ml', 5.50, 'Não Alcoólicas', 'img/gatoradelaranja.webp'),
(78, 'Água Mineral com Gás Perrier 750ml', 7.90, 'Não Alcoólicas', 'img/perrieragua.webp'),
(79, 'Ice Tea Leão, Limão 500ml', 12.00, 'Não Alcoólicas', 'img/chagelado.webp'),
(80, 'Nescau 270g', 10.00, 'Não Alcoólicas', 'img/nescau.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
