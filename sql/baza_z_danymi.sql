-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Lut 2022, 20:23
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
-- Baza danych: `praca_inzynierska`
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

--
-- Zrzut danych tabeli `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `post_code`, `business_id`) VALUES
(6, 'Fajna 15', '22-523', 6),
(7, 'Lwowska 67', '14-632', 7),
(8, 'Podwisłocze 32', '12-521', 8),
(9, 'Warszawska 53', '32-213', 9),
(10, 'Łukasiewicza 42', '32-321', 10),
(11, 'Morska 15', '32-421', 11),
(12, 'Handlowa 99', '32-543', 12),
(13, 'Orzechowa 1', '32-524', 13),
(14, 'Dołowa 15', '32-767', 14);

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
  `rating` int(11) DEFAULT NULL,
  `beds` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_category_id` int(11) NOT NULL,
  `name_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `businesses`
--

INSERT INTO `businesses` (`id`, `name`, `title`, `description`, `short_description`, `rating`, `beds`, `main_category_id`, `name_category`, `user_id`, `city_id`) VALUES
(6, 'Wesoło', 'Sala weselno-bankietowa', 'Oferujemy Państwu sale bankietowo-weselną o wyjątkowym charakterze.\r\nSala jest duża i wygodna, otoczona pięknymi widokami na góry i las. Mamy też mniejszą salę do imprez kameralnych oraz pokoje gościnne dla ponad 100 osób z apartamentem dla nowożeńców. Oprócz sali stacjonarnej mamy sale namiotowe mobilne. Współpracujemy z artystami cukiernictwa, fotografii czy stylizacji wnętrz, zapewniając kompleksową obsługę, mamy dużo atrakcji dodatkowych. Jesteśmy po to, aby wspierać Państwa pomysły naszą wiedzą i doświadczeniem, uwzględniając indywidualne potrzeby i sugestie.\r\nOd lat będąc w branży, zbudowaliśmy sprawnie współdziałający zespół, posiadamy dużą i wygodną salę bankietową, mniejszą salę do imprez kameralnych oraz  pokoje gościnne dla ponad 100 osób z apartamentem dla nowożeńców. Nasza sala mieści się w pięknej malowniczej miejscowości obok Brzozowa. Wizytówką naszego regionu są Bieszczady, od których dzieli nas nie wielka odległość, co sprawia iż możemy zorganizować wesela plenerowe w wybranym przez Państwa miejscu - nad rzeką, w górach czy w leśnej scenerii.\r\nJesteśmy po to, aby wspierać Państwa pomysły naszą wiedzą i doświadczeniem, uwzględniając indywidualne potrzeby i sugestie. Współpracujemy z artystami cukiernictwa, fotografii czy stylizacji wnętrz, zapewniając kompleksową obsługę przed, w trakcie i po tych ważnych wydarzeniach w życiu naszych Klientów.', 'Najpiękniejsza sala na Twoje wesele! Szukasz miejsca, w którym będziesz mógł zorganizować niezapomniane przyjęcie weselne, komunijne, urodzinowe? Zapraszamy!', 0, '0', 22, 'room', 1, 3),
(7, 'Arttube', 'Zespół OMEN', 'Zespół Muzyczny *OMEN* 100% LIVE ‣ zespół funkcjonuje pod dwoma nazwami\r\n‣ Zespół Omen - wesela oraz\r\n‣ Popularni - koncerty - eventy\r\nnasze doświadczenie to ponad pół tysiąca zagranych imprez :)\r\nDlaczego właśnie powinniście wybrać nas ?\r\n\r\n1. gwarantujemy muzykę taneczną na żywo na najwyższym poziomie\r\n2. gramy na sprzęcie renomowanych firm: HK-Audio, Korg, Shure\r\n3. prowadzimy konferansjerkę oraz zabawy\r\n4. usłyszycie brzmienie stuletniego akordeonu\r\n5. w naszym repertuarze oprócz własnych utworów usłyszycie największe hity muzyczki tanecznej polskiej oraz zagranicznej\r\n6. szerokie instrumentarium spowoduje że poczujecie się wspaniale\r\n7. konferansjerka możliwa w 4 językach: angielskim, włoskim, niemieckim, hiszańskim\r\n8. autorskie zabawy których nie spotkacie nigdzie indziej\r\n9. usłyszycie jedyne w swoim rodzaju wykonanie utworu - Żono Moja - DiscoMana (propozycja na pierwszy taniec)\r\n10. podziękowanie dla rodziców w stylu góralskim \"Łociec z syćkie dni\" - specjalnie od naszego zespołu dopełni całości\r\n11. zależy ci bardzo na utworze którego nie mamy w repertuarze nie ma sprawy gramy również bloki z muzyka mechaniczną (nowość)\r\n12. poprowadzimy również imprezę w języku włoskim - nasza wokalistka Paulina uwielbia ten kraj oraz mówi również po włosku\r\n\r\nPewnie zauważyliście Państwo, że wpisując w Goglach frazę zespół muzyczny, zespół muzyczny Kraków, zespół na wesele Kraków, Małopolska – wyskakują różne zespoły, proponujące swoje usługi związane z obsługą muzyczną wesel oraz innych imprez okolicznościowych… i jak tu wybrać najlepszych?\r\n\r\nOprawa muzyczna wesela to nie tylko repertuar, a więc pewne szlagiery tzw. piosenki weselne w połączeniu z najnowszymi hitami muzyki polskiej i zagranicznej, ale również odpowiednia konferansjerka, prowadzenie wesela - które łącznie tworzą niezapomniany klimat wesela a muzyka na żywo stanowi jedyną w swoim rodzaju wspaniałą niepowtarzalną atmosferę przyjęcia weselnego :)', 'Najlepsi w Małopolsce na Twoim Weselu! ‣ Muzyka bez kompromisu :) Niezapomniana, czadowa impreza gwarantowana! dzwoń teraz zapytaj o wolny termin!', 0, NULL, 33, 'music', 1, 4),
(8, 'Fotka', 'Naturalna fotografia WEDDSTUDIO', 'Witam serdecznie,\r\n\r\nbardzo dziękuje za zainteresowanie naszym portfolio - będzie mi bardzo miło jeśli właśnie nas wybiorą Państwo na swojego fotografa ślubnego. Więcej o naszej pracy mogą powiedzieć nasi klienci z ostatnich lat. Opinie można znaleźć tutaj oraz w Recenzjach na naszym fanpage na facebooku - \"Weddstudio - fotografia i film ślubny\"\r\n\r\nWOLNE TERMINY 2021 oraz 2022 rok ( cennik na 2022 oraz sezonowe soboty może być droższy)\r\nZachęcamy do kontaktu telefonicznego lub mailowego\r\nPosiadamy ekipę video, która wykonuje nowoczesne filmy\r\nPosiadamy własną fotobudkę, którą wynajmujemy na wesela.\r\nZapraszamy na naszą stronę internetową.\r\nWystawiamy faktury.\r\n\r\n\r\nJesteśmy doświadczonym zespołem z świeżym spojrzeniem na fotografię ślubną. Podążamy za trendami oraz dysponujemy profesjonalnym sprzętem dzięki czemu mamy 100% zadowolonych klientów. Wykonujemy reportaże ślubne, sesje plenerowe, sesje narzeczeńskie oraz fotografię rodzinną. Pracujemy na pełnoklatkowych aparatach z jasnymi obiektywami. Nasze zdjęcia wykonujemy równolegle na dwóch niezależnych kartach pamięci, a następnie materiał trzymamy na 2 niezależnych nośnikach - wszystko po to aby Państwa materiał był bezpieczny. Z racji podobnego poziomu naszych umiejętności możemy obsługiwać kilka ślubów jednocześnie w całej Polsce. Wykonujemy także sesje plenerowe zza granicą, robiliśmy zdjęcia m. in. w Paryżu, Walencji, Weronie, Wenecji czy Londynie.', 'Specjalizujemy się w fotografii i filmie ślubnym. Bardzo chętnie wykonamy dla Państwa zdjęcia i film, które będą pamiątką na lata. Zachęcamy do przeczytania opinii naszych klientów oraz wyceny.', 0, NULL, 100, 'photo', 1, 3),
(9, 'Impresja', 'IMPRESJA - Dekoracje', 'Nasza firma - Impresja, istnieje na rynku od 2010 roku. Specjalizujemy się w kompleksowej obsłudze uroczystości ślubnych i weselnych,. Działamy na terenie województwa Podkarpackiego, a ponad to oferujemy, dekoracje kościoła, dekoracje światłem, dekoracje eventów, bukiety ślubne, krzesła chviari, napisy Love Miłość, My, Better Together i wiele innych, Fotolustro, wytwornica dymu', 'Impresja - dekoracje ślubne, florystyka, napisy świecące, krzesła chaviari, dekoracje kościoła, dekoracje weselne, dekoracje auta, plener, fotolustro, wytwornica dymu.', 0, NULL, 8, 'decoration', 1, 3),
(10, 'Co za bar', 'Co Za Bar! Profesjonalni Barmani!', 'Gwarantujemy kompleksową obsługę barmańska która spełni Państwa oczekiwania w 100%\r\n\r\nAtrakcyjne pakiety dopasowane do Państwa potrzeb oraz budżetu. Wszystkie stworzone z myślą o wygodzie i w trosce o Państwa cenny czas.\r\n\r\nZapewniamy:\r\n- perfekcyjną obsługę barmańska\r\n- mobilne bary\r\n- szeroki asortyment alkoholi, syropów, soków\r\n- menu dostępne na każdym stoliku i w formie elektronicznej\r\n- dojazd w cenie usługi\r\n- niezbędny sprzęt barmański, szkło, lód\r\n- konsultacje oraz pokaz barmański\r\n\r\nCocktail Atelier to przede wszystkim grupa przyjaciół dla których barmaństwo to pasja i sposób na życie.\r\nTo unikalne zestawienie osób których różne temperamenty i charaktery zbiegają się w wspólnym mianowniku czyli barmaństwie.\r\nGrupa Ekspertów którzy na co dzień piastują stanowiska menagerskie\r\noraz kierownicze w prestiżowych krakowskich restauracjach i hotelach.\r\nTo ludzie którzy kochają innych a za formę przekazu wybrali Barmaństwo', 'Lata doświadczenia w barmaństwie, przepyszne drinki i to wszystko połączone z potężną dawką humoru gwarantuje niezapomnianą zabawę.', 0, NULL, 57, 'attraction', 1, 3),
(11, 'Smacznie', 'Catering Ambrozja', 'Catering Ambrozja to rodzinna firma z bogatym doświadczeniem, tradycją i historią. Wyróżnia nas przede wszystkim to, że przedkładamy jakość nad ilość. Rozwijamy naszą pasję - jaką jest gotowanie - nieprzerwanie od wielu lat, dzięki czemu dysponujemy doświadczeniem, fachową wiedzą, rozbudowanym zapleczem gastronomicznym oraz profesjonalnym, kreatywnym personelem. Posiadamy doświadczenie w kompleksowej organizacji i obsłudze gastronomicznej różnego rodzaju imprez okolicznościowych, przez co Państwa przyjęcie zostanie zrealizowane od “A-Z” . Oprócz kwestii gastronomicznej zajmujemy się również dekoracją sal i kościołów. Jesteśmy bardzo elastyczni jeśli chodzi o dobór menu. Każdorazowo ustalamy i wyceniamy Państwa wybór indywidualnie. Dbamy o to, żeby przygotowane przez nas posiłki były nie tylko zdrowe i urozmaicone, ale przede wszystkim smaczne. Nasza profesjonalna obsługa kelnerska dołoży wszelkich starań, aby zapewnić Państwu i gościom niezwykłą atmosferę, która zapisze się wśród najlepszych wspomnień', 'Catering Ambrozja - kompleksowa organizacja imprez okolicznościowych, pełna obsługa oraz dekoracja sal weselnych.', 0, NULL, 14, 'catering', 1, 3),
(12, 'Sukienkowo', 'Salon Kaledonia - suknie ślubne', 'Uroczystość zaślubin to niewątpliwie jeden z najpiękniejszych dni w życiu każdej kobiety. W dniu ślubu pragniemy wyglądać elegancko, zmysłowo i niepowtarzalnie, wywołując zachwyt nie tylko w oczach narzeczonego. Misją, którą z przyjemnością realizujemy w naszych Salonach jest perfekcyjne dobieranie sukni do każdej z Pań, podkreślając jej osobowość oraz naturalne, kobiece piękno.\r\n\r\nDzięki rozmaitym wzorom kreacji, jesteśmy w stanie zaspokoić każde - nawet najbardziej wymagające gusta Klientek. Możliwość idealnego dopasowania dodatków gwarantuje satysfakcję z dokonanego wyboru, a kompleksowa obsługa oraz profesjonalne doradztwo to sposób na urzeczywistnianie Waszych wyobrażeń.\r\n\r\nW Salonach KALEDONIA znajdziesz wyjątkową ofertę sukien ślubnych, welonów, podwiązek, okryć oraz biżuterii. Czyli wszystko, co sprawia, że w tym dniu Panna Młoda wygląda jeszcze piękniej.\r\nZapewnimy Ci pełen komfort podczas wyboru sukni, doświadczenie i wsparcie. Pomożemy stworzyć idealny projekt i uszyjemy go z najwyższej jakości tkanin, z dbałością o każdy, nawet najmniejszy detal.\r\nWszystko po to, abyś nowy rozdział w swoim życiu u boku oczarowanego Ukochanego rozpoczęła jak najpiękniej!', 'Salony KALEDONIA to miejsce, w którym znajdziesz swoją najpiękniejszą suknię i stworzysz wyśnioną stylizację ślubną. Stawiamy na najwyższą jakość i dbałość o najmniejszy detal.', 0, NULL, 35, 'shop', 1, 3),
(13, 'Fryzjerkowo', 'Salon fryzjerski', 'Salon fryzjerski, który swoją szeroką ofertę kieruje do wszystkich, którzy chcą wyglądać pięknie każdego dnia.\r\n\r\nW ramach usług fryzjerskich polecamy:\r\n- strzyżenie damskie/męskie/dziecięce,\r\n- strzyżenie zarostu,\r\n- ombre/sombre/flamboyage/baleyage,\r\n- koloryzacja/dekoloryzacja,\r\n- loki, koki, upięcia, pół upięcia,\r\n- pielęgnacja i regeneracja\r\n\r\nZapraszamy!', 'Zapraszamy do naszego Studia, gdzie nasi styliści pomogą dobrać i wykonają fryzurę, upięcie, które podkreślą podniosłość chwili!', 0, NULL, 18, 'services', 1, 3),
(14, 'Samochody', 'Bentley, Maserati, Jaguar, Phantom, Excalibur.', 'Firma „Rentier” powstała w 2010 r. Świadczymy profesjonalne usługi w zakresie wynajmu samochodów z kierowcą na ślub i inne uroczystości. Działalność prowadzona jest na terenie całego kraju. W swej ofercie posiadamy bogaty wybór wysokiej klasy limuzyn, od luksusowych po osobliwości rzadko spotykane na polskich drogach. Wszystkie limuzyny są własnością firmy „Rentier”. Samochody są białego koloru i posiadają jasne wnętrza. Samochody są pięcioosobowe.\r\nNaszą misją jest dbanie o najwyższą jakość świadczonych przez nas usług i idące za tym zadowolenie Klientów. Posiadamy wieloletnie doświadczenie, które zaprocentowało wieloma pozytywnymi opiniami. Możemy pochwalić się współpracą z telewizją TVN. Swoje usługi świadczyliśmy na potrzeby realizacji programów tj.:\r\n• Mam Talent,\r\n• Ślub od pierwszego wejrzenia,\r\n• Damy i wieśniaczki,\r\n• I nie opuszczę Cię aż do ślubu.\r\n\r\nLimuzyny prowadzą doświadczeni, kulturalni i odpowiednio ubrani kierowcy.\r\nNa życzenie Klientów, zapewniamy gustowne wystrojenie samochodów.\r\nW prezencie dla Państwa Młodych schłodzona lampka szampana z pamiątkowym zdjęciem podczas podróży.', 'Auto do ślubu lub wynajmu.', 0, NULL, 36, 'rent', 1, 5);

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
(105, 'Nocleg'),
(106, 'Parking'),
(107, 'Taras'),
(108, 'Klimatyzacja'),
(109, 'Usługa'),
(110, 'Dojazd do klienta'),
(111, 'Sklep'),
(112, 'Prywatne projekty'),
(115, 'keyboard'),
(116, 'perkusja'),
(117, 'trąbka'),
(118, 'Fotoksiążka'),
(119, 'Album tradycyjny'),
(120, 'Odbiór od klienta');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'lkl'),
(2, 'jlk'),
(3, 'Rzeszów'),
(4, 'Krosno'),
(5, 'Tarnów');

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

--
-- Zrzut danych tabeli `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `surname`, `phone`, `contactable_type`, `contactable_id`) VALUES
(1, 'Natalia', 'Firma', '231312313', 'App\\Models\\User', 1),
(2, 'jlk', 'jlkjlkj', 'lkjlk', 'App\\Models\\Business', 1),
(3, 'lkj', 'lkjl', 'jlk', 'App\\Models\\Business', 2),
(4, 'Patryk', 'Kowalski', '223567128', 'App\\Models\\User', 2),
(5, 'Ola', 'Nowa', '256234546', 'App\\Models\\Business', 3),
(6, 'Ola', 'Nowa', '256234546', 'App\\Models\\Business', 4),
(7, 'Ola', 'Nowa', '256234546', 'App\\Models\\Business', 5),
(8, 'Ola', 'Nowa', '256234546', 'App\\Models\\Business', 6),
(9, 'Stanisław', 'Kokosz', '243563475', 'App\\Models\\Business', 7),
(10, 'Daniel', 'Foto', '321412412', 'App\\Models\\Business', 8),
(11, 'Katarzyna', 'Kowalska', '325325324', 'App\\Models\\Business', 9),
(12, 'Natalia', 'Firma', '234141242', 'App\\Models\\Business', 10),
(13, 'Natalia', 'Firma', '421412412', 'App\\Models\\Business', 11),
(14, 'Maja', 'Pawlak', '345692562', 'App\\Models\\Business', 12),
(15, 'Natalia', 'Firma', '231312313', 'App\\Models\\Business', 13),
(16, 'Natalia', 'Firma', '231312313', 'App\\Models\\Business', 14);

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

