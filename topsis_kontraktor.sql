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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `kontraktor` */

insert  into `kontraktor`(`id`,`nama_kontraktor`,`alamat`,`telepon`) values 
(1,'test1','terserah','081922822829'),
(2,'test','coba alamat',''),
(3,'coba','                                                                    ','');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kriteria_proyek` */

/*Table structure for table `nilai_kriteria` */

DROP TABLE IF EXISTS `nilai_kriteria`;

CREATE TABLE `nilai_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyek_id` int(11) DEFAULT NULL,
  `sub_kriteria_id` int(11) DEFAULT NULL,
  `kriteria_proyek_id` int(11) DEFAULT NULL,
  `kontraktor_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `nilai_kriteria` */

/*Table structure for table `proyek` */

DROP TABLE IF EXISTS `proyek`;

CREATE TABLE `proyek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_proyek` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `proyek` */

insert  into `proyek`(`id`,`nama_proyek`) values 
(5,'Proyek 1');

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
