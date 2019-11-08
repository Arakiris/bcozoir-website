-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 05 sep. 2019 à 23:14
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP :  7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bcozoir_db`
--

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'member', NULL, NULL);

--
-- Déchargement des données de la table `statistics`
--

INSERT INTO `statistics` (`id`, `daily_visits`, `month_visits`, `since_creation_visits`, `last_update`, `created_at`, `updated_at`) VALUES
(1, 41, 41, 41, '2019-09-05 02:00:38', NULL, '2019-09-05 15:55:25');

--
-- Déchargement des données de la table `tournament_types`
--

INSERT INTO `tournament_types` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'BC Ozoir', NULL, NULL),
(2, 'Privé', NULL, NULL),
(3, 'Championnat Fédéral', NULL, NULL);

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Senior', NULL, NULL),
(2, 'Vétéran 1', NULL, NULL),
(3, 'Vétéran 2', NULL, NULL),
(4, 'Vétéran 3', NULL, NULL);

--
-- Déchargement des données de la table `clubs`
--

INSERT INTO `clubs` (`id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Ozoir', '4 Rue de la Tuilerie, 91160 Ballainvilliers', NULL, NULL),
(2, 'Champs-sur-Marne', 'Champs-sur-Marne', NULL, NULL),
(3, 'Paris', 'Paris', NULL, NULL);

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(1, '', '', '2019-09-04 16:15:41', '2019-09-04 16:15:41'),
(2, '', '', '2019-09-04 16:15:41', '2019-09-04 16:15:41'),
(3, '', '', '2019-09-04 16:15:41', '2019-09-04 16:15:41'),
(4, '', '', '2019-09-04 16:15:41', '2019-09-04 16:15:41'),
(5, '', '', '2019-09-04 16:15:42', '2019-09-04 16:15:42');

--
-- Déchargement des données de la table `content_informations`
--

INSERT INTO `content_informations` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'presentation', '', NULL, NULL),
(2, 'adresses', '', NULL, NULL),
(3, 'version', '', NULL, NULL),
(4, 'mentions légales', '', NULL, NULL);

--
-- Déchargement des données de la table `guests`
--

INSERT INTO `guests` (`id`, `guest_ip`, `last_activity`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', '2019-09-05 18:22:50', '2019-08-26 15:53:58', '2019-09-05 16:22:50');

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `club_id`, `category_id`, `first_name`, `last_name`, `sex`, `birth_date`, `is_licensee`, `id_licensee`, `handicap`, `bonus`, `is_active`, `historical_path`, `created_at`, `updated_at`, `listing_url`) VALUES
(1, 1, 1, 'Toto', 'Toto', 'm', '1988-05-06 00:00:00', 1, 'xtfduxftu', 0, 0, 1, NULL, '2019-08-26 15:54:45', '2019-08-26 15:54:45', NULL),
(2, 1, 1, 'Ruru', 'Ruru', 'm', '1987-04-04 00:00:00', 0, NULL, 0, 0, 1, NULL, '2019-08-26 15:55:05', '2019-08-26 15:55:05', NULL),
(3, 1, 1, 'titi', 'Titititi', 'm', '1985-06-06 00:00:00', 0, NULL, 0, 0, 1, NULL, '2019-08-26 15:55:36', '2019-08-26 15:55:36', NULL),
(4, 1, 1, 'Lili', 'Lili', 'm', NULL, 0, NULL, 0, 0, 1, NULL, '2019-08-26 15:55:46', '2019-08-26 15:55:46', NULL);

--
-- Déchargement des données de la table `partners`
--

INSERT INTO `partners` (`id`, `address`, `created_at`, `updated_at`, `title`, `url`) VALUES
(1, 'ARTS Traiteur : 18 Avenue du Général De Gaulle, 77610 Marles-en-Brie. Website www.arts-traiteur.com ☎ 01 64 42 68 38. ✉ artstraiteur@wanadoo.fr', '2019-09-03 15:32:18', '2019-09-04 16:19:52', 'ARTS traiteur', 'https://www.google.com/'),
(2, 'Extra-LaserBowl : 4 Rue Tuilerie, 91160 Ballainvilliers. Website www.extra-bowl.fr ☎ 01 64 54 89 39. ✉ decastro.christophe@gmail.com', '2019-09-03 17:24:46', '2019-09-04 16:38:26', 'Extra-LaserBowl', 'https://www.extra-laserbowl.fr/'),
(3, 'Pater Bowling Proshop - PEP\'s Bowling : Rond Point Val d\'Yerres, 91800 Boussy-Saint-Antoine. Website www.pepsbowling.fr ☎ 06 78 87 56 52. ✉ patmitch@wanadoo.fr', '2019-09-03 18:10:50', '2019-09-04 16:39:03', 'Pater Bowling Proshop', 'https://www.google.com/'),
(4, 'La Gondole : 2 Avenue Grimeler, 77330 Ozoir-la-Ferrière. ☎ 01 64 40 01 01.', '2019-09-03 18:11:04', '2019-09-04 16:39:49', 'La Gondole', 'https://www.tripadvisor.fr/Restaurant_Review-g187147-d2564666-Reviews-La_Gondole-Paris_Ile_de_France.html');

