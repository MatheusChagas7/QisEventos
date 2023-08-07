-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 05/09/2017 às 11:29
-- Versão do servidor: 5.5.51-38.2
-- Versão do PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `troiatec_baco`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nome_sub_categoria` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `contador`
--

CREATE TABLE IF NOT EXISTS `contador` (
  `id_cont` int(11) NOT NULL,
  `fk_cont_usu` int(11) NOT NULL,
  `qtd_clique` int(15) NOT NULL,
  `qtd_visu` int(15) NOT NULL,
  `dt_cont` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `propaganda`
--

CREATE TABLE IF NOT EXISTS `propaganda` (
  `id_propaganda` int(11) NOT NULL,
  `fk_propaganda_usu` int(11) NOT NULL,
  `imagem_propaganda` mediumblob NOT NULL,
  `nome_ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `url_redi` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `localizacao` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usu` int(11) NOT NULL,
  `nome_completo` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email_usu` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha__usu` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf_usu` char(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rg_usu` char(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dt_nasc` date NOT NULL,
  `sexo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `nivel` int(1) NOT NULL,
  `pacote_usu` int(1) NOT NULL,
  `foto_perfil` mediumblob,
  `nome_fp` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_fp` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_capa` mediumblob,
  `nome_fc` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_fc` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fk_categoria1_usu` int(11) DEFAULT NULL,
  `fk_categoria2_usu` int(11) DEFAULT NULL,
  `fk_categoria3_usu` int(11) DEFAULT NULL,
  `descricao` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `numero_1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_contato` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_persona` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `canal_yt` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `canal_playlist` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `conta_insta` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `conta_face` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `conta_twitter` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `contador`
--
ALTER TABLE `contador`
  ADD PRIMARY KEY (`id_cont`);

--
-- Índices de tabela `propaganda`
--
ALTER TABLE `propaganda`
  ADD PRIMARY KEY (`id_propaganda`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usu`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `contador`
--
ALTER TABLE `contador`
  MODIFY `id_cont` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `propaganda`
--
ALTER TABLE `propaganda`
  MODIFY `id_propaganda` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
