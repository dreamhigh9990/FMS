# Host: localhost  (Version 5.5.5-10.4.21-MariaDB)
# Date: 2022-10-24 10:43:43
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "branches"
#

DROP TABLE IF EXISTS `branches`;
CREATE TABLE `branches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branches` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `branches_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "branches"
#

INSERT INTO `branches` VALUES (1,'Amby','2021-12-07 11:07:41','2021-12-07 11:07:41','Amby.wards@gmail.com'),(2,'Brisbane','2021-12-07 11:07:41','2021-12-07 11:07:41','Brisbane.wards@gmail.com'),(3,'Cunnamulla','2021-12-07 11:07:41','2022-04-27 21:50:03','Cunnamulla.wards@gmail.com'),(5,'Tambo-Blackall','2021-12-07 11:07:41','2021-12-07 11:07:41','Tambo-Blackall.wards@gmail.com'),(6,'Taroom','2021-12-07 11:07:41','2021-12-07 11:07:41','Taroom.wards@gmail.com'),(7,'Wandoan','2021-12-07 11:07:41','2021-12-07 11:07:41','Wandoan.wards@gmail.com'),(8,'Toowoomba','2021-12-07 11:07:41','2021-12-07 11:07:41','Toowoomba.wards@gmail.com'),(9,'Dalby','2021-12-07 11:07:41','2021-12-07 11:07:41','Dalby.wards@gmail.com'),(10,'Chinchilla','2021-12-07 11:07:41','2021-12-07 11:07:41','Chinchilla.wards@gmail.com'),(11,'Miles','2021-12-07 11:07:41','2021-12-07 11:07:41','Miles.wards@gmail.com'),(12,'Wallumbilla','2021-12-07 11:07:41','2021-12-07 11:07:41','Wallumbilla.wards@gmail.com'),(13,'Roma','2021-12-07 11:07:41','2021-12-07 11:07:41','Roma.wards@gmail.com'),(14,'Injune','2021-12-07 11:07:41','2021-12-07 11:07:41','Injune.wards@gmail.com'),(15,'Surat','2021-12-07 11:07:41','2021-12-07 11:07:41','Surat.wards@gmail.com'),(16,'Mitchell','2021-12-07 11:07:41','2022-04-27 21:52:53','Mitchell.wards@gmail.com'),(17,'Morven','2022-04-27 21:52:18','2022-04-27 21:52:18','Morven.wards@gmail.com'),(18,'Mungallala','2022-04-27 21:52:18','2022-04-27 21:52:18','Mungallala.wards@gmail.com'),(19,'Charleville','2022-04-27 21:52:18','2022-04-27 21:52:18','Charleville.wards@gmail.com'),(20,'Quilpie','2022-04-27 21:52:18','2022-04-27 21:52:18','Quilpie.wards@gmail.com'),(21,'Augathella','2022-04-27 21:52:18','2022-04-27 21:52:18','Augathella.wards@gmail.com'),(22,'Other','2022-04-27 21:53:51','2022-04-27 21:53:51','Other.wards@gmail.com'),(23,'St George','2022-04-27 21:54:52','2022-04-27 21:54:52','St George.wards@gmail.com'),(24,'0Test','2022-09-22 14:58:33','2022-09-22 14:58:33','vladtarasov20203@gmail.com');

#
# Structure for table "customer_account_details"
#

DROP TABLE IF EXISTS `customer_account_details`;
CREATE TABLE `customer_account_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trading_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_manager` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `industry` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ABN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ACN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_terms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `credit_limit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gen_invoice_chk` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `xero_link_chk` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `invoice_export` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `xero_data` varchar(2550) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_account_details_customer_id_foreign` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "customer_account_details"
#

