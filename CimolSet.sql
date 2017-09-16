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
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES (1,'ativo'),(2,'ativo'),(3,'ativo'),(4,'ativo'),(14,'ativo');
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `agenda`
--

LOCK TABLES `agenda` WRITE;
/*!40000 ALTER TABLE `agenda` DISABLE KEYS */;
INSERT INTO `agenda` VALUES (1,'2015-12-25','00:00:00','<p>Dia de natal</p>',NULL,NULL,'inativo','Natal','geral'),(2,'2016-01-01','00:00:00','<p>Dia de ano novo</p>',NULL,NULL,'inativo','Ano Novo','geral'),(3,'2015-12-24','00:00:00','<p>Dia anterior ao natal.</p>',NULL,NULL,'inativo','Véspera de Natal','geral'),(4,'2016-01-06','14:00:00','<p>Inicio &nbsp;matr&iacute;culas do ensino m&eacute;dio, para alunos novos.</p>\r\n<p>As matr&iacute;culas para novos alunos do ensino m&eacute;dio ocorrer&atilde;o nos dias &nbsp;06,07,08, 11,12,13 e 14 de Janeiro, no hor&aacute;rio das 9;00 as 11:30 e&nbsp;das 14:00 as 19:00.</p>',NULL,NULL,'inativo','Inicio  matrículas  para alunos novos','geral'),(5,'2016-01-11','14:00:00','<p>As&nbsp;rematr&iacute;culas do curso t&eacute;cnico noturno, ocorer&atilde;o entre os dias 11 e 15 de Janeiro, a aprtir das 14:00 at&eacute; as 19:00.</p>\r\n<p>&nbsp;</p>',NULL,NULL,'ativo','Inicio das rematrículas do curso técnico noturno','geral'),(6,'2016-06-08','10:00:00','<p>Edital lan&ccedil;ado! As inscri&ccedil;&otilde;es para alunos novos ingressarem no Cimol estar&atilde;o abertas do dia 8 ao dia 19 de junho. N&atilde;o perca o prazo.<img src=\"../public/images/geral/06-02-2016_12-58-05-1.jpg\" alt=\"Aqui, juntos constru&iacute;mos nosso conhecimento. A troca de experi&ecirc;ncias entre aluno e professor e a forma em que ela ocorre &eacute; o que aumenta o diferencial do Cimol.\" width=\"999\" height=\"749\" /></p>',NULL,NULL,'ativo','ABERTURA DO PRAZO DE INSCRIÇÕES PARA INGRESSO 2016/2','geral'),(8,'2016-12-19','00:00:00','Entrega dos boletins aos pais de alunos',NULL,NULL,'ativo','Entrega de boletins','geral');
/*!40000 ALTER TABLE `agenda` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aluno`
--

LOCK TABLES `aluno` WRITE;
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
INSERT INTO `aluno` VALUES (1,'ativo',16,'matriculado','114293614507','1'),(2,'ativo',17,'',NULL,'1'),(3,'ativo',18,'matriculado',NULL,'1'),(4,'ativo',19,'',NULL,'1'),(5,'inativo',24,'',NULL,'1'),(6,'inativo',25,'',NULL,'1'),(7,'inativo',26,'',NULL,'1'),(8,'ativo',27,'',NULL,'1'),(9,'inativo',28,'',NULL,'1'),(10,'ativo',29,'',NULL,'1'),(11,'inativo',30,'',NULL,'1'),(12,'ativo',31,'',NULL,'1'),(13,'inativo',32,'',NULL,'1'),(14,'inativo',33,'',NULL,'1'),(15,'inativo',34,'',NULL,'1'),(16,'ativo',35,'',NULL,'1'),(17,'ativo',77,'matriculado',NULL,'1'),(18,'ativo',78,'matriculado',NULL,'1'),(19,'ativo',79,'matriculado',NULL,'1'),(20,'ativo',84,'matriculado',NULL,'1'),(21,'ativo',85,'matriculado',NULL,'1'),(22,'ativo',86,'matriculado',NULL,'1');
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `aluno_turma`
--

LOCK TABLES `aluno_turma` WRITE;
/*!40000 ALTER TABLE `aluno_turma` DISABLE KEYS */;
INSERT INTO `aluno_turma` VALUES (1,3),(3,3);
/*!40000 ALTER TABLE `aluno_turma` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `armario`
--

LOCK TABLES `armario` WRITE;
/*!40000 ALTER TABLE `armario` DISABLE KEYS */;
/*!40000 ALTER TABLE `armario` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `armario_aluno`
--

LOCK TABLES `armario_aluno` WRITE;
/*!40000 ALTER TABLE `armario_aluno` DISABLE KEYS */;
/*!40000 ALTER TABLE `armario_aluno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arquivo`
--

DROP TABLE IF EXISTS `arquivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arquivo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `path_arquivo` varchar(90) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `descricao` varchar(90) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idarquivo_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=358 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arquivo`
--

LOCK TABLES `arquivo` WRITE;
/*!40000 ALTER TABLE `arquivo` DISABLE KEYS */;
INSERT INTO `arquivo` VALUES (357,'Aceite orientação.odt','public/arquivos/','','Arquivo teste');
/*!40000 ALTER TABLE `arquivo` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `aula`
--

LOCK TABLES `aula` WRITE;
/*!40000 ALTER TABLE `aula` DISABLE KEYS */;
/*!40000 ALTER TABLE `aula` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `banner`
--

LOCK TABLES `banner` WRITE;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `biblioteca`
--

LOCK TABLES `biblioteca` WRITE;
/*!40000 ALTER TABLE `biblioteca` DISABLE KEYS */;
INSERT INTO `biblioteca` VALUES (1),(2),(3);
/*!40000 ALTER TABLE `biblioteca` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `biblioteca_autor`
--

LOCK TABLES `biblioteca_autor` WRITE;
/*!40000 ALTER TABLE `biblioteca_autor` DISABLE KEYS */;
/*!40000 ALTER TABLE `biblioteca_autor` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `biblioteca_autor_obra`
--

LOCK TABLES `biblioteca_autor_obra` WRITE;
/*!40000 ALTER TABLE `biblioteca_autor_obra` DISABLE KEYS */;
/*!40000 ALTER TABLE `biblioteca_autor_obra` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `biblioteca_categoria`
--

LOCK TABLES `biblioteca_categoria` WRITE;
/*!40000 ALTER TABLE `biblioteca_categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `biblioteca_categoria` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `biblioteca_editora`
--

LOCK TABLES `biblioteca_editora` WRITE;
/*!40000 ALTER TABLE `biblioteca_editora` DISABLE KEYS */;
/*!40000 ALTER TABLE `biblioteca_editora` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `biblioteca_emprestimo`
--

LOCK TABLES `biblioteca_emprestimo` WRITE;
/*!40000 ALTER TABLE `biblioteca_emprestimo` DISABLE KEYS */;
/*!40000 ALTER TABLE `biblioteca_emprestimo` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `biblioteca_obra`
--

LOCK TABLES `biblioteca_obra` WRITE;
/*!40000 ALTER TABLE `biblioteca_obra` DISABLE KEYS */;
/*!40000 ALTER TABLE `biblioteca_obra` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `biblioteca_obra_eletronica`
--

LOCK TABLES `biblioteca_obra_eletronica` WRITE;
/*!40000 ALTER TABLE `biblioteca_obra_eletronica` DISABLE KEYS */;
/*!40000 ALTER TABLE `biblioteca_obra_eletronica` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `biblioteca_reserva`
--

LOCK TABLES `biblioteca_reserva` WRITE;
/*!40000 ALTER TABLE `biblioteca_reserva` DISABLE KEYS */;
/*!40000 ALTER TABLE `biblioteca_reserva` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coordenador_curso`
--

LOCK TABLES `coordenador_curso` WRITE;
/*!40000 ALTER TABLE `coordenador_curso` DISABLE KEYS */;
INSERT INTO `coordenador_curso` VALUES (1,16,'2015-11-25',NULL,'ativo','',1),(3,10,'2017-05-31',NULL,'ativo','127.0.0.1',1),(5,11,'2015-11-25',NULL,'ativo','',1),(5,24,'2016-08-23',NULL,'ativo','127.0.0.1',1),(6,12,'2015-11-25',NULL,'ativo','',1),(6,19,'2016-07-25',NULL,'ativo','127.0.0.1',1),(6,22,'2016-08-08',NULL,'ativo','127.0.0.1',1),(6,23,'2016-08-08',NULL,'ativo','127.0.0.1',1),(7,13,'2015-11-25',NULL,'ativo','',1),(8,14,'2015-11-25',NULL,'ativo','',1),(11,18,'2016-07-25',NULL,'ativo','127.0.0.1',1),(21,15,'2015-11-25',NULL,'ativo','',1),(23,25,'2017-06-13',NULL,'ativo','127.0.0.1',1);
/*!40000 ALTER TABLE `coordenador_curso` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `coordenador_nucleo`
--

LOCK TABLES `coordenador_nucleo` WRITE;
/*!40000 ALTER TABLE `coordenador_nucleo` DISABLE KEYS */;
/*!40000 ALTER TABLE `coordenador_nucleo` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` VALUES (10,'Eletrônica','A Eletrônica  é editado uma das áreas que mais cresce no país.  O objetivo do Curso Técnico em Eletrônica é formar profissionais capacitados a realizar desde o desenvolvimento e implantação de projetos até a instalação e manutenção de equipamentos eletrônicos, microcomputadores e terminais de telecomunicação, bem como trabalhar com automação e programação.\\r\\nO Curso dispõe de laboratórios de informática e eletrônica, com instrumentos, como osciloscópios digitais, geradores de sinais, fontes; além de estrutura para a confecção de placas de circuitos eletrônicos. ','127.0.0.1',1,'ativo','public/images/logo/01-05-2016_11-05-21.png'),(11,'Eletrotécnica','O Curso de Eletrotécnica visa fornecer ao educando acesso a instrumentos capazes de torna-los profissionais aptos para atuar elaborando projetos e executando instalações elétricas residenciais e industriais.\nNeste Curso o aluno estuda formas de trabalhar com motores, contatoras, cercas elétricas, instalação de equipamentos, CLP - para automação de processos e telecomunicação, com fio, sem fio e com centrais telefônicas analógicas, digitais e, infra-estrutura de redes.','127.0.0.1',1,'ativo','public/images/logo/01-05-2016_11-05-42.png'),(12,'Móveis','O curso Técnico em Móveis visa proporcionar e a produtividade de manufaturas, incentivando a reengenharia, buscando melhorar a eficiência e a lucratividade nos negócios, qualificando equipes de trabalho e capacitando-as a atuar na instalação, produção e manutenção fabril.<br/>\nNesta curso o aluno estuda formas de executar móveis e ambiente planejados utilizando materiais tendências no mercado de trabalho.','177.203.74.149',3,'ativo','public/images/logo/01-05-2016_11-06-09.png'),(13,'Mecânica','O objetivo do Curso de Mecânica é a especialização do educando na área da tecnologia industrial mecânica, proporcionando  e ela a capacitação através da interpretação, avaliação, coordenação e controle de parâmetros de medidas, projetos de dispositivos, máquinas e equipamentos, com o uso de instrumental de oficina e laboratório de qualidade. O CIMOL possui, além de diversos tornos frezza, torno CNC, com a mesma tecnologia que é encontrada no mercado de trabalho.  Também possui oficinas de usinagem e solda, proporcionando o ambiente propício para a preparação do aluno.','189.72.37.157',3,'ativo','public/images/logo/01-05-2016_09-43-09.png'),(14,'Design de Móveis','Neste curso o aluno aprende a projetar móveis e ambientes internos com inovação estética, funcional e tecnológica, considerando aspectos relativos a tendências mundiais e à conservação ambiental.','127.0.0.1',1,'ativo','public/images/logo/01-05-2016_09-43-25.png'),(15,'Química','O Técnico em Química está apto a atuar no planejamento, coordenação, operação e controle dos processos industriais e equipamentos nos processos produtivos.  Pode ainda planejar e coordenar processos laboratoriais, realizar amostragens, análises químicas, físico-químicas e microbiológicas.<br/>\r\nO profissional Técnico em Química pode realizar vendas e assistência técnica na aplicação de equipamentos e produtos químicos e participar do no desenvolvimento de produtos e na validação de métodos.','127.0.0.1',1,'ativo','public/images/logo/01-05-2016_09-43-42.png'),(16,'Informática',' O Curso Técnico em Informática capacita o aluno para o planejamento  e execução dos processos de manutenção de computadores e para operação de redes locais de computadores. Capacita também para o desenvolvimento de aplicativos computacionais, adotando normas técnicas.  Desenvolve-se ainda o trabalho em equipe, e as relações interpessoais construtivas, para que haja a compreensão do contexto em que está inserido, desenvolvendo capacidade propositiva e criativa. ','127.0.0.1',1,'ativo','public/images/logo/01-05-2016_09-43-59.png'),(17,'Meio Ambiente','O profissional da área de meio ambiente tem como objetivo produzir mais usando menos, reduzindo a emissão de gases e a produção de resíduos. Como todas as indústrias devem ter um plano de gestão ambiental, precisam de pessoal especializado, e isso torna o campo de trabalho nesta área bastante grande e promissor. O profissional também pode atar no poder público, em secretarias e órgãos municipais, estaduais ou federais, que fiscalizam e desenvolvem programas de prevenção e educação ambiental, encontrando soluções sustentáveis. Aqui no Cimol, os alunos do Curso de Meio Ambiente realizam diversas visitas técnicas,para que possam estudar, analisar e catalogar minérios, vegetais e várias outras amostras coletadas.','189.72.37.157',3,'ativo','public/images/logo/01-05-2016_09-50-54.png'),(18,'tESTE TES','NVK\\SKLDVAKS','127.0.0.1',1,'inativo','public/images/logo/07-25-2016_13-41-03.jpg'),(19,'Testekshgksjfgk','svhklasdkfvasjg','127.0.0.1',1,'inativo','public/images/logo/07-25-2016_14-11-53.jpg'),(20,'Curso teste','Descrição curso teste','127.0.0.1',1,'inativo','public/images/logo/08-08-2016_11-19-34.jpg'),(21,'Curso teste','Descrição curso teste','127.0.0.1',1,'inativo','public/images/logo/08-08-2016_11-19-34.jpg'),(22,'Curso teste','Descrição curso teste','127.0.0.1',1,'inativo','public/images/logo/08-08-2016_11-19-34.jpg'),(23,'Curso teste','Descrição curso teste','127.0.0.1',1,'inativo','public/images/logo/08-08-2016_11-19-34.jpg'),(24,'Curso de teste','sçgmal fgl fakdl falçj adflçjgd','127.0.0.1',1,'inativo','public/images/logo/08-23-2016_10-09-38.jpg'),(25,'fghgksdfjgçPPP','fjgçdzfjgzçdfjgsdklg','127.0.0.1',1,'inativo','public/images/logo/06-13-2017_09-59-39.png');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `disciplina`
--

LOCK TABLES `disciplina` WRITE;
/*!40000 ALTER TABLE `disciplina` DISABLE KEYS */;
INSERT INTO `disciplina` VALUES (1,'Seminário Integrado I','Sshpawetw\r\ngiashgkas\r\nzndkvasg[is',80,1,16,1,'inativo'),(2,'Seminário Integrado II','GGUB  YOIY O OGUIG G\' ',80,1,16,2,'ativo'),(3,'Seminário Integrado III','kdsjçsadjg\r\nasjgas\r\ng\r\nasg\' \' ',80,1,16,3,'ativo'),(4,'Programação I','\' ç\\sjgoGKgrv\r\ndfgvpsdjgdfks',80,1,16,1,'ativo'),(5,'Programação II','\' vnklasnvklasngkaf sbdagashdg\r\nasjdgasdgyaos',80,1,16,2,'ativo'),(6,'Filosofia','\' ',40,1,16,3,'ativo'),(7,'Matemática','\' \' ',120,1,16,3,'ativo'),(8,'Ensino Religioso','\' ',40,1,16,3,'inativo'),(9,'Quimica','\' ',80,1,16,3,'ativo'),(10,'Artes','\' ',80,1,16,1,'ativo'),(11,'Educação Física','\' ',40,1,16,3,'ativo'),(12,'Lingua Inglesa','\' ',80,1,16,3,'ativo'),(13,'Lingua Espanhola','\' ',40,1,16,1,'inativo'),(14,'Literatura','\' ',40,1,16,3,'ativo'),(15,'Lingua Portuguesa','\' ',160,1,16,3,'ativo'),(16,'Física','\' ',80,1,16,3,'ativo'),(17,'Sociologia','\' ',40,1,16,3,'ativo'),(18,'Biologia','\' ',80,1,16,3,'ativo'),(19,'Geografia','\' ',80,1,16,3,'ativo'),(20,'História','\' ',80,1,16,3,'ativo'),(21,'Empreendedorismo','\' ',40,1,16,3,'ativo'),(22,'Redes de computadores','\' ',80,1,16,3,'ativo'),(23,'Design Gráfico','\' ',120,1,16,3,'ativo'),(24,'Modelagem e Projeto de Banco de Dados','\' ',160,1,16,3,'ativo'),(25,'Criação de Sites','\' ',120,1,16,3,'ativo'),(26,'Filosofia','\' ',40,1,16,1,'ativo'),(27,'Matemática','\' ',160,1,16,1,'ativo'),(28,'Ensino Religioso','\' ',40,1,16,1,'inativo'),(29,'Ensino Religioso','\' ',40,1,16,1,'ativo'),(30,'Química','\' ',80,1,16,1,'ativo'),(31,'Educação Física','\' ',40,1,16,1,'ativo'),(32,'Lingua Inglesa','\' ',80,1,16,1,'ativo'),(33,'Lingua Espanhola','\' ',40,1,16,1,'ativo'),(34,'Literatura','\' ',40,1,16,1,'ativo'),(35,'Lingua Portuguesa','\' ',160,1,16,1,'ativo'),(36,'Física','',80,1,16,1,'ativo'),(37,'Sociologia','\' ',40,1,16,1,'ativo'),(38,'Biologia','\' ',80,1,16,1,'ativo'),(39,'Geografia','\' ',80,1,16,1,'ativo'),(40,'História','\' ',80,1,16,1,'ativo'),(41,'Matemática','\' ',160,1,16,2,'ativo'),(42,'Ética','\' ',40,1,16,2,'ativo'),(43,'Design Gráfico','\' ',80,1,16,2,'ativo'),(44,'Lingua Espanhola','\' ',40,1,16,1,'ativo'),(45,'Lingua Inglesa','\' ',80,1,16,2,'ativo'),(46,'Sistemas Operacionais','\' ',120,1,16,2,'ativo'),(47,'Manutenção de Microcomputadores','\' ',80,1,16,2,'ativo'),(48,'Educação Física','\' ',40,1,16,2,'ativo'),(49,'Lingua Portuguesa	','\' ',160,1,16,2,'ativo'),(50,'Física','\' ',80,1,16,2,'ativo'),(51,'Sociologia','\' ',40,1,16,2,'ativo'),(52,'Quimica','\' ',80,1,16,2,'ativo'),(53,'Geografia','\' ',40,1,16,2,'ativo'),(54,'Biologia','\' ',80,1,16,2,'ativo'),(55,'Programação III','\' ',160,1,16,3,'ativo');
/*!40000 ALTER TABLE `disciplina` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `disciplina_turma`
--

LOCK TABLES `disciplina_turma` WRITE;
/*!40000 ALTER TABLE `disciplina_turma` DISABLE KEYS */;
INSERT INTO `disciplina_turma` VALUES (1,1,11,'inativo','seg',1,1),(1,3,5,'inativo','seg',2,2),(1,3,7,'inativo','ter',3,3),(1,3,8,'ativo','ter',4,4),(2,2,6,'ativo','qua',2,5),(3,1,14,'ativo','qui',1,6),(4,3,5,'inativo','seg',3,7),(5,2,3,'ativo','qui',4,8),(7,1,37,'inativo',NULL,0,9),(7,1,41,'inativo',NULL,0,10),(10,3,39,'ativo',NULL,0,11),(13,3,40,'ativo',NULL,0,12),(26,3,23,'ativo',NULL,0,13),(27,3,41,'ativo',NULL,0,14),(28,3,23,'ativo',NULL,0,15),(30,3,24,'ativo',NULL,0,16),(31,3,32,'ativo',NULL,0,17),(32,3,38,'ativo',NULL,0,18),(34,3,44,'ativo',NULL,0,19),(35,3,30,'ativo',NULL,0,20),(36,3,31,'ativo',NULL,0,21),(37,3,27,'ativo',NULL,0,22),(38,3,29,'ativo',NULL,0,23),(39,3,34,'ativo',NULL,0,24),(40,3,26,'ativo',NULL,0,25),(41,2,41,'ativo',NULL,0,26),(42,2,25,'ativo',NULL,0,27),(43,2,28,'ativo',NULL,0,28),(45,2,38,'ativo',NULL,0,29),(46,2,12,'ativo',NULL,0,30),(47,2,12,'ativo',NULL,0,31),(48,2,32,'ativo',NULL,0,32),(49,2,30,'ativo',NULL,0,33),(50,2,31,'ativo',NULL,0,34),(51,2,27,'ativo',NULL,0,35),(52,2,24,'ativo',NULL,0,36),(53,2,34,'ativo',NULL,0,37),(54,2,29,'ativo',NULL,0,38),(6,1,23,'ativo',NULL,0,39),(25,1,1,'ativo',NULL,0,40),(7,1,41,'ativo',NULL,0,41),(8,1,39,'ativo',NULL,0,42),(9,1,24,'ativo',NULL,0,43),(11,1,32,'ativo',NULL,0,44),(12,1,38,'ativo',NULL,0,45),(14,1,44,'ativo',NULL,0,46),(15,1,30,'ativo',NULL,0,47),(16,1,31,'ativo',NULL,0,48),(17,1,27,'ativo',NULL,0,49),(18,1,29,'ativo',NULL,0,50),(19,1,34,'ativo',NULL,0,51),(20,1,26,'ativo',NULL,0,52),(21,1,25,'ativo',NULL,0,53),(22,1,12,'ativo',NULL,0,54),(23,1,28,'ativo',NULL,0,55),(55,1,1,'ativo',NULL,0,56);
/*!40000 ALTER TABLE `disciplina_turma` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `disciplina_turma_periodo`
--

LOCK TABLES `disciplina_turma_periodo` WRITE;
/*!40000 ALTER TABLE `disciplina_turma_periodo` DISABLE KEYS */;
INSERT INTO `disciplina_turma_periodo` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `disciplina_turma_periodo` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edicao_evento`
--

LOCK TABLES `edicao_evento` WRITE;
/*!40000 ALTER TABLE `edicao_evento` DISABLE KEYS */;
INSERT INTO `edicao_evento` VALUES (2,'8ª Feintec','7','','2016-07-18','2016-07-22',25,97,'inativo'),(3,'7ª Feintec','7','','2016-07-18','2016-07-22',25,96,'ativo'),(4,'Edição especial','25','É apenas um teste','2017-04-29','2017-04-30',25,372,'ativo'),(77,'Edição especial','25','É apenas um teste','2017-04-29','2017-04-30',25,413,'ativo');
/*!40000 ALTER TABLE `edicao_evento` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
INSERT INTO `email` VALUES (2,'jady98muller@gmail.com',2,''),(5,'brunaroberta.azevedo@gmail.com',24,''),(6,'',25,''),(7,'',26,''),(11,'',30,''),(13,'',32,''),(14,'',33,''),(15,'',34,''),(16,'brenda@gmail.com',35,''),(17,'gwagner@gmail.com',31,''),(21,'erai@faccat.br',36,''),(25,'',40,''),(26,'',41,''),(27,'',42,''),(28,'',43,''),(29,'',44,''),(30,'tiago.ulrich@gmail.com',46,''),(31,'evaldo@hotmail.com',47,''),(32,'',48,''),(33,'',49,''),(34,'',50,''),(35,'',51,''),(36,'',52,''),(37,'',53,''),(38,'',54,''),(39,'',55,''),(40,'',56,''),(41,'',57,''),(42,'',58,''),(43,'',59,''),(44,'',60,''),(45,'',61,''),(46,'',62,''),(47,'',63,''),(49,'',65,''),(50,'',66,''),(51,'',67,''),(52,'',68,''),(53,'',69,''),(54,'',70,''),(55,'',71,''),(56,'luziaespinossa@gmail.com',72,''),(57,'',73,''),(58,'',74,''),(59,'',75,''),(60,'',76,''),(61,'',77,''),(62,'',78,''),(63,'',79,''),(64,'cdcfarias@gmail.com',1,''),(65,'cdsfdgkls@gmail.com',80,''),(66,'cdsfdgkls@gmail.com',81,''),(67,'cdsfasgf@gmail.com',82,''),(68,'cdsfasgf@gmail.com',83,''),(69,'',84,''),(70,'',85,''),(71,'messssias@hotmail.com',86,''),(72,'cdsfasgf@gmail.com',87,''),(73,'richardfogaca.rf@gmail.com',14,'');
/*!40000 ALTER TABLE `email` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (0,'Bento Gonçalves','rua','2807','Ap202','Centro',1,'');
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` VALUES (10,'Feitec','Descrição sdgkjrszh z kfj  jgça o zjg as',62,'inativo','Resumo dhgqpetu dfh aseiutpqw s çjf'),(11,'Semana do design','Descrição hdkljsad  sdflhadg sadgjklasdhg sfgas',63,'inativo','Resumo kakshg asgkkas  kgkasgdk a sdgkalsç aads'),(12,'Gincana Cimol','Descrição da gincana',62,'inativo','Resumo da Gincana'),(13,'Gincana Cimol','Descrição da gincana',77,'ativo','Resumo da Gincana'),(14,'Evento Master','Descrição do evento',77,'ativo','Resumo do evento'),(15,'Evento Master','Descrição do evento',67,'inativo','Resumo do evento'),(16,'Evento Master','Descrição do evento',68,'inativo','Resumo do evento'),(17,'Evento Master','Descrição do evento',69,'inativo','Resumo do evento'),(18,'Evento Master','Descrição do evento',70,'inativo','Resumo do evento'),(19,'Evento muito importante','Descrição',71,'inativo','Resumo'),(20,'Evento','Descrição',72,'inativo','Resumo'),(21,'Evento','Descrição',73,'inativo','Resumo'),(22,'Evento','Descrição',74,'inativo','Resumo'),(23,'Evento','Descrição',75,'inativo','Resumo'),(24,'Feintec','Feira de inovação tecnológica',83,'inativo','Feira de inovação tecnológica'),(25,'Feintec','Feira de inovação tecnológica',77,'ativo','Feira de inovação tecnológica'),(26,'Feintec','Feira de inovação tecnológica',78,'inativo','Feira de inovação tecnológica'),(27,'Feintec','Feira de inovação tecnológica',79,'inativo','Feira de inovação tecnológica'),(28,'',NULL,98,'inativo',''),(29,'gjfgjfxgj','<p>xfgxfjgxfg</p>',395,'inativo','xfghsghs'),(35,'Tttttt','<p>dddddddd</p>',398,'ativo','rrrrrrr');
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `feintec`
--

