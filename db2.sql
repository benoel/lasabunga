/*
SQLyog Ultimate v10.42 
MySQL - 5.5.5-10.1.21-MariaDB : Database - lasabunga
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lasabunga` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `content_picture` */

DROP TABLE IF EXISTS `content_picture`;

CREATE TABLE `content_picture` (
  `content_picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) DEFAULT NULL,
  `content_body` varchar(255) DEFAULT NULL,
  `user_record` varchar(255) DEFAULT NULL,
  `my_website` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`content_picture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `content_picture` */

LOCK TABLES `content_picture` WRITE;

UNLOCK TABLES;

/*Table structure for table `departement` */

DROP TABLE IF EXISTS `departement`;

CREATE TABLE `departement` (
  `departement_id` int(11) NOT NULL AUTO_INCREMENT,
  `departement_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`departement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `departement` */

LOCK TABLES `departement` WRITE;

UNLOCK TABLES;

/*Table structure for table `material_category` */

DROP TABLE IF EXISTS `material_category`;

CREATE TABLE `material_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `photo` text,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `material_category` */

LOCK TABLES `material_category` WRITE;

insert  into `material_category`(`category_id`,`category_name`,`photo`) values (1,'indoor','upload/0_LASABUNGA_INTERIOR_SUPER_04_(watermarked)3.jpg'),(2,'outdoor',NULL),(3,'decking',NULL);

UNLOCK TABLES;

/*Table structure for table `material_content` */

DROP TABLE IF EXISTS `material_content`;

CREATE TABLE `material_content` (
  `material_content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`material_content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `material_content` */

LOCK TABLES `material_content` WRITE;

insert  into `material_content`(`material_content_id`,`content`) values (1,'Berikut daftar material untuk kebbutuhan anda');

UNLOCK TABLES;

/*Table structure for table `material_detail` */

DROP TABLE IF EXISTS `material_detail`;

CREATE TABLE `material_detail` (
  `material_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_name` varchar(255) DEFAULT NULL,
  `material_subject` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `material_desc` text,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`material_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `material_detail` */

LOCK TABLES `material_detail` WRITE;

insert  into `material_detail`(`material_detail_id`,`material_name`,`material_subject`,`photo`,`material_desc`,`category_id`) values (1,'Lantai Kayu Merbau','Merbau Solid','assets/welcome/img/merbau-solid-standard.jpg','Ukuran Standard : 1.5 cm x 9 cm x 30 - 90 cm (int 50mm, panjang acak)',1),(2,'Lantai kayu Jati','Jati Solid','assets/welcome/img/Jati-Solid-Unijoint.jpg','Ukuran Standard : 1.5 cm x 9 cm x 30 - 90 cm (int 50mm, panjang acak)',1),(3,'Jati Solid Jumbo','Jati Solid Jumbo','assets/welcome/img/Jati-Solid-Jumbo.jpg','Ukuran product : 1.5 cm x 9 cm x 120 cm (int 50mm, panjang acak)\r\nFinishing : UV coating warna natural\r\nKualitas : Grade A (standart & better)\r\nHarga : M2\r\n\r\n',2),(4,'Papan Trap Tangga','Papan Trap Tangga Merbau FJL','assets/welcome/img/trap-tangga-merbau-fjl.jpg','Ukuran : 3cm x 32cm x 110cm\r\nFinishing : UV coating warna natural (coating on face&sealer on back)\r\nKualitas : Grade A (standart & better)\r\nHarga : PCS',2),(5,'Papan Bordes Tangga','Bordes Tangga Merbau FJL','assets/welcome/img/trap-tangga-merbau-fjll.jpg','Ukuran : 3cm x 32cm x 110cm\r\nFinishing : UV coating warna natural (coating on face&sealer on back)\r\nKualitas  : Grade A (standart & better)\r\nHarga : M2',3),(6,'Papan Trap Tangga Sonokeling FJL','Papan Trap Tangga Sonokeling FJL','assets/welcome/img/trap-tangga-sonokeling-fjl.jpg','Ukuran : 3cm x 32cm x 110cm\r\nFinishing : UV coating warna natural (coating on face&sealer on back)\r\nKualitas : Grade A (standart & better)\r\nHarga : PCS',1),(7,'Bordes Tangga Sonokeling FJL','Bordes Tangga Sonokeling FJL','assets/welcome/img/trap-tangga-sonokeling-fjll.jpg','Ukuran : 3cm x 32cm x 110cm\r\nFinishing : UV coating warna natural (coating on face&sealer on back)\r\nKualitas : Grade A (standart & better)\r\nHarga : M2',1);

UNLOCK TABLES;

/*Table structure for table `material_full_category` */

DROP TABLE IF EXISTS `material_full_category`;

CREATE TABLE `material_full_category` (
  `id_material_full_category` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_material_full_category`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `material_full_category` */

LOCK TABLES `material_full_category` WRITE;

insert  into `material_full_category`(`id_material_full_category`,`category_id`,`sub_category_id`,`material_id`,`user_id`) values (1,1,1,1,1);

UNLOCK TABLES;

/*Table structure for table `material_sub_category` */

DROP TABLE IF EXISTS `material_sub_category`;

CREATE TABLE `material_sub_category` (
  `material_sub_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_sub_category_name` varchar(255) DEFAULT NULL,
  `photo` text,
  PRIMARY KEY (`material_sub_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `material_sub_category` */

LOCK TABLES `material_sub_category` WRITE;

insert  into `material_sub_category`(`material_sub_category_id`,`material_sub_category_name`,`photo`) values (1,'kamar tidur',NULL);

UNLOCK TABLES;

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) DEFAULT NULL,
  `menu_url` text,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

LOCK TABLES `menu` WRITE;

insert  into `menu`(`menu_id`,`menu_name`,`menu_url`) values (1,'Dashboard','ctr_admin'),(2,'Barang','ctr_admin/barang'),(3,'Kategori','ctr_admin/category'),(4,'About','ctr_admin/about'),(5,'Sub Kategori','ctr_admin/sub_category'),(6,'Project','ctr_admin/project');

UNLOCK TABLES;

/*Table structure for table `message` */

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) DEFAULT NULL,
  `client_email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message_body` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `message` */

LOCK TABLES `message` WRITE;

UNLOCK TABLES;

/*Table structure for table `order_material` */

DROP TABLE IF EXISTS `order_material`;

CREATE TABLE `order_material` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `material_detail_id` int(11) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `order_material` */

LOCK TABLES `order_material` WRITE;

insert  into `order_material`(`order_id`,`subject`,`email`,`material_detail_id`,`message`,`name`,`phone`) values (1,'saya ingin','rodhiyanto@icloud.com',3,'tolong hubungi saya','asdsdas',2147483647),(2,'pesan sekarang','rodhiyanto@icloud.com',6,'mohon kirimkan barang yang saya pesan','rodhiyanto',2147483647),(3,'pesan sekarang','rodhiyanto@icloud.com',3,'mohon kirimkan barang yang saya pesan','rodhiyanto',2147483647),(4,'pesan merbau floor','rodhiyanto@icloud.com',2,'Hubungi saya ','rodhiyanto',2147483647);

UNLOCK TABLES;

/*Table structure for table `our_company_content` */

DROP TABLE IF EXISTS `our_company_content`;

CREATE TABLE `our_company_content` (
  `our_company_content_id` int(11) NOT NULL AUTO_INCREMENT,
  `body_content` varchar(1000) DEFAULT NULL,
  `subject_content` varchar(255) DEFAULT NULL,
  `opening_content` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`our_company_content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `our_company_content` */

LOCK TABLES `our_company_content` WRITE;

insert  into `our_company_content`(`our_company_content_id`,`body_content`,`subject_content`,`opening_content`) values (1,'PT. LASABUNGA adalah suatu perusahaan industri kayu olahan untuk lantai kayu flooring, decking, wall panel dan papan trap tangga dan jasa perusahaan khusus yang kami buat yang berfungsi secara pribadi membantu perencanaan dan supervisi dalam membangun suatu bangunan yang indah terutama lantai kayu sesuai dengan budget yang anda miliki. ','Terima kasih anda telah mengunjungi website lantai kayu PT. LASABUNGA.','Ini adalah website official kami yang selanjutnya akan memberikan berbagai macam informasi terkait dengan kegiatan yang biasanya kami lakukan. Info lebih lengkap hubungi HOTLINE dan Info Email kami.');

UNLOCK TABLES;

/*Table structure for table `our_company_point` */

DROP TABLE IF EXISTS `our_company_point`;

CREATE TABLE `our_company_point` (
  `our_company_point_id` int(11) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `our_company_point` */

LOCK TABLES `our_company_point` WRITE;

insert  into `our_company_point`(`our_company_point_id`,`content`) values (1,'Lantai Senam'),(2,'Lantai Kamar Tidur'),(3,'Lantai Kantor'),(4,'Lantai Gedung'),(5,'Lantai Kolam Renang'),(6,'Lantai Seminar'),(7,'Lantai Kamar Hotel'),(8,'Lantai Gym'),(9,'Lantai Kantor');

UNLOCK TABLES;

/*Table structure for table `our_company_slider` */

DROP TABLE IF EXISTS `our_company_slider`;

CREATE TABLE `our_company_slider` (
  `our_company_slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) DEFAULT NULL,
  `numer` int(11) DEFAULT NULL,
  PRIMARY KEY (`our_company_slider_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `our_company_slider` */

LOCK TABLES `our_company_slider` WRITE;

insert  into `our_company_slider`(`our_company_slider_id`,`filename`,`numer`) values (1,'asset/welcome/img/prods3.jpg',1),(2,'asset/welcome/img/prods1.jpg',2),(3,'asset/welcome/img/prods2.jpg',3);

UNLOCK TABLES;

/*Table structure for table `our_service_content` */

DROP TABLE IF EXISTS `our_service_content`;

CREATE TABLE `our_service_content` (
  `our_service_content_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`our_service_content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `our_service_content` */

LOCK TABLES `our_service_content` WRITE;

insert  into `our_service_content`(`our_service_content_id`,`subject`) values (1,'Kami dapat memanjakan anda selama 24jam x 7 hari, Untuk anda ');

UNLOCK TABLES;

/*Table structure for table `our_service_point` */

DROP TABLE IF EXISTS `our_service_point`;

CREATE TABLE `our_service_point` (
  `our_service_point_id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`our_service_point_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `our_service_point` */

LOCK TABLES `our_service_point` WRITE;

insert  into `our_service_point`(`our_service_point_id`,`icon`,`content`,`subject`) values (1,'fa fa-cog','Pemasang dilakukan pada akhir tahap pembangunan rumah Anda. Pastikan suhu ruangan terjaga di 22-30oC pada saat pemasangan dan selama minimal 1 minggu sebelumnya. Plesteran harus rata dengan umur minimal 2 minggu, hasil concrete test tidak boleh lebih dari','Pemasangan'),(2,'fa fa-dropbox','Siap Digunakan dan Dipasang, anda hanya perlu menghubungi kami dan berikan kami catatan untuk mendesign ruangan yang akan anda percantik','Siap Digunakan'),(3,'fa fa-github-alt','Kami siap pemasangan dalam waktu 24 x 7 jam, untuk memberikan pelayanan terbaik kami untuk anda','Siap Selalu'),(4,'fa fa-gears','Dalam waktu musim Hujan kelembaban dalam ruangan dapat naik hingga 90%. Kayu dapat menyerap kelembaban dari udara, dan karena itu, mengembang yang dapat menyebabkan cupping. Untuk mencegah cupping gunakanlah AC atau dehumidifier dikala musim hujan yang le','Perawatan'),(5,'fa fa-shopping-cart','Taruhlah foam ke seluruh permukaan lantai, isolasi sambungan foam tersebut.Susunlah kayu flooring sebelum benar benar di pasang / dibeber.Tentukanlah terlebih dahulu garis awal pemasangan, gunakanlah benang untuk menetukan garis awal pemasangan. Berikanla','Barang Apik'),(6,'fa fa-rocket','Pengiriman pemasanan anda gratis untuk wilayah jakarta selatan dan barat','Pengiriman');

UNLOCK TABLES;

/*Table structure for table `our_team_content` */

DROP TABLE IF EXISTS `our_team_content`;

CREATE TABLE `our_team_content` (
  `our_team_content_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`our_team_content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `our_team_content` */

LOCK TABLES `our_team_content` WRITE;

insert  into `our_team_content`(`our_team_content_id`,`subject`) values (1,'Perkenalkan team kami yang sangat berbakat');

UNLOCK TABLES;

/*Table structure for table `our_team_profile` */

DROP TABLE IF EXISTS `our_team_profile`;

CREATE TABLE `our_team_profile` (
  `our_team_profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) DEFAULT NULL,
  `jobs` varchar(255) DEFAULT NULL,
  `information` varchar(255) DEFAULT NULL,
  `display` int(11) DEFAULT NULL,
  `foto` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`our_team_profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `our_team_profile` */

LOCK TABLES `our_team_profile` WRITE;

insert  into `our_team_profile`(`our_team_profile_id`,`fullname`,`jobs`,`information`,`display`,`foto`) values (1,'Taufik Qomarudin','Design','Halo saya taufik, saya pekerja dari PT. Lasabunga dan saya senang berkerja diperusahaan ini, skill saya adalah design',1,'asset/welcome/img/members3.jpg'),(2,'Rodhiyanto','Developer','Halo guys, Saya Rodhi, Skill saya adalah membuat lantai kayu semanis mungkin untuk anda',1,'asset/welcome/img/members2.jpg'),(3,'Windy','Developer','Halo, saya Windy , saya berkerja di PT. Lasabunga sebagai developer',1,'asset/welcome/img/members1.jpg'),(4,'Agus','Tata Kelola','Hai Agus, profesi saya sebagai tata kelola di PT.Lasabunga',1,'asset/welcome/img/members2.jpg'),(5,'Ingga Amelia','Accounting','Hey, Saya ingga, saya adalah accounting staff pada PT. Lasabunga',1,'asset/welcome/img/members1.jpg'),(6,'Ibnu Abdul','Design','Halo bro, saya ibnu saya designer pada PT. Lasabunga dan saya cukup berpengalaman dalam bidang ini',1,'asset/welcome/img/members2.jpg');

UNLOCK TABLES;

/*Table structure for table `portfolio_category` */

DROP TABLE IF EXISTS `portfolio_category`;

CREATE TABLE `portfolio_category` (
  `portfolio_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`portfolio_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `portfolio_category` */

LOCK TABLES `portfolio_category` WRITE;

insert  into `portfolio_category`(`portfolio_category_id`,`category_name`) values (1,'hotel'),(2,'rumah'),(3,'kantor'),(4,'aula');

UNLOCK TABLES;

/*Table structure for table `portfolio_content` */

DROP TABLE IF EXISTS `portfolio_content`;

CREATE TABLE `portfolio_content` (
  `portfolio_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`portfolio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='ontent';

/*Data for the table `portfolio_content` */

LOCK TABLES `portfolio_content` WRITE;

insert  into `portfolio_content`(`portfolio_id`,`content`) values (1,'Lembar kerja yang kami banggakan');

UNLOCK TABLES;

/*Table structure for table `portfolio_picture` */

DROP TABLE IF EXISTS `portfolio_picture`;

CREATE TABLE `portfolio_picture` (
  `portfolio_picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `portfolio_name` varchar(255) DEFAULT NULL,
  `portfolio_filename` varchar(255) DEFAULT NULL,
  `portfolio_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`portfolio_picture_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `portfolio_picture` */

LOCK TABLES `portfolio_picture` WRITE;

insert  into `portfolio_picture`(`portfolio_picture_id`,`portfolio_name`,`portfolio_filename`,`portfolio_category_id`) values (1,'rumah kemang','asset/welcome/img/ubin-1.jpg',2),(2,'rumah petojo','asset/welcome/img/ubin-2.jpg',2),(3,'rumah permata hijau','asset/welcome/img/ubin-3.jpg',2),(4,'aula karoke permata','asset/welcome/img/prods1.jpg',4),(5,'aula renang','asset/welcome/img/prods3.jpg',4),(6,'kantor itc','asset/welcome/img/prods4.jpg',3),(7,'kantor mampang','asset/welcome/img/prods5.jpg',3),(8,'hotel bali','asset/welcome/img/prods6.jpg',1);

UNLOCK TABLES;

/*Table structure for table `project` */

DROP TABLE IF EXISTS `project`;

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) DEFAULT NULL,
  `photo` text,
  `subject` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `deskripsi` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `project` */

