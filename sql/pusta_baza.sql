-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Lut 2022, 20:24
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `pusta_baza`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `businesses`
--

CREATE TABLE `businesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `beds` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `main_category_id` int(11) NOT NULL,
  `name_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `businesses_categories`
--

CREATE TABLE `businesses_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Wesele'),
(2, 'Urodziny'),
(3, 'Komunia święta'),
(4, 'Chrzest'),
(5, 'Sale'),
(6, 'Fotograf'),
(7, 'Muzyka'),
(8, 'Dekoracje'),
(9, 'Atrakcje'),
(10, 'Wynajem'),
(11, 'Barman'),
(12, 'Uroda'),
(13, 'Barista'),
(14, 'Catering'),
(15, 'Animatorzy'),
(16, 'Artysta'),
(17, 'Cukiernia'),
(18, 'Fryzjer'),
(19, 'Garnitury'),
(20, 'Biżuteria'),
(21, 'Szkoła tańca'),
(22, 'Sala'),
(23, 'Lokal'),
(24, 'Hotel'),
(25, 'Pałac'),
(26, 'Dworek'),
(27, 'Zamek'),
(28, 'Gospoda'),
(29, 'Namiot'),
(30, 'Ogród'),
(31, 'Dom'),
(32, 'Kamerzysta'),
(33, 'Zespół muzyczny'),
(34, 'DJ'),
(35, 'Salon sukien'),
(36, 'Auto do wynajęcia'),
(37, 'Fotobudka'),
(38, 'Wynajem busów'),
(39, 'Artykuły'),
(40, 'Cięzki dym'),
(41, 'Balony'),
(42, 'Artysta'),
(43, 'Czekoladowa fontanna'),
(44, 'Dekoracje światłem'),
(45, 'Iluzjonista'),
(46, 'Bukiety'),
(47, 'Napis love'),
(48, 'Oprawa muzyczna'),
(49, 'Pokaz sztucznych ogni'),
(50, 'Pokaz tańca'),
(51, 'Pokazy laserowe'),
(52, 'Prezenty'),
(53, 'Słodki kącik'),
(54, 'Tort'),
(55, 'Teatr ognia'),
(56, 'Zaproszenia'),
(57, 'Pokaz barmański'),
(58, 'Pokaz laserowy'),
(59, 'Bańki mydlane'),
(60, 'Animatorzy dla dzieci'),
(61, 'Chodzenie na szczudłach'),
(62, 'Fontanna czekolady'),
(63, 'Słodki stół'),
(64, 'Szwedzki stół'),
(65, 'Gotowanie na miejscu'),
(66, 'Dowolne menu'),
(67, 'Kucharz'),
(68, 'Zastawki'),
(69, 'Dekoracja samochodu'),
(70, 'Etykiety na alkochol'),
(71, 'Podziękowania'),
(72, 'Upominki dla gości'),
(73, 'Balony z nadrukiem'),
(74, 'Dekoracja stołu'),
(75, 'Etykiekty na ciasto'),
(76, 'Kieliszki'),
(77, 'Kotyliony'),
(78, 'Ozdoby bibułowe'),
(79, 'Ozdoby na krzesła'),
(80, 'Serwetki'),
(81, 'Świece'),
(82, 'Dekoracja ściany'),
(83, 'Dekoracja sali'),
(84, 'Dekoracja kościołu'),
(85, 'Pokrowce na krzesła'),
(86, 'Makijaż'),
(87, 'Bus do wynajęcia'),
(88, 'Animator dla dzieci'),
(89, 'Bryczka do ślubu'),
(90, 'Fontanna czekoladowa'),
(91, 'Obrączki'),
(92, 'Gra na żywo'),
(93, 'Efekty świetlne'),
(94, 'Prowadzenie zabaw'),
(95, 'Wokalista'),
(96, 'Wokalistka'),
(97, 'Akordeon'),
(98, 'Saksofon'),
(99, 'Skrzypce'),
(100, 'Fotograf i kamerzysta'),
(101, '4K'),
(102, 'Dron'),
(103, 'Sesja plenerowa'),
(104, 'Sesja narzeczeńska'),
(105, 'Na godziny'),
(106, 'Na dni'),
(107, 'Kierowca'),
(108, 'Odbiór osobisty'),
(109, 'Nocleg'),
(110, 'Parking'),
(111, 'Taras'),
(112, 'Klimatyzacja'),
(113, 'Usługa'),
(114, 'Dojazd do klienta'),
(115, 'Sklep'),
(116, 'Prywatne projekty');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactable_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `costs`
--

CREATE TABLE `costs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `advance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `date_payment` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `group_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_event` date DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `groups`
--

INSERT INTO `groups` (`id`, `name`, `type`) VALUES
(1, 'attractionCategory', 'attractionCategory'),
(2, 'attractionSelectCategory', 'attractionSelectCategory'),
(3, 'cateringCategory', 'cateringCategory'),
(4, 'cateringSelectCategory', 'cateringSelectCategory'),
(5, 'decorationCategory', 'decorationCategory'),
(6, 'decorationSelectCategory', 'decorationSelectCategory'),
(7, 'mainCategory', 'mainCategory'),
(8, 'musicCategory', 'musicCategory'),
(9, 'musicSelectCategory', 'musicSelectCategory'),
(10, 'partyCategory', 'partyCategory'),
(11, 'photoCategory', 'photoCategory'),
(12, 'photoSelectCategory', 'photoSelectCategory'),
(13, 'rentCategory', 'rentCategory'),
(14, 'rentSelectCategory', 'rentSelectCategory'),
(15, 'roomCategory', 'roomCategory'),
(16, 'roomSelectCategory', 'roomSelectCategory'),
(17, 'servicesCategory', 'servicesCategory'),
(18, 'serviceCategory', 'serviceCategory'),
(19, 'servicesSelectCategory', 'servicesSelectCategory'),
(20, 'shopCategory', 'shopCategory'),
(21, 'shopSelectCategory', 'shopSelectCategory');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `groups_businesses`
--

CREATE TABLE `groups_businesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `groups_categories`
--