--
-- Déchargement des données de la table `tournaments`
--

INSERT INTO `tournaments` (`id`, `type_id`, `title`, `start_season`, `end_season`, `date`, `is_accredited`, `place`, `is_rules_pdf`, `rules_url`, `rules_pdf`, `lexer_url`, `listing`, `is_finished`, `report`, `slug`, `created_at`, `updated_at`, `formation`) VALUES
(1, 1, 'Yoyo', '2019-09-01 17:02:48', '2020-08-31 17:02:48', '2019-08-26 00:00:00', 0, 'Yoyo', 0, 'http://bcozoir.prg/administration/tournois/create', NULL, 'https://laravel.com/docs/master/eloquent-relationships#has-many-through', '/upload/medias/tournaments/1/GYeVYYnD0K64m0rtQtttjI099Ox88dDF6fMAfWz1.jpeg', 1, '<p>rdydrt ydrydrydry rydry dr ydr yrdy dr ydr ydr y</p>', 'yoyo-1', '2019-08-26 15:56:54', '2019-08-27 17:02:48', 1),
(2, 1, 'Rololo', '2018-09-01 23:20:31', '2019-08-31 23:20:31', '2018-06-06 00:00:00', 1, 'Rololo', 0, 'http://bcozoir.prg/administration/tournois/create', NULL, NULL, NULL, 1, NULL, 'rololo-2', '2019-08-30 17:01:08', '2019-09-01 23:20:31', 0),
(3, 1, 'Chut', '2018-09-01 22:44:47', '2019-08-31 22:44:47', '2018-03-06 00:00:00', 1, 'Chut', 0, 'http://bcozoir.prg/administration/tournois/create', NULL, NULL, NULL, 1, NULL, 'chut-3', '2019-08-30 17:01:47', '2019-08-30 22:44:47', 0),
(4, 1, 'Popo', '2017-09-01 17:51:27', '2018-08-31 17:51:27', '2017-06-06 00:00:00', 1, 'Popo', 0, 'http://bcozoir.prg/administration/tournois/create', NULL, NULL, NULL, 1, NULL, 'popo-4', '2019-08-30 17:34:07', '2019-08-30 17:51:27', 1),
(5, 1, 'nexus', '2016-09-01 23:08:36', '2017-08-31 23:08:36', '2016-06-06 00:00:00', 1, 'nexus', 0, 'http://bcozoir.prg/administration/tournois/create', NULL, 'http://bcozoir.prg/administration/tournois/create', NULL, 1, NULL, 'nexus-5', '2019-08-30 21:36:01', '2019-09-01 23:08:36', 0),
(6, 1, 'tiuxyuxty', '2017-09-01 23:08:49', '2018-08-31 23:08:49', '2017-04-06 00:00:00', 1, 'hxtfyhxtfy', 0, 'http://bcozoir.prg/administration/tournois/create', NULL, NULL, NULL, 1, '<p>sreydrsydry</p>', 'tiuxyuxty-6', '2019-09-01 23:08:09', '2019-09-01 23:08:49', 0),
(7, 1, 'uhilkvhuikvuhc', '2017-09-01 23:09:41', '2018-08-31 23:09:41', '2017-05-01 00:00:00', 1, 'ytucyucygu', 0, 'http://bcozoir.prg/administration/tournois/create', NULL, 'http://bcozoir.prg/administration/tournois/create', NULL, 1, NULL, 'uhilkvhuikvuhc-7', '2019-09-01 23:09:32', '2019-09-01 23:09:41', 1),
(8, 2, 'espoiytsjie', '2019-09-01 00:00:38', '2020-08-31 00:00:38', '2019-10-10 00:00:00', 1, 'xtfyixtyi', 0, 'https://www.google.com/', NULL, 'https://www.google.com/', NULL, 1, '<p>stygdryudrudyhgfhfg hfgh gfh</p>', 'espoiytsjie-8', '2019-09-05 00:00:20', '2019-09-05 00:00:38', 0);

--
-- Déchargement des données de la table `podia`
--

