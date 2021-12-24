-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.11-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para projcheckin
DROP DATABASE IF EXISTS `projcheckin`;
CREATE DATABASE IF NOT EXISTS `projcheckin` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `projcheckin`;

-- Copiando estrutura para tabela projcheckin.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela projcheckin.failed_jobs: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Copiando estrutura para tabela projcheckin.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela projcheckin.migrations: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2021_12_22_004720_create_table_all', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando estrutura para tabela projcheckin.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela projcheckin.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Copiando estrutura para tabela projcheckin.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela projcheckin.personal_access_tokens: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Copiando estrutura para tabela projcheckin.tb_aulas
DROP TABLE IF EXISTS `tb_aulas`;
CREATE TABLE IF NOT EXISTS `tb_aulas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `professor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duracao` int(11) NOT NULL,
  `qtdemaxalunos` int(11) NOT NULL,
  `hora` time NOT NULL,
  `data` date NOT NULL,
  `dhinicioaula` datetime NOT NULL,
  `dhfimaula` datetime NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_aulas_user_id_foreign` (`user_id`),
  CONSTRAINT `tb_aulas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela projcheckin.tb_aulas: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `tb_aulas` DISABLE KEYS */;
INSERT INTO `tb_aulas` (`id`, `nome`, `professor`, `duracao`, `qtdemaxalunos`, `hora`, `data`, `dhinicioaula`, `dhfimaula`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Curso de HTML', 'Wanderson Santos', 20, 3, '10:00:00', '2021-12-20', '2021-12-20 10:00:00', '2021-12-20 10:20:00', 1, '2021-12-24 06:20:40', '2021-12-24 06:20:40'),
	(2, 'Curso de PHP Básico', 'Wanderson Santos', 10, 2, '10:00:00', '2021-12-30', '2021-12-30 10:00:00', '2021-12-30 10:10:00', 1, '2021-12-24 06:21:14', '2021-12-24 06:21:14'),
	(3, 'Curso de SQL', 'Pedro', 25, 1, '11:00:00', '2021-12-20', '2021-12-20 11:00:00', '2021-12-20 11:25:00', 1, '2021-12-24 06:22:00', '2021-12-24 06:22:00');
/*!40000 ALTER TABLE `tb_aulas` ENABLE KEYS */;

-- Copiando estrutura para tabela projcheckin.tb_checkin
DROP TABLE IF EXISTS `tb_checkin`;
CREATE TABLE IF NOT EXISTS `tb_checkin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `aluno_id` bigint(20) unsigned NOT NULL,
  `aula_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_checkin_aluno_id_foreign` (`aluno_id`),
  KEY `tb_checkin_aula_id_foreign` (`aula_id`),
  CONSTRAINT `tb_checkin_aluno_id_foreign` FOREIGN KEY (`aluno_id`) REFERENCES `users` (`id`),
  CONSTRAINT `tb_checkin_aula_id_foreign` FOREIGN KEY (`aula_id`) REFERENCES `tb_aulas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela projcheckin.tb_checkin: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tb_checkin` DISABLE KEYS */;
INSERT INTO `tb_checkin` (`id`, `aluno_id`, `aula_id`, `created_at`, `updated_at`) VALUES
	(1, 2, 3, '2021-12-24 06:22:15', '2021-12-24 06:22:15'),
	(2, 2, 1, '2021-12-24 06:22:19', '2021-12-24 06:22:19'),
	(3, 3, 1, '2021-12-24 06:22:35', '2021-12-24 06:22:35'),
	(4, 3, 2, '2021-12-24 06:22:48', '2021-12-24 06:22:48');
/*!40000 ALTER TABLE `tb_checkin` ENABLE KEYS */;

-- Copiando estrutura para tabela projcheckin.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipocadastro` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela projcheckin.users: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `tipocadastro`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', 'admin@hotmail.com', NULL, '$2y$10$Ex/O0ZTgvd7QT9zkCI4a8uD69I2PY/p/kbV.R6VeObzZsPj2mcUPC', NULL, 'admin', '2021-12-24 06:19:25', '2021-12-24 06:19:25'),
	(2, 'Aluno 01', 'aluno1@hotmail.com', NULL, '$2y$10$90bbeRUyrivjHIKQ9sIEXORDZFaYeADWOKI0twd2eTW9OeMMDV9v.', NULL, 'aluno', '2021-12-24 06:19:47', '2021-12-24 06:19:47'),
	(3, 'Aluno 02', 'aluno2@hotmail.com', NULL, '$2y$10$MGMrQHFndBNr9nAHwrSTHOOL63G5WPVge/xx45uImOB8oeLUtXagO', NULL, 'aluno', '2021-12-24 06:20:03', '2021-12-24 06:23:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
