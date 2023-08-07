-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 17/11/2017 às 14:33
-- Versão do servidor: 5.5.51-38.2
-- Versão do PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `bacoeven_baco`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nome_sub_categoria` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome_categoria`, `nome_sub_categoria`) VALUES
(37, 'Artistas / Bandas / Grupos', 'Rock'),
(38, 'Artistas / Bandas / Grupos', 'Sertanejo'),
(39, 'Artistas / Bandas / Grupos', 'Pagode'),
(40, 'Artistas / Bandas / Grupos', 'Samba'),
(41, 'Artistas / Bandas / Grupos', 'MPB'),
(42, 'Artistas / Bandas / Grupos', 'Música Portuguesa'),
(43, 'Artistas / Bandas / Grupos', 'Músicas Judaicas'),
(44, 'Artistas / Bandas / Grupos', 'Banda de Casamento'),
(45, 'Artistas / Bandas / Grupos', 'Anos 70, 80, 90'),
(46, 'Artistas / Bandas / Grupos', 'Dança de Salão'),
(47, 'Artistas / Bandas / Grupos', 'Rap Nacional'),
(48, 'Artistas / Bandas / Grupos', 'MCs'),
(49, 'Artistas / Bandas / Grupos', 'Outros'),
(50, 'Staff', 'Garçom'),
(51, 'Staff', 'Caixa'),
(52, 'Staff', 'Limpeza'),
(53, 'Staff', 'Barman'),
(54, 'Staff', 'Eletricista'),
(55, 'Staff', 'Segurança'),
(56, 'Staff', 'Bombeiro Civil'),
(57, 'Staff', 'Produtor'),
(58, 'Staff', 'Promoter'),
(59, 'Staff', 'Tequileiro(a)'),
(60, 'Staff', 'Dançarino(a)'),
(61, 'Staff', 'Outros'),
(62, 'Estruturas', 'Palco / Praticável'),
(63, 'Estruturas', 'Grade'),
(64, 'Estruturas', 'Banheiro Químico'),
(65, 'Estruturas', 'Tenda / Lona'),
(66, 'Estruturas', 'Mesa / Cadeira / Bistrô'),
(67, 'Estruturas', 'Outros'),
(68, 'Infantil', 'Animador(a)'),
(69, 'Infantil', 'Brinquedos'),
(70, 'Infantil', 'Buffet Infantil'),
(71, 'Infantil', 'Decorador(a)'),
(72, 'Infantil', 'DJ de Festa Infantil'),
(73, 'Infantil', 'Mesas / Móveis'),
(74, 'Infantil', 'Outros'),
(75, 'Transporte', 'Van'),
(76, 'Transporte', 'Micro-ônibus'),
(77, 'Transporte', 'Ônibus'),
(78, 'Transporte', 'Fretes'),
(79, 'Transporte', 'Outros'),
(92, 'Bebidas', 'Bebidas Consignadas'),
(93, 'Bebidas', 'Depósito'),
(94, 'Bebidas', 'Gelo'),
(95, 'Bebidas', 'Tina'),
(96, 'Bebidas', 'Outros'),
(97, 'Divulgação', 'Promoter'),
(98, 'Divulgação', 'Gráfica'),
(99, 'Divulgação', 'Designer'),
(100, 'Divulgação', 'Agência de Publicidade'),
(101, 'Divulgação', 'Outros'),
(102, 'Audiovisual', 'Sonorização'),
(103, 'Audiovisual', 'Iluminação'),
(104, 'Audiovisual', 'Telão / Televisões / Painéis de Led'),
(105, 'Audiovisual', 'Filmagem'),
(106, 'Audiovisual', 'Filmagem c/ drone'),
(107, 'Audiovisual', 'Fotográfia'),
(108, 'Audiovisual', 'DJ'),
(109, 'Audiovisual', 'Técnico de áudio'),
(110, 'Audiovisual', 'Técnico de iluminação'),
(111, 'Audiovisual', 'Roadie'),
(112, 'Audiovisual', 'Outros'),
(114, 'Infantil', 'Fantasias'),
(115, 'Artistas / Bandas / Grupos', 'Hip-Hop'),
(116, 'Artistas / Bandas / Grupos', 'Funk'),
(117, 'Artistas / Bandas / Grupos', 'Forró'),
(118, 'Comidas', 'Buffet'),
(119, 'Comidas', 'Salgadinhos'),
(120, 'Comidas', 'Frios'),
(121, 'Comidas', 'Bolos'),
(122, 'Comidas', 'Doces'),
(123, 'Músicos', 'Bateristas'),
(124, 'Músicos', 'Guitarrisas'),
(125, 'Músicos', 'Baixistas'),
(126, 'Músicos', 'Vocalistas'),
(127, 'Músicos', 'Backing Vocal'),
(128, 'Músicos', 'Tecladista'),
(129, 'Músicos', 'Sanfonistas'),
(131, 'Comidas', 'Outros'),
(132, 'Músicos', 'Outros');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos`
--

CREATE TABLE IF NOT EXISTS `favoritos` (
  `id_favoritos` int(11) NOT NULL,
  `id_fk_usu` int(11) NOT NULL,
  `id_fk_cliente` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=712 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `favoritos`
--

INSERT INTO `favoritos` (`id_favoritos`, `id_fk_usu`, `id_fk_cliente`) VALUES
(704, 111, 74);

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacao`
--

