CREATE DATABASE  IF NOT EXISTS `cimol2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cimol2`;
-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: cimol2
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrador` (
  `pessoa_id` int(10) unsigned NOT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`pessoa_id`),
  KEY `fk_administrador_pessoa1_idx` (`pessoa_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `agenda`
--

DROP TABLE IF EXISTS `agenda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agenda` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `descricao` text NOT NULL,
  `segmento_id` int(10) unsigned DEFAULT NULL,
  `curso_id` int(10) unsigned DEFAULT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  `evento` varchar(60) NOT NULL,
  `visibilidade` enum('geral','aluno','professor') NOT NULL DEFAULT 'geral',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_agenda_1_idx` (`curso_id`),
  KEY `fk_agenda_2_idx` (`segmento_id`),
  CONSTRAINT `fk_agenda_1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_agenda_2` FOREIGN KEY (`segmento_id`) REFERENCES `segmento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aluno`
--

DROP TABLE IF EXISTS `aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aluno` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  `pessoa_id` int(10) unsigned NOT NULL,
  `situacao` enum('matriculado','transferido') NOT NULL DEFAULT 'matriculado',
  `id_mec` varchar(20) DEFAULT NULL,
  `periodo` enum('1','2','3','4','5','6') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idaluno_UNIQUE` (`id`),
  KEY `fk_aluno_pessoa1_idx` (`pessoa_id`),
  CONSTRAINT `fk_aluno_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aluno_turma`
--

