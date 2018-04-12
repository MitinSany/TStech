
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `clients`
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_number` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sex` enum('male','female') COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for `deposits`
-- ----------------------------
DROP TABLE IF EXISTS `deposits`;
CREATE TABLE `deposits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `creation_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_commission_month` smallint(5) unsigned NOT NULL,
  `value` decimal(14,2) NOT NULL,
  `percent` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `deposits_client_id_foreign` (`client_id`),
  CONSTRAINT `deposits_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- ----------------------------
-- Table structure for `transactions`
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deposit_id` int(10) unsigned NOT NULL,
  `creation_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `value` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_deposit_id_foreign` (`deposit_id`),
  CONSTRAINT `transactions_deposit_id_foreign` FOREIGN KEY (`deposit_id`) REFERENCES `deposits` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of clients
-- ----------------------------
INSERT INTO `clients` VALUES ('1', '0', '', '', 'male', '1989-04-10');
INSERT INTO `clients` VALUES ('2', '0', '', '', 'female', '1998-04-10');

-- ----------------------------
-- Records of deposits
-- ----------------------------
INSERT INTO `deposits` VALUES ('1', '1', '2018-03-01 14:30:42', '4', '11698.59', '4.00');
INSERT INTO `deposits` VALUES ('3', '1', '2018-04-12 11:08:38', '4', '18600.00', '0.00');
INSERT INTO `deposits` VALUES ('4', '2', '2018-04-12 11:09:52', '4', '23250.00', '0.00');

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('11', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('12', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('13', '2018_04_12_063811_create_clients_table', '1');
INSERT INTO `migrations` VALUES ('14', '2018_04_12_064608_create_deposits_table', '1');
INSERT INTO `migrations` VALUES ('15', '2018_04_12_072120_create_transactions_table', '1');

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES ('22', '1', '2018-01-12 07:34:59', '400.00');
INSERT INTO `transactions` VALUES ('23', '1', '2018-01-12 07:35:01', '-728.00');
INSERT INTO `transactions` VALUES ('24', '1', '2018-02-12 07:36:46', '386.88');
INSERT INTO `transactions` VALUES ('25', '1', '2018-02-12 07:36:47', '402.36');
INSERT INTO `transactions` VALUES ('26', '1', '2018-03-12 07:36:48', '418.45');
INSERT INTO `transactions` VALUES ('27', '1', '2018-03-12 07:36:50', '435.19');
INSERT INTO `transactions` VALUES ('28', '1', '2018-03-12 07:36:51', '452.60');
INSERT INTO `transactions` VALUES ('29', '1', '2018-03-12 07:36:52', '470.70');
INSERT INTO `transactions` VALUES ('30', '1', '2018-04-12 07:36:52', '489.53');
INSERT INTO `transactions` VALUES ('31', '1', '2018-04-12 07:36:54', '509.11');
INSERT INTO `transactions` VALUES ('32', '1', '2018-04-12 10:20:56', '529.47');
INSERT INTO `transactions` VALUES ('33', '1', '2018-04-12 10:51:46', '550.65');
INSERT INTO `transactions` VALUES ('34', '1', '2018-04-12 14:06:30', '400.00');
INSERT INTO `transactions` VALUES ('35', '3', '2018-04-12 14:06:30', '0.00');
INSERT INTO `transactions` VALUES ('36', '3', '2018-04-12 14:06:30', '-1400.00');
INSERT INTO `transactions` VALUES ('37', '4', '2018-04-12 14:06:30', '0.00');
INSERT INTO `transactions` VALUES ('38', '4', '2018-04-12 14:06:30', '-1750.00');
INSERT INTO `transactions` VALUES ('39', '1', '2018-04-12 14:12:32', '416.00');
INSERT INTO `transactions` VALUES ('40', '3', '2018-04-12 14:12:32', '0.00');
INSERT INTO `transactions` VALUES ('41', '4', '2018-04-12 14:12:32', '0.00');
INSERT INTO `transactions` VALUES ('42', '1', '2018-04-12 14:12:39', '432.64');
INSERT INTO `transactions` VALUES ('43', '3', '2018-04-12 14:12:39', '0.00');
INSERT INTO `transactions` VALUES ('44', '4', '2018-04-12 14:12:39', '0.00');
INSERT INTO `transactions` VALUES ('45', '1', '2018-04-12 14:12:42', '449.95');
INSERT INTO `transactions` VALUES ('46', '3', '2018-04-12 14:12:42', '0.00');
INSERT INTO `transactions` VALUES ('47', '4', '2018-04-12 14:12:42', '0.00');
