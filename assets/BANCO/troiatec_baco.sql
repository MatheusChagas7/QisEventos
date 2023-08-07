-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 18/09/2017 às 18:30
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
  `dt_cont` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos`
--

CREATE TABLE IF NOT EXISTS `favoritos` (
  `id_favoritos` int(11) NOT NULL,
  `id_fk_usu` int(11) NOT NULL,
  `id_fk_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `propaganda`
--

CREATE TABLE IF NOT EXISTS `propaganda` (
  `id_propaganda` int(11) NOT NULL,
  `fk_propaganda_usu` int(11) NOT NULL,
  `imagem_propaganda` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url_redi` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `localizacao` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dt_propaganda` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `publicacao`
--

CREATE TABLE IF NOT EXISTS `publicacao` (
  `id_publicacao` int(11) NOT NULL,
  `publicacao` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `fk_publicacao_usu` int(11) NOT NULL,
  `data_publicacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `id_token` int(11) NOT NULL,
  `fk_token_usu` int(11) DEFAULT NULL,
  `token` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usu` int(11) NOT NULL,
  `nome_completo` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email_usu` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha_usu` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `cpf_usu` char(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rg_usu` char(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dt_nasc` date DEFAULT NULL,
  `sexo` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nivel` int(1) NOT NULL,
  `pacote_usu` int(1) NOT NULL,
  `foto_perfil` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_capa` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fk_categoria1_usu` int(11) DEFAULT NULL,
  `fk_categoria2_usu` int(11) DEFAULT NULL,
  `fk_categoria3_usu` int(11) DEFAULT NULL,
  `sobre_usu` mediumtext COLLATE utf8_unicode_ci NOT NULL,
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
  `skip_albun` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `conta_twitter` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dt_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `migracao` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `situacao_login` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `noticias` int(1) NOT NULL DEFAULT '3'
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
  ADD PRIMARY KEY (`id_cont`), ADD KEY `fk_cont_usu` (`fk_cont_usu`);

--
-- Índices de tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id_favoritos`), ADD KEY `id_fk_usu` (`id_fk_usu`), ADD KEY `id_fk_cliente` (`id_fk_cliente`);

--
-- Índices de tabela `propaganda`
--
ALTER TABLE `propaganda`
  ADD PRIMARY KEY (`id_propaganda`), ADD KEY `fk_propaganda_usu` (`fk_propaganda_usu`);

--
-- Índices de tabela `publicacao`
--
ALTER TABLE `publicacao`
  ADD PRIMARY KEY (`id_publicacao`), ADD KEY `fk_publicacao_usu` (`fk_publicacao_usu`);

--
-- Índices de tabela `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id_token`), ADD KEY `fk_token_usu` (`fk_token_usu`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usu`), ADD KEY `fk_categoria3_usu` (`fk_categoria3_usu`), ADD KEY `fk_categoria1_usu` (`fk_categoria1_usu`), ADD KEY `fk_categoria2_usu` (`fk_categoria2_usu`);

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
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id_favoritos` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `propaganda`
--
ALTER TABLE `propaganda`
  MODIFY `id_propaganda` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `publicacao`
--
ALTER TABLE `publicacao`
  MODIFY `id_publicacao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `token`
--
ALTER TABLE `token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `contador`
--
ALTER TABLE `contador`
ADD CONSTRAINT `fk_cont_usu` FOREIGN KEY (`fk_cont_usu`) REFERENCES `usuario` (`id_usu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `favoritos`
--
ALTER TABLE `favoritos`
ADD CONSTRAINT `id_fk_cliente` FOREIGN KEY (`id_fk_cliente`) REFERENCES `usuario` (`id_usu`),
ADD CONSTRAINT `id_fk_usu` FOREIGN KEY (`id_fk_usu`) REFERENCES `usuario` (`id_usu`);

--
-- Restrições para tabelas `propaganda`
--
ALTER TABLE `propaganda`
ADD CONSTRAINT `fk_propaganda_usu` FOREIGN KEY (`fk_propaganda_usu`) REFERENCES `usuario` (`id_usu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `publicacao`
--
ALTER TABLE `publicacao`
ADD CONSTRAINT `fk_publicacao_usu` FOREIGN KEY (`fk_publicacao_usu`) REFERENCES `usuario` (`id_usu`);

--
-- Restrições para tabelas `token`
--
ALTER TABLE `token`
ADD CONSTRAINT `fk_token_usu` FOREIGN KEY (`fk_token_usu`) REFERENCES `usuario` (`id_usu`);

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `fk_categoria1_usu` FOREIGN KEY (`fk_categoria1_usu`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_categoria2_usu` FOREIGN KEY (`fk_categoria2_usu`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_categoria3_usu` FOREIGN KEY (`fk_categoria3_usu`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