DROP TABLE IF EXISTS `aluno_turma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aluno_turma` (
  `aluno_id` int(10) unsigned NOT NULL,
  `turma_id` int(11) NOT NULL,
  PRIMARY KEY (`aluno_id`,`turma_id`),
  KEY `fk_aluno_has_turma_turma1_idx` (`turma_id`),
  KEY `fk_aluno_has_turma_aluno1_idx` (`aluno_id`),
  CONSTRAINT `fk_aluno_has_turma_aluno1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_aluno_has_turma_turma1` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `armario`
--

DROP TABLE IF EXISTS `armario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `armario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(45) NOT NULL,
  `curso_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_armario_curso1_idx` (`curso_id`),
  CONSTRAINT `fk_armario_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `armario_aluno`
--

DROP TABLE IF EXISTS `armario_aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `armario_aluno` (
  `armario_id` int(10) unsigned NOT NULL,
  `aluno_id` int(10) unsigned NOT NULL,
  `semestre` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  PRIMARY KEY (`armario_id`,`aluno_id`),
  KEY `fk_armario_has_aluno_aluno1_idx` (`aluno_id`),
  KEY `fk_armario_has_aluno_armario1_idx` (`armario_id`),
  CONSTRAINT `fk_armario_has_aluno_aluno1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_armario_has_aluno_armario1` FOREIGN KEY (`armario_id`) REFERENCES `armario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `arquivo`
--

DROP TABLE IF EXISTS `arquivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arquivo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `url_arquivo` varchar(90) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `descricao` varchar(90) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idarquivo_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=358 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aula`
--

DROP TABLE IF EXISTS `aula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aula` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banner` (
  `banner` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(60) NOT NULL,
  `descricao` text,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`banner`),
  UNIQUE KEY `banner_UNIQUE` (`banner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `biblioteca`
--

DROP TABLE IF EXISTS `biblioteca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biblioteca` (
  `pessoa_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pessoa_id`),
  CONSTRAINT `fk_biblioteca_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `biblioteca_autor`
--

DROP TABLE IF EXISTS `biblioteca_autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biblioteca_autor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `biblioteca_autor_obra`
--

DROP TABLE IF EXISTS `biblioteca_autor_obra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biblioteca_autor_obra` (
  `autor_id` int(10) unsigned NOT NULL,
  `Obra_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`autor_id`,`Obra_id`),
  KEY `fk_autor_has_Obra_Obra1_idx` (`Obra_id`),
  KEY `fk_autor_has_Obra_autor1_idx` (`autor_id`),
  CONSTRAINT `fk_autor_has_Obra_autor1` FOREIGN KEY (`autor_id`) REFERENCES `biblioteca_autor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_autor_has_Obra_Obra1` FOREIGN KEY (`Obra_id`) REFERENCES `biblioteca_obra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `biblioteca_categoria`
--

DROP TABLE IF EXISTS `biblioteca_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biblioteca_categoria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `categoria_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_categoria_categoria_idx` (`categoria_id`),
  CONSTRAINT `fk_categoria_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `biblioteca_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=ascii;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `biblioteca_editora`
--

DROP TABLE IF EXISTS `biblioteca_editora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biblioteca_editora` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `biblioteca_emprestimo`
--

DROP TABLE IF EXISTS `biblioteca_emprestimo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biblioteca_emprestimo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_emprestimo` date NOT NULL,
  `data_prev_dev` date NOT NULL,
  `data_dev` date DEFAULT NULL,
  `num_renov` int(11) NOT NULL DEFAULT '0',
  `obra_id` int(10) unsigned NOT NULL,
  `pessoa_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_emprestimo_obra1_idx` (`obra_id`),
  KEY `fk_biblioteca_emprestimo_pessoa1_idx` (`pessoa_id`),
  CONSTRAINT `fk_biblioteca_emprestimo_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_emprestimo_obra1` FOREIGN KEY (`obra_id`) REFERENCES `biblioteca_obra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `biblioteca_obra`
--

DROP TABLE IF EXISTS `biblioteca_obra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biblioteca_obra` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(60) NOT NULL,
  `resumo` varchar(140) DEFAULT NULL,
  `edicao` decimal(10,0) DEFAULT NULL,
  `isbn` varchar(60) DEFAULT NULL,
  `categoria_id` int(10) unsigned NOT NULL,
  `editora_id` int(10) unsigned NOT NULL,
  `quantidade` int(11) NOT NULL,
  `locacao` tinyint(1) DEFAULT NULL,
  `formato` enum('fisico','eletronico') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Obra_categoria1_idx` (`categoria_id`),
  KEY `fk_Obra_editora1_idx` (`editora_id`),
  CONSTRAINT `fk_Obra_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `biblioteca_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Obra_editora1` FOREIGN KEY (`editora_id`) REFERENCES `biblioteca_editora` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `biblioteca_obra_eletronica`
--

DROP TABLE IF EXISTS `biblioteca_obra_eletronica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biblioteca_obra_eletronica` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url_caminho` varchar(45) NOT NULL,
  `obra_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_biblioteca_obra_digiital_biblioteca_obra1_idx` (`obra_id`),
  CONSTRAINT `fk_biblioteca_obra_digiital_biblioteca_obra1` FOREIGN KEY (`obra_id`) REFERENCES `biblioteca_obra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `biblioteca_reserva`
--

DROP TABLE IF EXISTS `biblioteca_reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biblioteca_reserva` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_reserv` date DEFAULT NULL,
  `obra_id` int(10) unsigned NOT NULL,
  `pessoa_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_reserva_obra1_idx` (`obra_id`),
  KEY `fk_biblioteca_reserva_pessoa1_idx` (`pessoa_id`),
  CONSTRAINT `fk_biblioteca_reserva_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_obra1` FOREIGN KEY (`obra_id`) REFERENCES `biblioteca_obra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `coordenador_curso`
--

DROP TABLE IF EXISTS `coordenador_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coordenador_curso` (
  `professor_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `curso_id` int(10) unsigned NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  `ip` varchar(20) NOT NULL,
  `usuario_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`professor_id`,`curso_id`),
  KEY `fk_professor_has_curso_curso1_idx` (`curso_id`),
  KEY `fk_professor_has_curso_professor1_idx` (`professor_id`),
  KEY `fk_coordenador_curso_1_idx` (`usuario_id`),
  CONSTRAINT `fk_coordenador_curso_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_professor_has_curso_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_professor_has_curso_professor1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `coordenador_nucleo`
--

DROP TABLE IF EXISTS `coordenador_nucleo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coordenador_nucleo` (
  `professor_id` int(10) unsigned NOT NULL,
  `nucleo_id` int(10) unsigned NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`professor_id`,`nucleo_id`),
  KEY `fk_professor_has_nucleo_nucleo1_idx` (`nucleo_id`),
  KEY `fk_professor_has_nucleo_professor1_idx` (`professor_id`),
  CONSTRAINT `fk_professor_has_nucleo_nucleo1` FOREIGN KEY (`nucleo_id`) REFERENCES `nucleo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_professor_has_nucleo_professor1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `curso` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `descricao` text,
  `ip` varchar(20) NOT NULL,
  `usuario_id` int(10) unsigned NOT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'inativo',
  `logo` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_curso_1_idx` (`usuario_id`),
  CONSTRAINT `fk_curso_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disciplina` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(60) NOT NULL,
  `ementa` text NOT NULL,
  `carga_horaria` int(11) NOT NULL,
  `segmento_curso_segmento_id` int(10) unsigned NOT NULL,
  `segmento_curso_curso_id` int(10) unsigned NOT NULL,
  `periodo` int(11) NOT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_disciplina_segmento_curso1_idx` (`segmento_curso_segmento_id`,`segmento_curso_curso_id`),
  CONSTRAINT `fk_disciplina_segmento_curso1` FOREIGN KEY (`segmento_curso_segmento_id`, `segmento_curso_curso_id`) REFERENCES `segmento_curso` (`segmento_id`, `curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `disciplina_turma`
--

DROP TABLE IF EXISTS `disciplina_turma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disciplina_turma` (
  `disciplina_id` int(10) unsigned NOT NULL,
  `turma_id` int(11) unsigned NOT NULL,
  `professor_id` int(10) NOT NULL,
  `status` enum('ativo','inativo') NOT NULL,
  `dia` enum('seg','ter','qua','qui','sex','sab','dom') DEFAULT NULL,
  `sala_id` int(10) unsigned NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`,`professor_id`,`turma_id`,`disciplina_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_disciplina_has_turma_turma1_idx` (`turma_id`),
  KEY `fk_disciplina_has_turma_disciplina1_idx` (`disciplina_id`),
  KEY `fk_disciplina_turma_professor1_idx` (`professor_id`),
  KEY `fk_disciplina_turma_1_idx` (`sala_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `disciplina_turma_periodo`
--

DROP TABLE IF EXISTS `disciplina_turma_periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disciplina_turma_periodo` (
  `periodo_id` int(10) unsigned NOT NULL,
  `disciplina_turma_id` int(10) unsigned NOT NULL,
  KEY `fk_disciplina_turma_periodo_2_idx1` (`periodo_id`),
  CONSTRAINT `fk_disciplina_turma_periodo_2` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `edicao_evento`
--

DROP TABLE IF EXISTS `edicao_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edicao_evento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `edicao` varchar(10) NOT NULL,
  `slogan` text,
  `data_inicial` date NOT NULL,
  `data_final` date NOT NULL,
  `evento_id` int(10) unsigned NOT NULL,
  `imagem_id` int(10) unsigned NOT NULL,
  `status` enum('ativo','inativo') DEFAULT 'ativo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_edicao_evento_evento1_idx` (`evento_id`),
  KEY `fk_edicao_evento_imagem1_idx` (`imagem_id`),
  CONSTRAINT `fk_edicao_evento_evento1` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_edicao_evento_imagem1` FOREIGN KEY (`imagem_id`) REFERENCES `imagem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(45) DEFAULT NULL,
  `pessoa_id` int(10) unsigned NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_table1_pessoa1_idx` (`pessoa_id`),
  CONSTRAINT `fk_table1_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco` (
  `id` int(11) NOT NULL,
  `logradouro` varchar(60) DEFAULT NULL,
  `tipo` enum('av','rua','rod','beco','alam','serv') DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `complemento` varchar(60) DEFAULT NULL,
  `bairro` varchar(60) DEFAULT NULL,
  `pessoa_id` int(10) unsigned NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_endereco_pessoa1_idx` (`pessoa_id`),
  CONSTRAINT `fk_endereco_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `descricao` text,
  `imagem_id` int(10) unsigned NOT NULL,
  `status` enum('ativo','inativo') NOT NULL,
  `resumo` varchar(180) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_evento_imagem1_idx` (`imagem_id`),
  CONSTRAINT `fk_evento_imagem1` FOREIGN KEY (`imagem_id`) REFERENCES `imagem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `feintec`
--

DROP TABLE IF EXISTS `feintec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feintec` (
  `pessoa_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pessoa_id`),
  CONSTRAINT `fk_feintec_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin2;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `feintec_aluno_projeto`
--

DROP TABLE IF EXISTS `feintec_aluno_projeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feintec_aluno_projeto` (
  `aluno_pessoa_id` int(10) unsigned NOT NULL,
  `projeto_id` int(11) NOT NULL,
  PRIMARY KEY (`aluno_pessoa_id`,`projeto_id`),
  KEY `fk_aluno_has_projeto_projeto1_idx` (`projeto_id`),
  KEY `fk_aluno_has_projeto_aluno1_idx` (`aluno_pessoa_id`),
  CONSTRAINT `fk_aluno_has_projeto_aluno1` FOREIGN KEY (`aluno_pessoa_id`) REFERENCES `app_feintec`.`aluno` (`pessoa_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_aluno_has_projeto_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `app_feintec`.`feintec_projeto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `feintec_avaliador`
--

DROP TABLE IF EXISTS `feintec_avaliador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feintec_avaliador` (
  `pessoa_id` int(10) unsigned NOT NULL,
  `edicao_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pessoa_id`),
  KEY `fk_feintec_avaliador_edicao1_idx` (`edicao_id`),
  CONSTRAINT `fk_avaliador_pessoa` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_feintec_avaliador_edicao1` FOREIGN KEY (`edicao_id`) REFERENCES `edicao_evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `feintec_avaliador_projeto`
--

DROP TABLE IF EXISTS `feintec_avaliador_projeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feintec_avaliador_projeto` (
  `avaliador_pessoa_id` int(10) unsigned NOT NULL,
  `projeto_id` int(10) unsigned NOT NULL,
  `observacoes` text,
  PRIMARY KEY (`avaliador_pessoa_id`,`projeto_id`),
  KEY `fk_avaliador_has_projeto_projeto1_idx` (`projeto_id`),
  KEY `fk_avaliador_has_projeto_avaliador1_idx` (`avaliador_pessoa_id`),
  CONSTRAINT `fk_avaliador_has_projeto_avaliador1` FOREIGN KEY (`avaliador_pessoa_id`) REFERENCES `feintec_avaliador` (`pessoa_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_avaliador_has_projeto_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `feintec_projeto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `feintec_eixo`
--

DROP TABLE IF EXISTS `feintec_eixo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feintec_eixo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `descricao` varchar(145) DEFAULT NULL,
  `status` enum('ativo','inativo') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `feintec_projeto`
--

DROP TABLE IF EXISTS `feintec_projeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feintec_projeto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `resumo` varchar(45) NOT NULL,
  `edicao_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_feintec_projeto_edicao1_idx` (`edicao_id`),
  CONSTRAINT `fk_feintec_projeto_edicao1` FOREIGN KEY (`edicao_id`) REFERENCES `edicao_evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fentec_eixo_projeto`
--

DROP TABLE IF EXISTS `fentec_eixo_projeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fentec_eixo_projeto` (
  `eixo_id` int(10) unsigned NOT NULL,
  `projeto_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`eixo_id`,`projeto_id`),
  KEY `fk_eixo_has_projeto_projeto1_idx` (`projeto_id`),
  KEY `fk_eixo_has_projeto_eixo1_idx` (`eixo_id`),
  CONSTRAINT `fk_eixo_has_projeto_eixo1` FOREIGN KEY (`eixo_id`) REFERENCES `feintec_eixo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_eixo_has_projeto_projeto1` FOREIGN KEY (`projeto_id`) REFERENCES `feintec_projeto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `historico`
--

DROP TABLE IF EXISTS `historico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historico` (
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tabela` varchar(40) NOT NULL,
  `operacao` varchar(45) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`timestamp`),
  UNIQUE KEY `timestamp_UNIQUE` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `imagem`
--

DROP TABLE IF EXISTS `imagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagem` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `url_imagem` varchar(90) NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idimagem_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=357 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `imagem_banner`
--

DROP TABLE IF EXISTS `imagem_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagem_banner` (
  `imagem_id` int(10) unsigned NOT NULL,
  `banner_banner` int(10) unsigned NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`imagem_id`,`banner_banner`),
  KEY `fk_imagem_has_banner_banner1_idx` (`banner_banner`),
  KEY `fk_imagem_has_banner_imagem1_idx` (`imagem_id`),
  CONSTRAINT `fk_imagem_has_banner_banner1` FOREIGN KEY (`banner_banner`) REFERENCES `banner` (`banner`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_imagem_has_banner_imagem1` FOREIGN KEY (`imagem_id`) REFERENCES `imagem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `imagem_edicao_evento`
--

DROP TABLE IF EXISTS `imagem_edicao_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagem_edicao_evento` (
  `imagem_id` int(10) unsigned NOT NULL,
  `edicao_evento_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`imagem_id`,`edicao_evento_id`),
  KEY `fk_imagem_has_edicao_evento_edicao_evento1_idx` (`edicao_evento_id`),
  KEY `fk_imagem_has_edicao_evento_imagem1_idx` (`imagem_id`),
  CONSTRAINT `fk_imagem_has_edicao_evento_edicao_evento1` FOREIGN KEY (`edicao_evento_id`) REFERENCES `edicao_evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_imagem_has_edicao_evento_imagem1` FOREIGN KEY (`imagem_id`) REFERENCES `imagem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `imagem_noticia`
--

DROP TABLE IF EXISTS `imagem_noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagem_noticia` (
  `imagem_id` int(10) unsigned NOT NULL,
  `noticia_id` int(10) unsigned NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`imagem_id`,`noticia_id`),
  KEY `fk_imagem_has_noticia_noticia1_idx` (`noticia_id`),
  KEY `fk_imagem_has_noticia_imagem1_idx` (`imagem_id`),
  CONSTRAINT `fk_imagem_has_noticia_imagem1` FOREIGN KEY (`imagem_id`) REFERENCES `imagem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_imagem_has_noticia_noticia1` FOREIGN KEY (`noticia_id`) REFERENCES `noticia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `marcador`
--

DROP TABLE IF EXISTS `marcador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marcador` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `marcador` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `marcador_arquivo`
--

DROP TABLE IF EXISTS `marcador_arquivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marcador_arquivo` (
  `marcador_id` int(10) unsigned NOT NULL,
  `arquivo_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`marcador_id`,`arquivo_id`),
  KEY `fk_marcador_arquivo_1_idx` (`arquivo_id`),
  CONSTRAINT `fk_marcador_arquivo_1` FOREIGN KEY (`arquivo_id`) REFERENCES `arquivo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_marcador_arquivo_2` FOREIGN KEY (`marcador_id`) REFERENCES `marcador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `marcador_imagem`
--

DROP TABLE IF EXISTS `marcador_imagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marcador_imagem` (
  `marcador_id` int(10) unsigned NOT NULL,
  `imagem_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`marcador_id`,`imagem_id`),
  KEY `fk_marcador_imagem_1_idx` (`imagem_id`),
  CONSTRAINT `fk_marcador_imagem_1` FOREIGN KEY (`imagem_id`) REFERENCES `imagem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_marcador_imagem_2` FOREIGN KEY (`marcador_id`) REFERENCES `marcador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `matricula`
--

DROP TABLE IF EXISTS `matricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matricula` (
  `matricula` int(11) NOT NULL,
  `aluno_id` int(11) unsigned NOT NULL,
  `segmento_curso_segmento_id` int(11) unsigned NOT NULL,
  `segmento_curso_curso_id` int(11) unsigned NOT NULL,
  `data_matricula` date NOT NULL,
  `periodo` int(11) NOT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  KEY `fk_matricula_1_idx` (`aluno_id`),
  KEY `fk_matricula_2_idx` (`segmento_curso_segmento_id`),
  KEY `fk_matricula_3_idx` (`segmento_curso_curso_id`),
  CONSTRAINT `fk_matricula_1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_2` FOREIGN KEY (`segmento_curso_segmento_id`) REFERENCES `segmento_curso` (`segmento_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_3` FOREIGN KEY (`segmento_curso_curso_id`) REFERENCES `segmento_curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nivel_administrador`
--

DROP TABLE IF EXISTS `nivel_administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nivel_administrador` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `administrador_id` int(10) unsigned NOT NULL,
  `nivel` enum('total','noticia','evento','administrativo') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nivel_administrador_1_idx` (`administrador_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `noticia`
--

DROP TABLE IF EXISTS `noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticia` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(60) NOT NULL,
  `conteudo` text NOT NULL,
  `resumo` text,
  `arquivo_imagem` varchar(90) DEFAULT NULL,
  `url_imagem` varchar(45) DEFAULT NULL,
  `ip` varchar(20) NOT NULL,
  `status` enum('ativo','ativo') NOT NULL,
  `data_postagem` date NOT NULL,
  `publicado` enum('sim','nao') NOT NULL DEFAULT 'nao',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nucleo`
--

DROP TABLE IF EXISTS `nucleo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nucleo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pagina`
--

DROP TABLE IF EXISTS `pagina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagina` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `conteudo` text,
  `ip` varchar(45) NOT NULL,
  `css` text,
  `js_head` text,
  `js_footer` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pagina_curso`
--

DROP TABLE IF EXISTS `pagina_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagina_curso` (
  `pagina_id` int(11) NOT NULL,
  `curso_id` int(10) unsigned NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`pagina_id`,`curso_id`),
  KEY `fk_pagina_has_curso_curso1_idx` (`curso_id`),
  KEY `fk_pagina_has_curso_pagina1_idx` (`pagina_id`),
  CONSTRAINT `fk_pagina_has_curso_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pagina_has_curso_pagina1` FOREIGN KEY (`pagina_id`) REFERENCES `pagina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pagina_nucleo`
--

DROP TABLE IF EXISTS `pagina_nucleo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagina_nucleo` (
  `pagina_id` int(11) NOT NULL,
  `nucleo_id` int(10) unsigned NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`pagina_id`,`nucleo_id`),
  KEY `fk_pagina_has_nucleo_nucleo1_idx` (`nucleo_id`),
  KEY `fk_pagina_has_nucleo_pagina1_idx` (`pagina_id`),
  CONSTRAINT `fk_pagina_has_nucleo_nucleo1` FOREIGN KEY (`nucleo_id`) REFERENCES `nucleo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pagina_has_nucleo_pagina1` FOREIGN KEY (`pagina_id`) REFERENCES `pagina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `painel`
--

DROP TABLE IF EXISTS `painel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `painel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  `edicao_id` int(10) unsigned NOT NULL,
  `evento_id` int(10) unsigned NOT NULL,
  `imagem_id` int(10) unsigned NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_painel_edicao_evento1_idx` (`edicao_id`,`evento_id`),
  KEY `fk_painel_imagem1_idx` (`imagem_id`),
  CONSTRAINT `fk_painel_edicao_evento1` FOREIGN KEY (`edicao_id`) REFERENCES `edicao_evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_painel_imagem1` FOREIGN KEY (`imagem_id`) REFERENCES `imagem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `turno` enum('Manhã','Tarde','Noite') NOT NULL,
  `ordem` int(11) NOT NULL,
  `inicio` time NOT NULL,
  `final` time NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idperiodo_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `ip` varchar(20) NOT NULL,
  `status` enum('ativo','inativo') NOT NULL,
  `foto` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `carga_horaria` int(11) DEFAULT NULL,
  `pessoa_id` int(10) unsigned NOT NULL,
  `ip` varchar(20) NOT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_professor_pessoa1_idx` (`pessoa_id`),
  CONSTRAINT `fk_professor_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sala`
--

DROP TABLE IF EXISTS `sala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sala` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idsala_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `segmento`
--

DROP TABLE IF EXISTS `segmento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `segmento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL DEFAULT 'integrado',
  `periodo` enum('anual','semestral') NOT NULL DEFAULT 'anual',
  `descricao` varchar(120) NOT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  `num_aulas_periodo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `segmento_curso`
--

DROP TABLE IF EXISTS `segmento_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `segmento_curso` (
  `segmento_id` int(10) unsigned NOT NULL,
  `curso_id` int(10) unsigned NOT NULL,
  `num_periodos` int(11) NOT NULL,
  PRIMARY KEY (`segmento_id`,`curso_id`),
  KEY `fk_segmento_has_curso_curso1_idx` (`curso_id`),
  KEY `fk_segmento_has_curso_segmento1_idx` (`segmento_id`),
  CONSTRAINT `fk_segmento_has_curso_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_segmento_has_curso_segmento1` FOREIGN KEY (`segmento_id`) REFERENCES `segmento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `telefone`
--

DROP TABLE IF EXISTS `telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefone` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ddd` varchar(45) NOT NULL,
  `numero` varchar(45) NOT NULL,
  `tipo` enum('res','com','cel') NOT NULL DEFAULT 'cel',
  `pessoa_id` int(10) unsigned NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_telefone_pessoa1_idx` (`pessoa_id`),
  CONSTRAINT `fk_telefone_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `turma`
--

DROP TABLE IF EXISTS `turma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `periodo` int(11) NOT NULL,
  `ano` int(4) NOT NULL,
  `segmento_curso_segmento_id` int(10) unsigned NOT NULL,
  `segmento_curso_curso_id` int(10) unsigned NOT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_turma_segmento_curso1_idx` (`segmento_curso_segmento_id`,`segmento_curso_curso_id`),
  CONSTRAINT `fk_turma_segmento_curso1` FOREIGN KEY (`segmento_curso_segmento_id`, `segmento_curso_curso_id`) REFERENCES `segmento_curso` (`segmento_id`, `curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `senha` varchar(60) DEFAULT NULL,
  `pessoa_id` int(10) unsigned NOT NULL,
  `session_id` varchar(30) NOT NULL,
  `status` enum('ativo','inativo') DEFAULT 'ativo',
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_usuario_pessoa1_idx` (`pessoa_id`),
  CONSTRAINT `fk_usuario_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(90) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `descricao` tinytext,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-03 16:11:35
