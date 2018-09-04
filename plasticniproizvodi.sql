-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2018 at 04:38 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plasticniproizvodi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

CREATE TABLE `cart_product` (
  `cart_product_id` int(11) UNSIGNED NOT NULL,
  `cart_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `quantity` decimal(10,2) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `picture_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_category_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `description`, `picture_path`, `parent_category_id`) VALUES
(1, 'Nameštaj', 'Plastični stolovi i stolice za svaku priliku i namenu. Bilo da su vam neophodni za dvorište ili unutrašnji prostor, stolovi i stolice vrhunskog kvaliteta će zadovoljiti svaku vašu potrebu. Plastični stolovi i stolice raznih oblika i dimenzija stižu brzo do vas da ukrase vaše domaćinstvo.', '0', NULL),
(2, 'Kupatilo', 'U ovoj kategoriji možete naći korpe za veš, veliki izbor kvalitetnih fioka, lavora, dozatora za sapun i ostalo.', '1', NULL),
(3, 'Saksije i Bašta', 'Saksije za cveće za bašte i za kuće! Uredite svoju baštu ili dom sa najboljim, ali i najpovoljnijim saksijama svih dimenzija, oblika i boja. Plastične saksije su idelane za vaš dom zbog toga što su veoma održive, teže se lome i veoma lake za premeštanje. Saksije su napravljenje od najkvalitetnije plastike kako bi cveće dalo svoj najbolji sjaj i pokazalo lepotu. Danas se saksije koriste ne samo napolju ili na teresama nego su i sastavni deo unutrašnjeg prostora doma, poslovnog prostora odnosno kancelarija. Saksije koje vam mi preporučujemo dolaze veoma brzo na vašu adresu sa ciljem da ulepšaju vaš životni prostor.', '2', NULL),
(4, 'Čišćenje', 'Lista proizvoda od plastike za čišćenje', '3', NULL),
(5, 'Kuhinja', 'Lista proizvoda od plastike za kuhinju', '4', NULL),
(6, 'Dečiji Program', 'Lista proizvoda od plastike - dečiji program', '5', NULL),
(7, 'Ostalo', 'Lista proizvoda od plastike - ostali proizvodi', '6', NULL),
(13, 'ajdee', 'ajde', 'Untitled.jpg', NULL),
(16, 'nesto kat', 'neki opis', 'aquamax-emajl-za-drvo.jpg', NULL),
(17, 'sifoni', 'u ovu kategoriju ubacujemo sifone', '123.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `characteristic`
--

CREATE TABLE `characteristic` (
  `characteristic_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `characteristic`
--

INSERT INTO `characteristic` (`characteristic_id`, `name`) VALUES
(1, 'Dimenzije'),
(2, 'Boja');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `manufacturer_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `service` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `adress` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`manufacturer_id`, `name`, `service`, `adress`) VALUES
(1, 'BIGPlast', 'Prodaja saksija', 'Branka Radicevic 76'),
(2, 'Drina', 'Proizvodnja plastike', 'IV industrijska 7'),
(3, 'Miškone Plastika', 'Proizvodnja plastike', 'Banovačka 64'),
(4, 'IMMOS-PLAST', 'Proizvodnja plastike', 'Železnička 49'),
(5, 'Megaplast', 'PVC stolarija', 'Bulevar oslobođenja 38'),
(6, 'Test', 'test1', 'test2'),
(8, 'proba', 'proba', 'proba'),
(9, 'proba1', 'proba1', 'proba1');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) UNSIGNED NOT NULL,
  `cart_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('completed','paid','made') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'made'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) UNSIGNED NOT NULL,
  `amount` decimal(10,2) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `picture_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) UNSIGNED NOT NULL,
  `manufacturer_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `picture_path`, `description`, `is_active`, `created_at`, `user_id`, `manufacturer_id`) VALUES
(1, 'Baštenska Stolicaa', 'Untitled.jpg', 'Dimenzije: visina 76 cm, širina sedalnog dela 43cm, težina 2 kga', 1, '2018-05-04 17:39:30', 1, 2),
(2, 'Baštenska Stolica Dona', '2', 'Dimenzije: 590 x 570 x 895 mm\r\nMaterijal: PP (homopolymer)\r\n\r\nOdlična stolica sa izlivenim naslonom (ne ispada)', 1, '2018-05-04 17:40:00', 1, 1),
(3, 'Adapter Za Wc Šolju', '3', 'Anatomski oblikovan adapter sa dve neklizajuće podloge sa unutrašnje strane koje obezbeđuju bolji kontakt sa wc šoljom i sprečavaju klizanje.Plastični adapter za decu koji se stavlja na wc šolju!', 1, '2018-05-04 17:41:56', 1, 2),
(4, 'Bebi Kada', '4', 'Dimenzije : 75x46x21cm\r\n\r\nKada za kupanje beba.', 1, '2018-05-04 17:42:16', 1, 5),
(5, 'Saksija Gerber', '5', 'Dimenzije	Ø14 x 12 cm\r\n \r\n\r\nGerber saksija za cvece za tacnicom u vise razlicitih boja ', 1, '2018-05-04 17:43:08', 1, 2),
(6, 'Saksija HydriaT15', '6', 'Dimenzije: Ø15\r\n\r\nVisina: 14cm Litara: 1\r\n\r\n \r\n\r\nsaksije su kreirane tako da služe kao “cachepot” što znači da vam ne treba podmetač. One su dekorativne i služe kao obloda da stavite cveće koje je u saksiji za rasad ili u staroj saksiji. Isto tako možete zasaditi i direktno. Na dno saksije stavite prvo sloj šljunka ili saitnog kamenja, prekrijete slojem zemlje a zatim biljku stavite na sredinu i oko nje naspete zemlju do visine 2 cm ispod ruba saksije. Zemlju zatim pritisnete da se biljka učvrsti i ako je potebno dodate još malo zemlje.\r\n\r\n \r\n\r\nNeobičan dizajn. Pogodan oblik za svaki prostor.\r\n\r\nSaksija nema tacnu i rupe na dnu.\r\nSaksija napravljena od plastike sa visokim sjajem i ima UV stabilnost.', 1, '2018-05-04 17:43:38', 1, 1),
(7, 'Kanta Klatno 40L', '7', 'Zapremina : 40 l', 1, '2018-05-04 17:44:10', 1, 4),
(8, 'Aspirator', '8', 'Aspirator praktican i lak za upotrebu, namenjen za ciscenje', 1, '2018-05-04 17:44:26', 1, 3),
(9, 'Balon 5l Bez Pletiva', '9', 'Dimenzije: 5l\r\n\r\n Balon 5l bez pletiva namenjen za odlaganje tecnosti', 1, '2018-05-04 17:44:57', 1, 4),
(10, 'Frigo Box 1,2 + 2,2L', '10', 'Dimenzije	5 x 17 x H13 cm \r\n \r\n \r\nPlastična posuda (kutija) za čuvanje hrane.\r\nPosuda ima dva sprata za ekonomično čuvanje hrane. \r\n \r\n\r\nSveže na sprat!', 1, '2018-05-04 17:45:11', 1, 2),
(11, 'Auto Pedal Tr', '11', 'Auto na pedale zabavna igracka za svako dete.', 1, '2018-05-04 17:45:46', 1, 3),
(12, 'Avioni Pertini', '12', 'Dimenzije proizvoda: 9.5x10 cm\r\n\r\nMakete aviona sa propelerima i duvalicom koja\r\nih pokrece. Dostupno u više boja.', 1, '2018-05-04 17:46:02', 1, 4),
(13, 'Četka za nokte', '13', 'Plastična četkica za nokte. Pogodna za profesionalu i ličnu upotrebu.', 1, '2018-05-04 17:47:04', 1, 4),
(14, 'Alatka Za Garnišle', '14', '', 1, '2018-05-04 17:47:17', 1, 4),
(15, 'Baštenski Sto Okrugli', '15', 'Dimenzije : ø70cm, 4.2kg Boja: Bela, bordo, zelena, teget, kajsija, bez', 1, '2018-08-20 10:26:27', 1, 3),
(29, 'Zzz', '', 'zzz', 1, '2018-08-20 10:27:59', 5, 4),
(30, 'Cinija', 'er-lac-stocofin.jpg', 'plasticna', 1, '2018-08-20 17:54:42', 6, 2),
(31, 'Sifon', 'aaa.png', 'Sifon plasticni', 1, '2018-08-22 14:34:42', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `product_id`, `category_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 4),
(9, 9, 5),
(10, 10, 5),
(11, 11, 6),
(12, 12, 6),
(13, 13, 7),
(14, 14, 7);