--
-- Zrzut danych tabeli `costs`
--

INSERT INTO `costs` (`id`, `name`, `note`, `cost`, `quantity`, `advance`, `date_payment`, `status`, `group_id`) VALUES
(1, 'Tort', NULL, '2000', '1', '0', '2022-02-17', 0, 1),
(2, 'Kurs tańca', '', '0', '1', '0', NULL, 0, 1),
(3, 'Zaproszenia', '', '0', '1', '0', NULL, 0, 1),
(4, 'Sala urodzinowa', NULL, '1000', '1', '0', '2022-02-28', 0, 2),
(5, 'Dekoracja sali', '', '0', '1', '0', NULL, 0, 2),
(6, 'Fotograf', '', '0', '1', '0', NULL, 0, 2),
(7, 'Catering', '', '0', '1', '0', NULL, 0, 2),
(8, 'Zespół muzyczny', '', '0', '1', '0', NULL, 0, 2),
(9, 'Fryzjer', '', '0', '1', '0', NULL, 0, 2),
(10, 'Kupić ubranie na urodziny', NULL, '500', '1', '0', NULL, 0, 3),
(11, '[Wynajem] Koszty oferty jlkj', '', '0', '1', '0', NULL, 0, 2),
(12, 'Tort', '', '0', '1', '0', NULL, 0, 13),
(13, 'Kurs tańca', '', '0', '1', '0', NULL, 0, 13),
(14, 'Zaproszenia', '', '0', '1', '0', NULL, 0, 13),
(15, 'Sala weselna', '', '0', '1', '0', NULL, 0, 14),
(16, 'Dekoracja sali', '', '0', '1', '0', NULL, 0, 14),
(17, 'Dekoracja kościoła', '', '0', '1', '0', NULL, 0, 14),
(18, 'Fotograf', '', '0', '1', '0', NULL, 0, 14),
(19, 'Catering', '', '0', '1', '0', NULL, 0, 14),
(20, 'Zespół muzyczny', '', '0', '1', '0', NULL, 0, 14),
(21, 'Wynajem auta', '', '0', '1', '0', NULL, 0, 14),
(22, 'Fryzjer', '', '0', '1', '0', NULL, 0, 14),
(23, 'Makijażystka', '', '0', '1', '0', NULL, 0, 14),
(24, 'Kupić suknie ślubną', '', '0', '1', '0', NULL, 0, 15),
(25, 'Kupić garnitur do ślubu', '', '0', '1', '0', NULL, 0, 15),
(26, 'Kupić obrączki', '', '0', '1', '0', NULL, 0, 15),
(27, 'Tort', '', '0', '1', '0', NULL, 0, 24),
(28, 'Kurs tańca', '', '0', '1', '0', NULL, 0, 24),
(29, 'Zaproszenia', '', '0', '1', '0', NULL, 0, 24),
(30, 'Sala weselna', '', '0', '1', '0', NULL, 0, 25),
(31, 'Dekoracja sali', '', '0', '1', '0', NULL, 0, 25),
(32, 'Dekoracja kościoła', '', '0', '1', '0', NULL, 0, 25),
(33, 'Fotograf', '', '0', '1', '0', NULL, 0, 25),
(34, 'Catering', '', '0', '1', '0', NULL, 0, 25),
(35, 'Zespół muzyczny', '', '0', '1', '0', NULL, 0, 25),
(36, 'Wynajem auta', '', '0', '1', '0', NULL, 0, 25),
(37, 'Fryzjer', '', '0', '1', '0', NULL, 0, 25),
(38, 'Makijażystka', '', '0', '1', '0', NULL, 0, 25),
(39, 'Kupić suknie ślubną', '', '0', '1', '0', NULL, 0, 26),
(40, 'Kupić garnitur do ślubu', '', '0', '1', '0', NULL, 0, 26),
(41, 'Kupić obrączki', '', '0', '1', '0', NULL, 0, 26);

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