CREATE TABLE `groups_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `groups_categories`
--

INSERT INTO `groups_categories` (`id`, `icon_name`, `type`, `group_id`, `category_id`) VALUES
(1, '', 'default', 1, 9),
(2, '', 'default', 1, 57),
(3, '', 'default', 1, 49),
(4, '', 'default', 1, 50),
(5, '', 'default', 1, 58),
(6, '', 'default', 2, 59),
(7, '', 'default', 2, 60),
(8, '', 'default', 2, 16),
(9, '', 'default', 2, 61),
(10, '', 'default', 2, 40),
(11, '', 'default', 2, 43),
(12, '', 'default', 2, 37),
(13, '', 'default', 2, 45),
(14, '', 'default', 2, 47),
(15, '', 'default', 2, 57),
(16, '', 'default', 2, 50),
(17, '', 'default', 2, 51),
(18, '', 'default', 2, 55),
(19, '', 'default', 3, 14),
(20, '', 'default', 3, 62),
(21, '', 'default', 3, 63),
(22, '', 'default', 3, 64),
(23, '', 'default', 4, 65),
(24, '', 'default', 4, 66),
(25, '', 'default', 4, 67),
(26, '', 'default', 4, 68),
(27, '', 'default', 5, 8),
(28, '', 'default', 6, 41),
(29, '', 'default', 6, 69),
(30, '', 'default', 6, 70),
(31, '', 'default', 6, 71),
(32, '', 'default', 6, 72),
(33, '', 'default', 6, 73),
(34, '', 'default', 6, 74),
(35, '', 'default', 6, 75),
(36, '', 'default', 6, 76),
(37, '', 'default', 6, 77),
(38, '', 'default', 6, 78),
(39, '', 'default', 6, 79),
(40, '', 'default', 6, 80),
(41, '', 'default', 6, 81),
(42, '', 'default', 6, 47),
(43, '', 'default', 6, 82),
(44, '', 'default', 6, 83),
(45, '', 'default', 6, 84),
(46, '', 'default', 6, 85),
(47, '', 'default', 7, 22),
(48, '', 'default', 7, 6),
(49, '', 'default', 7, 32),
(50, '', 'default', 7, 34),
(51, '', 'default', 7, 35),
(52, '', 'default', 7, 33),
(53, '', 'default', 7, 36),
(54, '', 'default', 7, 8),
(55, '', 'default', 7, 37),
(56, '', 'default', 7, 11),
(57, '', 'default', 7, 12),
(58, '', 'default', 7, 86),
(59, '', 'default', 7, 18),
(60, '', 'default', 7, 87),
(61, '', 'default', 7, 88),
(62, '', 'default', 7, 56),
(63, '', 'default', 7, 16),
(64, '', 'default', 7, 13),
(65, '', 'default', 7, 89),
(66, '', 'default', 7, 14),
(67, '', 'default', 7, 40),
(68, '', 'default', 7, 90),
(69, '', 'default', 7, 59),
(70, '', 'default', 7, 47),
(71, '', 'default', 7, 44),
(72, '', 'default', 7, 19),
(73, '', 'default', 7, 45),
(74, '', 'default', 7, 46),
(75, '', 'default', 7, 91),
(76, '', 'default', 7, 57),
(77, '', 'default', 7, 49),
(78, '', 'default', 7, 50),
(79, '', 'default', 7, 51),
(80, '', 'default', 7, 52),
(81, '', 'default', 7, 63),
(82, '', 'default', 7, 56),
(83, '', 'default', 8, 33),
(84, '', 'default', 8, 34),
(85, '', 'default', 9, 92),
(86, '', 'default', 9, 93),
(87, '', 'default', 9, 94),
(88, '', 'default', 9, 95),
(89, '', 'default', 9, 96),
(90, '', 'default', 9, 97),
(91, '', 'default', 9, 98),
(92, '', 'default', 9, 99),
(93, '', 'default', 10, 1),
(94, '', 'default', 10, 2),
(95, '', 'default', 10, 3),
(96, '', 'default', 10, 4),
(97, '', 'default', 11, 6),
(98, '', 'default', 11, 32),
(99, '', 'default', 11, 100),
(100, '', 'default', 12, 101),
(101, '', 'default', 12, 102),
(102, '', 'default', 12, 103),
(103, '', 'default', 12, 104),
(104, '', 'default', 13, 10),
(105, '', 'default', 13, 36),
(106, '', 'default', 13, 87),
(107, '', 'default', 13, 89),
(108, '', 'default', 13, 37),
(109, '', 'default', 13, 47),
(110, '', 'default', 14, 105),
(111, '', 'default', 14, 106),
(112, '', 'default', 14, 107),
(113, '', 'default', 14, 108),
(114, '', 'default', 15, 22),
(115, '', 'default', 15, 23),
(116, '', 'default', 15, 24),
(117, '', 'default', 15, 25),
(118, '', 'default', 15, 26),
(119, '', 'default', 15, 27),
(120, '', 'default', 15, 28),
(121, '', 'default', 15, 29),
(122, '', 'default', 15, 30),
(123, '', 'default', 15, 31),
(124, '', 'default', 16, 109),
(125, '', 'default', 16, 110),
(126, '', 'default', 16, 111),
(127, '', 'default', 16, 112),
(128, '', 'default', 17, 113),
(129, '', 'default', 17, 11),
(130, '', 'default', 17, 12),
(131, '', 'default', 17, 18),
(132, '', 'default', 17, 88),
(133, '', 'default', 17, 16),
(134, '', 'default', 17, 13),
(135, '', 'default', 18, 22),
(136, '', 'default', 18, 23),
(137, '', 'default', 18, 24),
(138, '', 'default', 18, 25),
(139, '', 'default', 18, 26),
(140, '', 'default', 18, 27),
(141, '', 'default', 18, 28),
(142, '', 'default', 18, 29),
(143, '', 'default', 18, 30),
(144, '', 'default', 18, 31),
(145, '', 'default', 18, 6),
(146, '', 'default', 18, 32),
(147, '', 'default', 18, 100),
(148, '', 'default', 18, 33),
(149, '', 'default', 18, 34),
(150, '', 'default', 18, 35),
(151, '', 'default', 18, 36),
(152, '', 'default', 18, 37),
(153, '', 'default', 18, 38),
(154, '', 'default', 18, 39),
(155, '', 'default', 18, 40),
(156, '', 'default', 18, 41),
(157, '', 'default', 18, 16),
(158, '', 'default', 18, 43),
(159, '', 'default', 18, 44),
(160, '', 'default', 18, 45),
(161, '', 'default', 18, 46),
(162, '', 'default', 18, 47),
(163, '', 'default', 18, 48),
(164, '', 'default', 18, 49),
(165, '', 'default', 18, 50),
(166, '', 'default', 18, 51),
(167, '', 'default', 18, 52),
(168, '', 'default', 18, 53),
(169, '', 'default', 18, 54),
(170, '', 'default', 18, 55),
(171, '', 'default', 18, 56),
(172, '', 'default', 19, 114),
(173, '', 'default', 20, 115),
(174, '', 'default', 20, 35),
(175, '', 'default', 20, 56),
(176, '', 'default', 20, 19),
(177, '', 'default', 20, 46),
(178, '', 'default', 20, 91),
(179, '', 'default', 20, 52),
(180, '', 'default', 21, 116);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `groups_events`
--

CREATE TABLE `groups_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `guests`
--