CREATE TABLE IF NOT EXISTS `notificacao` (
  `id_noti` int(11) NOT NULL,
  `msg_noti` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data_noti` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visu_noti` tinyint(1) NOT NULL DEFAULT '0',
  `id_cli_noti` int(11) NOT NULL,
  `id_usu_noti` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=462 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `notificacao`
--

INSERT INTO `notificacao` (`id_noti`, `msg_noti`, `data_noti`, `visu_noti`, `id_cli_noti`, `id_usu_noti`) VALUES
(277, '\n			Está seguindo você', '2017-10-27 15:56:44', 1, 63, 51),
(455, '\n			Está seguindo você', '2017-11-09 17:16:56', 1, 63, 59),
(281, 'Falta(m) 2 dias para seu pacote expirar. <a href=premium.php>RENOVAR</a>', '2017-10-28 02:15:02', 1, 0, 51),
(282, 'Falta(m) 1 dias para seu pacote expirar. <a href=premium.php>RENOVAR</a>', '2017-10-29 02:15:02', 1, 0, 51),
(283, '\n			Está seguindo você', '2017-10-29 12:41:05', 1, 59, 51),
(285, 'Falta(m) 0 dias para seu pacote expirar. <a href=premium.php>RENOVAR</a>', '2017-10-30 02:15:02', 1, 0, 51),
(454, '\n			Está seguindo você', '2017-11-09 17:12:43', 1, 63, 59),
(432, '\n			Está seguindo você', '2017-11-07 15:15:47', 1, 63, 59),
(433, '\n			Está seguindo você', '2017-11-07 15:16:21', 1, 63, 59),
(330, '\n			Está seguindo você', '2017-10-30 18:17:26', 1, 59, 51),
(331, 'Seu pacote expirou! <a href=premium.php>COMPRAR</a>', '2017-10-31 02:00:05', 1, 0, 51),
(332, '\n			Está seguindo você', '2017-10-31 16:18:21', 0, 51, 61),
(434, '\n			Está seguindo você', '2017-11-07 15:16:22', 1, 63, 59),
(435, '\n			Está seguindo você', '2017-11-07 15:16:22', 1, 63, 59),
(456, '\n			Está seguindo você', '2017-11-09 17:17:13', 1, 63, 59),
(436, '\n			Está seguindo você', '2017-11-07 15:16:23', 1, 63, 59),
(457, '\n			Está seguindo você', '2017-11-09 17:26:40', 1, 63, 59),
(458, '\n			Está seguindo você', '2017-11-13 23:23:38', 0, 74, 111),
(459, '\n			Está seguindo você', '2017-11-14 15:02:07', 0, 63, 54),
(460, '\n			Está seguindo você', '2017-11-14 15:05:54', 0, 63, 54),
(461, '\n			Está seguindo você', '2017-11-17 16:31:17', 0, 123, 52);

-- --------------------------------------------------------

--
-- Estrutura para tabela `propaganda`
--

CREATE TABLE IF NOT EXISTS `propaganda` (
  `id_propaganda` int(11) NOT NULL,
  `fk_propaganda_usu` int(11) NOT NULL,
  `imagem_propaganda` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url_redi` varchar(900) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `localizacao` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dt_propaganda` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `propaganda`
--

INSERT INTO `propaganda` (`id_propaganda`, `fk_propaganda_usu`, `imagem_propaganda`, `url_redi`, `localizacao`, `dt_propaganda`) VALUES
(24, 59, 'assets/img/anuncio/buffet.jpg', 'https://www.facebook.com/buffetpersonalite/', 'slide-topo', '2017-10-15 03:14:19'),
(29, 59, 'assets/img/anuncio/batuta.jpg', 'https://www.facebook.com/events/143642749700885/?acontext=%7B"source"%3A5%2C"page_id_source"%3A1532406873717608%2C"action_history"%3A[%7B"surface"%3A"page"%2C"mechanism"%3A"main_list"%2C"extra_data"%3A"%7B%5C"page_id%5C"%3A1532406873717608%2C%5C"tour_id%5C"%3Anull%7D"%7D]%2C"has_source"%3Atrue%7D', 'slide-topo', '2017-10-17 16:22:12'),
(30, 59, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/23316486_1600871859981358_7810092946232502951_n.jpg?oh=4cbea904af97dda711bddceb065eadd1&oe=5AA108E5', 'https://www.facebook.com/events/783803288471611/', 'slide-topo', '2017-10-17 16:22:12'),
(31, 59, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/22894359_1933891946831734_3399753601921993694_n.jpg?oh=93f7139bc876681e4045c0ac5fc3cc3c&oe=5A69C4A7', 'https://www.facebook.com/events/500671380304747/', 'slide-topo', '2017-10-17 16:22:12'),
(32, 59, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/23435278_510377955998396_2675547731564977793_n.jpg?oh=b6cd1f8b77023c4628d909878ed45973&oe=5A98FD7E', 'https://www.facebook.com/events/292321681280114/', 'slide-topo', '2017-10-17 16:22:12'),
(37, 59, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/12744213_759429670857472_4181796207345087017_n.jpg?oh=ff51699c2506dac489dbbeaa6d4d7b17&oe=5AA28110', 'https://www.facebook.com/alphagelo/', 'sly-rodape', '2017-11-12 15:09:09'),
(38, 59, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/3612_295409573939566_472060371_n.jpg?oh=ae6ea0409c3c42f09e78f56988371a7c&oe=5A9F62DD', 'https://www.facebook.com/alugueldeparedoes/', 'sly-rodape', '2017-11-12 15:11:04'),
(39, 59, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/14520393_886982974779534_2623052016526908154_n.jpg?oh=1b48ca7bd7b4cabbb2d1c6eed0ea32f8&oe=5A939C25', 'https://www.facebook.com/Depósito-de-Bebidas-Rio-90-Graus-583925095085325/', 'sly-rodape', '2017-11-12 15:12:40'),
(40, 59, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/21078817_1637247016319547_6478348673330981850_n.jpg?oh=293e82eb84ef9f4f2e7b1aca73e5fb82&oe=5AA29042', 'https://www.facebook.com/silvia.queirozfotografias/', 'sly-rodape', '2017-11-12 15:13:48'),
(41, 59, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/13700080_1971644436395232_3872954926637363445_n.png?oh=1d5f2afb0686f2a15bdb672448d0e7f1&oe=5A9F08E6', 'https://www.facebook.com/bebidaexpress/', 'sly-rodape', '2017-11-12 15:17:40'),
(42, 59, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/10805848_708594809235708_5789769120520214855_n.jpg?oh=662f40e7cb491ac4cd0c0a354ab6d68d&oe=5A9BED5D', 'https://www.facebook.com/transporteVan/', 'sly-rodape', '2017-11-12 15:17:40'),
(43, 59, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/23172735_724113824465176_4460359317799271555_n.jpg?oh=cd37bb695037e97d351c4af77b1e86b6&oe=5A696941', 'https://www.facebook.com/events/131631297491450/', 'sly-rodape', '2017-11-12 15:20:28'),
(44, 59, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/22851976_721035998106292_3350184441049253041_n.jpg?oh=dfa03e27f4075a4f93ee1596fe22b6fc&oe=5AB02E8C', 'https://www.facebook.com/events/1648853778500520/', 'sly-rodape', '2017-11-12 15:20:28'),
(45, 59, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/22851722_1647888638564747_3745796102801188480_n.jpg?oh=7b82d7c3f5348b486a2f07c24b702602&oe=5AA972AC', 'https://www.facebook.com/events/1886732448311318/', 'sly-rodape', '2017-11-12 15:24:14'),
(46, 59, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/23231673_1976669689268311_7966565418228228790_n.jpg?oh=45ab8251073f362e80357b8b0698bbcb&oe=5AA60D76', 'https://www.facebook.com/events/755526471321216/', 'sly-rodape', '2017-11-12 15:24:14');

-- --------------------------------------------------------

--
-- Estrutura para tabela `publicacao`
--

CREATE TABLE IF NOT EXISTS `publicacao` (
  `id_publicacao` int(11) NOT NULL,
  `publicacao` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fk_publicacao_usu` int(11) NOT NULL,
  `data_publicacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `id_token` int(11) NOT NULL,
  `fk_token_usu` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=749 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `token`
--

INSERT INTO `token` (`id_token`, `fk_token_usu`, `token`) VALUES
(695, 'matheusch7@gmail.com', 'e2SRkF53YjM:APA91bFpg84Eb1MYIEbhHEgzwo_aVBeBXhFNowQ3MnWIinQvbgbIrRQWF-raCsDirXukEQZxND_hhk_K3qxXRhJTIZk3doSxykJIpHAA4yPKw4OM11UU97EpKA5lwXdlDwL52PyW-_SP'),
(698, 'matheusch7@gmail.com', 'cJXa9thsShA:APA91bEu0w-t35fDcY7pvopdeAoejVCe9DGwJxF7EZI0MX6PtUQ4hLUjmkcZpVulsUxTx6kOPGcTcPFVK3wkna_qHGxjo34394Mv_XCC_X52cTdIqy9fK2tjhkHLry6VWF-KBSSQVXhL'),
(700, 'matheusch7@gmail.com', ''),
(701, 'matheusch7@gmail.com', 'fgt6zmTriIU:APA91bHXyidIKbVXUAJ2cF3EqBS4YjdZ39TJgn36JUnV0YgNNk8IHz75DVWvqOLtO9-p-K1K3Gx7c51Lv11Qn4lcKg9cBnjjntWDCN4i04jRBK0I-tIh85gWCycPsmowMeopZAp1Zkm-'),
(718, 'emailexemplo025@outlook.com', ''),
(719, 'krd222@hotmail.com', 'cVauTQZ3X8E:APA91bHr4YOKWnhTVRhTqsdlJVim6ePqQ3FEzayasnELuE390LhQwJCXEI6Of8ejd8pW9rettB8W3B-OroL2vLdUH-ac8IqyMJEjfbcznNqEniO27ObYlBS1hSY1EIhcaRmIy5nX1pg5'),
(722, 'matheusch7@gmail.com', 'fB_Qo3bppsw:APA91bF3-Wvwcc25FOJFsIHSaeI_F-ipbKBYklEYGkOst2_O8vWMqMJ8ZhIVfI9wkvilLsc-ZDfZWQRvzjoKc0u0YnkjcQIQMwk2KolpUtXb4p_kNPWY8oWOYTk8AtRLHLIWqdLtobjK'),
(737, 'matheusch7@gmail.com', ''),
(738, 'matheusch7@gmail.com', 'cpHYPUmk-oo:APA91bHW8GxwXAzdexRtN6nkdfR412u276pe6cG_t4tQfMHph-hfAgggS0jdssfvm5Fb6vGp0zaGbf3suizqIp492loDmrx9EKsX2Dz8p9LrBiRgn8tS2mEUsjktrtpYfimt-GWIDP5i'),
(739, 'matheusch7@gmail.com', 'c_ZJx11XeC0:APA91bEPVmg_3sOrRhT8L7s7sb9-BFFHHQAEGYdoaeX1N2D9BVr83-8xV5fTXWOaX4InIlP1co3xYobndYjlvgYFR4pLMZtRTzAVXfqGJSlSNjQ7Bp0fwx76gmQzwfgWD-pyNmAu0sR5');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usu` int(11) NOT NULL,
  `nome_completo` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_usu` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `senha_usu` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cpf_usu` char(14) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rg_usu` char(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `dt_nasc` date DEFAULT NULL,
  `sexo` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nivel` int(1) NOT NULL,
  `pacote_usu` int(1) NOT NULL,
  `data_inicio_pagamento` date NOT NULL,
  `cont_dias_pacote` int(11) NOT NULL,
  `foto_perfil` varchar(10000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_capa` varchar(10000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fk_categoria1_usu` int(11) DEFAULT NULL,
  `nome_categoria_1` varchar(90) NOT NULL,
  `fk_categoria2_usu` int(11) DEFAULT NULL,
  `nome_categoria_2` varchar(90) NOT NULL,
  `fk_categoria3_usu` int(11) DEFAULT NULL,
  `nome_categoria_3` varchar(90) NOT NULL,
  `sobre_usu` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `n_acesso` int(11) NOT NULL,
  `rating` float DEFAULT NULL,
  `n_rating` int(11) NOT NULL,
  `numero_1` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_2` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_3` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_contato` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_persona` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `canal_yt` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `canal_playlist` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `conta_insta` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `conta_face` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `skip_albun` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `conta_twitter` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dt_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `migracao` char(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `situacao_login` char(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dt_last_acess` date NOT NULL,
  `cont_dias_desl` int(11) NOT NULL,
  `noticias` int(1) NOT NULL DEFAULT '3',
  `status_confirma` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`id_usu`, `nome_completo`, `email_usu`, `senha_usu`, `cpf_usu`, `rg_usu`, `estado`, `cidade`, `dt_nasc`, `sexo`, `nivel`, `pacote_usu`, `data_inicio_pagamento`, `cont_dias_pacote`, `foto_perfil`, `foto_capa`, `fk_categoria1_usu`, `nome_categoria_1`, `fk_categoria2_usu`, `nome_categoria_2`, `fk_categoria3_usu`, `nome_categoria_3`, `sobre_usu`, `descricao`, `n_acesso`, `rating`, `n_rating`, `numero_1`, `numero_2`, `numero_3`, `email_contato`, `url_persona`, `canal_yt`, `canal_playlist`, `conta_insta`, `conta_face`, `skip_albun`, `conta_twitter`, `website`, `dt_criacao`, `migracao`, `situacao_login`, `dt_last_acess`, `cont_dias_desl`, `noticias`, `status_confirma`) VALUES
(52, 'Grupo Deu liga', 'emailexemplo000@outlook.com', 'bacoeventos123', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 54, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/17265289_604644403066602_132562290491407343_n.jpg?oh=2ecbfbda57bbd1d2dd21d5932982b397&oe=5A6BDC72', '/assets/img/usuario/150803561559e2cc1f3fefb.jpg', 39, 'Artistas / Bandas / Grupos', NULL, '', NULL, '', 'E aí família! Nós somos o Grupo Deu Liga. Contamos com a ajuda de cada amigo nosso nessa grande caminhada. Vem que #JáDeuLigaNeguinho', 'Grupo de pagode - GRUPO DEU LIGA ', 7, NULL, 0, '(21)9 8848-1815', '', '', 'deu_liga@outlook.com', 'GrupoDeuLiga', 'https://www.youtube.com/channel/UCuTiODv82A87hmZmx4ts8Tg/', '', 'deuligaoficial', 'GrupoDeuLiga', '', '', '', '2017-10-14 16:18:08', 'baco', '', '2017-11-14', 60, 3, 0),
(53, 'Luizzinho Rodrigues', 'emailexemplo001@outlook.com', 'Luiz0657', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '1982-12-06', 'm', 3, 2, '0000-00-00', 54, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/22089993_1967608060167060_3549983441620803513_n.png?oh=c10b82912a11c3fd61fd92397154dca2&oe=5A698029', '/assets/img/usuario/150803570859e2cc7cbb502.jpg', 39, 'Artistas / Bandas / Grupos', 40, 'Artistas / Bandas / Grupos', 41, 'Artistas / Bandas / Grupos', 'Cantor de Samba e Pagode do Rio de Janeiro.', 'Sensação do Samba carioca', 2, NULL, 0, '(21)9 7941-7406', '', '', 'luiznossaconsultoria@hotmail.com', 'luizinhoVPC', 'https://www.youtube.com/channel/', '', '', 'luizinhoVPC', '', '', 'http://www.luizzinhorodrigues.com.br', '2017-10-14 19:32:20', 'baco', 'log', '0000-00-00', 60, 3, 0),
(54, 'Thiago Mendonça', 'emailexemplo002@outlook.com', 'bacoeventos123', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 54, '/assets/img/usuario/150803302459e2c200ea278.jpg', '', 108, 'Audiovisual', NULL, '', NULL, '', '', 'Dj pelo RIO DE JANEIRO', 2, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'ThiagoDJBS', 'https://www.youtube.com/channel/', '', '', '', '', '', '', '2017-10-14 23:26:25', 'baco', 'log', '2017-11-03', 60, 3, 0),
(55, 'Inusitados', 'emailexemplo003@outlook.com', 'bacoeventos123', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 54, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/15027982_1804329303147801_7376006657709162944_n.jpg?_nc_eui2=v1%3AAeEbR3OzNIQb_Nu9TP0MR-1vYhmjPagdK9Z406S-aIrrsiaBOnXUmqqxV_35W9yh5ePvX65QELIeL4bflsaaOE61uIy2Nkm-EsA0a6BfmV1UZA&oh=98c311cf6429df888ffb5611e2f5861e&oe=5A6E7A60', '/assets/img/usuario/150803585559e2cd0f2a25e.jpg', 39, 'Artistas / Bandas / Grupos', NULL, '', NULL, '', 'Sabe aquela história de ''''fazer um som lá em casa'''',? Pois é, tudo começou assim, nos juntávamos para estudar nossos respectivos instrumentos, tocar juntos aquelas músicas que gostávamos e isso se repetia por diversas vezes na semana.\r\n\r\nA maioria das bandas tem uma história parecida, e não foi diferente com a gente, rapaziada natural do Rio de Janeiro, corpo e alma carioca influenciados por diversos gêneros e estilos musicais, por nossos pais, irmãos e tios músicos.\r\n\r\nComeçou com um grupo de pessoas mais chegadas em uma festa pra lá de animada, na casa dos integrantes, amigos e familiares.\r\nDaí a brincadeira cresceu, tomou corpo, e o que era apenas se juntar pra tocar despretensiosamente, foi ficando cada vez mais sério, quando fomos ver já tínhamos um repertório.\r\n\r\nConvidamos mais e mais amigos, depois músicos, e logo um deles disse que tínhamos futuro e que nos ajudaria.\r\n\r\nCom o sucesso entre amigos, a brincadeira ficou séria resultando no mais novo e diferenciado grupo os Inusitados.\r\n\r\nApesar da pouca idade dos seus integrantes, o grupo vem chamando atenção por onde passa, trata-se de jovens nascidos do berço artístico do samba, rock, pop e gospel. E por isso se sentem a vontade em misturar todos esses gêneros musicais e com novas idéias tentar buscar um som de qualidade. \r\n\r\nEstudiosos da música, dedicados e com objetivo de mostrar qualidade, competência musical e principalmente respeito ao público, com um repertório diversificado e atual.', 'Bem-vindos à nossa página Oficial!  Nem melhor, nem pior, apenas "INUSITADOS"  Segura o balanço.', 8, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'InusitadosOficial', 'https://www.youtube.com/channel/', '', 'inusitadosoficial', 'inusitadosoficial', '', '', '', '2017-10-15 02:06:33', 'baco', 'log', '0000-00-00', 60, 3, 0),
(56, 'Daniel Conceição', 'emailexemplo004@outlook.com', 'bacoeventos123', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 54, '/assets/img/usuario/150803529459e2caded4354.jpg', '/assets/img/usuario/150803529459e2caded3109.jpg', 107, 'Audiovisual', NULL, '', NULL, '', '', 'Daniel Fotográfia', 1, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'DannFoto', 'https://www.youtube.com/channel/', '', 'dannfotografia', '', '', '', '', '2017-10-15 02:16:32', 'baco', 'log', '0000-00-00', 60, 3, 0),
(57, 'Passo à frente', 'emailexemplo005@outlook.com', 'bacoeventos123', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 54, '/assets/img/usuario/150803612659e2ce1ea95b6.jpg', '/assets/img/usuario/150803612659e2ce1ea90a3.jpg', 47, 'Artistas / Bandas / Grupos', NULL, '', NULL, '', 'Projeto de rap voltado para a batida clássica do boom bap,original golden era. Vem com letras incisivas,ácidas e conteúdo baseado na vivência de seus integrantes Dieguin ALD''BAS e OMA CACO, crias da zona norte do Rio de Janeiro. Contam com a sagacidade,bagagem e maestria de um dos melhores beatmakers e produtores do cenário hip-hop do Brasil: Goribeatzz!!!', '"Um passo à frente e você não está mais no mesmo lugar" Chico Science', 2, NULL, 0, '(21)9 7178-7253', '(21)9 8342-4806', '', 'emaildecontato@outlook.com', 'PassoAFrente', 'https://www.youtube.com/channel/UC6TkCHREmZa8EekQOQUxKIQ/', '', 'passoafrenterap', 'PassoaFrente', '', '', '', '2017-10-15 02:53:40', 'baco', '', '0000-00-00', 60, 3, 0),
(58, 'Igor Cursino Sardinha', 'emailexemplo006@outlook.com', 'bacoeventos123', 'NULL', 'NULL', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 54, '/assets/img/usuario/150803683059e2d0de40f4f.jpg', '/assets/img/usuario/150803683059e2d0de3ff7a.jpg', 108, 'Audiovisual', NULL, '', NULL, '', '', 'DJ Igor ', 0, NULL, 0, '', '', '', '', 'djigorsardinha', 'https://www.youtube.com/channel/', '', '', '', '', '', '', '2017-10-15 03:04:35', 'baco', '', '0000-00-00', 60, 3, 0),
(59, 'Troia Tecnologia', 'troiatecnologia@gmail.com', 'troiaebaco123', '161.828.167-40', '30.210.450.0', 'RJ', 'Rio de Janeiro', '1995-09-28', '', 2, 0, '2017-11-03', 0, '/assets/img/usuario/15101649715a0349eb3cfa4.jpg', NULL, NULL, '', NULL, '', NULL, '', '', '', 3, NULL, 0, '(21)9 6969-3385', '', '', 'matheusch7@gmail.com', 'Troia634050', NULL, NULL, NULL, NULL, '', NULL, '', '2017-10-15 03:11:25', 'baco', '', '2017-11-11', 60, 3, 0),
(60, 'Thiago Mendonça de Souza Teixeira', 'diretorexecutivo@mail.com', 'aaaaaa123', NULL, NULL, 'RJ', 'Rio de Janeiro', '0000-00-00', '', 2, 0, '2017-10-27', 0, '', NULL, NULL, '', NULL, '', NULL, '', '', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 'Thiagof189e7', NULL, NULL, NULL, NULL, '', NULL, '', '2017-10-16 18:08:25', 'baco', 'log', '0000-00-00', 0, 3, 0),
(61, 'Grupo Numa Boa', 'emailexemplo007@outlook.com', 'bacoeventos123', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '2017-10-27', 54, '/assets/img/usuario/150846378459e954a85dc32.jpg', '/assets/img/usuario/150846340459e9532cac5b9.jpg', 39, 'Artistas / Bandas / Grupos', NULL, '', NULL, '', 'O grupo Numa Boa, criado em janeiro de 2002, foi formado com o intuito de juntas a paixão dos amigos por samba e pagode. \r\nAquela batucada que era feita de uma forma descontraída após partidas de futebol, acabou se tornando profissional. \r\nO som do grupo começou a ser propagado pelos eventos da Tijuca e Vila Isabel. Com o passar o tempo o grupo foi sendo convidado para tocar em diversas casas de shows, assim o Numa Boa se tornou a mais autêntica representação do pagode carioca.\r\nEmbora o grupo Numa Boa tenha sido criado em 2002, o grupo traz importantes influências no cenário da música brasileira, que brilharam intensamente na década de 1990.\r\nTais influências deram origem a um projeto paralelo do grupo, que se convencionou chamar de "Retrôzinho", onde o grupo faz uma homenagem aos seus ídolos, cantando seus antigos sucessos, que marcaram época e que são lembrados até os dias de hoje. O "Retrôzinho" logo ganhou fama e sucesso, de tal modo, teve que ser incorporado a todos os shows do grupo Numa Boa. \r\nPercebendo que o auge das apresentações era o momento do “Retrôzinho”, o grupo resolveu se especializar em repertório retrô. \r\nAssim o Grupo Numa Boa se tornou o percursor em repertório em pagode retrô.', 'Grupo precursor em repertório de pagode retrô', 6, NULL, 0, '(00)0 0000-0000', '', '', 'gruponumaboa@hotmail.com', 'GrupoNumaBoa', 'https://www.youtube.com/channel/', '', 'gruponumaboaoficial', 'gruponumaboaoficial', '', '', '', '2017-10-20 01:33:07', 'baco', '', '0000-00-00', 60, 3, 0),
(63, 'Matheus Chagas', 'matheusch7@gmail.com', 'm77777777', '161.828.167-40', '30.210.450.0', 'PR', 'Curitiba', '1995-09-28', 'm', 2, 0, '2017-11-07', 0, '/assets/img/usuario/15103198405a05a6e02be9b.jpg', '/assets/img/usuario/15103334355a05dbfbb7589.jpg', NULL, '', NULL, '', NULL, '', '', '', 0, NULL, 0, '(21)9 6969-3385', '', '', 'matheusch7@gmail.com', 'MatheusChagas', 'https://www.youtube.com/channel/', '', '', '', '', '', '', '2017-10-24 13:32:24', 'face', 'log', '2017-11-16', 60, 3, 0),
(74, 'Alex Martins', 'krd222@hotmail.com', 'lol715187krd', NULL, NULL, 'RJ', 'Rio de Janeiro', '1986-02-19', 'm', 2, 0, '0000-00-00', 0, 'https://scontent.xx.fbcdn.net/v/t1.0-1/p160x160/21462800_10207744557850682_73299653337411428_n.jpg?oh=262d914b2a5f838363c5ec7cbbc7ed5e&oe=5AAD2D13', NULL, NULL, '', NULL, '', NULL, '', '', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 'Alex133091', NULL, NULL, NULL, NULL, '', NULL, '', '2017-10-31 16:19:48', 'face', 'log', '2017-11-14', 60, 3, 0),
(75, 'Thunder Light Som E Iluminação', 'emailexemplo008@outlook.com', 'thunderlsi01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104237165a073ca47f0f2.jpg', '/assets/img/usuario/15104237165a073ca47e8b4.jpg', 102, 'Audiovisual', 103, 'Audiovisual', NULL, '', 'Em 1995 foi criada a primeira loja THUNDER LIGHT, a matriz, localizada na Rua da Constituição numero 57, no Centro do Rio de Janeiro, hoje, esse mesmo endereço é um ponto de referencia e de encontro de vários profissionais da área.', 'Tudo em Som e iluminação para festas e eventos! Amplificadores profissionais com 3 anos de garantia total! Assistência técnica no centro do Rio de Janeiro.', 11, NULL, 0, '(00)0 0000-0000', '', '(21) 3217-9388', 'contato@thunderlight.com.br', 'Thunder5ab77b', 'https://www.youtube.com/channel/', '', '', 'thunderlightcascadura', '', '', 'http://www.thunderlight.com.br', '2017-11-11 17:37:53', 'baco', '', '2017-11-11', 60, 3, 0),
(76, 'Duda Santtos', 'emailexemplo009@outlook.com', 'dudastt01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', 'm', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104255445a0743c8223ba.jpg', '/assets/img/usuario/15104255445a0743c821b98.jpg', 108, 'Audiovisual', NULL, '', NULL, '', 'Duda Santtos é hoje, um dos nomes mais conhecidos e respeitados artistas da cena eletrônica carioca. Aliando um repertório diferenciado, técnica precisa e um carisma inconfundível, seu nome está sempre presente nos eventos de maior relevância da capital fluminense.', 'Duda Santtos , um dos maiores djs da cena eletrônica carioca. Curta e fique por dentro das novidades sobre ele !!', 2, NULL, 0, '(21)9 8067-6165', '', '(21) 3437-8382', 'contatodudasanttos@gmail.com', 'Duda9d3edf', 'https://www.youtube.com/channel/', '', '', 'dudasanttosmusic', '', '', 'http://www.dudasanttos.com', '2017-11-11 18:33:55', 'baco', '', '2017-11-11', 60, 3, 0),
(77, 'Rodrigo Loyola', 'emailexemplo010@outlook.com', 'djloyola01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104294165a0752e876ff3.jpg', NULL, 108, 'Audiovisual', NULL, '', NULL, '', 'DJ', 'DJ', 1, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'Rodrigoa42c3c', 'https://www.youtube.com/channel/', '', '', 'djrodrigoloyola', '', '', '', '2017-11-11 19:32:37', 'baco', '', '2017-11-11', 60, 3, 0),
(78, 'Grupo VacilaSamba', 'emailexemplo011@outlook.com', 'vacila01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104297585a07543e39a73.jpg', '/assets/img/usuario/15104297585a07543e3905d.jpg', 39, 'Artistas / Bandas / Grupos', 40, 'Artistas / Bandas / Grupos', NULL, '', '', '', 2, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'Grupo38a2f7', NULL, NULL, NULL, NULL, '', NULL, '', '2017-11-11 19:48:34', 'baco', '', '2017-11-11', 60, 3, 0),
(79, 'Pedrinho DJ', 'emailexemplo012@outlook.com', 'pedrinho01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104302295a075615e8afa.jpg', '/assets/img/usuario/15104302295a075615e7f4b.jpg', 108, 'Audiovisual', NULL, '', NULL, '', 'Equipe Pedrinho DJ Som e Iluminação para você que quer fazer uma projeção ou exibir em sua festa ou eventos fotos, vídeos ou qualquer conteúdo multimídia de promoção ou clipes diversos. Locação de som e iluminação com Projeção de Telas .', 'DJ', 1, NULL, 0, '(00)0 0000-0000', '', '', 'pedrohenrique_luz@hotmail.com', 'Pedrinho0a67a1', 'https://www.youtube.com/channel/', '', '', 'PedrinhoDejay', '', '', '', '2017-11-11 19:55:24', 'baco', '', '2017-11-11', 60, 3, 0),
(80, 'Dj André Bolão', 'emailexemplo013@outlook.com', 'andreb01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104309125a0758c08b779.jpg', '/assets/img/usuario/15104309125a0758c08a764.jpg', 108, 'Audiovisual', NULL, '', NULL, '', 'dj', 'DJ', 1, NULL, 0, '(21)9 6599-4980', '(00)0 0000-0000', '(00) 0000-0000', 'emaildecontato@outlook.com', 'Djfe2aaa', 'https://www.youtube.com/channel/', '', '', 'profile.php?id=100008806988482', '', '', '', '2017-11-11 20:04:56', 'baco', '', '2017-11-11', 60, 3, 0),
(81, 'Jet Samba Black', 'emailexemplo014@outlook.com', 'jetsambab01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104312835a075a3330884.jpg', '/assets/img/usuario/15104312835a075a332f399.jpg', 39, 'Artistas / Bandas / Grupos', 41, 'Artistas / Bandas / Grupos', 49, 'Artistas / Bandas / Grupos', 'O JetSambaBlack nasceu em 2006 pelo desejo dos músicos Ricardo Mariano e Silvio Sanuto de mostrar um som de qualidade, misturando MPB e Pagode com a pegada da black music. ', 'O JSB leva o seu swing para a noite carioca, com um som original, com hits que vão de Djavan aos mais consagrados pagodes, tudo com o verdadeiro “sotaque” black.', 2, NULL, 0, '(21)9 9904-6060', '', '', 'jetsambablackoficial@gmail.com', 'Jetebe9b9', NULL, NULL, NULL, NULL, '', NULL, '', '2017-11-11 20:11:52', 'baco', '', '2017-11-11', 60, 3, 0),
(82, 'Betin Ns E B', 'emailexemplo015@outlook.com', 'betinnseb01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104320015a075d019d04f.jpg', '/assets/img/usuario/15104320015a075d019c919.jpg', 38, 'Artistas / Bandas / Grupos', 101, 'Divulgação', NULL, '', 'O cantor Betin está preparando seu novo EP que será lançado em breve. Com uma voz marcante, carisma, energia e animação característicos, Betin e sua equipe levam um espetáculo maravilhoso. Um misto de romantismo e animação, com novidades e clássicos da música sertaneja.', 'Cantor, músico, compositor e produtor musical, Betin tem a música como sua grande paixão. Já se vão 15 anos de dedicação e profissionalismo e devido a isso, Betin vem se destacando no cenário carioca.', 1, NULL, 0, '(00)0 0000-0000', '(00)0 0000-0000', '(00) 0000-0000', 'betinoficial@gmail.com', 'Betinefed64', 'https://www.youtube.com/channel/', '', 'cantacomobetin', 'cantacomobetin', '', '', '', '2017-11-11 20:19:18', 'baco', '', '2017-11-12', 60, 3, 0),
(83, 'Danielle Nicolau II', 'emailexemplo016@outlook.com', 'danielle01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104335285a0762f8de3a4.jpg', '/assets/img/usuario/15104335285a0762f8dd740.jpg', 70, 'Infantil', 71, 'Infantil', 74, 'Infantil', '', 'DECORAÇÃO - BUFFET - PERSONALIZADOS', 1, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'Danielle3ff677', 'https://www.youtube.com/channel/', '', '', 'delicia.desonho', '', '', '', '2017-11-11 20:45:05', 'baco', '', '2017-11-11', 60, 3, 0),
(84, 'Gustavinho Oliveira', 'emailexemplo017@outlook.com', 'gustavinho01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104341525a076568ee611.jpg', '/assets/img/usuario/15104341525a076568ec771.jpg', 40, 'Artistas / Bandas / Grupos', NULL, '', NULL, '', '', '', 2, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'Gustavinhob52fc3', 'https://www.youtube.com/channel/', '', '', 'gustavinho.oliveira.7', '', '', '', '2017-11-11 20:57:12', 'baco', '', '2017-11-11', 60, 3, 0),
(85, 'G-meos', 'emailexemplo018@outlook.com', 'djgmeos01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104348465a07681e260b2.jpg', '/assets/img/usuario/15104348465a07681e25bca.jpg', 108, 'Audiovisual', NULL, '', NULL, '', 'G-Meos tocam Techno desde 2000, em (2001) Foram vencedores do concurso Bunker 94, ganhando espaço no line up da Bunker Rave, com muita credibilidade e conhecimento sonoro G-Meos resulta numa mistura eletrizante com apresentações envolvente de produções próprias, e tracks exclusivas.', 'procurando trazer para pista o que tem de mais atual da cena. Já passaram em boates e festivas no RJ, MG, PR, SP, ES. Bunker 94,(...)', 4, NULL, 0, '(21)9 8347-5805', '', '', 'elektroid@hotmail.com', 'Gmeos2e772b', 'https://www.youtube.com/channel/', '', '', 'gmeosdjs', '', 'DjsGMeos', '', '2017-11-11 21:10:36', 'baco', '', '2017-11-15', 60, 3, 0),
(86, 'Caroles', 'emailexemplo019@outlook.com', 'caroles01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104355875a076b03541e7.jpg', '/assets/img/usuario/15104355875a076b0353030.jpg', 108, 'Audiovisual', NULL, '', NULL, '', 'Poucos djs conseguem levar a pista onde querem como a Caroles faz. Mixagens suaves e limpas, positividade e um som com muita personalidade justificam a quantidade de fãs que acompanham sua carreira onde quer que ela vá.', ' O convencional nunca fez parte da sua paixão pela arte e pela música. É impossível ficar indiferente quando essa menina assume o comando da festa.', 1, NULL, 0, '(00)0 0000-0000', '', '', 'carolesramos@yahoo.com.br', 'Carolesc71316', 'https://www.youtube.com/channel/UCHuCDUJAVV8nfFLhOjljuMQ', '', '', 'carolesdj', '', 'twitter.com/djcaroles', 'http://www.djcaroles.com', '2017-11-11 21:22:57', 'baco', '', '2017-11-11', 60, 3, 0),
(87, 'Agita Samba', 'emailexemplo020@outlook.com', 'agitas01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104503095a07a4855dff9.jpg', '/assets/img/usuario/15104503095a07a48542a92.jpg', 39, 'Artistas / Bandas / Grupos', 40, 'Artistas / Bandas / Grupos', NULL, '', '', 'Agita Samba ! ', 1, NULL, 0, '(21)9 6446-0872', '', '(21) 3259-0369', 'emaildecontato@outlook.com', 'Agita71288e', 'https://www.youtube.com/channel/', '', '', 'agita.samba.1', '', '', 'www.grupoagitasamba.com.br', '2017-11-12 01:25:23', 'baco', '', '2017-11-11', 60, 3, 0),
(88, 'Leandro Barman', 'emailexemplo021@outlook.com', 'leandrob01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104529285a07aec05b4dc.jpg', NULL, 53, 'Staff', NULL, '', NULL, '', '', '', 6, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'Leandro1ec66b', 'https://www.youtube.com/channel/', '', '', 'leandro.barman', '', '', '', '2017-11-12 02:13:08', 'baco', '', '2017-11-12', 60, 3, 0),
(89, 'Arte E Fantasia', 'emailexemplo022@outlook.com', 'artefant01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104534285a07b0b48044d.jpg', '/assets/img/usuario/15104534285a07b0b47f4a5.jpg', 114, 'Infantil', NULL, '', NULL, '', 'Faça sua festa a fantasia e traga 15 convidados para alugar a roupa conosco e ganhe 50% de desconto na sua fantasia, e trazendo 25 convidados sua fantasia sai com 100% de desconto.', 'Venha conhecer a primeira e unica loja de aluguel de fantasias de Duque de Caxias. Temos mais de 150 fantasias femininas e masculinas para muitos gostos, idades e tamanhos.', 2, NULL, 0, '(00)0 0000-0000', '', '(21) 2771-5125', 'arteefantasia1@hotmail.com', 'Artef03430', 'https://www.youtube.com/channel/', '', '', 'arteefantasia', '', '', '', '2017-11-12 02:18:28', 'baco', '', '2017-11-12', 60, 3, 0),
(90, 'Tonny Dicarlo', 'emailexemplo023@outlook.com', 'djdicarlo01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104541005a07b3543045d.jpg', '/assets/img/usuario/15104541005a07b3542e0de.jpg', 108, 'Audiovisual', NULL, '', NULL, '', 'Desde 1981 vem atuando como DJ nas principais casas noturnas do Rio de Janeiro. com raízes na disco music acompanhou a evolução dela até a eletronica (House e Acid House), hj é parte da história da noite carioca\r\nAlém das atuações em festas , eventos e grandes festas.', 'DJ nas principais casas noturnas do Rio de Janeiro.', 2, NULL, 0, '(00)0 0000-0000', '', '', 'tonnydicarlo@gmail.com', 'Tonnyac06cd', 'https://www.youtube.com/channel/', '', '', 'DJTONNYDICARLO', '', '', '', '2017-11-12 02:30:42', 'baco', '', '2017-11-12', 60, 3, 0),
(91, 'Vitally', 'emailexemplo024@outlook.com', 'vitally01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104544845a07b4d452a3e.jpg', '/assets/img/usuario/15104544845a07b4d451fae.jpg', 47, 'Artistas / Bandas / Grupos', 49, 'Artistas / Bandas / Grupos', NULL, '', 'Há aproximadamente 7 anos comecei a me interessar pela música.\r\nDurante esse tempo encontrei muitos obstáculos, momentos de incertezas, passei por muitos desafios, mas também por muito aprendizado e finalmente hoje me sinto pronto para dar início a um novo ciclo em minha carreira.', 'Vitally', 6, NULL, 0, '(00)0 0000-0000', '', '', 'vittaly.contato@gmail.com', 'Vitally446c0b', 'https://www.youtube.com/channel/', '', '', 'vittalymusic ', '', '', '', '2017-11-12 02:39:06', 'baco', '', '2017-11-12', 60, 3, 0),
(92, 'Pekão Silva', 'emailexemplo025@outlook.com', 'pekaos01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104863915a083177c2d2f.jpg', NULL, 123, 'Músicos', 49, 'Artistas / Bandas / Grupos', NULL, '', 'Baterista', 'Baterista', 0, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'Pekãod06f1c', 'https://www.youtube.com/channel/', '', '', 'pecao.neymar', '', '', '', '2017-11-12 11:30:29', 'baco', 'log', '2017-11-13', 60, 3, 0),
(93, 'Dj Marcelo Caê', 'emailexemplo026@outlook.com', 'djmcae01', '000.000.000-00', '00.000.000.0', 'PE', 'Recife', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104866635a08328790431.jpg', '/assets/img/usuario/15104866635a0832878f03a.jpg', 108, 'Audiovisual', NULL, '', NULL, '', '', '', 0, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'Djd366f8', 'https://www.youtube.com/channel/', '', '', 'djmarcelo.cae', '', '', '', '2017-11-12 11:35:10', 'baco', '', '2017-11-12', 60, 3, 0),
(94, 'Arthur Marsili', 'emailexemplo027@outlook.com', 'arthurm01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104870585a083412f2572.jpg', NULL, 105, 'Audiovisual', NULL, '', NULL, '', '', 'Cinegrafista ', 2, NULL, 0, '(21)9 8104-4008', '', '', 'emaildecontato@outlook.com', 'Arthurbc67d6', 'https://www.youtube.com/channel/', '', 'marsilivideo', '', '', '', '', '2017-11-12 11:41:17', 'baco', '', '2017-11-12', 60, 3, 0),
(95, 'VBN Painéis Eletrônicos', 'emailexemplo028@outlook.com', 'bvnpaineis01', '000.000.000-00', '00.000.000.0', 'SP', 'Guarulhos', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104876525a083664119dd.jpg', NULL, 104, 'Audiovisual', NULL, '', NULL, '', '', '', 0, NULL, 0, '(11)9 5713-5582', '(11)9 4111-9953', '(11) 2087-4303', 'vendas01@vbnpaineis.com.br', 'VBN834bba', 'https://www.youtube.com/channel/', '', '', '', '', '', 'www.vbnpaineis.com.br', '2017-11-12 11:49:19', 'baco', '', '2017-11-12', 60, 3, 0),
(96, 'Guanambi', 'emailexemplo029@outlook.com', 'guanambi01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104879705a0837a2ad8c8.jpg', '/assets/img/usuario/15104879705a0837a2ad282.jpg', 106, 'Audiovisual', NULL, '', NULL, '', '', 'Imagem aérea com drone.', 5, NULL, 0, '(00)0 0000-0000', '', '', 'jezielmedeiros@gmail.com', 'Guanambi90f9f4', 'https://www.youtube.com/channel/', '', '', 'Guanambi.imagem', '', '', '', '2017-11-12 11:57:44', 'baco', '', '2017-11-12', 60, 3, 0),
(97, 'Ed Polo Eventos', 'emailexemplo030@outlook.com', 'edpoloev01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104886615a083a556c2e9.jpg', '/assets/img/usuario/15104889245a083b5c0b504.jpg', 107, 'Audiovisual', NULL, '', NULL, '', '', 'Atuando no ramo do entretenimento desde 2010, trabalhado junto as melhores produtoras do Rio de Janeiro.', 3, NULL, 0, '(21)9 9911-1211', '', '(21) 3593-9353', 'edpolocom@hotmail.com', 'Eda8ea1c', 'https://www.youtube.com/channel/', '', '', 'edpolojr', '', '', 'http://www.edpolo.com.br', '2017-11-12 12:07:46', 'baco', '', '2017-11-12', 60, 3, 0),
(98, 'Rodrigo Ribeiro', 'emailexemplo031@outlook.com', 'rribeiro01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104892175a083c8124d78.jpg', '/assets/img/usuario/15104893395a083cfbb356e.jpg', 41, 'Artistas / Bandas / Grupos', 39, 'Artistas / Bandas / Grupos', NULL, '', '', '', 3, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'Rodrigoe77f9a', 'https://www.youtube.com/channel/', '', '', 'duduasdf', '', '', '', '2017-11-12 12:18:10', 'baco', '', '2017-11-12', 60, 3, 0),
(99, 'Zé Delivery de bebidas', 'emailexemplo032@outlook.com', 'zedbebidas01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104909345a084336f0c4e.jpg', '/assets/img/usuario/15104909345a084336f00f8.jpg', 92, 'Bebidas', 96, 'Bebidas', NULL, '', 'Onde o Zé atende?\r\nAté agora estamos experimentando. O Zé quer ser o melhor para você. Então atendemos São Paulo, Campinas, Rio de Janeiro, Niterói, São José dos Campos, Fortaleza, São José do Rio Preto, São Carlos, Curitiba e Belo Horizonte.', 'E ai, o Zé chegou e com Cerveja! Mas afinal, quem é o Zé? O Zé é seu amigo que sempre pode te ajudar. Ele é o cara gente boa que sempre sabe para quem ligar na hora certa.', 0, NULL, 0, '(00)0 0000-0000', '', '', 'ze@ze.delivery', 'Zé092478', 'https://www.youtube.com/channel/', '', '', 'zedeliverydebebidas', '', '', '', '2017-11-12 12:44:32', 'baco', '', '2017-11-12', 60, 3, 0),
(100, 'Festas Bebidas', 'emailexemplo033@outlook.com', 'fbebidas01', '000.000.000-00', '00.000.000.0', 'MG', 'Belo Horizonte', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104924725a084938ab85f.jpg', '/assets/img/usuario/15104924725a084938aab95.jpg', 92, 'Bebidas', NULL, '', NULL, '', '', 'Destilados com os melhores preços', 0, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'Festas479b8d', 'https://www.youtube.com/channel/', '', '', 'festasbebidasbh', '', '', '', '2017-11-12 13:11:08', 'baco', '', '2017-11-12', 60, 3, 0),
(101, 'Bebidas BH delivery', 'emailexemplo034@outlook.com', 'bhdelivery01', '000.000.000-00', '00.000.000.0', 'MG', 'Belo Horizonte', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104928375a084aa56e54f.jpg', '/assets/img/usuario/15104928375a084aa56d845.jpg', 92, 'Bebidas', NULL, '', NULL, '', 'A Bebidas BH Delivery é uma distribuidora de bebidas que está há cinco anos no mercado.Nossos clientes são muito importantes e isso reflete em nossa missão,visão e valores.Temos como missão, a comercialização de bebidas de alta qualidade e preços acessíveis.', 'DELIVERY P/ TODO BRASIL ', 0, NULL, 0, '(31)9 9577-7281', '', '(31) 2527-1007', 'suporte@bebidasbhdelivery.com.br', 'Bebidas33a1cf', 'https://www.youtube.com/channel/', '', '', 'bebidasbhdelivery', '', '', 'http://www.bebidasbhdelivery.com.br', '2017-11-12 13:17:39', 'baco', '', '2017-11-12', 60, 3, 0),
(102, 'Gelo Alpha', 'emailexemplo035@outlook.com', 'galpha01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104933485a084ca4d3aa2.jpg', NULL, 94, 'Bebidas', 93, 'Bebidas', NULL, '', '', 'Bebidas, gelo e carvão na Piedade e adjacências!', 2, NULL, 0, '(21)9 6465-0858', '(21)9 6463-6006', '(21) 3296-4128', 'distribuidora.alpha@yahoo.com.br', 'Gelo1bc7e2', 'https://www.youtube.com/channel/', '', '', 'alphagelo', '', '', '', '2017-11-12 13:26:34', 'baco', '', '2017-11-12', 60, 3, 0),
(103, 'Deposito de Bebida Gelo Expresso', 'emailexemplo036@outlook.com', 'dbgeloe01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104937025a084e06e34a5.jpg', '/assets/img/usuario/15104937025a084e06e1f03.jpg', 93, 'Bebidas', 94, 'Bebidas', 66, 'Estruturas', '', 'DEPOSITO DE GELO', 2, NULL, 0, '(21)9 8190-9979', '', '(21) 3909-3925', 'geloexpresso@hotmail.com', 'Depositocdd523', 'https://www.youtube.com/channel/', '', '', 'GeloExpresso', '', '', '', '2017-11-12 13:31:28', 'baco', '', '2017-11-12', 60, 3, 0),
(104, 'VAM transporte', 'emailexemplo037@outlook.com', 'vamtrj01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104941445a084fc0ddf58.jpg', '/assets/img/usuario/15104941445a084fc0dd898.jpg', 75, 'Transporte', NULL, '', NULL, '', 'A VAM Transportes está há 10 anos trabalhando com aluguel de vans e carros executivos.\r\n\r\nAluguel de vans de luxo com toda segurança e conforto, oferecendo um serviço de qualidade em todo Rio de Janeiro.', ' VAM Transportes - Aluguel de Van RJ', 2, NULL, 0, '(21)9 9918-3333', '(21)9 9712-7332', '', 'vamtransportesinfo@gmail.com', 'VAMf32b4c', 'https://www.youtube.com/channel/', '', '', 'Vamtransportes', '', '', 'http://www.vamtransportes.com', '2017-11-12 13:40:27', 'baco', '', '2017-11-12', 60, 3, 0),
(105, 'Transporte Flores', 'emailexemplo038@outlook.com', 'flores01', '000.000.000-00', '00.000.000.0', 'RJ', 'São João de Meriti', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104945475a0851530b87c.jpg', '/assets/img/usuario/15104945475a08515308f89.jpg', 77, 'Transporte', NULL, '', NULL, '', 'Fundada em 1957, a empresa começou sua operação fazendo a linha São João X Caxias (via Matadouro), em novembro de 1959. Foi nesta época que a garagem foi transferida para São João de Meriti, o que ajudou a alavancar o crescimento da cidade. A garagem ficava no Parque Araruama.', 'Prestamos serviço de transporte coletivo de passageiros e opera nos municípios de São João de Meriti, Nilópolis, Duque de Caxias, Mesquita, Nova Iguaçu, Belford Roxo e Rio de Janeiro.', 2, NULL, 0, '(00)0 0000-0000', '', '(21) 2755-9200', 'empresadetransportesflores@gmail.com', 'Transporte479c58', 'https://www.youtube.com/channel/', '', '', 'FloresTransportes', '', '', 'http://www.transportesflores.com.br', '2017-11-12 13:45:54', 'baco', '', '2017-11-12', 60, 3, 0),
(106, 'Jeferson Promoter', 'emailexemplo039@outlook.com', 'jpromoter01', '000.000.000-00', '00.000.000.0', 'RJ', 'São João de Meriti', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104949575a0852ed63a1b.jpg', '/assets/img/usuario/15104949575a0852ed6290f.jpg', 97, 'Divulgação', 105, 'Audiovisual', 107, 'Audiovisual', 'Produtor de Eventos, Artístico e Cultural, colunista da Revista Eletrônica JP Eventos.\r\nImplementador e Supervisor na Secretaria de Educação, Cultura, Esporte e Lazer da Prefeitura da Cidade de São João de Meriti.', 'Apresentador, Promotor e Produtor de Eventos, Artístico e Cultural. Repórter fotográfico do site Midianinja e colunista do Jornal da Baixada.', 2, NULL, 0, '(21)9 9201-3025', '', '', 'jefersonsantos_16@hotmail.com', 'Jeferson0c2de7', 'https://www.youtube.com/channel/', '', '', 'jefersonpromoteroficial', '', '', 'http://www.jefersonpromoter.tk', '2017-11-12 13:52:26', 'baco', '', '2017-11-12', 60, 3, 0),
(107, 'Vando buffet', 'emailexemplo040@outlook.com', 'vbuffet01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15104962605a085804b1387.jpg', '/assets/img/usuario/15104973745a085c5e49343.jpg', 118, 'Comidas', 108, 'Audiovisual', 107, 'Audiovisual', 'Deixe a sua preocupação por nossa conta.\r\nNossa missão é apresentar as melhores alternativas para a realização do seu evento.\r\nGerenciamos todas as etapas, possibilitando assim a tranquilidade que você merece.\r\nRealizamos Casamentos, Bodas,Aniversários,Confraternizações, Coquetéis e Eventos em geral.', 'Cuidamos de todos os detalhes antes,durante e após o seu evento!!', 2, NULL, 0, '(21)9 8599-4989', '(21)9 8076-8187', '(21) 2440-1736', 'emaildecontato@outlook.com', 'Vando12441a', 'https://www.youtube.com/channel/', '', '', 'vando.buffet', '', '', 'http://vandobuffet.no.comunidades.net/', '2017-11-12 14:12:18', 'baco', '', '2017-11-12', 60, 3, 0),
(108, 'lupin', 'emailexemplo041@outlook.com', 'djlupin01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15105857445a09b5901eabe.jpg', '/assets/img/usuario/15105857445a09b5901751c.jpg', 108, 'Audiovisual', NULL, '', NULL, '', '', 'DJ/Produtor Cultural na noite alternativa carioca. Funk, trap, favela bass, edm, pop, hits e nostalgias.', 13, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'lupin21cdd9', 'https://www.youtube.com/channel/', '', 'lobolupin', 'lobolupin', '', '', 'soundclound.com/lobolupin', '2017-11-13 15:06:52', 'baco', '', '2017-11-13', 60, 3, 0),
(109, 'Jeziel', 'jezielmedeiros@gmail.com', 'tubarao10', NULL, NULL, NULL, NULL, '0000-00-00', '', 2, 0, '0000-00-00', 0, '', NULL, NULL, '', NULL, '', NULL, '', '', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 'Jezielcc5e8c', NULL, NULL, NULL, NULL, '', NULL, '', '2017-11-13 17:09:11', 'baco', 'log', '2017-11-14', 60, 3, 0),
(111, 'Elecktra Casting', 'elecktracastingrj@gmail.com', 'elecktra1', '058.538.557-27', '20.547.478.6', 'RJ', 'Rio de Janeiro', '1987-02-05', 'o', 3, 2, '0000-00-00', 26, '/assets/img/usuario/15106148415a0a27398533b.jpg', NULL, 100, 'Divulgação', 118, 'Comidas', 57, 'Staff', '•Somos uma agencia completa e dinâmica que prioriza o tempo do nosso cliente para que seu evento seja realizado com sucesso e em pouco tempo. \r\n •Projetamos, implementamos e executamos soluções em eventos customizadas. \r\n •Conduzimos, idealizamos e realizamos eventos em todo Brasil com Casting de qualidade e o melhor preço do mercado. \r\n •Garantimos rapidez, controle, eficiência e qualidade em todas as etapas do seu evento com o melhor custo beneficio pois o mesmo time de profissionais é responsável por todas as etapas do projeto do inicio ao fim: planejamento, desenvolvimento, coordenação e realização. \r\n. •Entregamos insights diferenciados e informações precisas e relevantes sempre dentro do prazo. \r\n ', '', 48, 4.6, 1, '(21)9 6011-1336', '(21)9 6016-7640', '', 'parcerias@elecktracasting.com.br', 'Elecktrabf3dc0', 'https://www.youtube.com/channel/', '', 'elecktracasting', 'ElecktraCasting', '', '', 'www.elecktracasting.com.br', '2017-11-13 22:58:39', 'baco', 'log', '2017-11-13', 60, 3, 0),
(126, 'Jimmy Carlos B', 'emailexemplo042@outlook.com', 'jimmycb01', '000.000.000-00', '00.000.000.0', 'RJ', 'Rio de Janeiro', '0000-00-00', '', 3, 2, '0000-00-00', 28, '/assets/img/usuario/15107798465a0cabc62e89e.jpg', '/assets/img/usuario/15107798465a0cabc62d967.jpg', 108, 'Audiovisual', NULL, '', NULL, '', 'Dj Music Composition Production / Residente Boate Buxixo Up/Dj Aloha Formandos /Booking Artist : Agencia (Db Live Agency) ', 'DJ', 2, NULL, 0, '(21)9 8327-9357', '', '', 'emaildecontato@outlook.com', 'Jimmy7979d2', 'https://www.youtube.com/channel/', '', 'jimmyoficial02', 'jimmy.c.borges', '', '', '', '2017-11-15 21:00:32', 'baco', '', '2017-11-15', 60, 3, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario_continue`
--

CREATE TABLE IF NOT EXISTS `usuario_continue` (
  `id_usu_continue` int(11) NOT NULL,
  `id_fk_usu_continue` int(11) NOT NULL,
  `soundcloud` varchar(400) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `usuario_continue`
--

INSERT INTO `usuario_continue` (`id_usu_continue`, `id_fk_usu_continue`, `soundcloud`) VALUES
(4, 52, ''),
(5, 53, ''),
(6, 54, ''),
(7, 55, ''),
(8, 56, ''),
(9, 57, ''),
(10, 58, ''),
(11, 59, ''),
(12, 60, ''),
(13, 61, ''),
(14, 63, ''),
(15, 74, ''),
(16, 75, ''),
(17, 76, ''),
(18, 77, ''),
(19, 78, ''),
(20, 79, ''),
(21, 80, ''),
(22, 81, ''),
(23, 82, ''),
(24, 83, ''),
(25, 84, ''),
(26, 85, '1275998'),
(27, 86, ''),
(28, 87, ''),
(29, 88, ''),
(30, 89, ''),
(31, 90, ''),
(32, 91, ''),
(33, 92, ''),
(34, 93, ''),
(35, 94, ''),
(36, 95, ''),
(37, 96, ''),
(38, 97, ''),
(39, 98, ''),
(40, 99, ''),
(41, 100, ''),
(42, 101, ''),
(43, 102, ''),
(44, 103, ''),
(45, 104, ''),
(46, 105, ''),
(47, 106, ''),
(48, 107, ''),
(49, 108, ''),
(50, 109, ''),
(51, 111, ''),
(55, 126, '308269442');

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
-- Índices de tabela `notificacao`
--
ALTER TABLE `notificacao`
  ADD PRIMARY KEY (`id_noti`);

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
-- Índices de tabela `usuario_continue`
--
ALTER TABLE `usuario_continue`
  ADD PRIMARY KEY (`id_usu_continue`), ADD KEY `id_fk_usu_continue` (`id_fk_usu_continue`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=133;
--
-- AUTO_INCREMENT de tabela `contador`
--
ALTER TABLE `contador`
  MODIFY `id_cont` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id_favoritos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=712;
--
-- AUTO_INCREMENT de tabela `notificacao`
--
ALTER TABLE `notificacao`
  MODIFY `id_noti` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=462;
--
-- AUTO_INCREMENT de tabela `propaganda`
--
ALTER TABLE `propaganda`
  MODIFY `id_propaganda` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT de tabela `publicacao`
--
ALTER TABLE `publicacao`
  MODIFY `id_publicacao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `token`
--
ALTER TABLE `token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=749;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT de tabela `usuario_continue`
--
ALTER TABLE `usuario_continue`
  MODIFY `id_usu_continue` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
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
ADD CONSTRAINT `id_fk_usu` FOREIGN KEY (`id_fk_usu`) REFERENCES `usuario` (`id_usu`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `id_fk_cliente` FOREIGN KEY (`id_fk_cliente`) REFERENCES `usuario` (`id_usu`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `fk_categoria1_usu` FOREIGN KEY (`fk_categoria1_usu`) REFERENCES `categoria` (`id_categoria`) ON DELETE SET NULL,
ADD CONSTRAINT `fk_categoria2_usu` FOREIGN KEY (`fk_categoria2_usu`) REFERENCES `categoria` (`id_categoria`) ON DELETE SET NULL,
ADD CONSTRAINT `fk_categoria3_usu` FOREIGN KEY (`fk_categoria3_usu`) REFERENCES `categoria` (`id_categoria`) ON DELETE SET NULL;

--
-- Restrições para tabelas `usuario_continue`
--
ALTER TABLE `usuario_continue`
ADD CONSTRAINT `id_fk_usu_continue` FOREIGN KEY (`id_fk_usu_continue`) REFERENCES `usuario` (`id_usu`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