--
-- Zrzut danych tabeli `events`
--

INSERT INTO `events` (`id`, `name`, `budget`, `date_event`, `category_id`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'eqweqw', '10000', '2022-02-17', 2, '2022-02-07 02:22:20', '2022-02-07 02:29:02', 2),
(2, 'wesele', '5000', '2022-02-01', 1, '2022-02-07 07:58:33', '2022-02-07 07:58:33', 2),
(3, 'wesele', '5000', '2022-02-01', 1, '2022-02-07 07:59:18', '2022-02-07 07:59:18', 2);

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
(14, 'roomCategory', 'roomCategory'),
(15, 'roomSelectCategory', 'roomSelectCategory'),
(16, 'servicesCategory', 'servicesCategory'),
(17, 'serviceCategory', 'serviceCategory'),
(18, 'servicesSelectCategory', 'servicesSelectCategory'),
(19, 'shopCategory', 'shopCategory'),
(20, 'shopSelectCategory', 'shopSelectCategory');

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

--
-- Zrzut danych tabeli `groups_businesses`
--

INSERT INTO `groups_businesses` (`id`, `name`, `type`, `business_id`) VALUES
(15, 'party', 'party', 6),
(16, 'additional', 'additional', 6),
(17, 'user', 'user', 6),
(18, 'party', 'party', 7),
(19, 'additional', 'additional', 7),
(20, 'user', 'user', 7),
(21, 'party', 'party', 8),
(22, 'additional', 'additional', 8),
(23, 'user', 'user', 8),
(24, 'party', 'party', 9),
(25, 'additional', 'additional', 9),
(26, 'user', 'user', 9),
(27, 'party', 'party', 10),
(28, 'additional', 'additional', 10),
(29, 'user', 'user', 10),
(30, 'party', 'party', 11),
(31, 'additional', 'additional', 11),
(32, 'user', 'user', 11),
(33, 'party', 'party', 12),
(34, 'additional', 'additional', 12),
(35, 'user', 'user', 12),
(36, 'party', 'party', 13),
(37, 'additional', 'additional', 13),
(38, 'user', 'user', 13),
(39, 'party', 'party', 14),
(40, 'user', 'user', 14);

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
(110, '', 'default', 14, 22),
(111, '', 'default', 14, 23),
(112, '', 'default', 14, 24),
(113, '', 'default', 14, 25),
(114, '', 'default', 14, 26),
(115, '', 'default', 14, 27),
(116, '', 'default', 14, 28),
(117, '', 'default', 14, 29),
(118, '', 'default', 14, 30),
(119, '', 'default', 14, 31),
(120, '', 'default', 15, 105),
(121, '', 'default', 15, 106),
(122, '', 'default', 15, 107),
(123, '', 'default', 15, 108),
(124, '', 'default', 16, 109),
(125, '', 'default', 16, 11),
(126, '', 'default', 16, 12),
(127, '', 'default', 16, 18),
(128, '', 'default', 16, 88),
(129, '', 'default', 16, 16),
(130, '', 'default', 16, 13),
(131, '', 'default', 17, 22),
(132, '', 'default', 17, 23),
(133, '', 'default', 17, 24),
(134, '', 'default', 17, 25),
(135, '', 'default', 17, 26),
(136, '', 'default', 17, 27),
(137, '', 'default', 17, 28),
(138, '', 'default', 17, 29),
(139, '', 'default', 17, 30),
(140, '', 'default', 17, 31),
(141, '', 'default', 17, 6),
(142, '', 'default', 17, 32),
(143, '', 'default', 17, 100),
(144, '', 'default', 17, 33),
(145, '', 'default', 17, 34),
(146, '', 'default', 17, 35),
(147, '', 'default', 17, 36),
(148, '', 'default', 17, 37),
(149, '', 'default', 17, 38),
(150, '', 'default', 17, 39),
(151, '', 'default', 17, 40),
(152, '', 'default', 17, 41),
(153, '', 'default', 17, 16),
(154, '', 'default', 17, 43),
(155, '', 'default', 17, 44),
(156, '', 'default', 17, 45),
(157, '', 'default', 17, 46),
(158, '', 'default', 17, 47),
(159, '', 'default', 17, 48),
(160, '', 'default', 17, 49),
(161, '', 'default', 17, 50),
(162, '', 'default', 17, 51),
(163, '', 'default', 17, 52),
(164, '', 'default', 17, 53),
(165, '', 'default', 17, 54),
(166, '', 'default', 17, 55),
(167, '', 'default', 17, 56),
(168, '', 'default', 18, 110),
(169, '', 'default', 19, 111),
(170, '', 'default', 19, 35),
(171, '', 'default', 19, 56),
(172, '', 'default', 19, 19),
(173, '', 'default', 19, 46),
(174, '', 'default', 19, 91),
(175, '', 'default', 19, 52),
(176, '', 'default', 20, 112),
(177, NULL, 'business', 1, 1),
(178, NULL, 'business', 1, 2),
(179, NULL, 'business', 1, 3),
(180, NULL, 'business', 1, 4),
(181, NULL, 'business', 3, 2),
(182, NULL, 'business', 3, 3),
(183, NULL, 'business', 3, 4),
(184, NULL, 'business', 4, 66),
(185, NULL, 'business', 4, 67),
(186, NULL, 'business', 4, 68),
(187, NULL, 'business', 5, 113),
(188, NULL, 'business', 5, 114),
(189, 'brak', 'service', 9, 6),
(190, 'brak', 'service', 9, 14),
(191, 'brak', 'service', 9, 34),
(192, 'brak', 'service', 9, 22),
(193, 'brak', 'service', 9, 8),
(194, 'brak', 'service', 21, 6),
(195, 'brak', 'service', 21, 14),
(196, 'brak', 'service', 21, 33),
(197, 'brak', 'service', 21, 36),
(198, 'brak', 'service', 21, 35),
(199, 'brak', 'service', 21, 22),
(200, 'brak', 'service', 21, 8),
(201, 'brak', 'service', 32, 6),
(202, 'brak', 'service', 32, 14),
(203, 'brak', 'service', 32, 33),
(204, 'brak', 'service', 32, 36),
(205, 'brak', 'service', 32, 35),
(206, 'brak', 'service', 32, 22),
(207, 'brak', 'service', 32, 8),
(208, NULL, 'business', 6, 1),
(209, NULL, 'business', 6, 2),
(210, NULL, 'business', 6, 3),
(211, NULL, 'business', 6, 4),
(212, NULL, 'business', 7, 105),
(213, NULL, 'business', 7, 106),
(214, NULL, 'business', 7, 107),
(215, NULL, 'business', 7, 108),
(216, NULL, 'business', 8, 11),
(217, NULL, 'business', 8, 47),
(218, NULL, 'business', 8, 53),
(219, NULL, 'business', 8, 40),
(220, NULL, 'business', 9, 1),
(221, NULL, 'business', 9, 2),
(222, NULL, 'business', 9, 3),
(223, NULL, 'business', 9, 4),
(224, NULL, 'business', 10, 105),
(225, NULL, 'business', 10, 106),
(226, NULL, 'business', 10, 107),
(227, NULL, 'business', 10, 108),
(228, NULL, 'business', 12, 1),
(229, NULL, 'business', 12, 2),
(230, NULL, 'business', 12, 3),
(231, NULL, 'business', 12, 4),
(232, NULL, 'business', 13, 105),
(233, NULL, 'business', 13, 106),
(234, NULL, 'business', 13, 107),
(235, NULL, 'business', 13, 108),
(236, NULL, 'business', 15, 1),
(237, NULL, 'business', 15, 2),
(238, NULL, 'business', 15, 3),
(239, NULL, 'business', 15, 4),
(240, NULL, 'business', 16, 105),
(241, NULL, 'business', 16, 106),
(242, NULL, 'business', 16, 107),
(243, NULL, 'business', 16, 108),
(244, NULL, 'business', 18, 1),
(245, NULL, 'business', 18, 2),
(246, NULL, 'business', 19, 92),
(247, NULL, 'business', 19, 94),
(248, NULL, 'business', 19, 95),
(249, NULL, 'business', 19, 96),
(250, NULL, 'business', 19, 97),
(251, NULL, 'business', 19, 98),
(252, NULL, 'business', 19, 99),
(253, NULL, 'business', 20, 115),
(254, NULL, 'business', 20, 116),
(255, NULL, 'business', 20, 117),
(256, NULL, 'business', 21, 1),
(257, NULL, 'business', 21, 2),
(258, NULL, 'business', 21, 3),
(259, NULL, 'business', 21, 4),
(260, NULL, 'business', 22, 101),
(261, NULL, 'business', 22, 103),
(262, NULL, 'business', 22, 104),
(263, NULL, 'business', 23, 118),
(264, NULL, 'business', 23, 119),
(265, NULL, 'business', 23, 37),
(266, NULL, 'business', 24, 1),
(267, NULL, 'business', 24, 2),
(268, NULL, 'business', 24, 3),
(269, NULL, 'business', 24, 4),
(270, NULL, 'business', 25, 41),
(271, NULL, 'business', 25, 69),
(272, NULL, 'business', 25, 74),
(273, NULL, 'business', 25, 79),
(274, NULL, 'business', 25, 82),
(275, NULL, 'business', 25, 83),
(276, NULL, 'business', 25, 85),
(277, NULL, 'business', 27, 1),
(278, NULL, 'business', 27, 2),
(279, NULL, 'business', 28, 57),
(280, NULL, 'business', 30, 1),
(281, NULL, 'business', 30, 2),
(282, NULL, 'business', 30, 3),
(283, NULL, 'business', 30, 4),
(284, NULL, 'business', 31, 66),
(285, NULL, 'business', 31, 68),
(286, NULL, 'business', 33, 1),
(287, NULL, 'business', 34, 112),
(288, NULL, 'business', 36, 1),
(289, NULL, 'business', 36, 2),
(290, NULL, 'business', 36, 3),
(291, NULL, 'business', 36, 4),
(292, NULL, 'business', 37, 110),
(293, NULL, 'business', 39, 1),
(294, NULL, 'business', 40, 110),
(295, NULL, 'business', 40, 120);

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