CREATE TABLE `guests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `invitation` tinyint(1) NOT NULL DEFAULT 0,
  `confirmation` tinyint(1) NOT NULL DEFAULT 0,
  `accommodation` tinyint(1) NOT NULL DEFAULT 0,
  `diet` tinyint(1) NOT NULL DEFAULT 0,
  `type` enum('Dorosły','Dziecko','Niemowlę','Usługodawcy') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dorosły',
  `transport` tinyint(1) NOT NULL DEFAULT 0,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `likeables`
--

CREATE TABLE `likeables` (
  `likeable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `likeable_id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2020_10_12_165219_create_category_table', 1),
(6, '2021_09_04_001308_create_groups_table', 1),
(7, '2021_09_14_194935_create_notifications_table', 1),
(8, '2021_09_14_195734_create_business_table', 1),
(9, '2021_09_14_195951_create_cities_table', 1),
(10, '2021_09_14_204116_create_comments_table', 1),
(11, '2021_09_14_205205_create_likeables_table', 1),
(12, '2021_09_14_205428_create_photos_table', 1),
(13, '2021_09_15_010122_create_addresses_table', 1),
(14, '2021_09_15_010505_create_socials_table', 1),
(15, '2021_09_17_155126_create_questions_and_answers_table', 1),
(16, '2021_10_12_165426_create_businesses_categories_table', 1),
(17, '2021_10_13_163130_create_contacts_table', 1),
(18, '2021_10_20_225744_create_events_table', 1),
(19, '2021_10_20_225745_create_groups_events_table', 1),
(20, '2021_10_20_225757_create_tasks_table', 1),
(21, '2021_10_20_230255_create_guests_table', 1),
(22, '2021_10_20_230323_create_costs_table', 1),
(23, '2021_10_25_160859_create_services_table', 1),
(24, '2021_10_25_161410_create_reservations_table', 1),
(25, '2021_10_25_220249_create_groups_categories_table', 1),
(26, '2021_10_28_213929_create_statistics_category_table', 1),
(27, '2021_11_15_185941_create_statistics_table', 1),
(28, '2021_12_01_110337_create_opening_hours_table', 1),
(29, '2021_12_09_181916_create_groups_businesses_table', 1),
(30, '2022_01_13_202347_create_statistics_service_table', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `shown` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notification_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `opening_hours`
--

CREATE TABLE `opening_hours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `monday` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Zamknięte',
  `tuesday` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Zamknięte',
  `wednesday` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Zamknięte',
  `thursday` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Zamknięte',
  `friday` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Zamknięte',
  `saturday` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Zamknięte',
  `sunday` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Zamknięte',
  `business_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photoable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photoable_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `questions_and_answers`
--

CREATE TABLE `questions_and_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_business` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `people_from` int(11) NOT NULL,
  `people_to` int(11) DEFAULT NULL,
  `price_from` int(11) DEFAULT NULL,
  `price_to` int(11) DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) DEFAULT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `socials`
--

CREATE TABLE `socials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `www` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `movie_youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `statistics`
--

CREATE TABLE `statistics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `likes` int(11) NOT NULL DEFAULT 0,
  `reservations` int(11) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `statistics_category`
