-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 18, 2019 at 02:43 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Perma_farmer`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_authToken` varchar(255) NOT NULL,
  `admin_login` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_password`, `admin_authToken`, `admin_login`) VALUES
(1, '$2y$10$XhgixcTzW55FNxIbgEAk7./PhBlL/HlDh4kNC1Khe67X5d3odhLVS', '', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `article_title` varchar(255) NOT NULL,
  `article_content` text NOT NULL,
  `article_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `article_title`, `article_content`, `article_image`) VALUES
(1, 'Bienvenue sur Perma-Farmer', 'La ferme familiale Perma-Farmer propose à la vente, des paniers de légumes de saison aux particuliers et occasionnellement à des petits restaurateurs régionaux.\r\n \r\nLa ferme Perma-Farmer propose une culture biologique de fruits et légumes cultivés en permaculture. La ferme ne possède pas de label bio mais cultive ses productions sans produits phytosanitaires (désherbants, insecticides, engrais chimiques...).\r\n\r\nLes produits proposés par la ferme sont : \r\n- Des fruits et légumes de saison (pommes de terre, carottes, divers salades, ail, oignons, courgettes…)\r\n- Des œufs frais de poules, canards et d\'oies', 'presentation.jpg'),
(2, 'Le concept Perma-Farmer', 'La vente de panier de légumes et fruits bios prend de l\'ampleur auprès des particuliers. Généralement, le particulier paie un abonnement mensuel pour une quantité de légumes hebdomadaire.\r\n\r\n2 types de paniers sont proposés dans le cadre de la ferme Perma-Farmer :\r\n- La petite formule qui correspond à un panier d\'environ 2,5 kg au prix de 12,50 €/panier (soit 48,40 €/mois)\r\n- La grande formule qui correspond à un panier d\'environ 7 kg au prix de 24,90 €/panier (soit 111,60 €/mois)\r\n\r\nLe fonctionnement est le suivant : \r\n- Le particulier souscrit à un abonnement mensuel.\r\n- Une fois par semaine, celui-ci va récupérer ses légumes à la ferme.', 'concept.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_firstName` varchar(100) NOT NULL,
  `customer_lastName` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_code` varchar(255) NOT NULL,
  `customer_authToken` varchar(255) NOT NULL,
  `customer_idSubscription` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_firstName`, `customer_lastName`, `customer_email`, `customer_password`,
`customer_code`, `customer_authToken`, customer_idSubscription) VALUES
(1, 'Jean Bobby', 'Lapointe', 'jeanbobby@lapointe.fr', '$2y$10$MTHtFL/C9qep85pnW9iFfOjQiYpQ2c29odbXadl/3.ypAxqqtGi/O',
'997261136b85a8a630b5d4ca5f2ee82d', '', 1);


-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `order_availableDate` datetime NOT NULL,
  `order_pickedDate` datetime NOT NULL,
  `order_notificationSent` int(1) NOT NULL,
  `order_idCustomer` int(11) NOT NULL,
  `order_picked` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_label` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_price`, `product_stock`, `product_image`, `product_description`, `product_label`) VALUES
(1, 1, 100, 'pomme.jpg', 'Pommes de saison.', 'Pomme'),
(2, 2, 20, 'kiwi.jpg', 'Kiwis de saison.', 'Kiwi'),
(3, 1.5, 100, 'poire.jpg', 'Poires de saison.', 'Poire'),
(4, 2, 200, 'peche.jpg', 'Pêches de saison.', 'Pêche'),
(5, 3, 50, 'abricot.jpg', 'Abricots de saison.', 'Abricot'),
(6, 2, 100, 'poireau.jpg', 'Poireaux de saison.', 'Poireau'),
(7, 1, 300, 'pommeDeTerre.jpg', 'Pommes de terre de saison.', 'Pomme de terre'),
(8, 1.5, 300, 'courgette.jpg', 'Courgettes de saison.', 'Courgette'),
(9, 3, 200, 'tomate.jpg', 'Tomates de saison.', 'Tomate'),
(10, 2.5, 400, 'aubergine.jpg', 'Aubergines de saison.', 'Aubergine'),
(11, 4, 500, 'champignon.jpg', 'Champignons de saison.', 'Champignon'),
(12, 2, 300, 'oeuf.jpg', 'Oeufs frais de poules élevées en plein air.', 'Oeuf'),
(13, 3, 250, 'fraise.jpg', 'Fraises de saison.', 'Fraise'),
(14, 2, 70, 'concombre.jpg', 'Concombres de saison.', 'Concombre'),
(15, 1.5, 450, 'oignon.jpg', 'Oignons de saison.', 'Oignon');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `subscription_id` int(11) NOT NULL,
  `subscription_label` varchar(100) NOT NULL,
  `subscription_price` double NOT NULL,
  `subscription_weight` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`subscription_id`, `subscription_label`, `subscription_price`, `subscription_weight`) VALUES
(1, 'Petite formule', 48.4, 2.5),
(2, 'Grande formule', 111.6, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_AK` (`admin_login`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`product_id`,`order_id`),
  ADD KEY `cart_order0_FK` (`order_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `customer_subscription_FK` (`customer_idSubscription`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_customer_FK` (`order_idCustomer`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_AK` (`product_label`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`subscription_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_order0_FK` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `cart_product_FK` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_subscription_FK` FOREIGN KEY (`customer_idSubscription`) REFERENCES `subscription` (`subscription_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_customer_FK` FOREIGN KEY (`order_idCustomer`) REFERENCES `customer` (`customer_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