--
-- Zrzut danych tabeli `groups_events`
--

INSERT INTO `groups_events` (`id`, `name`, `type`, `color`, `event_id`) VALUES
(1, 'Opłaty', 'cost', '#F64C32', 1),
(2, 'Usługi', 'cost', '#F64C32', 1),
(3, 'Sklepy', 'cost', '#F64C32', 1),
(4, 'Zadania', 'task', '#09A4DB', 1),
(5, 'Rezerwacje', 'task', '#09A4DB', 1),
(6, 'Dokumenty', 'task', '#09A4DB', 1),
(7, 'Rodzina', 'guest', NULL, 1),
(8, 'Znajomi', 'guest', NULL, 1),
(9, 'Usługi', 'service', NULL, 1),
(10, 'Usługi', 'task', NULL, 1),
(11, 'Goście specjjalni', 'guest', '#000000', 1),
(12, 'swqeqe', 'guest', NULL, 1),
(13, 'Opłaty', 'cost', '#F64C32', 2),
(14, 'Usługi', 'cost', '#F64C32', 2),
(15, 'Sklepy', 'cost', '#F64C32', 2),
(16, 'Zadania', 'task', '#09A4DB', 2),
(17, 'Rezerwacje', 'task', '#09A4DB', 2),
(18, 'Dokumenty', 'task', '#09A4DB', 2),
(19, 'Rodzina', 'guest', NULL, 2),
(20, 'Znajomi', 'guest', NULL, 2),
(21, 'Usługi', 'service', NULL, 2),
(22, 'Nocleg', 'guest', NULL, 2),
(23, 'Transport', 'guest', NULL, 2),
(24, 'Opłaty', 'cost', '#F64C32', 3),
(25, 'Usługi', 'cost', '#F64C32', 3),
(26, 'Sklepy', 'cost', '#F64C32', 3),
(27, 'Zadania', 'task', '#09A4DB', 3),
(28, 'Rezerwacje', 'task', '#09A4DB', 3),
(29, 'Dokumenty', 'task', '#09A4DB', 3),
(30, 'Rodzina', 'guest', NULL, 3),
(31, 'Znajomi', 'guest', NULL, 3),
(32, 'Usługi', 'service', NULL, 3),
(33, 'Nocleg', 'guest', NULL, 3),
(34, 'Transport', 'guest', NULL, 3);

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