--

CREATE TABLE `statistics_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `stats` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `statistics_service`
--

CREATE TABLE `statistics_service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `reservations` int(11) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_task` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `group_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','moderator','user','business') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_business_id_foreign` (`business_id`);

--
-- Indeksy dla tabeli `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `businesses_user_id_foreign` (`user_id`);

--
-- Indeksy dla tabeli `businesses_categories`
--
ALTER TABLE `businesses_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indeksy dla tabeli `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `costs_group_id_foreign` (`group_id`);

--
-- Indeksy dla tabeli `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_user_id_foreign` (`user_id`);

--
-- Indeksy dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeksy dla tabeli `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `groups_businesses`
--
ALTER TABLE `groups_businesses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_businesses_business_id_foreign` (`business_id`);

--
-- Indeksy dla tabeli `groups_categories`
--
ALTER TABLE `groups_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `groups_events`
--
ALTER TABLE `groups_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_events_event_id_foreign` (`event_id`);

--
-- Indeksy dla tabeli `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guests_group_id_foreign` (`group_id`);

--
-- Indeksy dla tabeli `likeables`
--
ALTER TABLE `likeables`
  ADD KEY `likeables_user_id_foreign` (`user_id`);

--
-- Indeksy dla tabeli `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `opening_hours`
--
ALTER TABLE `opening_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `opening_hours_business_id_foreign` (`business_id`);

--
-- Indeksy dla tabeli `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeksy dla tabeli `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeksy dla tabeli `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `questions_and_answers`
--
ALTER TABLE `questions_and_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_and_answers_business_id_foreign` (`business_id`);