LOCK TABLES `feintec` WRITE;
/*!40000 ALTER TABLE `feintec` DISABLE KEYS */;
INSERT INTO `feintec` VALUES (1);
/*!40000 ALTER TABLE `feintec` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `feintec_aluno_projeto`
--

LOCK TABLES `feintec_aluno_projeto` WRITE;
/*!40000 ALTER TABLE `feintec_aluno_projeto` DISABLE KEYS */;
/*!40000 ALTER TABLE `feintec_aluno_projeto` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `feintec_avaliador`
--

LOCK TABLES `feintec_avaliador` WRITE;
/*!40000 ALTER TABLE `feintec_avaliador` DISABLE KEYS */;
/*!40000 ALTER TABLE `feintec_avaliador` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `feintec_avaliador_projeto`
--

LOCK TABLES `feintec_avaliador_projeto` WRITE;
/*!40000 ALTER TABLE `feintec_avaliador_projeto` DISABLE KEYS */;
/*!40000 ALTER TABLE `feintec_avaliador_projeto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feintec_config`
--

DROP TABLE IF EXISTS `feintec_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feintec_config` (
  `evento_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`evento_id`),
  UNIQUE KEY `evento_id_UNIQUE` (`evento_id`),
  CONSTRAINT `fk_feintec_config_1` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feintec_config`
--

LOCK TABLES `feintec_config` WRITE;
/*!40000 ALTER TABLE `feintec_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `feintec_config` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `feintec_eixo`
--

LOCK TABLES `feintec_eixo` WRITE;
/*!40000 ALTER TABLE `feintec_eixo` DISABLE KEYS */;
INSERT INTO `feintec_eixo` VALUES (1,'Inovação tecnologica','','ativo');
/*!40000 ALTER TABLE `feintec_eixo` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `feintec_projeto`
--

LOCK TABLES `feintec_projeto` WRITE;
/*!40000 ALTER TABLE `feintec_projeto` DISABLE KEYS */;
/*!40000 ALTER TABLE `feintec_projeto` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `fentec_eixo_projeto`
--

LOCK TABLES `fentec_eixo_projeto` WRITE;
/*!40000 ALTER TABLE `fentec_eixo_projeto` DISABLE KEYS */;
/*!40000 ALTER TABLE `fentec_eixo_projeto` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `historico`
--

LOCK TABLES `historico` WRITE;
/*!40000 ALTER TABLE `historico` DISABLE KEYS */;
/*!40000 ALTER TABLE `historico` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=444 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagem`
--

LOCK TABLES `imagem` WRITE;
/*!40000 ALTER TABLE `imagem` DISABLE KEYS */;
INSERT INTO `imagem` VALUES (1,'05-25-2016_16-25-17-0.jpg','public/image','127.0.0.1'),(2,'05-25-2016_16-25-17-0.jpg','public/image','127.0.0.1'),(3,'07-23-2016_19-04-08-0.png','public/image','127.0.0.1'),(4,'07-23-2016_19-04-09-1.png','public/image','127.0.0.1'),(5,'07-23-2016_19-04-09-2.png','public/image','127.0.0.1'),(6,'07-23-2016_19-04-09-3.png','public/image','127.0.0.1'),(7,'07-23-2016_19-04-10-4.png','public/image','127.0.0.1'),(8,'07-23-2016_19-04-10-5.jpg','public/image','127.0.0.1'),(9,'07-23-2016_19-04-11-6.png','public/image','127.0.0.1'),(10,'07-23-2016_19-04-08-0.png','public/image','127.0.0.1'),(11,'07-23-2016_19-04-09-1.png','public/image','127.0.0.1'),(12,'07-23-2016_19-04-09-2.png','public/image','127.0.0.1'),(13,'07-23-2016_19-04-09-3.png','public/image','127.0.0.1'),(14,'07-23-2016_19-04-10-4.png','public/image','127.0.0.1'),(15,'07-23-2016_19-04-10-5.jpg','public/image','127.0.0.1'),(16,'07-23-2016_19-04-11-6.png','public/image','127.0.0.1'),(17,'07-23-2016_19-11-50-0.jpg','public/image','127.0.0.1'),(18,'07-23-2016_19-11-50-1.png','public/image','127.0.0.1'),(19,'07-23-2016_19-11-50-0.jpg','public/image','127.0.0.1'),(20,'07-23-2016_19-11-50-1.png','public/image','127.0.0.1'),(21,'07-25-2016_19-55-03-0.jpg','public/image','127.0.0.1'),(22,'07-25-2016_19-55-03-1.jpg','public/image','127.0.0.1'),(23,'07-25-2016_19-55-03-2.jpg','public/image','127.0.0.1'),(24,'07-25-2016_19-55-03-3.jpg','public/image','127.0.0.1'),(25,'07-25-2016_19-55-03-4.jpg','public/image','127.0.0.1'),(26,'07-25-2016_19-55-03-5.jpg','public/image','127.0.0.1'),(27,'07-25-2016_19-55-03-6.jpg','public/image','127.0.0.1'),(28,'07-25-2016_19-55-03-7.jpg','public/image','127.0.0.1'),(29,'07-25-2016_20-40-58-0.jpg','public/images/geral/','127.0.0.1'),(30,'07-25-2016_20-40-58-1.jpg','public/images/geral/','127.0.0.1'),(31,'07-25-2016_20-40-58-2.jpg','public/images/geral/','127.0.0.1'),(32,'07-25-2016_20-40-58-3.jpg','public/images/geral/','127.0.0.1'),(33,'07-25-2016_20-40-58-4.jpg','public/images/geral/','127.0.0.1'),(34,'07-25-2016_20-40-58-5.jpg','public/images/geral/','127.0.0.1'),(35,'07-25-2016_20-45-10-0.jpg','public/images/geral/','127.0.0.1'),(36,'07-25-2016_20-45-10-1.jpg','public/images/geral/','127.0.0.1'),(37,'07-25-2016_20-45-10-2.jpg','public/images/geral/','127.0.0.1'),(38,'07-25-2016_20-45-10-3.jpg','public/images/geral/','127.0.0.1'),(39,'07-25-2016_20-45-10-4.jpg','public/images/geral/','127.0.0.1'),(40,'07-25-2016_20-45-10-5.jpg','public/images/geral/','127.0.0.1'),(41,'07-25-2016_20-45-10-6.jpg','public/images/geral/','127.0.0.1'),(42,'07-25-2016_20-45-10-7.jpg','public/images/geral/','127.0.0.1'),(43,'07-25-2016_20-45-10-8.jpg','public/images/geral/','127.0.0.1'),(44,'07-25-2016_20-45-10-9.jpg','public/images/geral/','127.0.0.1'),(45,'07-25-2016_20-52-58-0.jpg','public/images/geral/','127.0.0.1'),(46,'07-25-2016_20-52-58-1.jpg','public/images/geral/','127.0.0.1'),(47,'07-25-2016_20-52-58-2.jpg','public/images/geral/','127.0.0.1'),(48,'07-25-2016_20-52-58-3.jpg','public/images/geral/','127.0.0.1'),(49,'07-25-2016_20-52-58-4.jpg','public/images/geral/','127.0.0.1'),(50,'07-25-2016_20-52-58-5.jpg','public/images/geral/','127.0.0.1'),(51,'07-25-2016_20-52-58-6.jpg','public/images/geral/','127.0.0.1'),(52,'0','public/images/geral/',''),(53,'0','public/images/geral/',''),(54,'0','public/images/geral/',''),(55,'0','public/images/geral/',''),(56,'0','public/images/geral/',''),(57,'0','public/images/geral/',''),(58,'0','public/images/geral/',''),(59,'0','public/images/geral/',''),(60,'0','public/images/geral/',''),(61,'0','public/images/geral/',''),(62,'0','public/images/geral/',''),(63,'0','public/images/geral/',''),(64,'0','public/images/geral/',''),(65,'0','public/images/geral/',''),(66,'0','public/images/geral/',''),(67,'0','public/images/geral/',''),(68,'0','public/images/geral/',''),(69,'0','public/images/geral/',''),(70,'public/images/temp/07-27-2016_','public/images/geral/',''),(71,'public/images/temp/07-27-2016_','public/images/geral/',''),(72,'public/images/temp/07-27-2016_','public/images/geral/',''),(73,'public/images/temp/07-27-2016_','public/images/geral/',''),(74,'public/images/temp/07-27-2016_','public/images/geral/',''),(75,'07-27-2016_11-47-11.jpg','public/images/geral/',''),(76,'07-27-2016_12-29-08.png','public/images/geral/',''),(77,'07-27-2016_14-16-24.png','public/images/geral/',''),(78,'07-27-2016_14-20-37.jpg','public/images/geral/',''),(79,'07-27-2016_14-20-37.jpg','public/images/geral/',''),(80,'07-27-2016_14-27-17.jpg','public/images/geral/',''),(81,'07-27-2016_14-27-17.jpg','public/images/geral/',''),(82,'07-27-2016_14-27-17.jpg','public/images/geral/',''),(83,'07-27-2016_14-27-17.jpg','public/images/geral/',''),(84,'07-28-2016_11-14-05.jpg','public/images/geral/',''),(85,'07-28-2016_11-14-05.jpg','public/images/geral/',''),(86,'07-28-2016_12-02-32.jpg','public/images/geral/',''),(87,'07-28-2016_12-02-32.jpg','public/images/geral/',''),(88,'07-28-2016_12-02-32.jpg','public/images/geral/',''),(89,'07-28-2016_12-10-47.jpg','public/images/geral/',''),(90,'07-28-2016_12-17-44.png','public/images/geral/',''),(91,'07-28-2016_12-17-44.png','public/images/geral/',''),(92,'07-28-2016_12-17-44.png','public/images/geral/',''),(93,'07-28-2016_12-17-44.png','public/images/geral/',''),(94,'07-28-2016_12-17-44.png','public/images/geral/',''),(95,'07-28-2016_12-17-44.png','public/images/geral/',''),(96,'07-28-2016_12-17-44.png','public/images/geral/',''),(97,'07-28-2016_12-36-56.png','public/images/geral/',''),(98,'07-28-2016_15-29-31.jpg','public/images/geral/',''),(99,'07-28-2016_16-03-10.jpg','public/images/geral/',''),(100,'07-28-2016_16-03-10.jpg','public/images/geral/',''),(101,'07-28-2016_16-03-10.jpg','public/images/geral/',''),(102,'07-28-2016_16-03-10.jpg','public/images/geral/',''),(103,'07-28-2016_16-03-10.jpg','public/images/geral/',''),(104,'07-28-2016_16-03-10.jpg','public/images/geral/',''),(105,'07-28-2016_16-03-10.jpg','public/images/geral/',''),(106,'07-28-2016_16-03-10.jpg','public/images/geral/',''),(107,'07-28-2016_16-03-10.jpg','public/images/geral/',''),(108,'07-28-2016_16-03-10.jpg','public/images/geral/',''),(109,'07-28-2016_17-15-56.jpg','public/images/geral/',''),(110,'07-28-2016_17-15-56.jpg','public/images/geral/',''),(111,'07-28-2016_17-15-56.jpg','public/images/geral/',''),(112,'07-28-2016_17-15-56.jpg','public/images/geral/',''),(113,'07-28-2016_17-15-56.jpg','public/images/geral/',''),(114,'07-28-2016_17-15-57.jpg','public/images/geral/',''),(115,'07-28-2016_17-15-57.jpg','public/images/geral/',''),(116,'07-28-2016_17-15-57.jpg','public/images/geral/',''),(117,'07-28-2016_17-33-56-0.jpg','public/images/geral/',''),(118,'07-28-2016_17-33-56-1.jpg','public/images/geral/',''),(119,'07-28-2016_17-33-56-2.jpg','public/images/geral/',''),(120,'07-28-2016_17-33-56-3.jpg','public/images/geral/',''),(121,'07-28-2016_17-33-56-4.jpg','public/images/geral/',''),(122,'07-28-2016_17-33-56-5.jpg','public/images/geral/',''),(123,'07-28-2016_17-33-56-6.jpg','public/images/geral/',''),(124,'07-28-2016_17-33-56-0.jpg','public/images/geral/',''),(125,'07-28-2016_17-33-56-1.jpg','public/images/geral/',''),(126,'07-28-2016_17-33-56-2.jpg','public/images/geral/',''),(127,'07-28-2016_17-33-56-3.jpg','public/images/geral/',''),(128,'07-28-2016_17-33-56-4.jpg','public/images/geral/',''),(129,'07-28-2016_17-33-56-5.jpg','public/images/geral/',''),(130,'07-28-2016_17-33-56-6.jpg','public/images/geral/',''),(131,'08-01-2016_15-34-11.jpg','public/images/geral/',''),(132,'08-01-2016_15-34-11.jpg','public/images/geral/',''),(133,'08-01-2016_15-34-11.jpg','public/images/geral/',''),(134,'08-01-2016_15-34-11.jpg','public/images/geral/',''),(135,'08-01-2016_15-34-11.jpg','public/images/geral/',''),(136,'08-01-2016_15-34-11.jpg','public/images/geral/',''),(137,'08-01-2016_15-34-11.jpg','public/images/geral/',''),(138,'08-01-2016_15-34-11.jpg','public/images/geral/',''),(139,'08-01-2016_15-56-28.jpg','public/images/geral/',''),(140,'08-01-2016_15-58-10.jpg','public/images/geral/',''),(141,'09-16-2016_09-00-51-0.jpg','public/images/geral/','127.0.0.1'),(164,'12-15-2015_16-31-22.png','public/images/geral/',''),(165,'12-15-2015_16-31-23.png','public/images/geral/',''),(167,'12-15-2015_16-31-24.png','public/images/geral/',''),(172,'12-15-2015_16-36-04.png','public/images/geral/',''),(174,'12-15-2015_16-36-05.png','public/images/geral/',''),(175,'1','public/images/geral/','127.0.0.1'),(176,'1','public/images/geral/','127.0.0.1'),(177,'1','public/images/geral/','127.0.0.1'),(178,'1','public/images/geral/','127.0.0.1'),(179,'1','public/images/geral/','127.0.0.1'),(180,'1','public/images/geral/','127.0.0.1'),(181,'1','public/images/geral/','127.0.0.1'),(182,'1','public/images/geral/','127.0.0.1'),(183,'1','public/images/geral/','127.0.0.1'),(184,'1','public/images/geral/','127.0.0.1'),(185,'1','public/images/geral/','127.0.0.1'),(186,'1','public/images/geral/','127.0.0.1'),(187,'1','public/images/geral/','127.0.0.1'),(188,'1','public/images/geral/','127.0.0.1'),(189,'1','public/images/geral/','127.0.0.1'),(190,'1','public/images/geral/','127.0.0.1'),(191,'1','public/images/geral/','127.0.0.1'),(192,'1','public/images/geral/','127.0.0.1'),(193,'1','public/images/geral/','127.0.0.1'),(194,'1','public/images/geral/','127.0.0.1'),(195,'1','public/images/geral/','127.0.0.1'),(196,'11-10-2016_10-54-47-0.jpg','public/images/geral/','127.0.0.1'),(197,'11-10-2016_10-54-47-1.png','public/images/geral/','127.0.0.1'),(198,'11-10-2016_10-54-47-2.png','public/images/geral/','127.0.0.1'),(199,'11-10-2016_10-54-48-3.jpg','public/images/geral/','127.0.0.1'),(200,'11-10-2016_11-14-56-0.jpg','public/images/geral/','127.0.0.1'),(201,'11-10-2016_11-14-56-1.jpg','public/images/geral/','127.0.0.1'),(202,'11-10-2016_11-14-57-2.jpg','public/images/geral/','127.0.0.1'),(203,'11-10-2016_11-14-57-3.jpg','public/images/geral/','127.0.0.1'),(204,'11-10-2016_11-14-57-4.jpg','public/images/geral/','127.0.0.1'),(205,'11-10-2016_11-14-57-5.jpg','public/images/geral/','127.0.0.1'),(206,'11-10-2016_11-14-57-6.jpg','public/images/geral/','127.0.0.1'),(207,'11-10-2016_13-48-40-0.jpg','public/images/geral/','127.0.0.1'),(208,'11-10-2016_13-48-40-1.jpg','public/images/geral/','127.0.0.1'),(209,'11-10-2016_13-48-40-2.jpg','public/images/geral/','127.0.0.1'),(210,'11-10-2016_13-48-40-3.jpg','public/images/geral/','127.0.0.1'),(211,'11-10-2016_13-48-40-4.jpg','public/images/geral/','127.0.0.1'),(212,'11-10-2016_13-48-41-5.jpg','public/images/geral/','127.0.0.1'),(213,'11-10-2016_13-48-41-6.jpg','public/images/geral/','127.0.0.1'),(214,'1','public/images/geral/',''),(215,'1','public/images/geral/',''),(216,'-','public/images/geral/',''),(217,'1','public/images/geral/',''),(218,'0','public/images/geral/',''),(219,'-','public/images/geral/',''),(220,'2','public/images/geral/',''),(221,'1','public/images/geral/',''),(222,'1','public/images/geral/',''),(223,'-','public/images/geral/',''),(224,'1','public/images/geral/',''),(225,'0','public/images/geral/',''),(226,'-','public/images/geral/',''),(227,'2','public/images/geral/',''),(228,'1','public/images/geral/',''),(229,'1','public/images/geral/',''),(230,'-','public/images/geral/',''),(231,'1','public/images/geral/',''),(232,'0','public/images/geral/',''),(233,'-','public/images/geral/',''),(234,'2','public/images/geral/',''),(235,'1','public/images/geral/',''),(236,'1','public/images/geral/',''),(237,'-','public/images/geral/',''),(238,'1','public/images/geral/',''),(239,'0','public/images/geral/',''),(240,'-','public/images/geral/',''),(241,'2','public/images/geral/',''),(242,'1','public/images/geral/',''),(243,'1','public/images/geral/',''),(244,'-','public/images/geral/',''),(245,'1','public/images/geral/',''),(246,'0','public/images/geral/',''),(247,'-','public/images/geral/',''),(248,'2','public/images/geral/',''),(249,'1','public/images/geral/',''),(250,'1','public/images/geral/',''),(251,'-','public/images/geral/',''),(252,'1','public/images/geral/',''),(253,'0','public/images/geral/',''),(254,'-','public/images/geral/',''),(255,'2','public/images/geral/',''),(256,'1','public/images/geral/',''),(257,'1','public/images/geral/',''),(258,'-','public/images/geral/',''),(259,'1','public/images/geral/',''),(260,'0','public/images/geral/',''),(261,'-','public/images/geral/',''),(262,'2','public/images/geral/',''),(263,'p','public/images/geral/',''),(264,'','public/images/geral/',''),(265,'','public/images/geral/',''),(266,'','public/images/geral/',''),(267,'','public/images/geral/',''),(268,'','public/images/geral/',''),(269,'','public/images/geral/',''),(270,'p','public/images/geral/',''),(271,'p','public/images/geral/',''),(272,'p','public/images/geral/',''),(273,'p','public/images/geral/',''),(274,'p','public/images/geral/',''),(275,'p','public/images/geral/',''),(276,'p','public/images/geral/',''),(277,'','public/images/geral/',''),(278,'','public/images/geral/',''),(279,'','public/images/geral/',''),(280,'','public/images/geral/',''),(281,'','public/images/geral/',''),(282,'','public/images/geral/',''),(283,'','public/images/geral/',''),(284,'11-10-2016_15-28-22-0.jpg','public/images/geral/',''),(285,'11-10-2016_15-28-22-1.jpg','public/images/geral/',''),(286,'11-10-2016_15-28-22-2.jpg','public/images/geral/',''),(287,'11-10-2016_15-28-22-3.jpg','public/images/geral/',''),(288,'11-10-2016_15-28-22-4.jpg','public/images/geral/',''),(289,'11-10-2016_15-28-22-5.jpg','public/images/geral/',''),(290,'11-10-2016_15-28-22-6.jpg','public/images/geral/',''),(291,'11-10-2016_16-47-16-0.jpg','public/images/geral/',''),(292,'11-10-2016_16-47-16-1.jpg','public/images/geral/',''),(293,'11-10-2016_16-47-16-2.jpg','public/images/geral/',''),(294,'11-10-2016_16-47-16-3.jpg','public/images/geral/',''),(295,'11-10-2016_16-47-16-4.jpg','public/images/geral/',''),(296,'11-10-2016_16-47-17-5.jpg','public/images/geral/',''),(297,'11-10-2016_16-47-17-6.jpg','public/images/geral/',''),(298,'11-10-2016_16-58-49-0.jpg','public/images/geral/',''),(299,'11-10-2016_16-58-49-1.jpg','public/images/geral/',''),(300,'11-10-2016_16-58-49-2.jpg','public/images/geral/',''),(301,'11-10-2016_16-58-50-3.jpg','public/images/geral/',''),(302,'11-10-2016_16-58-50-4.jpg','public/images/geral/',''),(303,'11-10-2016_16-58-50-5.jpg','public/images/geral/',''),(304,'11-10-2016_16-58-50-6.jpg','public/images/geral/',''),(305,'11-10-2016_17-01-18-0.jpg','public/images/geral/',''),(306,'11-10-2016_17-01-18-1.jpg','public/images/geral/',''),(307,'11-10-2016_17-01-18-2.jpg','public/images/geral/',''),(308,'11-10-2016_17-01-18-3.jpg','public/images/geral/',''),(309,'11-10-2016_17-01-18-4.jpg','public/images/geral/',''),(310,'11-10-2016_17-01-18-5.jpg','public/images/geral/',''),(311,'11-10-2016_17-01-19-6.jpg','public/images/geral/',''),(312,'11-10-2016_17-13-10-0.jpg','public/images/geral/',''),(313,'11-10-2016_17-13-10-1.jpg','public/images/geral/',''),(314,'11-10-2016_17-13-10-2.jpg','public/images/geral/',''),(315,'11-10-2016_17-13-10-3.jpg','public/images/geral/',''),(316,'11-10-2016_17-13-10-4.jpg','public/images/geral/',''),(317,'11-10-2016_17-13-11-5.jpg','public/images/geral/',''),(318,'11-10-2016_17-13-11-6.jpg','public/images/geral/',''),(319,'11-10-2016_17-13-10-0.jpg','public/images/geral/',''),(320,'11-10-2016_17-13-10-1.jpg','public/images/geral/',''),(321,'11-10-2016_17-13-10-2.jpg','public/images/geral/',''),(322,'11-10-2016_17-13-10-3.jpg','public/images/geral/',''),(323,'11-10-2016_17-13-10-4.jpg','public/images/geral/',''),(324,'11-10-2016_17-13-11-5.jpg','public/images/geral/',''),(325,'11-10-2016_17-13-11-6.jpg','public/images/geral/',''),(326,'11-12-2016_09-28-15-0.jpg','public/images/geral/',''),(327,'11-12-2016_09-28-15-1.jpg','public/images/geral/',''),(328,'11-12-2016_09-28-15-2.jpg','public/images/geral/',''),(329,'11-12-2016_09-28-15-3.jpg','public/images/geral/',''),(330,'11-12-2016_09-28-15-4.jpg','public/images/geral/',''),(331,'11-12-2016_09-28-15-5.jpg','public/images/geral/',''),(332,'11-12-2016_09-28-15-6.jpg','public/images/geral/',''),(333,'11-12-2016_09-28-16-7.jpg','public/images/geral/',''),(334,'11-12-2016_09-28-16-8.jpg','public/images/geral/',''),(335,'11-12-2016_09-28-16-9.jpg','public/images/geral/',''),(336,'11-12-2016_09-28-16-10.jpg','public/images/geral/',''),(337,'11-12-2016_12-32-27-0.jpg','public/images/geral/',''),(338,'11-12-2016_12-32-27-1.jpg','public/images/geral/',''),(339,'11-12-2016_12-32-27-2.jpg','public/images/geral/',''),(340,'11-12-2016_12-32-27-3.jpg','public/images/geral/',''),(341,'11-12-2016_12-32-27-4.jpg','public/images/geral/',''),(342,'11-12-2016_12-32-27-5.jpg','public/images/geral/',''),(343,'11-12-2016_12-32-27-6.jpg','public/images/geral/',''),(344,'11-12-2016_12-32-28-7.jpg','public/images/geral/',''),(345,'11-12-2016_12-32-28-8.jpg','public/images/geral/',''),(346,'11-12-2016_12-32-28-9.jpg','public/images/geral/',''),(347,'11-12-2016_12-32-28-10.jpg','public/images/geral/',''),(348,'11-13-2016_13-04-43-0.jpg','public/images/geral/',''),(349,'11-13-2016_13-04-43-0.jpg','public/images/geral/',''),(350,'11-13-2016_14-25-29-0.jpg','public/images/geral/',''),(351,'11-13-2016_14-25-29-0.jpg','public/images/geral/',''),(352,'11-13-2016_14-25-29-0.jpg','public/images/geral/',''),(353,'11-13-2016_14-25-30-1.jpg','public/images/geral/',''),(354,'11-13-2016_14-25-30-2.jpg','public/images/geral/',''),(355,'11-13-2016_22-46-02-0.jpg','public/images/geral/',''),(356,'11-27-2016_22-19-31.jpg','public/images/geral/',''),(357,'04-24-2017_15-29-05-0.png','public/images/geral/','127.0.0.1'),(358,'04-24-2017_15-29-06-1.png','public/images/geral/','127.0.0.1'),(359,'04-24-2017_15-29-06-2.png','public/images/geral/','127.0.0.1'),(360,'04-25-2017_10-39-21-0.png','public/images/geral/','127.0.0.1'),(361,'04-25-2017_10-39-22-1.png','public/images/geral/','127.0.0.1'),(362,'04-25-2017_10-39-22-2.png','public/images/geral/','127.0.0.1'),(363,'04-25-2017_10-41-29-0.png','public/images/geral/','127.0.0.1'),(364,'04-25-2017_10-41-29-1.png','public/images/geral/','127.0.0.1'),(365,'04-25-2017_10-50-45-0.jpg','public/images/geral/','127.0.0.1'),(366,'04-25-2017_10-50-45-1.jpg','public/images/geral/','127.0.0.1'),(367,'04-25-2017_10-50-45-2.jpg','public/images/geral/','127.0.0.1'),(368,'04-25-2017_10-50-45-3.jpg','public/images/geral/','127.0.0.1'),(369,'04-25-2017_10-50-45-4.jpg','public/images/geral/','127.0.0.1'),(370,'04-25-2017_10-50-45-5.jpg','public/images/geral/','127.0.0.1'),(371,'04-28-2017_11-11-15.png','public/images/geral/',''),(372,'04-28-2017_11-11-15.png','public/images/geral/',''),(373,'04-28-2017_14-20-59-0.png','public/images/geral/',''),(374,'04-28-2017_14-20-59-0.png','public/images/geral/',''),(375,'04-28-2017_14-41-54-0.png','public/images/geral/',''),(376,'04-28-2017_14-41-54-0.png','public/images/geral/',''),(377,'04-28-2017_14-41-54-0.png','public/images/geral/',''),(385,'04-28-2017_16-24-59-0.png','public/images/geral/',''),(386,'04-28-2017_16-25-44-0.png','public/images/geral/',''),(387,'04-30-2017_19-48-28.jpg','public/images/geral/',''),(388,'04-30-2017_19-48-28.jpg','public/images/geral/',''),(389,'04-30-2017_19-48-28.jpg','public/images/geral/',''),(390,'04-30-2017_21-15-05.jpg','public/images/geral/',''),(391,'04-30-2017_21-15-05.jpg','public/images/geral/',''),(392,'04-30-2017_21-43-53.jpg','public/images/geral/',''),(393,'04-30-2017_21-46-02.jpg','public/images/geral/',''),(394,'05-18-2017_21-38-10-0.png','public/images/geral/','127.0.0.1'),(395,'05-30-2017_09-15-22.jpg','public/images/geral/',''),(396,'05-31-2017_10-11-41.jpg','public/images/geral/',''),(397,'05-31-2017_10-34-57.jpg','public/images/geral/',''),(398,'05-31-2017_11-04-05.png','public/images/geral/',''),(399,'05-31-2017_21-51-47.jpg','public/images/geral/',''),(400,'06-01-2017_10-06-23.jpg','public/images/geral/',''),(401,'06-02-2017_11-03-19-0.jpg','public/images/geral/',''),(402,'06-02-2017_11-03-19-1.jpg','public/images/geral/',''),(403,'06-02-2017_11-03-20-2.jpg','public/images/geral/',''),(404,'06-02-2017_11-04-56.jpg','public/images/geral/',''),(405,'06-02-2017_14-43-04.jpg','public/images/geral/',''),(406,'06-02-2017_14-45-01.jpg','public/images/geral/',''),(407,'06-02-2017_14-47-21.jpg','public/images/geral/',''),(408,'06-02-2017_14-47-21.jpg','public/images/geral/',''),(409,'06-02-2017_14-47-21.jpg','public/images/geral/',''),(410,'06-02-2017_14-47-21.jpg','public/images/geral/',''),(411,'06-02-2017_15-00-06.jpg','public/images/geral/',''),(412,'06-02-2017_15-00-06.jpg','public/images/geral/',''),(413,'06-02-2017_15-00-06.jpg','public/images/geral/',''),(414,'06-02-2017_15-37-56-0.jpg','public/images/geral/',''),(415,'06-03-2017_09-44-23.jpg','public/images/geral/',''),(416,'06-03-2017_10-00-13.png','public/images/geral/',''),(417,'06-03-2017_10-23-01.png','public/images/geral/',''),(418,'06-03-2017_10-27-52.png','public/images/geral/',''),(419,'0','public/images/geral/','127.0.0.1'),(420,'0','public/images/geral/','127.0.0.1'),(421,'06-18-2017_13-20-16.jpg','public/images/geral/','127.0.0.1'),(422,'06-18-2017_13-20-16.jpg','public/images/geral/','127.0.0.1'),(423,'06-18-2017_13-20-16.jpg','public/images/geral/','127.0.0.1'),(424,'06-18-2017_13-20-16.jpg','public/images/geral/','127.0.0.1'),(425,'06-18-2017_13-20-16.jpg','public/images/geral/','127.0.0.1'),(426,'06-18-2017_13-42-19.png','public/images/geral/','127.0.0.1'),(427,'06-18-2017_19-30-34.png','public/images/geral/','127.0.0.1'),(428,'06-18-2017_19-30-34.png','public/images/geral/','127.0.0.1'),(429,'06-18-2017_19-30-34.png','public/images/geral/','127.0.0.1'),(430,'06-18-2017_22-39-13.png','public/images/geral/','127.0.0.1'),(431,'06-18-2017_22-39-13.png','public/images/geral/','127.0.0.1'),(432,'06-18-2017_22-39-13.jpg','public/images/geral/','127.0.0.1'),(433,'06-18-2017_22-39-13.jpg','public/images/geral/','127.0.0.1'),(434,'06-19-2017_16-24-40.png','public/images/geral/','127.0.0.1'),(435,'06-19-2017_16-24-40.png','public/images/geral/','127.0.0.1'),(436,'06-19-2017_16-24-41.png','public/images/geral/','127.0.0.1'),(437,'06-19-2017_16-24-41.jpg','public/images/geral/','127.0.0.1'),(438,'06-19-2017_16-24-41.jpg','public/images/geral/','127.0.0.1'),(439,'06-19-2017_16-24-41.png','public/images/geral/','127.0.0.1'),(440,'06-19-2017_16-30-33.jpg','public/images/geral/','127.0.0.1'),(441,'06-19-2017_16-30-33.jpg','public/images/geral/','127.0.0.1'),(442,'06-19-2017_16-30-33.jpg','public/images/geral/','127.0.0.1'),(443,'07-17-2017_15-14-56.gif','public/images/geral/','');
/*!40000 ALTER TABLE `imagem` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `imagem_banner`
--

LOCK TABLES `imagem_banner` WRITE;
/*!40000 ALTER TABLE `imagem_banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `imagem_banner` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `imagem_edicao_evento`
--

LOCK TABLES `imagem_edicao_evento` WRITE;
/*!40000 ALTER TABLE `imagem_edicao_evento` DISABLE KEYS */;
INSERT INTO `imagem_edicao_evento` VALUES (101,3),(117,3),(118,3),(119,3),(120,3),(121,3),(122,3),(123,3),(124,3),(125,3),(126,3),(127,3),(128,3),(129,3),(130,3),(385,4),(386,4),(401,77),(402,77),(403,77),(414,77);
/*!40000 ALTER TABLE `imagem_edicao_evento` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `imagem_noticia`
--

LOCK TABLES `imagem_noticia` WRITE;
/*!40000 ALTER TABLE `imagem_noticia` DISABLE KEYS */;
INSERT INTO `imagem_noticia` VALUES (2,3,'127.0.0.1'),(3,4,'127.0.0.1'),(4,4,'127.0.0.1'),(5,4,'127.0.0.1'),(6,4,'127.0.0.1'),(7,4,'127.0.0.1'),(8,4,'127.0.0.1'),(9,4,'127.0.0.1'),(10,5,'127.0.0.1'),(11,5,'127.0.0.1'),(12,5,'127.0.0.1'),(13,5,'127.0.0.1'),(14,5,'127.0.0.1'),(15,5,'127.0.0.1'),(16,5,'127.0.0.1'),(17,6,'127.0.0.1'),(18,6,'127.0.0.1'),(21,9,'127.0.0.1'),(22,9,'127.0.0.1'),(23,9,'127.0.0.1'),(24,9,'127.0.0.1'),(25,9,'127.0.0.1'),(26,9,'127.0.0.1'),(27,9,'127.0.0.1'),(28,9,'127.0.0.1'),(29,9,'127.0.0.1'),(30,9,'127.0.0.1'),(31,9,'127.0.0.1'),(32,9,'127.0.0.1'),(33,9,'127.0.0.1'),(34,9,'127.0.0.1'),(35,7,'127.0.0.1'),(36,7,'127.0.0.1'),(37,7,'127.0.0.1'),(38,7,'127.0.0.1'),(40,7,'127.0.0.1'),(41,7,'127.0.0.1'),(42,7,'127.0.0.1'),(43,7,'127.0.0.1'),(44,7,'127.0.0.1'),(45,7,'127.0.0.1'),(46,7,'127.0.0.1'),(47,7,'127.0.0.1'),(48,7,'127.0.0.1'),(49,7,'127.0.0.1'),(50,7,'127.0.0.1'),(51,7,'127.0.0.1'),(141,10,'127.0.0.1'),(175,45,'127.0.0.1'),(176,46,'127.0.0.1'),(177,47,'127.0.0.1'),(178,48,'127.0.0.1'),(179,49,'127.0.0.1'),(180,50,'127.0.0.1'),(181,51,'127.0.0.1'),(182,52,'127.0.0.1'),(183,53,'127.0.0.1'),(184,54,'127.0.0.1'),(185,55,'127.0.0.1'),(186,56,'127.0.0.1'),(187,57,'127.0.0.1'),(188,58,'127.0.0.1'),(189,59,'127.0.0.1'),(190,60,'127.0.0.1'),(191,61,'127.0.0.1'),(192,62,'127.0.0.1'),(193,63,'127.0.0.1'),(194,64,'127.0.0.1'),(195,65,'127.0.0.1'),(196,62,'127.0.0.1'),(197,62,'127.0.0.1'),(198,62,'127.0.0.1'),(199,62,'127.0.0.1'),(200,71,'127.0.0.1'),(201,71,'127.0.0.1'),(202,71,'127.0.0.1'),(203,71,'127.0.0.1'),(204,71,'127.0.0.1'),(205,71,'127.0.0.1'),(206,71,'127.0.0.1'),(207,72,'127.0.0.1'),(208,72,'127.0.0.1'),(209,72,'127.0.0.1'),(210,72,'127.0.0.1'),(211,72,'127.0.0.1'),(212,72,'127.0.0.1'),(213,72,'127.0.0.1'),(214,76,'127.0.0.1'),(215,76,'127.0.0.1'),(216,76,'127.0.0.1'),(217,76,'127.0.0.1'),(218,76,'127.0.0.1'),(219,76,'127.0.0.1'),(220,76,'127.0.0.1'),(221,76,'127.0.0.1'),(222,76,'127.0.0.1'),(223,76,'127.0.0.1'),(224,76,'127.0.0.1'),(225,76,'127.0.0.1'),(226,76,'127.0.0.1'),(227,76,'127.0.0.1'),(228,76,'127.0.0.1'),(229,76,'127.0.0.1'),(230,76,'127.0.0.1'),(231,76,'127.0.0.1'),(232,76,'127.0.0.1'),(233,76,'127.0.0.1'),(234,76,'127.0.0.1'),(235,71,'127.0.0.1'),(236,71,'127.0.0.1'),(237,71,'127.0.0.1'),(238,71,'127.0.0.1'),(239,71,'127.0.0.1'),(240,71,'127.0.0.1'),(241,71,'127.0.0.1'),(242,71,'127.0.0.1'),(243,71,'127.0.0.1'),(244,71,'127.0.0.1'),(245,71,'127.0.0.1'),(246,71,'127.0.0.1'),(247,71,'127.0.0.1'),(248,71,'127.0.0.1'),(249,71,'127.0.0.1'),(250,71,'127.0.0.1'),(251,71,'127.0.0.1'),(252,71,'127.0.0.1'),(253,71,'127.0.0.1'),(254,71,'127.0.0.1'),(255,71,'127.0.0.1'),(256,71,'127.0.0.1'),(257,71,'127.0.0.1'),(258,71,'127.0.0.1'),(259,71,'127.0.0.1'),(260,71,'127.0.0.1'),(261,71,'127.0.0.1'),(262,71,'127.0.0.1'),(263,71,'127.0.0.1'),(264,71,'127.0.0.1'),(265,71,'127.0.0.1'),(266,71,'127.0.0.1'),(267,71,'127.0.0.1'),(268,71,'127.0.0.1'),(269,71,'127.0.0.1'),(270,71,'127.0.0.1'),(271,71,'127.0.0.1'),(272,71,'127.0.0.1'),(273,71,'127.0.0.1'),(274,71,'127.0.0.1'),(275,71,'127.0.0.1'),(276,71,'127.0.0.1'),(277,71,'127.0.0.1'),(278,71,'127.0.0.1'),(279,71,'127.0.0.1'),(280,71,'127.0.0.1'),(281,71,'127.0.0.1'),(282,71,'127.0.0.1'),(283,71,'127.0.0.1'),(284,71,'127.0.0.1'),(285,71,'127.0.0.1'),(286,71,'127.0.0.1'),(287,71,'127.0.0.1'),(288,71,'127.0.0.1'),(289,71,'127.0.0.1'),(290,71,'127.0.0.1'),(291,77,'127.0.0.1'),(292,77,'127.0.0.1'),(293,77,'127.0.0.1'),(294,77,'127.0.0.1'),(295,77,'127.0.0.1'),(296,77,'127.0.0.1'),(297,77,'127.0.0.1'),(298,77,'127.0.0.1'),(299,77,'127.0.0.1'),(300,77,'127.0.0.1'),(301,77,'127.0.0.1'),(302,77,'127.0.0.1'),(303,77,'127.0.0.1'),(304,77,'127.0.0.1'),(305,77,'127.0.0.1'),(306,77,'127.0.0.1'),(307,77,'127.0.0.1'),(308,77,'127.0.0.1'),(309,77,'127.0.0.1'),(310,77,'127.0.0.1'),(311,77,'127.0.0.1'),(312,77,'127.0.0.1'),(313,77,'127.0.0.1'),(314,77,'127.0.0.1'),(315,77,'127.0.0.1'),(316,77,'127.0.0.1'),(317,77,'127.0.0.1'),(318,77,'127.0.0.1'),(319,77,'127.0.0.1'),(320,77,'127.0.0.1'),(321,77,'127.0.0.1'),(322,77,'127.0.0.1'),(323,77,'127.0.0.1'),(324,77,'127.0.0.1'),(325,77,'127.0.0.1'),(326,78,'127.0.0.1'),(327,78,'127.0.0.1'),(328,78,'127.0.0.1'),(329,78,'127.0.0.1'),(330,78,'127.0.0.1'),(331,78,'127.0.0.1'),(332,78,'127.0.0.1'),(333,78,'127.0.0.1'),(334,78,'127.0.0.1'),(335,78,'127.0.0.1'),(336,78,'127.0.0.1'),(337,81,'127.0.0.1'),(339,81,'127.0.0.1'),(340,81,'127.0.0.1'),(341,81,'127.0.0.1'),(342,81,'127.0.0.1'),(343,81,'127.0.0.1'),(344,81,'127.0.0.1'),(346,81,'127.0.0.1'),(347,81,'127.0.0.1'),(360,69,'127.0.0.1'),(361,69,'127.0.0.1'),(362,69,'127.0.0.1'),(363,69,'127.0.0.1'),(364,69,'127.0.0.1'),(365,43,'127.0.0.1'),(366,43,'127.0.0.1'),(367,43,'127.0.0.1'),(368,43,'127.0.0.1'),(369,43,'127.0.0.1'),(370,43,'127.0.0.1'),(394,43,'127.0.0.1'),(419,87,'127.0.0.1'),(420,88,'127.0.0.1'),(421,89,'127.0.0.1'),(422,90,'127.0.0.1'),(423,91,'127.0.0.1'),(424,92,'127.0.0.1'),(425,93,'127.0.0.1'),(426,94,'127.0.0.1'),(427,126,'127.0.0.1'),(428,127,'127.0.0.1'),(429,128,'127.0.0.1'),(430,128,'127.0.0.1'),(431,128,'127.0.0.1'),(432,128,'127.0.0.1'),(433,128,'127.0.0.1'),(434,129,'127.0.0.1'),(435,129,'127.0.0.1'),(436,129,'127.0.0.1'),(437,129,'127.0.0.1'),(438,129,'127.0.0.1'),(439,129,'127.0.0.1'),(440,127,'127.0.0.1'),(441,127,'127.0.0.1'),(442,127,'127.0.0.1');
/*!40000 ALTER TABLE `imagem_noticia` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `marcador`
--

LOCK TABLES `marcador` WRITE;
/*!40000 ALTER TABLE `marcador` DISABLE KEYS */;
INSERT INTO `marcador` VALUES (1,'cimol'),(2,'informatica'),(3,'noticia'),(4,'economia'),(5,'rrr'),(6,'ddd'),(7,'teste'),(8,'feintec'),(9,'oreintação aceite');
/*!40000 ALTER TABLE `marcador` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `marcador_arquivo`
--

LOCK TABLES `marcador_arquivo` WRITE;
/*!40000 ALTER TABLE `marcador_arquivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `marcador_arquivo` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `marcador_imagem`
--

LOCK TABLES `marcador_imagem` WRITE;
/*!40000 ALTER TABLE `marcador_imagem` DISABLE KEYS */;
INSERT INTO `marcador_imagem` VALUES (1,350),(1,351),(1,352),(7,352),(1,353),(7,353),(1,354),(7,354),(8,355);
/*!40000 ALTER TABLE `marcador_imagem` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `matricula`
--

LOCK TABLES `matricula` WRITE;
/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
INSERT INTO `matricula` VALUES (97931,1,1,16,'0000-00-00',0,'ativo'),(98163,3,1,16,'2016-01-25',0,'ativo');
/*!40000 ALTER TABLE `matricula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `new_table`
--

DROP TABLE IF EXISTS `new_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `new_table` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `path_arquivo` varchar(90) NOT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `new_table`
--

LOCK TABLES `new_table` WRITE;
/*!40000 ALTER TABLE `new_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `new_table` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `nivel_administrador`
--

LOCK TABLES `nivel_administrador` WRITE;
/*!40000 ALTER TABLE `nivel_administrador` DISABLE KEYS */;
INSERT INTO `nivel_administrador` VALUES (1,1,'total');
/*!40000 ALTER TABLE `nivel_administrador` ENABLE KEYS */;
UNLOCK TABLES;

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
  `feed` enum('on','off') NOT NULL DEFAULT 'on',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticia`
--

LOCK TABLES `noticia` WRITE;
/*!40000 ALTER TABLE `noticia` DISABLE KEYS */;
INSERT INTO `noticia` VALUES (1,'klklççlçoç','<p>jkjkljklj&ccedil;lkj</p>','djçGLÇVALVZXFVS',NULL,NULL,'127.0.0.1','','2016-05-25','nao',''),(2,'klklççlçoç','<p>jkjkljklj&ccedil;lkj</p>','djçGLÇVALVZXFVS',NULL,NULL,'127.0.0.1','','2016-05-25','nao',''),(3,'Teste Eitarklklççlçoç','<p>jkjkljklj&ccedil;lkj</p>','djçGLÇVALVZXFVS',NULL,NULL,'127.0.0.1','','2016-05-25','nao',''),(4,'Noticia Teste 1','<p>Recentemente o Google lan&ccedil;ou oficialmente sua ferramenta para desenvolvimento de aplicativos Android, o <strong>Android Studio</strong>. Juntamente com este anuncio, deixou claro tamb&eacute;m que o <strong>Eclipse ADT</strong> n&atilde;o ter&aacute; mais suporte pela pr&oacute;pria Google.</p>\r\n<p>Nesse conte&uacute;do, vou ensinar a voc&ecirc;s como configurar o ambiente de desenvolvimento utilizando a ferramenta <strong>oficial</strong> do Google.</p>\r\n<p>Vamos come&ccedil;ar! <img class=\"emoji\" draggable=\"false\" src=\"https://s.w.org/images/core/emoji/72x72/1f600.png\" alt=\"','Recentemente o Google lançou oficialmente sua ferramenta para desenvolvimento de aplicativos Android, o Android Studio. Juntamente com este ',NULL,NULL,'127.0.0.1','','2016-07-23','nao',''),(5,'Noticia Teste 1','<p>Recentemente o Google lan&ccedil;ou oficialmente sua ferramenta para desenvolvimento de aplicativos Android, o <strong>Android Studio</strong>. Juntamente com este anuncio, deixou claro tamb&eacute;m que o <strong>Eclipse ADT</strong> n&atilde;o ter&aacute; mais suporte pela pr&oacute;pria Google.</p>\r\n<p>Nesse conte&uacute;do, vou ensinar a voc&ecirc;s como configurar o ambiente de desenvolvimento utilizando a ferramenta <strong>oficial</strong> do Google.</p>\r\n<p>Vamos come&ccedil;ar! <img class=\"emoji\" draggable=\"false\" src=\"https://s.w.org/images/core/emoji/72x72/1f600.png\" alt=\"','Recentemente o Google lançou oficialmente sua ferramenta para desenvolvimento de aplicativos Android, o Android Studio. Juntamente com este ',NULL,NULL,'127.0.0.1','','2016-07-23','nao',''),(6,'Noticia Teste 1','<p>Recentemente o Google lan&ccedil;ou oficialmente sua ferramenta para desenvolvimento de aplicativos Android, o <strong>Android Studio</strong>. Juntamente com este anuncio, deixou claro tamb&eacute;m que o <strong>Eclipse ADT</strong> n&atilde;o ter&aacute; mais suporte pela pr&oacute;pria Google.</p>','Recentemente o Google lançou oficialmente sua ferramenta para desenvolvimento de aplicativos Android, o Android Studio. Juntamente com este ',NULL,NULL,'127.0.0.1','','2016-07-23','nao',''),(7,'Noticia Teste 1.0','<p>Recentemente o Google lan&ccedil;ou oficialmente sua ferramenta para desenvolvimento de aplicativos Android, o <strong>Android Studio</strong>. Juntamente com este anuncio, deixou claro tamb&eacute;m que o <strong>Eclipse ADT</strong> n&atilde;o ter&aacute; mais suporte pela pr&oacute;pria Google.</p>','Recentemente o Google lançou oficialmente sua ferramenta para desenvolvimento de aplicativos Android, o Android Studio. Juntamente com este ',NULL,NULL,'127.0.0.1','ativo','2016-07-23','nao',''),(8,'Boa Noticia','dsjglalçsdgla alsçdjg lSAKDG ','\\SKGHKSDG  askajsdgkas',NULL,NULL,'127.0.0.1','ativo','2016-07-25','nao',''),(9,'Boa Noticia','dsjglalçsdgla alsçdjg lSAKDG ','\\SKGHKSDG  askajsdgkas',NULL,NULL,'127.0.0.1','','2016-07-25','nao',''),(10,'dfgsfhsdf','<p>zvzgvzvzxcv</p>','cxvzxcbzcbzzx',NULL,NULL,'127.0.0.1','','2016-09-16','sim',''),(39,'8ª FEINTEC E OS PROJETOS CAMPEÕES','<p style=\"text-align: justify;\">Do dia 10 ao dia 12 de Novembro ocorreu na Escola T&eacute;cnica Estadual Monteiro Lobato, em Taquara, a FEINTEC &ndash; FEIRA DE INOVA&Ccedil;&Atilde;O TECNOL&Oacute;GICA.mostrar a pesquisa, criatividade, inova&ccedil;&atilde;o, preocupa&ccedil;&atilde;o com a sustentabilidade e acessibilidade das pessoas, conseguindo, atrav&eacute;s da feira, demonstrar para a comunidade seus projetos como forma de incentivo &agrave; pesquisa.</p>\r\n<p style=\"text-align: justify;\" align=\"justify\">Os tr&ecirc;s dias de evento foram marcados por visita&ccedil;&otilde;es de outras escolas e comunidade em geral, que tamb&eacute;m aproveitaram para conhecer o Museu da Hist&oacute;ria da Tecnologia do CIMOL &ndash; Harald Alberto Bauer.</p>\r\n<p style=\"text-align: justify;\" align=\"justify\">&nbsp; &nbsp;&nbsp;Atrav&eacute;s do patroc&iacute;nio da Universidade Feevale, da Faculdade Integrada de Taquara (FACCAT), FlyByte e com apoio de&nbsp;<a href=\"http://www.escolaolimpio.com.br/\">Olimpio,&nbsp;</a><a href=\"http://www.cr.inf.br/\">CR Sistemas e Web,&nbsp;</a><a href=\"http://www.heidrichmonitoramento.com.br/\">Heidrich,&nbsp;</a><a href=\"http://eletrodinamica.com.br/\">Eletrodin&acirc;mica,&nbsp;</a><a href=\"http://www.ska.com.br/\">SKA,&nbsp;</a><a href=\"http://www.sanvitron.com.br/\">Sanvitron,&nbsp;</a><a href=\"http://www.vibmaster.com.br/\">VibMaster,&nbsp;</a><a href=\"http://www.pirisa.com/\">Pirisa,&nbsp;</a><a href=\"http://vivavida.com.br/\">Viva a Vida,&nbsp;</a><a href=\"https://www.facebook.com/di.taq.7?fref=ts\">Di Taq,&nbsp;</a><a href=\"http://www.w2abrasil.com.br/\">w2abrasil</a>&nbsp;e&nbsp;<a href=\"http://copicenter.net/\">Copicenter N&amp;A,&nbsp;</a>o evento tem como premia&ccedil;&atilde;o destaque credenciais para a 36th ESKON EXPO FOR YOUNG SCIENTISTS, em Johannesburg, &Aacute;frica do Sul, e para a EUREKA 2016, em Lima, no Peru. Al&eacute;m de credenciais para a Mostratec 2016 e MEP 2016. Os projetos destaque dos quatro eixos, de primeiro a terceiro colocado, receberam trof&eacute;us e medalhas.&nbsp;</p>\r\n<p style=\"text-align: justify;\" align=\"justify\">Com mais de 2000 visitantes neste ano, a organiza&ccedil;&atilde;o do evento fica contente com o desenvolvimento dos projetos e interesse da comunidade em conhecer a feira.</p>\r\n<p style=\"text-align: justify;\" align=\"justify\">Silvio Quintino de Mello, diretor do educand&aacute;rio, destaca:</p>\r\n<p style=\"text-align: justify;\" align=\"justify\">&ldquo;&Eacute; extremamente relevante incentivar os alunos &agrave; pesquisa e proporcionar espa&ccedil;o para que eles possam apresentar o fruto de seus estudos.&rdquo;</p>\r\n<p style=\"text-align: justify;\">A classifica&ccedil;&atilde;o ficou da seguinte forma:</p>\r\n<p style=\"text-align: justify;\" align=\"justify\">Eixo Experi&ecirc;ncia: 1&ordm; lugar para Inclus&atilde;o de Pessoas Especiais em Projetos Educacionais de Preserva&ccedil;&atilde;o Ambiental, das alunas Luisa Pacheco, Alana Freitas e Nicole N&iacute;cola; o 2&ordm; GME Gerador Magn&eacute;tico de Energia, de Jo&atilde;o Pedro da Silva, Lucas Lahm e Vitor Gottschalk e o 3&ordm; para Gerador de Energia E&oacute;lica atrav&eacute;s de Exaustor Industrial, dos alunos Natan Sousa, Guilherme Ramison e Tiago Vingert.</p>\r\n<p style=\"text-align: justify;\" align=\"justify\">Eixo Estudo: 1&ordm; lugar, projeto Polui&ccedil;&atilde;o Luminosa, de Jo&atilde;o Pedro Brodt, J&uacute;lio Bartzen e Lucas Wille, o 2&ordm; colocado, Utiliza&ccedil;&atilde;o de Compostos Naturais no Tratamento de Doen&ccedil;as Mentais e Neurol&oacute;gicas, de Sarah Hoffmeister e Endiel Martin; o 3&ordm; para Alternativa Sustent&aacute;vel: Um Aproveitamento Pluviom&eacute;trico para Hortas Hidrop&ocirc;nicas.</p>\r\n<p style=\"text-align: justify;\" align=\"justify\">&nbsp; &nbsp;Eixo Inova&ccedil;&atilde;o Tecnol&oacute;gica: 1&ordm; lugar para o projeto Teclado de Aux&iacute;lio ao Aprendizado do C&oacute;digo Braile, de Fernanda B&eacute;rgamo e Milena Doneli; o 2&ordm; lugar para Software de Gerenciamento para Transporte Escola Privado, de P&acirc;mela de Oliveira, Gabriel Wagner e Brenda Gallas; o 3&ordm; para Dispositivo Detector de Ambientes Destinado a Deficientes Visuais, de Jessica de Leis, Julia Demenigui e Milena Micaela.</p>\r\n<p style=\"text-align: justify;\" align=\"justify\">Eixo Inova&ccedil;&atilde;o Industrial: 1&ordm; Lugar, Dormit&oacute;rio Sustent&aacute;vel, da aluna Analice Pereira, 2&ordm; lugar Biodiversidade da Flora Amaz&ocirc;nica Inspirado no Organicismo, de J&uacute;lia Glinke; e 3&ordm; lugar para Design Entre Fibras, da aluna Carine Federici.</p>\r\n<p style=\"text-align: justify;\" align=\"justify\">&nbsp; &nbsp;A credencial para Lima, no Peru 2016, foi para o projeto Software de Gerenciamento para Transporte Escolar Privado e a credencial para Johannesburg, na &Aacute;frica do Sul, para Biodiversidade da Flora Amaz&ocirc;nia Inspirado no Organicismo.</p>','Do dia 10 ao dia 12 de Novembro ocorreu na Escola Técnica Estadual Monteiro Lobato, em Taquara, a FEINTEC – FEIRA DE INOVAÇÃO TECNOLÓGICA.mostrar a pesquisa, criatividade, inovação, preocupação com a sustentabilidade e acessibilidade das pessoas, conseguindo, através da feira, demonstrar para a comunidade seus projetos como forma de incentivo à pesquisa.','','','','ativo','2015-12-07','sim',''),(43,'GABARITO DA PROVA DE SELEÇÃO','<p>Divulgado o gabarito da prova de selec&ccedil;&atilde;, para os cursos noturnos,&nbsp;realizada em 05 de Dezembro de 2015.</p>\r\n<p><img src=\"../public/images/geral/01-06-2016_11-49-45-3.png\" alt=\"\" width=\"678\" height=\"1500\" /></p>\r\n<p>&nbsp;</p>','Divulgado o gabarito da prova de selecção realizada em 05 de Dezembro de 2015.',NULL,NULL,'','ativo','2015-12-14','nao',''),(44,'SORTEADOS CURSOS INTEGRADOS','',NULL,NULL,NULL,'','','0000-00-00','nao',''),(45,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(46,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(47,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(48,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(49,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(50,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(51,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(52,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(53,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(54,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(55,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(56,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(57,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(58,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(59,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(60,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(61,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(62,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(63,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(64,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(65,'','',NULL,NULL,NULL,'127.0.0.1','','2016-10-27','nao',''),(66,'','',NULL,NULL,NULL,'127.0.0.1','','2016-11-10','nao',''),(67,'','',NULL,NULL,NULL,'127.0.0.1','','2016-11-10','nao',''),(68,'','',NULL,NULL,NULL,'127.0.0.1','','2016-11-10','nao',''),(69,'ABERTAS AS INSCRIÇÕES PARA INGRESSO 2017/1','<p>ABERTAS AS INSCRI&Ccedil;&Otilde;ES PARA INGRESSO 2017/1 - CURSOS INTEGRADOS E NOTURNOS. De 07 a 30 de novembro, no site educacao.rs.gov.br, no link \"Matr&iacute;cula na Escola P&uacute;blica\".</p>\r\n<p>Os editais podem ser encontrados nos links abaixo:</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"http://www.cimol.g12.br/public/documentos/15232504D20171.pdf\" target=\"_blank\">Edital do curso t&eacute;cnico integrado ao ensino m&eacute;dio.</a></p>\r\n<p><a href=\"http://www.cimol.g12.br/public/documentos/15232437N20171.pdf\" target=\"_blank\">Edital do curso t&eacute;cnino subsequente noturno.</a></p>','ABERTAS INSCRIÇÕES PARA INGRESSO 2017/1 - CURSOS INTEGRADOS E NOTURNOS. De 07 a 30 de novembro.',NULL,NULL,'127.0.0.1','ativo','2016-11-10','sim',''),(70,'ABERTAS AS INSCRIÇÕES PARA INGRESSO 2017/1','<p>ABERTAS AS INSCRI&Ccedil;&Otilde;ES PARA INGRESSO 2017/1 - CURSOS INTEGRADOS E NOTURNOS. De 07 a 30 de novembro, no site educacao.rs.gov.br, no link \"Matr&iacute;cula na Escola P&uacute;blica\".</p>\r\n<p>Os editais podem ser encontrados nos links abaixo:</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"http://www.cimol.g12.br/public/documentos/15232504D20171.pdf\" target=\"_blank\">Edital do curso t&eacute;cnico integrado ao ensino m&eacute;dio.</a></p>\r\n<p><a href=\"http://www.cimol.g12.br/public/documentos/15232437N20171.pdf\" target=\"_blank\">Edital do curso t&eacute;cnino subsequente noturno.</a></p>','ABERTAS INSCRIÇÕES PARA INGRESSO 2017/1 - CURSOS INTEGRADOS E NOTURNOS. De 07 a 30 de novembro.',NULL,NULL,'127.0.0.1','','2016-11-10','nao',''),(71,'ABERTAS AS INSCRIÇÕES PARA INGRESSO 2017/1','<p>ABERTAS AS INSCRI&Ccedil;&Otilde;ES PARA INGRESSO 2017/1 - CURSOS INTEGRADOS E NOTURNOS. De 07 a 30 de novembro, no site educacao.rs.gov.br, no link \"Matr&iacute;cula na Escola P&uacute;blica\".</p>\r\n<p>Os editais podem ser encontrados nos links abaixo:</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"http://www.cimol.g12.br/public/documentos/15232504D20171.pdf\" target=\"_blank\">Edital do curso t&eacute;cnico integrado ao ensino m&eacute;dio.</a></p>\r\n<p><a href=\"http://www.cimol.g12.br/public/documentos/15232437N20171.pdf\" target=\"_blank\">Edital do curso t&eacute;cnino subsequente noturno.</a></p>','ABERTAS INSCRIÇÕES PARA INGRESSO 2017/1 - CURSOS INTEGRADOS E NOTURNOS. De 07 a 30 de novembro.',NULL,NULL,'','','2016-11-10','nao',''),(72,'ABERTAS AS INSCRIÇÕES PARA INGRESSO 2017/1','<p>ABERTAS AS INSCRI&Ccedil;&Otilde;ES PARA INGRESSO 2017/1 - CURSOS INTEGRADOS E NOTURNOS. De 07 a 30 de novembro, no site educacao.rs.gov.br, no link \"Matr&iacute;cula na Escola P&uacute;blica\".</p>\r\n<p>Os editais podem ser encontrados nos links abaixo:</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"http://www.cimol.g12.br/public/documentos/15232504D20171.pdf\" target=\"_blank\">Edital do curso t&eacute;cnico integrado ao ensino m&eacute;dio.</a></p>\r\n<p><a href=\"http://www.cimol.g12.br/public/documentos/15232437N20171.pdf\" target=\"_blank\">Edital do curso t&eacute;cnino subsequente noturno.</a></p>','ABERTAS INSCRIÇÕES PARA INGRESSO 2017/1 - CURSOS INTEGRADOS E NOTURNOS. De 07 a 30 de novembro.',NULL,NULL,'','','2016-11-10','nao',''),(73,'ABERTAS AS INSCRIÇÕES PARA INGRESSO 2017/1','<p>ABERTAS AS INSCRI&Ccedil;&Otilde;ES PARA INGRESSO 2017/1 - CURSOS INTEGRADOS E NOTURNOS. De 07 a 30 de novembro, no site educacao.rs.gov.br, no link \"Matr&iacute;cula na Escola P&uacute;blica\".</p>\r\n<p>Os editais podem ser encontrados nos links abaixo:</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"http://www.cimol.g12.br/public/documentos/15232504D20171.pdf\" target=\"_blank\">Edital do curso t&eacute;cnico integrado ao ensino m&eacute;dio.</a></p>\r\n<p><a href=\"http://www.cimol.g12.br/public/documentos/15232437N20171.pdf\" target=\"_blank\">Edital do curso t&eacute;cnino subsequente noturno.</a></p>','ABERTAS INSCRIÇÕES PARA INGRESSO 2017/1 - CURSOS INTEGRADOS E NOTURNOS. De 07 a 30 de novembro.',NULL,NULL,'','','2016-11-10','nao',''),(74,'','',NULL,NULL,NULL,'','','2016-11-10','nao',''),(75,'','',NULL,NULL,NULL,'','','2016-11-10','nao',''),(76,'ABERTAS AS INSCRIÇÕES PARA INGRESSO 2017/1','<p>ABERTAS AS INSCRI&Ccedil;&Otilde;ES PARA INGRESSO 2017/1 - CURSOS INTEGRADOS E NOTURNOS. De 07 a 30 de novembro, no site educacao.rs.gov.br, no link \"Matr&iacute;cula na Escola P&uacute;blica\".</p>\r\n<p>Os editais podem ser encontrados nos links abaixo:</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"http://www.cimol.g12.br/public/documentos/15232504D20171.pdf\" target=\"_blank\">Edital do curso t&eacute;cnico integrado ao ensino m&eacute;dio.</a></p>\r\n<p><a href=\"http://www.cimol.g12.br/public/documentos/15232437N20171.pdf\" target=\"_blank\">Edital do curso t&eacute;cnino subsequente noturno.</a></p>','ABERTAS INSCRIÇÕES PARA INGRESSO 2017/1 - CURSOS INTEGRADOS E NOTURNOS. De 07 a 30 de novembro.',NULL,NULL,'','','2016-11-10','nao',''),(77,'ABERTAS AS INSCRIÇÕES PARA INGRESSO 2017/1','<p>ABERTAS AS INSCRI&Ccedil;&Otilde;ES PARA INGRESSO 2017/1 - CURSOS INTEGRADOS E NOTURNOS. De 07 a 30 de novembro, no site educacao.rs.gov.br, no link \"Matr&iacute;cula na Escola P&uacute;blica\".</p>\r\n<p>Os editais podem ser encontrados nos links abaixo:</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"http://www.cimol.g12.br/public/documentos/15232504D20171.pdf\" target=\"_blank\">Edital do curso t&eacute;cnico integrado ao ensino m&eacute;dio.</a></p>\r\n<p><a href=\"http://www.cimol.g12.br/public/documentos/15232437N20171.pdf\" target=\"_blank\">Edital do curso t&eacute;cnino subsequente noturno.</a></p>','ABERTAS INSCRIÇÕES PARA INGRESSO 2017/1 - CURSOS INTEGRADOS E NOTURNOS. De 07 a 30 de novembro.',NULL,NULL,'','','2016-11-10','nao',''),(78,'9 FEINTEC | EXPOSITORES E SEUS PROJETOS - 41 ao 51','<p>Na manh&atilde; desta sexta-feira, dia 11 de novembro, na cerim&ocirc;nia oficial de encerramento, estiveram presentes o diretor, professor Silvio Quintino de Mello, a professora supervisora Karine Kersting, o professor coordenador geral dos Cursos T&eacute;cnicos do Cimol, Jo&atilde;o Carlos Spindler, o sr. Dorneles Sita Fagundes, representante das Faculdades Integradas de Taquara- Faccat e o professor Carlos Nascimento, representante da Universidade Feevale.</p>\r\n<p>A Feintec, que &eacute; organizada pelos professores Priscila Kasper, Kamila Seefeld e Richard Foga&ccedil;a, ao todo, contou com 106 alunos expositores e 27 professores orientadores participando do evento, que &eacute; o maior da Escola.</p>\r\n<div>&nbsp;</div>\r\n<div>Sempre inovando, a Feintec premiou os alunos dos projetos vencedores com duas credenciais para feiras internacionais: para a Expoingenieria, na Costa Rica &ndash; projeto vencedor CONCRETO PERME&Aacute;VEL E O REAPROVEITAMENTO DA &Aacute;GUA &ndash; e para a Ci&ecirc;ncia no Campus, em Portugal &ndash; projeto O EST&Iacute;MULO PARA O DESENVOLVIMENTO INFANTIL ATRAV&Eacute;S DO MOBILI&Aacute;RIO MULTIFUNCIONAL.</div>','Na manhã desta sexta-feira, dia 11 de novembro, na cerimônia oficial de encerramento, estiveram presentes o diretor, professor Silvio Quintino de Mello, a professora supervisora Karine Kersting, o professor coordenador geral dos Cursos Técnicos do Cimol, João Carlos Spindler, o sr. Dorneles Sita Fagundes, representante das Faculdades Integradas de Taquara- Faccat e o professor Carlos Nascimento, representante da Universidade Feevale.\r\n',NULL,NULL,'','','2016-11-12','sim',''),(79,'Noticia teste','<p>conteudo teste</p>','resumo teste',NULL,NULL,'','','2016-11-12','nao',''),(80,'zçgjaçsdjgs','<p>dgas&ccedil;djgldsz</p>','kdsgakdgçsld',NULL,NULL,'','','2016-11-12','nao',''),(81,'dsgasrzg','<p>dfhdfhf</p>','sgsdfhfghfg',NULL,NULL,'','','2016-11-12','sim',''),(82,'dsgasrzg','<p>dfhdfhf</p>','sgsdfhfghfg',NULL,NULL,'','','2016-11-12','nao',''),(83,'','',NULL,NULL,NULL,'127.0.0.1','','2017-05-16','nao',''),(84,'','',NULL,NULL,NULL,'127.0.0.1','','2017-05-16','nao',''),(85,'','',NULL,NULL,NULL,'127.0.0.1','','2017-05-16','nao',''),(86,'','',NULL,NULL,NULL,'127.0.0.1','','2017-05-16','nao',''),(87,'','',NULL,NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(88,'','',NULL,NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(89,'','',NULL,NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(90,'','',NULL,NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(91,'','',NULL,NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(92,'','',NULL,NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(93,'','',NULL,NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(94,'','',NULL,NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(95,'','',NULL,NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(96,'Testet','<p>vu\\l&ccedil;gp&aacute;yhwml ybigh&ccedil;lzvn fgnsvn&nbsp;</p>','nlkngvdywbo0rgisjt irtug8duy9r',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(97,'fgjalçsjglsdlkfg','<p>zkfjg&ccedil;df fiqwet</p>','slgqpwet jtlçt  irt wer',NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(98,'fgjalçsjglsdlkfg','<p>zkfjg&ccedil;df fiqwet</p>','slgqpwet jtlçt  irt wer',NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(99,'fgjalçsjglsdlkfg','<p>zkfjg&ccedil;df fiqwet</p>','slgqpwet jtlçt  irt wer',NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(100,'fgjalçsjglsdlkfg','<p>zkfjg&ccedil;df fiqwet</p>','slgqpwet jtlçt  irt wer',NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(101,'fgjalçsjglsdlkfg','<p>zkfjg&ccedil;df fiqwet</p>','slgqpwet jtlçt  irt wer',NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(102,'fgjalçsjglsdlkfg','<p>zkfjg&ccedil;df fiqwet</p>','slgqpwet jtlçt  irt wer',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(103,'fgjalçsjglsdlkfg','<p>zkfjg&ccedil;df fiqwet</p>','slgqpwet jtlçt  irt wer',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(104,'fgjalçsjglsdlkfg','<p>zkfjg&ccedil;df fiqwet</p>','slgqpwet jtlçt  irt wer',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(105,'TTTTTTTTTTT','<p>TTTTTTTTTT</p>','TTTTTTTTTT',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(106,'TTTTTTTTTTT','<p>TTTTTTTTTT</p>','TTTTTTTTTT',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(107,'TTTTTTTTTTT','<p>TTTTTTTTTT</p>','TTTTTTTTTT',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(108,'TTTTTTTTTTT','<p>TTTTTTTTTT</p>','TTTTTTTTTT',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(109,'TTTTTTTTTTT','<p>TTTTTTTTTT</p>','TTTTTTTTTT',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(110,'TTTTTTTTTTT','<p>TTTTTTTTTT</p>','TTTTTTTTTT',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(111,'TTTTTTTTTTT','<p>TTTTTTTTTT</p>','TTTTTTTTTT',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(112,'zbsjpojgwdçlsf','<p>;zxmcb; zzj</p>','zjgosd  sfsdjfsdfg çlsg  s jfç sdf',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(113,'QQQQQQQQQQQ','<p>QQQQQQ QQQQQQ QQQQQQ</p>','QQQQ QQQQQQQ QQQQQQQ',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(114,'WWWWWWWWW','<p>WWWWWWWW</p>','WWWWWWWWWWW',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(115,'AAAAAAAAAA','<p>AAAAAAAAAAAAAA</p>','AAAAAAAAAAAA',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(116,'AAAAAAAAAA','<p>AAAAAAAAAAAAAA</p>','AAAAAAAAAAAA',NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(117,'AAAAAAAAAA','<p>AAAAAAAAAAAAAA</p>','AAAAAAAAAAAA',NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(118,'AAAAAAAAAA','<p>AAAAAAAAAAAAAA</p>','AAAAAAAAAAAA',NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(119,'AAAAAAAAAA','<p>AAAAAAAAAAAAAA</p>','AAAAAAAAAAAA',NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(120,'AAAAAAAAAA','<p>AAAAAAAAAAAAAA</p>','AAAAAAAAAAAA',NULL,NULL,'127.0.0.1','','2017-06-18','nao',''),(121,'AAAAAAAAAA','<p>AAAAAAAAAAAAAA</p>','AAAAAAAAAAAA',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(122,'SSSSSSSSS','<p>SSSSSSSSSS</p>','SSSSSSSSSSS',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(123,'DDDDDD','<p>DDDDDDDDD</p>','DDDDDDDD',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(124,'FFFFFF','<p>FFFFFF</p>','FFFFFF',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(125,'FFFFFF','<p>FFFFFF</p>','FFFFFF',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(126,'FFFFFF','<p>FFFFFF</p>','FFFFFF',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(127,'FFFFFF','<p>FFFFFF</p>','FFFFFF',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(128,'FFFFFF','<p>FFFFFF</p>','FFFFFF',NULL,NULL,'127.0.0.1','ativo','2017-06-18','nao',''),(129,'GGGGGGGGGGG','<p>GGGGGGGGGGGGGGGGGGGGGG</p>','GGGGGGGGGGGGGGGGGGGGGGG','06-19-2017_14-33-30.png','public/images/geral/','127.0.0.1','ativo','2017-06-19','nao',''),(130,'TTTTTTTTTTT','<p>tftftftftftft</p>','sfhasioya nasidugias  ighsid g sdifsoguasf','08-30-2017_16-28-19.png','public/images/geral/','::1','ativo','2017-08-30','nao','on'),(131,'UUUUUUUUUUUUUU','<p>uuuuuuuuuuuuuuuuuuuuuuuuuuuu</p>','kjhl hl lk  i ihh lh lp  up pio u ','08-30-2017_16-36-26.png','public/images/geral/','::1','ativo','2017-08-30','nao','on'),(132,'clszrkzdfkzdfh','<p>bjzdlfkb&ccedil;x lxmclzxcvl</p>','zsdkgãksdkas','08-30-2017_16-53-30.png','public/images/geral/','::1','ativo','2017-08-30','nao','on'),(133,'jfsdAGAJSDÇGJSÇA','<p>DFHASDKG&Ccedil;LAJSDL&Ccedil;GJA&Ccedil;LSGLAS</p>','ML \\ÇZJVASDGPKQAPKGA M GASDG A','08-30-2017_17-05-01.png','public/images/geral/','::1','ativo','2017-08-30','nao','on'),(134,'fzasfgasg','<p>zvazxvzxcz</p>','zfcasfcAFS','08-30-2017_17-14-25.jpg','public/images/geral/','::1','ativo','2017-08-30','nao','on'),(135,'SDGASGSDHASDFG','<p>SDGASHSFDHDSFJHSDG</p>','Z\\DVASDGASGSD','08-30-2017_17-15-11.jpg','public/images/geral/','::1','ativo','2017-08-30','nao','off'),(136,'jjhklhklh  h l  ujkj gg','<p>jgkjggkj &nbsp;gkjkjjkh</p>','v gjgk gk h k  oo',NULL,NULL,'::1','ativo','2017-08-30','nao','off');
/*!40000 ALTER TABLE `noticia` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `nucleo`
--

LOCK TABLES `nucleo` WRITE;
/*!40000 ALTER TABLE `nucleo` DISABLE KEYS */;
/*!40000 ALTER TABLE `nucleo` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `pagina`
--

LOCK TABLES `pagina` WRITE;
/*!40000 ALTER TABLE `pagina` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagina` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `pagina_curso`
--