--
-- Zrzut danych tabeli `guests`
--

INSERT INTO `guests` (`id`, `name`, `surname`, `invitation`, `confirmation`, `accommodation`, `diet`, `type`, `transport`, `note`, `group_id`) VALUES
(1, 'Patryk', 'Paściak', 1, 0, 1, 0, 'Dorosły', 0, NULL, 7);

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

--
-- Zrzut danych tabeli `notifications`
--

INSERT INTO `notifications` (`id`, `content`, `content_type`, `status`, `shown`, `created_at`, `updated_at`, `notification_type`, `notification_id`) VALUES
(1, 'Nowa rezerwacja oferty jlkj', 'blueNotification', 0, 0, '2022-02-07 02:28:00', NULL, 'App\\Models\\Business', 1),
(2, '[Wynajem] Wysłano prośbę o rezerwację oferty jlkj.', 'blueNotification', 1, 0, '2022-02-07 02:28:00', NULL, 'App\\Models\\Event', 1),
(3, 'Rezerwacja oferty jlkj została anulowana', 'redNotification', 0, 0, '2022-02-07 02:32:35', NULL, 'App\\Models\\Business', 1),
(4, '[Wynajem] Rezerwacja oferty jlkj została anulowana.', 'redNotification', 1, 0, '2022-02-07 02:32:35', NULL, 'App\\Models\\Event', 1);

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

--
-- Zrzut danych tabeli `opening_hours`
--