-- --------------------------------------------------------

--
-- Table structure for table `product_characteristic`
--

CREATE TABLE `product_characteristic` (
  `product_characteristic_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `characteristic_id` int(11) UNSIGNED NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_characteristic`
--

INSERT INTO `product_characteristic` (`product_characteristic_id`, `product_id`, `characteristic_id`, `value`) VALUES
(1, 1, 2, 'Crvena'),
(2, 1, 2, 'Plava'),
(3, 1, 2, 'Roze'),
(4, 1, 2, 'Zelena'),
(5, 1, 2, 'Žuta'),
(6, 1, 2, 'Ljubičasta'),
(7, 1, 2, 'Bela'),
(8, 2, 2, 'Plava'),
(9, 2, 2, 'Crvena'),
(10, 2, 2, 'Zelena'),
(11, 2, 2, 'Bela'),
(12, 3, 2, 'Žuta'),
(13, 3, 2, 'Plava'),
(14, 3, 2, 'Zelena'),
(15, 3, 2, 'Crvena'),
(16, 4, 2, 'Ljubičasta'),
(17, 4, 2, 'Zelena'),
(18, 4, 2, 'Crvena'),
(19, 4, 2, 'Plava'),
(20, 5, 2, 'Braon'),
(21, 5, 2, 'Žuta'),
(22, 5, 2, 'Zelena'),
(23, 5, 2, 'Bela'),
(24, 5, 2, 'Narandžasta'),
(25, 6, 2, 'Bela'),
(26, 7, 2, 'Braon'),
(27, 7, 2, 'Crvena'),
(28, 8, 2, 'Bela'),
(29, 9, 2, 'Bela'),
(30, 10, 2, 'Roze'),
(31, 10, 2, 'Plava'),
(32, 10, 2, 'Zelena'),
(33, 11, 2, 'Crvena');

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `product_price_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `amount` decimal(10,2) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`product_price_id`, `product_id`, `amount`, `created_at`) VALUES
(1, 1, '770.00', '2018-05-04 18:01:50'),
(2, 2, '1230.00', '2018-05-04 18:01:57'),
(3, 3, '325.00', '2018-05-04 18:02:13'),
(4, 4, '885.00', '2018-05-04 18:02:17'),
(5, 5, '65.00', '2018-05-04 18:02:26'),
(6, 6, '85.00', '2018-05-04 18:02:29'),
(7, 7, '890.00', '2018-05-04 18:02:39'),
(8, 8, '50.00', '2018-05-04 18:02:44'),
(9, 9, '475.00', '2018-05-04 18:02:57'),
(10, 10, '270.00', '2018-05-04 18:03:00'),
(11, 11, '4224.00', '2018-05-04 18:03:10'),
(12, 12, '79.00', '2018-05-04 18:03:14'),
(13, 13, '77.00', '2018-05-04 18:03:23'),
(14, 14, '380.00', '2018-05-04 18:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `shipment_id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tracking_number` char(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` text COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `salt`, `is_active`, `created_at`) VALUES
(1, 'MarkoR1995', 'qwerty12345', 'marko.radicevic.14@singimail.rs', 'qwerty12345', 2, '2018-05-04 17:07:11'),
(2, 'Stajic', 'qwerty12345', 'marko.stajic.14@singimail.rs', 'qwerty12345', 2, '2018-05-04 17:07:38'),
(3, 'MarkoRadicevic', '$2y$10$cNOCYsZy3NvVQ13NaupvQ.eM.8LdhRnKGmtgGfnhJcKZZztJ5.zvK', 'marko.radicevic.15@singimail.rs', '', 0, '2018-08-15 17:08:57'),
(4, 'test', '$2y$10$AT0swP7puQ86sUMimbxiEe8SV9fH8m4ncMtNxAYBuwV0vN.RnhF7m', 'test@test.rs', '', 0, '2018-08-16 14:11:32'),
(5, 'test1234', '$2y$10$bZLEPpKnYzy8bl3AehAbhO8UvloSS4FFRiD/dA94rNHAWZXpqkkQW', 'test1234@test.rs', '', 0, '2018-08-17 16:43:50'),
(6, 'user', '$2y$10$gvwi0y7V3IOSfmeW7QaoK.17zT/cdsL2qCzx1NLynC96Q5xzipST2', 'user@user.com', '', 0, '2018-08-20 11:46:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `user_login_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`) USING BTREE,
  ADD KEY `fk_cart_user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD PRIMARY KEY (`cart_product_id`) USING BTREE,
  ADD KEY `fk_cart_product_cart_id` (`cart_id`) USING BTREE,
  ADD KEY `fk_cart_product_product_id` (`product_id`) USING BTREE;

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`) USING BTREE,
  ADD UNIQUE KEY `uq_category_name` (`name`) USING BTREE,
  ADD UNIQUE KEY `uq_category_picture_path` (`picture_path`) USING BTREE,
  ADD KEY `fk_category_parent_category_id` (`parent_category_id`) USING BTREE;

