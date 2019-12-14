-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 14-Dez-2019 às 04:14
-- Versão do servidor: 5.7.24
-- versão do PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loja`
--
CREATE DATABASE IF NOT EXISTS `loja` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `loja`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`) VALUES
(1, 'LIMPEZA'),
(2, 'PADARIA'),
(3, 'BEBIDAS'),
(4, 'FRUTAS'),
(5, 'CARRO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `foto`
--

DROP TABLE IF EXISTS `foto`;
CREATE TABLE IF NOT EXISTS `foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) DEFAULT NULL,
  `foto` varchar(120) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produto` (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `foto`
--

INSERT INTO `foto` (`id`, `id_produto`, `foto`) VALUES
(4, 5, 'img/5/4.jpg'),
(5, 5, 'img/5/lol.png'),
(6, 5, 'img/5/verde.jpg'),
(7, 40, 'img/40/12382-0.jpg.jpg'),
(8, 32, 'img/32/1960977582570e657ec2bbd5.74439504.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` longtext,
  `valor` decimal(10,2) DEFAULT NULL,
  `fabricante` varchar(100) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `descricao`, `valor`, `fabricante`, `id_categoria`) VALUES
(5, 'DETERGENTE', 'um', '1.99', 'ypÃ©', 1),
(6, 'BOMBRIL', 'unidade', '1.00', 'bombril', 1),
(7, 'PANO', 'de lÃ£ de ovelha negra', '58.00', 'aakjsa', 1),
(8, 'RODO', 'MADEIRA', '12.00', 'A', 1),
(9, 'VASSOURA', 'MADEIRA', '12.00', 'A', 1),
(10, 'SABÃO LÍQUIDO', '2 LITROS', '12.00', 'ALOE VERA', 1),
(11, 'SABÃO EM PEDRA', '6unid.', '12.00', 'ALOE VERA', 1),
(12, 'ÓLEO DE PEROBA', '350ml', '12.00', 'ALOE VERA', 1),
(13, 'ÁGUA SANITÁRIA', '5L', '12.00', 'ALOE VERA', 1),
(14, 'AMACIANTE', '2L', '12.00', 'ALOE VERA', 1),
(15, 'SONHO', 'Unid', '3.99', 'A', 2),
(16, 'PASTEL', 'Unid', '4.95', 'A', 2),
(17, 'CAROLINA', 'Kg', '35.50', 'A', 2),
(18, 'PUDIM', 'Kg', '12.56', 'A', 2),
(19, 'BOLO', 'Kg', '47.80', 'A', 2),
(20, 'TORTA', 'Unid', '18.99', 'A', 2),
(21, 'CROISSAINT', 'Uni', '1.99', 'A', 2),
(22, 'ROCAMBOLE', 'Unid', '5.99', 'A', 2),
(23, 'PÃO DE CARA', 'Kg', '7.99', 'A', 2),
(24, 'PÃO FRANCÊS', 'Kg', '8.99', 'A', 2),
(25, 'COCA COLA', '2L', '7.99', 'Coca Cola', 3),
(26, 'FANTA UVA', 'Lata', '6.95', 'Coca Cola', 3),
(27, 'Suco de Uva', '1,5L', '12.50', 'Tanjal', 3),
(28, 'Poupa de Fruta - Congelada', 'Unid', '0.96', 'da casa', 3),
(29, 'Cerveja Itaipava', 'Lata', '2.80', 'Ambev', 3),
(30, 'Leite Integral', 'Unid', '2.99', 'Italac', 3),
(31, 'LEITE DESNATADO', 'Uni', '2.59', 'Italac', 3),
(32, 'ÁGUA DE COCO', 'Unid', '15.99', 'Ducoco', 3),
(33, 'GUARAVITTON', 'Kg', '2.99', 'Minalba', 3),
(34, 'H2O', 'Kg', '2.59', 'Coca Cola', 3),
(35, 'UVA', 'Kg', '9.79', '...', 4),
(36, 'MAMÃO', 'Unid', '2.99', '..', 4),
(37, 'Limão', 'Kg', '1.99', '..', 4),
(38, 'Maracujá', 'Kg', '9.99', '..', 4),
(40, 'Abacaxi', 'Unid', '3.99', '..', 4),
(41, 'Morango', 'Caixa', '3.75', '...', 3);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