--
-- Indeksy dla tabeli `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_event_id_foreign` (`event_id`),
  ADD KEY `reservations_service_id_foreign` (`service_id`),
  ADD KEY `reservations_city_id_foreign` (`city_id`);

--
-- Indeksy dla tabeli `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_business_id_foreign` (`business_id`);

--
-- Indeksy dla tabeli `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `socials_business_id_foreign` (`business_id`);

--
-- Indeksy dla tabeli `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `statistics_business_id_foreign` (`business_id`);

--
-- Indeksy dla tabeli `statistics_category`
--
ALTER TABLE `statistics_category`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `statistics_service`
--
ALTER TABLE `statistics_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `statistics_service_service_id_foreign` (`service_id`);

--
-- Indeksy dla tabeli `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_group_id_foreign` (`group_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `businesses`
--
ALTER TABLE `businesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `businesses_categories`
--
ALTER TABLE `businesses_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT dla tabeli `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `costs`
--
ALTER TABLE `costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `groups_businesses`
--
ALTER TABLE `groups_businesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `groups_categories`
--
ALTER TABLE `groups_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT dla tabeli `groups_events`
--
ALTER TABLE `groups_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT dla tabeli `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `opening_hours`
--
ALTER TABLE `opening_hours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `questions_and_answers`
--
ALTER TABLE `questions_and_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `statistics_category`
--
ALTER TABLE `statistics_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `statistics_service`
--
ALTER TABLE `statistics_service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `businesses`
--
ALTER TABLE `businesses`
  ADD CONSTRAINT `businesses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `costs`
--
ALTER TABLE `costs`
  ADD CONSTRAINT `costs_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups_events` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `groups_businesses`
--
ALTER TABLE `groups_businesses`
  ADD CONSTRAINT `groups_businesses_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `groups_events`
--
ALTER TABLE `groups_events`
  ADD CONSTRAINT `groups_events_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `guests`
--
ALTER TABLE `guests`
  ADD CONSTRAINT `guests_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups_events` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `likeables`
--
ALTER TABLE `likeables`
  ADD CONSTRAINT `likeables_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `opening_hours`
--
ALTER TABLE `opening_hours`
  ADD CONSTRAINT `opening_hours_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `questions_and_answers`
--
ALTER TABLE `questions_and_answers`
  ADD CONSTRAINT `questions_and_answers_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `reservations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `socials`
--
ALTER TABLE `socials`
  ADD CONSTRAINT `socials_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `statistics`
--
ALTER TABLE `statistics`
  ADD CONSTRAINT `statistics_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `statistics_service`
--
ALTER TABLE `statistics_service`
  ADD CONSTRAINT `statistics_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups_events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