LOCK TABLES `project` WRITE;

insert  into `project`(`project_id`,`project_name`,`photo`,`subject`,`category_id`,`sub_category_id`,`deskripsi`) values (1,'Pembuatan Kamar Tidur Hotel Indonesiaa','upload/0_LASABUNGA_INTERIOR_SUPER_02_(watermarked)4.jpg','saa',1,1,'asdasda');

UNLOCK TABLES;

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `role` */

LOCK TABLES `role` WRITE;

insert  into `role`(`id_role`,`role_name`) values (1,'master');

UNLOCK TABLES;

/*Table structure for table `role_menu` */

DROP TABLE IF EXISTS `role_menu`;

CREATE TABLE `role_menu` (
  `id_role_menu` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_role_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `role_menu` */

LOCK TABLES `role_menu` WRITE;

insert  into `role_menu`(`id_role_menu`,`role_id`,`menu_id`) values (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5),(6,1,6);

UNLOCK TABLES;

/*Table structure for table `slider_big` */

DROP TABLE IF EXISTS `slider_big`;

CREATE TABLE `slider_big` (
  `slider_big_id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`slider_big_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `slider_big` */

LOCK TABLES `slider_big` WRITE;

insert  into `slider_big`(`slider_big_id`,`filename`,`number`,`subject`,`content`) values (1,'asset/welcome/img/ubin-1.jpg',1,'Lantai Kamar Yang Manis & Menawan','Lantai kayu terpasang dengan rapih dan bahan yang berkualitas'),(2,'asset/welcome/img/ubin-2.jpg',2,'Lantai kayu untuk pemanis kamar anda','Lantai kami mempunyai kualitas terbaik untuk membuat kamar anda terasa nyaman'),(3,'asset/welcome/img/ubin-3.jpg',3,'Lantai Perhotelan Elegan','Lantai kayu pada kamar hotel yang kami design dengan sedemikian rapih dan elegan');

UNLOCK TABLES;

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `dbo` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `profilepicture` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

LOCK TABLES `user` WRITE;

insert  into `user`(`user_id`,`name`,`password`,`dbo`,`email`,`mobile`,`website`,`profilepicture`) values (1,'rodhiyanto','905bf09128376a513c5f7d792d893665','1992-11-20','rodhiyanto@icloud.com','081519644610',NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id_user_role` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user_role`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user_role` */

LOCK TABLES `user_role` WRITE;

insert  into `user_role`(`id_user_role`,`user_id`,`role_id`) values (1,1,1);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