INSERT INTO `podia` (`id`, `tournament_id`, `date`, `slug`, `created_at`, `updated_at`, `is_ranking`) VALUES
(1, 1, '2019-08-26 00:00:00', 'yoyo-1', '2019-08-27 12:53:11', '2019-08-27 17:02:48', 0),
(2, 2, '2018-06-06 00:00:00', 'rololo-2', '2019-08-30 17:01:08', '2019-09-01 23:20:31', 1),
(3, 3, '2018-03-06 00:00:00', 'chut-3', '2019-08-30 17:09:00', '2019-08-30 21:37:10', 1),
(4, 4, '2017-06-06 00:00:00', 'popo-4', '2019-08-30 17:41:22', '2019-08-30 17:41:22', 1),
(5, 5, '2016-06-06 00:00:00', 'nexus-5', '2019-08-30 21:36:13', '2019-08-30 21:36:13', 1),
(6, 6, '2017-04-06 00:00:00', 'tiuxyuxty-6', '2019-09-01 23:08:09', '2019-09-01 23:08:49', 1),
(7, 7, '2017-05-01 00:00:00', 'uhilkvhuikvuhc-7', '2019-09-01 23:09:32', '2019-09-01 23:09:41', 1),
(8, 8, '2019-10-10 00:00:00', 'espoiytsjie-8', '2019-09-05 00:00:38', '2019-09-05 00:00:38', 1);

--
-- Déchargement des données de la table `teams`
--

INSERT INTO `teams` (`id`, `name`, `tournament_id`, `rank`, `order_display`, `created_at`, `updated_at`) VALUES
(5, 'Lulu', 1, '3eme', 3, '2019-08-27 00:14:49', '2019-08-27 15:22:34'),
(6, 'Riri', 1, NULL, NULL, '2019-08-27 00:22:31', '2019-08-27 00:22:31'),
(7, 'Yoyo', 1, '1er', 1, '2019-08-27 15:22:51', '2019-08-27 15:22:51'),
(8, 'spoeti', 4, 'zsêotyik', 1, '2019-08-30 17:51:53', '2019-08-30 17:51:53'),
(9, 'qtgrdyhgdfrt', 7, 'ftuftu', 1, '2019-09-01 23:09:52', '2019-09-01 23:09:52');


--
-- Déchargement des données de la table `member_team`
--

INSERT INTO `member_team` (`member_id`, `team_id`) VALUES
(1, 5),
(1, 9),
(2, 5),
(2, 6),
(3, 7),
(3, 8),
(4, 6),
(4, 7),
(4, 8),
(4, 9);

--
-- Déchargement des données de la table `member_tournament`
--

INSERT INTO `member_tournament` (`member_id`, `tournament_id`, `rank`, `order_display`) VALUES
(1, 1, '1er', 1),
(1, 2, '1er', 1),
(1, 3, '3eme', 2),
(1, 5, '3eme', 2),
(1, 6, NULL, NULL),
(1, 8, '3eme', 3),
(2, 1, NULL, NULL),
(2, 3, '1er', 1),
(2, 5, NULL, NULL),
(2, 6, '1er', 1),
(3, 5, '1er', 1),
(4, 1, '4eme', 4),
(4, 3, NULL, NULL),
(4, 5, '4eme', 3);

--
-- Déchargement des données de la table `pictures`
--

INSERT INTO `pictures` (`id`, `path`, `title`, `imageable_id`, `imageable_type`, `created_at`, `updated_at`) VALUES
(1, '/upload/images/partners/85QhEDQy6v6kpnwH4sZWVZC7IObRKuDfopa08u8R.png', NULL, 1, 'App\\Partner', '2019-09-03 15:32:18', '2019-09-03 15:32:18'),
(2, '/upload/images/partners/kqyjp5ohTcst7feiUA3JeDmAv9h8rRXkoxkZHO0h.jpeg', NULL, 2, 'App\\Partner', '2019-09-03 17:24:47', '2019-09-03 17:24:47'),
(3, '/upload/images/partners/SMXnD7qDciC6hQxg7bzuPbG9kmr1ZzIZu89fZ3Nh.jpeg', NULL, 3, 'App\\Partner', '2019-09-03 18:10:50', '2019-09-03 18:10:50'),
(4, '/upload/images/partners/Y7vQvqQkA98yvP4GPa47MtNcOOA1M5nCFSvpOlzI.jpeg', NULL, 4, 'App\\Partner', '2019-09-03 18:11:04', '2019-09-03 18:11:04');


--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `role_id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 1, 'abc@test.com', '$2y$10$iGkAVZwboWJBRLm9OaGK0.rHM2CIMMYtyXlfStZANshja7o7B1VNG', 'c1HnQc07V9kOG7neOZwvXdHVBjigzGouQuhMNukcnKbIXAjQX6jaoB7rwpkj', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