INSERT INTO `opening_hours` (`id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `business_id`) VALUES
(3, '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', 'Zamknięte', 'Zamknięte', 6),
(4, '8-00:20:00', '8-00:20:00', '8-00:20:00', '8-00:20:00', '8-00:20:00', '8-00:20:00', 'Zamknięte', 7),
(5, '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', 8),
(6, '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', 'Zamknięte', 'Zamknięte', 9),
(7, '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', '12:00-20:00', 'Zamknięte', 10),
(8, '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', 'Zamknięte', 'Zamknięte', 11),
(9, '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', 'Zamknięte', 'Zamknięte', 12),
(10, '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', '8:00-16:00', 'Zamknięte', 13),
(11, '8:00-20:00', '8:00-20:00', '8:00-20:00', '8:00-20:00', '8:00-20:00', '8:00-20:00', '8:00-20:00', 14);

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

--
-- Zrzut danych tabeli `photos`
--

INSERT INTO `photos` (`id`, `photoable_type`, `photoable_id`, `path`) VALUES
(1, 'App\\Models\\User', 1, 'photos/bC0EZOPLWBCcI7SvF2afm2me2VhOh3jbJMThO5yn.png'),
(2, 'App\\Models\\Business', 3, 'photos/edzyOnXm0MayUkRHYajH9asZBbz2hFARdV3fnJgL.jpg'),
(3, 'App\\Models\\Business', 3, 'photos/HAnxdsVdLAkQyKsaJ8umxSaPuw2uQKygjibTuy24.jpg'),
(4, 'App\\Models\\Service', 3, 'photos/qdtJsg7OEvJ8p07OdOPQbOZAwyFACGDryTEwd7MA.jpg'),
(5, 'App\\Models\\Service', 3, 'photos/xU35BeZvPS7bpPTkzYN8BplhK9LJ9ggMJIdPtDYw.jpg'),
(6, 'App\\Models\\Service', 3, 'photos/RJWzXWMhcryCoE1uywopKGP2PZXAonOjp9fKeQ4L.jpg'),
(7, 'App\\Models\\Business', 4, 'photos/SdzzWajCXQTgomZ4mRZmBMwuSxeyYdrGX8wBQXff.jpg'),
(8, 'App\\Models\\Business', 4, 'photos/uJVWC1x5FvMRpwkxxOgMso5Z1Tgf61YvKLwoNP6P.jpg'),
(9, 'App\\Models\\Service', 4, 'photos/T3wDpM9UR2Scm6Ei8KSXwez7bP9dmMm9n28tM811.jpg'),
(10, 'App\\Models\\Service', 4, 'photos/47tmMVnPFL0oedxCnmasoRDiZI4oY5uxRr4xLPUc.jpg'),
(11, 'App\\Models\\Service', 4, 'photos/4rEKti2swf6SuhsbmJYPVYhtgYSruCBaiJQaJC3a.jpg'),
(12, 'App\\Models\\Business', 5, 'photos/wq7jgIGM7oxceklPLEfeDCAveOay8MBfhBAIVUlH.jpg'),
(13, 'App\\Models\\Business', 5, 'photos/GjOTbPfu64v8EaMmEgGkBZpD4RcmQDloe7CRCfAz.jpg'),
(14, 'App\\Models\\Service', 5, 'photos/yKnpKtE9eXBBO7yErDsCzvIqJokKSpQMSVdrf6Op.jpg'),
(15, 'App\\Models\\Service', 5, 'photos/R3F9X4YcuoNQ0eWRfZnnl7aJS3SnYUolYftpQUfW.jpg'),
(16, 'App\\Models\\Service', 5, 'photos/2UF4QvagJiG0uMAfbC2em2FTDxTnfpMSsvwiz9v6.jpg'),
(17, 'App\\Models\\Business', 6, 'photos/Jg3YWwGVopZ1oLrksPVli5eWEbO3Aw1IYiaxSnPQ.jpg'),
(18, 'App\\Models\\Business', 6, 'photos/0ImXVrxXzhkaQVEPgDNG2gF6fSaZiyMwWGeBlFvb.jpg'),
(19, 'App\\Models\\Service', 6, 'photos/bY88Qk584XqyxAuD4zfK9ueJMad2BmDpp31JqIgl.jpg'),
(20, 'App\\Models\\Service', 6, 'photos/2doRGruPjWehkorIPkann8Y5kdTd7RSkQwHOgIHA.jpg'),
(21, 'App\\Models\\Service', 6, 'photos/zUFacn2Lwf7uytF6LGmXGAYEKSjcdSiFyjMmtXNw.jpg'),
(22, 'App\\Models\\Business', 7, 'photos/PgXG26HWLf65p4i4AvwJnIAkBRCCiKZ6bHcJNuc1.jpg'),
(23, 'App\\Models\\Service', 7, 'photos/1rHBgYFsQKkLb82jxfdrHolQoWuCwpcMA9pxNUuv.jpg'),
(24, 'App\\Models\\Business', 8, 'photos/tMp49n5QowwpxladU4GHKcb72aAa9hthtrKDZ040.jpg'),
(25, 'App\\Models\\Service', 8, 'photos/YWzxLtGAepO3LGALKpkQ9RkvBk1AyRqNuKoiFPs8.jpg'),
(26, 'App\\Models\\Business', 9, 'photos/NhCjv3Tqd3P7bY8J9MPLdGA5zc8z4BqOIodAvEhz.jpg'),
(27, 'App\\Models\\Service', 9, 'photos/fpR1PJU2k7WwxNpeYOzPGSVeAUe8q6IMgIaPMT6w.jpg'),
(28, 'App\\Models\\Business', 10, 'photos/xInkuW7STv7XGSofOUdEOuTykrumZ6kWxZJyRXqn.jpg'),
(29, 'App\\Models\\Service', 10, 'photos/sbsufLnrDJWXcT6EjghMVc0ssTW3YDZNo2Pbdcvs.jpg'),
(30, 'App\\Models\\Service', 10, 'photos/55eIctyI3lL5Aentw29kBHSq3iSZidYNIWjWDmCA.jpg'),
(31, 'App\\Models\\Business', 11, 'photos/Q9qhw8PizLqr7NDJJaw7CeY7ld7G6YpPD6MmBcYv.jpg'),
(32, 'App\\Models\\Service', 11, 'photos/JmKQdKCtWVtTB79qGHmURJ8j3MOXZOYi1G7gQj19.jpg'),
(33, 'App\\Models\\Service', 11, 'photos/G2EfrTjHk3Lg2A4b2o6wE7R0GAAKtP8hszrBdjIF.jpg'),
(34, 'App\\Models\\Service', 11, 'photos/WdDGKW8xG90OQGG2yiC00Z0136jr3jvXbXmBWpyh.jpg'),
(35, 'App\\Models\\Business', 12, 'photos/7xUdTNlhos6SotkLVa47Vah9JcaRYQEAghGO8zSn.jpg'),
(36, 'App\\Models\\Service', 12, 'photos/HTuTxiGnifNm2tQVL9ZyBGNBZpNJSFOw6TRcSwTV.jpg'),
(37, 'App\\Models\\Service', 12, 'photos/8PpGbaD4snJw7m7ZQBvOqhz7l18CKBhqPRiGCxaN.jpg'),
(38, 'App\\Models\\Business', 13, 'photos/a4DwOobmrRLsJ82qpdqYUaMp7fQX42nnIs6W8eA5.jpg'),
(39, 'App\\Models\\Service', 13, 'photos/1GZVv7Izw7MAYdDvPz1YGjRlyohnb1sLbftnq4lE.jpg'),
(40, 'App\\Models\\Service', 13, 'photos/haS03HhgvYeqHUsHDLy4m6niOSJ3c9t4cC6Kvnlq.jpg'),
(41, 'App\\Models\\Service', 13, 'photos/a5wGR3VeTo7d8sQUGtt1cw2JAsVkWel4WaD2D3Vm.jpg'),
(42, 'App\\Models\\Business', 14, 'photos/PXnnEiCfg6RdIZj0Sszj9J9SGFtAGeKA0KWfwRET.jpg'),
(43, 'App\\Models\\Service', 14, 'photos/XN4NCPQNFpJOF5Nv9MyChv1K0irMNcerGrLBMGNE.jpg'),
(44, 'App\\Models\\Service', 15, 'photos/VBQIgNKrBNuqeO7wzPdVMOriAF2Xa3csaIBrxJZE.jpg'),
(45, 'App\\Models\\Service', 16, 'photos/VEEFoRB3ssMOX5eH1cMbwvJG5L8uZ7ys29FI4OVf.jpg'),
(46, 'App\\Models\\Service', 17, 'photos/oM7CnplKnfyi6IeEyB5d7CSchDjh2Kpv6xVtFrzh.jpg');

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

--
-- Zrzut danych tabeli `questions_and_answers`
--

INSERT INTO `questions_and_answers` (`id`, `question`, `answer`, `business_id`) VALUES
(3, 'Jakie jest nasze wykształcenie muzyczne?', 'większość muzyków posiada wykształcenie wokalistka jest autorką tekstów natomiast lider kompozytorem i multiinstrumentalistą również dyrygentem i organistą', 7),
(4, 'Kiedy rozpoczęła się nasza przygoda z muzyką?', 'Zespól tworzy muzykę tu i teraz i gwarantuje wrażenia na najwyższym poziomie muzyczno-artystycznym', 7),
(5, 'Jakie jest nasze podejście do zabaw integracyjnych na weselu?', 'zabawy integracyjne jak najbardziej na tak - ale trzeba to robić z wyczuciem i wiedzieć kiedy zrealizować dana zabawę w czasie', 7),
(6, 'Nasze sposoby na \"rozkręcenie\" wolno rozwijającej się imprezy.', 'z nami nikt nie podpiera ścian, ale to już nasz słodki sekret jak to robimy ;)', 7),
(7, 'Najbardziej nietypowe miejsce, w którym zagraliśmy.', 'Na starym starze w Sosnowcu podczas Dni Sosnowca ale to już lata temu :)', 7),
(8, 'Czy możecie zaproponować własną listę utworów?', 'nie trzeba nie polecamy ingerować w listę utworów ewentualnie możecie coś wykreślić :)', 7),
(9, 'Czy oferujemy efekty świetlne w trakcie prowadzenia imprezy?', 'tak światło ledowe, kurtyna świetlna, głowy ruchome, dym', 7),
(10, 'Czy zrealizujemy dla Ciebie sesję zagraniczną?', 'Sesje zagraniczne do tej pory robiłem Włochy i Portugalia, ale nie ograniczam się tylko do tych lokacji.', 8),
(11, 'Jakie miejsca Pary Młode najczęściej wybierają na sesje plenerowe?', 'Nigdy nie robiłem zdjęć plenerowych w tych samych miejscach, ale mam swoje perełki.', 8),
(12, 'Najbardziej nietypowe miejsce, w którym realizowaliśmy usługę.', 'To piękne wspomnienie z Portugalii gdzie właścicielka pięknej posesji na klifie udostępniła nam swojego bajkowego ogrodu.', 8),
(13, 'Czy jesteśmy w stanie spersonalizować usługę na Wasze życzenie?', 'Właściwie to nie ma dwóch identycznych ślub więc i usługi są personalizowane indywidualnie.', 8),
(14, 'Czy słabe oświetlenie jest dla nas przeszkodą?', 'Mam swoje oświetlenie, często to co oferuje sala nie pozwala bez niego zrobić dobrych zdjęć, nawet przy jasnych obiektywach.', 8),
(15, 'Nasze osiągnięcia i wyróżnienia artystyczne.', 'Fotografia artystyczna, którą zajmuję się dodatkowo jest dodatkową zaletą przy tworzeniu zdjęć z duszą.', 8),
(16, 'Na jakim sprzęcie pracujemy?', 'Pracuję tylko na profesjonalnym sprzęcie, a mój Staff to Canon i DJI', 8),
(17, 'Dlaczego warto skorzystać z naszej oferty?', 'Wyróżnia nas rodzinna atmosfera. Menu, wystrój sal jest ustalana przyjaźnie i indywidualnie', 11),
(18, 'Jak wygląda pierwsze spotkanie z nami i czy jest płatne?', 'Oczywiście ze nie. Na pierwszym spotkaniu ustalamy termin oraz opowiadamy na pytania', 11),
(19, 'W jaki sposób pomagamy osobom niezdecydowanym, bez skonkretyzowanej wizji?', 'W naszym zespołem pracuje młode i kreatywne osoby które zawsze maja świetne i nowoczesne pomysły.', 11);

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

--
-- Zrzut danych tabeli `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `people_from`, `people_to`, `price_from`, `price_to`, `unit`, `size`, `business_id`) VALUES
(6, 'Wynajem sali', 'Od lat będąc w branży, zbudowaliśmy sprawnie współdziałający zespół, posiadamy dużą i wygodną salę bankietową, mniejszą salę do imprez kameralnych oraz  pokoje gościnne dla ponad 100 osób z apartamentem dla nowożeńców. Nasza sala mieści się w pięknej malowniczej miejscowości obok Brzozowa. Wizytówką naszego regionu są Bieszczady, od których dzieli nas nie wielka odległość, co sprawia iż możemy zorganizować wesela plenerowe w wybranym przez Państwa miejscu - nad rzeką, w górach czy w leśnej scenerii.\r\nJesteśmy po to, aby wspierać Państwa pomysły naszą wiedzą i doświadczeniem, uwzględniając indywidualne potrzeby i sugestie. Współpracujemy z artystami cukiernictwa, fotografii czy stylizacji wnętrz, zapewniając kompleksową obsługę przed, w trakcie i po tych ważnych wydarzeniach w życiu naszych Klientów.', 40, 250, 5000, 12000, 'za imprezę', 900, 6),
(7, 'Nasza oferta', 'OMEN to zespół muzyczny z okolic Krakowa, a dokładniej z Gminy Liszki, który od wielu lat towarzyszy Państwu w tej niezapomnianej chwili jaką jest przyjęcie weselne\r\nZespół O!MEN to najczęściej wybierana kapela w Małopolsce!\r\n\r\n‣ Szkoda czasu na szukanie\r\nSpełnij marzenia o swoim niepowtarzalnym i jedynym zespole weselnym \"OMEN\"\r\n\r\n‣ Dobry zespół to: kapela ludowa, gwiazda rocka, gorący klimat latino, żywiołowa muzyka góralska oraz gwiazda disco, czy disco polo w jednym\r\nZespół muzyczny OMEN łączy te wszystkie cechy', 4, 5, 4000, 6000, 'za imprezę', NULL, 7),
(8, 'Fotografia', 'Podążamy za trendami oraz dysponujemy profesjonalnym sprzętem dzięki czemu mamy 100% zadowolonych klientów. Wykonujemy reportaże ślubne, sesje plenerowe, sesje narzeczeńskie oraz fotografię rodzinną. Pracujemy na pełnoklatkowych aparatach z jasnymi obiektywami. Nasze zdjęcia wykonujemy równolegle na dwóch niezależnych kartach pamięci, a następnie materiał trzymamy na 2 niezależnych nośnikach - wszystko po to aby Państwa materiał był bezpieczny.', 1, 3, 3000, 5000, 'za imprezę', NULL, 8),
(9, 'Dekoracje', 'Łamiemy schematy. Na każdym przyjęciu dodajemy coś od siebie - czego jeszcze nigdzie nie było ! Tutaj profesjonalizm i doświadczenie idzie w parze z optymizmem i szaleństwem.\r\nNuda, kicz i banał nie są zaproszeni na Wasz ślub.\r\nOgromne uznanie i zaufanie wśród Par Młodych.\r\nWieloletnie doświadczenie.\r\nGwarantowany sukces ! ;)', 2, 8, 1500, 6000, 'za imprezę', NULL, 9),
(10, 'Pokaz barmański', 'Lata doświadczenia w barmaństwie pozwala nam tworzyć koktaile idealnie dopasowane do preferencji gości.\r\nPaństwo młodzi chcą aby ich ulubiony drink dodać do naszego menu lub skomponować własne? Nie ma problemu!\r\nGość ma ochotę na weselu na coś spoza karty drinków? Z największą przyjemnością!\r\nNasi barmani na codzień pracują w najlepszych coctail barach co pozwala nam zagwarantować Państwu obsługę na najwyższym poziomie.', 2, 4, 100, 150, 'za godzinę', NULL, 10),
(11, 'Menu ogólne', 'Dysponujemy odpowiednim zapleczem gastronomicznym, oraz sprzętem pozwalającym\r\nprzygotować każdy rodzaj imprezy w dowolnie wybranym przez Państwa miejscu na terenie Podkarpacia i Małopolski.\r\n\r\nW naszej ofercie znajdziecie również możliwość wynajęcia : w pełni wyposażone mobilne drink bary, roll bary, grille, namioty plenerowe, ławo stoły, krzesła i stoły bankietowe, mobilne chłodnie\r\nfontanny czekoladowe i inne.\r\n\r\nDo każdego przedsięwzięcia podchodzimy indywidualnie i z największą starannością.\r\nPolecamy smaczne, estetycznie podane dania oraz fachową odpowiedzialną obsługę.', 2, 6, 100, 150, 'za osobę', NULL, 11),
(12, 'Suknie', 'Dzięki rozmaitym wzorom kreacji, jesteśmy w stanie zaspokoić każde - nawet najbardziej wymagające gusta Klientek. Możliwość idealnego dopasowania dodatków gwarantuje satysfakcję z dokonanego wyboru, a kompleksowa obsługa oraz profesjonalne doradztwo to sposób na urzeczywistnianie Waszych wyobrażeń.', 1, 2, 1000, 20000, 'za suknię', NULL, 12),
(13, 'Strzyżenie', 'W ramach usług fryzjerskich polecamy:\r\n- strzyżenie damskie/męskie/dziecięce,\r\n- strzyżenie zarostu,\r\n- ombre/sombre/flamboyage/baleyage,\r\n- koloryzacja/dekoloryzacja,\r\n- loki, koki, upięcia, pół upięcia,\r\n- pielęgnacja i regeneracja', 1, 1, 50, 600, 'za osobę', NULL, 13),
(14, 'Bentley', 'Jedna z najstarszych i najbardziej szanowanych marek na świecie. Bentley Flying Spur to brytyjska klasyka elegancji. Synonim bogactwa i najwyższej klasy. Łączy w sobie tradycję i dostojność. Oferowany Nowożeńcom, którzy cenią sobie wytworność i komfort.', 1, 1, 200, 200, 'za godzinę', NULL, 14),
(15, 'Maserati', 'Marka idąca z duchem czasu. Obecnie jest jedną z najbardziej pożądanych na świecie. Maserati Quattroporte prezentuje włoski i dynamiczny styl. To wyjątkowe połączenie sportowego charakteru z elegancją. Oferowany Nowożeńcom preferującym prestiżowe modele limuzyn.', 1, 1, 250, 250, 'za godzinę', NULL, 14),
(16, 'Jaguar XJ', 'Jaguar to legendarna brytyjska marka ekskluzywnych i najbardziej rozpoznawalnych sportowych samochodów świata. Szczególnie pożądany i ceniony za efektowność i wyjątkowość. Jaguar XJ oferowany jest Nowożeńcom, którzy wybierają nowoczesność i sportowy styl.', 1, 1, 300, 300, 'za godzinę', NULL, 14),
(17, 'Chrysler 300c', 'Jedna z najbardziej popularnych marek samochodowych na rynku amerykańskim. Ceniona za niepowtarzalny design. Chrysler 300c jest przestronny i komfortowy. Linia auta jest ponadczasowa i zawsze stylowa. Ekskluzywny wygląd samochodu sprawia, że najczęściej wybierany jest przez Nowożeńców preferujących klasykę i elegancję.', 1, 1, 300, 300, 'za godzinę', NULL, 14);

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