--
-- Indexes for table `characteristic`
--
ALTER TABLE `characteristic`
  ADD PRIMARY KEY (`characteristic_id`) USING BTREE,
  ADD UNIQUE KEY `uq_characteristic_characteristic_id` (`characteristic_id`) USING BTREE;

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`manufacturer_id`) USING BTREE,
  ADD UNIQUE KEY `uq_manufacturer_name` (`name`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`) USING BTREE,
  ADD UNIQUE KEY `fk_order_cart_id` (`cart_id`) USING BTREE;

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`) USING BTREE,
  ADD KEY `fk_payment_order_id` (`order_id`) USING BTREE;

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`) USING BTREE,
  ADD UNIQUE KEY `uq_product_picture_path` (`picture_path`) USING BTREE,
  ADD KEY `fk_product_user_id` (`user_id`) USING BTREE,
  ADD KEY `fk_product_manufacturer_id` (`manufacturer_id`) USING BTREE;

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`),
  ADD UNIQUE KEY `uq_product_category_product_id_category_id` (`product_id`,`category_id`) USING BTREE,
  ADD KEY `fk_product_category_category_id` (`category_id`);

--
-- Indexes for table `product_characteristic`
--
ALTER TABLE `product_characteristic`
  ADD PRIMARY KEY (`product_characteristic_id`),
  ADD KEY `fk_product_characteristic_characteristic_id` (`characteristic_id`),
  ADD KEY `fk_product_characteristic_product_id` (`product_id`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`product_price_id`) USING BTREE,
  ADD KEY `fk_product_price_product_id` (`product_id`) USING BTREE;

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`shipment_id`) USING BTREE,
  ADD UNIQUE KEY `uq_tracking_number` (`tracking_number`) USING BTREE,
  ADD UNIQUE KEY `uq_order_id` (`order_id`),
  ADD KEY `fk_shipment_order_id` (`order_id`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD UNIQUE KEY `uq_user_email` (`email`) USING BTREE,
  ADD UNIQUE KEY `uq_user_username` (`username`) USING BTREE;

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`user_login_id`) USING BTREE,
  ADD KEY `fk_user_login_user_id` (`user_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_product`
--
ALTER TABLE `cart_product`
  MODIFY `cart_product_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `characteristic`
--
ALTER TABLE `characteristic`
  MODIFY `characteristic_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `manufacturer_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_characteristic`
--
ALTER TABLE `product_characteristic`
  MODIFY `product_characteristic_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `product_price_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `shipment_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `user_login_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD CONSTRAINT `fk_cart_product_cart_id` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_product_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_category_parent_category_id` FOREIGN KEY (`parent_category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_cart_id` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_order_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_manufacturer_id` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturer` (`manufacturer_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `fk_product_category_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_category_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `product_characteristic`
--
ALTER TABLE `product_characteristic`
  ADD CONSTRAINT `fk_product_characteristic_characteristic_id` FOREIGN KEY (`characteristic_id`) REFERENCES `characteristic` (`characteristic_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_characteristic_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `product_price`
--
ALTER TABLE `product_price`
  ADD CONSTRAINT `fk_product_price_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `shipment`
--
ALTER TABLE `shipment`
  ADD CONSTRAINT `fk_shipment_order_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_login`
--
ALTER TABLE `user_login`
  ADD CONSTRAINT `fk_user_login_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
