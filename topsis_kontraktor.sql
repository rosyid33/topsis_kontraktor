/*
SQLyog Ultimate v12.4.0 (64 bit)
MySQL - 10.1.16-MariaDB : Database - topsis_kontraktor
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`topsis_kontraktor` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `topsis_kontraktor`;

/*Table structure for table `kontraktor` */

DROP TABLE IF EXISTS `kontraktor`;

CREATE TABLE `kontraktor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kontraktor` varchar(200) DEFAULT NULL,
  `alamat` text,
  `telepon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `kontraktor` */

insert  into `kontraktor`(`id`,`nama_kontraktor`,`alamat`,`telepon`) values 
(1,'PCS','',''),
(2,'Swadaya Graha','',''),
(3,'Mustika Zidane Karya','',''),
(4,'Sasmito','','');

/*Table structure for table `kriteria` */

DROP TABLE IF EXISTS `kriteria`;

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria_code` varchar(10) DEFAULT NULL,
  `kriteria_nama` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `kriteria` */

insert  into `kriteria`(`id`,`kriteria_code`,`kriteria_nama`) values 
(1,'A1','Laporan keuangan tahunan'),
(2,'A2','Struktur Organisasi'),
(3,'A3','Surat Pernyataan'),
(4,'A4','Rencana waktu pelaksanaan'),
(5,'A5','Sertifikat Badan Usaha Jasa'),
(6,'A6','Dokumen Perusahaan'),
(7,'A7','Daftar Pengalaman'),
(8,'A8','Beban kerja saat ini'),
(9,'A9','Pemberian pekerjaan'),
(10,'A10','Contractor Safety Management System'),
(11,'A11','Perijinan'),
(12,'A12','Tenaga Kerja'),
(13,'A13','Pekerjaan Persiapan'),
(14,'A14','Pekerjaan Pembuatan Tanggul Reklamasi A'),
(15,'A15','Pekerjaan Pengisian Area Reklamasi'),
(16,'A16','Pekerjaan Sumur Perkolasi'),
(17,'A17','Pekerjaan Lain-lain'),
(18,'A18','Metode Kerja'),
(19,'A19','Penawaran Harga');

/*Table structure for table `kriteria_proyek` */

DROP TABLE IF EXISTS `kriteria_proyek`;

CREATE TABLE `kriteria_proyek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyek_id` int(11) DEFAULT NULL,
  `kriteria_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `kriteria_proyek` */

insert  into `kriteria_proyek`(`id`,`proyek_id`,`kriteria_id`) values 
(3,5,3),
(4,5,4),
(5,5,5),
(6,5,6),
(7,5,7),
(8,5,8),
(9,5,9),
(10,5,10),
(11,5,11),
(12,5,12),
(13,5,13),
(14,5,14),
(15,5,15),
(16,5,16),
(17,5,17),
(18,5,18),
(19,5,19),
(20,5,1),
(21,5,2);

/*Table structure for table `nilai_kriteria` */

DROP TABLE IF EXISTS `nilai_kriteria`;

CREATE TABLE `nilai_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyek_id` int(11) DEFAULT NULL,
  `kontraktor_id` int(11) DEFAULT NULL,
  `sub_kriteria_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=273 DEFAULT CHARSET=latin1;

/*Data for the table `nilai_kriteria` */