--
-- Zrzut danych tabeli `socials`
--

INSERT INTO `socials` (`id`, `facebook`, `instagram`, `www`, `youtube`, `movie_youtube`, `business_id`) VALUES
(6, NULL, NULL, 'http://planeteon.pl/?utm_source=weselezklasa&utm_medium=www', NULL, NULL, 6),
(7, 'https://www.facebook.com/zespolomen/', 'https://www.instagram.com/zespolpopularni/', 'https://zespolomen.pl/?utm_source=weselezklasa&utm_medium=www', NULL, NULL, 7),
(8, 'https://www.facebook.com/weddstudio', 'https://www.instagram.com/weddstudio.pl/', 'https://weddstudio.pl/?utm_source=weselezklasa&utm_medium=www', NULL, NULL, 8),
(9, NULL, NULL, 'https://impresja-dekoracje.pl/?utm_source=weselezklasa&utm_medium=www', NULL, NULL, 9),
(10, 'https://www.facebook.com/cozabar.info', 'https://www.instagram.com/cozabar/', 'https://cozabar.pl/?utm_source=weselezklasa&utm_medium=www', NULL, NULL, 10),
(11, NULL, NULL, 'http://cateringambrozja.pl/?utm_source=weselezklasa&utm_medium=www', NULL, NULL, 11),
(12, NULL, NULL, NULL, NULL, NULL, 12),
(13, NULL, NULL, NULL, NULL, NULL, 13),
(14, NULL, NULL, 'http://samochod-na-slub.pl/?utm_source=weselezklasa&utm_medium=www', NULL, NULL, 14);

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

--
-- Zrzut danych tabeli `statistics`
--

INSERT INTO `statistics` (`id`, `views`, `likes`, `reservations`, `date`, `business_id`) VALUES
(2, 0, 0, 0, '2022-02-07', 6),
(3, 0, 0, 0, '2022-02-07', 7),
(4, 0, 0, 0, '2022-02-07', 12),
(5, 1, 0, 0, '2022-02-07', 14);

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

--
-- Zrzut danych tabeli `statistics_category`
--

INSERT INTO `statistics_category` (`id`, `type`, `category_id`, `stats`) VALUES
(3, 'Urodziny', 6, 3),
(4, 'Urodziny', 14, 3),
(5, 'Urodziny', 34, 1),
(6, 'Urodziny', 22, 3),
(7, 'Urodziny', 8, 3),
(8, 'Wesele', 6, 2),
(9, 'Wesele', 14, 3),
(10, 'Wesele', 33, 2),
(11, 'Wesele', 36, 2),
(12, 'Wesele', 35, 2),
(13, 'Wesele', 22, 3),
(14, 'Wesele', 8, 2),
(15, 'room', 11, 1),
(16, 'room', 47, 1),
(17, 'room', 53, 1),
(18, 'room', 40, 1),
(19, 'music', 115, 1),
(20, 'music', 116, 1),
(21, 'music', 117, 1),
(22, 'photo', 118, 1),
(23, 'photo', 119, 1),
(24, 'photo', 37, 1),
(25, 'rent', 110, 1),
(26, 'rent', 120, 1);

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