LOCK TABLES `pagina_curso` WRITE;
/*!40000 ALTER TABLE `pagina_curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagina_curso` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `pagina_nucleo`
--

LOCK TABLES `pagina_nucleo` WRITE;
/*!40000 ALTER TABLE `pagina_nucleo` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagina_nucleo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `painel_edicao_evento`
--

DROP TABLE IF EXISTS `painel_edicao_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `painel_edicao_evento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  `edicao_id` int(10) unsigned NOT NULL,
  `evento_id` int(10) unsigned NOT NULL,
  `imagem_id` int(10) unsigned NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_painel_edicao_evento1_idx` (`edicao_id`,`evento_id`),
  KEY `fk_painel_imagem1_idx` (`imagem_id`),
  CONSTRAINT `fk_painel_edicao_evento1` FOREIGN KEY (`edicao_id`) REFERENCES `edicao_evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_painel_imagem1` FOREIGN KEY (`imagem_id`) REFERENCES `imagem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `painel_edicao_evento`
--

LOCK TABLES `painel_edicao_evento` WRITE;
/*!40000 ALTER TABLE `painel_edicao_evento` DISABLE KEYS */;
INSERT INTO `painel_edicao_evento` VALUES (3,'Abertura','Cerimonia de abetturA',3,25,140,'2016-11-25','10:00:00','ativo'),(8,'Painel de avertura','Descrição painel jsdçgjfaso sg s   agsj a gj ',4,25,393,'2017-04-30','02:45:00','ativo'),(9,'dsvnvknx','\\jdhflasdgaks',4,25,399,'2017-05-25','05:00:00','ativo'),(10,'Fasdtjaçwlejt ttt','sldgKEAV RAE~ yyyyyy\r\nEYRÉLFDGG',77,25,415,'2017-06-16','23:01:00','inativo'),(11,'fdashlkashdflkhadlgkhasdlghdaslk','undezblçxcmbzc,.zmc çcbzxc,zbm zxb zfined',77,25,416,'2017-06-19','01:59:00','ativo'),(12,'Testando','undefineSFV  g,ahsldghIPSE FMDFBAJSGHOAS KJSF',77,25,443,'2017-07-11','00:01:00','ativo');
/*!40000 ALTER TABLE `painel_edicao_evento` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `periodo`
--

LOCK TABLES `periodo` WRITE;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
INSERT INTO `periodo` VALUES (1,'Manhã',1,'07:30:00','08:20:00'),(2,'Manhã',2,'08:20:00','09:10:00'),(3,'Manhã',3,'09:10:00','10:00:00'),(4,'Manhã',4,'10:15:00','11:00:00'),(5,'Manhã',5,'11:40:00','00:00:00'),(6,'Tarde',1,'13:00:00','13:50:00'),(7,'Tarde',2,'13:50:00','14:40:00'),(8,'Tarde',3,'14:40:00','15:45:00'),(9,'Tarde',4,'15:45:00','16:30:00'),(10,'Tarde',5,'16:30:00','17:15:00');
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissao`
--

DROP TABLE IF EXISTS `permissao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permissao` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `permissao_UNIQUE` (`permissao`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissao`
--

LOCK TABLES `permissao` WRITE;
/*!40000 ALTER TABLE `permissao` DISABLE KEYS */;
INSERT INTO `permissao` VALUES (4,'agenda'),(5,'aluno'),(3,'evento'),(2,'noticia'),(6,'professor'),(1,'total');
/*!40000 ALTER TABLE `permissao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissao_admin`
--

DROP TABLE IF EXISTS `permissao_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissao_admin` (
  `admin_id` int(11) NOT NULL,
  `permissao_id` varchar(45) NOT NULL,
  PRIMARY KEY (`admin_id`,`permissao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissao_admin`
--

LOCK TABLES `permissao_admin` WRITE;
/*!40000 ALTER TABLE `permissao_admin` DISABLE KEYS */;
INSERT INTO `permissao_admin` VALUES (1,'1'),(4,'2'),(4,'3'),(14,'2'),(14,'3');
/*!40000 ALTER TABLE `permissao_admin` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (1,'Cândido Luciano de Faria','1053174817','undefined','','ativo','public/images/logo/10-12-2016_15-17-04.jpg'),(2,'Jady Beatriz Müller','undefined','undefined','','ativo',NULL),(3,'Bruna Roberta de Azevedo',NULL,NULL,'','ativo',NULL),(4,'Priscila Fabiane Kasper','null','null','','ativo','public/images/logo/10-13-2016_16-48-20.jpg'),(6,'Marlon Lazzaretti','null','null','','ativo',NULL),(7,'Marlon Lazzaretti',NULL,NULL,'','ativo','public/images/logo/10-12-2016_15-19-12.jpg'),(8,' Marcos E. Frozza',NULL,NULL,'','ativo',NULL),(9,'Juçana Candemil',NULL,NULL,'','ativo',NULL),(11,'Tiago Espinosa de Oliveira',NULL,NULL,'','ativo',NULL),(12,'Cimol','999999','9999999','','ativo',NULL),(14,'Richard Fogaça',NULL,NULL,'','ativo',NULL),(15,'Gerson Carneiro de Souza',NULL,NULL,'','ativo',NULL),(16,'Aline Correia','undefined','undefined','','ativo','public/images/logo/10-12-2016_14-56-06.jpg'),(17,'Ana Carolina Magalhães dos Santos','undefined','undefined','','ativo','public/images/logo/10-12-2016_14-56-49.jpg'),(18,'Angelo Gabriel de Quadros Villas Boas','undefined','undefined','','ativo','public/images/logo/10-12-2016_14-58-09.jpg'),(19,'Augusto de Souza Corrêa','undefined','undefined','','ativo','public/images/logo/10-12-2016_14-59-14.jpg'),(20,'Brenda Filmann',NULL,NULL,'','ativo',NULL),(21,'Bruno Finimundi Port',NULL,NULL,'','ativo',NULL),(22,'Cátia Elizabete Nunes Silveira',NULL,NULL,'','ativo',NULL),(23,'Daiana da Silva Hahn',NULL,NULL,'','ativo',NULL),(24,'Karmem  Lúcia da Silva','2153689745','123.987.456-58','','ativo',''),(25,'Karmem  Lúcia da Silva','2153689745','123.987.456-58','','ativo',''),(26,'Karmem  Lúcia da Silva','2153689745','123.987.456-58','','ativo',''),(27,'Filomena Correia','undefined','undefined','','ativo','public/images/logo/10-12-2016_14-59-57.jpg'),(28,'Jonas Aires','undefined','undefined','','ativo','public/images/logo/10-12-2016_11-45-11.jpg'),(29,'Karmem  Lúcia da Silva','undefined','undefined','','ativo','public/images/logo/10-12-2016_12-31-57.jpg'),(30,'Jonas Aires','undefined','undefined','','ativo','public/images/logo/10-12-2016_11-43-50.jpg'),(31,'Gabriel Henrique Wagner','7895641258','753.159.741-96','','ativo','public/images/logo/10-12-2016_12-32-52.jpg'),(32,'Jonas Aires','undefined','undefined','','ativo','public/images/logo/10-12-2016_11-45-11.jpg'),(33,'Jonas Aires','undefined','undefined','','ativo','public/images/logo/10-12-2016_11-45-11.jpg'),(34,'Jonas Aires','undefined','undefined','','ativo','public/images/logo/10-12-2016_11-45-11.jpg'),(35,'Brenda Galas do Amaral','2578965485','895.876.652-98','','ativo','public/images/logo/10-12-2016_12-34-31.jpg'),(36,'Erai de Souza Jr','159863247','426.684.842-65','','ativo','public/images/logo/10-13-2016_15-59-40.jpg'),(37,'Almerinda de Souza','null','null','','ativo','public/images/logo/10-13-2016_16-20-57.jpg'),(38,'Odete Roitmann','null','null','','ativo','public/images/logo/10-13-2016_16-31-42.jpg'),(39,'Eleninha Vergara','null','null','','ativo','public/images/logo/10-13-2016_16-34-43.jpg'),(40,'Priscila Fabiane Kasperr','null','null','','ativo',NULL),(41,'Priscila Fabiane Kasperr','null','null','','ativo','public/images/logo/10-13-2016_16-40-06.jpg'),(42,'Priscila Fabiane Kasperr','null','null','','ativo',NULL),(43,'Priscila Fabiane Kasper','null','null','','ativo',NULL),(44,'Afroncio de Albuquerque','1585963247','154.563.254-85','','ativo','public/images/logo/10-13-2016_17-10-56.jpg'),(45,'Maria Leonora  de Poli Bersano','','','','ativo',NULL),(46,'Tiago Urich','00000000','00000000000','','ativo','public/images/logo/12-10-2016_10-04-11.jpg'),(47,'Luís Evaldo','00000000','00000000000','','ativo',''),(48,'Gustavo Lauck','00000000','00000000000','','ativo',''),(49,'Cassiano Kaiser','00000000','00000000000','','ativo',''),(50,'Paulo Mossmann','00000000','00000000000','','ativo',''),(51,'Camila Martins','00000000','00000000000','','ativo',''),(52,'Carina Souza','00000000','00000000000','','ativo',''),(53,'Fabiana Thiel','00000000','00000000000','','ativo',''),(54,'Ana Paula','00000000','00000000000','','ativo',''),(55,'Fabiano Hollweg','00000000','00000000000','','ativo',''),(56,'Vivian','00000000','00000000000','','ativo',''),(57,'Maicon Bandeira','00000000','00000000000','','ativo',''),(58,'Marcuse Guazina','00000000','00000000000','','ativo','public/images/logo/'),(59,'Jeane','00000000','00000000000','','ativo','public/images/logo/'),(60,'Tiago Mossmann','00000000','00000000000','','ativo','public/images/logo/'),(61,'Alexandre','00000000','00000000000','','ativo',''),(62,'Rory Mikalauscas','00000000','00000000000','','ativo',''),(63,'Márcia Cattani Moura','00000000','00000000000','','ativo',''),(64,'Gislaine dos Reis','00000000','00000000000','','ativo',''),(65,'Ariel Espinosa','00000000','00000000000','','ativo',''),(66,'Kamila ','00000000','00000000000','','ativo',''),(67,'Guilherme Lauck','00000000','00000000000','','ativo',''),(68,'Simone','00000000','00000000000','','ativo',''),(69,'Virgínia','00000000','00000000000','','ativo',''),(70,'Aline','00000000','00000000000','','ativo',''),(71,'Magda Kontz','00000000','00000000000','','ativo',''),(72,'Maria Luzia Espinossa','00000000000','00000000000','','ativo',''),(73,'hdfhdfh','123','123','','ativo',''),(74,'hdfghdg','54','5454','','ativo',''),(75,'zdjgoçaglk','14654','3132','','ativo',''),(76,'Rhdgfkjskldg sdfgsd','456','456','','ativo',''),(77,'Aluno teste','5546464','31','','ativo',''),(78,'Aluno teste','5546464','3123','','ativo',''),(79,'Aluno teste','3523','53245','','ativo','public/images/logo/05-18-2017_19-50-11.jpg'),(80,'sfkhfskhksfdçksfd','00','00','','ativo',''),(81,'sfkhfskhksfdçksfd','00','00','','ativo',''),(82,'fdjgçlsdfg','445','154','','ativo',''),(83,'gsgsdfgsd','43','34','','ativo',''),(84,'Marcia Fischer','00','00','','ativo',''),(85,'Marcia Fischer','00','00','','ativo',''),(86,'Regis da silva Souza','00','00','','ativo',''),(87,'cb zxbzvcb','00','00','','ativo','public/images/logo/06-18-2017_11-10-47.png');
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor`
--

LOCK TABLES `professor` WRITE;
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` VALUES (1,60,1,'','ativo'),(3,60,4,'','ativo'),(5,200,6,'','inativo'),(6,200,7,'','ativo'),(7,200,8,'','ativo'),(8,200,9,'','ativo'),(11,200,11,'','ativo'),(12,40,36,'','ativo'),(13,60,37,'','ativo'),(14,200,38,'','ativo'),(15,60,39,'','ativo'),(16,60,40,'','inativo'),(17,60,41,'','inativo'),(18,60,42,'','inativo'),(19,200,43,'','inativo'),(20,20,44,'','ativo'),(21,40,45,'','ativo'),(22,40,46,'','ativo'),(23,40,47,'','ativo'),(24,80,48,'','ativo'),(25,40,49,'','ativo'),(26,80,50,'','ativo'),(27,40,51,'','ativo'),(28,120,52,'','ativo'),(29,80,53,'','ativo'),(30,160,54,'','ativo'),(31,40,55,'','ativo'),(32,40,56,'','ativo'),(33,40,57,'','ativo'),(34,40,58,'','ativo'),(35,60,59,'','ativo'),(36,40,60,'','ativo'),(37,200,61,'','ativo'),(38,200,62,'','ativo'),(39,80,63,'','ativo'),(40,40,64,'','ativo'),(41,200,65,'','ativo'),(42,200,66,'','inativo'),(43,60,67,'','ativo'),(44,40,68,'','ativo'),(45,200,69,'','ativo'),(46,60,70,'','ativo'),(47,40,71,'','ativo'),(48,40,72,'','ativo'),(49,52,73,'','inativo'),(50,45,74,'','inativo'),(51,52,75,'','inativo'),(52,36,76,'','inativo'),(53,45,82,'','inativo'),(54,45,83,'','ativo'),(55,20,87,'','inativo');
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `sala`
--

LOCK TABLES `sala` WRITE;
/*!40000 ALTER TABLE `sala` DISABLE KEYS */;
INSERT INTO `sala` VALUES (1,'C-313'),(2,'C-202'),(3,'D-202');
/*!40000 ALTER TABLE `sala` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `segmento`
--

LOCK TABLES `segmento` WRITE;
/*!40000 ALTER TABLE `segmento` DISABLE KEYS */;
INSERT INTO `segmento` VALUES (1,'Técnico integrado ao ensino médio','anual','','ativo',40),(2,'Técnico','semestral','','ativo',0);
/*!40000 ALTER TABLE `segmento` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `segmento_curso`
--

LOCK TABLES `segmento_curso` WRITE;
/*!40000 ALTER TABLE `segmento_curso` DISABLE KEYS */;
INSERT INTO `segmento_curso` VALUES (1,10,3),(1,11,3),(1,12,3),(1,13,3),(1,14,3),(1,15,3),(1,16,3),(1,17,3),(1,24,3),(1,25,3),(2,10,3),(2,11,3),(2,16,3),(2,24,3),(2,25,3);
/*!40000 ALTER TABLE `segmento_curso` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefone`
--

LOCK TABLES `telefone` WRITE;
/*!40000 ALTER TABLE `telefone` DISABLE KEYS */;
INSERT INTO `telefone` VALUES (5,'51','98456211','',24,''),(6,'51','98456211','',25,''),(7,'51','98456211','',26,''),(13,'','','',33,''),(14,'','','',34,''),(15,'51','98456211','',29,''),(16,'51','99887766','',31,''),(17,'51','98526314','',27,''),(21,'51','9988 2211','',36,''),(25,'','','',40,''),(26,'','','',41,''),(27,'','','',42,''),(28,'','','',43,''),(29,'','','',44,''),(30,'51','982760231','',46,''),(31,'51','000000000','',47,''),(32,'','','',48,''),(33,'','','',49,''),(34,'','','',50,''),(35,'','','',51,''),(36,'','','',52,''),(37,'','','',53,''),(38,'','','',54,''),(39,'','','',55,''),(40,'','','',56,''),(41,'','','',57,''),(42,'','','',58,''),(43,'','','',59,''),(44,'','','',60,''),(45,'','','',61,''),(46,'','','',62,''),(47,'','','',63,''),(49,'','','',65,''),(50,'','','',66,''),(51,'','','',67,''),(52,'','','',68,''),(53,'','','',69,''),(54,'','','',70,''),(55,'','','',71,''),(56,'','','',72,''),(57,'51','99874551','',73,''),(58,'51','465465465','',74,''),(59,'51','15165','',75,''),(60,'51','987456','',76,''),(61,'51','997143142','',1,''),(62,'51','35411805','',1,''),(63,'51','651565','',82,''),(64,'51','4565','',83,''),(65,'51','156165156','',83,''),(66,'51','151651651561','',83,''),(67,'51','35422725','',84,''),(68,'51','35422725','',85,''),(69,'51','35411315','',86,''),(70,'51','984385805','',86,''),(71,'51','4654646','',87,'');
/*!40000 ALTER TABLE `telefone` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `turma`
--

LOCK TABLES `turma` WRITE;
/*!40000 ALTER TABLE `turma` DISABLE KEYS */;
INSERT INTO `turma` VALUES (1,'Info63',3,2016,1,16,'ativo'),(2,'Info 62',2,2016,1,16,'ativo'),(3,'Info 61',1,2016,1,16,'ativo');
/*!40000 ALTER TABLE `turma` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'8e665638d106886c63b6d1795e0925c2',1,'re9537g9ur9r1ajtr0s4sm8vs7','ativo',''),(2,'e10adc3949ba59abbe56e057f20f883e',2,'','ativo',''),(3,'e10adc3949ba59abbe56e057f20f883e',3,'','ativo',''),(4,'e643a956151011f8b1bb5331c9bbf0c4',14,'','ativo','');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-14 15:30:13