insert  into `nilai_kriteria`(`id`,`proyek_id`,`kontraktor_id`,`sub_kriteria_id`,`nilai`) values 
(1,5,1,1,2),
(2,5,1,2,2),
(3,5,1,3,3),
(4,5,1,4,3),
(5,5,1,5,3),
(6,5,1,6,3),
(7,5,1,7,2),
(8,5,1,8,3),
(9,5,1,9,3),
(10,5,1,10,3),
(11,5,1,11,3),
(12,5,1,12,3),
(13,5,1,13,3),
(14,5,1,14,3),
(15,5,1,15,3),
(16,5,1,16,3),
(17,5,1,17,3),
(18,5,1,18,3),
(19,5,1,19,3),
(20,5,1,20,3),
(21,5,1,21,3),
(22,5,1,22,3),
(23,5,1,23,3),
(24,5,1,24,3),
(25,5,1,25,3),
(26,5,1,26,3),
(27,5,1,27,3),
(28,5,1,28,3),
(29,5,1,29,3),
(30,5,1,30,3),
(31,5,1,31,3),
(32,5,1,32,3),
(33,5,1,33,3),
(34,5,1,34,3),
(35,5,1,35,3),
(36,5,1,36,3),
(37,5,1,37,3),
(38,5,1,38,3),
(39,5,1,39,3),
(40,5,1,40,3),
(41,5,1,41,3),
(42,5,1,42,3),
(43,5,1,43,3),
(44,5,1,44,3),
(45,5,1,45,3),
(46,5,1,46,3),
(47,5,1,47,3),
(48,5,1,48,3),
(49,5,1,49,3),
(50,5,1,50,3),
(51,5,1,51,3),
(52,5,1,52,3),
(53,5,1,53,3),
(54,5,1,54,3),
(55,5,1,55,3),
(56,5,1,56,3),
(57,5,1,57,3),
(58,5,1,58,3),
(59,5,1,59,3),
(60,5,1,60,3),
(61,5,1,61,3),
(62,5,1,62,3),
(63,5,1,63,3),
(64,5,1,64,0),
(65,5,1,65,0),
(66,5,1,66,0),
(67,5,1,67,0),
(68,5,1,68,3),
(69,5,2,1,2),
(70,5,2,2,3),
(71,5,2,3,3),
(72,5,2,4,3),
(73,5,2,5,3),
(74,5,2,6,3),
(75,5,2,7,3),
(76,5,2,8,3),
(77,5,2,9,3),
(78,5,2,10,3),
(79,5,2,11,3),
(80,5,2,12,3),
(81,5,2,13,3),
(82,5,2,14,3),
(83,5,2,15,3),
(84,5,2,16,3),
(85,5,2,17,3),
(86,5,2,18,3),
(87,5,2,19,3),
(88,5,2,20,3),
(89,5,2,21,3),
(90,5,2,22,3),
(91,5,2,23,3),
(92,5,2,24,3),
(93,5,2,25,3),
(94,5,2,26,3),
(95,5,2,27,3),
(96,5,2,28,3),
(97,5,2,29,3),
(98,5,2,30,3),
(99,5,2,31,3),
(100,5,2,32,3),
(101,5,2,33,3),
(102,5,2,34,3),
(103,5,2,35,3),
(104,5,2,36,3),
(105,5,2,37,3),
(106,5,2,38,3),
(107,5,2,39,3),
(108,5,2,40,3),
(109,5,2,41,3),
(110,5,2,42,3),
(111,5,2,43,3),
(112,5,2,44,3),
(113,5,2,45,3),
(114,5,2,46,3),
(115,5,2,47,3),
(116,5,2,48,3),
(117,5,2,49,3),
(118,5,2,50,3),
(119,5,2,51,3),
(120,5,2,52,3),
(121,5,2,53,3),
(122,5,2,54,3),
(123,5,2,55,3),
(124,5,2,56,3),
(125,5,2,57,3),
(126,5,2,58,3),
(127,5,2,59,3),
(128,5,2,60,3),
(129,5,2,61,3),
(130,5,2,62,3),
(131,5,2,63,3),
(132,5,2,64,3),
(133,5,2,65,0),
(134,5,2,66,3),
(135,5,2,67,3),
(136,5,2,68,1),
(137,5,3,1,3),
(138,5,3,2,3),
(139,5,3,3,2),
(140,5,3,4,3),
(141,5,3,5,3),
(142,5,3,6,3),
(143,5,3,7,3),
(144,5,3,8,3),
(145,5,3,9,3),
(146,5,3,10,3),
(147,5,3,11,3),
(148,5,3,12,3),
(149,5,3,13,3),
(150,5,3,14,3),
(151,5,3,15,3),
(152,5,3,16,3),
(153,5,3,17,3),
(154,5,3,18,3),
(155,5,3,19,3),
(156,5,3,20,3),
(157,5,3,21,3),
(158,5,3,22,3),
(159,5,3,23,3),
(160,5,3,24,2),
(161,5,3,25,3),
(162,5,3,26,3),
(163,5,3,27,2),
(164,5,3,28,3),
(165,5,3,29,3),
(166,5,3,30,3),
(167,5,3,31,3),
(168,5,3,32,3),
(169,5,3,33,3),
(170,5,3,34,3),
(171,5,3,35,3),
(172,5,3,36,3),
(173,5,3,37,3),
(174,5,3,38,3),
(175,5,3,39,3),
(176,5,3,40,3),
(177,5,3,41,3),
(178,5,3,42,3),
(179,5,3,43,3),
(180,5,3,44,3),
(181,5,3,45,3),
(182,5,3,46,3),
(183,5,3,47,3),
(184,5,3,48,3),
(185,5,3,49,3),
(186,5,3,50,3),
(187,5,3,51,3),
(188,5,3,52,3),
(189,5,3,53,3),
(190,5,3,54,3),
(191,5,3,55,3),
(192,5,3,56,3),
(193,5,3,57,3),
(194,5,3,58,3),
(195,5,3,59,3),
(196,5,3,60,3),
(197,5,3,61,3),
(198,5,3,62,3),
(199,5,3,63,3),
(200,5,3,64,3),
(201,5,3,65,3),
(202,5,3,66,3),
(203,5,3,67,3),
(204,5,3,68,1),
(205,5,4,1,3),
(206,5,4,2,3),
(207,5,4,3,2),
(208,5,4,4,2),
(209,5,4,5,3),
(210,5,4,6,3),
(211,5,4,7,3),
(212,5,4,8,3),
(213,5,4,9,3),
(214,5,4,10,3),
(215,5,4,11,3),
(216,5,4,12,3),
(217,5,4,13,2),
(218,5,4,14,3),
(219,5,4,15,3),
(220,5,4,16,3),
(221,5,4,17,3),
(222,5,4,18,3),
(223,5,4,19,3),
(224,5,4,20,3),
(225,5,4,21,3),
(226,5,4,22,3),
(227,5,4,23,3),
(228,5,4,24,3),
(229,5,4,25,3),
(230,5,4,26,3),
(231,5,4,27,2),
(232,5,4,28,3),
(233,5,4,29,3),
(234,5,4,30,3),
(235,5,4,31,3),
(236,5,4,32,3),
(237,5,4,33,3),
(238,5,4,34,3),
(239,5,4,35,3),
(240,5,4,36,3),
(241,5,4,37,3),
(242,5,4,38,3),
(243,5,4,39,3),
(244,5,4,40,3),
(245,5,4,41,3),
(246,5,4,42,3),
(247,5,4,43,3),
(248,5,4,44,3),
(249,5,4,45,3),
(250,5,4,46,3),
(251,5,4,47,3),
(252,5,4,48,3),
(253,5,4,49,3),
(254,5,4,50,3),
(255,5,4,51,3),
(256,5,4,52,3),
(257,5,4,53,3),
(258,5,4,54,3),
(259,5,4,55,3),
(260,5,4,56,3),
(261,5,4,57,3),
(262,5,4,58,3),
(263,5,4,59,3),
(264,5,4,60,3),
(265,5,4,61,3),
(266,5,4,62,3),
(267,5,4,63,3),
(268,5,4,64,0),
(269,5,4,65,3),
(270,5,4,66,3),
(271,5,4,67,0),
(272,5,4,68,2);