--
-- Zrzut danych tabeli `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `end_task`, `status`, `group_id`) VALUES
(1, 'Określić planowaną liczbę gości', NULL, 1, 4),
(2, 'Wybrać miejsce urodzin', NULL, 1, 4),
(3, 'Ustalić listę gości', NULL, 1, 4),
(4, 'Wysłać zaproszenia', NULL, 1, 4),
(5, 'Ustalić muzykę', NULL, 0, 4),
(6, 'Rozpocząć kurs tańca', NULL, 0, 4),
(7, 'Ustalić menu', NULL, 0, 4),
(8, 'Zarezerwować sale', NULL, 0, 5),
(9, 'Zarezerwować fotografa', NULL, 0, 5),
(10, 'Zarezerwować zespół muzyczny', NULL, 0, 5),
(11, 'Zarezerwować dekoratora', NULL, 0, 5),
(12, 'Zarezerwować catering', NULL, 0, 5),
(13, 'Zarezerwować fryzjera', NULL, 0, 5),
(14, 'Dowód osobisty', NULL, 0, 6),
(15, '[Wynajem] Usalić szczegoły oferty jlkj', NULL, 0, 10),
(16, 'Ustalić charakter imprezy', NULL, 0, 16),
(17, 'Określić planowaną liczbę gości', NULL, 0, 16),
(18, 'Wybrać miejsce ślubu', NULL, 0, 16),
(19, 'Wybrać salę weselną', NULL, 0, 16),
(20, 'Zapisać się na nauki przedmałżeńskie', NULL, 0, 16),
(21, 'Wybrać świadków', NULL, 0, 16),
(22, 'Ustalić listę gości', NULL, 0, 16),
(23, 'Wysłać zaproszenia', NULL, 0, 16),
(24, 'Ustalić muzykę na wesele', NULL, 0, 16),
(25, 'Wybrać piosenkę na pierwszy taniec', NULL, 0, 16),
(26, 'Rozpocząć kurs tańca', NULL, 0, 16),
(27, 'Ustalić menu weselne', NULL, 0, 16),
(28, 'Ustalić scenariusz wesela', NULL, 0, 16),
(29, 'Zaplanować podróż poślubną', NULL, 0, 16),
(30, 'Ustalić kto będzie odpowiedzialny za prezenty', NULL, 0, 16),
(31, 'Buty na zmianę', NULL, 0, 16),
(32, 'Zarezerwować datę ślubu w kościele', NULL, 0, 17),
(33, 'Zarezerwować miejsce ślubu', NULL, 0, 17),
(34, 'Zarezerwować fotografa', NULL, 0, 17),
(35, 'Zarezerwować zespół muzyczny', NULL, 0, 17),
(36, 'Zarezerwować dekoratora', NULL, 0, 17),
(37, 'Zarezerwować catering', NULL, 0, 17),
(38, 'Zarezerwować samochód do ślubu', NULL, 0, 17),
(39, 'Zarezerwować fryzjera', NULL, 0, 17),
(40, 'Zarezerwować makijarzystkę', NULL, 0, 17),
(41, 'Zarezerwować transport dla gości', NULL, 0, 17),
(42, 'Zarezerwować nocleg dla gości', NULL, 0, 17),
(43, 'Dowody osobiste narzeczonych', NULL, 0, 18),
(44, 'Dowody osobiste świadków', NULL, 0, 18),
(45, 'Metryki chrztu', NULL, 0, 18),
(46, 'Zaświadczenia o bierzmowaniu', NULL, 0, 18),
(47, 'Świadectwa nauki religii (w zależności od wymagań parafii)', NULL, 0, 18),
(48, 'Licencja - zgody proboszczów na ślub w innej parafii niż parafie narzeczonych', NULL, 0, 18),
(49, 'Potwierdzenie odbycia nauk przedmałżeńskich i spotkań w poradni rodzinnej', NULL, 0, 18),
(50, 'Zaświadczenie o wygłoszeniu zapowiedzi (w przypadku wygłoszenia w innej parafii)', NULL, 0, 18),
(51, 'Zaświadczenia o odbyciu spowiedzi', NULL, 0, 18),
(52, 'Zaświadczenie z Urzędu Stanu Cywilnego o braku okoliczności wykluczających zawarcie związku małżeńskiego', NULL, 0, 18),
(53, 'Skrócone odpisy aktów urodzenia', NULL, 0, 18),
(54, 'Dowody osobiste świadków', NULL, 0, 18),
(55, 'Ustalić charakter imprezy', NULL, 0, 27),
(56, 'Określić planowaną liczbę gości', NULL, 0, 27),
(57, 'Wybrać miejsce ślubu', NULL, 0, 27),
(58, 'Wybrać salę weselną', NULL, 0, 27),
(59, 'Zapisać się na nauki przedmałżeńskie', NULL, 0, 27),
(60, 'Wybrać świadków', NULL, 0, 27),
(61, 'Ustalić listę gości', NULL, 0, 27),
(62, 'Wysłać zaproszenia', NULL, 0, 27),
(63, 'Ustalić muzykę na wesele', NULL, 0, 27),
(64, 'Wybrać piosenkę na pierwszy taniec', NULL, 0, 27),
(65, 'Rozpocząć kurs tańca', NULL, 0, 27),
(66, 'Ustalić menu weselne', NULL, 0, 27),
(67, 'Ustalić scenariusz wesela', NULL, 0, 27),
(68, 'Zaplanować podróż poślubną', NULL, 0, 27),
(69, 'Ustalić kto będzie odpowiedzialny za prezenty', NULL, 0, 27),
(70, 'Buty na zmianę', NULL, 0, 27),
(71, 'Zarezerwować datę ślubu w kościele', NULL, 0, 28),
(72, 'Zarezerwować miejsce ślubu', NULL, 0, 28),
(73, 'Zarezerwować fotografa', NULL, 0, 28),
(74, 'Zarezerwować zespół muzyczny', NULL, 0, 28),
(75, 'Zarezerwować dekoratora', NULL, 0, 28),
(76, 'Zarezerwować catering', NULL, 0, 28),
(77, 'Zarezerwować samochód do ślubu', NULL, 0, 28),
(78, 'Zarezerwować fryzjera', NULL, 0, 28),
(79, 'Zarezerwować makijarzystkę', NULL, 0, 28),
(80, 'Zarezerwować transport dla gości', NULL, 0, 28),
(81, 'Zarezerwować nocleg dla gości', NULL, 0, 28),
(82, 'Dowody osobiste narzeczonych', NULL, 0, 29),
(83, 'Dowody osobiste świadków', NULL, 0, 29),
(84, 'Metryki chrztu', NULL, 0, 29),
(85, 'Zaświadczenia o bierzmowaniu', NULL, 0, 29),
(86, 'Świadectwa nauki religii (w zależności od wymagań parafii)', NULL, 0, 29),
(87, 'Licencja - zgody proboszczów na ślub w innej parafii niż parafie narzeczonych', NULL, 0, 29),
(88, 'Potwierdzenie odbycia nauk przedmałżeńskich i spotkań w poradni rodzinnej', NULL, 0, 29),
(89, 'Zaświadczenie o wygłoszeniu zapowiedzi (w przypadku wygłoszenia w innej parafii)', NULL, 0, 29),
(90, 'Zaświadczenia o odbyciu spowiedzi', NULL, 0, 29),
(91, 'Zaświadczenie z Urzędu Stanu Cywilnego o braku okoliczności wykluczających zawarcie związku małżeńskiego', NULL, 0, 29),
(92, 'Skrócone odpisy aktów urodzenia', NULL, 0, 29),
(93, 'Dowody osobiste świadków', NULL, 0, 29);

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
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nati@firma.pl', '2022-02-01 03:18:17', '$2y$10$KMr8dKM0OZsog9uY8KJ6CubYhM6cmMJ1nITCCZlrN1oTEAlEE1ByO', 'business', NULL, '2022-02-07 02:18:12', '2022-02-07 08:02:31'),
(2, 'patryk@user.pl', '2022-02-01 03:22:10', '$2y$10$zd3itzuwfnf3GY4zdQ4gpuz2lwIpGPDK80FOGeszss1srohyIFzym', 'user', NULL, '2022-02-07 02:22:06', '2022-02-07 07:58:15');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `businesses`
--
ALTER TABLE `businesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `businesses_categories`
--
ALTER TABLE `businesses_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT dla tabeli `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `costs`
--
ALTER TABLE `costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT dla tabeli `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `groups_businesses`
--
ALTER TABLE `groups_businesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT dla tabeli `groups_categories`
--
ALTER TABLE `groups_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=296;

--
-- AUTO_INCREMENT dla tabeli `groups_events`
--
ALTER TABLE `groups_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT dla tabeli `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT dla tabeli `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `opening_hours`
--
ALTER TABLE `opening_hours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT dla tabeli `questions_and_answers`
--
ALTER TABLE `questions_and_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `statistics_category`
--
ALTER TABLE `statistics_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT dla tabeli `statistics_service`
--
ALTER TABLE `statistics_service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
