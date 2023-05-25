-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 25/05/2023 às 19:15
-- Versão do servidor: 8.0.31
-- Versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `getao_de_membros`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `membros`
--

DROP TABLE IF EXISTS `membros`;
CREATE TABLE IF NOT EXISTS `membros` (
  `gestor` varchar(150) NOT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nome` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `data_conversao` date NOT NULL,
  `data_batism_aguas` date NOT NULL,
  `data_batism_esp` date NOT NULL,
  `situacao` int NOT NULL,
  PRIMARY KEY (`cpf`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `membros`
--

INSERT INTO `membros` (`gestor`, `foto`, `nome`, `cpf`, `data_nascimento`, `sexo`, `data_conversao`, `data_batism_aguas`, `data_batism_esp`, `situacao`) VALUES
('teste@teste.com', 'fotos/646d24fe67fbb.jpg', 'Angela Rodriges Costa', '22222222222', '0001-01-01', 2, '0001-01-01', '0001-01-01', '0001-01-01', 2),
('teste@teste.com', 'fotos/646d237022175.png', 'Wesley Monteiro De Araújo', '11111111111', '2001-03-01', 1, '2014-02-09', '2006-11-11', '2006-11-11', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `nome` varchar(150) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `data_nascimento` date NOT NULL,
  PRIMARY KEY (`cpf`,`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`nome`, `cpf`, `email`, `senha`, `tipo`, `data_nascimento`) VALUES
('Wesley', '11111111111', 'teste2@teste.com', 'teste', 2, '2001-03-01'),
('Robsom', '00000000000', 'teste@teste.com', 'teste', 1, '1970-01-01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