/*Table structure for table `proyek` */

DROP TABLE IF EXISTS `proyek`;

CREATE TABLE `proyek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_proyek` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `proyek` */

insert  into `proyek`(`id`,`nama_proyek`) values 
(5,'Proyek 1'),
(6,'Proyek 2');

/*Table structure for table `sub_kriteria` */

DROP TABLE IF EXISTS `sub_kriteria`;

CREATE TABLE `sub_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) DEFAULT NULL,
  `sub_kriteria` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

/*Data for the table `sub_kriteria` */

insert  into `sub_kriteria`(`id`,`id_kriteria`,`sub_kriteria`) values 
(1,1,'Rasio Kas'),
(2,1,'Rasio Lancar'),
(3,1,'Rasio Hutang/modal'),
(4,1,'Rasio hutang/Aktiva'),
(5,1,'Surat referensi bank'),
(6,2,'Nama Direksi Perusahaan'),
(7,2,'Penanggungjawab proyek'),
(8,3,'Bukan PNS, TNI, BUMN, Bank Pemerintah/Bank Daerah kecuali yang bersangkutan adalah perusahaan milik negara'),
(9,3,'Tidak dalam keadaan pailit'),
(10,3,'Tidak ada conflict of interest'),
(11,3,'Sanggup mengikuti peraturan yang berlaku di PT Petrokimia Gresik'),
(12,3,'Sanggup melaksanakan pekerjaan apabila ditunjuk sebagai pemenang'),
(13,3,'Sanggup bekerjasama dengan UKM/Koperasi setempat dan menyebutkan nilai rupiah yang akan di subkontrakan'),
(14,3,'Bersedia dikenakan sanksi atas keterlambatan penyelesaian dan atau ketidaksesuaian unjuk kerja yang dijanjikan'),
(15,4,'Rencana Waktu Pelaksanaan'),
(16,5,'Sertifikasi Badan usaha Jasa Pelaksana Konstruksi'),
(17,5,'Ijin Galian Tipe C'),
(18,6,'NPWP'),
(19,6,'PKP (Pengusahan Kena Pajak)'),
(20,6,'TDP (Tanda Daftar Perusahaan)'),
(21,6,'Akta Pendirian Perusahaan'),
(22,6,'SIUP'),
(23,6,'SKDP'),
(24,7,'Daftar Pengalaman'),
(25,8,'Ketersediaan SDM'),
(26,8,'Daftar Proyek yang dikerjaan saat ini'),
(27,8,'Kemampuan keuangan'),
(28,9,'Pemberian Asuransi'),
(29,10,'Diwajibkan mematuhi aturan K3 yang tercantum dalam buku pedoman K3 dan prosedur pengelolaan K3 penyedia barang /jasa (PR-02-0092)'),
(30,10,'Menunjuk penanggungjawab keselamatan/safety representative'),
(31,10,'Menyediakan alat-alat K3 yang diperlukan bagi para pekerja'),
(32,11,'Perijinan'),
(33,12,'Menunjuk penanggungjawab tenaga kerja'),
(34,12,'Tidak boleh ada tenaga kerja dibawah umur 18 tahun'),
(35,12,'Wajib mengajukan daftar tenaga kerja untuk KIB (KIB)'),
(36,13,'Direksi Keet (gudang material & kantor pengawas)'),
(37,13,'Mob/Demob Peralatan berat'),
(38,13,'Pengukuran/bouwplank'),
(39,13,'Pekerjaan pembuatan tanda sementara area kerja'),
(40,14,'Urug tanggul lime stone padat, s/d elevasi +3.5 LLWL'),
(41,14,'Urug lime stone padat (s/d elevasi +1.0 LLWL)'),
(42,14,'Perataan dan pemadatan di area Reklamasi'),
(43,15,'Urug Lime Stone Padat ( s/d elevasi +1.0 LLWL)'),
(44,15,'Perataan dan pemadatan di area Reklamasi'),
(45,16,'Pekerjaan Galian Tanah (Sumur dan Tanam Pipa)'),
(46,16,'Pekerjaan lantai kerja t = 10 cm, 1 pc : 3 ps : 5 kr'),
(47,16,'Pekerjaan Cor Rabat Beton t = 10 cm, single Wiremesh M6-150'),
(48,16,'Pekerjaan Base Beton Bertulang (Sumur)'),
(49,16,'Pekerjaan Tutup Cor Beton t = 12 cm, Single Wiremesh M6-150'),
(50,16,'Pekerjaan Urugan Gravel'),
(51,16,'Pekerjaan Pipa PVC 10\"'),
(52,16,'Pekerjaan Geotextile Non Woven'),
(53,16,'Pekerjaan Finishing Plesteran t = 2 cm'),
(54,17,'Pekerjaan pondasi bor straust D=30 cm L= 6 m'),
(55,17,'Beton 30 x 30 x 50 cm'),
(56,17,'Pekerjaan Pembuatan Sarana Pembuangan Air Laut'),
(57,17,'Pekerjaan Pemompaan Air Laut keluar Area Reklamasi'),
(58,17,'Pekerjaan Penutupan Sarana Pembuangan Air Laut (Finishing)'),
(59,17,'Cover Pipa Gas Type 2'),
(60,17,'Patok Beton, tiap jarak 30 m ( 2 sisi )'),
(61,17,'Pekerjaan Jembatan Sementara'),
(62,17,'Pekerjaan Pembersihan Lahan'),
(63,18,'Metode kerja reklamasi'),
(64,18,'List daftar alat kerja'),
(65,18,'Beton ready mix'),
(66,18,'Tulangan Baja'),
(67,18,'Pipa PVC'),
(68,19,'Nilai Penawan Harga');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `password` text,
  `akses` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`nama`,`password`,`akses`) values 
(1,'admin','Administrator','21232f297a57a5a743894a0e4a801fc3',1),
(2,'manager','Manager','1d0258c2440a8d19e716292b231e3190',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