INSERT INTO `customer_account_details` VALUES (13,101,'Davichi',NULL,NULL,NULL,'Dav123',NULL,NULL,NULL,'cod',NULL,NULL,NULL,'2022-04-26 11:03:13','2022-10-15 16:42:26','Yes','No','Monday',NULL),(14,102,'Beryl Ward',NULL,NULL,NULL,'Beryl123',NULL,NULL,NULL,'cod',NULL,NULL,NULL,'2022-04-27 21:30:06','2022-10-15 18:47:20','Yes','No','Daily',NULL),(15,103,'Ashley Ward',NULL,NULL,NULL,'Ashley123',NULL,NULL,NULL,'cod',NULL,NULL,NULL,'2022-04-27 21:31:25','2022-10-15 17:20:49','Yes','Yes','Wednesday',NULL),(16,107,'Ron Ward',NULL,NULL,'active','ABS123',NULL,NULL,NULL,'cod',NULL,NULL,NULL,'2022-05-08 11:12:43','2022-06-29 01:59:31','No','No','Daily',NULL),(32,147,'John Doe',NULL,NULL,NULL,'ASHL01',NULL,NULL,NULL,'',NULL,NULL,NULL,'2022-10-19 17:49:20','2022-10-19 17:49:20','Yes','Yes','0-','{\"ContactID\":\"28863739-fec9-4710-b7fa-e5ae86ac5ffc\",\"AccountNumber\":\"ASHL01\",\"ContactStatus\":\"ACTIVE\",\"Name\":\"Ashleigh Duncan\",\"FirstName\":\"John\",\"LastName\":\"Doe\",\"EmailAddress\":\"ashley@awardservices.com.au\",\"Addresses\":[{\"AddressType\":\"STREET\"},{\"AddressType\":\"POBOX\",\"AddressLine1\":\"Must Change\",\"City\":\"MUST CHANGE\",\"Region\":\"MUST CHANGE\",\"PostalCode\":\"1234\",\"Country\":\"Australia\",\"AttentionTo\":\"Att Business Name\"}],\"Phones\":[{\"PhoneType\":\"DDI\"},{\"PhoneType\":\"DEFAULT\",\"PhoneNumber\":\"61746221828\"},{\"PhoneType\":\"FAX\",\"PhoneNumber\":\"617277800\"},{\"PhoneType\":\"MOBILE\",\"PhoneNumber\":\"61427221035\"}],\"IsSupplier\":\"false\",\"IsCustomer\":\"true\",\"PaymentTerms\":{\"Sales\":{\"Day\":\"0\",\"Type\":\"DAYSAFTERBILLDATE\"}},\"UpdatedDateUTC\":\"2022-10-05T12:51:54+00:00\",\"HasAttachments\":\"false\"}'),(33,148,'John Doe',NULL,NULL,NULL,'CASH03',NULL,NULL,NULL,'',NULL,NULL,NULL,'2022-10-19 17:49:20','2022-10-19 17:49:20','Yes','Yes','0-','{\"ContactID\":\"fe691ea7-fa2f-4ac6-a00d-19e8c28c789f\",\"AccountNumber\":\"CASH03\",\"ContactStatus\":\"ACTIVE\",\"Name\":\"Cash Sales\",\"FirstName\":\"John\",\"LastName\":\"Doe\",\"EmailAddress\":\"ashley@awardservices.com.au\",\"Addresses\":[{\"AddressType\":\"STREET\"},{\"AddressType\":\"POBOX\",\"AttentionTo\":\"Att Business Name\"}],\"Phones\":[{\"PhoneType\":\"DDI\"},{\"PhoneType\":\"DEFAULT\",\"PhoneNumber\":\"61746221828\"},{\"PhoneType\":\"FAX\",\"PhoneNumber\":\"617277800\"},{\"PhoneType\":\"MOBILE\",\"PhoneNumber\":\"61427221035\"}],\"IsSupplier\":\"false\",\"IsCustomer\":\"true\",\"PaymentTerms\":{\"Sales\":{\"Day\":\"0\",\"Type\":\"DAYSAFTERBILLDATE\"}},\"UpdatedDateUTC\":\"2022-10-05T12:51:57+00:00\",\"Balances\":\"\",\"HasAttachments\":\"false\"}'),(34,149,'John Doe',NULL,NULL,NULL,'AACO01',NULL,NULL,NULL,'',NULL,NULL,NULL,'2022-10-19 17:49:20','2022-10-19 17:49:20','Yes','Yes','7-','{\"ContactID\":\"4626228f-f9bf-48d4-a034-02345ca9146b\",\"AccountNumber\":\"AACO01\",\"ContactStatus\":\"ACTIVE\",\"Name\":\"AA Company\",\"FirstName\":\"John\",\"LastName\":\"Doe\",\"EmailAddress\":\"ashley@awardservices.com.au\",\"Addresses\":[{\"AddressType\":\"POBOX\",\"AddressLine1\":\"Wylarah Station\",\"AddressLine2\":\"Wylarah Station\",\"AddressLine3\":\"M\\/S 104\",\"City\":\"Surat\",\"Region\":\"QLD\",\"PostalCode\":\"4417\",\"Country\":\"Australia\",\"AttentionTo\":\"Att Business Name\"},{\"AddressType\":\"STREET\"}],\"Phones\":[{\"PhoneType\":\"DDI\"},{\"PhoneType\":\"DEFAULT\",\"PhoneNumber\":\"61746221828\"},{\"PhoneType\":\"FAX\",\"PhoneNumber\":\"617277800\"},{\"PhoneType\":\"MOBILE\",\"PhoneNumber\":\"61427221035\"}],\"IsSupplier\":\"false\",\"IsCustomer\":\"true\",\"PaymentTerms\":{\"Sales\":{\"Day\":\"7\",\"Type\":\"DAYSAFTERBILLDATE\"}},\"UpdatedDateUTC\":\"2022-10-19T09:36:11+00:00\",\"Balances\":\"\",\"HasAttachments\":\"false\"}'),(35,150,'Vlad Tarasov',NULL,NULL,NULL,'',NULL,NULL,NULL,'',NULL,NULL,NULL,'2022-10-19 17:49:21','2022-10-19 17:49:21','Yes','Yes','-','{\"ContactID\":\"f276e9ba-2471-4ec4-b0d6-a1da1b936339\",\"ContactStatus\":\"ACTIVE\",\"Name\":\"Vlad FMS test\",\"FirstName\":\"Vlad\",\"LastName\":\"Tarasov\",\"EmailAddress\":\"vladtarasov20203@gmail.com\",\"CompanyNumber\":\"3232323\",\"Addresses\":[{\"AddressType\":\"POBOX\",\"AddressLine1\":\"219 Hillside Rd\",\"City\":\"AVOCA BEACH\",\"Region\":\"NSW\",\"PostalCode\":\"2251\",\"Country\":\"Australia\"},{\"AddressType\":\"STREET\",\"AddressLine1\":\"217 Clifton Hills Rd\",\"AddressLine2\":\"217 Clifton Hills Rd1\",\"AddressLine3\":\"217 Clifton Hills Rd2\",\"AddressLine4\":\"217 Clifton Hills Rd3\",\"City\":\"CLIFTON HILLS STATION\",\"Region\":\"SA\",\"PostalCode\":\"5731\",\"Country\":\"Australia\",\"AttentionTo\":\"217 Clifton Hills Rd111\"}],\"Phones\":[{\"PhoneType\":\"DDI\"},{\"PhoneType\":\"DEFAULT\",\"PhoneNumber\":\"333\",\"PhoneAreaCode\":\"222\",\"PhoneCountryCode\":\"1111\"},{\"PhoneType\":\"FAX\"},{\"PhoneType\":\"MOBILE\"}],\"IsSupplier\":\"true\",\"IsCustomer\":\"true\",\"UpdatedDateUTC\":\"2022-10-19T09:39:25+00:00\",\"Website\":\"vlad20203.com\",\"Balances\":\"\",\"HasAttachments\":\"false\"}'),(36,151,'John Doe',NULL,NULL,NULL,'ASHL01',NULL,NULL,NULL,'cod',NULL,NULL,NULL,'2022-10-19 17:55:48','2022-10-23 02:01:33','Yes','Yes','0-DAYSAFTERBILLDATE','{\"ContactID\":\"28863739-fec9-4710-b7fa-e5ae86ac5ffc\",\"AccountNumber\":\"ASHL01\",\"ContactStatus\":\"ACTIVE\",\"Name\":\"Ashleigh Duncan\",\"FirstName\":\"John\",\"LastName\":\"Doe\",\"EmailAddress\":\"ashley@awardservices.com.au\",\"Addresses\":[{\"AddressType\":\"STREET\"},{\"AddressType\":\"POBOX\",\"AddressLine1\":\"Must Change\",\"City\":\"MUST CHANGE\",\"Region\":\"MUST CHANGE\",\"PostalCode\":\"1234\",\"Country\":\"Australia\",\"AttentionTo\":\"Att Business Name\"}],\"Phones\":[{\"PhoneType\":\"DDI\"},{\"PhoneType\":\"DEFAULT\",\"PhoneNumber\":\"61746221828\"},{\"PhoneType\":\"FAX\",\"PhoneNumber\":\"617277800\"},{\"PhoneType\":\"MOBILE\",\"PhoneNumber\":\"61427221035\"}],\"IsSupplier\":\"false\",\"IsCustomer\":\"true\",\"PaymentTerms\":{\"Sales\":{\"Day\":\"0\",\"Type\":\"DAYSAFTERBILLDATE\"}},\"UpdatedDateUTC\":\"2022-10-05T12:51:54+00:00\",\"HasAttachments\":\"false\",\"dbID\":151}'),(37,152,'John Doe',NULL,NULL,NULL,'CASH03',NULL,NULL,NULL,'',NULL,NULL,NULL,'2022-10-19 17:55:48','2022-10-19 17:55:48','Yes','Yes','0-DAYSAFTERBILLDATE','{\"ContactID\":\"fe691ea7-fa2f-4ac6-a00d-19e8c28c789f\",\"AccountNumber\":\"CASH03\",\"ContactStatus\":\"ACTIVE\",\"Name\":\"Cash Sales\",\"FirstName\":\"John\",\"LastName\":\"Doe\",\"EmailAddress\":\"ashley@awardservices.com.au\",\"Addresses\":[{\"AddressType\":\"STREET\"},{\"AddressType\":\"POBOX\",\"AttentionTo\":\"Att Business Name\"}],\"Phones\":[{\"PhoneType\":\"DDI\"},{\"PhoneType\":\"DEFAULT\",\"PhoneNumber\":\"61746221828\"},{\"PhoneType\":\"FAX\",\"PhoneNumber\":\"617277800\"},{\"PhoneType\":\"MOBILE\",\"PhoneNumber\":\"61427221035\"}],\"IsSupplier\":\"false\",\"IsCustomer\":\"true\",\"PaymentTerms\":{\"Sales\":{\"Day\":\"0\",\"Type\":\"DAYSAFTERBILLDATE\"}},\"UpdatedDateUTC\":\"2022-10-05T12:51:57+00:00\",\"Balances\":\"\",\"HasAttachments\":\"false\"}'),(38,153,'John Doe',NULL,NULL,NULL,'AACO01',NULL,NULL,NULL,'',NULL,NULL,NULL,'2022-10-19 17:55:49','2022-10-19 17:55:49','Yes','Yes','7-DAYSAFTERBILLDATE','{\"ContactID\":\"4626228f-f9bf-48d4-a034-02345ca9146b\",\"AccountNumber\":\"AACO01\",\"ContactStatus\":\"ACTIVE\",\"Name\":\"AA Company\",\"FirstName\":\"John\",\"LastName\":\"Doe\",\"EmailAddress\":\"ashley@awardservices.com.au\",\"Addresses\":[{\"AddressType\":\"POBOX\",\"AddressLine1\":\"Wylarah Station\",\"AddressLine2\":\"Wylarah Station\",\"AddressLine3\":\"M\\/S 104\",\"City\":\"Surat\",\"Region\":\"QLD\",\"PostalCode\":\"4417\",\"Country\":\"Australia\",\"AttentionTo\":\"Att Business Name\"},{\"AddressType\":\"STREET\"}],\"Phones\":[{\"PhoneType\":\"DDI\"},{\"PhoneType\":\"DEFAULT\",\"PhoneNumber\":\"61746221828\"},{\"PhoneType\":\"FAX\",\"PhoneNumber\":\"617277800\"},{\"PhoneType\":\"MOBILE\",\"PhoneNumber\":\"61427221035\"}],\"IsSupplier\":\"false\",\"IsCustomer\":\"true\",\"PaymentTerms\":{\"Sales\":{\"Day\":\"7\",\"Type\":\"DAYSAFTERBILLDATE\"}},\"UpdatedDateUTC\":\"2022-10-19T09:36:11+00:00\",\"Balances\":\"\",\"HasAttachments\":\"false\"}'),(39,154,'Vlad Tarasov',NULL,NULL,NULL,'',NULL,NULL,NULL,'',NULL,NULL,NULL,'2022-10-19 17:55:49','2022-10-19 17:55:49','Yes','Yes','-','{\"ContactID\":\"f276e9ba-2471-4ec4-b0d6-a1da1b936339\",\"ContactStatus\":\"ACTIVE\",\"Name\":\"Vlad FMS test\",\"FirstName\":\"Vlad\",\"LastName\":\"Tarasov\",\"EmailAddress\":\"vladtarasov20203@gmail.com\",\"CompanyNumber\":\"3232323\",\"Addresses\":[{\"AddressType\":\"POBOX\",\"AddressLine1\":\"219 Hillside Rd\",\"City\":\"AVOCA BEACH\",\"Region\":\"NSW\",\"PostalCode\":\"2251\",\"Country\":\"Australia\"},{\"AddressType\":\"STREET\",\"AddressLine1\":\"217 Clifton Hills Rd\",\"AddressLine2\":\"217 Clifton Hills Rd1\",\"AddressLine3\":\"217 Clifton Hills Rd2\",\"AddressLine4\":\"217 Clifton Hills Rd3\",\"City\":\"CLIFTON HILLS STATION\",\"Region\":\"SA\",\"PostalCode\":\"5731\",\"Country\":\"Australia\",\"AttentionTo\":\"217 Clifton Hills Rd111\"}],\"Phones\":[{\"PhoneType\":\"DDI\"},{\"PhoneType\":\"DEFAULT\",\"PhoneNumber\":\"333\",\"PhoneAreaCode\":\"222\",\"PhoneCountryCode\":\"1111\"},{\"PhoneType\":\"FAX\"},{\"PhoneType\":\"MOBILE\"}],\"IsSupplier\":\"true\",\"IsCustomer\":\"true\",\"UpdatedDateUTC\":\"2022-10-19T09:39:25+00:00\",\"Website\":\"vlad20203.com\",\"Balances\":\"\",\"HasAttachments\":\"false\"}'),(40,155,'John Doe',NULL,NULL,NULL,'AACO01',NULL,NULL,NULL,'cod',NULL,NULL,NULL,'2022-10-23 02:01:34','2022-10-23 02:01:34','Yes','Yes','7-DAYSAFTERBILLDATE','{\"ContactID\":\"4626228f-f9bf-48d4-a034-02345ca9146b\",\"AccountNumber\":\"AACO01\",\"ContactStatus\":\"ACTIVE\",\"Name\":\"AA Company\",\"FirstName\":\"John\",\"LastName\":\"Doe\",\"EmailAddress\":\"ashley@awardservices.com.au\",\"Addresses\":[{\"AddressType\":\"POBOX\",\"AddressLine1\":\"Wylarah Station\",\"AddressLine2\":\"Wylarah Station\",\"AddressLine3\":\"M\\/S 104\",\"City\":\"Surat\",\"Region\":\"QLD\",\"PostalCode\":\"4417\",\"Country\":\"Australia\",\"AttentionTo\":\"Att Business Name\"},{\"AddressType\":\"STREET\"}],\"Phones\":[{\"PhoneType\":\"DDI\"},{\"PhoneType\":\"DEFAULT\",\"PhoneNumber\":\"61746221828\"},{\"PhoneType\":\"FAX\",\"PhoneNumber\":\"617277800\"},{\"PhoneType\":\"MOBILE\",\"PhoneNumber\":\"61427221035\"}],\"IsSupplier\":\"false\",\"IsCustomer\":\"true\",\"PaymentTerms\":{\"Sales\":{\"Day\":\"7\",\"Type\":\"DAYSAFTERBILLDATE\"}},\"UpdatedDateUTC\":\"2022-10-19T09:36:11+00:00\",\"Balances\":\"\",\"HasAttachments\":\"false\"}');

#
# Structure for table "customer_address"
#

