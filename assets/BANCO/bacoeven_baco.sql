-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 15/10/2017 às 01:16
-- Versão do servidor: 5.5.51-38.2
-- Versão do PHP: 5.6.20

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
  `nome_categoria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nome_sub_categoria` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome_categoria`, `nome_sub_categoria`) VALUES
(28, 'Audiovisual', 'Sonorização'),
(29, 'Audiovisual', 'Iluminação'),
(30, 'Audiovisual', 'Telão / Televisões / Painés de Led'),
(31, 'Audiovisual', 'Filmagem'),
(32, 'Audiovisual', 'DJ'),
(33, 'Audiovisual', 'Técnico de áudio'),
(34, 'Audiovisual', 'Técnico de iluminação'),
(35, 'Audiovisual', 'Roadie'),
(36, 'Audiovisual', 'Outros'),
(37, 'Bandas / Grupos', 'Rock'),
(38, 'Bandas / Grupos', 'Sertanejo'),
(39, 'Bandas / Grupos', 'Pagode'),
(40, 'Bandas / Grupos', 'Samba'),
(41, 'Bandas / Grupos', 'MPB'),
(42, 'Bandas / Grupos', 'Música Portuguesa'),
(43, 'Bandas / Grupos', 'Músicas Judaicas'),
(44, 'Bandas / Grupos', 'Banda de Casamento'),
(45, 'Bandas / Grupos', 'Anos 70, 80, 90'),
(46, 'Bandas / Grupos', 'Dança de Salão'),
(47, 'Bandas / Grupos', 'Rap Nacional'),
(48, 'Bandas / Grupos', 'MCs'),
(49, 'Bandas / Grupos', 'Outros'),
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
(76, 'Transporte', 'Micrô ónibus'),
(77, 'Transporte', 'Ônibus'),
(78, 'Transporte', 'Fretes'),
(79, 'Transporte', 'Outros');

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
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `propaganda`
--

INSERT INTO `propaganda` (`id_propaganda`, `fk_propaganda_usu`, `imagem_propaganda`, `url_redi`, `localizacao`, `dt_propaganda`) VALUES
(24, 59, 'assets/img/anuncio/img_sli1.jpg', 'https://www.google.com.br', 'index', '2017-10-15 03:14:19'),
(25, 59, 'assets/img/anuncio/img_sli2.jpg', 'https://www.google.com.br', 'index', '2017-10-15 03:14:19'),
(26, 59, 'assets/img/anuncio/img_sli3.jpg', 'https://www.google.com.br', 'index', '2017-10-15 03:14:19'),
(27, 59, 'assets/img/anuncio/img_sli4.jpg', 'https://www.google.com.br', 'index', '2017-10-15 03:14:19'),
(28, 59, 'assets/img/anuncio/img_sli5.jpg', 'https://www.google.com.br', 'index', '2017-10-15 03:14:19');

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
  `fk_token_usu` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `token`
--

INSERT INTO `token` (`id_token`, `fk_token_usu`, `token`) VALUES
(59, 'matheus.me.ngo@hotmail.com', 'dNREQiPUsxA:APA91bEANcALQAVZXhwUWRzFYBiRmX-zgVO4bnAhkuo812mGTlvHbkYLP_8kjtvur7asZ3tksN1_kj6DDsri7e-_K_dj4_Q0525GPS3Tsd3TKdJ32OgfLXVl59k13SeHLA__iKYfP2Wk'),
(70, 'emailexemplo003@outlook.com', 'f2xgJu4dJM8:APA91bEjhDOduzKbZ8xhZf26XqdMYCcq_08tRf45B7aRibIiOekeasK5ahqg_R3KaV43beDavdpTlg8PdTWDUzYCPpo7cIpdtGe7YczuhZ12trHg9ZBepKDpJ8m_feI-fsiXWExA_Ck2');

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
  `foto_perfil` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_capa` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fk_categoria1_usu` int(11) DEFAULT NULL,
  `fk_categoria2_usu` int(11) DEFAULT NULL,
  `fk_categoria3_usu` int(11) DEFAULT NULL,
  `sobre_usu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `n_acesso` int(11) NOT NULL,
  `rating` float DEFAULT NULL,
  `n_rating` int(11) NOT NULL,
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
  `website` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `dt_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `migracao` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `situacao_login` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `noticias` int(1) NOT NULL DEFAULT '3'
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`id_usu`, `nome_completo`, `email_usu`, `senha_usu`, `cpf_usu`, `rg_usu`, `dt_nasc`, `sexo`, `nivel`, `pacote_usu`, `foto_perfil`, `foto_capa`, `fk_categoria1_usu`, `fk_categoria2_usu`, `fk_categoria3_usu`, `sobre_usu`, `descricao`, `n_acesso`, `rating`, `n_rating`, `numero_1`, `numero_2`, `numero_3`, `email_contato`, `url_persona`, `canal_yt`, `canal_playlist`, `conta_insta`, `conta_face`, `skip_albun`, `conta_twitter`, `website`, `dt_criacao`, `migracao`, `situacao_login`, `noticias`) VALUES
(38, 'TestesemFoto', 'blablablakkk@algo.com', 'aosidjaodijao', NULL, NULL, '0000-00-00', '', 2, 0, '', NULL, NULL, NULL, NULL, '', NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, 'TestesemFoto1e985a', 'https://www.youtube.com/channel/UCrKXYE-Y4saxVFPI7Fuuzyw', 'https://www.youtube.com/playlist?list=PLqZOd75stvjdOpGbE0qqMViZCOdcYxs', '', '', '', '', 'https://www.google.com', '2017-10-08 01:52:07', 'baco', '', 1),
(46, 'MatheusChagas', 'matheus.me.ngo@hotmail.com', 'm77777777', 'NULL', 'NULL', '1995-09-28', 'm', 3, 0, '/assets/img/usuario/150757479259dbc408a6a4a.jpg', '/assets/img/usuario/150757479259dbc408a4338.jpg', NULL, NULL, NULL, '', '', 7, 3.4, 1, '', '', '', '', 'MatheusChagas', 'https://www.youtube.com/channel/', '', '', '', 'NULL', '', '', '2017-10-09 18:45:32', 'face', 'log', 3),
(51, 'Douglas Araujo', 'douugd_fs@hotmail.com', '0101Douglas', NULL, NULL, '1996-05-05', 'm', 3, 0, 'https://scontent.xx.fbcdn.net/v/t1.0-1/c3.7.153.153/p160x160/19260491_1334633889965140_7181959734249762565_n.jpg?oh=3a0c2d411935f049e7d9d9f50b2db737&oe=5A813970', NULL, NULL, NULL, NULL, '', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 'Douglas', 'https://www.youtube.com/channel/', '', '', '', '', '', '', '2017-10-14 15:59:46', 'face', '', 3),
(52, 'Grupo Deu liga', 'emailexemplo000@outlook.com', 'bacoeventos123', '000.000.000-00', '00.000.000.0', '0000-00-00', '', 3, 2, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/17265289_604644403066602_132562290491407343_n.jpg?oh=2ecbfbda57bbd1d2dd21d5932982b397&oe=5A6BDC72', '/assets/img/usuario/150803561559e2cc1f3fefb.jpg', 39, NULL, NULL, 'E aí família! Nós somos o Grupo Deu Liga. Contamos com a ajuda de cada amigo nosso nessa grande caminhada. Vem que #JáDeuLigaNeguinho', 'Grupo de pagode - GRUPO DEU LIGA ', 6, NULL, 0, '(21)9 8848-1815', '', '', 'deu_liga@outlook.com', 'GrupoDeuLiga', 'https://www.youtube.com/channel/UCuTiODv82A87hmZmx4ts8Tg/', '', 'deuligaoficial', 'GrupoDeuLiga', '', '', '', '2017-10-14 16:18:08', 'baco', '', 3),
(53, 'Luizzinho Rodrigues', 'emailexemplo001@outlook.com', 'bacoeventos123', '000.000.000-00', '00.000.000.0', '0000-00-00', '', 3, 2, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/22089993_1967608060167060_3549983441620803513_n.png?oh=c10b82912a11c3fd61fd92397154dca2&oe=5A698029', '/assets/img/usuario/150803570859e2cc7cbb502.jpg', 39, NULL, NULL, 'Cantor de Samba e Pagode do Rio de Janeiro.', 'Sensação do Samba carioca', 1, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'luizinhoVPC', 'https://www.youtube.com/channel/', '', '', 'luizinhoVPC', '', '', 'http://www.luizzinhorodrigues.com.br', '2017-10-14 19:32:20', 'baco', '', 3),
(54, 'Thiago Mendonça', 'emailexemplo002@outlook.com', 'bacoeventos123', '000.000.000-00', '00.000.000.0', '0000-00-00', '', 3, 2, '/assets/img/usuario/150803302459e2c200ea278.jpg', '/assets/img/usuario/150803577859e2ccc28c7b6.jpg', 32, NULL, NULL, '', 'Dj pelo RIO DE JANEIRO', 0, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'ThiagoDJBS', 'https://www.youtube.com/channel/', '', '', '', '', '', '', '2017-10-14 23:26:25', 'baco', '', 3),
(55, 'Inusitados', 'emailexemplo003@outlook.com', 'bacoeventos123', '000.000.000-00', '00.000.000.0', '0000-00-00', '', 3, 2, 'https://scontent.fsdu7-1.fna.fbcdn.net/v/t1.0-9/15027982_1804329303147801_7376006657709162944_n.jpg?_nc_eui2=v1%3AAeEbR3OzNIQb_Nu9TP0MR-1vYhmjPagdK9Z406S-aIrrsiaBOnXUmqqxV_35W9yh5ePvX65QELIeL4bflsaaOE61uIy2Nkm-EsA0a6BfmV1UZA&oh=98c311cf6429df888ffb5611e2f5861e&oe=5A6E7A60', '/assets/img/usuario/150803585559e2cd0f2a25e.jpg', 39, NULL, NULL, 'Sabe aquela história de ''''fazer um som lá em casa'''',? Pois é, tudo começou assim, nos juntávamos para estudar nossos respectivos instrumentos, tocar juntos aquelas músicas que gostávamos e isso se repetia por diversas vezes na semana.\r\n\r\nA maioria das bandas tem uma história parecida, e não foi diferente com a gente, rapaziada natural do Rio de Janeiro, corpo e alma carioca influenciados por diversos gêneros e estilos musicais, por nossos pais, irmãos e tios músicos.\r\n\r\nComeçou com um grupo de pessoas mais chegadas em uma festa pra lá de animada, na casa dos integrantes, amigos e familiares.\r\nDaí a brincadeira cresceu, tomou corpo, e o que era apenas se juntar pra tocar despretensiosamente, foi ficando cada vez mais sério, quando fomos ver já tínhamos um repertório.\r\n\r\nConvidamos mais e mais amigos, depois músicos, e logo um deles disse que tínhamos futuro e que nos ajudaria.\r\n\r\nCom o sucesso entre amigos, a brincadeira ficou séria resultando no mais novo e diferenciado grupo os Inusitados.\r\n\r\nApesar da pouca idade dos seus integrantes, o grupo vem chamando atenção por onde passa, trata-se de jovens nascidos do berço artístico do samba, rock, pop e gospel. E por isso se sentem a vontade em misturar todos esses gêneros musicais e com novas idéias tentar buscar um som de qualidade. \r\n\r\nEstudiosos da música, dedicados e com objetivo de mostrar qualidade, competência musical e principalmente respeito ao público, com um repertório diversificado e atual.', 'Bem-vindos à nossa página Oficial!  Nem melhor, nem pior, apenas "INUSITADOS"  Segura o balanço.', 0, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'InusitadosOficial', 'https://www.youtube.com/channel/', '', 'inusitadosoficial', 'inusitadosoficial', '', '', '', '2017-10-15 02:06:33', 'baco', '', 3),
(56, 'Daniel Conceição', 'emailexemplo004@outlook.com', 'bacoeventos123', '000.000.000-00', '00.000.000.0', '0000-00-00', '', 3, 2, '/assets/img/usuario/150803529459e2caded4354.jpg', '/assets/img/usuario/150803529459e2caded3109.jpg', 31, NULL, NULL, '', 'Daniel Fotográfia', 0, NULL, 0, '(00)0 0000-0000', '', '', 'emaildecontato@outlook.com', 'DannFoto', 'https://www.youtube.com/channel/', '', 'dannfotografia', '', '', '', '', '2017-10-15 02:16:32', 'baco', '', 3),
(57, 'Passo à frente', 'emailexemplo005@outlook.com', 'bacoeventos123', '000.000.000-00', '00.000.000.0', '0000-00-00', '', 3, 2, '/assets/img/usuario/150803612659e2ce1ea95b6.jpg', '/assets/img/usuario/150803612659e2ce1ea90a3.jpg', 47, NULL, NULL, 'Projeto de rap voltado para a batida clássica do boom bap,original golden era. Vem com letras incisivas,ácidas e conteúdo baseado na vivência de seus integrantes Dieguin ALD''BAS e OMA CACO, crias da zona norte do Rio de Janeiro. Contam com a sagacidade,bagagem e maestria de um dos melhores beatmakers e produtores do cenário hip-hop do Brasil: Goribeatzz!!!', '"Um passo à frente e você não está mais no mesmo lugar" Chico Science', 0, NULL, 0, '(21)9 7178-7253', '(21)9 8342-4806', '', 'emaildecontato@outlook.com', 'PassoAFrente', 'https://www.youtube.com/channel/UC6TkCHREmZa8EekQOQUxKIQ/', '', 'passoafrenterap', 'PassoaFrente', '', '', '', '2017-10-15 02:53:40', 'baco', '', 3),
(58, 'Igor Cursino Sardinha', 'emailexemplo006@outlook.com', 'bacoeventos123', 'NULL', 'NULL', '0000-00-00', '', 3, 0, '/assets/img/usuario/150803683059e2d0de40f4f.jpg', '/assets/img/usuario/150803683059e2d0de3ff7a.jpg', NULL, NULL, NULL, '', 'DJ Igor ', 0, NULL, 0, '', '', '', '', 'djigorsardinha', 'https://www.youtube.com/channel/', '', '', '', '', '', '', '2017-10-15 03:04:35', 'baco', '', 3),
(59, 'Troia Tecnologia', 'troiatecnologia@gmail.com', 'troiaebaco123', NULL, NULL, '0000-00-00', '', 2, 0, '', NULL, NULL, NULL, NULL, '', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 'Troia634050', NULL, NULL, NULL, NULL, '', NULL, '', '2017-10-15 03:11:25', 'baco', 'log', 3);

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
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT de tabela `contador`
--
ALTER TABLE `contador`
  MODIFY `id_cont` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id_favoritos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=215;
--
-- AUTO_INCREMENT de tabela `propaganda`
--
ALTER TABLE `propaganda`
  MODIFY `id_propaganda` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de tabela `publicacao`
--
ALTER TABLE `publicacao`
  MODIFY `id_publicacao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `token`
--
ALTER TABLE `token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
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
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `fk_categoria1_usu` FOREIGN KEY (`fk_categoria1_usu`) REFERENCES `categoria` (`id_categoria`) ON DELETE SET NULL,
ADD CONSTRAINT `fk_categoria2_usu` FOREIGN KEY (`fk_categoria2_usu`) REFERENCES `categoria` (`id_categoria`) ON DELETE SET NULL,
ADD CONSTRAINT `fk_categoria3_usu` FOREIGN KEY (`fk_categoria3_usu`) REFERENCES `categoria` (`id_categoria`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