DROP TABLE IF EXISTS `customer_address`;
CREATE TABLE `customer_address` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `p_address_line_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `p_suburb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `p_postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_opening_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_address_line_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_suburb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_opening_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_address_line_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_suburb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_opening_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "customer_address"
#

INSERT INTO `customer_address` VALUES (1,58,'123-a','sss','new york','10001','New York',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-12-15 16:01:25','2021-12-15 16:01:25'),(2,59,'123-adfd','sssdfdf','new yorkdfdf','10001dfdf','New Yorkdfdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123-a','sss','new york','10001','New York',NULL,'2021-12-15 22:55:35','2022-01-06 11:53:16'),(3,95,'Kanju town ship',NULL,'Swat','19200',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123-a','sss','new york','10001','New York',NULL,'2022-01-17 17:40:33','2022-01-17 17:51:50'),(4,95,'Kanju town ship',NULL,'Swat','19200',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-01-17 17:41:18','2022-01-17 17:41:18'),(5,95,'Kanju town ship',NULL,'Swat','19200',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-01-17 17:45:09','2022-01-17 17:45:09'),(6,95,'Kanju town ship',NULL,'Swat','19200',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-01-17 17:46:05','2022-01-17 17:46:05'),(7,95,'Kanju town ship',NULL,'Swat','19200',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-01-17 17:48:09','2022-01-17 17:48:09'),(8,95,'Kanju town ship',NULL,'Swat','19200',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-01-17 17:50:25','2022-01-17 17:50:25'),(9,95,'Kanju town ship',NULL,'Swat','19200',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-01-17 17:51:05','2022-01-17 17:51:05'),(10,96,'Kanju town ship','sss','Swat','19200','New York',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-01-17 18:06:28','2022-01-17 18:06:28'),(11,98,'123-a','sss','new york','10001','New York',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-01-17 19:03:24','2022-01-17 19:03:24'),(12,99,'123-a update','sss update','new york update','1000122','New Yorkdd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-01-18 10:42:50','2022-01-18 10:42:50'),(13,100,'b address update','b address 2 update','b suburb update','b postal code update','b state',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-02-08 15:31:41','2022-02-08 15:31:41'),(14,101,'219 Juliette Street, Greenslopes QLD, Australia',NULL,' ','4012',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-26 11:03:13','2022-04-26 11:03:13'),(15,102,'75 Duke St S, Roma QLD, Australia',NULL,'Roma','4455','Queensland',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-27 21:30:06','2022-04-27 21:30:06'),(16,103,'219 Juliette Street, Greenslopes QLD, Australia',NULL,'Greenslopes','4012','QLD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-27 21:31:25','2022-04-27 21:31:25'),(17,107,'98 Wyndham St, Roma QLD, Australia','98 Wyndham St','Roma','4455','QLD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-05-08 11:12:43','2022-05-08 11:12:43'),(18,108,'A Pumpura Iela 164 4',NULL,'Daugavpils','5404','st',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-10-14 15:15:36','2022-10-14 15:15:36');

#
# Structure for table "customer_attachments"
#

DROP TABLE IF EXISTS `customer_attachments`;
CREATE TABLE `customer_attachments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_attachments_customer_id_foreign` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "customer_attachments"
#


#
# Structure for table "customer_bookings"
#

DROP TABLE IF EXISTS `customer_bookings`;
CREATE TABLE `customer_bookings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `statusv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consignment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender` int(11) DEFAULT NULL,
  `receiver` int(11) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

#
# Data for table "customer_bookings"
#

INSERT INTO `customer_bookings` VALUES (3,103,'st1','WT-323','12',1,1,'2022-05-23','33','2022-05-21 20:49:32','2022-05-21 20:49:32');

#
# Structure for table "customer_contacts"
#

DROP TABLE IF EXISTS `customer_contacts`;
CREATE TABLE `customer_contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alerts` tinyint(3) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

#
# Data for table "customer_contacts"
#

INSERT INTO `customer_contacts` VALUES (2,103,'vlad','qqq','543543','543543','vladtarasov20203@gmail.com',0,'2022-05-21 00:17:47','2022-10-15 18:46:54'),(4,123,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:38:50','2022-10-19 17:38:50'),(5,125,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:39:44','2022-10-19 17:39:44'),(6,126,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:41:00','2022-10-19 17:41:00'),(7,129,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:41:55','2022-10-19 17:41:55'),(8,131,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:42:57','2022-10-19 17:42:57'),(9,133,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:43:23','2022-10-19 17:43:23'),(10,135,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:44:28','2022-10-19 17:44:28'),(11,136,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:44:29','2022-10-19 17:44:29'),(12,137,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:44:29','2022-10-19 17:44:29'),(13,139,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:45:59','2022-10-19 17:45:59'),(14,140,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:46:00','2022-10-19 17:46:00'),(15,141,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:46:00','2022-10-19 17:46:00'),(16,142,'Vlad Tarasov','Customer','','333','vladtarasov20203@gmail.com',0,'2022-10-19 17:46:00','2022-10-19 17:46:00'),(17,143,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:46:36','2022-10-19 17:46:36'),(18,144,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:46:37','2022-10-19 17:46:37'),(19,145,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:46:37','2022-10-19 17:46:37'),(20,146,'Vlad Tarasov','Customer','','333','vladtarasov20203@gmail.com',0,'2022-10-19 17:46:37','2022-10-19 17:46:37'),(21,147,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:49:19','2022-10-19 17:49:19'),(22,148,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:49:20','2022-10-19 17:49:20'),(23,149,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:49:20','2022-10-19 17:49:20'),(24,150,'Vlad Tarasov','Customer','','333','vladtarasov20203@gmail.com',0,'2022-10-19 17:49:20','2022-10-19 17:49:20'),(25,151,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:55:48','2022-10-19 17:55:48'),(26,152,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:55:48','2022-10-19 17:55:48'),(27,153,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-19 17:55:49','2022-10-19 17:55:49'),(28,154,'Vlad Tarasov','Customer','','333','vladtarasov20203@gmail.com',0,'2022-10-19 17:55:49','2022-10-19 17:55:49'),(29,155,'John Doe','Customer','61427221035','61746221828','ashley@awardservices.com.au',0,'2022-10-23 02:01:33','2022-10-23 02:01:33');

#
# Structure for table "customer_invoices"
#

DROP TABLE IF EXISTS `customer_invoices`;
CREATE TABLE `customer_invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consignment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender` int(11) DEFAULT NULL,
  `receiver` int(11) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

#
# Data for table "customer_invoices"
#

INSERT INTO `customer_invoices` VALUES (1,103,'wt-inv-321','WT-123','32',3,1,'2022-05-23','2022-05-22 22:09:49','2022-05-22 22:09:49');

#
# Structure for table "customer_notes"
#

DROP TABLE IF EXISTS `customer_notes`;
CREATE TABLE `customer_notes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_notes_customer_id_foreign` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "customer_notes"
#


#
# Structure for table "customer_other_contacts"
#

DROP TABLE IF EXISTS `customer_other_contacts`;
CREATE TABLE `customer_other_contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_other_contacts_customer_id_foreign` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "customer_other_contacts"
#


#
# Structure for table "customer_secondary_contacts"
#

DROP TABLE IF EXISTS `customer_secondary_contacts`;
CREATE TABLE `customer_secondary_contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_secondary_contacts_customer_id_foreign` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "customer_secondary_contacts"
#


#
# Structure for table "customer_sites"
#

DROP TABLE IF EXISTS `customer_sites`;
CREATE TABLE `customer_sites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suburb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operating_hours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_contact` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "customer_sites"
#

INSERT INTO `customer_sites` VALUES (34,108,'demo','A Pumpura Iela 164 4','Daugavpils','Daugavpils','5404','VIC','14:23',NULL,'2022-10-14 15:15:36','2022-10-14 15:15:36'),(35,103,'demo','A Pumpura Iela 164 4',NULL,'Daugavpils','5404',NULL,NULL,NULL,'2022-10-15 16:29:55','2022-10-15 16:29:55'),(36,101,'demo1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-10-15 16:42:25','2022-10-15 16:42:25'),(37,102,'test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-10-15 18:47:19','2022-10-15 18:47:19'),(38,123,NULL,'Must Change','','MUST CHANGE','1234','MUST CHANGE','0-',NULL,'2022-10-19 17:38:50','2022-10-19 17:38:50'),(39,125,NULL,'Must Change','','MUST CHANGE','1234','MUST CHANGE','0-',NULL,'2022-10-19 17:39:44','2022-10-19 17:39:44'),(40,126,NULL,'Must Change','','MUST CHANGE','1234','MUST CHANGE','0-',NULL,'2022-10-19 17:41:00','2022-10-19 17:41:00'),(41,129,NULL,'Must Change','','MUST CHANGE','1234','MUST CHANGE','0-',NULL,'2022-10-19 17:41:54','2022-10-19 17:41:54'),(42,131,NULL,'Must Change','','MUST CHANGE','1234','MUST CHANGE','0-',NULL,'2022-10-19 17:42:57','2022-10-19 17:42:57'),(43,133,NULL,'Must Change','','MUST CHANGE','1234','MUST CHANGE','0-',NULL,'2022-10-19 17:43:23','2022-10-19 17:43:23'),(44,135,NULL,'Must Change','','MUST CHANGE','1234','MUST CHANGE','0-',NULL,'2022-10-19 17:44:28','2022-10-19 17:44:28'),(45,136,NULL,'','','','','','0-',NULL,'2022-10-19 17:44:29','2022-10-19 17:44:29'),(46,137,NULL,'','','','','','7-',NULL,'2022-10-19 17:44:29','2022-10-19 17:44:29'),(47,138,NULL,'217 Clifton Hills Rd','217 Clifton Hills Rd1','CLIFTON HILLS STATION','5731','SA','-',NULL,'2022-10-19 17:44:29','2022-10-19 17:44:29'),(48,139,NULL,'Must Change','','MUST CHANGE','1234','MUST CHANGE','0-',NULL,'2022-10-19 17:45:59','2022-10-19 17:45:59'),(49,140,NULL,'','','','','','0-',NULL,'2022-10-19 17:46:00','2022-10-19 17:46:00'),(50,141,NULL,'','','','','','7-',NULL,'2022-10-19 17:46:00','2022-10-19 17:46:00'),(51,142,NULL,'217 Clifton Hills Rd','217 Clifton Hills Rd1','CLIFTON HILLS STATION','5731','SA','-',NULL,'2022-10-19 17:46:00','2022-10-19 17:46:00'),(52,143,NULL,'Must Change','','MUST CHANGE','1234','MUST CHANGE','0-',NULL,'2022-10-19 17:46:36','2022-10-19 17:46:36'),(53,144,NULL,'','','','','','0-',NULL,'2022-10-19 17:46:37','2022-10-19 17:46:37'),(54,145,NULL,'','','','','','7-',NULL,'2022-10-19 17:46:37','2022-10-19 17:46:37'),(55,146,NULL,'217 Clifton Hills Rd','217 Clifton Hills Rd1','CLIFTON HILLS STATION','5731','SA','-',NULL,'2022-10-19 17:46:37','2022-10-19 17:46:37'),(56,147,'Att Business Name','Must Change','','MUST CHANGE','1234','MUST CHANGE','0-',NULL,'2022-10-19 17:49:19','2022-10-19 17:49:19'),(57,148,'Att Business Name','','','','','','0-',NULL,'2022-10-19 17:49:20','2022-10-19 17:49:20'),(58,149,'','','','','','','7-',NULL,'2022-10-19 17:49:20','2022-10-19 17:49:20'),(59,150,'217 Clifton Hills Rd111','217 Clifton Hills Rd','217 Clifton Hills Rd1','CLIFTON HILLS STATION','5731','SA','-',NULL,'2022-10-19 17:49:20','2022-10-19 17:49:20'),(60,151,'Att Business Name','Must Change','','MUST CHANGE','1234','MUST CHANGE','0-DAYSAFTERBILLDATE',NULL,'2022-10-19 17:55:48','2022-10-19 17:55:48'),(61,152,'Att Business Name','','','','','','0-DAYSAFTERBILLDATE',NULL,'2022-10-19 17:55:48','2022-10-19 17:55:48'),(62,153,'','','','','','','7-DAYSAFTERBILLDATE',NULL,'2022-10-19 17:55:48','2022-10-19 17:55:48'),(63,154,'217 Clifton Hills Rd111','217 Clifton Hills Rd','217 Clifton Hills Rd1','CLIFTON HILLS STATION','5731','SA','-',NULL,'2022-10-19 17:55:49','2022-10-19 17:55:49'),(64,155,'','','','','','','7-DAYSAFTERBILLDATE',NULL,'2022-10-23 02:01:33','2022-10-23 02:01:33');

#
# Structure for table "employees"
#

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `new_pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `can_login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `can_use_app` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "employees"
#

INSERT INTO `employees` VALUES (4,'user1','user1','$2y$10$5elFxcTJv.CJ5bhdLN463uvg8LOv/mV6ssw88htvMxzAXUMkDFWJ.','123456','admin@domain.com',13,'$2y$10$/TwT0cFOU5IMlQsnYw6yv.1CSB69Do2WNybMTr7WQLRCrlkF9EzD2','1','1','2022-10-12 16:52:17','2022-10-12 16:52:17');

#
# Structure for table "failed_jobs"
#

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
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

#
# Data for table "failed_jobs"
#


#
# Structure for table "items"
#

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "items"
#

INSERT INTO `items` VALUES (1,'Bag','bag description','2021-12-16 13:34:25','2021-12-16 13:34:25'),(2,'Bale - Clothes','clothes description','2021-12-16 13:34:25','2021-12-16 13:34:25'),(3,'Bale - Wool','wool description','2021-12-16 13:34:25','2021-12-16 13:34:25'),(4,'Bar & Rail - 210','rail description','2021-12-16 13:34:25','2021-12-16 13:34:25'),(5,'Bar & Rail - 270','rail description','2021-12-16 13:34:25','2021-12-16 13:34:25'),(6,'Bar 210','210 description','2021-12-16 13:34:25','2021-12-16 13:34:25'),(7,'Black Case','case description','2021-12-16 13:34:25','2021-12-16 13:34:25'),(8,'Box - Plants',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(9,'Brackets - 60',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(10,'Bulkier Bag',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(11,'Bundle',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(12,'Carton',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(13,'Carton - CCA',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(14,'Carton - Large Bike',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(15,'Carton - Small Bike',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(16,'Casing',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(17,'Coffin',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(18,'Container - 10',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(19,'Container - 20',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(20,'Container - 40',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(21,'Crate',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(22,'Cylinder',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(23,'Drum',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(24,'Esky',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(25,'FTL - A',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(26,'FTL - B',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(27,'Furniture',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(28,'IBC',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(29,'Jiffy Bag',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(30,'Logs',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(31,'LTL',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(32,'Miscellaneous',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(33,'Moto Crate - Large',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(34,'Moto Crate - Small',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(35,'Pallet',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(36,'Pallet - Chiller',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(37,'Pallet - Dry',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(38,'Pallet - Feed',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(39,'Pallet - Freezer',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(40,'Pallet - Gas Bottles',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(41,'Pallet - Kegs',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(42,'Pallet - Milk',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(43,'Pipe',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(44,'Rails - 270',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(45,'Roll',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(46,'Skid',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(47,'Steel',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(48,'Tank',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(49,'Timber Pack',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(50,'Tyre - 4WD/Light Truck/Bobcat',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(51,'Tyre - AG',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(52,'Tyre - Bundle',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(53,'Tyre - Car/Forklift/Mower ',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(54,'Tyre - Truck',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(55,'Tyre – Loader/Grader/Large Ag/Earthmover',NULL,'2022-04-28 12:03:19','2022-04-28 12:03:19'),(56,'Vehicle',NULL,'2022-04-28 12:03:28','2022-04-28 12:03:28');

#
# Structure for table "job_item_dg_details"
#

DROP TABLE IF EXISTS `job_item_dg_details`;
CREATE TABLE `job_item_dg_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint(20) unsigned NOT NULL,
  `o_random_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `o_dg_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `o_dg_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `o_dg_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `o_dg_class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "job_item_dg_details"
#


#
# Structure for table "job_items"
#

DROP TABLE IF EXISTS `job_items`;
CREATE TABLE `job_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL,
  `random_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_type` bigint(11) unsigned NOT NULL,
  `item_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_length` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_width` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_height` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_tweight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_stackable` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_plt_spc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_cubic_m3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `items_id` (`item_type`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "job_items"
#

INSERT INTO `job_items` VALUES (5,5,'18100',NULL,'7',3,NULL,'23','23','2','323','2261','off',NULL,'10.58',NULL,NULL,NULL,'2022-01-03 13:48:11','2022-01-03 13:48:11'),(6,5,'18100',NULL,'7',4,NULL,'23','23','2','323','2261','off',NULL,'10.58',NULL,NULL,NULL,'2022-01-03 13:48:11','2022-01-03 13:48:11'),(7,6,'18100',NULL,'7',5,NULL,'23','23','2','323','2261','off',NULL,'10.58',NULL,NULL,NULL,'2022-01-03 13:48:11','2022-01-03 13:48:11'),(8,6,'18100',NULL,'7',6,NULL,'23','23','2','323','2261','off',NULL,'10.58',NULL,NULL,NULL,'2022-01-03 13:48:11','2022-01-03 13:48:11'),(9,7,'82105',NULL,'23',2,NULL,'23','23','23','23','529','off',NULL,'121.67',NULL,NULL,NULL,'2022-01-05 19:33:02','2022-01-05 19:33:02'),(10,8,'93222',NULL,'12',5,NULL,'12','121','12','2','24','off',NULL,'174.24',NULL,NULL,NULL,'2022-01-05 20:10:39','2022-01-05 20:10:39'),(11,9,'34275',NULL,'12',2,NULL,'12','12','12','12','144','off',NULL,'0.001728',NULL,NULL,NULL,'2022-01-19 18:25:34','2022-01-19 18:25:34'),(12,10,'73092',NULL,'12',1,NULL,'1','1','1','1','12','off',NULL,'0.000001',NULL,NULL,NULL,'2022-01-20 10:53:08','2022-01-20 10:53:08'),(13,11,'86011',NULL,'12',2,NULL,'12','12','12','12','144','off',NULL,'0.001728',NULL,NULL,NULL,'2022-01-20 12:27:03','2022-01-20 12:27:03'),(14,12,'66664',NULL,'3',2,NULL,'5','5','5','4','12','off',NULL,'0.000125',NULL,NULL,NULL,'2022-01-20 17:42:42','2022-01-20 17:42:42'),(15,13,'68133',NULL,'2',3,NULL,'1','1','1','1','2552','off',NULL,'0.001331',NULL,NULL,NULL,'2022-04-30 18:01:39','2022-04-30 18:01:39'),(16,14,'90353',NULL,'2',4,NULL,'1','1','3','1','276','off',NULL,'0.004992',NULL,NULL,NULL,'2022-05-02 17:43:46','2022-06-22 16:20:49'),(17,15,'77656',NULL,'3',3,NULL,'1','1','2','3','1024','off',NULL,'0.003312',NULL,NULL,NULL,'2022-05-02 17:44:50','2022-06-06 23:47:49'),(18,16,'74239',NULL,'2',1,'23','3','2','2','2','529','off',NULL,'0.016928','23',NULL,NULL,'2022-05-02 17:54:56','2022-06-06 23:48:14'),(19,22,'77122','32','3',4,'item 0003 description','3','3','3','3','1024','off',NULL,'0.032768','42',NULL,NULL,'2022-06-29 02:13:25','2022-06-29 02:13:25'),(20,17,'24835','test','12233',3,'item 0001 description','3','3','3','3','36699','off','32','0.000027','21',NULL,NULL,'2022-08-02 14:56:04','2022-10-23 02:58:35'),(21,17,'24269','item-ref-002','23',3,'item 0002 description','13','33','3','3','69','off','23','0.001287','44',NULL,NULL,'2022-10-18 07:05:07','2022-10-23 02:58:35');

#
# Structure for table "job_load_restraints"
#

DROP TABLE IF EXISTS `job_load_restraints`;
CREATE TABLE `job_load_restraints` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL,
  `bolsters` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chains` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dogs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gates` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `straps` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "job_load_restraints"
#

INSERT INTO `job_load_restraints` VALUES (1,1,'off','off','off','off','off','off','off','off','2021-12-23 15:59:47','2021-12-23 15:59:47'),(2,2,'off','off','off','off','off','off','off','off','2021-12-23 17:06:30','2021-12-23 17:06:30'),(3,3,'off','off','off','off','off','off','off','off','2022-01-01 18:56:15','2022-01-01 18:56:15'),(4,4,'off','off','off','off','off','off','off','off','2022-01-01 19:18:18','2022-01-01 19:18:18'),(5,5,'off','off','off','off','off','off','off','off','2022-01-03 13:48:11','2022-01-03 13:48:11'),(6,7,'off','off','off','off','off','off','off','off','2022-01-05 19:33:02','2022-01-05 19:33:02'),(7,8,'off','off','off','off','off','off','off','off','2022-01-05 20:10:39','2022-01-05 20:10:39'),(8,9,'off','off','off','off','off','off','off','off','2022-01-19 18:25:34','2022-01-19 18:25:34'),(9,10,'off','off','off','off','off','off','off','off','2022-01-20 10:53:08','2022-01-20 10:53:08'),(10,11,'off','off','off','off','off','off','off','off','2022-01-20 12:27:03','2022-01-20 12:27:03'),(11,12,'off','off','off','off','off','off','off','off','2022-01-20 17:42:42','2022-01-20 17:42:42'),(12,13,'off','off','off','off','off','off','off','off','2022-04-30 18:01:39','2022-04-30 18:01:39'),(13,14,'off','off','off','off','off','off','off','off','2022-05-02 17:43:46','2022-05-02 17:43:46'),(14,15,'off','off','off','off','off','off','off','off','2022-05-02 17:44:50','2022-05-02 17:44:50'),(15,16,'off','off','off','off','off','off','off','off','2022-05-02 17:54:56','2022-05-02 17:54:56'),(16,22,'off','off','off','off','off','off','off','off','2022-06-29 02:13:26','2022-06-29 02:13:26'),(17,17,'off','off','off','off','off','off','off','off','2022-08-02 14:56:04','2022-08-02 14:56:04');

#
# Structure for table "job_notes"
#

DROP TABLE IF EXISTS `job_notes`;
CREATE TABLE `job_notes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `driver_id` bigint(20) unsigned NOT NULL,
  `job_id` bigint(20) unsigned NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "job_notes"
#

INSERT INTO `job_notes` VALUES (1,58,2,'test note one','2021-12-29 17:07:15','2021-12-29 17:07:15'),(2,58,2,'test note two','2021-12-29 17:07:15','2021-12-29 17:07:15'),(3,58,2,'test note one','2021-12-29 17:49:21','2021-12-29 17:49:21'),(4,58,2,'test note two','2021-12-29 17:49:21','2021-12-29 17:49:21');

#
# Structure for table "job_pallet_controls"
#

DROP TABLE IF EXISTS `job_pallet_controls`;
CREATE TABLE `job_pallet_controls` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL,
  `in_chep` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `out_chep` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_loscam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `out_loscam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transfer_in_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfer_out_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "job_pallet_controls"
#

INSERT INTO `job_pallet_controls` VALUES (13,14,'12','23','23','321','2022-05-02 17:43:46','2022-06-08 17:17:15',NULL,NULL,'na'),(14,15,'12','15','423','23','2022-05-02 17:44:50','2022-06-06 23:47:49',NULL,NULL,'exchange'),(15,16,'65','3','23','73','2022-05-02 17:54:56','2022-06-06 23:48:14','2223','4332','transfer'),(16,22,'32','32','32','23','2022-06-29 02:13:26','2022-06-29 02:13:26',NULL,NULL,'exchange'),(17,17,NULL,NULL,NULL,NULL,'2022-08-02 14:56:04','2022-08-02 14:56:04',NULL,NULL,'na');

#
# Structure for table "job_photos"
#

DROP TABLE IF EXISTS `job_photos`;
CREATE TABLE `job_photos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `driver_id` bigint(20) unsigned NOT NULL,
  `job_id` bigint(20) unsigned NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "job_photos"
#

INSERT INTO `job_photos` VALUES (5,58,2,'1640773980_300_21 (1).jpg','2021-12-29 16:33:00','2021-12-29 16:33:00'),(6,58,2,'1640773980_WhatsApp Image 2021-11-13 at 1.52.00 PM.jpeg','2021-12-29 16:33:00','2021-12-29 16:33:00');

#
# Structure for table "job_receivers"
#

DROP TABLE IF EXISTS `job_receivers`;
CREATE TABLE `job_receivers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL,
  `receiver_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_address_line_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_suburb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `onforworder` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `r_collect_at_branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forworder_option` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_Pick_up_notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "job_receivers"
#

INSERT INTO `job_receivers` VALUES (1,1,'59','123-adfd','sssdfdf','new yorkdfdf','10001dfdf','New Yorkdfdf',NULL,'zakir zakfff','8990000000dd','no',NULL,NULL,NULL,NULL,'2021-12-23 15:59:47','2021-12-23 15:59:47'),(2,2,'59','123-adfd','sssdfdf','new yorkdfdf','10001dfdf','New Yorkdfdf',NULL,'zakir zakfff','8990000000dd','no',NULL,NULL,NULL,NULL,'2021-12-23 17:06:30','2021-12-23 17:06:30'),(3,3,'64','b address update','b address 2 update','b suburb update','b postal code update','b state',NULL,'zakir zak','8990000000','no',NULL,NULL,NULL,NULL,'2022-01-01 18:56:15','2022-01-01 18:56:15'),(4,4,'59','123-adfd','sssdfdf','new yorkdfdf','10001dfdf','New Yorkdfdf',NULL,'zakir zakfff','8990000000dd','no',NULL,NULL,NULL,NULL,'2022-01-01 19:18:18','2022-01-01 19:18:18'),(5,5,'64','Kanju town ship','sss','Swat','19200','New York',NULL,'zakir zak','8990000000','no',NULL,NULL,NULL,NULL,'2022-01-03 13:48:11','2022-01-03 13:48:11'),(6,6,'webexert','Kanju town ship','sss','Swat','19200','New York',NULL,'zakir zak','8990000000','no',NULL,NULL,NULL,NULL,'2022-01-03 13:48:11','2022-01-03 13:48:11'),(7,7,'Amazon Echo','Kanju town ship','p address 2 update','Swat','19200','New Yorkdd',NULL,'zakir zak','8990000000','no',NULL,NULL,NULL,NULL,'2022-01-05 19:33:02','2022-01-05 19:33:02'),(8,8,'Amazon Echo','Kanju town ship','p address 2 update','Swat','19200','New Yorkdd',NULL,'zakir zak','8990000000','no',NULL,NULL,NULL,NULL,'2022-01-05 20:10:39','2022-01-05 20:10:39'),(9,9,'Amazon Echo','123-a update','sss update','new york update','1000122','New Yorkdd',NULL,'zakir zak','8990000000','no',NULL,NULL,NULL,NULL,'2022-01-19 18:25:34','2022-01-19 18:25:34'),(10,10,'Amazon Echo','123-a update','sss update','new york update','1000122','New Yorkdd',NULL,'zakir zak','8990000000','no',NULL,NULL,NULL,NULL,'2022-01-20 10:53:08','2022-01-20 10:53:08'),(11,11,'Amazon Echo','123-a update','sss update','new york update','1000122','New Yorkdd',NULL,'zakir zak','8990000000','no',NULL,NULL,NULL,NULL,'2022-01-20 12:27:03','2022-01-20 12:27:03'),(12,12,'Amazon Echo','123-a update','sss update','new york update','1000122','New Yorkdd',NULL,'zakir zak','8990000000','no',NULL,NULL,NULL,NULL,'2022-01-20 17:42:42','2022-01-20 17:42:42'),(13,13,'Beryl Ward','melb','melb','melb','4455','Wyoming',NULL,'Beryl Ward',NULL,'no',NULL,NULL,NULL,NULL,'2022-04-30 18:01:39','2022-04-30 18:01:39'),(14,14,'ZZ_Beryl Ward_Test','75 Duke St S, Roma QLD, Australia','add','Roma','4455','Queensland',NULL,'Beryl Ward',NULL,'no',NULL,NULL,NULL,NULL,'2022-05-02 17:43:46','2022-05-02 17:43:46'),(15,15,'ZZ_Beryl Ward_Test','75 Duke St S, Roma QLD, Australia','add','Roma','4455','Queensland',NULL,'Beryl Ward',NULL,'no',NULL,NULL,NULL,NULL,'2022-05-02 17:44:50','2022-05-02 17:44:50'),(16,16,'ZZ_Ashley Ward_Test','219 Juliette Street, Greenslopes QLD, Australia','add','Greenslopes','4012','QLD',NULL,'Ashley Ward',NULL,'no',NULL,NULL,NULL,NULL,'2022-05-02 17:54:56','2022-05-02 17:54:56'),(17,17,'ZZ_Beryl Ward_Test','75 Duke St S, Roma QLD, Australia',NULL,'Roma','4455','Queensland',NULL,'Beryl Ward',NULL,'no',NULL,NULL,NULL,NULL,'2022-06-29 01:58:31','2022-10-18 07:33:59'),(18,18,'ZZ_Beryl Ward_Test','75 Duke St S, Roma QLD, Australia',NULL,'Roma','4455','Queensland',NULL,'Beryl Ward',NULL,'no',NULL,NULL,NULL,NULL,'2022-06-29 01:58:38','2022-06-29 01:58:38'),(19,19,'ZZ_Beryl Ward_Test','75 Duke St S, Roma QLD, Australia',NULL,'Roma','4455','Queensland',NULL,'Beryl Ward',NULL,'no',NULL,NULL,NULL,NULL,'2022-06-29 01:58:47','2022-06-29 01:58:47'),(20,20,'ZZ_Ashley Ward_Test111','219 Juliette Street, Greenslopes QLD, Australia',NULL,'Greenslopes','4012','QLD',NULL,'Ashley Ward',NULL,'no',NULL,NULL,NULL,NULL,'2022-06-29 02:01:00','2022-06-29 02:01:00'),(21,21,'ZZ_Ashley Ward_Test111','219 Juliette Street, Greenslopes QLD, Australia',NULL,'Greenslopes','4012','QLD',NULL,'Ashley Ward',NULL,'no',NULL,NULL,NULL,NULL,'2022-06-29 02:01:40','2022-06-29 02:01:40'),(22,22,'ZZ_Ashley Ward_Test111','219 Juliette Street, Greenslopes QLD, Australia',NULL,'Greenslopes','4012','QLD',NULL,'Ashley Ward',NULL,'no',NULL,NULL,NULL,NULL,'2022-06-29 02:13:25','2022-06-29 02:13:25');

#
# Structure for table "job_senders"
#

DROP TABLE IF EXISTS `job_senders`;
CREATE TABLE `job_senders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL,
  `sender_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_address_line_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suburb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `third_part_collection_charge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge_collector_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge_collector_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ready_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ready_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pick_up_notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "job_senders"
#

INSERT INTO `job_senders` VALUES (1,1,'58','123-a','sss','new york','10001','New York',NULL,'zakir zak','8990000000',NULL,'teryTruck 1',NULL,NULL,'3:00 PM',NULL,'2021-12-23 15:59:47','2021-12-23 15:59:47'),(2,2,'58','123-a','sss','new york','10001','New York',NULL,'zakir zak','8990000000',NULL,'teryTruck 1',NULL,NULL,'4:15 PM',NULL,'2021-12-23 17:06:30','2021-12-23 17:06:30'),(3,3,'59','123-adfd','sssdfdf','new yorkdfdf','10001dfdf','New Yorkdfdf',NULL,'zakir zakfff','8990000000dd',NULL,'teryTruck 1',NULL,NULL,'6:00 PM',NULL,'2022-01-01 18:56:15','2022-01-01 18:56:15'),(4,4,'59','123-adfd','sssdfdf','new yorkdfdf','10001dfdf','New Yorkdfdf',NULL,'zakir zakfff','8990000000dd',NULL,'teryTruck 1',NULL,NULL,'6:30 PM',NULL,'2022-01-01 19:18:18','2022-01-01 19:18:18'),(5,5,'59','123-adfd','sssdfdf','new yorkdfdf','10001dfdf','New Yorkdfdf',NULL,'zakir zakfff','8990000000dd',NULL,'teryTruck 1',NULL,NULL,'1:00 PM',NULL,'2022-01-03 13:48:11','2022-01-03 13:48:11'),(6,7,'freelancer','123-adfd','sssdfdf','new yorkdfdf','10001dfdf','New Yorkdfdf',NULL,'zakir zakfff','8990000000dd',NULL,'teryTruck 1',NULL,NULL,'6:45 PM',NULL,'2022-01-05 19:33:02','2022-01-05 19:33:02'),(7,8,'freelancer','123-adfd','sssdfdf','new yorkdfdf','10001dfdf','New Yorkdfdf',NULL,'zakir zakfff','8990000000dd',NULL,'teryTruck 1',NULL,NULL,'7:15 PM',NULL,'2022-01-05 20:10:39','2022-01-05 20:10:39'),(8,9,'Amazon Echo update','123-a','sss','new york','10001','New York',NULL,'zakir zak','8990000000',NULL,'teryTruck 1',NULL,NULL,'5:30 PM',NULL,'2022-01-19 18:25:34','2022-01-19 18:25:34'),(9,10,'Amazon Echo update','123-a','sss','new york','10001','New York',NULL,'zakir zak','8990000000',NULL,'teryTruck 1',NULL,NULL,'9:30 AM',NULL,'2022-01-20 10:53:08','2022-01-20 10:53:08'),(10,11,'Amazon Echo update','123-a','sss','new york','10001','New York',NULL,'zakir zak','8990000000',NULL,'teryTruck 1',NULL,NULL,'11:30 AM',NULL,'2022-01-20 12:27:03','2022-01-20 12:27:03'),(11,12,'Amazon Echo update','123-a','sss','new york','10001','New York',NULL,'zakir zak','8990000000',NULL,'teryTruck 1',NULL,NULL,'4:45 PM',NULL,'2022-01-20 17:42:42','2022-01-20 17:42:42'),(12,13,'test custmmmmer','b address update','b address 2 update','b suburb update','b postal code update','b state',NULL,'zakir zak','8990000000',NULL,'teryTruck 1',NULL,NULL,'6:00 PM',NULL,'2022-04-30 18:01:39','2022-04-30 18:01:39'),(13,14,'ZZ_Davichi_Test','219 Juliette Street, Greenslopes QLD, Australia','add',NULL,'4012','st',NULL,'Davichi',NULL,NULL,'teryTruck 1',NULL,'2022-06-22','2:30 AM',NULL,'2022-05-02 17:43:46','2022-06-22 16:20:49'),(14,15,'ZZ_Davichi_Test','219 Juliette Street, Greenslopes QLD, Australia','add',NULL,'4012','st',NULL,'Davichi',NULL,NULL,'teryTruck 1',NULL,'2022-06-06','10:00 AM',NULL,'2022-05-02 17:44:50','2022-06-06 23:47:49'),(15,16,'ZZ_Davichi_Test','219 Juliette Street, Greenslopes QLD, Australia','ad',NULL,'4012','st',NULL,'Davichi',NULL,NULL,'teryTruck 1',NULL,'2022-06-06','10:00 AM',NULL,'2022-05-02 17:54:56','2022-06-06 23:48:14'),(16,17,'ZZ_Ron_Test','98 Wyndham St, Roma QLD, Australia','98 Wyndham St','Roma','4455','QLD',NULL,'Davichi',NULL,NULL,'teryTruck 1',NULL,'2022-10-23','2:00 PM',NULL,'2022-06-29 01:58:31','2022-10-23 03:06:52'),(17,18,'ZZ_Ron_Test','98 Wyndham St, Roma QLD, Australia','98 Wyndham St','Roma','4455','QLD',NULL,'Davichi',NULL,NULL,'teryTruck 1',NULL,'2022-06-29','01-56-49',NULL,'2022-06-29 01:58:38','2022-06-29 01:58:38'),(18,19,'ZZ_Ron_Test','98 Wyndham St, Roma QLD, Australia','98 Wyndham St','Roma','4455','QLD',NULL,'Davichi',NULL,NULL,'teryTruck 1',NULL,'2022-06-29','01-56-49',NULL,'2022-06-29 01:58:47','2022-06-29 01:58:47'),(19,20,'ZZ_Ron_Test','98 Wyndham St, Roma QLD, Australia','98 Wyndham St','Roma','4455','QLD',NULL,'Ron Ward',NULL,NULL,'teryTruck 1','21','2022-06-29','01-59-37',NULL,'2022-06-29 02:01:00','2022-06-29 02:01:00'),(20,21,'ZZ_Ron_Test','98 Wyndham St, Roma QLD, Australia','98 Wyndham St','Roma','4455','QLD',NULL,'Ron Ward',NULL,NULL,'teryTruck 1','21','2022-06-29','01-59-37',NULL,'2022-06-29 02:01:40','2022-06-29 02:01:40'),(21,22,'ZZ_Ron_Test','98 Wyndham St, Roma QLD, Australia','98 Wyndham St','Roma','4455','QLD',NULL,'Ron Ward',NULL,NULL,'teryTruck 1','21','2022-06-29','01-59-37',NULL,'2022-06-29 02:13:25','2022-06-29 02:13:25');

#
# Structure for table "job_statuses"
#

DROP TABLE IF EXISTS `job_statuses`;
CREATE TABLE `job_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "job_statuses"
#

INSERT INTO `job_statuses` VALUES (2,'Assigned for Pickup','2021-12-16 04:15:22','2022-05-27 00:43:28','#00ff00'),(3,'Onboard for Delivery','2021-12-16 04:15:29','2022-05-27 00:46:49','#004dff'),(4,'In Branch','2022-01-01 05:39:42','2022-05-27 00:46:34','#ff0000'),(5,'In Transit','2022-04-30 12:27:38','2022-05-27 00:42:35','#840257'),(6,'Delivered','2022-04-30 12:27:38','2022-05-27 00:45:54','#8100ff'),(7,'Partial Delivery','2022-04-30 12:27:43','2022-05-27 00:48:38','#2600ff'),(8,'Rejected Delivery','2022-04-30 12:27:50','2022-05-27 00:48:21','#ffa400'),(9,'Futile Pickup','2022-04-30 12:27:55','2022-05-27 00:45:41','#00d0ff'),(10,'Complete','2022-04-30 12:28:01','2022-05-27 00:43:49','#ffe700'),(11,'Booked In','2022-05-01 19:30:55','2022-05-01 19:30:55',NULL),(12,'Closed','2022-05-01 19:31:13','2022-05-27 00:46:10','#373838'),(13,'Invoiced','2022-05-01 19:31:37','2022-05-27 00:47:04','#9cff00'),(14,'Ready for Pickup','2022-05-01 19:32:40','2022-05-27 00:49:07','#00ff04');

#
# Structure for table "job_total_prices"
#

DROP TABLE IF EXISTS `job_total_prices`;
CREATE TABLE `job_total_prices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL,
  `job_total_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_handling_fee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_unload_fee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_pick_up_fee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_delivery_fee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "job_total_prices"
#

INSERT INTO `job_total_prices` VALUES (1,1,NULL,NULL,NULL,'off','on','2021-12-23 15:59:47','2021-12-23 15:59:47'),(2,2,NULL,NULL,NULL,'off','on','2021-12-23 17:06:30','2021-12-23 17:06:30'),(3,3,NULL,NULL,NULL,'off','on','2022-01-01 18:56:15','2022-01-01 18:56:15'),(4,4,NULL,NULL,NULL,'off','on','2022-01-01 19:18:18','2022-01-01 19:18:18'),(5,5,NULL,NULL,NULL,'off','on','2022-01-03 13:48:11','2022-01-03 13:48:11'),(6,7,NULL,NULL,NULL,'off','on','2022-01-05 19:33:02','2022-01-05 19:33:02'),(7,8,NULL,NULL,NULL,'off','on','2022-01-05 20:10:39','2022-01-05 20:10:39'),(8,9,NULL,NULL,NULL,'off','on','2022-01-19 18:25:34','2022-01-19 18:25:34'),(9,10,NULL,NULL,NULL,'off','on','2022-01-20 10:53:08','2022-01-20 10:53:08'),(10,11,NULL,NULL,NULL,'off','on','2022-01-20 12:27:03','2022-01-20 12:27:03'),(11,12,NULL,NULL,NULL,'off','on','2022-01-20 17:42:42','2022-01-20 17:42:42'),(12,13,NULL,NULL,NULL,'off','on','2022-04-30 18:01:39','2022-04-30 18:01:39'),(13,14,NULL,NULL,NULL,'off','off','2022-05-02 17:43:46','2022-06-06 18:02:13'),(14,15,NULL,NULL,NULL,'off','off','2022-05-02 17:44:50','2022-06-06 23:47:49'),(15,16,NULL,NULL,NULL,'off','off','2022-05-02 17:54:56','2022-06-06 23:48:14'),(16,22,NULL,NULL,NULL,'off','off','2022-06-29 02:13:26','2022-06-29 02:13:26'),(17,17,NULL,NULL,NULL,'off','off','2022-08-02 14:56:04','2022-08-02 14:56:04');

#
# Structure for table "jobs"
#

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connote_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quote_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_driver` int(11) DEFAULT NULL,
  `job_status` bigint(11) unsigned NOT NULL,
  `current_branch` int(11) unsigned DEFAULT NULL,
  `m_connote_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_branch` bigint(11) unsigned DEFAULT NULL,
  `receiver_branch` bigint(11) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `manifest_id` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `xero_data` varchar(2550) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_status` (`job_status`),
  KEY `sender_id` (`sender_branch`),
  KEY `receiver_id` (`receiver_branch`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "jobs"
#

INSERT INTO `jobs` VALUES (14,'4179','WT-04179',NULL,NULL,NULL,NULL,'express',NULL,10,1,NULL,2,10,'2022-06-23 12:06:00','2022-06-24 08:12:02',NULL,NULL,NULL),(15,'5788','WT-05788',NULL,NULL,NULL,NULL,'general',NULL,2,2,NULL,2,8,'2022-06-23 12:06:00','2022-06-24 03:16:33',NULL,NULL,NULL),(16,'9944','WT-09944',NULL,NULL,NULL,'22113','general',NULL,2,2,'MC-01211',2,10,'2022-06-23 12:06:00','2022-06-24 03:16:33',NULL,NULL,NULL),(17,'5726','WT-05726','Ref-05726',NULL,NULL,NULL,'general',NULL,14,NULL,'MC-01211',21,6,'2022-06-29 01:58:31','2022-10-23 03:06:54',NULL,NULL,'{\"Type\":\"ACCREC\",\"Contact\":{\"ContactID\":\"f276e9ba-2471-4ec4-b0d6-a1da1b936339\",\"ContactStatus\":\"ACTIVE\",\"Name\":\"Vlad FMS test\",\"FirstName\":\"Vlad\",\"LastName\":\"Tarasov\",\"EmailAddress\":\"vladtarasov20203@gmail.com\",\"CompanyNumber\":\"3232323\",\"Addresses\":[{\"AddressType\":\"POBOX\",\"AddressLine1\":\"219 Hillside Rd\",\"City\":\"AVOCA BEACH\",\"Region\":\"NSW\",\"PostalCode\":\"2251\",\"Country\":\"Australia\"},{\"AddressType\":\"STREET\",\"AddressLine1\":\"217 Clifton Hills Rd\",\"AddressLine2\":\"217 Clifton Hills Rd1\",\"AddressLine3\":\"217 Clifton Hills Rd2\",\"AddressLine4\":\"217 Clifton Hills Rd3\",\"City\":\"CLIFTON HILLS STATION\",\"Region\":\"SA\",\"PostalCode\":\"5731\",\"Country\":\"Australia\",\"AttentionTo\":\"217 Clifton Hills Rd111\"}],\"Phones\":[{\"PhoneType\":\"DDI\"},{\"PhoneType\":\"DEFAULT\",\"PhoneNumber\":\"333\",\"PhoneAreaCode\":\"222\",\"PhoneCountryCode\":\"1111\"},{\"PhoneType\":\"FAX\"},{\"PhoneType\":\"MOBILE\"}],\"IsSupplier\":\"true\",\"IsCustomer\":\"true\",\"UpdatedDateUTC\":\"2022-10-19T09:39:25+00:00\",\"Website\":\"vlad20203.com\",\"Balances\":\"\",\"HasAttachments\":\"false\"},\"LineItems\":[{\"Description\":\"item 0001 description\",\"Quantity\":\"12233\",\"UnitAmount\":\"21\",\"AccountCode\":\"200\"},{\"Description\":\"item 0002 description\",\"Quantity\":\"23\",\"UnitAmount\":\"44\",\"AccountCode\":\"200\"}],\"Date\":\"2022-10-23\",\"DueDate\":\"2022-10-23\",\"LineAmountTypes\":\"Exclusive\",\"InvoiceNumber\":\"INV-0018\",\"Reference\":\"Ref-05726\",\"BrandingThemeID\":\"5aad789f-677d-41ab-8f05-2e7fc0daad35\",\"CurrencyCode\":\"AUD\",\"CurrencyRate\":\"1\",\"Status\":\"AUTHORISED\",\"SentToContact\":\"false\",\"SubTotal\":\"257905\",\"TotalTax\":\"25790.5\",\"Total\":\"283695.5\",\"InvoiceID\":\"24d1f2d8-9988-4cd0-ae98-caf243028785\",\"AmountDue\":\"283695.5\",\"AmountPaid\":\"0\",\"UpdatedDateUTC\":\"2022-10-23T03:06:56+00:00\"}'),(20,'6288','WT-06288',NULL,NULL,NULL,NULL,'express',NULL,13,NULL,NULL,19,21,'2022-06-29 02:01:00','2022-06-29 02:14:51',NULL,'2022-06-29 02:14:51',NULL),(21,'6288','WT-06288',NULL,NULL,NULL,NULL,'express',NULL,13,NULL,NULL,19,21,'2022-06-29 02:01:40','2022-06-29 02:15:28',NULL,'2022-06-29 02:15:28',NULL),(22,'6288','WT-06288',NULL,NULL,NULL,NULL,'express',NULL,13,NULL,NULL,19,21,'2022-06-29 02:13:25','2022-06-29 02:13:25',NULL,NULL,NULL);

#
# Structure for table "manifests"
#

DROP TABLE IF EXISTS `manifests`;
CREATE TABLE `manifests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `driver` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dispatch_branch` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiving_branch` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arrival_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "manifests"
#

INSERT INTO `manifests` VALUES (2,'105','15','2','Delivery','tra','2022-04-04','2022-04-30 13:39:55','2022-04-30 13:39:55'),(3,'106','3','6','Pickup','tet','2022-04-01','2022-04-30 15:47:14','2022-04-30 15:47:14'),(4,'104','2','6','Pickup','pass','2022-05-06','2022-04-30 16:00:46','2022-04-30 16:00:46'),(5,'104','2','13','Linehaul','123','2022-05-01','2022-04-30 18:36:02','2022-04-30 18:36:02');

#
# Structure for table "migrations"
#

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "migrations"
#

INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1),(2,'2019_08_19_000000_create_failed_jobs_table',1),(3,'2021_03_09_101046_create_settings_table',1),(4,'2021_12_06_110457_create_prices_table',1),(5,'2021_12_06_110731_create_branches_table',1),(6,'2021_12_06_110731_create_customer_account_details_table',1),(7,'2021_12_06_110731_create_customer_address_table',1),(8,'2021_12_06_110731_create_customer_attachments_table',1),(9,'2021_12_06_110731_create_customer_notes_table',1),(10,'2021_12_06_110731_create_customer_other_contacts_table',1),(11,'2021_12_06_110731_create_customer_primary_contacts_table',1),(12,'2021_12_06_110731_create_customer_secondary_contacts_table',1),(13,'2021_12_06_110731_create_customer_sites_table',1),(14,'2021_12_06_110731_create_items_table',1),(15,'2021_12_06_110731_create_job_statuses_table',1),(16,'2021_12_06_110731_create_manifests_table',1),(17,'2021_12_06_110731_create_users_table',1),(18,'2021_12_06_110732_add_foreign_keys_to_customer_account_details_table',1),(19,'2021_12_06_110732_add_foreign_keys_to_customer_attachments_table',1),(20,'2021_12_06_110732_add_foreign_keys_to_customer_notes_table',1),(21,'2021_12_06_110732_add_foreign_keys_to_customer_other_contacts_table',1),(22,'2021_12_06_110732_add_foreign_keys_to_customer_primary_contacts_table',1),(23,'2021_12_06_110732_add_foreign_keys_to_customer_secondary_contacts_table',1),(24,'2021_12_06_110732_add_foreign_keys_to_customer_sites_table',1),(25,'2021_12_06_111916_create_price_detail_table',1),(26,'2021_12_06_112726_create_add_price_by_spc',1),(27,'2021_12_06_113031_create_add_price_by_weight',1),(87,'2021_12_17_120014_create_jobs_table',2),(88,'2021_12_17_122200_create_job_senders_table',2),(89,'2021_12_17_123840_create_job_receivers_table',2),(90,'2021_12_17_124539_create_job_items_table',2),(91,'2021_12_17_130242_create_job_load_restraints_table',2),(92,'2021_12_17_134123_create_job_pallet_controls_table',2),(93,'2021_12_17_134502_create_job_total_prices_table',2),(94,'2021_12_22_123837_create_job_item_dg_details_table',2),(95,'2016_06_01_000001_create_oauth_auth_codes_table',3),(96,'2016_06_01_000002_create_oauth_access_tokens_table',3),(97,'2016_06_01_000003_create_oauth_refresh_tokens_table',3),(98,'2016_06_01_000004_create_oauth_clients_table',3),(99,'2016_06_01_000005_create_oauth_personal_access_clients_table',3),(100,'2021_12_29_091345_create_job_photos_table',4),(101,'2021_12_29_091506_create_job_notes_table',4),(102,'2022_01_03_071934_add_manifest_id_to_job_table',5),(107,'2022_01_05_094927_create_new_table_employees',6),(108,'2022_01_20_054532_add_soft_deletes_to_jobs_table',7),(109,'2022_09_30_062034_create_xero_tokens_table',8);

#
# Structure for table "password_resets"
#

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "password_resets"
#


#
# Structure for table "price_detail"
#

DROP TABLE IF EXISTS `price_detail`;
CREATE TABLE `price_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `price_id` bigint(20) unsigned NOT NULL,
  `item_type_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_for_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reversal_pricing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `price_by_weight` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT '[]',
  `price_by_spc` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT '[]',
  `price_by_weight_copy` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT '[]',
  `price_by_spc_copy` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT '[]',
  PRIMARY KEY (`id`),
  KEY `price_detail_price_id_foreign` (`price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=88678857 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "price_detail"
#

INSERT INTO `price_detail` VALUES (138,37,'1','7','12','3','No','2022-10-07 18:31:36','2022-10-07 18:31:36','[{\"from\":0,\"to\":23,\"cost\":23},{\"from\":24,\"to\":53,\"cost\":53},{\"from\":54,\"to\":57,\"cost\":23}]','[{\"from\":0,\"to\":23,\"cost\":23},{\"from\":24,\"to\":42,\"cost\":42}]','[]','[]'),(139,37,'2','12','13','3','No','2022-10-07 18:31:36','2022-10-07 18:31:36','[]','[]','[]','[]'),(140,38,'3','3','14','3','No','2022-10-07 18:32:18','2022-10-07 18:32:18','[{\"from\":0,\"to\":23,\"cost\":23}]','[{\"from\":0,\"to\":42,\"cost\":42}]','[]','[]'),(80367306,37,'2','21','2','32','Yes','2022-10-07 18:31:37','2022-10-07 18:31:37','[]','[]','[]','[]'),(85684546,37,'6','1','10','42','Yes','2022-10-07 18:31:37','2022-10-07 18:31:37','[]','[]','[]','[]'),(88678856,76131656,'4','9','16','','No','2022-10-07 19:29:34','2022-10-07 19:29:34','[]','[]','[]','[]');

#
# Structure for table "prices"
#

DROP TABLE IF EXISTS `prices`;
CREATE TABLE `prices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `con_fee` int(11) DEFAULT NULL,
  `delivery_fee` int(11) DEFAULT NULL,
  `fuel_levy` int(11) DEFAULT NULL,
  `futile_pickup_fee` int(11) DEFAULT NULL,
  `pickup_fee` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76131657 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "prices"
#

INSERT INTO `prices` VALUES (37,'Cahill Transport & Allied Pinnacle',11,42,2,3,4,2,'2022-01-14 12:06:01','2022-01-14 12:06:01'),(38,'Cahill Transport & Allied Pinnacle',4,23,2,2,3,3,'2022-02-08 15:06:15','2022-02-08 15:06:15'),(76131656,'aaaa',12,23,23,23,32,32,'2022-10-07 19:29:08','2022-10-07 19:29:08');

#
# Structure for table "settings"
#

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "settings"
#

INSERT INTO `settings` VALUES (1,'site_title','Wards Transport','2022-04-27 21:12:24','2022-04-27 21:12:24'),(2,'meta_keywords','Wards Transport','2022-04-27 21:12:24','2022-04-27 21:12:24'),(3,'meta_desc','Wards Transport','2022-04-27 21:12:24','2022-04-27 21:12:24'),(4,'favicon','1406925678WARDS TRNSPORT LOGO-01.png','2022-04-27 21:12:24','2022-04-27 21:12:24'),(5,'logo','1671312552WARDS TRNSPORT LOGO-01.png','2022-04-27 21:12:24','2022-04-27 21:12:24'),(6,'auth_page_heading','Wards Transport','2022-04-27 21:12:24','2022-04-27 21:12:24'),(7,'auth_logo','1006288630WARDS TRNSPORT LOGO-01.png','2022-04-27 21:12:24','2022-04-27 21:12:24'),(8,'auth_image','257230094WARDS TRNSPORT LOGO-01.png','2022-04-27 21:12:24','2022-04-27 21:12:24'),(9,'copy_right','Wards Transport','2022-04-27 21:12:24','2022-04-27 21:12:24');

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_show` int(11) DEFAULT 0,
  `primary_site` int(11) DEFAULT NULL,
  `primary_contact` int(11) DEFAULT NULL,
  `xero_access_token` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "users"
#

INSERT INTO `users` VALUES (57,'admin',NULL,'admin@domain.com',NULL,1,1,'$2y$13$kQoYHTqwWOgzAm/T/zRoUutXy6yD99awWRdhATpDVtgXB5JYkQlta',NULL,'2021-12-06 18:24:05','2022-10-23 02:57:42',' ',NULL,NULL,NULL,'{\"id_token\":\"eyJhbGciOiJSUzI1NiIsImtpZCI6IjFDQUY4RTY2NzcyRDZEQzAyOEQ2NzI2RkQwMjYxNTgxNTcwRUZDMTkiLCJ0eXAiOiJKV1QiLCJ4NXQiOiJISy1PWm5jdGJjQW8xbkp2MENZVmdWY09fQmsifQ.eyJuYmYiOjE2NjY0OTM4NjMsImV4cCI6MTY2NjQ5NDE2MywiaXNzIjoiaHR0cHM6Ly9pZGVudGl0eS54ZXJvLmNvbSIsImF1ZCI6IkE1MzVBODYyQzI1QzRDMTE5QjMxN0VFQjMzMzMzRkRCIiwiaWF0IjoxNjY2NDkzODYzLCJhdF9oYXNoIjoibXZRTzlyb3FQZkt5d3BMT2RRcVN1ZyIsInNfaGFzaCI6ImtJYW03TkxZNDVaUnFKU0R6cEdFS3ciLCJzaWQiOiJjMTgxMDcwMGNmM2E0ZTUyOTMzZDRkNTYzYzZlZmNlZSIsInN1YiI6ImVjMTA3MDdmMmZhYzVhYWJiNDdhM2M1YjU1NzVjZjAxIiwiYXV0aF90aW1lIjoxNjY2NDg3Mzg2LCJ4ZXJvX3VzZXJpZCI6Ijk5YmQxODNmLTQyOTUtNGZjZi1iZDBlLWUzNmM3NDIyMGM4NyIsImdsb2JhbF9zZXNzaW9uX2lkIjoiYzE4MTA3MDBjZjNhNGU1MjkzM2Q0ZDU2M2M2ZWZjZWUiLCJwcmVmZXJyZWRfdXNlcm5hbWUiOiJ2bGFkdGFyYXNvdjIwMjAzQGdtYWlsLmNvbSIsImVtYWlsIjoidmxhZHRhcmFzb3YyMDIwM0BnbWFpbC5jb20iLCJnaXZlbl9uYW1lIjoidmxhZCIsImZhbWlseV9uYW1lIjoidGFyYXNvdiIsIm5hbWUiOiJ2bGFkIHRhcmFzb3YiLCJhbXIiOlsic3NvIl19.Np6EP37kXyJyUWNFW5NawwGk7D9d810X46WADfZV6WQC1C8Pe2-BmwalRgSYYUZyZLq9793LO1T4M4iP3hzUr-DnMmAHY_Vp-f4o1W-Uy0ixakiH9xy8ZMJcOrGVO3u38emyXUe8gCnq6t0gZEeRGpn6P8vBDSAR5mZNDUq5lTheFw26avhhsJU4u8T2vz5nMpUDR6zsxrdxtA-m7HKoHEWhI8NAIakzJE8V9PolXWNbcuGCNCt4g-kxOxhHcZoTezpYkXeEwxENpSP5cveICfNXNen2OQvmtNJ7h-S_JL_8og4Sd9pC5yboUIdDkDjlRv5ztJ0B4BbAJirAyt-llA\",\"token_type\":\"Bearer\",\"scope\":\"openid email profile accounting.settings accounting.transactions accounting.contacts offline_access\",\"access_token\":\"eyJhbGciOiJSUzI1NiIsImtpZCI6IjFDQUY4RTY2NzcyRDZEQzAyOEQ2NzI2RkQwMjYxNTgxNTcwRUZDMTkiLCJ0eXAiOiJKV1QiLCJ4NXQiOiJISy1PWm5jdGJjQW8xbkp2MENZVmdWY09fQmsifQ.eyJuYmYiOjE2NjY0OTM4NjMsImV4cCI6MTY2NjQ5NTY2MywiaXNzIjoiaHR0cHM6Ly9pZGVudGl0eS54ZXJvLmNvbSIsImF1ZCI6Imh0dHBzOi8vaWRlbnRpdHkueGVyby5jb20vcmVzb3VyY2VzIiwiY2xpZW50X2lkIjoiQTUzNUE4NjJDMjVDNEMxMTlCMzE3RUVCMzMzMzNGREIiLCJzdWIiOiJlYzEwNzA3ZjJmYWM1YWFiYjQ3YTNjNWI1NTc1Y2YwMSIsImF1dGhfdGltZSI6MTY2NjQ4NzM4NiwieGVyb191c2VyaWQiOiI5OWJkMTgzZi00Mjk1LTRmY2YtYmQwZS1lMzZjNzQyMjBjODciLCJnbG9iYWxfc2Vzc2lvbl9pZCI6ImMxODEwNzAwY2YzYTRlNTI5MzNkNGQ1NjNjNmVmY2VlIiwianRpIjoiMDAxMDQ3Qjc3ODhEMTI3MzA3N0Y1ODA5MEMxQ0Y5MzgiLCJhdXRoZW50aWNhdGlvbl9ldmVudF9pZCI6ImM4YWY2YWY4LTBlZWMtNDgwYS05MWZiLWQ0YThjMDcwNTI1ZSIsInNjb3BlIjpbImVtYWlsIiwicHJvZmlsZSIsIm9wZW5pZCIsImFjY291bnRpbmcuc2V0dGluZ3MiLCJhY2NvdW50aW5nLnRyYW5zYWN0aW9ucyIsImFjY291bnRpbmcuY29udGFjdHMiLCJvZmZsaW5lX2FjY2VzcyJdLCJhbXIiOlsic3NvIl19.aLBE7QDLBqR6AeZHvamXMsXjbsVqBAwMmDOujgaxoUh8xeG6dBL9l75_dMmWCgwhlhZDvLTTxIfHEd6aBv0aRZjs5fURrPfgkj1JCs5fubbSC1U2JWqxlYUzaJ5AO7Nntb0z3uILGJJLAQ2XlgHgfiHXsTeV99Uj87x1HWHm6GB_-k0YqRGJszYAEL9eYLkzRFLZhh6mNyS7tfCobvdLU4Rl7S7ig3GtRo0vzMD8aW-ya-f6L-g6WGpZAAdvCumRqPgQPEmRZLqwVth8D6aNon09gY-uSbE_ouuk-33lT_wSlMAxZIx84Sr9K0byAJLrLuCNrtzFYgUUQmpom3Urcg\",\"refresh_token\":\"8g7FG_ChhjknCD9remhKfHiSKCY2fK8OujbvqiiNH9U\",\"expires\":1666495661}','6532b8a8-22cc-4f1e-88d5-9aa91adcc291'),(101,'ZZ_Davichi_Test',NULL,NULL,NULL,0,1,NULL,NULL,'2022-04-26 11:03:13','2022-10-15 16:42:26','37',1,NULL,NULL,NULL,NULL),(102,'ZZ_Beryl Ward_Test',NULL,NULL,NULL,0,0,NULL,NULL,'2022-04-27 21:30:06','2022-10-15 18:47:20','37',1,NULL,NULL,NULL,NULL),(103,'ZZ_Ashley Ward_Test111',NULL,NULL,NULL,0,1,NULL,NULL,'2022-04-27 21:31:25','2022-10-15 18:47:02','37',1,35,2,NULL,NULL),(104,'Ashley Ward','0427221035',NULL,NULL,2,1,'$2y$10$ydn0blHsJv8Z3PbhdxTBfOygyXxk3miC5RYHThaMFlXc9KIhbua02',NULL,'2022-04-30 10:42:28','2022-04-30 10:42:28',NULL,0,NULL,NULL,NULL,NULL),(105,'driver1','123123123',NULL,NULL,2,1,'$2y$10$7pthfSFYdknGCjD7iGNmCe4yeIS1qt7oflYXucGamcIErLLJJQ5hq',NULL,'2022-04-30 13:35:25','2022-04-30 13:35:25',NULL,0,NULL,NULL,NULL,NULL),(106,'driver2','Daugavpils',NULL,NULL,2,1,'$2y$10$bOaybmOzLe6iFCB5cTmvl.jbsSeRj79o/cKeFLh7kXrOv7nhtv3uu',NULL,'2022-04-30 13:38:53','2022-04-30 13:38:53',NULL,0,NULL,NULL,NULL,NULL),(107,'ZZ_Ron_Test',NULL,NULL,NULL,0,1,NULL,NULL,'2022-05-08 11:12:43','2022-06-29 01:59:31','39',1,NULL,NULL,NULL,NULL),(151,'Ashleigh Duncan',NULL,'ashley@awardservices.com.au',NULL,0,1,NULL,NULL,'2022-10-19 17:55:48','2022-10-19 18:02:06','38',1,60,25,NULL,NULL),(152,'Cash Sales',NULL,'ashley@awardservices.com.au',NULL,0,1,NULL,NULL,'2022-10-19 17:55:48','2022-10-19 17:55:48',NULL,1,NULL,NULL,NULL,NULL),(155,'AA Company',NULL,'ashley@awardservices.com.au',NULL,0,1,NULL,NULL,'2022-10-23 02:01:33','2022-10-23 02:01:33',NULL,1,NULL,NULL,NULL,NULL);

#
# Structure for table "customer_primary_contacts"
#

DROP TABLE IF EXISTS `customer_primary_contacts`;
CREATE TABLE `customer_primary_contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_primary_contacts_customer_id_foreign` (`customer_id`),
  CONSTRAINT `customer_primary_contacts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "customer_primary_contacts"
#

INSERT INTO `customer_primary_contacts` VALUES (16,101,'Davichi',NULL,NULL,NULL,NULL,'ashley.ward@davichi.com.au','2022-04-26 11:03:13','2022-04-26 11:03:13'),(17,102,'Beryl Ward',NULL,NULL,NULL,NULL,'beryl.ward@wardstransport.com.au','2022-04-27 21:30:06','2022-04-27 21:30:06'),(18,103,'Ashley Ward',NULL,NULL,NULL,NULL,'ashley.ward@wardstransport.com.au','2022-04-27 21:31:25','2022-04-27 21:31:25'),(19,107,'Ron Ward',NULL,NULL,NULL,NULL,'ron.ward@wardsgroup.com.au','2022-05-08 11:12:43','2022-05-08 11:12:43');
