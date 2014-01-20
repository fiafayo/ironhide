-- phpMyAdmin SQL Dump
-- version 2.9.0.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 12, 2008 at 06:05 PM
-- Server version: 5.0.24
-- PHP Version: 5.1.6
-- 
-- Database: `teknik`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `tk_admin`
-- 

CREATE TABLE `tk_admin` (
  `nik` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kode_jur` varchar(5) NOT NULL,
  `password` varchar(100) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  PRIMARY KEY  (`nik`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `tk_admin`
-- 

INSERT INTO `tk_admin` VALUES ('61111', 'Gianto', '-', 'coba', 'ADMINISTRATOR');
INSERT INTO `tk_admin` VALUES ('60004', 'Haryo', '64-64', 'infor', 'PAJ');
INSERT INTO `tk_admin` VALUES ('60002', 'Dwie', '62-62', 'kimia', 'PAJ');
INSERT INTO `tk_admin` VALUES ('60021', 'Dwie', '62-01', 'pangan', 'PAJ');

-- --------------------------------------------------------

-- 
-- Table structure for table `tk_admin_jadwal`
-- 

CREATE TABLE `tk_admin_jadwal` (
  `no` tinyint(4) NOT NULL auto_increment,
  `keterangan` varchar(100) NOT NULL,
  `waktu_buka` date NOT NULL,
  `waktu_tutup` date NOT NULL,
  PRIMARY KEY  (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `tk_admin_jadwal`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tk_daftar_kls`
-- 

CREATE TABLE `tk_daftar_kls` (
  `kode_fpp` varchar(20) NOT NULL,
  `kode_kelas` varchar(20) NOT NULL,
  `nrp` varchar(8) NOT NULL,
  `status` varchar(2) NOT NULL COMMENT 'pending/terima/tolak/pindah',
  PRIMARY KEY  (`kode_fpp`,`kode_kelas`,`nrp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `tk_daftar_kls`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tk_dosen`
-- 

CREATE TABLE `tk_dosen` (
  `kode_dosen` varchar(8) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`kode_dosen`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `tk_dosen`
-- 

INSERT INTO `tk_dosen` VALUES ('6196', 'LISANA', 'DOSEN');
INSERT INTO `tk_dosen` VALUES ('61135', 'ARBI', 'DOSEN');
INSERT INTO `tk_dosen` VALUES ('60', 'MIPA', 'DOSEN');
INSERT INTO `tk_dosen` VALUES ('00', 'MKU', 'DOSEN');
INSERT INTO `tk_dosen` VALUES ('6532', 'LILIANA', 'DOSEN');
INSERT INTO `tk_dosen` VALUES ('6149', 'BUDI HARTANTO', 'DOSEN');
INSERT INTO `tk_dosen` VALUES ('6112', 'BAMBANG', 'DOSEN');
INSERT INTO `tk_dosen` VALUES ('6548', 'SUSAN', 'DOSEN');

-- --------------------------------------------------------

-- 
-- Table structure for table `tk_dsn_kls`
-- 

CREATE TABLE `tk_dsn_kls` (
  `kode_dosen` varchar(8) NOT NULL,
  `kode_kelas` varchar(20) NOT NULL,
  PRIMARY KEY  (`kode_dosen`,`kode_kelas`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `tk_dsn_kls`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tk_fpp`
-- 

CREATE TABLE `tk_fpp` (
  `kode_fpp` varchar(20) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `semester` varchar(5) NOT NULL,
  `tahun` varchar(9) NOT NULL,
  `waktu_buka` datetime NOT NULL,
  `waktu_tutup` datetime NOT NULL,
  `status_aktif` char(2) NOT NULL,
  PRIMARY KEY  (`kode_fpp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `tk_fpp`
-- 

INSERT INTO `tk_fpp` VALUES ('KK07GE', 'KK', 'GENAP', '2007-2008', '2008-02-09 02:21:27', '2008-02-13 02:21:33', '1');
INSERT INTO `tk_fpp` VALUES ('I07GE', 'I', 'GENAP', '2007-2008', '2008-02-08 06:06:27', '2008-02-10 06:06:33', '0');

-- --------------------------------------------------------

-- 
-- Table structure for table `tk_jadwal_kul`
-- 

CREATE TABLE `tk_jadwal_kul` (
  `kode_jadwal` varchar(10) NOT NULL,
  `kode_kelas` varchar(20) NOT NULL,
  `kode_ruang` varchar(10) NOT NULL,
  `jam_masuk` varchar(5) NOT NULL,
  `jam_keluar` varchar(5) NOT NULL,
  `hari` tinyint(4) NOT NULL,
  PRIMARY KEY  (`kode_jadwal`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `tk_jadwal_kul`
-- 

INSERT INTO `tk_jadwal_kul` VALUES ('J0001', '64A611A07GA', '-', '10.10', '12.55', 2);
INSERT INTO `tk_jadwal_kul` VALUES ('J0002', '64A111C07GA', '-', '10.10', '12.55', 1);
INSERT INTO `tk_jadwal_kul` VALUES ('J0003', '64A111C07GA', '-', '15.40', '18.05', 2);
INSERT INTO `tk_jadwal_kul` VALUES ('J0004', '64A111A07GA', '-', '12.55', '15.40', 3);
INSERT INTO `tk_jadwal_kul` VALUES ('J0005', '64A111A07GA', '-', '07.25', '10.10', 5);
INSERT INTO `tk_jadwal_kul` VALUES ('J0006', '64A211B07GA', '-', '10.10', '12.55', 5);
INSERT INTO `tk_jadwal_kul` VALUES ('J0007', '64A111A07GE', '-', '10.10', '12.55', 3);
INSERT INTO `tk_jadwal_kul` VALUES ('J0008', '64A111A07GE', '-', '07.25', '10.10', 5);
INSERT INTO `tk_jadwal_kul` VALUES ('J0009', '64A112Q07GE', '-', '12.55', '15.50', 5);
INSERT INTO `tk_jadwal_kul` VALUES ('J0010', '64A413A07GE', '-', '10.10', '12.55', 2);
INSERT INTO `tk_jadwal_kul` VALUES ('J0013', '64A611A07GE', '-', '12.52', '14.25', 5);
INSERT INTO `tk_jadwal_kul` VALUES ('J0012', '62A011A07GE', '-', '10.10', '12.55', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `tk_jadwal_ujian`
-- 

CREATE TABLE `tk_jadwal_ujian` (
  `kode_ujian` varchar(20) NOT NULL,
  `kode_mk` varchar(10) NOT NULL,
  `hari` tinyint(4) NOT NULL,
  `jam` tinyint(4) NOT NULL,
  `minggu` tinyint(4) NOT NULL,
  `semester` varchar(5) NOT NULL,
  `tahun` varchar(9) NOT NULL,
  PRIMARY KEY  (`kode_ujian`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `tk_jadwal_ujian`
-- 

INSERT INTO `tk_jadwal_ujian` VALUES ('JU64A61107GA', '64A611', 5, 3, 1, 'GASAL', '2007-2008');
INSERT INTO `tk_jadwal_ujian` VALUES ('JU64A11107GA', '64A111', 1, 2, 1, 'GASAL', '2007-2008');
INSERT INTO `tk_jadwal_ujian` VALUES ('JU64A21107GA', '64A211', 1, 2, 1, 'GASAL', '2007-2008');

-- --------------------------------------------------------

-- 
-- Table structure for table `tk_jurusan`
-- 

CREATE TABLE `tk_jurusan` (
  `kode_jur` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY  (`kode_jur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `tk_jurusan`
-- 

INSERT INTO `tk_jurusan` VALUES ('61-61', 'TEKNIK ELEKTRO');
INSERT INTO `tk_jurusan` VALUES ('62-62', 'TEKNIK KIMIA');
INSERT INTO `tk_jurusan` VALUES ('63-63', 'TEKNIK INDUSTRI');
INSERT INTO `tk_jurusan` VALUES ('64-64', 'TEKNIK INFORMATIKA');
INSERT INTO `tk_jurusan` VALUES ('65-65', 'TEKNIK MANUFAKTUR');
INSERT INTO `tk_jurusan` VALUES ('67-67', 'SISTEM INFORMASI');
INSERT INTO `tk_jurusan` VALUES ('62-01', 'TEKNOLOGI PROSES PANGAN');
INSERT INTO `tk_jurusan` VALUES ('62-02', 'TEKNOLOGI ILMU DAN LINGKUNGAN');
INSERT INTO `tk_jurusan` VALUES ('66-66', 'DESAIN MANAGEMEN PRODUK');
INSERT INTO `tk_jurusan` VALUES ('68-68', 'MULTIMEDIA');

-- --------------------------------------------------------

-- 
-- Table structure for table `tk_kelas_mk`
-- 

CREATE TABLE `tk_kelas_mk` (
  `kode_kelas` varchar(20) NOT NULL,
  `kode_mk` varchar(10) NOT NULL,
  `kp` varchar(3) NOT NULL,
  `isi` int(11) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `semester` varchar(5) NOT NULL,
  `tahun` varchar(9) NOT NULL,
  `status_buka` varchar(1) NOT NULL,
  `dmb` varchar(1) NOT NULL,
  `waktu_buka` datetime NOT NULL,
  PRIMARY KEY  (`kode_kelas`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `tk_kelas_mk`
-- 

INSERT INTO `tk_kelas_mk` VALUES ('64A611A07GA', '64A611', 'A', 0, 10, 'GASAL', '2007-2008', '1', '0', '2008-01-12 04:36:16');
INSERT INTO `tk_kelas_mk` VALUES ('64A111A07GA', '64A111', 'A', 0, 10, 'GASAL', '2007-2008', '1', '0', '2008-01-12 09:51:49');
INSERT INTO `tk_kelas_mk` VALUES ('64A211B07GA', '64A211', 'B', 0, 10, 'GASAL', '2007-2008', '1', '0', '2008-01-12 09:52:03');
INSERT INTO `tk_kelas_mk` VALUES ('64A111C07GA', '64A111', 'C', 0, 10, 'GASAL', '2007-2008', '1', '0', '2008-01-12 09:52:11');
INSERT INTO `tk_kelas_mk` VALUES ('64A111A07GE', '64A111', 'A', 0, 20, 'GENAP', '2007-2008', '1', '0', '2008-02-18 01:21:28');
INSERT INTO `tk_kelas_mk` VALUES ('64A112Q07GE', '64A112', 'Q', 0, 20, 'GENAP', '2007-2008', '1', '0', '2008-02-18 01:21:40');
INSERT INTO `tk_kelas_mk` VALUES ('64A413A07GE', '64A413', 'A', 0, 20, 'GENAP', '2007-2008', '1', '0', '2008-02-18 01:22:00');
INSERT INTO `tk_kelas_mk` VALUES ('64A611A07GE', '64A611', 'A', 0, 12, 'GENAP', '2007-2008', '1', '0', '2008-02-11 04:25:22');
INSERT INTO `tk_kelas_mk` VALUES ('62A011A07GE', '62A011', 'A', 0, 10, 'GENAP', '2007-2008', '1', '0', '2008-02-09 06:05:32');

-- --------------------------------------------------------

-- 
-- Table structure for table `tk_kk`
-- 

CREATE TABLE `tk_kk` (
  `kode_fpp` varchar(20) NOT NULL,
  `jwd_kul` varchar(1) NOT NULL,
  `jwd_ujian` varchar(1) NOT NULL,
  `mk_p` varchar(1) NOT NULL,
  PRIMARY KEY  (`kode_fpp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `tk_kk`
-- 

INSERT INTO `tk_kk` VALUES ('KK07GE', '1', '1', '1');

-- --------------------------------------------------------

-- 
-- Table structure for table `tk_kls_jur`
-- 

CREATE TABLE `tk_kls_jur` (
  `kode_kelas` varchar(20) NOT NULL,
  `kode_jur` varchar(5) NOT NULL,
  PRIMARY KEY  (`kode_kelas`,`kode_jur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `tk_kls_jur`
-- 

INSERT INTO `tk_kls_jur` VALUES ('62A011A07GE', '62-62');
INSERT INTO `tk_kls_jur` VALUES ('64A111A07GA', '64-64');
INSERT INTO `tk_kls_jur` VALUES ('64A111A07GE', '64-64');
INSERT INTO `tk_kls_jur` VALUES ('64A111C07GA', '64-64');
INSERT INTO `tk_kls_jur` VALUES ('64A112Q07GE', '64-64');
INSERT INTO `tk_kls_jur` VALUES ('64A211B07GA', '64-64');
INSERT INTO `tk_kls_jur` VALUES ('64A413A07GE', '64-64');
INSERT INTO `tk_kls_jur` VALUES ('64A611A07GA', '64-64');
INSERT INTO `tk_kls_jur` VALUES ('64A611A07GE', '64-64');

-- --------------------------------------------------------

-- 
-- Table structure for table `tk_master_mk`
-- 

CREATE TABLE `tk_master_mk` (
  `kode_mk` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `sks` tinyint(4) NOT NULL,
  PRIMARY KEY  (`kode_mk`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `tk_master_mk`
-- 

INSERT INTO `tk_master_mk` VALUES ('000101', 'PANCASILA', 2);
INSERT INTO `tk_master_mk` VALUES ('000111', 'AGAMA ISLAM', 2);
INSERT INTO `tk_master_mk` VALUES ('000112', 'AGAMA KATOLIK', 2);
INSERT INTO `tk_master_mk` VALUES ('000113', 'AGAMA PROTESTAN', 2);
INSERT INTO `tk_master_mk` VALUES ('000114', 'AGAMA HINDU', 2);
INSERT INTO `tk_master_mk` VALUES ('000115', 'AGAMA BUDHA', 2);
INSERT INTO `tk_master_mk` VALUES ('000141', 'Kewarganegaraan', 2);
INSERT INTO `tk_master_mk` VALUES ('600001', 'KALKULUS I', 4);
INSERT INTO `tk_master_mk` VALUES ('600002', 'KALKULUS II', 3);
INSERT INTO `tk_master_mk` VALUES ('601001', 'MATEMATIKA I', 4);
INSERT INTO `tk_master_mk` VALUES ('601002', 'MATEMATIKA II', 4);
INSERT INTO `tk_master_mk` VALUES ('601003', 'MATEMATIKA LANJUT', 4);
INSERT INTO `tk_master_mk` VALUES ('601004', 'MATEMATIKA TEKNIK', 3);
INSERT INTO `tk_master_mk` VALUES ('601005', 'PERSAMAAN DIFERENSIAL', 2);
INSERT INTO `tk_master_mk` VALUES ('601006', 'VEKTOR DAN MATRIK', 3);
INSERT INTO `tk_master_mk` VALUES ('601007', 'MATEMATIKA TEKNIK', 3);
INSERT INTO `tk_master_mk` VALUES ('601008', 'VARIABEL KOMPLEKS', 2);
INSERT INTO `tk_master_mk` VALUES ('601009', 'Tran.Laplace&Pers.Differ Biasa', 3);
INSERT INTO `tk_master_mk` VALUES ('601010', 'Aljabar Linier', 3);
INSERT INTO `tk_master_mk` VALUES ('601011', 'Pengantar Aljabar Linear', 2);
INSERT INTO `tk_master_mk` VALUES ('601101', 'ANALISA NUMERIK', 3);
INSERT INTO `tk_master_mk` VALUES ('601102', 'ANALISA NUMERIK', 3);
INSERT INTO `tk_master_mk` VALUES ('601103', 'METODE NUMERIK', 3);
INSERT INTO `tk_master_mk` VALUES ('601104', 'METODE NUMERIK', 3);
INSERT INTO `tk_master_mk` VALUES ('601105', 'Metode Numerik', 3);
INSERT INTO `tk_master_mk` VALUES ('601201', 'STATISTIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('601202', 'STATISTIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('601203', 'Statistika', 2);
INSERT INTO `tk_master_mk` VALUES ('601204', 'Statistika', 3);
INSERT INTO `tk_master_mk` VALUES ('602001', 'FISIKA I', 3);
INSERT INTO `tk_master_mk` VALUES ('602002', 'FISIKA II', 3);
INSERT INTO `tk_master_mk` VALUES ('602003', 'FISIKA LANJUT', 3);
INSERT INTO `tk_master_mk` VALUES ('602004', 'FISIKA GELOMBANG', 2);
INSERT INTO `tk_master_mk` VALUES ('602005', 'FISIKA ALIRAN DAN PANAS', 2);
INSERT INTO `tk_master_mk` VALUES ('602006', 'Fisika I', 3);
INSERT INTO `tk_master_mk` VALUES ('602007', 'Fisika II', 3);
INSERT INTO `tk_master_mk` VALUES ('603001', 'KIMIA DASAR', 2);
INSERT INTO `tk_master_mk` VALUES ('603002', 'KIMIA DASAR', 3);
INSERT INTO `tk_master_mk` VALUES ('603003', 'KIMIA ANALITIK', 3);
INSERT INTO `tk_master_mk` VALUES ('603004', 'KIMIA ORGANIK I', 2);
INSERT INTO `tk_master_mk` VALUES ('603005', 'KIMIA ORGANIK II', 2);
INSERT INTO `tk_master_mk` VALUES ('603201', 'KIMIA FISIKA I', 3);
INSERT INTO `tk_master_mk` VALUES ('603202', 'KIMIA FISIKA II', 3);
INSERT INTO `tk_master_mk` VALUES ('603203', 'Kimia Fisika I', 2);
INSERT INTO `tk_master_mk` VALUES ('603204', 'Kimia Fisika II', 2);
INSERT INTO `tk_master_mk` VALUES ('604001', 'BAHASA INDONESIA', 2);
INSERT INTO `tk_master_mk` VALUES ('604002', 'BAHASA INGGRIS', 2);
INSERT INTO `tk_master_mk` VALUES ('604171', 'Komposisi Bahasa Indonesia', 3);
INSERT INTO `tk_master_mk` VALUES ('604271', 'Teknik Presentasi', 2);
INSERT INTO `tk_master_mk` VALUES ('604371', 'Bahasa Inggris I', 1);
INSERT INTO `tk_master_mk` VALUES ('604471', 'Bahasa Inggris II', 1);
INSERT INTO `tk_master_mk` VALUES ('604571', 'Bahasa Inggris III', 1);
INSERT INTO `tk_master_mk` VALUES ('609002', 'PRAKTIKUM FISIKA', 1);
INSERT INTO `tk_master_mk` VALUES ('609301', 'PRAKTIKUM KIMIA ANALITIK', 1);
INSERT INTO `tk_master_mk` VALUES ('609302', 'PRAKTIKUM KIMIA FISIKA', 2);
INSERT INTO `tk_master_mk` VALUES ('609303', 'PRAKTIKUM KIMIA ORGANIK', 2);
INSERT INTO `tk_master_mk` VALUES ('610001', 'FISIKA I', 4);
INSERT INTO `tk_master_mk` VALUES ('610002', 'FISIKA II', 3);
INSERT INTO `tk_master_mk` VALUES ('610004', 'ELEKTRO MEKANIK', 3);
INSERT INTO `tk_master_mk` VALUES ('610005', 'KONSEP TEKNOLOGI ELEKTRO', 2);
INSERT INTO `tk_master_mk` VALUES ('610012', 'MENGGAMBAR TEKNIK LISTRIK', 3);
INSERT INTO `tk_master_mk` VALUES ('610027', 'FISIKA MODERN', 3);
INSERT INTO `tk_master_mk` VALUES ('610028', 'BAHAN LISTRIK', 3);
INSERT INTO `tk_master_mk` VALUES ('610029', 'PENGETAHUAN LINGKUNGAN HIDUP', 2);
INSERT INTO `tk_master_mk` VALUES ('610042', 'METODOLOGI PENELITIAN', 2);
INSERT INTO `tk_master_mk` VALUES ('610056', 'KERJA PRAKTEK', 2);
INSERT INTO `tk_master_mk` VALUES ('610057', 'TUGAS AKHIR', 6);
INSERT INTO `tk_master_mk` VALUES ('610068', 'TOPIK KHUSUS', 2);
INSERT INTO `tk_master_mk` VALUES ('610069', 'PERENCANAAN ELEKTRO MEKANIK', 3);
INSERT INTO `tk_master_mk` VALUES ('610075', 'FISIKA III', 3);
INSERT INTO `tk_master_mk` VALUES ('610101', 'KONSEP TEKNOLOGI ELEKTRO', 2);
INSERT INTO `tk_master_mk` VALUES ('610102', 'PERENCANAAN ELEKTRO MEKANIK', 2);
INSERT INTO `tk_master_mk` VALUES ('610103', 'METODOLOGI PENELITIAN', 2);
INSERT INTO `tk_master_mk` VALUES ('610104', 'KERJA PRAKTEK', 2);
INSERT INTO `tk_master_mk` VALUES ('610105', 'TUGAS AKHIR', 6);
INSERT INTO `tk_master_mk` VALUES ('610106', 'PENGET. LINGKUNGAN HIDUP', 2);
INSERT INTO `tk_master_mk` VALUES ('610107', 'TOPIK KHUSUS', 2);
INSERT INTO `tk_master_mk` VALUES ('610108', 'PROBABILITAS & PROSES STOKASTI', 3);
INSERT INTO `tk_master_mk` VALUES ('610112', 'Rangkaian Listrik Dasar I', 3);
INSERT INTO `tk_master_mk` VALUES ('610113', 'Elektronika Lanjutan', 3);
INSERT INTO `tk_master_mk` VALUES ('610114', 'Teknologi Digital Lanjutan', 2);
INSERT INTO `tk_master_mk` VALUES ('610122', 'Elektronika Dasar I', 4);
INSERT INTO `tk_master_mk` VALUES ('610123', 'Sistem Telekomunikasi Analog', 2);
INSERT INTO `tk_master_mk` VALUES ('610124', 'Sistem Pengaturan Optimal', 2);
INSERT INTO `tk_master_mk` VALUES ('610132', 'Dasar Teknologi Digital', 3);
INSERT INTO `tk_master_mk` VALUES ('610133', 'Devais Logika Terprogram', 2);
INSERT INTO `tk_master_mk` VALUES ('610142', 'Teknologi Elektromagnetik I', 3);
INSERT INTO `tk_master_mk` VALUES ('610143', 'Teknik Tenaga Listrik I', 2);
INSERT INTO `tk_master_mk` VALUES ('610144', 'Program Kooperatif', 3);
INSERT INTO `tk_master_mk` VALUES ('610152', 'Sinyal Dan Sistem', 3);
INSERT INTO `tk_master_mk` VALUES ('610153', 'Sistem Kendali I', 3);
INSERT INTO `tk_master_mk` VALUES ('610161', 'Algoritma Dan Pemrograman I', 3);
INSERT INTO `tk_master_mk` VALUES ('610174', 'Komposisi Bahasa Inggris', 3);
INSERT INTO `tk_master_mk` VALUES ('610181', 'Ekonomi Teknik', 3);
INSERT INTO `tk_master_mk` VALUES ('610191', 'Konsep Teknologi', 2);
INSERT INTO `tk_master_mk` VALUES ('610212', 'Rangkaian Listrik Dasar II', 3);
INSERT INTO `tk_master_mk` VALUES ('610213', 'Penguat Operasional', 3);
INSERT INTO `tk_master_mk` VALUES ('610214', 'Arsitektur Komputer Digital', 2);
INSERT INTO `tk_master_mk` VALUES ('610222', 'Elektronika Dasar II', 4);
INSERT INTO `tk_master_mk` VALUES ('610223', 'Sistem Telekomunikasi Digital', 2);
INSERT INTO `tk_master_mk` VALUES ('610224', 'Sistem Komunikasi Bergerak', 2);
INSERT INTO `tk_master_mk` VALUES ('610232', 'Eksperimentasi Digital', 1);
INSERT INTO `tk_master_mk` VALUES ('610233', 'Organisasi & Arsitektur Komp.', 3);
INSERT INTO `tk_master_mk` VALUES ('610242', 'Teknologi Elektromagnetik II', 3);
INSERT INTO `tk_master_mk` VALUES ('610243', 'Teknik Tenaga Listrik II', 2);
INSERT INTO `tk_master_mk` VALUES ('610244', 'Proyek Desain Aplikasi', 3);
INSERT INTO `tk_master_mk` VALUES ('610252', 'Proses Stokastik', 2);
INSERT INTO `tk_master_mk` VALUES ('610253', 'Sistem Kendali II', 3);
INSERT INTO `tk_master_mk` VALUES ('610261', 'Algoritma Dan Pemrograman II', 3);
INSERT INTO `tk_master_mk` VALUES ('610274', 'Penulisan Karya Ilmiah', 2);
INSERT INTO `tk_master_mk` VALUES ('610281', 'Pengetahuan Lingkungan Hidup', 2);
INSERT INTO `tk_master_mk` VALUES ('610301', 'Keterampilan Aplikasi Komputer', 0);
INSERT INTO `tk_master_mk` VALUES ('610312', 'Rangkaian Listrik Dasar III', 2);
INSERT INTO `tk_master_mk` VALUES ('610314', 'Teknologi Jaringan Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('610323', 'Sistem Telepon', 2);
INSERT INTO `tk_master_mk` VALUES ('610324', 'Elektronika Daya', 3);
INSERT INTO `tk_master_mk` VALUES ('610333', 'Sistem Mikroprosesor', 4);
INSERT INTO `tk_master_mk` VALUES ('610344', 'Desain Sis.Elektronika Digital', 2);
INSERT INTO `tk_master_mk` VALUES ('610414', 'Desain Filter Digital', 2);
INSERT INTO `tk_master_mk` VALUES ('610424', 'Sistem Kom. Gelombang Mikro', 2);
INSERT INTO `tk_master_mk` VALUES ('610433', 'Aplikasi Mikrokontroler', 3);
INSERT INTO `tk_master_mk` VALUES ('610444', 'Antar Muka Dan Akuisisi Data', 2);
INSERT INTO `tk_master_mk` VALUES ('610514', 'Teori Dan Desain Antena', 2);
INSERT INTO `tk_master_mk` VALUES ('610524', 'Elektronika Komunikasi', 2);
INSERT INTO `tk_master_mk` VALUES ('610533', 'Sistem Pengendalian Terprogram', 3);
INSERT INTO `tk_master_mk` VALUES ('610544', 'Robotika', 2);
INSERT INTO `tk_master_mk` VALUES ('610614', 'Sistem Pengaturan Cerdas', 3);
INSERT INTO `tk_master_mk` VALUES ('610644', 'Desain Sistem Prosesor Sinyal', 2);
INSERT INTO `tk_master_mk` VALUES ('610714', 'Otomasi Industri', 3);
INSERT INTO `tk_master_mk` VALUES ('610744', 'Transduser', 2);
INSERT INTO `tk_master_mk` VALUES ('610814', 'Topik Khusus', 2);
INSERT INTO `tk_master_mk` VALUES ('610914', 'Sistem Komunikasi Satelit', 2);
INSERT INTO `tk_master_mk` VALUES ('610990', 'PES.UJ.NEGARA LULUS S-1 LOKAL', 0);
INSERT INTO `tk_master_mk` VALUES ('610999', 'BERHENTI STUDI SEMENTARA', 1);
INSERT INTO `tk_master_mk` VALUES ('611006', 'RANGKAIAN LISTRIK I', 3);
INSERT INTO `tk_master_mk` VALUES ('611007', 'RANGKAIAN LISTRIK II', 3);
INSERT INTO `tk_master_mk` VALUES ('611008', 'RANGKAIAN LISTRIK III', 3);
INSERT INTO `tk_master_mk` VALUES ('611015', 'ELEKTRONIKA I', 3);
INSERT INTO `tk_master_mk` VALUES ('611016', 'ELEKTRONIKA II', 3);
INSERT INTO `tk_master_mk` VALUES ('611017', 'PROYEK DESAIN', 2);
INSERT INTO `tk_master_mk` VALUES ('611035', 'FISIKA SEMIKONDUKTOR', 2);
INSERT INTO `tk_master_mk` VALUES ('611038', 'RANGKAIAN TAK LINIER AKTIF', 3);
INSERT INTO `tk_master_mk` VALUES ('611040', 'INSTRUMENTASI ELEKTRONIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('611041', 'TEORI FILTER', 2);
INSERT INTO `tk_master_mk` VALUES ('611044', 'ELEKTRONIKA KOMUNIKASI', 3);
INSERT INTO `tk_master_mk` VALUES ('611045', 'ELEKTRONIKA SISTEM TENAGA LIST', 3);
INSERT INTO `tk_master_mk` VALUES ('611046', 'RANGKAIAN LINEAR AKTIF', 3);
INSERT INTO `tk_master_mk` VALUES ('611053', 'ANALOG RANGKAIAN INTEGRASI', 3);
INSERT INTO `tk_master_mk` VALUES ('611055', 'TEKNOLOGI IC', 3);
INSERT INTO `tk_master_mk` VALUES ('611058', 'ELEKTRONIKA INDUSTRI', 3);
INSERT INTO `tk_master_mk` VALUES ('611061', 'PENG.KOMPT.DLM ANALISA RANGK.', 3);
INSERT INTO `tk_master_mk` VALUES ('611064', 'SINTESA RANGKAIAN', 3);
INSERT INTO `tk_master_mk` VALUES ('611076', 'MIKRO ELEKTRONIK', 3);
INSERT INTO `tk_master_mk` VALUES ('611080', 'FILTER DIGITAL', 3);
INSERT INTO `tk_master_mk` VALUES ('611101', 'RANGKAIAN LISTRIK I', 3);
INSERT INTO `tk_master_mk` VALUES ('611102', 'RANGKAIAN LISTRIK II', 3);
INSERT INTO `tk_master_mk` VALUES ('611103', 'ELEKTRONIKA I', 3);
INSERT INTO `tk_master_mk` VALUES ('611104', 'ELEKTRONIKA II', 3);
INSERT INTO `tk_master_mk` VALUES ('611105', 'RANGKAIAN LINIER AKTIF', 3);
INSERT INTO `tk_master_mk` VALUES ('611106', 'SIST. INSTRUMENTASI ELEKTRONIK', 3);
INSERT INTO `tk_master_mk` VALUES ('611107', 'SISTEM LINIER', 3);
INSERT INTO `tk_master_mk` VALUES ('611108', 'BAHAN SEMIKONDUKTOR', 3);
INSERT INTO `tk_master_mk` VALUES ('611109', 'TEKNOLOGI RANGK. TERPADU', 3);
INSERT INTO `tk_master_mk` VALUES ('611110', 'DEVAIS MIKROELEKTRONIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('611111', 'PENGG. KOMPT PD ANAL. RANGK', 2);
INSERT INTO `tk_master_mk` VALUES ('611112', 'PERANCANGAN SIST. ELEKTRONIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('611113', 'TEORI FILTER', 2);
INSERT INTO `tk_master_mk` VALUES ('611114', 'TRANSDUSER', 2);
INSERT INTO `tk_master_mk` VALUES ('612024', 'DASAR SISTEM KOMUNIKASI I', 2);
INSERT INTO `tk_master_mk` VALUES ('612025', 'DASAR SISTEM KOMUNIKASI II', 2);
INSERT INTO `tk_master_mk` VALUES ('612030', 'MEDAN ELEKTROMAGNETIK I', 3);
INSERT INTO `tk_master_mk` VALUES ('612031', 'MEDAN ELEKTROMAGNIT II', 3);
INSERT INTO `tk_master_mk` VALUES ('612036', 'TRANSMISI GEL.ELEKTROMAGNETIK', 3);
INSERT INTO `tk_master_mk` VALUES ('612037', 'SISTEM MODULASI', 3);
INSERT INTO `tk_master_mk` VALUES ('612039', 'SISTEM KOMUNIKASI', 3);
INSERT INTO `tk_master_mk` VALUES ('612040', 'DASAR SISTEM KOMUNIKASI', 3);
INSERT INTO `tk_master_mk` VALUES ('612041', 'TELEFONI DAN TELEGRAFI', 3);
INSERT INTO `tk_master_mk` VALUES ('612048', 'TEKNIK GELOMBANG MIKRO', 2);
INSERT INTO `tk_master_mk` VALUES ('612050', 'SISTEM KOMUNIKASI TERAPAN', 2);
INSERT INTO `tk_master_mk` VALUES ('612051', 'SISTEM KOMUNIKASI OPTIK', 2);
INSERT INTO `tk_master_mk` VALUES ('612052', 'SISTEM KOMUNIKASI SATELIT', 2);
INSERT INTO `tk_master_mk` VALUES ('612059', 'TEORI DAN PERENCANAAN ANTENA', 2);
INSERT INTO `tk_master_mk` VALUES ('612060', 'KOMUNIKASI DATA', 2);
INSERT INTO `tk_master_mk` VALUES ('612063', 'DIGITAL SWITCHING TELEPHONY', 3);
INSERT INTO `tk_master_mk` VALUES ('612067', 'SISTEM PEMANCAR DAN PENERIMA R', 2);
INSERT INTO `tk_master_mk` VALUES ('612101', 'MEDAN ELEKTROMAGNET I', 3);
INSERT INTO `tk_master_mk` VALUES ('612102', 'MEDAN ELEKTROMAGNET II', 3);
INSERT INTO `tk_master_mk` VALUES ('612103', 'DASAR SISTEM TELEKOMUNIKASI', 3);
INSERT INTO `tk_master_mk` VALUES ('612104', 'SISTEM TELEKOMUNIKASI', 2);
INSERT INTO `tk_master_mk` VALUES ('612105', 'ELEKTRONIKA KOMUNIKASI', 2);
INSERT INTO `tk_master_mk` VALUES ('612106', 'PENGUKURAN SIST. TELEKOMUNIKAS', 2);
INSERT INTO `tk_master_mk` VALUES ('612107', 'SISTEM KOMUNIKASI SATELIT', 2);
INSERT INTO `tk_master_mk` VALUES ('612108', 'SISTEM KOMUNIKASI BERGERAK', 2);
INSERT INTO `tk_master_mk` VALUES ('612109', 'KOMUNIKASI DATA', 2);
INSERT INTO `tk_master_mk` VALUES ('613001', 'DASAR TEKNIK TENAGA LISTRIK', 3);
INSERT INTO `tk_master_mk` VALUES ('613010', 'PENGUKURAN LISTRIK', 3);
INSERT INTO `tk_master_mk` VALUES ('613021', 'TEKNIK TENAGA LISTRIK I', 2);
INSERT INTO `tk_master_mk` VALUES ('613022', 'TEKNIK TENAGA LISTRIK II', 2);
INSERT INTO `tk_master_mk` VALUES ('613043', 'DISTR. & INSTALASI TENAGA LIST', 2);
INSERT INTO `tk_master_mk` VALUES ('613101', 'PENGUKURAN LISTRIK', 2);
INSERT INTO `tk_master_mk` VALUES ('613102', 'DASAR TEKNIK TENAGA LISTRIK', 3);
INSERT INTO `tk_master_mk` VALUES ('613103', 'ELEKTRONIKA DAYA', 3);
INSERT INTO `tk_master_mk` VALUES ('614018', 'SISTEM PENGATURAN & PENGUKURAN', 3);
INSERT INTO `tk_master_mk` VALUES ('614019', 'SISTEM PENGATURAN & PENGUKURAN', 3);
INSERT INTO `tk_master_mk` VALUES ('614060', 'DASAR PENGATURAN', 3);
INSERT INTO `tk_master_mk` VALUES ('614064', 'SISTEM PENGATURAN OPTIMAL', 3);
INSERT INTO `tk_master_mk` VALUES ('614066', 'SISTEM PENGATURAN DISKRIT', 3);
INSERT INTO `tk_master_mk` VALUES ('614070', 'ANALISA SINYAL DAN SISTEM', 3);
INSERT INTO `tk_master_mk` VALUES ('614101', 'SISTEM PEMROSESAN SINYAL', 2);
INSERT INTO `tk_master_mk` VALUES ('614102', 'DASAR SISTEM PENGATURAN', 3);
INSERT INTO `tk_master_mk` VALUES ('614103', 'SISTEM PENGATURAN DIGITAL', 3);
INSERT INTO `tk_master_mk` VALUES ('614104', 'PEMODELAN DAN SIMULASI', 3);
INSERT INTO `tk_master_mk` VALUES ('614105', 'SISTEM PENGATURAN OPTIMAL', 3);
INSERT INTO `tk_master_mk` VALUES ('614106', 'SISTEM PENGATURAN MULTIVARIABE', 3);
INSERT INTO `tk_master_mk` VALUES ('615013', 'RANGKAIAN LOGIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('615040', 'PRAKTIKUM MIKROPROSESOR', 1);
INSERT INTO `tk_master_mk` VALUES ('615047', 'ORGANISASI KOMPUTER LANJUTAN', 3);
INSERT INTO `tk_master_mk` VALUES ('615049', 'MIKROPROSESOR', 3);
INSERT INTO `tk_master_mk` VALUES ('615054', 'RANGKAIAN & KOMPONEN DIGITAL', 3);
INSERT INTO `tk_master_mk` VALUES ('615060', 'MIKROPROSESOR I', 4);
INSERT INTO `tk_master_mk` VALUES ('615062', 'DIGITAL SIGNAL PROCESSING', 3);
INSERT INTO `tk_master_mk` VALUES ('615070', 'MIKROPROSESOR II', 2);
INSERT INTO `tk_master_mk` VALUES ('615071', 'SWITCHING THEORY', 3);
INSERT INTO `tk_master_mk` VALUES ('615072', 'ARSITEKTUR KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('615073', 'ASSEMBLY LANGUAGE', 3);
INSERT INTO `tk_master_mk` VALUES ('615074', 'ORGANISASI KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('615076', 'RANGKAIAN ANTAR MUKA', 3);
INSERT INTO `tk_master_mk` VALUES ('615077', 'DESAIN LOGIKA TERPROGRAM', 3);
INSERT INTO `tk_master_mk` VALUES ('615078', 'DESAIN DIGITAL', 3);
INSERT INTO `tk_master_mk` VALUES ('615101', 'RANGKAIAN LOGIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('615102', 'ORG. & ARSITEKTUR KOMP. I', 3);
INSERT INTO `tk_master_mk` VALUES ('615103', 'PERANCANGAN SIST. DIGITAL', 3);
INSERT INTO `tk_master_mk` VALUES ('615104', 'MIKROPROCESSOR I', 4);
INSERT INTO `tk_master_mk` VALUES ('615105', 'MIKROPROCESSOR II', 2);
INSERT INTO `tk_master_mk` VALUES ('615106', 'ORGNS. DAN ARST. KOMPT II', 2);
INSERT INTO `tk_master_mk` VALUES ('615107', 'ARSITEKTUR JARINGAN KOMPUTER', 2);
INSERT INTO `tk_master_mk` VALUES ('618032', 'RANGKAIAN LISTRIK', 3);
INSERT INTO `tk_master_mk` VALUES ('618033', 'ELEKTRONIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('618034', 'TEKNIK TENAGA LISTRIK', 3);
INSERT INTO `tk_master_mk` VALUES ('618035', 'TEKNIK TENAGA LISTRIK', 3);
INSERT INTO `tk_master_mk` VALUES ('618065', 'ELEKTRONIKA INDUSTRI', 2);
INSERT INTO `tk_master_mk` VALUES ('618101', 'TEKNIK TENAGA LISTRIK', 2);
INSERT INTO `tk_master_mk` VALUES ('619003', 'PRAKTIKUM FISIKA', 1);
INSERT INTO `tk_master_mk` VALUES ('619009', 'PRAKTIKUM RANGKAIAN LISTRIK', 1);
INSERT INTO `tk_master_mk` VALUES ('619011', 'PRAKT. PENGUKURAN LISTRIK', 1);
INSERT INTO `tk_master_mk` VALUES ('619014', 'PRAK.RANGKAIAN LOGIKA', 1);
INSERT INTO `tk_master_mk` VALUES ('619017', 'PRAKTIKUM ELEKTRONIKA', 1);
INSERT INTO `tk_master_mk` VALUES ('619018', 'PRAKTIKUM ELEKTRONIKA INDUSTRI', 1);
INSERT INTO `tk_master_mk` VALUES ('619020', 'PRAKTIKUM S.P.P', 1);
INSERT INTO `tk_master_mk` VALUES ('619023', 'PRAKTIKUM TEKNIK TENAGA LISTRI', 1);
INSERT INTO `tk_master_mk` VALUES ('619026', 'PRAKTIKUM DASAR SISTEM KOMUNIK', 1);
INSERT INTO `tk_master_mk` VALUES ('619030', 'PRAKTIKUM RANG. LISTRIK', 2);
INSERT INTO `tk_master_mk` VALUES ('619101', 'PRAKTIKUM RANGKAIAN LISTRIK', 1);
INSERT INTO `tk_master_mk` VALUES ('619102', 'PRAKTIKUM RANGKAIAN LOGIKA', 1);
INSERT INTO `tk_master_mk` VALUES ('619103', 'PRAKTIKUM ELEKTRONIKA', 1);
INSERT INTO `tk_master_mk` VALUES ('619901', 'Orientasi Studi Teknik Elektro', 0);
INSERT INTO `tk_master_mk` VALUES ('619999', 'Tugas Akhir', 4);
INSERT INTO `tk_master_mk` VALUES ('620990', 'PES.UJ.NEGARA LULUS S-1 LOKAL', 0);
INSERT INTO `tk_master_mk` VALUES ('621001', 'KIMIA DASAR', 2);
INSERT INTO `tk_master_mk` VALUES ('621009', 'PENGETAHUAN LINGK. HIDUP', 2);
INSERT INTO `tk_master_mk` VALUES ('621010', 'AZAS TEKNIK KIMIA', 3);
INSERT INTO `tk_master_mk` VALUES ('621011', 'MATEMATIKA TEKNIK KIMIA', 3);
INSERT INTO `tk_master_mk` VALUES ('621012', 'KIMIA ORGANIK II', 3);
INSERT INTO `tk_master_mk` VALUES ('621013', 'PROGRAM KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('621016', 'STATIKA DINAMIKA', 2);
INSERT INTO `tk_master_mk` VALUES ('621017', 'ASAS TEKNIK KIMIA I', 3);
INSERT INTO `tk_master_mk` VALUES ('621117', 'Azas Teknik Kimia', 3);
INSERT INTO `tk_master_mk` VALUES ('622003', 'SUMBER-SUMBER ALAM', 3);
INSERT INTO `tk_master_mk` VALUES ('622005', 'KIMIA ANALITIK I', 3);
INSERT INTO `tk_master_mk` VALUES ('622007', 'KIMIA ORGANIK I', 3);
INSERT INTO `tk_master_mk` VALUES ('622008', 'KIMIA ANALITIK II', 3);
INSERT INTO `tk_master_mk` VALUES ('622009', 'PENGANTAR TEKNIK KIMIA', 2);
INSERT INTO `tk_master_mk` VALUES ('622012', 'KIMIA ORGANIK II', 3);
INSERT INTO `tk_master_mk` VALUES ('622014', 'KIMIA FISIKA I', 3);
INSERT INTO `tk_master_mk` VALUES ('622017', 'KIMIA FISIKA II', 3);
INSERT INTO `tk_master_mk` VALUES ('622019', 'BAHAN KONSTRUKSI TEKNIK KIMIA', 2);
INSERT INTO `tk_master_mk` VALUES ('622020', 'TERMODINAMIKA I', 3);
INSERT INTO `tk_master_mk` VALUES ('622022', 'KINETIKA DAN KATALISA', 3);
INSERT INTO `tk_master_mk` VALUES ('622023', 'THERMODINAMIKA II', 3);
INSERT INTO `tk_master_mk` VALUES ('622024', 'KIMIA ANALITIK I', 2);
INSERT INTO `tk_master_mk` VALUES ('622025', 'KIMIA ANALITIK II', 2);
INSERT INTO `tk_master_mk` VALUES ('622026', 'MEKANIKA FLUIDA', 2);
INSERT INTO `tk_master_mk` VALUES ('622027', 'PERPINDAHAN MASSA & PANAS', 3);
INSERT INTO `tk_master_mk` VALUES ('622119', 'Bahan Konstruksi & Korosi', 2);
INSERT INTO `tk_master_mk` VALUES ('622122', 'Teknik Reaksi Kimia I', 3);
INSERT INTO `tk_master_mk` VALUES ('622123', 'Teknik Reaksi Kimia II', 3);
INSERT INTO `tk_master_mk` VALUES ('622126', 'Peristiwa Perpindahan I', 2);
INSERT INTO `tk_master_mk` VALUES ('622127', 'Peristiwa Perpindahan II', 4);
INSERT INTO `tk_master_mk` VALUES ('623015', 'PENGANTAR OPERASI TEKNIK KIMIA', 2);
INSERT INTO `tk_master_mk` VALUES ('623021', 'OPERASI TEKNIK KIMIA I', 3);
INSERT INTO `tk_master_mk` VALUES ('623024', 'OPERASI TEKNIK KIMIA II', 3);
INSERT INTO `tk_master_mk` VALUES ('623025', 'PROSES INDUSTRI KIMIA I', 3);
INSERT INTO `tk_master_mk` VALUES ('623028', 'PROSES INDUSTRI KIMIA II', 3);
INSERT INTO `tk_master_mk` VALUES ('623029', 'OPERASI TEKNIK KIMIA III', 3);
INSERT INTO `tk_master_mk` VALUES ('623030', 'Operasi Teknik Kimia III', 2);
INSERT INTO `tk_master_mk` VALUES ('623031', 'REAKTOR KIMIA', 3);
INSERT INTO `tk_master_mk` VALUES ('623032', 'PERANCANG ALAT I', 3);
INSERT INTO `tk_master_mk` VALUES ('623034', 'PENGENDALIAN PROSES', 3);
INSERT INTO `tk_master_mk` VALUES ('623035', 'PERANCANG PABRIK KIMIA', 3);
INSERT INTO `tk_master_mk` VALUES ('623036', 'LATIHAN PENELITIHAN', 3);
INSERT INTO `tk_master_mk` VALUES ('623037', 'PERPINDAHAN MASSA & PANAS', 2);
INSERT INTO `tk_master_mk` VALUES ('623038', 'Perancangan Alat II', 2);
INSERT INTO `tk_master_mk` VALUES ('623039', 'PERANCANGAN ALAT II', 3);
INSERT INTO `tk_master_mk` VALUES ('623040', 'PROSES INDUSTRI KIMIA', 3);
INSERT INTO `tk_master_mk` VALUES ('623041', 'ASAS TEKNIK KIMIA II', 2);
INSERT INTO `tk_master_mk` VALUES ('623042', 'MATEMATIKA TEKNIK KIMIA', 2);
INSERT INTO `tk_master_mk` VALUES ('623043', 'PERANCANGAN ALAT I', 2);
INSERT INTO `tk_master_mk` VALUES ('623044', 'TEKNOLOGI MINYAK BUMI', 3);
INSERT INTO `tk_master_mk` VALUES ('623045', 'PETROKIMIA', 3);
INSERT INTO `tk_master_mk` VALUES ('623046', 'TEKNIK NUKLIR', 3);
INSERT INTO `tk_master_mk` VALUES ('623047', 'TEKNIK KOROSI', 3);
INSERT INTO `tk_master_mk` VALUES ('623048', 'KESETIMBANGAN FASE', 3);
INSERT INTO `tk_master_mk` VALUES ('623049', 'PENGENDALIAN PROSES LANJUTAN', 3);
INSERT INTO `tk_master_mk` VALUES ('623050', 'TRANSPORT PHENOMENA', 3);
INSERT INTO `tk_master_mk` VALUES ('623051', 'TEKNIK FLUIDISASI', 3);
INSERT INTO `tk_master_mk` VALUES ('623052', 'PROSES DESIGN', 3);
INSERT INTO `tk_master_mk` VALUES ('623053', 'TEKNOLOGI GULA', 3);
INSERT INTO `tk_master_mk` VALUES ('623054', 'TEKNOLOGI BAHAN MAKANAN', 3);
INSERT INTO `tk_master_mk` VALUES ('623055', 'MIKROBIOLOGI INDUSTRI', 2);
INSERT INTO `tk_master_mk` VALUES ('623056', 'PENGENDALIAN POLUSI AIR DAN UD', 3);
INSERT INTO `tk_master_mk` VALUES ('623057', 'TEKNOLOGI POLIMER', 3);
INSERT INTO `tk_master_mk` VALUES ('623059', 'PERANCANGAN ALAT III', 3);
INSERT INTO `tk_master_mk` VALUES ('623101', 'TERMODINAMIKA LANJUT', 3);
INSERT INTO `tk_master_mk` VALUES ('623102', 'PENGENDALIAN PROSES LANJUTAN', 3);
INSERT INTO `tk_master_mk` VALUES ('623103', 'PERANCANGAN ALAT III', 3);
INSERT INTO `tk_master_mk` VALUES ('623104', 'TEKNIK FLUIDISASI', 3);
INSERT INTO `tk_master_mk` VALUES ('623105', 'OPTIMASI PROSES', 3);
INSERT INTO `tk_master_mk` VALUES ('623106', 'TRANSPORT PHENOMENA', 3);
INSERT INTO `tk_master_mk` VALUES ('623107', 'PERANCANGAN PROSES', 3);
INSERT INTO `tk_master_mk` VALUES ('623108', 'PEMISAHAN MULTI KOMPONEN', 3);
INSERT INTO `tk_master_mk` VALUES ('623109', 'PERPIN. MASSA DISERTAI REAKSI', 3);
INSERT INTO `tk_master_mk` VALUES ('623110', 'Teknik Fluidisasi', 2);
INSERT INTO `tk_master_mk` VALUES ('623111', 'Optimasi Proses', 2);
INSERT INTO `tk_master_mk` VALUES ('623112', 'Perancangan Proses', 2);
INSERT INTO `tk_master_mk` VALUES ('623113', 'Pemisahan Multi Komponen', 2);
INSERT INTO `tk_master_mk` VALUES ('623114', 'Perpin.Massa Disertai Reaksi K', 2);
INSERT INTO `tk_master_mk` VALUES ('623201', 'PENGANTAR TEKNIK POLIMER', 2);
INSERT INTO `tk_master_mk` VALUES ('623202', 'TEKNOLOGI POLIMER', 3);
INSERT INTO `tk_master_mk` VALUES ('623203', 'TEKNOLOGI PLASTIK', 3);
INSERT INTO `tk_master_mk` VALUES ('623205', 'TEKNOLOGI MEMBRAN', 3);
INSERT INTO `tk_master_mk` VALUES ('623206', 'Teknologi Polimer', 2);
INSERT INTO `tk_master_mk` VALUES ('623207', 'Teknologi Membran', 2);
INSERT INTO `tk_master_mk` VALUES ('623208', 'Pengantar Teknologi Polimer', 3);
INSERT INTO `tk_master_mk` VALUES ('623300', 'PENG. TEKNOLOGI BIOPROSES', 3);
INSERT INTO `tk_master_mk` VALUES ('623301', 'MIKROBIOLOGI INDUSTRI', 2);
INSERT INTO `tk_master_mk` VALUES ('623302', 'TEKNIK FERMENTASI', 3);
INSERT INTO `tk_master_mk` VALUES ('623303', 'REKAYASA BIOKIMIA', 3);
INSERT INTO `tk_master_mk` VALUES ('623305', 'BIOSEPARASI', 3);
INSERT INTO `tk_master_mk` VALUES ('623306', 'BIOREMEDIASI', 3);
INSERT INTO `tk_master_mk` VALUES ('623307', 'TEKNOLOGI PENG. AIR BUANGAN', 3);
INSERT INTO `tk_master_mk` VALUES ('623308', 'TEK. PENG. AIR BUANGAN LANJUT', 3);
INSERT INTO `tk_master_mk` VALUES ('623309', 'TEKNOLOGI PROSES LINGKUNGAN', 2);
INSERT INTO `tk_master_mk` VALUES ('623310', 'MANAJEMEN LINGKUNGAN', 3);
INSERT INTO `tk_master_mk` VALUES ('623311', 'Teknik Fermentasi', 2);
INSERT INTO `tk_master_mk` VALUES ('623312', 'Rekayasa Biokimia', 2);
INSERT INTO `tk_master_mk` VALUES ('623313', 'Bio Separasi', 2);
INSERT INTO `tk_master_mk` VALUES ('623314', 'Tek.Pengolahan Air Buangan', 2);
INSERT INTO `tk_master_mk` VALUES ('623315', 'Tek.Peng. Air Buangan Lanjut', 2);
INSERT INTO `tk_master_mk` VALUES ('623316', 'Manajemen Lingkungan', 2);
INSERT INTO `tk_master_mk` VALUES ('623317', 'Bioremediasi', 2);
INSERT INTO `tk_master_mk` VALUES ('623318', 'BIOREAKTOR', 2);
INSERT INTO `tk_master_mk` VALUES ('623320', 'Pencegahan Polusi', 2);
INSERT INTO `tk_master_mk` VALUES ('623401', 'TEKNOLOGI AIR', 2);
INSERT INTO `tk_master_mk` VALUES ('623402', 'TEKNIK PENGOLAHAN AIR BUANGAN', 3);
INSERT INTO `tk_master_mk` VALUES ('624004', 'MENGGAMBAR TEKNIK', 2);
INSERT INTO `tk_master_mk` VALUES ('624027', 'TEKNOLOGI AIR', 2);
INSERT INTO `tk_master_mk` VALUES ('624031', 'UTILITAS', 3);
INSERT INTO `tk_master_mk` VALUES ('624038', 'TEKNIK PEMBAKARAN', 2);
INSERT INTO `tk_master_mk` VALUES ('624058', 'EKONOMI TEKNIK', 3);
INSERT INTO `tk_master_mk` VALUES ('624158', 'Ekonomi Teknik', 2);
INSERT INTO `tk_master_mk` VALUES ('625033', 'KERJA PRAKTEK', 2);
INSERT INTO `tk_master_mk` VALUES ('625040', 'PRA RENCANA PABRIK', 6);
INSERT INTO `tk_master_mk` VALUES ('625041', 'PRARENCANA PABRIK', 3);
INSERT INTO `tk_master_mk` VALUES ('627065', 'INDUSTRI KIMIA', 2);
INSERT INTO `tk_master_mk` VALUES ('629002', 'PRAKTIKUM KIMIA DASAR', 1);
INSERT INTO `tk_master_mk` VALUES ('629006', 'PRAKT.KIMIA ANALITIK I', 1);
INSERT INTO `tk_master_mk` VALUES ('629013', 'PRAKTIKUM KIMIA ORGANIK', 2);
INSERT INTO `tk_master_mk` VALUES ('629014', 'PRAK.KIMIA ANALITIK II', 1);
INSERT INTO `tk_master_mk` VALUES ('629018', 'PRAKTIKUM KIMIA FISIKA', 2);
INSERT INTO `tk_master_mk` VALUES ('629026', 'PRAKT.OPERASI TEKNIK KIMIA I', 2);
INSERT INTO `tk_master_mk` VALUES ('629030', 'PRAKT.OPERASI TEKNIK KIMIA II', 2);
INSERT INTO `tk_master_mk` VALUES ('630990', 'PES.UJ.NEGARA LULUS S-1 LOKAL', 0);
INSERT INTO `tk_master_mk` VALUES ('631001', 'PENGANTAR TEKNIK INDUSTRI', 3);
INSERT INTO `tk_master_mk` VALUES ('631002', 'BAHASA INGGRIS', 2);
INSERT INTO `tk_master_mk` VALUES ('631003', 'MENGGAMBAR MESIN', 2);
INSERT INTO `tk_master_mk` VALUES ('631004', 'KONSEP TEKNOLOGI', 2);
INSERT INTO `tk_master_mk` VALUES ('631005', 'BAHASA INDONESIA', 2);
INSERT INTO `tk_master_mk` VALUES ('631006', 'PENGANTAR ILMU EKONOMI', 2);
INSERT INTO `tk_master_mk` VALUES ('631007', 'TEKNOLOGI MEKANIK', 3);
INSERT INTO `tk_master_mk` VALUES ('631008', 'ILMU LOGAM', 3);
INSERT INTO `tk_master_mk` VALUES ('631009', 'PSIKOLOGI INDUSTRI', 2);
INSERT INTO `tk_master_mk` VALUES ('631010', 'MEKANIKA TEKNIK', 3);
INSERT INTO `tk_master_mk` VALUES ('631011', 'TATA HITUNG ONGKOS', 3);
INSERT INTO `tk_master_mk` VALUES ('631013', 'METODOLOGI PENELITIAN', 2);
INSERT INTO `tk_master_mk` VALUES ('631014', 'ELEMEN MESIN', 3);
INSERT INTO `tk_master_mk` VALUES ('631015', 'PENYELID. OPERASIONAL DETERMIN', 3);
INSERT INTO `tk_master_mk` VALUES ('631016', 'EKONOMI TEKNIK', 3);
INSERT INTO `tk_master_mk` VALUES ('631017', 'ERGONOMI', 2);
INSERT INTO `tk_master_mk` VALUES ('631018', 'TEORI DASAR SISTEM', 2);
INSERT INTO `tk_master_mk` VALUES ('631019', 'STATISTIK INDUSTRI II', 3);
INSERT INTO `tk_master_mk` VALUES ('631020', 'PRAKTIKUM STATISTIK', 1);
INSERT INTO `tk_master_mk` VALUES ('631021', 'SOSIOLOGI INDUSTRI', 2);
INSERT INTO `tk_master_mk` VALUES ('631022', 'KONTRUKSI BANGUNAN MESIN', 2);
INSERT INTO `tk_master_mk` VALUES ('631023', 'PENYELID. OPERASIONAL PROBABIL', 3);
INSERT INTO `tk_master_mk` VALUES ('631024', 'TEKNIK TATA CARA & PENGUKURAN', 2);
INSERT INTO `tk_master_mk` VALUES ('631025', 'PRAK.TEK.TATA CARA & PENGUK. K', 1);
INSERT INTO `tk_master_mk` VALUES ('631026', 'PENGUKURAN DIMENSIONIL', 3);
INSERT INTO `tk_master_mk` VALUES ('631027', 'TT. LETAK PABRIK & PEMINDAHAN', 3);
INSERT INTO `tk_master_mk` VALUES ('631028', 'SISTEM MANUSIA MESIN', 3);
INSERT INTO `tk_master_mk` VALUES ('631029', 'ORGANISASI & MANAJEMEN INDUSTR', 2);
INSERT INTO `tk_master_mk` VALUES ('631030', 'PERENCANAAN & PENGENDALIAN PRO', 3);
INSERT INTO `tk_master_mk` VALUES ('631031', 'PENGGERAK MULA', 2);
INSERT INTO `tk_master_mk` VALUES ('631032', 'DESAIN EKSPERIMEN', 3);
INSERT INTO `tk_master_mk` VALUES ('631033', 'MANAJEMEN PEMASARAN', 2);
INSERT INTO `tk_master_mk` VALUES ('631034', 'TEORI PENGAMBILAN KEPUTUSAN', 3);
INSERT INTO `tk_master_mk` VALUES ('631035', 'KESELAMATAN KERJA', 2);
INSERT INTO `tk_master_mk` VALUES ('631036', 'PENGENDALIAN KUALITAS', 3);
INSERT INTO `tk_master_mk` VALUES ('631037', 'MANAJEMEN PERSONALIA', 2);
INSERT INTO `tk_master_mk` VALUES ('631038', 'PERENCANAAN INDUSTRI', 2);
INSERT INTO `tk_master_mk` VALUES ('631040', 'MANAJEMEN MATERIAL', 3);
INSERT INTO `tk_master_mk` VALUES ('631041', 'HUKUM PERBURUHAN & MILIK PERUS', 2);
INSERT INTO `tk_master_mk` VALUES ('631042', 'KERJA PRAKTEK TEKNIK PRODUKSI', 1);
INSERT INTO `tk_master_mk` VALUES ('631043', 'KERJA PRAKTEK MANAJEMEN INDUST', 1);
INSERT INTO `tk_master_mk` VALUES ('631044', 'SEMINAR', 3);
INSERT INTO `tk_master_mk` VALUES ('631046', 'SISTEM INFORMASI MANAJEMEN', 3);
INSERT INTO `tk_master_mk` VALUES ('631057', 'MANAJEMEN', 3);
INSERT INTO `tk_master_mk` VALUES ('631058', 'STATISTIK INDUSTRI I', 3);
INSERT INTO `tk_master_mk` VALUES ('631059', 'MANAJEMEN INDUSTRI', 2);
INSERT INTO `tk_master_mk` VALUES ('631060', 'STATISTIK', 3);
INSERT INTO `tk_master_mk` VALUES ('631061', 'STATISTIK', 3);
INSERT INTO `tk_master_mk` VALUES ('631062', 'PENYELIDIKAN OPERASIONAL', 3);
INSERT INTO `tk_master_mk` VALUES ('631063', 'PEMODELAN SISTEM', 3);
INSERT INTO `tk_master_mk` VALUES ('631064', 'SIMULASI SISTEM INDUSTRI', 3);
INSERT INTO `tk_master_mk` VALUES ('631065', 'SISTEM MANUFAKTURING INDUSTRI', 3);
INSERT INTO `tk_master_mk` VALUES ('631066', 'ANALISA SISTEM', 3);
INSERT INTO `tk_master_mk` VALUES ('631067', 'TEORI GRAFIK DAN JARING KERJA', 3);
INSERT INTO `tk_master_mk` VALUES ('631068', 'TEKNIK KETERANDALAN', 3);
INSERT INTO `tk_master_mk` VALUES ('631069', 'TEKNIK PERAMALAN', 3);
INSERT INTO `tk_master_mk` VALUES ('631070', 'ADMINISTRASI PERUPAHAN', 3);
INSERT INTO `tk_master_mk` VALUES ('631071', 'ANALISA FINANSIAL', 3);
INSERT INTO `tk_master_mk` VALUES ('631072', 'TOPIK KHUSUS TEKNIK & MANAJEME', 3);
INSERT INTO `tk_master_mk` VALUES ('631073', 'TEORI KEMUNGKINAN', 3);
INSERT INTO `tk_master_mk` VALUES ('631074', 'PENGUKURAN DIMENSIONAL', 2);
INSERT INTO `tk_master_mk` VALUES ('631075', 'PERILAKU ORGANISASI', 3);
INSERT INTO `tk_master_mk` VALUES ('631077', 'ANALISIS PRODUKTIVITAS', 3);
INSERT INTO `tk_master_mk` VALUES ('631078', 'METROLOGI INDUSTRI', 2);
INSERT INTO `tk_master_mk` VALUES ('631079', 'CNC PROGRAMMING', 3);
INSERT INTO `tk_master_mk` VALUES ('631080', 'MANAJEMEN OPERASIONAL', 3);
INSERT INTO `tk_master_mk` VALUES ('631081', 'MANAJEMEN KUALITAS', 3);
INSERT INTO `tk_master_mk` VALUES ('631082', 'MANAJEMEN SUMBER DAYA MANUSIA', 2);
INSERT INTO `tk_master_mk` VALUES ('631083', 'PENGETAHUAN BAHAN TEKNIK', 3);
INSERT INTO `tk_master_mk` VALUES ('631084', 'MANAJEMEN PROYEK', 3);
INSERT INTO `tk_master_mk` VALUES ('631085', 'REKAYASA NILAI & PERANC.P.', 3);
INSERT INTO `tk_master_mk` VALUES ('631086', 'P.P.B.', 2);
INSERT INTO `tk_master_mk` VALUES ('631087', 'PROSES MANUFAKTUR', 3);
INSERT INTO `tk_master_mk` VALUES ('631088', 'DESAIN EKSPERIMEN', 2);
INSERT INTO `tk_master_mk` VALUES ('631090', 'APLIKASI TEKNIK & MAN.IND.', 0);
INSERT INTO `tk_master_mk` VALUES ('631091', 'M.S.D.M.', 2);
INSERT INTO `tk_master_mk` VALUES ('631099', 'TUGAS AKHIR SARJANA', 6);
INSERT INTO `tk_master_mk` VALUES ('631152', 'PRAK. PROSES MANUFAKTUR', 1);
INSERT INTO `tk_master_mk` VALUES ('631164', 'PRAK. ANALISIS & PERANC. KERJA', 1);
INSERT INTO `tk_master_mk` VALUES ('631184', 'KERJA PRAKTEK I', 1);
INSERT INTO `tk_master_mk` VALUES ('631185', 'KERJA PRAKTEK II', 1);
INSERT INTO `tk_master_mk` VALUES ('631212', 'PENGANTAR ILMU EKONOMI', 2);
INSERT INTO `tk_master_mk` VALUES ('631222', 'PSIKOLOGI INDUSTRI', 2);
INSERT INTO `tk_master_mk` VALUES ('631223', 'KONSEP TEKNOLOGI', 2);
INSERT INTO `tk_master_mk` VALUES ('631242', 'TEKNIK PERAMALAN', 2);
INSERT INTO `tk_master_mk` VALUES ('631251', 'PROSES MANUFAKTUR II', 2);
INSERT INTO `tk_master_mk` VALUES ('631255', 'ERGONOMI', 2);
INSERT INTO `tk_master_mk` VALUES ('631258', 'MANAJEMEN PEMASARAN', 2);
INSERT INTO `tk_master_mk` VALUES ('631261', 'ANALISA KEPUTUSAN', 2);
INSERT INTO `tk_master_mk` VALUES ('631262', 'ORG. & MANAJEMEN INDUSTRI', 2);
INSERT INTO `tk_master_mk` VALUES ('631271', 'METODOLOGI PENELITIAN', 2);
INSERT INTO `tk_master_mk` VALUES ('631273', 'PERENC. & PERANC. PRODUK', 2);
INSERT INTO `tk_master_mk` VALUES ('631274', 'KESELAMATAN KERJA', 2);
INSERT INTO `tk_master_mk` VALUES ('631276', 'MANAJ. SUMBER DAYA MANUSIA', 2);
INSERT INTO `tk_master_mk` VALUES ('631281', 'SISTEM INFORMASI MANAJEMEN', 2);
INSERT INTO `tk_master_mk` VALUES ('631282', 'SIMULASI SISTEM INDUSTRI', 2);
INSERT INTO `tk_master_mk` VALUES ('631283', 'PERENCANAAN INDUSTRI', 2);
INSERT INTO `tk_master_mk` VALUES ('631311', 'PENGANTAR TEKNIK INDUSTRI', 3);
INSERT INTO `tk_master_mk` VALUES ('631321', 'MENGG. TEKNIK & MET. INDUSTRI', 3);
INSERT INTO `tk_master_mk` VALUES ('631324', 'STATISTIK INDUSTRI I', 3);
INSERT INTO `tk_master_mk` VALUES ('631331', 'PENGETAHUAN BAHAN TEKNIK', 3);
INSERT INTO `tk_master_mk` VALUES ('631332', 'EKONOMI TEKNIK', 3);
INSERT INTO `tk_master_mk` VALUES ('631333', 'STATISTIK INDUSTRI II', 3);
INSERT INTO `tk_master_mk` VALUES ('631341', 'PROSES MANUFAKTUR I', 3);
INSERT INTO `tk_master_mk` VALUES ('631343', 'AKUNTANSI BIAYA', 3);
INSERT INTO `tk_master_mk` VALUES ('631344', 'PENYELIDIKAN OPERASIONAL I', 3);
INSERT INTO `tk_master_mk` VALUES ('631353', 'ANALISIS & PERANC. KERJA', 3);
INSERT INTO `tk_master_mk` VALUES ('631354', 'TEKNIK DASAR & PERMODELAN SIST', 3);
INSERT INTO `tk_master_mk` VALUES ('631356', 'PENYELIDIKAN OPERASIONAL II', 3);
INSERT INTO `tk_master_mk` VALUES ('631357', 'T L P & PEMINDAHAN BAHAN', 3);
INSERT INTO `tk_master_mk` VALUES ('631363', 'PENG. KUALITAS STATISTIK', 3);
INSERT INTO `tk_master_mk` VALUES ('631365', 'MANAJEMEN MATERIAL', 3);
INSERT INTO `tk_master_mk` VALUES ('631366', 'MANAJEMEN KEUANGAN', 3);
INSERT INTO `tk_master_mk` VALUES ('631372', 'PERENC. & PENGEND. PRODUKSI', 3);
INSERT INTO `tk_master_mk` VALUES ('631375', 'SISTEM MANUFAKTURING INDUSTRI', 3);
INSERT INTO `tk_master_mk` VALUES ('631586', 'TUGAS AKHIR', 5);
INSERT INTO `tk_master_mk` VALUES ('632201', 'MANAJEMEN KUALITAS', 2);
INSERT INTO `tk_master_mk` VALUES ('632202', 'KEWIRAUSAHAAN', 2);
INSERT INTO `tk_master_mk` VALUES ('632203', 'PERILAKU ORGANISASI', 2);
INSERT INTO `tk_master_mk` VALUES ('632204', 'EKONOMI INDUSTRI', 2);
INSERT INTO `tk_master_mk` VALUES ('632205', 'EKONOMETRI', 2);
INSERT INTO `tk_master_mk` VALUES ('632206', 'AKUNTANSI MANAJERIAL', 2);
INSERT INTO `tk_master_mk` VALUES ('632207', 'EKONOMI MANAJERIAL', 2);
INSERT INTO `tk_master_mk` VALUES ('632208', 'MULTI CRITERIA DECISION MAKING', 2);
INSERT INTO `tk_master_mk` VALUES ('632209', 'DECISION SUPPORT SYSTEM', 2);
INSERT INTO `tk_master_mk` VALUES ('632210', 'EXPERT SYSTEM', 2);
INSERT INTO `tk_master_mk` VALUES ('632211', 'ANALISA MULTI VARIABEL', 2);
INSERT INTO `tk_master_mk` VALUES ('632212', 'MANAJEMEN TEKNOLOGI', 2);
INSERT INTO `tk_master_mk` VALUES ('632213', 'TOPIK KHUSUS', 2);
INSERT INTO `tk_master_mk` VALUES ('632601', 'TUGAS MENGGAMBAR MESIN', 3);
INSERT INTO `tk_master_mk` VALUES ('633041', 'LOGIKA DAN ALGORITMA', 3);
INSERT INTO `tk_master_mk` VALUES ('633201', 'CNC PROGRAMMING', 2);
INSERT INTO `tk_master_mk` VALUES ('633202', 'CAD/CAM', 2);
INSERT INTO `tk_master_mk` VALUES ('633203', 'TEKNIK KETERANDALAN', 2);
INSERT INTO `tk_master_mk` VALUES ('633204', 'MANAJEMEN PERAWATAN', 2);
INSERT INTO `tk_master_mk` VALUES ('633205', 'ANALISA PRODUKTIVITAS', 2);
INSERT INTO `tk_master_mk` VALUES ('633206', 'MANEJEMEN PROYEK', 2);
INSERT INTO `tk_master_mk` VALUES ('633207', 'DESAIN EKSPERIMEN', 2);
INSERT INTO `tk_master_mk` VALUES ('633208', 'ADMINISTRASI PERUPAHAN', 2);
INSERT INTO `tk_master_mk` VALUES ('633209', 'SISTEM MANUSIA MESIN', 2);
INSERT INTO `tk_master_mk` VALUES ('633210', 'SISTEM DINAMIS', 2);
INSERT INTO `tk_master_mk` VALUES ('633211', 'OTOMASI INDUSTRI', 2);
INSERT INTO `tk_master_mk` VALUES ('633212', 'TOPIK KHUSUS', 2);
INSERT INTO `tk_master_mk` VALUES ('634001', 'MANAJEMEN OPERASIONAL', 3);
INSERT INTO `tk_master_mk` VALUES ('634152', 'Praktikum Proses Manufaktur', 1);
INSERT INTO `tk_master_mk` VALUES ('634164', 'Praktikum APK', 1);
INSERT INTO `tk_master_mk` VALUES ('634185', 'Kerja Praktik I', 1);
INSERT INTO `tk_master_mk` VALUES ('634186', 'Kerja Praktik II', 1);
INSERT INTO `tk_master_mk` VALUES ('634212', 'Pengantar Ilmu Ekonomi', 2);
INSERT INTO `tk_master_mk` VALUES ('634222', 'Konsep Teknologi', 2);
INSERT INTO `tk_master_mk` VALUES ('634224', 'Psikologi Industri', 2);
INSERT INTO `tk_master_mk` VALUES ('634233', 'T T L & Manajemen Energi', 2);
INSERT INTO `tk_master_mk` VALUES ('634242', 'Teknik Peramalan', 2);
INSERT INTO `tk_master_mk` VALUES ('634251', 'Proses Manufaktur II', 2);
INSERT INTO `tk_master_mk` VALUES ('634254', 'Ergonomi', 2);
INSERT INTO `tk_master_mk` VALUES ('634257', 'Manajemen Pemasaran', 2);
INSERT INTO `tk_master_mk` VALUES ('634261', 'Manajemen Organisasi', 2);
INSERT INTO `tk_master_mk` VALUES ('634262', 'Manajemen Sumber Daya Manusia', 2);
INSERT INTO `tk_master_mk` VALUES ('634265', 'Keselamatan Kerja', 2);
INSERT INTO `tk_master_mk` VALUES ('634271', 'Metodologi Penelitian', 2);
INSERT INTO `tk_master_mk` VALUES ('634273', 'Perenc. & Pengembangan Produk', 2);
INSERT INTO `tk_master_mk` VALUES ('634275', 'Sistem Informasi Manajemen', 2);
INSERT INTO `tk_master_mk` VALUES ('634281', 'Simulasi Sistem Industri', 2);
INSERT INTO `tk_master_mk` VALUES ('634282', 'Perencanaan Industri', 2);
INSERT INTO `tk_master_mk` VALUES ('634283', 'Manajemen Kualitas', 2);
INSERT INTO `tk_master_mk` VALUES ('634284', 'Kewirausahaan & Etika Bisnis', 2);
INSERT INTO `tk_master_mk` VALUES ('634311', 'Pengantar Teknik Industri', 3);
INSERT INTO `tk_master_mk` VALUES ('634321', 'Mengg.Teknik & Metrologi Indus', 3);
INSERT INTO `tk_master_mk` VALUES ('634323', 'Statistika Industri I', 3);
INSERT INTO `tk_master_mk` VALUES ('634331', 'Pengetahuan Bahan Teknik', 3);
INSERT INTO `tk_master_mk` VALUES ('634332', 'Ekonomi Teknik', 3);
INSERT INTO `tk_master_mk` VALUES ('634334', 'Statistika Industri II', 3);
INSERT INTO `tk_master_mk` VALUES ('634341', 'Proses Manufaktur I', 3);
INSERT INTO `tk_master_mk` VALUES ('634343', 'Analisis Biaya', 3);
INSERT INTO `tk_master_mk` VALUES ('634344', 'Penyelidikan Operasional I', 3);
INSERT INTO `tk_master_mk` VALUES ('634353', 'Analisis & Perancangan Kerja', 3);
INSERT INTO `tk_master_mk` VALUES ('634355', 'Penyelidikan Operasional II', 3);
INSERT INTO `tk_master_mk` VALUES ('634356', 'Pengend. Kualitas Statistik', 3);
INSERT INTO `tk_master_mk` VALUES ('634358', 'Manajemen Keuangan', 3);
INSERT INTO `tk_master_mk` VALUES ('634363', 'T L P & Pemindahan Bahan', 3);
INSERT INTO `tk_master_mk` VALUES ('634366', 'P.Produksi & Pengend.Pers. I', 3);
INSERT INTO `tk_master_mk` VALUES ('634367', 'Pemodelan Sistem', 3);
INSERT INTO `tk_master_mk` VALUES ('634372', 'P.Produksi & Pengend.Pers. II', 3);
INSERT INTO `tk_master_mk` VALUES ('634374', 'Sistem Manufaktur Industri', 3);
INSERT INTO `tk_master_mk` VALUES ('634587', 'Tugas Akhir', 5);
INSERT INTO `tk_master_mk` VALUES ('635211', 'Manajemen Perawatan', 2);
INSERT INTO `tk_master_mk` VALUES ('635212', 'Pemrograman CNC', 2);
INSERT INTO `tk_master_mk` VALUES ('635213', 'CAD/CAM', 2);
INSERT INTO `tk_master_mk` VALUES ('635214', 'Otomasi Industri', 2);
INSERT INTO `tk_master_mk` VALUES ('635219', 'Topik Khusus', 2);
INSERT INTO `tk_master_mk` VALUES ('635221', 'Analisis Keputusan', 2);
INSERT INTO `tk_master_mk` VALUES ('635222', 'Sistem Pendukung Keputusan', 2);
INSERT INTO `tk_master_mk` VALUES ('635223', 'Sistem Pakar', 2);
INSERT INTO `tk_master_mk` VALUES ('635229', 'Topik Khusus', 2);
INSERT INTO `tk_master_mk` VALUES ('635231', 'Ekonometri', 2);
INSERT INTO `tk_master_mk` VALUES ('635232', 'Analisis Multi Variabel', 2);
INSERT INTO `tk_master_mk` VALUES ('635233', 'Desain Eksperimen', 2);
INSERT INTO `tk_master_mk` VALUES ('635239', 'Topik Khusus', 2);
INSERT INTO `tk_master_mk` VALUES ('635241', 'Sistem Manusia Mesin', 2);
INSERT INTO `tk_master_mk` VALUES ('635242', 'Analisis Produktivitas', 2);
INSERT INTO `tk_master_mk` VALUES ('635249', 'Topik Khusus', 2);
INSERT INTO `tk_master_mk` VALUES ('635251', 'Manajemen Teknologi', 2);
INSERT INTO `tk_master_mk` VALUES ('635252', 'Manajemen Proyek', 2);
INSERT INTO `tk_master_mk` VALUES ('635253', 'Ekonomi Manajerial', 2);
INSERT INTO `tk_master_mk` VALUES ('635254', 'Manajemen Lingkungan', 2);
INSERT INTO `tk_master_mk` VALUES ('635255', 'Perilaku Organisasi', 2);
INSERT INTO `tk_master_mk` VALUES ('635259', 'Topik Khusus', 2);
INSERT INTO `tk_master_mk` VALUES ('636201', 'Dasar Dasar Manajemen', 2);
INSERT INTO `tk_master_mk` VALUES ('638065', 'ELEKTRONIKA INDUSTRI', 3);
INSERT INTO `tk_master_mk` VALUES ('639601', 'DASAR-DASAR MANAJEMEN', 2);
INSERT INTO `tk_master_mk` VALUES ('640131', 'ALGORITMA & PEMROGRAMAN I', 3);
INSERT INTO `tk_master_mk` VALUES ('640132', 'PRAK. ALG. & PEMROGRAMAN I', 1);
INSERT INTO `tk_master_mk` VALUES ('640181', 'PENGANTAR PDE', 2);
INSERT INTO `tk_master_mk` VALUES ('640193', 'KONSEP TEKNOLOGI', 2);
INSERT INTO `tk_master_mk` VALUES ('640221', 'RANGKAIAN LOGIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('640231', 'ALG. & PEMROGRAMAN II', 3);
INSERT INTO `tk_master_mk` VALUES ('640232', 'PRAK. ALG. & PEMROGRAMAN II', 1);
INSERT INTO `tk_master_mk` VALUES ('640311', 'MATEMATIKA DISKRIT', 3);
INSERT INTO `tk_master_mk` VALUES ('640321', 'ORGANISASI KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('640322', 'Program Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('640331', 'STRUKTUR DATA', 3);
INSERT INTO `tk_master_mk` VALUES ('640332', 'PRAKT. STRUKTUR DATA', 1);
INSERT INTO `tk_master_mk` VALUES ('640411', 'PENYELIDIKAN OPERASIONAL', 3);
INSERT INTO `tk_master_mk` VALUES ('640412', 'METODA NUMERIK', 3);
INSERT INTO `tk_master_mk` VALUES ('640421', 'BAHASA RAKITAN', 3);
INSERT INTO `tk_master_mk` VALUES ('640431', 'PEMR. BERORIENTASI OBYEK', 3);
INSERT INTO `tk_master_mk` VALUES ('640441', 'SISTEM BERKAS', 3);
INSERT INTO `tk_master_mk` VALUES ('640451', 'SISTEM OPERASI', 3);
INSERT INTO `tk_master_mk` VALUES ('640511', 'LOGIKA MATEMATIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('640531', 'DESAIN & ANALISA ALGORITMA', 3);
INSERT INTO `tk_master_mk` VALUES ('640541', 'BASIS DATA', 3);
INSERT INTO `tk_master_mk` VALUES ('640542', 'PRAK. BASIS DATA', 1);
INSERT INTO `tk_master_mk` VALUES ('640543', 'SISTEM INFORMASI', 3);
INSERT INTO `tk_master_mk` VALUES ('640561', 'GRAFIKA KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('640581', 'TEORI BAHASA & AUTOMATA', 3);
INSERT INTO `tk_master_mk` VALUES ('640641', 'REKAYASA PERANGKAT LUNAK', 3);
INSERT INTO `tk_master_mk` VALUES ('640642', 'SISTEM INFORMASI', 3);
INSERT INTO `tk_master_mk` VALUES ('640651', 'JARINGAN KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('640652', 'PRAK. JARINGAN KOMPUTER', 1);
INSERT INTO `tk_master_mk` VALUES ('640653', 'PENGAMAN SISTEM KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('640661', 'INTERAKSI MANUSIA KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('640681', 'TEKNIK KOMPILASI', 3);
INSERT INTO `tk_master_mk` VALUES ('640682', 'KECERDASAN BUATAN', 3);
INSERT INTO `tk_master_mk` VALUES ('640711', 'TEKNIK SIMULASI', 3);
INSERT INTO `tk_master_mk` VALUES ('640721', 'MIKROPROSESOR', 3);
INSERT INTO `tk_master_mk` VALUES ('640771', 'METODOLOGI PENELITIAN', 2);
INSERT INTO `tk_master_mk` VALUES ('640772', 'KERJA PRAKTIK', 2);
INSERT INTO `tk_master_mk` VALUES ('640851', 'PENGAMAN SISTEM KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('640871', 'TUGAS AKHIR', 6);
INSERT INTO `tk_master_mk` VALUES ('640990', 'PES.UJ.NEGARA LULUS S-1 LOKAL', 0);
INSERT INTO `tk_master_mk` VALUES ('641006', 'PEMROGRAMAN KOMPUTER I', 3);
INSERT INTO `tk_master_mk` VALUES ('641007', 'PEMROGRAMAN KOMPUTER II', 3);
INSERT INTO `tk_master_mk` VALUES ('641211', 'Konsep&Perkembangan Teknologi', 2);
INSERT INTO `tk_master_mk` VALUES ('641222', 'Pengantar Informatika', 2);
INSERT INTO `tk_master_mk` VALUES ('641313', 'PROGRAM KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('641421', 'Algoritma & Pemrograman', 4);
INSERT INTO `tk_master_mk` VALUES ('642001', 'MATEMATIKA I', 4);
INSERT INTO `tk_master_mk` VALUES ('642004', 'MATEMATIKA II', 4);
INSERT INTO `tk_master_mk` VALUES ('642010', 'MATEMATIKA IV', 3);
INSERT INTO `tk_master_mk` VALUES ('642101', 'MATEMATIKA LANJUT', 4);
INSERT INTO `tk_master_mk` VALUES ('642102', 'MATEMATIKA KOMPUTASI', 4);
INSERT INTO `tk_master_mk` VALUES ('642103', 'ANALISA NUMERIK', 3);
INSERT INTO `tk_master_mk` VALUES ('642321', 'Matematika Diskrit', 3);
INSERT INTO `tk_master_mk` VALUES ('642322', 'Logika Matematika', 3);
INSERT INTO `tk_master_mk` VALUES ('642323', 'Organisasi&Arsitektur Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('642324', 'Pemrograman Berorientasi Objek', 3);
INSERT INTO `tk_master_mk` VALUES ('643002', 'PENGANTAR INFORMATIKA', 2);
INSERT INTO `tk_master_mk` VALUES ('643007', 'MATEMATIKA III', 3);
INSERT INTO `tk_master_mk` VALUES ('643009', 'KOMPUTER & MASYARAKAT', 2);
INSERT INTO `tk_master_mk` VALUES ('643014', 'ANALISA NUMERIK I', 3);
INSERT INTO `tk_master_mk` VALUES ('643015', 'SISTEM INFORMASI MANAJEMEN', 3);
INSERT INTO `tk_master_mk` VALUES ('643016', 'ORGANISASI KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('643019', 'ANALISA NUMERIK II', 3);
INSERT INTO `tk_master_mk` VALUES ('643020', 'STRUKTUR DATA', 3);
INSERT INTO `tk_master_mk` VALUES ('643021', 'COMPILER', 2);
INSERT INTO `tk_master_mk` VALUES ('643022', 'PERANCANGAN SISTEM INFORMASI', 3);
INSERT INTO `tk_master_mk` VALUES ('643023', 'SISTEM OPERASI', 3);
INSERT INTO `tk_master_mk` VALUES ('643024', 'DATABASE', 3);
INSERT INTO `tk_master_mk` VALUES ('643025', 'COMPILER LANJUT', 2);
INSERT INTO `tk_master_mk` VALUES ('643026', 'SIMULASI', 3);
INSERT INTO `tk_master_mk` VALUES ('643028', 'KECERDASAN BUATAN', 3);
INSERT INTO `tk_master_mk` VALUES ('643029', 'NETWORK', 3);
INSERT INTO `tk_master_mk` VALUES ('643039', 'KOMPUTER GRAFIK', 3);
INSERT INTO `tk_master_mk` VALUES ('643040', 'METODA PENGARSIPAN & AKSES', 3);
INSERT INTO `tk_master_mk` VALUES ('643042', 'TOPIK KHUSUS', 3);
INSERT INTO `tk_master_mk` VALUES ('643043', 'KONSEP TEKNOLOGI', 2);
INSERT INTO `tk_master_mk` VALUES ('643045', 'BAHASA PEMROGRAMAN I', 3);
INSERT INTO `tk_master_mk` VALUES ('643046', 'BAHASA PEMROGRAMAN II', 3);
INSERT INTO `tk_master_mk` VALUES ('643047', 'BAHASA PEMROGRAMAN III', 3);
INSERT INTO `tk_master_mk` VALUES ('643048', 'BAHASA PEMROGRAMAN I', 4);
INSERT INTO `tk_master_mk` VALUES ('643101', 'PENGANTAR INFORMATIKA', 4);
INSERT INTO `tk_master_mk` VALUES ('643102', 'GRAFIKA KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('643103', 'TEORI BAHASA & AUTOMATA', 3);
INSERT INTO `tk_master_mk` VALUES ('643104', 'COMPILER', 3);
INSERT INTO `tk_master_mk` VALUES ('643105', 'DESAIN DAN ANALISIS ALGORITMA', 3);
INSERT INTO `tk_master_mk` VALUES ('643106', 'SISTEM MIKROPROSESOR', 3);
INSERT INTO `tk_master_mk` VALUES ('643107', 'PENGOLAHAN CITRA DIGITAL', 3);
INSERT INTO `tk_master_mk` VALUES ('643108', 'PROSES SIMULASI', 3);
INSERT INTO `tk_master_mk` VALUES ('643109', 'BAHASA ASEMBLER', 3);
INSERT INTO `tk_master_mk` VALUES ('643110', 'BASIS DATA', 3);
INSERT INTO `tk_master_mk` VALUES ('643111', 'JARINGAN KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('643224', 'Anal.&Desain Berorientasi Obje', 2);
INSERT INTO `tk_master_mk` VALUES ('643321', 'Matematika Terapan', 3);
INSERT INTO `tk_master_mk` VALUES ('643322', 'Lingkungan Pemrograman Visual', 3);
INSERT INTO `tk_master_mk` VALUES ('643323', 'Struktur Data', 3);
INSERT INTO `tk_master_mk` VALUES ('643331', 'Sistem Informasi', 3);
INSERT INTO `tk_master_mk` VALUES ('643332', 'Teori Bahasa dan Automata', 3);
INSERT INTO `tk_master_mk` VALUES ('644001', 'DATA SECURITY', 3);
INSERT INTO `tk_master_mk` VALUES ('644002', 'REKAYASA PERANGKAT LUNAK', 3);
INSERT INTO `tk_master_mk` VALUES ('644003', 'PERANCANGAN SISTEM INTERAKSI', 2);
INSERT INTO `tk_master_mk` VALUES ('644004', 'PERANCANGAN SISTEM INTERAKSI', 2);
INSERT INTO `tk_master_mk` VALUES ('644031', 'TUGAS AKHIR', 6);
INSERT INTO `tk_master_mk` VALUES ('644032', 'KERJA PRAKTEK', 2);
INSERT INTO `tk_master_mk` VALUES ('644101', 'BAHASA PEMROGRAMAN IV(PROLOG)', 3);
INSERT INTO `tk_master_mk` VALUES ('644102', 'WORKSHOP PERANCANGAN P.LUNAK', 3);
INSERT INTO `tk_master_mk` VALUES ('644103', 'WORKSHOP PER.SIST.BASIS DATA', 2);
INSERT INTO `tk_master_mk` VALUES ('644104', 'WORKSHOP PER.SISTEM BASIS DATA', 2);
INSERT INTO `tk_master_mk` VALUES ('644105', 'PERMASALAHAN DALAM SIST.INF.', 2);
INSERT INTO `tk_master_mk` VALUES ('644106', 'PERMASALAHAN DLM.JAR.KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('644107', 'AKUNTANSI', 3);
INSERT INTO `tk_master_mk` VALUES ('644108', 'TOPIK KHUSUS', 3);
INSERT INTO `tk_master_mk` VALUES ('644109', 'FUZZY LOGIC', 2);
INSERT INTO `tk_master_mk` VALUES ('644110', 'NEURAL NETWORK', 3);
INSERT INTO `tk_master_mk` VALUES ('644111', 'ARSITEKTUR & DESAIN KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('644112', 'SISTEM COMP.AIDED INSTRUCTION', 3);
INSERT INTO `tk_master_mk` VALUES ('644113', 'SISTEM CAD / CAM', 3);
INSERT INTO `tk_master_mk` VALUES ('644114', 'PENGENALAN POLA', 3);
INSERT INTO `tk_master_mk` VALUES ('644115', 'METODE CLUSTERING', 3);
INSERT INTO `tk_master_mk` VALUES ('644116', 'KNOWLEDGE BASED PROGRAMMING', 3);
INSERT INTO `tk_master_mk` VALUES ('644118', 'COMP.INFERENCE&KNOWLEDGE ACQ.', 3);
INSERT INTO `tk_master_mk` VALUES ('644119', 'BAHASA PEMROGRAMAN V (C++)', 3);
INSERT INTO `tk_master_mk` VALUES ('644120', 'PENGANTAR S.O. UNIX', 2);
INSERT INTO `tk_master_mk` VALUES ('644121', 'SISTEM OPERASI UNIX LANJUT', 2);
INSERT INTO `tk_master_mk` VALUES ('644122', 'PENGANTAR MULTI-MEDIA', 2);
INSERT INTO `tk_master_mk` VALUES ('644123', 'MULTIMEDIA LANJUT', 3);
INSERT INTO `tk_master_mk` VALUES ('644127', 'DECISION SUPPORT SYSTEM', 3);
INSERT INTO `tk_master_mk` VALUES ('644129', 'SISTEM INFORMASI AKUNTANSI', 3);
INSERT INTO `tk_master_mk` VALUES ('644331', 'Interaksi Manusia-Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('644332', 'Sistem Operasi', 3);
INSERT INTO `tk_master_mk` VALUES ('644333', 'Sistem Berkas', 3);
INSERT INTO `tk_master_mk` VALUES ('644334', 'Teknik Kompilasi', 3);
INSERT INTO `tk_master_mk` VALUES ('645005', 'PROGRAM KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('645006', 'PEMROGRAMAN KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('645007', 'PEMROGRAMAN KOMPUTER II', 3);
INSERT INTO `tk_master_mk` VALUES ('645008', 'PROGRAM KOMPUTER I', 2);
INSERT INTO `tk_master_mk` VALUES ('645009', 'PROGRAM KOMPUTER II', 2);
INSERT INTO `tk_master_mk` VALUES ('645038', 'ANALISA NUMERIK', 3);
INSERT INTO `tk_master_mk` VALUES ('645043', 'ANALISA NUMERIK', 3);
INSERT INTO `tk_master_mk` VALUES ('645137', 'Prak. Sistem Operasi Jaringan', 1);
INSERT INTO `tk_master_mk` VALUES ('645331', 'Pengamanan Data', 3);
INSERT INTO `tk_master_mk` VALUES ('645332', 'Basis Data', 3);
INSERT INTO `tk_master_mk` VALUES ('645333', 'Grafika Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('645334', 'Desain dan Analisa Algoritma', 3);
INSERT INTO `tk_master_mk` VALUES ('645335', 'Rekayasa Perangkat Lunak', 3);
INSERT INTO `tk_master_mk` VALUES ('645336', 'Jaringan Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('646133', 'Prak. Sistem Manaj. Basis Data', 1);
INSERT INTO `tk_master_mk` VALUES ('646231', 'Kerja Praktek', 2);
INSERT INTO `tk_master_mk` VALUES ('646332', 'Riset Operasi', 3);
INSERT INTO `tk_master_mk` VALUES ('646334', 'Sistem Terdistribusi', 3);
INSERT INTO `tk_master_mk` VALUES ('647211', 'Penulisan Ilmiah', 2);
INSERT INTO `tk_master_mk` VALUES ('647331', 'Kecerdasan Buatan', 3);
INSERT INTO `tk_master_mk` VALUES ('647332', 'Teknik Simulasi', 3);
INSERT INTO `tk_master_mk` VALUES ('647333', 'Manajemen Teknologi Informasi', 3);
INSERT INTO `tk_master_mk` VALUES ('648631', 'Tugas Akhir', 6);
INSERT INTO `tk_master_mk` VALUES ('649101', 'TEKNIK OPTIMASI', 3);
INSERT INTO `tk_master_mk` VALUES ('649102', 'NUMERIK LANJUT', 3);
INSERT INTO `tk_master_mk` VALUES ('649201', 'ARSITEKTUR KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('649301', 'PEMROGRAMAN CLIENT-SERVER', 3);
INSERT INTO `tk_master_mk` VALUES ('649302', 'PEMROGRAMAN VISUAL', 3);
INSERT INTO `tk_master_mk` VALUES ('649303', 'BAHASA NONPROSEDURAL', 3);
INSERT INTO `tk_master_mk` VALUES ('649304', 'ANATOMI BAHASA PEMROGRAMAN', 3);
INSERT INTO `tk_master_mk` VALUES ('649311', 'MultiMedia', 3);
INSERT INTO `tk_master_mk` VALUES ('649312', 'Pengolahan Citra Digital', 3);
INSERT INTO `tk_master_mk` VALUES ('649313', 'Topik Khusus Grafika Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('649314', 'Topik Khusus Multimedia', 3);
INSERT INTO `tk_master_mk` VALUES ('649315', 'Komputer dan Masyarakat', 3);
INSERT INTO `tk_master_mk` VALUES ('649316', 'Topik Khusus', 3);
INSERT INTO `tk_master_mk` VALUES ('649321', 'Topik Khusus Algo. dan Pemrog.', 3);
INSERT INTO `tk_master_mk` VALUES ('649322', 'Topik Khusus Pengamanan Data', 3);
INSERT INTO `tk_master_mk` VALUES ('649323', 'Topik Khusus Riset Operasi', 3);
INSERT INTO `tk_master_mk` VALUES ('649324', 'Topik Khusus Kecerdasan Buatan', 3);
INSERT INTO `tk_master_mk` VALUES ('649331', 'Topik Khusus Internet', 3);
INSERT INTO `tk_master_mk` VALUES ('649332', 'Workshop Aplikasi Internet', 3);
INSERT INTO `tk_master_mk` VALUES ('649333', 'Workshop Sistem Terdistribusi', 3);
INSERT INTO `tk_master_mk` VALUES ('649334', 'Topik Khusus Jar.& Sist.Inform', 3);
INSERT INTO `tk_master_mk` VALUES ('649341', 'Sistem Penunjang Keputusan', 3);
INSERT INTO `tk_master_mk` VALUES ('649342', 'Sistem Pakar', 3);
INSERT INTO `tk_master_mk` VALUES ('649343', 'Sistem Informasi Akuntansi', 3);
INSERT INTO `tk_master_mk` VALUES ('649344', 'Topik Khusus Sistem Informasi', 3);
INSERT INTO `tk_master_mk` VALUES ('649345', 'Topik Khusus Basis Data', 3);
INSERT INTO `tk_master_mk` VALUES ('649346', 'Topik Khusus R P L', 3);
INSERT INTO `tk_master_mk` VALUES ('649347', 'Manaj. Proyek Perangkat Lunak', 3);
INSERT INTO `tk_master_mk` VALUES ('649401', 'WORKSHOP BASIS DATA', 3);
INSERT INTO `tk_master_mk` VALUES ('649402', 'WORKSHOP REKAYASA PER. LUNAK', 3);
INSERT INTO `tk_master_mk` VALUES ('649403', 'BASIS DATA TERSEBAR', 3);
INSERT INTO `tk_master_mk` VALUES ('649404', 'SISTEM PENUNJANG KEPUTUSAN', 3);
INSERT INTO `tk_master_mk` VALUES ('649405', 'WORKSHOP SISTEM INFORMASI', 3);
INSERT INTO `tk_master_mk` VALUES ('649406', 'SISTEM INFORMASI GEOGRAFI', 3);
INSERT INTO `tk_master_mk` VALUES ('649499', 'TOPIK KHUSUS BAS. DATA & ST. I', 3);
INSERT INTO `tk_master_mk` VALUES ('649501', 'WORKSHOP JAR. KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('649502', 'WORKSHOP SISTEM OPERASI', 3);
INSERT INTO `tk_master_mk` VALUES ('649599', 'TOPIK KHUSUS JAR & SIST. OPERA', 3);
INSERT INTO `tk_master_mk` VALUES ('649601', 'WORKSHOP GRAFIKA KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('649602', 'PENGOLAHAN CITRA DIGITAL', 3);
INSERT INTO `tk_master_mk` VALUES ('649603', 'MULTIMEDIA', 3);
INSERT INTO `tk_master_mk` VALUES ('649604', 'CAD/CAM', 3);
INSERT INTO `tk_master_mk` VALUES ('649699', 'TOPIK KHUSUS GRAF. KOMPUTER', 3);
INSERT INTO `tk_master_mk` VALUES ('649701', 'SISTEM AKUNTANSI', 3);
INSERT INTO `tk_master_mk` VALUES ('649702', 'KOMPUTER DAN MASYARAKAT', 3);
INSERT INTO `tk_master_mk` VALUES ('649801', 'SISTEM PAKAR', 3);
INSERT INTO `tk_master_mk` VALUES ('650990', 'PES.UJ.NEGARA LULUS S-1 LOKAL', 0);
INSERT INTO `tk_master_mk` VALUES ('651001', 'PENGANTAR TEKNIK MANUFAKTUR', 3);
INSERT INTO `tk_master_mk` VALUES ('651002', 'MENGGAMBAR TEKNIK I', 2);
INSERT INTO `tk_master_mk` VALUES ('651003', 'MENGGAMBAR TEKNIK II', 2);
INSERT INTO `tk_master_mk` VALUES ('651004', 'PENGETAHUAN BAHAN TEKNIK', 3);
INSERT INTO `tk_master_mk` VALUES ('651005', 'STATISTIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('651006', 'THERMODINAMIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('651009', 'PROSES MANUFAKTUR I', 3);
INSERT INTO `tk_master_mk` VALUES ('651010', 'TRANS. PHENOMENA', 3);
INSERT INTO `tk_master_mk` VALUES ('651011', 'OTOMASI INDUSTRI I', 3);
INSERT INTO `tk_master_mk` VALUES ('651012', 'OTOMASI INDUSTRI II', 3);
INSERT INTO `tk_master_mk` VALUES ('651013', 'PROSES MANUFAKTURING II', 3);
INSERT INTO `tk_master_mk` VALUES ('651014', 'ANALISA BIAYA', 3);
INSERT INTO `tk_master_mk` VALUES ('651015', 'DINAMIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('651017', 'KEKUATAN MATERIAL', 3);
INSERT INTO `tk_master_mk` VALUES ('651018', 'PERENC. & PENGEM. PRODUK I', 2);
INSERT INTO `tk_master_mk` VALUES ('651019', 'PERENC. & PENGEM. PRODUK II', 2);
INSERT INTO `tk_master_mk` VALUES ('651020', 'PROSES PERMESINAN', 3);
INSERT INTO `tk_master_mk` VALUES ('651021', 'TOOL DISAIN', 2);
INSERT INTO `tk_master_mk` VALUES ('651022', 'EKOLOGI', 2);
INSERT INTO `tk_master_mk` VALUES ('651023', 'PENGET. & PEMROG. MESIN CNC', 3);
INSERT INTO `tk_master_mk` VALUES ('651024', 'PROSES PEMBENTUKAN', 3);
INSERT INTO `tk_master_mk` VALUES ('651025', 'CAD', 3);
INSERT INTO `tk_master_mk` VALUES ('651027', 'C A M', 3);
INSERT INTO `tk_master_mk` VALUES ('651028', 'PERENC. SISTEM MANUFAKTUR', 3);
INSERT INTO `tk_master_mk` VALUES ('651031', 'SIMULASI SISTEM MANUFAKTUR', 3);
INSERT INTO `tk_master_mk` VALUES ('651034', 'OPTIMASI PERANCANGAN', 3);
INSERT INTO `tk_master_mk` VALUES ('651035', 'FINITE ELEMENT METHOD', 3);
INSERT INTO `tk_master_mk` VALUES ('651037', 'GETARAN MEKANIS', 3);
INSERT INTO `tk_master_mk` VALUES ('651040', 'KEWIRAUSAHAAN', 3);
INSERT INTO `tk_master_mk` VALUES ('651156', 'PRAK. PROSES MANUFAKTUR', 1);
INSERT INTO `tk_master_mk` VALUES ('651222', 'MENGGAMBAR TEKNIK I', 2);
INSERT INTO `tk_master_mk` VALUES ('651223', 'PENGETAHUAN BAHAN TEKNIK I', 2);
INSERT INTO `tk_master_mk` VALUES ('651231', 'PENGETAHUAN BAHAN TEKNIK II', 2);
INSERT INTO `tk_master_mk` VALUES ('651234', 'MENGGAMBAR TEKNIK II', 2);
INSERT INTO `tk_master_mk` VALUES ('651241', 'KEKUATAN MATERIAL', 2);
INSERT INTO `tk_master_mk` VALUES ('651243', 'EKOLOGI', 2);
INSERT INTO `tk_master_mk` VALUES ('651252', 'PROSES MANUFAKTUR II', 2);
INSERT INTO `tk_master_mk` VALUES ('651253', 'OTOMASI INDUSTRI I', 2);
INSERT INTO `tk_master_mk` VALUES ('651262', 'DESAIN EKSPERIMEN', 2);
INSERT INTO `tk_master_mk` VALUES ('651264', 'PROSES PERMESINAN', 2);
INSERT INTO `tk_master_mk` VALUES ('651266', 'CAD/CAM I', 2);
INSERT INTO `tk_master_mk` VALUES ('651272', 'PERANC. & PENGEMB. PRODUK II', 2);
INSERT INTO `tk_master_mk` VALUES ('651275', 'CAD/CAM II', 2);
INSERT INTO `tk_master_mk` VALUES ('651276', 'KERJA PRAKTEK', 2);
INSERT INTO `tk_master_mk` VALUES ('651283', 'TOOL DESIGN', 2);
INSERT INTO `tk_master_mk` VALUES ('651301', 'OPTIMASI PERANCANGAN', 3);
INSERT INTO `tk_master_mk` VALUES ('651302', 'SIMULASI SISTEM MANUFAKTUR', 3);
INSERT INTO `tk_master_mk` VALUES ('651303', 'FINITE ELEMEN', 3);
INSERT INTO `tk_master_mk` VALUES ('651304', 'GETARAN MEKANIS', 3);
INSERT INTO `tk_master_mk` VALUES ('651305', 'TOPIK KHUSUS TEKNIK MANUFAKTUR', 3);
INSERT INTO `tk_master_mk` VALUES ('651311', 'PENGANTAR TEKNIK MANUFAKTUR', 3);
INSERT INTO `tk_master_mk` VALUES ('651321', 'STATISTIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('651332', 'MEKANIKA TEKNIK', 3);
INSERT INTO `tk_master_mk` VALUES ('651333', 'TERMODINAMIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('651335', 'TEKNIK TENAGA LISTRIK', 3);
INSERT INTO `tk_master_mk` VALUES ('651342', 'TRANSPORT PHENOMENA', 3);
INSERT INTO `tk_master_mk` VALUES ('651344', 'PROSES MANUFAKTUR I', 3);
INSERT INTO `tk_master_mk` VALUES ('651345', 'ELEMEN MESIN', 3);
INSERT INTO `tk_master_mk` VALUES ('651351', 'ANALISA BIAYA', 3);
INSERT INTO `tk_master_mk` VALUES ('651354', 'DINAMIKA', 3);
INSERT INTO `tk_master_mk` VALUES ('651355', 'PENYELIDIKAN OPERASIONAL', 3);
INSERT INTO `tk_master_mk` VALUES ('651361', 'OTOMASI INDUSTRI II', 3);
INSERT INTO `tk_master_mk` VALUES ('651363', 'PERANC. PENGEMB. PRODUK I', 3);
INSERT INTO `tk_master_mk` VALUES ('651365', 'METROLOGI & PKS', 3);
INSERT INTO `tk_master_mk` VALUES ('651371', 'PERENC. & PENGEND. PRODUKSI', 3);
INSERT INTO `tk_master_mk` VALUES ('651373', 'PERANC. SISTEM MANUFAKTUR', 3);
INSERT INTO `tk_master_mk` VALUES ('651374', 'PROSES PEMBENTUKAN', 3);
INSERT INTO `tk_master_mk` VALUES ('651381', 'PENGETAHUAN & PEMROG. CNC', 3);
INSERT INTO `tk_master_mk` VALUES ('651382', 'MOULD DESIGN', 3);
INSERT INTO `tk_master_mk` VALUES ('651585', 'TUGAS AKHIR', 5);
INSERT INTO `tk_master_mk` VALUES ('653331', 'Mekanika Teknik', 3);
INSERT INTO `tk_master_mk` VALUES ('653341', 'Elemen Mesin', 3);
INSERT INTO `tk_master_mk` VALUES ('654131', 'Praktikum CAD/CAM', 1);
INSERT INTO `tk_master_mk` VALUES ('654161', 'Praktikum Prosman', 1);
INSERT INTO `tk_master_mk` VALUES ('654211', 'Pengetahuan Bahan Teknik I', 2);
INSERT INTO `tk_master_mk` VALUES ('654221', 'Metrologi Industri', 2);
INSERT INTO `tk_master_mk` VALUES ('654222', 'Pengetahuan Bahan Teknik II', 2);
INSERT INTO `tk_master_mk` VALUES ('654232', 'Kekuatan Material', 2);
INSERT INTO `tk_master_mk` VALUES ('654251', 'Elemen Mesin II', 2);
INSERT INTO `tk_master_mk` VALUES ('654262', 'Peranc.Pengembangan Produk', 2);
INSERT INTO `tk_master_mk` VALUES ('654263', 'Metode Penelitian', 2);
INSERT INTO `tk_master_mk` VALUES ('654264', 'Desain Eksperimen', 2);
INSERT INTO `tk_master_mk` VALUES ('654265', 'Tugas Elemen Mesin', 2);
INSERT INTO `tk_master_mk` VALUES ('654271', 'Design Project', 2);
INSERT INTO `tk_master_mk` VALUES ('654272', 'Tool Design', 2);
INSERT INTO `tk_master_mk` VALUES ('654273', 'Kerja Praktek', 2);
INSERT INTO `tk_master_mk` VALUES ('654281', 'Pengetahuan Lingkungan Hidup', 2);
INSERT INTO `tk_master_mk` VALUES ('654333', 'CAD/CAM', 3);
INSERT INTO `tk_master_mk` VALUES ('654334', 'Termodinamika', 3);
INSERT INTO `tk_master_mk` VALUES ('654335', 'Proses Manufaktur I', 3);
INSERT INTO `tk_master_mk` VALUES ('654341', 'Mekanika Fluida', 3);
INSERT INTO `tk_master_mk` VALUES ('654342', 'Elemen Mesin I', 3);
INSERT INTO `tk_master_mk` VALUES ('654343', 'Proses Manufaktur II', 3);
INSERT INTO `tk_master_mk` VALUES ('654352', 'Perpindahan Panas', 3);
INSERT INTO `tk_master_mk` VALUES ('654353', 'Proses Manufaktur III', 3);
INSERT INTO `tk_master_mk` VALUES ('654354', 'Penyelidikan  Operasional', 3);
INSERT INTO `tk_master_mk` VALUES ('654355', 'Analisa Biaya', 3);
INSERT INTO `tk_master_mk` VALUES ('654366', 'Mould Design', 3);
INSERT INTO `tk_master_mk` VALUES ('654367', 'Dinamika', 3);
INSERT INTO `tk_master_mk` VALUES ('654368', 'Teknik Tenaga Listrik', 3);
INSERT INTO `tk_master_mk` VALUES ('654374', 'Otomasi Industri I', 3);
INSERT INTO `tk_master_mk` VALUES ('654375', 'Perenc. & Pengend. Produksi', 3);
INSERT INTO `tk_master_mk` VALUES ('654376', 'Pemrograman CNC', 3);
INSERT INTO `tk_master_mk` VALUES ('654382', 'Otomasi Industri II', 3);
INSERT INTO `tk_master_mk` VALUES ('654383', 'Perancangan Sistem Manufaktur', 3);
INSERT INTO `tk_master_mk` VALUES ('654412', 'Pengantar Teknik Manufaktur', 4);
INSERT INTO `tk_master_mk` VALUES ('654423', 'Mekanika Teknik', 4);
INSERT INTO `tk_master_mk` VALUES ('654424', 'Menggambar Teknik', 4);
INSERT INTO `tk_master_mk` VALUES ('654584', 'Tugas Akhir', 5);
INSERT INTO `tk_master_mk` VALUES ('655201', 'Finite Elemen', 2);
INSERT INTO `tk_master_mk` VALUES ('655202', 'Getaran Mekanis', 2);
INSERT INTO `tk_master_mk` VALUES ('655203', 'Topik Khusus', 2);
INSERT INTO `tk_master_mk` VALUES ('655204', 'Optimasi Perancangan', 2);
INSERT INTO `tk_master_mk` VALUES ('655205', 'Simulasi Sistem Manufaktur', 2);
INSERT INTO `tk_master_mk` VALUES ('00141A', 'Pancasila dan Kewarganegaraan', 3);
INSERT INTO `tk_master_mk` VALUES ('60A101', 'Kalkulus I', 4);
INSERT INTO `tk_master_mk` VALUES ('60A102', 'Kalkulus II', 3);
INSERT INTO `tk_master_mk` VALUES ('60A103', 'Pengantar Aljabar Linear', 2);
INSERT INTO `tk_master_mk` VALUES ('60A104', 'Persamaan Differensial Biasa', 2);
INSERT INTO `tk_master_mk` VALUES ('60A105', 'Vektor dan Matriks', 3);
INSERT INTO `tk_master_mk` VALUES ('60A106', 'Matematika Teknik', 3);
INSERT INTO `tk_master_mk` VALUES ('60A107', 'Metode Numerik', 2);
INSERT INTO `tk_master_mk` VALUES ('60A108', 'Metode Numerik', 2);
INSERT INTO `tk_master_mk` VALUES ('60A201', 'Statistika', 2);
INSERT INTO `tk_master_mk` VALUES ('60A202', 'Statistika', 3);
INSERT INTO `tk_master_mk` VALUES ('60A203', 'Statistika', 3);
INSERT INTO `tk_master_mk` VALUES ('60A204', 'Statistika dan Reliabilitas', 3);
INSERT INTO `tk_master_mk` VALUES ('60A301', 'Fisika I', 3);
INSERT INTO `tk_master_mk` VALUES ('60A302', 'Fisika II', 3);
INSERT INTO `tk_master_mk` VALUES ('60A391', 'Praktikum Fisika', 1);
INSERT INTO `tk_master_mk` VALUES ('60A401', 'Kimia Dasar', 3);
INSERT INTO `tk_master_mk` VALUES ('60A402', 'Elektrokimia Dasar', 2);
INSERT INTO `tk_master_mk` VALUES ('60A403', 'Dasar Kimia Bahan', 2);
INSERT INTO `tk_master_mk` VALUES ('60A404', 'Kimia Analitik', 3);
INSERT INTO `tk_master_mk` VALUES ('60A405', 'Kimia Organik I', 2);
INSERT INTO `tk_master_mk` VALUES ('60A406', 'Kimia Organik II', 2);
INSERT INTO `tk_master_mk` VALUES ('60A407', 'Kimia Fisika I', 2);
INSERT INTO `tk_master_mk` VALUES ('60A408', 'Kimia Fisika II', 2);
INSERT INTO `tk_master_mk` VALUES ('60A494', 'Praktikum Kimia Analitik', 1);
INSERT INTO `tk_master_mk` VALUES ('60A495', 'Praktikum Kimia Organik', 2);
INSERT INTO `tk_master_mk` VALUES ('60A497', 'Praktikum Kimia Fisika', 2);
INSERT INTO `tk_master_mk` VALUES ('60A501', 'Bahasa Indonesia', 3);
INSERT INTO `tk_master_mk` VALUES ('60A511', 'Presentasi Ilmiah', 2);
INSERT INTO `tk_master_mk` VALUES ('60A601', 'Bahasa Inggris', 2);
INSERT INTO `tk_master_mk` VALUES ('60A611', 'Bahasa Inggris Lanjut', 2);
INSERT INTO `tk_master_mk` VALUES ('60A701', 'Kewirausahaan & Inovasi', 2);
INSERT INTO `tk_master_mk` VALUES ('60A811', 'Pengetahuan Lingkungan Hidup', 2);
INSERT INTO `tk_master_mk` VALUES ('61A113', 'Dasar Teknologi Digital', 4);
INSERT INTO `tk_master_mk` VALUES ('61A121', 'Rangkaian Listrik I', 3);
INSERT INTO `tk_master_mk` VALUES ('61A131', 'Rangkaian Listrik II', 3);
INSERT INTO `tk_master_mk` VALUES ('61A132', 'Elektronika I', 4);
INSERT INTO `tk_master_mk` VALUES ('61A141', 'Sistem Telekomunikasi Analog', 3);
INSERT INTO `tk_master_mk` VALUES ('61A145', 'Elektronika II', 3);
INSERT INTO `tk_master_mk` VALUES ('61A155', 'Teknik Tenaga Listrik I', 2);
INSERT INTO `tk_master_mk` VALUES ('61A199', 'Tugas Akhir', 4);
INSERT INTO `tk_master_mk` VALUES ('61A211', 'Pengantar Teknik Elektro', 2);
INSERT INTO `tk_master_mk` VALUES ('61A212', 'Konsep & Perkembangan Teknolog', 2);
INSERT INTO `tk_master_mk` VALUES ('61A222', 'Divais Logika Terprogram', 2);
INSERT INTO `tk_master_mk` VALUES ('61A223', 'Algoritma dan Pemrograman', 3);
INSERT INTO `tk_master_mk` VALUES ('61A233', 'Arsitektur Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('61A234', 'Pemrograman Mikroprosesor', 3);
INSERT INTO `tk_master_mk` VALUES ('61A242', 'Sinyal dan Sistem', 3);
INSERT INTO `tk_master_mk` VALUES ('61A243', 'Teknologi Elektromagnetik', 3);
INSERT INTO `tk_master_mk` VALUES ('61A244', 'Rangkaian Listrik III', 2);
INSERT INTO `tk_master_mk` VALUES ('61A246', 'Peranc. Sistem Mikroprosesor', 3);
INSERT INTO `tk_master_mk` VALUES ('61A251', 'Sistem Telekomunikasi Digital', 3);
INSERT INTO `tk_master_mk` VALUES ('61A252', 'Control System I', 3);
INSERT INTO `tk_master_mk` VALUES ('61A253', 'Elektronika III', 3);
INSERT INTO `tk_master_mk` VALUES ('61A254', 'Penguat Operasional', 3);
INSERT INTO `tk_master_mk` VALUES ('61A256', 'Mikrokontroler', 3);
INSERT INTO `tk_master_mk` VALUES ('61A261', 'Telephony System', 2);
INSERT INTO `tk_master_mk` VALUES ('61A262', 'Signal Processing', 3);
INSERT INTO `tk_master_mk` VALUES ('61A263', 'Control System II', 3);
INSERT INTO `tk_master_mk` VALUES ('61A264', 'Teknik Tenaga Listrik II', 2);
INSERT INTO `tk_master_mk` VALUES ('61A265', 'Programmable Logic Controler', 3);
INSERT INTO `tk_master_mk` VALUES ('61A271', 'Stokastik', 2);
INSERT INTO `tk_master_mk` VALUES ('61A272', 'Computer Networks', 3);
INSERT INTO `tk_master_mk` VALUES ('61A281', 'Power Electronics', 2);
INSERT INTO `tk_master_mk` VALUES ('61A371', 'Mekatronika', 2);
INSERT INTO `tk_master_mk` VALUES ('61A372', 'Otomasi Industri', 3);
INSERT INTO `tk_master_mk` VALUES ('61A381', 'Robotika', 3);
INSERT INTO `tk_master_mk` VALUES ('61A461', 'Kerja Praktek', 2);
INSERT INTO `tk_master_mk` VALUES ('61A471', 'Hardware Description Language', 2);
INSERT INTO `tk_master_mk` VALUES ('61A472', 'SCADA', 2);
INSERT INTO `tk_master_mk` VALUES ('61A473', 'Digital Electronics', 2);
INSERT INTO `tk_master_mk` VALUES ('61A481', 'Sistem Cerdas', 3);
INSERT INTO `tk_master_mk` VALUES ('61A482', 'Sistem Pengaturan Optimal', 2);
INSERT INTO `tk_master_mk` VALUES ('61A483', 'Interfacing', 2);
INSERT INTO `tk_master_mk` VALUES ('61A484', 'Teknologi Digital Lanjut', 2);
INSERT INTO `tk_master_mk` VALUES ('61A485', 'Topik Khusus Otomasi', 2);
INSERT INTO `tk_master_mk` VALUES ('61A571', 'Saluran Transmisi dan Antena', 2);
INSERT INTO `tk_master_mk` VALUES ('61A572', 'Elektronika Komunikasi', 2);
INSERT INTO `tk_master_mk` VALUES ('61A573', 'Sistem Komunikasi Seluler', 3);
INSERT INTO `tk_master_mk` VALUES ('61A581', 'Sistem Kom. Gelombang Mikro', 2);
INSERT INTO `tk_master_mk` VALUES ('61A671', 'Pemrosesan Citra', 2);
INSERT INTO `tk_master_mk` VALUES ('61A672', 'Topik Khusus Tekno. Komunikasi', 2);
INSERT INTO `tk_master_mk` VALUES ('61A673', 'Instrumentasi Biomedis', 2);
INSERT INTO `tk_master_mk` VALUES ('61A681', 'Radar dan Navigasi', 2);
INSERT INTO `tk_master_mk` VALUES ('61A682', 'Sistem Komunikasi Satelit', 2);
INSERT INTO `tk_master_mk` VALUES ('61A683', 'Sistem Komunikasi Serat Optik', 3);
INSERT INTO `tk_master_mk` VALUES ('61A684', 'Sistem Kompresi Digital', 2);
INSERT INTO `tk_master_mk` VALUES ('61A685', 'Teknologi Spread Spectrum', 2);
INSERT INTO `tk_master_mk` VALUES ('62A011', 'Pengantar Teknologi Proses', 2);
INSERT INTO `tk_master_mk` VALUES ('62A021', 'Neraca Massa dan Energi', 3);
INSERT INTO `tk_master_mk` VALUES ('62A022', 'Program Komputer', 2);
INSERT INTO `tk_master_mk` VALUES ('62A031', 'Termodinamika I', 3);
INSERT INTO `tk_master_mk` VALUES ('62A041', 'Termodinamika II', 3);
INSERT INTO `tk_master_mk` VALUES ('62A042', 'Mekanika Fluida', 2);
INSERT INTO `tk_master_mk` VALUES ('62A043', 'Matematika Teknik Kimia', 3);
INSERT INTO `tk_master_mk` VALUES ('62A044', 'Komputasi Numerik Terapan', 2);
INSERT INTO `tk_master_mk` VALUES ('62A045', 'Dasar-Dasar Manajemen', 2);
INSERT INTO `tk_master_mk` VALUES ('62A051', 'Operasi Teknik Kimia I', 3);
INSERT INTO `tk_master_mk` VALUES ('62A052', 'Perpindahan Massa dan Panas', 3);
INSERT INTO `tk_master_mk` VALUES ('62A053', 'Teknik Reaksi Kimia I', 3);
INSERT INTO `tk_master_mk` VALUES ('62A054', 'Perancangan Alat I', 2);
INSERT INTO `tk_master_mk` VALUES ('62A061', 'Prak. Operasi Teknik Kimia I', 2);
INSERT INTO `tk_master_mk` VALUES ('62A062', 'Operasi Teknik Kimia II', 3);
INSERT INTO `tk_master_mk` VALUES ('62A063', 'Proses Industri Kimia', 3);
INSERT INTO `tk_master_mk` VALUES ('62A064', 'Teknik Reaksi Kimia II', 3);
INSERT INTO `tk_master_mk` VALUES ('62A071', 'Prak.Operasi Teknik Kimia II', 2);
INSERT INTO `tk_master_mk` VALUES ('62A072', 'Operasi Teknik Kimia III', 3);
INSERT INTO `tk_master_mk` VALUES ('62A073', 'Perancangan Alat II', 2);
INSERT INTO `tk_master_mk` VALUES ('62A074', 'Keselamatan & Kesehatan Kerja', 2);
INSERT INTO `tk_master_mk` VALUES ('62A075', 'Utilitas', 3);
INSERT INTO `tk_master_mk` VALUES ('62A076', 'Ekonomi Teknik', 2);
INSERT INTO `tk_master_mk` VALUES ('62A077', 'Kerja Praktek', 2);
INSERT INTO `tk_master_mk` VALUES ('62A081', 'Perancangan Pabrik Kimia', 3);
INSERT INTO `tk_master_mk` VALUES ('62A082', 'Pengendalian Proses', 3);
INSERT INTO `tk_master_mk` VALUES ('62A083', 'Desain Proyek', 4);
INSERT INTO `tk_master_mk` VALUES ('62A084', 'Penelitian', 4);
INSERT INTO `tk_master_mk` VALUES ('62A141', 'Dasar-Dasar Tekno. & Ilmu Ling', 2);
INSERT INTO `tk_master_mk` VALUES ('62A151', 'Pengantar Teknologi Bioproses', 3);
INSERT INTO `tk_master_mk` VALUES ('62A161', 'Pengantar Teknologi Polimer', 3);
INSERT INTO `tk_master_mk` VALUES ('62A162', 'Bahan Konstruksi & Korosi', 2);
INSERT INTO `tk_master_mk` VALUES ('62A231', 'Kimia Pangan', 3);
INSERT INTO `tk_master_mk` VALUES ('62A251', 'Mikrobiologi Pangan', 3);
INSERT INTO `tk_master_mk` VALUES ('62A261', 'Praktikum Analisa Pangan', 2);
INSERT INTO `tk_master_mk` VALUES ('62A262', 'Teknologi Pemrosesan Pangan', 3);
INSERT INTO `tk_master_mk` VALUES ('62A271', 'Praktikum Teknologi Pangan', 2);
INSERT INTO `tk_master_mk` VALUES ('62A272', 'Peng. Mutu & Keamanan Pangan', 2);
INSERT INTO `tk_master_mk` VALUES ('62A281', 'Teknologi Pengemasan Pangan', 2);
INSERT INTO `tk_master_mk` VALUES ('62A351', 'Dasar-Dasar Mikrobiologi Lingk', 3);
INSERT INTO `tk_master_mk` VALUES ('62A352', 'Manaj. Limbah Padat & Berbahaya', 3);
INSERT INTO `tk_master_mk` VALUES ('62A361', 'Manajemen Kualitas Udara', 2);
INSERT INTO `tk_master_mk` VALUES ('62A362', 'Teknik-Teknik Penyel. Masalah Lingk', 2);
INSERT INTO `tk_master_mk` VALUES ('62A363', 'Teknologi Pengolahan Air Buangan I', 2);
INSERT INTO `tk_master_mk` VALUES ('62A381', 'Teknologi Pengolahan Air Buangan II', 2);
INSERT INTO `tk_master_mk` VALUES ('62A901', 'Teknik Fluidisasi', 2);
INSERT INTO `tk_master_mk` VALUES ('62A902', 'Optimasi Proses', 2);
INSERT INTO `tk_master_mk` VALUES ('62A903', 'Perancangan Proses', 2);
INSERT INTO `tk_master_mk` VALUES ('62A905', 'Pemisahan Multi Komponen', 2);
INSERT INTO `tk_master_mk` VALUES ('62A906', 'Perpin. Massa Disertai Reaksi Kimia', 2);
INSERT INTO `tk_master_mk` VALUES ('62A907', 'Teknologi Partikel', 2);
INSERT INTO `tk_master_mk` VALUES ('62A908', 'Teknologi Polimer', 2);
INSERT INTO `tk_master_mk` VALUES ('62A909', 'Teknologi Membran', 2);
INSERT INTO `tk_master_mk` VALUES ('62A910', 'Teknologi Fermentasi', 2);
INSERT INTO `tk_master_mk` VALUES ('62A911', 'Rekayasa Biokimia', 2);
INSERT INTO `tk_master_mk` VALUES ('62A912', 'Bioseparasi', 2);
INSERT INTO `tk_master_mk` VALUES ('62A913', 'Bioreaktor', 2);
INSERT INTO `tk_master_mk` VALUES ('62A914', 'Teknologi Pemrosesan Produk Susu', 2);
INSERT INTO `tk_master_mk` VALUES ('62A915', 'Teknologi Pengolahan Pati', 2);
INSERT INTO `tk_master_mk` VALUES ('62A916', 'Teknologi Pengolahan Minyak & Lemak', 2);
INSERT INTO `tk_master_mk` VALUES ('62A917', 'Protein Pangan', 2);
INSERT INTO `tk_master_mk` VALUES ('62A918', 'Bioteknologi Pangan', 2);
INSERT INTO `tk_master_mk` VALUES ('62A919', 'Teknologi Produksi Bersih', 2);
INSERT INTO `tk_master_mk` VALUES ('62A921', 'Manajemen Lingkungan', 2);
INSERT INTO `tk_master_mk` VALUES ('62A922', 'Bioremediasi', 2);
INSERT INTO `tk_master_mk` VALUES ('62A923', 'Manajemen Pemasaran', 2);
INSERT INTO `tk_master_mk` VALUES ('62A924', 'Kepemimpinan', 2);
INSERT INTO `tk_master_mk` VALUES ('62A925', 'Manajemen Operasi', 2);
INSERT INTO `tk_master_mk` VALUES ('62A926', 'Pencegahan Polusi', 2);
INSERT INTO `tk_master_mk` VALUES ('62A927', 'Pengantar Bioreaktor', 2);
INSERT INTO `tk_master_mk` VALUES ('62A928', 'Biopolimer', 2);
INSERT INTO `tk_master_mk` VALUES ('63A121', 'Pengantar Ilmu Ekonomi', 2);
INSERT INTO `tk_master_mk` VALUES ('63A130', 'Pengantar Teknik Industri', 3);
INSERT INTO `tk_master_mk` VALUES ('63A132', 'Logika Pemrograman', 3);
INSERT INTO `tk_master_mk` VALUES ('63A220', 'Psikologi Industri', 2);
INSERT INTO `tk_master_mk` VALUES ('63A231', 'Menggambar Teknik', 3);
INSERT INTO `tk_master_mk` VALUES ('63A232', 'Statistika Industri I', 3);
INSERT INTO `tk_master_mk` VALUES ('63A322', 'Ergonomi Industri', 2);
INSERT INTO `tk_master_mk` VALUES ('63A323', 'Manajemen Organisasi', 2);
INSERT INTO `tk_master_mk` VALUES ('63A325', 'Kimia Industri', 2);
INSERT INTO `tk_master_mk` VALUES ('63A330', 'Penyelidikan Operasional I', 3);
INSERT INTO `tk_master_mk` VALUES ('63A331', 'Statistika Industri II', 3);
INSERT INTO `tk_master_mk` VALUES ('63A334', 'Analisis Biaya', 3);
INSERT INTO `tk_master_mk` VALUES ('63A336', 'Mekanika Teknik', 3);
INSERT INTO `tk_master_mk` VALUES ('63A412', 'Prak. Analisis & Perancangan Kerja', 1);
INSERT INTO `tk_master_mk` VALUES ('63A430', 'Penyelidikan Operasional II', 3);
INSERT INTO `tk_master_mk` VALUES ('63A431', 'Analisis dan Perancangan Kerja', 3);
INSERT INTO `tk_master_mk` VALUES ('63A433', 'Pengetahuan Bahan Teknik', 3);
INSERT INTO `tk_master_mk` VALUES ('63A434', 'Ekonomi Teknik', 3);
INSERT INTO `tk_master_mk` VALUES ('63A435', 'Proses Manufaktur', 3);
INSERT INTO `tk_master_mk` VALUES ('63A516', 'Praktikum Proses Manufaktur', 1);
INSERT INTO `tk_master_mk` VALUES ('63A520', 'Manajemen Keuangan', 2);
INSERT INTO `tk_master_mk` VALUES ('63A521', 'Manajemen Pemasaran', 2);
INSERT INTO `tk_master_mk` VALUES ('63A532', 'Pengendalian Kualitas Statistik', 3);
INSERT INTO `tk_master_mk` VALUES ('63A533', 'Perenc. & Pengendalian Produksi', 3);
INSERT INTO `tk_master_mk` VALUES ('63A534', 'Manajemen Persediaan', 3);
INSERT INTO `tk_master_mk` VALUES ('63A535', 'Sistem Informasi Manajemen', 3);
INSERT INTO `tk_master_mk` VALUES ('63A537', 'Elemen Mesin', 3);
INSERT INTO `tk_master_mk` VALUES ('63A620', 'Manajemen Pengembangan Produk', 2);
INSERT INTO `tk_master_mk` VALUES ('63A622', 'Keselamatan Kerja', 2);
INSERT INTO `tk_master_mk` VALUES ('63A623', 'Manajemen Kualitas', 2);
INSERT INTO `tk_master_mk` VALUES ('63A624', 'Supply Chain Management', 2);
INSERT INTO `tk_master_mk` VALUES ('63A631', 'Tata Letak Pabrik & Pemind. Bahan', 3);
INSERT INTO `tk_master_mk` VALUES ('63A635', 'Pemodelan Sistem', 3);
INSERT INTO `tk_master_mk` VALUES ('63A636', 'Sistem Tenaga Listrik', 3);
INSERT INTO `tk_master_mk` VALUES ('63A716', 'Kerja Praktik I', 1);
INSERT INTO `tk_master_mk` VALUES ('63A720', 'Sistem Pengukuran Kinerja', 2);
INSERT INTO `tk_master_mk` VALUES ('63A721', 'Perencanaan Industri', 2);
INSERT INTO `tk_master_mk` VALUES ('63A722', 'Manajemen Teknologi', 2);
INSERT INTO `tk_master_mk` VALUES ('63A723', 'Simulasi Sistem Industri', 2);
INSERT INTO `tk_master_mk` VALUES ('63A724', 'Manajemen Sumber Daya Manusia', 2);
INSERT INTO `tk_master_mk` VALUES ('63A725', 'Metodologi Penelitian', 2);
INSERT INTO `tk_master_mk` VALUES ('63A810', 'Kerja Praktik II', 1);
INSERT INTO `tk_master_mk` VALUES ('63A851', 'Tugas Akhir', 5);
INSERT INTO `tk_master_mk` VALUES ('63A900', 'Analisis Keputusan', 2);
INSERT INTO `tk_master_mk` VALUES ('63A901', 'Otomasi Industri', 2);
INSERT INTO `tk_master_mk` VALUES ('63A902', 'Sistem Pendukung Keputusan', 2);
INSERT INTO `tk_master_mk` VALUES ('63A903', 'Sistem Manusia Mesin', 2);
INSERT INTO `tk_master_mk` VALUES ('63A904', 'Manufacturing Strategies', 2);
INSERT INTO `tk_master_mk` VALUES ('63A905', 'Flexible Manufacturing System', 2);
INSERT INTO `tk_master_mk` VALUES ('63A906', 'Pemrograman CNC', 2);
INSERT INTO `tk_master_mk` VALUES ('63A907', 'CAD/CAM', 2);
INSERT INTO `tk_master_mk` VALUES ('63A908', 'Analisis Multi Variabel', 2);
INSERT INTO `tk_master_mk` VALUES ('63A909', 'Riset Pemasaran', 2);
INSERT INTO `tk_master_mk` VALUES ('63A910', 'Manajemen Perubahan', 2);
INSERT INTO `tk_master_mk` VALUES ('63A911', 'Risk Management', 2);
INSERT INTO `tk_master_mk` VALUES ('63A912', 'Manajemen Proyek', 2);
INSERT INTO `tk_master_mk` VALUES ('63A913', 'Penyelidikan Operasional Lanjut', 2);
INSERT INTO `tk_master_mk` VALUES ('63A940', 'Manajemen Keselamatan Kerja', 2);
INSERT INTO `tk_master_mk` VALUES ('63A941', 'Ergonomi Terapan', 2);
INSERT INTO `tk_master_mk` VALUES ('63A942', 'Manajemen Lingkungan', 2);
INSERT INTO `tk_master_mk` VALUES ('63A943', 'Ergonomi Kognitif', 2);
INSERT INTO `tk_master_mk` VALUES ('63A944', 'Ergonomi Perkantoran', 2);
INSERT INTO `tk_master_mk` VALUES ('63A950', 'Topik Khusus A', 2);
INSERT INTO `tk_master_mk` VALUES ('63A951', 'Topik Khusus B', 2);
INSERT INTO `tk_master_mk` VALUES ('63A952', 'Topik Khusus C', 2);
INSERT INTO `tk_master_mk` VALUES ('63A960', 'Audit Quality System (AQS)', 2);
INSERT INTO `tk_master_mk` VALUES ('63A961', 'Desain Eksperimen', 2);
INSERT INTO `tk_master_mk` VALUES ('63A962', 'Rekayasa Kualitas', 2);
INSERT INTO `tk_master_mk` VALUES ('63A963', 'Manajemen Perawatan', 2);
INSERT INTO `tk_master_mk` VALUES ('63A964', 'Manajemen Jasa', 2);
INSERT INTO `tk_master_mk` VALUES ('63A965', 'Six Sigma', 2);
INSERT INTO `tk_master_mk` VALUES ('63A966', 'Leadership for Quality', 2);
INSERT INTO `tk_master_mk` VALUES ('63A970', 'Sistem Manajemen Mutu (ISO 9000)', 2);
INSERT INTO `tk_master_mk` VALUES ('63A971', 'Topik Khusus B', 2);
INSERT INTO `tk_master_mk` VALUES ('63A972', 'Topik Khusus C', 2);
INSERT INTO `tk_master_mk` VALUES ('63A980', 'Demand Management', 2);
INSERT INTO `tk_master_mk` VALUES ('63A981', 'Warehouse Management System', 2);
INSERT INTO `tk_master_mk` VALUES ('63A982', 'Sistem Distribusi dan Transportasi', 2);
INSERT INTO `tk_master_mk` VALUES ('63A983', 'Enterprise Resource Planning', 2);
INSERT INTO `tk_master_mk` VALUES ('63A984', 'Procurement & Supply Management', 2);
INSERT INTO `tk_master_mk` VALUES ('63A990', 'Topik Khusus A: I S I', 2);
INSERT INTO `tk_master_mk` VALUES ('63A991', 'Strategi Retail', 2);
INSERT INTO `tk_master_mk` VALUES ('63A992', 'Topik Khusus C', 2);
INSERT INTO `tk_master_mk` VALUES ('64A101', 'Konsep Teknologi Telematika', 2);
INSERT INTO `tk_master_mk` VALUES ('64A111', 'Algoritma dan Pemrograman', 4);
INSERT INTO `tk_master_mk` VALUES ('64A112', 'Pengantar Informatika', 2);
INSERT INTO `tk_master_mk` VALUES ('64A211', 'Pemrograman Berorientasi Objek', 3);
INSERT INTO `tk_master_mk` VALUES ('64A212', 'Matematika Diskrit', 4);
INSERT INTO `tk_master_mk` VALUES ('64A213', 'Analisis & Desain Berorientasi Obje', 3);
INSERT INTO `tk_master_mk` VALUES ('64A311', 'Struktur Data', 4);
INSERT INTO `tk_master_mk` VALUES ('64A312', 'Teori Automata', 2);
INSERT INTO `tk_master_mk` VALUES ('64A313', 'Pengantar Sistem Informasi', 2);
INSERT INTO `tk_master_mk` VALUES ('64A314', 'Organisasi dan Arsitektur Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('64A315', 'Pemrograman Terdistribusi', 4);
INSERT INTO `tk_master_mk` VALUES ('64A411', 'Lingkungan Pemrograman Visual', 3);
INSERT INTO `tk_master_mk` VALUES ('64A412', 'Teknik Kompilator', 2);
INSERT INTO `tk_master_mk` VALUES ('64A413', 'Interaksi Manusia Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('64A414', 'Analisis & Desain Sistem Informasi', 2);
INSERT INTO `tk_master_mk` VALUES ('64A415', 'Sistem Operasi', 3);
INSERT INTO `tk_master_mk` VALUES ('64A511', 'Basis Data', 3);
INSERT INTO `tk_master_mk` VALUES ('64A512', 'Grafika Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('64A513', 'Teknologi Multimedia', 3);
INSERT INTO `tk_master_mk` VALUES ('64A514', 'Jaringan Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('64A515', 'Pemrograman Web', 3);
INSERT INTO `tk_master_mk` VALUES ('64A611', 'Keamanan Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('64A612', 'Manajemen Sains', 3);
INSERT INTO `tk_master_mk` VALUES ('64A613', 'Kerja Praktek', 2);
INSERT INTO `tk_master_mk` VALUES ('64A614', 'Pengantar Intelijensia Buatan', 3);
INSERT INTO `tk_master_mk` VALUES ('64A615', 'Rekayasa Perangkat Lunak', 3);
INSERT INTO `tk_master_mk` VALUES ('64A701', 'Metodologi Penelitian', 2);
INSERT INTO `tk_master_mk` VALUES ('64A711', 'Manajemen Teknologi Telematika', 3);
INSERT INTO `tk_master_mk` VALUES ('64A712', 'Pemodelan dan Simulasi', 3);
INSERT INTO `tk_master_mk` VALUES ('64A811', 'Tugas Akhir', 5);
INSERT INTO `tk_master_mk` VALUES ('64A900', 'Business Communication', 3);
INSERT INTO `tk_master_mk` VALUES ('64A901', 'Bahasa Inggris Lanjutan', 3);
INSERT INTO `tk_master_mk` VALUES ('64A902', 'Topik Khusus', 3);
INSERT INTO `tk_master_mk` VALUES ('64A903', 'Komputer dan Masyarakat', 3);
INSERT INTO `tk_master_mk` VALUES ('64A904', 'Kepemimpinan', 3);
INSERT INTO `tk_master_mk` VALUES ('64A910', 'Sistem Informasi Akuntansi', 3);
INSERT INTO `tk_master_mk` VALUES ('64A911', 'Topik Khusus Sistem Informasi', 3);
INSERT INTO `tk_master_mk` VALUES ('64A912', 'Data Warehouse', 3);
INSERT INTO `tk_master_mk` VALUES ('64A913', 'Topik Khusus Basis Data', 3);
INSERT INTO `tk_master_mk` VALUES ('64A914', 'Workshop Basis Data', 3);
INSERT INTO `tk_master_mk` VALUES ('64A915', 'Workshop Rekayasa Perangkat Lunak', 3);
INSERT INTO `tk_master_mk` VALUES ('64A916', 'T K Rekayasa Perangkat Lunak', 3);
INSERT INTO `tk_master_mk` VALUES ('64A917', 'Topik Khusus Sistem Informasi', 3);
INSERT INTO `tk_master_mk` VALUES ('64A918', 'Manajemen E-Bisnis', 3);
INSERT INTO `tk_master_mk` VALUES ('64A919', 'Sistem Penunjang Keputusan', 3);
INSERT INTO `tk_master_mk` VALUES ('64A920', 'Enterprise Resource Planning', 3);
INSERT INTO `tk_master_mk` VALUES ('64A921', 'Customer Relation Management', 3);
INSERT INTO `tk_master_mk` VALUES ('64A922', 'Supply Chain Management', 3);
INSERT INTO `tk_master_mk` VALUES ('64A923', 'Manajemen Operasi', 3);
INSERT INTO `tk_master_mk` VALUES ('64A935', 'Workshop Multimedia', 3);
INSERT INTO `tk_master_mk` VALUES ('64A936', 'Multimedia Tools  I', 3);
INSERT INTO `tk_master_mk` VALUES ('64A937', 'Multimedia Tools  II', 3);
INSERT INTO `tk_master_mk` VALUES ('64A938', 'Topik Khusus Muktimedia', 3);
INSERT INTO `tk_master_mk` VALUES ('64A939', 'Game Programming', 3);
INSERT INTO `tk_master_mk` VALUES ('64A940', 'Topik Khusus Grafkom', 3);
INSERT INTO `tk_master_mk` VALUES ('64A941', 'Pengolahan Citra Digital', 3);
INSERT INTO `tk_master_mk` VALUES ('64A950', 'Topik Khusus Jaringan Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('64A951', 'Workshop Jaringan Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('64A952', 'Topik Khusus Internet', 3);
INSERT INTO `tk_master_mk` VALUES ('64A953', 'Aplikasi E-Bisnis', 3);
INSERT INTO `tk_master_mk` VALUES ('64A954', 'Topik Khusus Sistem Terdistribusi', 3);
INSERT INTO `tk_master_mk` VALUES ('64A955', 'Pemrograman Nirkabel', 3);
INSERT INTO `tk_master_mk` VALUES ('64A956', 'Interfacing', 3);
INSERT INTO `tk_master_mk` VALUES ('64A957', 'Topik Khusus Keamanan Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('64A958', 'Pemrograman Internet dengan JAVA', 3);
INSERT INTO `tk_master_mk` VALUES ('64A959', 'Pemrog. Terdistribusi dengan JAVA', 3);
INSERT INTO `tk_master_mk` VALUES ('64A960', 'Pemrograman JAVA', 3);
INSERT INTO `tk_master_mk` VALUES ('64A975', 'Sistem Pakar', 3);
INSERT INTO `tk_master_mk` VALUES ('64A976', 'Text Mining', 3);
INSERT INTO `tk_master_mk` VALUES ('64A977', 'Data Mining', 3);
INSERT INTO `tk_master_mk` VALUES ('64A978', 'Neuro Fuzzy', 3);
INSERT INTO `tk_master_mk` VALUES ('64A979', 'Topik Khusus Intelejensia Buatan', 3);
INSERT INTO `tk_master_mk` VALUES ('64A980', 'Topik Khusus Algoritma & Pemrogaman', 3);
INSERT INTO `tk_master_mk` VALUES ('64A981', 'Topik Khusus Optimasi', 3);
INSERT INTO `tk_master_mk` VALUES ('64A982', 'Topik Khusus Pemodelan', 3);
INSERT INTO `tk_master_mk` VALUES ('64A983', 'Pengantar Bahasa Natural', 3);
INSERT INTO `tk_master_mk` VALUES ('64A984', 'Topik Khusus Statistik Terapan', 3);
INSERT INTO `tk_master_mk` VALUES ('65A211', 'Pengetahuan Bahan Teknik I', 2);
INSERT INTO `tk_master_mk` VALUES ('65A212', 'Pengantar Teknik Manufaktur', 3);
INSERT INTO `tk_master_mk` VALUES ('65A213', 'Program Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('65A221', 'Mekanika Teknik', 4);
INSERT INTO `tk_master_mk` VALUES ('65A222', 'Pengetahuan Bahan Teknik II', 2);
INSERT INTO `tk_master_mk` VALUES ('65A223', 'Menggambar Teknik', 2);
INSERT INTO `tk_master_mk` VALUES ('65A224', 'Computer Aided Design', 2);
INSERT INTO `tk_master_mk` VALUES ('65A231', 'Termodinamika', 3);
INSERT INTO `tk_master_mk` VALUES ('65A233', 'Kekuatan Material', 2);
INSERT INTO `tk_master_mk` VALUES ('65A234', 'Proyek Gambar Teknik', 1);
INSERT INTO `tk_master_mk` VALUES ('65A241', 'Rangkaian Listrik & Elektronika', 3);
INSERT INTO `tk_master_mk` VALUES ('65A242', 'Mekanika Fluida', 3);
INSERT INTO `tk_master_mk` VALUES ('65A251', 'Perpindahan Panas', 3);
INSERT INTO `tk_master_mk` VALUES ('65A266', 'Penyelidikan Operasional', 2);
INSERT INTO `tk_master_mk` VALUES ('65A332', 'Proses Manufaktur I', 3);
INSERT INTO `tk_master_mk` VALUES ('65A343', 'Proses Manufaktur II', 3);
INSERT INTO `tk_master_mk` VALUES ('65A344', 'Elemen Mesin I', 3);
INSERT INTO `tk_master_mk` VALUES ('65A352', 'Proses Manufaktur III', 3);
INSERT INTO `tk_master_mk` VALUES ('65A353', 'Elemen Mesin II', 2);
INSERT INTO `tk_master_mk` VALUES ('65A354', 'Peranc. & Pengembangan Produk', 3);
INSERT INTO `tk_master_mk` VALUES ('65A355', 'Metrologi Industri', 2);
INSERT INTO `tk_master_mk` VALUES ('65A356', 'Otomasi Industri I', 3);
INSERT INTO `tk_master_mk` VALUES ('65A361', 'Mould Design', 3);
INSERT INTO `tk_master_mk` VALUES ('65A362', 'Praktikum Proses Manufaktur', 1);
INSERT INTO `tk_master_mk` VALUES ('65A363', 'Analisis Produk Manufaktur', 2);
INSERT INTO `tk_master_mk` VALUES ('65A364', 'Analisis & Perancangan Mekanik', 3);
INSERT INTO `tk_master_mk` VALUES ('65A367', 'Otomasi Industri II', 2);
INSERT INTO `tk_master_mk` VALUES ('65A368', 'Pengantar Analisis Biaya', 3);
INSERT INTO `tk_master_mk` VALUES ('65A371', 'Tool Design', 2);
INSERT INTO `tk_master_mk` VALUES ('65A373', 'Perenc. & Pengendalian Produksi', 3);
INSERT INTO `tk_master_mk` VALUES ('65A374', 'Desain Eksperimen', 3);
INSERT INTO `tk_master_mk` VALUES ('65A375', 'Design Project', 2);
INSERT INTO `tk_master_mk` VALUES ('65A376', 'CNC & CAM', 4);
INSERT INTO `tk_master_mk` VALUES ('65A381', 'Perancangan Sistem Manufaktur', 2);
INSERT INTO `tk_master_mk` VALUES ('65A465', 'Pengetahuan Lingkungan Hidup', 2);
INSERT INTO `tk_master_mk` VALUES ('65A572', 'Kerja Praktek', 1);
INSERT INTO `tk_master_mk` VALUES ('65A582', 'Tugas Akhir', 5);
INSERT INTO `tk_master_mk` VALUES ('65A801', 'Proses Pengecoran', 2);
INSERT INTO `tk_master_mk` VALUES ('65A802', 'Assembly Processes', 2);
INSERT INTO `tk_master_mk` VALUES ('65A803', 'Manajemen Kualitas', 2);
INSERT INTO `tk_master_mk` VALUES ('65A804', 'Teknik & Manajemen Perawatan', 2);
INSERT INTO `tk_master_mk` VALUES ('65A805', 'T K Teknik & Manaj. Produksi', 2);
INSERT INTO `tk_master_mk` VALUES ('65A901', 'Finite Element Method & CAE', 2);
INSERT INTO `tk_master_mk` VALUES ('65A902', 'Integrated Product Design', 2);
INSERT INTO `tk_master_mk` VALUES ('65A903', 'Geometric Tolerancing', 2);
INSERT INTO `tk_master_mk` VALUES ('65A904', 'Optimasi Perancangan dan Proses', 2);
INSERT INTO `tk_master_mk` VALUES ('65A905', 'Value Engineering', 2);
INSERT INTO `tk_master_mk` VALUES ('65A906', 'Topik Khusus Desain Produk', 2);
INSERT INTO `tk_master_mk` VALUES ('66A211', 'Matematika Perancangan', 4);
INSERT INTO `tk_master_mk` VALUES ('66A212', 'Fisika Perancangan', 3);
INSERT INTO `tk_master_mk` VALUES ('66A213', 'Rupa Dasar I', 3);
INSERT INTO `tk_master_mk` VALUES ('66A214', 'Kreatifitas I', 3);
INSERT INTO `tk_master_mk` VALUES ('66A215', 'Gambar Bentuk I', 3);
INSERT INTO `tk_master_mk` VALUES ('66A221', 'Rupa Dasar II', 3);
INSERT INTO `tk_master_mk` VALUES ('66A222', 'Kreatifitas II', 3);
INSERT INTO `tk_master_mk` VALUES ('66A223', 'Gambar Bentuk II', 3);
INSERT INTO `tk_master_mk` VALUES ('66A224', 'Sejarah Desain & Desain Produk', 3);
INSERT INTO `tk_master_mk` VALUES ('66A231', 'Estetika', 2);
INSERT INTO `tk_master_mk` VALUES ('66A232', 'Pemodelan', 3);
INSERT INTO `tk_master_mk` VALUES ('66A241', 'Analisis Biaya', 3);
INSERT INTO `tk_master_mk` VALUES ('66A242', 'Mekanisme Gerak', 2);
INSERT INTO `tk_master_mk` VALUES ('66A261', 'Desain Komunikasi II', 2);
INSERT INTO `tk_master_mk` VALUES ('66A331', 'Proyek Desain Produk I', 4);
INSERT INTO `tk_master_mk` VALUES ('66A341', 'Proyek Desain Produk II', 4);
INSERT INTO `tk_master_mk` VALUES ('66A342', 'Computer Aided Industrial Design', 2);
INSERT INTO `tk_master_mk` VALUES ('66A351', 'Strategi Bisnis', 2);
INSERT INTO `tk_master_mk` VALUES ('66A352', 'Apresiasi Desain', 2);
INSERT INTO `tk_master_mk` VALUES ('66A353', 'Desain Komunikasi I', 2);
INSERT INTO `tk_master_mk` VALUES ('66A354', 'Proyek Desain Produk III', 5);
INSERT INTO `tk_master_mk` VALUES ('66A355', 'Psikologi Pemasaran', 2);
INSERT INTO `tk_master_mk` VALUES ('66A356', 'Manajemen Pemasaran II', 2);
INSERT INTO `tk_master_mk` VALUES ('66A361', 'New Product Management', 2);
INSERT INTO `tk_master_mk` VALUES ('66A362', 'Presentasi Desain dan Fotografi', 2);
INSERT INTO `tk_master_mk` VALUES ('66A363', 'Riset Desain', 2);
INSERT INTO `tk_master_mk` VALUES ('66A364', 'Proyek Desain Produk IV', 5);
INSERT INTO `tk_master_mk` VALUES ('66A365', 'Manajemen & Studi Kelayakan Proyek', 3);
INSERT INTO `tk_master_mk` VALUES ('66A371', 'Proposal Desain', 3);
INSERT INTO `tk_master_mk` VALUES ('66A372', 'Proyek Desain Produk V', 5);
INSERT INTO `tk_master_mk` VALUES ('66A373', 'Life Cycle Management', 2);
INSERT INTO `tk_master_mk` VALUES ('66A571', 'Kerja Praktek', 2);
INSERT INTO `tk_master_mk` VALUES ('66A581', 'Tugas Akhir', 7);
INSERT INTO `tk_master_mk` VALUES ('66A801', 'Customer Relationship Management', 3);
INSERT INTO `tk_master_mk` VALUES ('66A901', 'Mebel I', 3);
INSERT INTO `tk_master_mk` VALUES ('66A902', 'Mebel II', 3);
INSERT INTO `tk_master_mk` VALUES ('67A111', 'Konsep Sistem Informasi', 3);
INSERT INTO `tk_master_mk` VALUES ('67A112', 'Matematika Bisnis', 3);
INSERT INTO `tk_master_mk` VALUES ('67A113', 'Pengantar Bisnis', 3);
INSERT INTO `tk_master_mk` VALUES ('67A114', 'Pengantar Teknologi Informasi', 3);
INSERT INTO `tk_master_mk` VALUES ('67A211', 'Teori Akuntansi', 3);
INSERT INTO `tk_master_mk` VALUES ('67A212', 'Analisis Proses Bisnis', 3);
INSERT INTO `tk_master_mk` VALUES ('67A213', 'Statistik Bisnis', 3);
INSERT INTO `tk_master_mk` VALUES ('67A311', 'Desain Sistem Informasi', 3);
INSERT INTO `tk_master_mk` VALUES ('67A312', 'Sistem Manajemen Basis Data', 3);
INSERT INTO `tk_master_mk` VALUES ('67A411', 'Manajemen Administrasi Basis Data', 3);
INSERT INTO `tk_master_mk` VALUES ('67A412', 'Jaringan Komputer', 3);
INSERT INTO `tk_master_mk` VALUES ('67A413', 'Komunikasi Intra Personil', 2);
INSERT INTO `tk_master_mk` VALUES ('67A511', 'Sistem Informasi Manajemen', 3);
INSERT INTO `tk_master_mk` VALUES ('67A512', 'Testing dan Implementasi Sistem', 3);
INSERT INTO `tk_master_mk` VALUES ('67A513', 'Pemrograman Java', 3);
INSERT INTO `tk_master_mk` VALUES ('67A514', 'Proyek Pengemb. Sistem Informasi I', 2);
INSERT INTO `tk_master_mk` VALUES ('67A515', 'System Design Usability', 3);
INSERT INTO `tk_master_mk` VALUES ('67A611', 'Manajemen Proyek Sistem Informasi', 3);
INSERT INTO `tk_master_mk` VALUES ('67A612', 'Etika Profesi', 2);
INSERT INTO `tk_master_mk` VALUES ('67A613', 'Proyek Pengemb. Sistem Informasi II', 3);
INSERT INTO `tk_master_mk` VALUES ('67A711', 'Kerja Praktek', 2);
INSERT INTO `tk_master_mk` VALUES ('67A811', 'Tugas Akhir', 5);
INSERT INTO `tk_master_mk` VALUES ('67A900', 'Pengembangan Situs E-Commerce', 3);
INSERT INTO `tk_master_mk` VALUES ('67A901', 'Teknologi XML', 3);
INSERT INTO `tk_master_mk` VALUES ('67A925', 'Inteligensia Web', 3);
INSERT INTO `tk_master_mk` VALUES ('67A950', 'Perenc. Strategis Sistem Informasi', 3);
INSERT INTO `tk_master_mk` VALUES ('67A975', 'Basis Data Berorientasi Objek', 3);
INSERT INTO `tk_master_mk` VALUES ('68A101', 'Aplikasi Komputer Grafis I', 3);
INSERT INTO `tk_master_mk` VALUES ('68A201', 'Aplikasi Komputer Grafis II', 3);
INSERT INTO `tk_master_mk` VALUES ('68A202', 'Sejarah Seni', 2);
INSERT INTO `tk_master_mk` VALUES ('68A301', 'Desain Grafis', 3);
INSERT INTO `tk_master_mk` VALUES ('68A401', 'Pemodelan 3D', 3);
INSERT INTO `tk_master_mk` VALUES ('68A402', 'Tipografi', 3);
INSERT INTO `tk_master_mk` VALUES ('68A403', 'Desain Web', 3);
INSERT INTO `tk_master_mk` VALUES ('68A501', 'Desktop Publishing', 3);
INSERT INTO `tk_master_mk` VALUES ('68A502', 'Animasi 3D', 3);
INSERT INTO `tk_master_mk` VALUES ('68A601', 'Multimedia Studio I', 3);
INSERT INTO `tk_master_mk` VALUES ('68A602', 'Game Development', 3);
INSERT INTO `tk_master_mk` VALUES ('68A603', 'Audio & Video Digital', 3);
INSERT INTO `tk_master_mk` VALUES ('68A701', 'Kerja Praktek', 2);
INSERT INTO `tk_master_mk` VALUES ('68A702', 'Multimedia Studio II', 4);
INSERT INTO `tk_master_mk` VALUES ('68A801', 'Tugas Akhir', 6);
INSERT INTO `tk_master_mk` VALUES ('68A901', 'Topik Khusus 3D', 3);
INSERT INTO `tk_master_mk` VALUES ('68A902', 'Workshop 3D', 3);
INSERT INTO `tk_master_mk` VALUES ('68A903', 'Topik Khusus Pemrograman Web', 3);
INSERT INTO `tk_master_mk` VALUES ('68A904', 'Topik Khusus Animasi', 3);
INSERT INTO `tk_master_mk` VALUES ('68A905', 'Workshop Desain Grafis', 3);
INSERT INTO `tk_master_mk` VALUES ('68A906', 'Topik Khusus Aplikasi Multimedia', 3);
INSERT INTO `tk_master_mk` VALUES ('68A907', 'Wokshop Aplikasi Multimedia', 3);
INSERT INTO `tk_master_mk` VALUES ('68A908', 'Workshop Pemrograman Game', 3);
INSERT INTO `tk_master_mk` VALUES ('68A909', 'Workshop Fotografi', 3);
INSERT INTO `tk_master_mk` VALUES ('68A910', 'Workshop Audio Vsiual', 3);
INSERT INTO `tk_master_mk` VALUES ('68A911', 'T K Pengolahan Citra Digital', 3);
INSERT INTO `tk_master_mk` VALUES ('68A912', 'Aplikasi Jaringan Komputer', 3);

-- --------------------------------------------------------

-- 
-- Table structure for table `tk_mhs`
-- 

CREATE TABLE `tk_mhs` (
  `nrp` varchar(8) NOT NULL,
  `sksmax` decimal(10,0) default NULL,
  `ips` float default NULL,
  `status` varchar(2) default NULL,
  `jurusan` varchar(5) default NULL,
  `nama` varchar(50) default NULL,
  `alamat` varchar(50) default NULL,
  `tgllahir` date default NULL,
  `tmplahir` varchar(13) default NULL,
  `totbss` decimal(10,0) NOT NULL,
  `ipk` float default NULL,
  `skskum` decimal(10,0) default NULL,
  `telepon` varchar(12) default NULL,
  `password` varchar(8) default NULL,
  `angkatan` varchar(4) default NULL,
  `namasma` varchar(16) default NULL,
  `namaortu` varchar(25) default NULL,
  `kelamin` varchar(1) default NULL,
  `asisten` varchar(1) NOT NULL,
  PRIMARY KEY  (`nrp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `tk_mhs`
-- 

INSERT INTO `tk_mhs` VALUES ('6021001', 24, 4, '', '61-61', 'KHANDAR ANTHONY SUDONO', 'BABATAN PANTAI UTARA 2 41 -Surabaya', '1985-02-13', 'Surabaya', 0, 3.14, 144, '3810179', '32557872', '6021', 'SMUK SANTO YUSUF', 'KHANIS SULAIHOK', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021003', 16, 1.33, 'P', '61-61', 'NOORADIN ARROHMANI', 'KREMBANGAN JAYA SEL 1 30A -Surabaya', '1983-07-26', 'Kota Waringin', 0, 2.18, 33, '3541729', '26-07-83', '6021', '05011142', 'H AK BAROGHIS MHUM', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021005', 20, 0.19, '', '61-61', 'ACHMAD SYAUGIE ALAYDRUS', 'KARANG REJO SAWAH 5 3     -Surabaya', '1982-12-26', 'Surabaya', 0, 2.17, 103, '8291480', '39030167', '6021', '05010007', 'BUDI IRWAN S', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021006', 14, 1.2, 'P', '61-61', 'DEDI SETIAWAN', 'SIMO HILIR UTR 06G 1      -Surabaya', '1983-07-22', 'Surabaya', 0, 1.87, 38, '7312637', '22-07-83', '6021', '0x011068', 'SUGIONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021007', 24, 3.65, 'N', '61-61', 'ADEAN SALAM PARDANA PUTRA', 'JL JOHAR2 14 REWWIN2 WARU -Sidoarjo', '1984-03-11', 'Sidoarjo', 0, 3.09, 146, '8535717', '11-03-84', '6021', '0501000*', 'SALEH MUHAMMADY', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021008', 14, 0.44, 'DO', '61-61', 'IWAN WIDODO', 'KERANTIL  1 260           -Blitar', '1984-03-06', 'Blitar', 0, 1.33, 6, '', '31651620', '6021', '05061010', 'WIDYA SETIAWATI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021009', 18, 1.75, 'P', '61-61', 'RONALD FAHRIZAL', 'GRUDO 3 NO 11             -Surabaya', '1984-06-05', 'Surabaya', 1, 1.63, 20, '5611262', '05-06-84', '6021', '05010007', 'HARRY F GUNARDI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021011', 16, 1.08, 'DO', '61-61', 'SATRIO YUSMANTORO', 'WARU INDAH 21 REWWIN      -Surabaya', '1984-02-15', 'Surabaya', 0, 1.9, 30, '8662841', '91709776', '6021', '05010015', 'SUBIYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021012', 20, 1.93, 'DO', '61-61', 'ACHMAD NAJARUDIN', 'MOROKREMBANGAN 6 11 SBY   -Surabaya', '1982-04-06', 'Surabaya', 2, 2.26, 61, '07480054', '27609438', '6021', '05010006', 'HERU BUDI YAMI I', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021013', 14, 0.18, 'DO', '61-61', 'HENDRA  FERDYANTO', 'MANYAR SABRANGAN 40       -Surabaya', '1983-06-23', 'Surabaya', 0, 1.25, 4, '5930959', '69864981', '6021', '05011143', 'EKO MUDJIANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021014', 22, 2.69, '', '61-61', 'ARIF RAHMAN AZIZI', 'JL HUSEIN IDRIS 2 SPJ     -Sidoarjo', '1983-07-01', 'Sidoarjo', 0, 2.59, 154, '', '79414722', '6021', '05010006', 'MOCH ICHSAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021017', 16, 1.92, 'TD', '61-61', 'TJEN TEK HONG', 'KALIMAS UDIK 3 9          -Surabaya', '1983-11-05', 'Surabaya', 3, 2.2, 106, '3528760', '44493944', '6021', '05011149', 'TJEN TJIN WI WOE', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021018', 20, 1.71, '', '61-61', 'CHANDRA SAGITA UTAMA', 'CENDRAWASIH CB 01         -Gresik', '1984-12-19', 'Palembang', 0, 2.5, 123, '3953692', '13524306', '6021', '05550001', 'JOHNY SUNARYO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021019', 14, 0, 'DO', '61-61', 'WAHYUDI KURNIAWAN', 'JL MOJOPAHIT SEMPUSARI T22-Jember', '1981-09-30', 'Bondowoso', 0, 1, 1, '483012', '88180486', '6021', '05211012', 'SUNATA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021020', 14, 0, 'DO', '61-61', 'ANGGA DEFIAR AKBAR', 'PEPELEGI INDAH 15 WARU SDA-Sidoarjo', '1984-05-29', 'Jombang', 0, 0, 0, '8538311', '54281929', '6021', '05010001', 'BUDI WIYONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021022', 14, 0, 'DO', '61-61', 'RIO WIBISONO', 'GAYUNG KEBON SARI NO 133  -Surabaya', '1984-05-19', 'Surabaya', 0, 0, 0, '08295023', '83963820', '6021', '05010005', 'R KARDANI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021023', 24, 0, 'P', '61-61', 'STEFANUS', 'KEDUNGD0R0 9 6            -Surabaya', '1984-09-04', 'Sumenep', 1, 0, 0, '547541', '04-09-84', '6021', '05011155', 'PAULUS SH', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021024', 14, 0, 'DO', '61-61', 'HENDRA RAHMAD', 'JL JAMBU 6 E125 PCI SBY   -Surabaya', '1983-03-03', 'Jember', 0, 1, 3, '8665590', '67058021', '6021', '05211012', 'WIDJONARKO RAHMAD', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021025', 22, 1.58, 'TD', '61-61', 'YUDHA CHANDRA KARISMA', 'WISMA KED ASEM INDAH E 16 -Surabaya', '1983-09-20', 'Surabaya', 0, 2.52, 140, '8711235', '50790908', '6021', '05010016', 'ENDANG SUDRAJAT', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021028', 20, 1.24, 'Tu', '61-61', 'YULIANDRY SURYO NEGORO', 'RUNGKUT MAPAN TENGAH 3DB14-SURABAYA', '1984-07-06', 'Surabaya', 0, 2.32, 113, '8704923', '93726580', '6021', '05011077', 'BAMBANG DP', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021029', 14, 0.85, 'P', '61-61', 'MAI HENDRA JAYA PUTRA', 'PCI BLOK D69 12A CILEGON  -Serang', '1983-05-24', 'Kutai', 0, 1.96, 14, '382140', '24-05-83', '6021', '02499999', 'CIPTA D PUTRA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021030', 16, 0.97, 'P', '61-61', 'ERNY OCTAVIA', 'SRUNI JL NANGKA 309       -Sidoarjo', '1982-10-13', 'Sidoarjo', 0, 2.1, 59, '8910226', '13-10-82', '6021', '05451014', 'SUNAIB', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6021033', 22, 2.61, '', '61-61', 'HENDRA ANGERTO', 'JL KAPITAN MALONGI        -Maluku T', '1983-12-13', 'Maluku Tengga', 1, 2.1, 139, '21017', '13426564', '6021', '21319999', 'HERDIANTO ANGGREK', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021034', 16, 1.55, 'DO', '61-61', 'DONI NGADIMAN', 'BRATANG 1F NO11A          -SURABAYA', '1983-09-09', 'Medan', 0, 2.31, 36, '5020969', '29517442', '6021', '05011057', 'BUDYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021036', 24, 4, '', '61-61', 'FRANSISKA AMELIA', 'PANTAI MENTARI M-31 SURABAYA', '1984-04-08', 'Yogyakarta', 0, 3.65, 147, '3819375', '24278025', '6021', '04011016', 'KOO KIEM ENG', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6021037', 14, 0, 'DO', '61-61', 'ARIF SUGIARTO', 'PEPELEGI INDAH G 10       -Sidoarjo', '1983-06-30', 'Jember', 0, 2.09, 27, '8537882', '58703864', '6021', '05010006', 'AGUNG HARIANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021039', 24, 0, 'K', '61-61', 'FERY KURNIAWAN DJUNAIDY', 'JL SUROPATI 19 NGORO      -Jombang', '1982-02-03', 'Jombang', 0, 0, 0, '710208', '03-02-82', '6021', '05470001', 'DJUNAID Y', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021041', 14, 0, 'DO', '61-61', 'PRIMA PRAMUDYA A.', 'SIMOKERTO 3 68 SURABAYA   -Surabaya', '1908-04-17', 'Ujung Pandang', 0, 0, 0, '3712674', '65378635', '6021', '05010005', 'AHMAD FANDI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021043', 14, 0.83, 'P', '61-61', 'DHARMA ENDAR YUDISTHIRA', 'JL IKAN MUGGSING 8 35     -Surabaya', '1984-10-28', 'Surabaya', 1, 2.5, 6, '3539694', '28-10-84', '6021', '05010008', 'ENDANG SUDARSONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021044', 14, 1.12, 'P', '61-61', 'YUDHI ARDIAN', 'SIDOKARE INDAH FF 02 SDA  -Sidoarjo', '1983-11-19', 'Sidoarjo', 0, 1.87, 92, '8945919', '19-11-83', '6021', '05451019', 'SUGITO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021045', 16, 1.35, 'DO', '61-61', 'FATHUR RACHMAN', 'PLOSO 8C 3                -Surabaya', '1984-12-03', 'Balikpapan', 0, 1.72, 46, '5035789', '18812664', '6021', '16021013', 'MARIANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021046', 14, 0.56, 'DO', '61-61', 'HENDRA DWI KRISHNANTO', 'JL SWADAYA 103 GEDANGAN   -Sidoarjo', '1984-04-26', 'Surabaya', 0, 2.2, 10, '8532047', '60459206', '6021', '05451077', 'HERU SUSANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021047', 24, 4, 'N', '61-61', 'BADRUS TALIS YULIARTO', 'JL SIDOLUHUR 19 SURAKARTA -Surakart', '1983-07-06', 'Surakarta', 0, 3.03, 146, '712417', '06-07-83', '6021', '03029999', 'BAMBANG SLAMETO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021048', 16, 0, 'DO', '61-61', 'HARTONO', 'VETERAN 34 BONE           -Bone', '1983-10-18', 'Ujung Pandang', 0, 2.1, 40, '21527', '23283531', '6021', '19389999', 'SOECHINTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021049', 24, 4, 'Tu', '61-61', 'HANDIANSYAH SEHAN', 'JL TENGGILIS MEJOYO AF 42 -Surabaya', '1984-09-15', 'Balikpapan', 0, 2.78, 154, '8410986', '10585960', '6021', '16020001', 'FOE HENDRA SUMANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021050', 22, 2.53, '', '61-61', 'PRAMUDITA TRIATMOKO', 'JL KARANGREJO SAWAH 2 19  -Surabaya', '1985-01-01', 'Padang', 0, 2.66, 161, '8282922', '80141579', '6021', '08019999', 'TRI BUDIYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021051', 20, 2, 'TD', '61-61', 'TAKDIR UTAMA TIKA', 'TENGGILIS MJY SLTN 3 N39  -Surabaya', '1982-02-05', 'Sorong', 0, 2.14, 137, '8432985', '25208224', '6021', '19019999', 'THOMAS TIKA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021052', 24, 4, '', '61-61', 'RIDHO AJI PREHANA', 'JAMBU RAYA 48 KAMAL       -Bangkala', '1984-04-20', 'Bangkalan', 0, 3.14, 147, '3011426', '57849125', '6021', '05011046', 'REMBUN SUDADI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021053', 20, 1.35, '', '61-61', 'SUHENDRO SANDI HOUYENSYAH', 'TENGGILIS MEJOYO W23      -Surabaya', '1984-08-19', 'Balikpapan', 0, 2.37, 135, '8433850', '80849164', '6021', '16020001', 'YENI PANGESTU', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021054', 24, 4, '', '61-61', 'LEONARD', 'GUBENG POJOK DALAM 7      -Surabaya', '1981-12-07', 'Surabaya', 0, 3.02, 144, '5475574', '95984846', '6021', '05011101', 'LINAWATI BUDIJANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021055', 20, 1.58, '', '61-61', 'ROMYANTO', 'JLN JUWINGAN NO 93        -Surabaya', '1982-03-24', 'Luwu', 0, 2.18, 146, '5014374', '13153501', '6021', '19019999', 'DANIEL RABA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021056', 14, 1.2, 'P', '61-61', 'TEGUH ARI WIBOWO', 'MANUKAN SARI VIII 3C 4    -Surabaya', '1984-05-25', 'Surabaya', 0, 1.91, 38, '7412507', '25-05-84', '6021', '05011070', 'ATEKAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021057', 16, 1.07, 'DO', '61-61', 'MUHAMMAD RIZAL', 'SEMOLOWARU INDAH S 16     -Surabaya', '1983-07-03', 'Surabaya', 1, 1.8, 23, '5931550', '26077006', '6021', '05011142', 'ABDUL RACHMAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021058', 14, 0, 'DO', '61-61', 'DIMAS NUSANTORO', 'RUNGKUT BARATA 2 1        -SURABAYA', '1980-02-22', 'Surabaya', 0, 0, 0, '', '88801859', '6021', '05010020', 'MOHAMAD YAKIN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021059', 14, 1.23, 'P', '61-61', 'MUHAMMAD IMAM KHAIRUDIN', 'JL BOGEN 1 24 SURABAYA    -SURABAYA', '1984-07-28', 'Surabaya', 0, 2.11, 87, '5034259', '28-07-84', '6021', '05011105', 'MOCH NOOR RACHMAD', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021801', 24, 4, '', '61-61', 'YULI SETIAWAN', 'PURWOTENGAH 4 25          -Mojokert', '1984-07-12', 'Mojokerto', 0, 3.41, 148, '328232', '96893632', '6021', '05021011', 'BIANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021803', 24, 4, '', '61-61', 'FI HWANG TANANGTO', 'P SUDIRMAN NO 176 TUBAN   -Tuban', '1984-08-30', 'Surabaya', 0, 3.33, 149, '321847', '87442472', '6021', '05011101', 'TAN MINTAN SISWANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021804', 14, 0, 'TD', '61-61', 'TJANDRA PRAWITO', 'MANYAR JAYA 13 183        -Surabaya', '1984-09-26', 'Madiun', 4, 2.08, 50, '5944593', '24406226', '6021', '05011100', 'TJU AI LIAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021805', 24, 3.5, 'N', '61-61', 'PURNOMO KRISTANTO', 'PETEMON 4 203             -Surabaya', '1984-09-12', 'Surabaya', 0, 3.79, 155, '5350857', '12-09-84', '6021', '05011115', 'ATMADJA KRISTANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021808', 22, 2.66, 'DO', '61-61', 'SATRIO SUDIMAN', 'HIDAYATULLAH 47           -Samarind', '1899-12-30', 'SURABAYA', 1, 2.3, 48, '204552', '81563179', '6021', '16011013', '', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6021991', 20, 2.15, 'DO', '61-61', 'ROBERT LIMPO', 'KARANG ASEM 16 39         -Surabaya', '1984-03-20', 'Surabaya', 1, 2.14, 66, '3815278', '33378188', '6021', '05011149', 'KLEMENS LIMPO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022003', 24, 3.25, 'N', '62-62', 'MARIA FRANSISCA ANGELIA HERYAN', 'JLSAWUNGGALING 108        -SURABAYA', '1985-01-05', 'Bojonegoro', 0, 3.28, 148, '882442', '05-01-85', '6022', 'xx031029', 'LILIK RAHAYU', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022004', 24, 2.95, 'DO', '62-62', 'SHINTA DEWI CHANDRA', 'GEMAH RAYA 32             -Semarang', '1984-03-20', 'Semarang', 0, 3.21, 41, '6712514', '25427780', '6022', '03041022', 'RONNY CHANDRA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022005', 24, 3.25, 'N', '62-62', 'INNEKE KUSUMADEWI', 'THAMRIN 65                -Madiun', '1983-09-02', 'Malang', 0, 3.46, 146, '462942', '02-09-83', '6022', 'SMUK SANTO YUSUF', 'HARY CHRISTIANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022006', 24, 3.32, 'N', '62-62', 'WENNY ARISTA CAROLINA', 'SEMARANG INDAH C18 NO 1   -Semarang', '1985-04-03', 'Semarang', 0, 2.84, 148, '7604844', '03-04-85', '6022', '03041022', 'YULIA SURYANTI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022007', 24, 3.15, 'N', '62-62', 'BENI HERMAWAN', 'TEUKU UMAR NO 21          -Denpasar', '1983-04-15', 'Pasuruan', 0, 2.93, 146, '410840', '15-04-83', '6022', '16020001', 'FRANKY HARIYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022008', 24, 3.48, '', '62-62', 'WISNU RISTANDI', 'KREMBANGAN BHAKTI 29      -Surabaya', '1984-04-15', 'Surabaya', 0, 2.81, 144, '3538838', '72443274', '6022', '05010007', 'SUDJARWO SH', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022010', 24, 3.5, 'N', '62-62', 'RONALD MARIO HEAVENTY LUANDJAJ', 'SIMPANG BOROBUDUR         -Malang', '1984-08-13', 'Kupang', 0, 3.19, 148, '491776', '13-08-84', '6022', '05031037', 'COSMAS LUANDJAJA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022011', 14, 0, 'DO', '62-62', 'SHERLIN LIANA TANHANGKARA', 'PANDAN WANGI 74 RT 20     -Balikpap', '1985-04-24', 'Balikpapan', 0, 0, 0, '424914', '10290582', '6022', 'SMUK SANTO YUSUF', 'JONNA TANHANGKARA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022012', 24, 3.54, 'N', '62-62', 'NISYE KUSUMAWATI', 'TENGGILIS MEJOYO AM 14    -Surabaya', '1984-06-16', 'Surakarta', 0, 3.19, 149, '8410082', '16-06-84', '6022', '03021018', 'TONY HARTANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022013', 20, 2.33, '', '62-62', 'MARTINUS DAVID SETIAWAN', 'JL SIMPANG BOROBUDUR 28   -Malang', '1985-03-18', 'Jakarta Barat', 0, 2.05, 150, '496942', '99222066', '6022', '05031098', 'LIAW  ALEX SETIAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022014', 24, 3.58, 'N', '62-62', 'CHRISTINA NATALIA', 'TMN BOROBUDUR TENGAH 3    -Malang', '1983-12-04', 'Malang', 0, 3.39, 146, '493269', '04-12-83', '6022', '05031029', 'HENDRO DWIYONO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022017', 24, 3.15, '', '62-62', 'PASTI RONIDA ANDRINI SUSANNA T', 'KLAMPIS SEMOLO TENGAH 4 14-Surabaya', '1984-06-06', 'Surabaya', 0, 2.73, 147, '5922645', '47933545', '6022', '05010009', 'HRL TOBING', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022020', 20, 1.62, 'P', '62-62', 'SYENI YUNITA CHRYSTIANTI', 'RAYATAWANG71 WATES KEDIRI -Kediri', '1985-06-30', 'Purbalingga', 0, 2.21, 19, '442215', '30-06-85', '6022', '05051012', 'SOEDJIWA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022021', 24, 3, '', '62-62', 'NORA NOVIANTI S.', 'JALAN MAWAR 19 GEDANGAN   -Sidoarjo', '1982-10-27', 'Surabaya', 0, 2.67, 146, '8541967', '73805736', '6022', '05450001', 'SUYANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022022', 24, 3.5, 'N', '62-62', 'MARITTA LIANA', 'PONDOK SEJATI INDAH 5 16  -Pasuruan', '1984-03-02', 'Pasuruan', 0, 2.78, 149, '422512', '02-03-84', '6022', '0x040001', 'HADI SISWANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022023', 24, 3.67, 'N', '62-62', 'STANISLAUS RADITYA SUWARNO', 'SIMPANG DARMO PERMAI S 43 -Surabaya', '1985-10-09', 'Surabaya', 0, 3.21, 148, '7341211', '09-10-85', '6022', '05011114', 'DWI SUWARNO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022024', 24, 3.16, 'N', '62-62', 'SINTHYA CHRISTIANTI', 'WIJAYA KUSUMA 6           -Banyuwan', '1984-04-24', 'Banyuwangi', 0, 2.57, 147, '422346', '24-04-84', '6022', '03031004', 'WELLY WIRYANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022025', 14, 0, 'TD', '62-62', 'ANDY SANTOSO', 'JAGALAN BARAT 529         -Semarang', '1984-07-04', 'Semarang', 2, 2.06, 79, '3517786', '15347172', '6022', '03041022', 'POEI HOK TJIE', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022028', 22, 2.5, '', '62-62', 'HARMAN WIJAYA KUSUMA', 'NGAGLIK 18                -SURABAYA', '1983-08-09', 'Surabaya', 0, 3.02, 149, '5340860', '57253790', '6022', '05011115', 'TJOA JOUW', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022030', 24, 3, 'N', '62-62', 'HARTONO SANTOSO', '-', '1983-12-16', 'Surabaya', 0, 3.25, 146, '', '16-12-83', '6022', '05011096', 'BUDI SANTOSO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022034', 20, 2, '', '62-62', 'MELISSA LINDA ANGGRAENI', 'KALIMATI 4 40 MOJOKERT0   -Mojokert', '1983-10-13', 'Mojokerto', 0, 2.47, 145, '394591', '23408487', '6022', '05xx1012', 'EDY SANTOSO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022035', 22, 2.5, 'TD', '62-62', 'RB. INDRAYANA FIRMANSYAH', 'RUNGKUT MENANGGAL 2 21    -Surabaya', '1983-10-06', 'Surabaya', 0, 2.61, 147, '8703887', '19364462', '6022', '05010002', 'R AMIN TAUFIK EFENDI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022037', 24, 3.4, 'N', '62-62', 'ADI MULIA', 'HOS COKROAMINOTO 19       -Pematang', '1984-06-27', 'PEMATANG SIAN', 0, 2.86, 146, '22597', '27-06-84', '6022', '07041007', 'HERMAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022038', 14, 0, 'DO', '62-62', 'SIGIT DWI PRASTYANTO', 'RUNGKUT MEJOYO SEL VI 31  -Surabaya', '1984-06-01', 'Surabaya', 0, 0, 0, '8411226', '40934288', '6022', '05010002', 'SOEBIJANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022039', 24, 3.38, '', '62-62', 'JOHAN CAHYONO', 'SIDODADI 65               -Surabaya', '1984-02-16', 'Surabaya', 0, 2.81, 147, '3766629', '82391035', '6022', '05011087', 'AGUS CAHYONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022040', 24, 3, '', '62-62', 'CHANDRA LELIANA', 'WIROTO 11                -Blitar', '1983-09-26', 'Blitar', 0, 2.89, 147, '331415', '42474050', '6022', '05060001', 'BUDIONO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022041', 14, 0, 'DO', '62-62', 'RENDRA WAHYU HERYAWAN', 'GAYUNGSARI BARAT 11 GD6   -Surabaya', '1984-09-12', 'Surabaya', 0, 0, 0, '8280846', '16149474', '6022', '05010005', 'TJAHJA GUNAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022042', 22, 2.66, 'P', '62-62', 'PRAMUDITA TRIATMOJO', 'JL KARANGREJO SAWAH 2 19  -Surabaya', '1985-01-01', 'Padang', 0, 2.73, 41, '8282922', '01-01-85', '6022', '08019999', 'TRI BUDIYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022043', 14, 0, 'DO', '62-62', 'DEVI OKTARINI', 'JL BILITON 3 MOJOKERTO    -Mojokert', '1984-10-16', 'Mojokerto', 0, 0, 0, '322473', '27411191', '6022', '05021011', 'DR TRI WALUYO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022044', 14, 0, 'DO', '62-62', 'DERY VITRA YUNIARTA', 'HOP6 431 BONTANG KALTIM   -SURABAYA', '1984-06-30', 'Trenggalek', 0, 0, 0, '23974', '88001408', '6022', '16339999', 'MULYANI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022046', 16, 0, 'DO', '62-62', 'ANNY SETIAWATI', 'JL BRATANG WETAN GG 2 4   -Surabaya', '1984-11-22', 'Sumenep', 0, 1.75, 12, '5045359', '80576446', '6022', '05589999', 'SUGIANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022047', 14, 0, 'DO', '62-62', 'IKA MARYA AGUSTINA', 'PETERONGAN JOMBANG        -Jombang', '1983-08-18', 'Surabaya', 0, 1.95, 21, '860540', '80665490', '6022', '05471008', 'MARIANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022050', 22, 2.57, '', '62-62', 'WENTY EKA PRATIWI', 'JL SENAYAN 69 64          -Balikpap', '1984-07-16', 'Bojonegoro', 0, 2.12, 142, '735064', '27043432', '6022', '16020001', 'SUPRATNO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022051', 22, 2.5, '', '62-62', 'LILIS MUDJIARTI', 'JL SIMOREJOSARI A 35A     -Surabaya', '1984-09-03', 'Surabaya', 0, 2.45, 144, '7492117', '37479083', '6022', '05011046', 'MUDJ RI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022052', 14, 0, 'DO', '62-62', 'INDRA WENDA PRASETYA', 'JL KRANGGAN VI 79         -Surabaya', '1984-10-05', 'Surabaya', 0, 0, 0, '5476306', '64518005', '6022', '05011063', 'MOCH SOLEH', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022053', 14, 0, 'DO', '62-62', 'YOSI REAPRADANA', 'NGINDEN INTAN TIMUR D6 6  -Surabaya', '1984-05-09', 'Palembang', 0, 0, 0, '5949000', '58520913', '6022', '01029999', 'TEGUH JUWONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022802', 24, 3.25, 'N', '62-62', 'PHILIP GUNAWAN SUTANTO', 'SEROJA DALEM 2 5          -Semarang', '1984-04-16', 'Semarang', 0, 3.2, 150, '8317571', '16-04-84', '6022', '03041022', 'HADI SUTANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022803', 24, 3.07, 'N', '62-62', 'RATNA DEWI RUSLI', 'KRAKATAU GG 6 19 SMG      -Semarang', '1984-09-30', 'Semarang', 0, 2.89, 148, '8452838', '30-09-84', '6022', '03041022', 'SUDIJANTO RUSLI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022804', 24, 3.81, 'N', '62-62', 'MARIA IMELDA ANGGRAINI RIDWAN', 'WOTGANDUL DALAM 167       -Semarang', '1984-05-13', 'Semarang', 0, 3.42, 148, '3505339', '13-05-84', '6022', '03041022', 'ROBERTUS RIDWAN H', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022805', 24, 3.81, 'N', '62-62', 'AGUS SUBAGIO SUTANTO', 'KARANGGENENG UTARA 149B   -Semarang', '1984-11-18', 'Semarang', 0, 3.41, 148, '3547600', '18-11-84', '6022', '03041022', 'MARGONO SUTANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022806', 24, 3, '', '62-62', 'DAVID OKKY KURNIAWAN KOSASIH', 'R SUPRAPTO 35             -Grobogan', '1984-09-13', 'PURWODADI', 0, 2.71, 145, '421551', '31126844', '6022', '03041022', 'HARJANTO KOSASIH', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022807', 24, 3.9, 'N', '62-62', 'CHRISTIAN JANUAR HANDOYO', 'TAMBAK MAS 7 104          -Semarang', '1984-01-31', 'Semarang', 0, 3.61, 150, '', '31-01-84', '6022', '03041012', 'BUDIMULJONO HANDOJO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022808', 22, 2.82, '', '62-62', 'LUSI AMALIA', 'JL MADURA L 17 KEDIRI     -Kediri', '1983-12-31', 'Kediri', 0, 2.07, 146, '', '44855304', '6022', '05050009', 'MARGO MULJONO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022809', 24, 3, 'N', '62-62', 'RYAN BELLAMY PRASATYA', 'KETILENG ASRI IX F7       -Semarang', '1984-11-26', 'Semarang', 0, 2.87, 150, '6710129', '26-11-84', '6022', '03041022', 'AVIANTO PRASATYA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022810', 24, 3.25, 'N', '62-62', 'IRA ARYANI', 'GANG AMPERA 112 WELERI    -Semarang', '1984-11-24', 'Semarang', 0, 2.63, 146, '641174', '24-11-84', '6022', '03041022', 'HANDOYO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022811', 24, 3.78, 'N', '62-62', 'ADI RACHMADI WICAKSONO', 'JL IKAN MAS 6 11          -Malang', '1985-01-10', 'Surabaya', 0, 3.26, 147, '498269', '10-01-85', '6022', '05031025', 'TH A WAHJUDJATI STP', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022812', 24, 0, 'DO', '62-62', 'LOVIANI TJANDRA', '-', '1984-08-29', 'SURABAYA', 0, 3.37, 19, '', '74756224', '6022', '05500001', 'LIANAWATI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022813', 24, 3, 'TD', '62-62', 'SYELIN MELINA INDRAWIJAYA', 'BETON MAS RAYA B237       -Semarang', '1984-02-25', 'Semarang', 0, 2.4, 144, '3510790', '94369206', '6022', '03041014', 'DJONI INDRAWIJAYA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022814', 24, 3, '', '62-62', 'IKA KURNIAWATI', 'JEND A YANI 71            -Jombang', '1984-03-02', 'Jombang', 0, 2.39, 147, '869262', '28696746', '6022', '05470002', 'DINA HARTATI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022815', 24, 3.79, 'N', '62-62', 'MELA ROSMIATI', 'PADMONEGORO 30            -Surakart', '1983-10-25', 'Surakarta', 0, 3.58, 148, '653808', '25-10-83', '6022', '03020003', 'HENY INDRAWATI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022816', 24, 3.25, 'N', '62-62', 'VIVI SEPTA MARIA', 'WONO PERSEL II 40 BLKCC182-SURABAYA', '1984-09-14', 'Jember', 0, 3.37, 146, '', '14-09-84', '6022', '05211013', 'SUKIDJAN', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022817', 24, 3.88, 'N', '62-62', 'CRISTINE RUSTANTY', 'VETERAN 111               -Blitar', '1984-04-11', 'Blitar', 0, 3.83, 150, '803100', '11-04-84', '6022', '05060001', 'JUHDI DJIWAN R', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022818', 14, 0.11, 'DO', '62-62', 'ANDY PRASETIA', 'KUSUMA BANGSA108          -Surabaya', '1985-02-15', 'Surabaya', 0, 1, 2, '5343340', '74104112', '6022', '05011115', 'KOESNANDAR HADI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022819', 24, 3.82, 'N', '62-62', 'ALICE NATASSYA', 'BINTAN 9                  -Malang', '1984-03-05', 'Malang', 0, 3.54, 146, '326997', '05-03-84', '6022', '05031029', 'HADI TANOJO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022820', 20, 2.42, 'TD', '62-62', 'SHINTA NATHALIA', 'CANDI INDAH D2            -SURABAYA', '1984-11-20', 'Jombang', 0, 2, 132, '', '22369290', '6022', '05471009', 'BING DJWAN', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022821', 24, 3.75, 'N', '62-62', 'FELICIA LI', 'MARGOREJO INDAH C 718     -Surabaya', '1984-07-03', 'Surabaya', 0, 3.58, 153, '8475242', '03-07-84', '6022', '05011091', 'HENRIETA GUNAWAN', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022822', 20, 0, 'DO', '62-62', 'DEWI NIRMALA SURYANI', 'WONOREJO 1 82             -Surabaya', '1984-03-27', 'Surabaya', 0, 3.05, 41, '5314769', '19467762', '6022', '05011096', 'NJOO KIEM KUNG', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022823', 14, 0.21, 'DO', '62-62', 'ADIGUNA SANDJAJA', 'SULUNG 5 25               -Surabaya', '1983-02-26', 'Surabaya', 0, 1.48, 31, '', '63175697', '6022', '05011105', 'SINGGIH SANDJAJA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022825', 22, 2.83, '', '62-62', 'HAUZENLIES YEFRICO', 'STASIUN3                  -Kediri', '1984-08-04', 'Kediri', 0, 2.71, 147, '689353', '83608071', '6022', '05xx1012', 'YONG SUSANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022826', 24, 4, 'N', '62-62', 'NELLY ROESTINA', 'WONOREJO 2 38             -Surabaya', '1984-06-21', 'Surabaya', 0, 3.33, 149, '5343201', '21-06-84', '6022', '05011087', 'HADI SOEDARMONO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022827', 24, 3.75, 'N', '62-62', 'VIVI LESMANA', 'JALAN KRAKATAU 30         -Surabaya', '1985-04-17', 'Surabaya', 0, 3.57, 153, '5462338', '17-04-85', '6022', '05011087', 'BAMBANG LESMANA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022828', 24, 3.55, 'P', '62-62', 'SRI LESTARI WURI HANDAYANI', 'RAYA SATELIT UTARA DT 20  -Surabaya', '1984-07-02', 'Surabaya', 1, 3.7, 41, '7325128', '02-07-84', '6022', '05011160', 'EFFENDI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022829', 24, 3.33, 'N', '62-62', 'RIKO ARDI KURNIAWAN', 'JL PEMUDA 51 B MUNTILAN   -Magelang', '1984-09-01', 'Semarang', 0, 2.83, 146, '587104', '01-09-84', '6022', '03011004', 'ANTON SANTOSO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022832', 24, 3.91, 'N', '62-62', 'SILVIA CAROLINA', 'SIMP DARMO PERMAI SELXV 26-Surabaya', '1984-03-25', 'Surabaya', 0, 3.79, 150, '7311977', '25-03-84', '6022', '05011114', 'BAMBANG SUGIANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022833', 24, 3.75, 'N', '62-62', 'AI LIEN', 'TEMPEL SUKOREJO 3 7       -Surabaya', '1983-11-04', 'Surabaya', 0, 3.08, 147, '5313262', '04-11-83', '6022', '05011116', 'TJAN KEK IEN', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022835', 24, 4, 'N', '62-62', 'ANDREAS WONGSOWIDJAJA', 'MULYOSARI PRIMA 1 MD30    -Surabaya', '1984-01-08', 'Surabaya', 0, 3.65, 148, '5997446', '08-01-84', '6022', '05011101', 'HERDJANDJAM WONGSO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022836', 24, 4, 'N', '62-62', 'ELLY YUNITA', 'PLAMPITAN 2 1I            -Surabaya', '1984-06-27', 'Probolinggo', 0, 3.29, 149, '5453138', '27-06-84', '6022', '05011101', 'TJIA TJIN WIE', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022837', 24, 3.48, 'N', '62-62', 'ANTON FADJARTO', '', '1984-11-24', 'SURABAYA', 0, 3.07, 149, '', '24-11-84', '6022', '', '', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022838', 24, 3.26, '', '62-62', 'WIYANTO', 'K MPUNG BUGIS             -SURABAYA', '1984-06-15', 'TARAKAN', 0, 2.76, 144, '', '81676319', '6022', '16220002', 'HENDRA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022839', 24, 3.52, 'N', '62-62', 'ELIANA LILIK', 'DHARMAHUSADA UTARA 2 23   -Surabaya', '1984-08-18', 'Bangkalan', 0, 3.29, 147, '5933535', '18-08-84', '6022', '05011091', 'NIYATA YITNO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022840', 24, 3.35, 'N', '62-62', 'SANTHOS PRABU PILLAY', 'PAKIS TIRTOSARI 10A   5A  -Surabaya', '1983-10-01', 'Medan', 0, 2.98, 151, '5632337', '01-10-83', '6022', '05011092', 'M PANER SP', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022841', 24, 3.75, 'N', '62-62', 'JOHANES ANDRE ASTAYASA', 'DUKUH KUPANG 16A          -Surabaya', '1984-11-25', 'Surabaya', 0, 3.26, 151, '5671745', '25-11-84', '6022', '05011114', 'HADI ASTAYASA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6022842', 16, 1.57, 'DO', '62-62', 'NELLY WONGKAR', 'JL TENGGILIS AF           -Surabaya', '1899-12-30', 'SURABAYA', 0, 1.74, 46, '', '89827353', '6022', '21320005', '', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022843', 20, 2.29, 'TD', '62-62', 'ANNA MARIEKE SIAILA', 'JL DR KAYAD *             -Maluku', '1899-12-30', 'SURABAYA', 0, 2.32, 159, '342916', '69308082', '6022', '21320005', '', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022844', 24, 3.4, 'N', '62-62', 'LIDYA MUSTIKA GUNAWAN', 'LIDYA MUSTIKA             -SURABAYA', '1984-11-11', 'Surabaya', 0, 3.02, 148, '3518250', '11-11-84', '6022', '03041015', 'OEI BOEN ANG', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6022845', 24, 3.95, 'N', '62-62', 'HARYANTO SETIAWAN WIYOTO', 'NGAGEL WASANA 6/11 SURABAYA', '1984-02-25', 'TULUNGAGUNG', 0, 3.8, 152, '5024074', '25-02-84', '6022', '05011114', '', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023001', 24, 3, '', '63-63', 'LAURA CERIA', 'CITRA GARDEN 3 EXT E8 3   -Jakarta', '1984-08-21', 'Tuban', 0, 2.81, 145, '54390254', '13561253', '6023', '01041009', 'HERIANTO T', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023002', 24, 4, 'N', '63-63', 'FINA KRISTINA', 'ANTOSARI 22X              -Klungkun', '1984-06-05', 'Klungkung', 0, 2.61, 146, '23620', '05-06-84', '6023', '22379999', 'CANDRA BUDIARTA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023003', 24, 3.75, 'N', '63-63', 'WELLYANTO ONGKOJOYO', 'GRIYA KEBRAON BLOK Z28    -Surabaya', '1984-07-19', 'Surabaya', 0, 3.33, 147, '7664369', '19-07-84', '6023', '05031098', 'ANDI ONGKOJOYO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023004', 16, 1.65, '', '63-63', 'SOEGIARTO GIAMNYOTO', 'DIPONEGORO 56             -Lumajang', '1984-10-03', 'Lumajang', 0, 1.99, 145, '882414', '56648831', '6023', '05380001', 'RUDY SUGIANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023005', 24, 4, 'N', '63-63', 'RIBKA SAVITRI DEWI', 'MR ISKANDAR 35A           -Blora', '1985-11-12', 'Blora', 0, 2.8, 144, '533051', '12-11-85', '6023', '03461009', 'RUDY HERMANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023007', 24, 3.36, '', '63-63', 'OSCAR ANANGGA SUGIARTO', 'MANYAR REJO 9 31          -Surabaya', '1983-07-15', 'Surabaya', 0, 2.27, 157, '5944942', '10981557', '6023', '05011091', 'ADHI SUGIARTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023008', 24, 3.5, '', '63-63', 'YUNIATY WIJAYA', 'PUNCAK ESBERG 25          -Malang', '1985-06-10', 'SAMARINDA', 0, 3.01, 147, '586008', '62647256', '6023', '05031025', 'SUKMO WIJOYO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023009', 24, 4, 'Tu', '63-63', 'ANTONIUS TANI WIDJOJO', 'JL SUPRIA*  28 PARE       -Kediri', '1984-02-25', 'Kediri', 0, 2.53, 140, '', '10830685', '6023', '05361012', 'SOENARYO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023010', 24, 3.44, '', '63-63', 'CORNELIA DEWI', 'JL M SUDIRO 24 TUBAN      -Tuban', '1984-09-07', 'Surabaya', 0, 2.36, 141, '321525', '84044917', '6023', '05011087', 'HANDOYO HADI SUTANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023011', 14, 0.82, 'P', '63-63', 'HARDONO DWI WICAKSONO', 'RUNGKUT BARATA 10  23     -Surabaya', '1984-02-28', 'Surabaya', 0, 1.82, 33, '8700107', '28-02-84', '6023', '05010001', 'SIDIQ NIZAMI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023012', 24, 3.39, 'N', '63-63', 'YENI SETIAWATI', 'JL KALONGAN BESAR 6       -Surabaya', '1983-12-16', 'Tuban', 0, 3.22, 145, '3521269', '16-12-83', '6023', '05011087', 'MUNTOLIP SUWIGNYO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023013', 20, 2.41, '', '63-63', 'AMILINDA VIONITA', 'MASTRIP 27                -Kediri', '1984-01-28', 'SURABAYA', 0, 2.26, 141, '391364', '46259898', '6023', '05051012', 'PEK TJING SIONG', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023014', 22, 2.88, '', '63-63', 'SUGIARTO NYOTO WIBOWO', 'CITANDUI 111              -Lumajang', '1984-07-06', 'Lumajang', 0, 2.14, 143, '888843', '72911546', '6023', '05381007', 'NYOTO WIBOWO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023015', 24, 3.5, '', '63-63', 'YANTI ANGGRENY ANG', 'BANTA BANTAENG D 9        -Ujung Pa', '1984-04-11', 'Pare - pare', 0, 3.07, 147, '850273', '56301406', '6023', '05031029', 'ANTONG KUNCORO ANG', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023017', 20, 2.16, '', '63-63', 'ANDRA KARTIKA RAMANITA', 'TAMAN CIBODAS RAYA A6 12A -Tanggera', '1984-05-31', 'Surabaya', 0, 2.27, 142, '5527602', '10117510', '6023', '02219999', 'RACHMAD RAHARDJA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023018', 24, 3.5, '', '63-63', 'BASTIAN NUGROHO HADI SAPUTRO', 'HAYAM WURUK 23F           -Surabaya', '1984-02-29', 'Singkawang', 0, 3.1, 148, '5666121', '37619511', '6023', '05011142', 'AGUS BASUKI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023020', 24, 3.45, '', '63-63', 'TEGUH HINDARTO', 'KARIMATA 34 SEMARANG      -Semarang', '1983-11-20', 'Jakarta Utara', 0, 2.24, 147, '8313381', '49312954', '6023', '03041015', 'HINDARTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023021', 24, 4, '', '63-63', 'DWI NOVALIA', 'LAKSDA ADI SOECIPTO 9     -Malang', '1984-11-25', 'Malang', 0, 2.7, 146, '493481', '52220295', '6023', '05031025', 'MEGA WAHYUNI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023022', 24, 3.92, 'N', '63-63', 'SISCA NATALIA SUGIYONO', '-', '1984-12-08', 'LUMAJANG', 0, 3.59, 147, '', '08-12-84', '6023', '05391013', 'SUGIYONO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023024', 24, 3.54, 'N', '63-63', 'YUSTINA WIWEKO', 'TENGGILIS MEJOYO AH 14    -Surabaya', '1984-06-21', 'Samarinda', 0, 2.82, 147, '8498343', '21-06-84', '6023', '05031026', 'EMILIANA TERANG', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023025', 14, 0, 'DO', '63-63', 'DANIEL FIKY AGRESTA', 'PONDOK BLIMBING INDAH J6 3-Malang', '1984-03-26', 'Malang', 0, 0, 0, '414744', '97831037', '6023', '05031025', 'THERESIA SUKAMTI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023026', 16, 0.23, 'DO', '63-63', 'MARIO RINALDI LAUTAN', 'LETJEN S PAR AN 17        -Sidoarjo', '1982-07-04', 'Surabaya', 0, 2.15, 63, '8533311', '15141845', '6023', '05011091', 'RANDY LAUW', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023027', 24, 3.5, '', '63-63', 'REZA HARI NUGROHO', 'PETEMON SIDOMULYO 4A 61   -Surabaya', '1985-01-25', 'Surabaya', 0, 2.79, 145, '5474858', '60830575', '6023', '05010009', 'AGUS RIYONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023028', 24, 4, '', '63-63', 'ONNY MARGARETHA', 'BENDUL MERISI SELATAN 1 98-Surabaya', '1984-03-11', 'Surabaya', 1, 2.76, 144, '8434655', '31610599', '6023', '05011091', 'HARJONO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023029', 24, 4, '', '63-63', 'BENNY SOEHARSONO', 'TAURUS 2                  -Surabaya', '1983-09-17', 'Medan', 0, 2.61, 146, '3818889', '73374351', '6023', '05011101', 'HENDY', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023031', 24, 3.63, 'N', '63-63', 'ANGELIA HARTATIK', 'GADING INDAH UTARA 3 8    -Surabaya', '1984-07-30', 'Surabaya', 0, 2.98, 145, '', '30-07-84', '6023', '05011116', 'LILIK MINARTI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023032', 22, 2.71, '', '63-63', 'YANTH ANDRIANTO', 'LEBOAGUNG 8 15            -Surabaya', '1984-06-17', 'Surabaya', 0, 2.25, 141, '3818211', '48463400', '6023', '05011116', 'EDI GUNARSO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023035', 20, 1.79, '', '63-63', 'ANDJIK FITRIANTA', 'JATAYU 50 REWWIN W RU SDA -Sidoarjo', '1983-07-26', 'Sidoarjo', 0, 2.18, 134, '8542713', '70049397', '6023', 'SMUN KRIAN', 'YULIA SUHARTINI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023036', 16, 1.31, 'DO', '63-63', 'AGUS PUJIANTO', 'KYAI SALEH 49             -SURABAYA', '1983-08-22', 'Banyuwangi', 0, 2.02, 33, '', '28544249', '6023', '05391013', 'LEO ARTADINATA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023037', 16, 0, 'DO', '63-63', 'BUDYANTO AL LIE YEN', 'JLN RAYA MARON KIDUL 723  -Probolin', '1983-09-18', 'Probolinggo', 0, 1.75, 4, '611592', '21187708', '6023', '05071009', 'ALOYSIUS YOSEP', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023038', 24, 4, '', '63-63', 'ERNA NURSIYAH TANOYO', 'BELITUNG                  -Pasuruan', '1984-03-29', 'Surabaya', 0, 2.8, 146, '424124', '17569391', '6023', '05031025', 'HADI TANOYO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023039', 24, 4, 'Tu', '63-63', 'VIGNON WIJAYA', 'SIMOKERTO 88              -Surabaya', '1984-03-18', 'Lamongan', 0, 2.55, 139, '3710202', '87182648', '6023', '05011087', 'ISHAK WIJAYA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023040', 20, 2.18, 'TD', '63-63', 'NIKEN MUSTIKA', 'JLSUPRIADI 44 POGAR BANGIL-SURABAYA', '1985-02-19', 'Pasuruan', 0, 2.2, 147, '741 486', '44983441', '6023', '05440006', 'MOHAMAD SOLEH', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023041', 24, 3, '', '63-63', 'HENY DWI WULANDARI', 'WISMA KEDUNG ASEM DD 16   -Surabaya', '1984-09-26', 'Denpasar', 0, 2.71, 148, '8711964', '19559870', '6023', '05010014', 'SUDJITO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023042', 24, 4, 'N', '63-63', 'KORVIANTIKA CAHYANING SETIAWAT', 'JALAN JAWA NO 88          -Mojokert', '1984-03-07', 'Lumajang', 0, 3.12, 148, '', '07-03-84', '6023', '05460002', 'SUWANDI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023044', 24, 4, '', '63-63', 'ANDREAS ADI PAMUNGKAS', '-', '1984-06-25', 'Surabaya', 0, 3.73, 144, '', '24059790', '6023', '05011087', 'ANT T KOESHINDARTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023046', 20, 0, 'DO', '63-63', 'KWANTONO', 'JL JAGARAGA 16            -Surabaya', '1983-08-02', 'Pasuruan', 0, 2.25, 4, '3523250', '57528683', '6023', '05011095', 'DJONNOTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023047', 22, 2.57, 'Tu', '63-63', 'VERONICA SUGIARTO', 'MERPATI 5 14              -Surabaya', '1984-01-13', 'Semarang', 1, 2.17, 143, '867127', '85411503', '6023', '03031006', 'IMAM SUGIARTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023048', 16, 0, 'Tu', '63-63', 'ANTONIUS GUSTI', 'MOJO KIDUL 1  9           -Surabaya', '1984-05-26', 'Surabaya', 0, 1.95, 102, '5942074', '85761231', '6023', '05011087', 'THERESIA Y ETTY', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023049', 24, 4, 'TD', '63-63', 'STEFANUS EDWINE EKA', 'KAWUNG 5                  -Surabaya', '1984-07-18', 'Sumenep', 0, 3.01, 144, '3528574', '29968153', '6023', '05011087', 'SUGIARTO S', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023050', 24, 4, '', '63-63', 'GALUH NURINA SUCAHYO', 'BENDULMERISISELATAN       -Surabaya', '1984-07-10', 'Surabaya', 0, 2.74, 141, '', '52694400', '6023', '05010002', 'IR MAKMUR SUTJAHJO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023051', 24, 4, 'TD', '63-63', 'MILANI PHELUPESIK', 'PLOSO TIMUR 07 NO  67     -Surabaya', '1984-12-29', 'Palu', 0, 2.83, 144, '3818896', '78926055', '6023', '05031027', 'HENDRIK PHELUPESIK', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023052', 24, 3.25, 'TD', '63-63', 'ERIC SOEPRAPTO', 'TENGGILISMEJOYOSELATAN0422-Surabaya', '1984-04-05', 'Bangkalan', 0, 2.31, 143, '8431812', '45823498', '6023', '05011155', 'SUPRAPTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023053', 24, 4, 'N', '63-63', 'FELLEN DIANA', '-', '1984-04-21', 'Surabaya', 0, 3.3, 149, '', '21-04-84', '6023', '05011091', 'RICKY SUGIANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023054', 24, 3, '', '63-63', 'RENI RACHMAWATI', 'SEMOLOWARU INDAH H 19     -Surabaya', '1983-09-26', 'Surabaya', 0, 2.67, 144, '5931549', '73963614', '6023', '05011143', 'UMI ATIYAH', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023055', 24, 4, '', '63-63', 'ANTON CEASARIO A', 'YKP RUNGKUT LOR 2K 16     -Surabaya', '1984-03-10', 'Surabaya', 0, 2.45, 139, '8701594', '75862912', '6023', '05010002', 'H SAWAL RIYADI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023056', 16, 1.53, 'DO', '63-63', 'RATIH WIDYASTUTI P.', 'CIPTA MENANGGAL 5 9       -Surabaya', '1984-10-12', 'Ujung Pandang', 0, 1.93, 15, '8282067', '38735802', '6023', '05010002', 'ENDRO LUKITO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023057', 24, 3.5, '', '63-63', 'GRACE CYNTHIA', 'BABATAN PANTAI 6 15       -SURABAYA', '1984-06-19', 'Surabaya', 0, 2.46, 145, '3814147', '62782194', '6023', '05011149', 'LINDA SUBAGIO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023058', 24, 4, 'TD', '63-63', 'FREDY KUSUMO TEDJO', 'TENGGILIS MEJOYO AI 9     -Surabaya', '1984-06-02', 'Surabaya', 0, 2.62, 145, '8497451', '37889611', '6023', '05011091', 'SOEBIANTORO KT', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023059', 14, 0, 'DO', '63-63', 'PAULINA', 'DR SUTOMO 77              -SURABAYA', '1983-06-24', 'Nganjuk', 0, 0, 0, '323561', '54481020', '6023', '05031025', 'SULARNO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023061', 16, 0.56, 'TD', '63-63', 'ANDREW FIRMANSYAH L.', 'BRONGGALAN 2H 20          -Surabaya', '1984-04-13', 'Surabaya', 0, 2.04, 78, '3819451', '57257545', '6023', '05011087', 'TJAHYO LIMANTORO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023062', 24, 3.5, '', '63-63', 'ADI DARMANTO', 'GUBENG KERTAJAYA 3F 3A    -Surabaya', '1984-02-15', 'Surabaya', 0, 2.6, 147, '5031629', '29869691', '6023', '05010007', 'SUTADJI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023063', 24, 3, 'TD', '63-63', 'AANG WAHONO NUGROHO', 'GEMBONG 2 16 BLOK B 5     -Surabaya', '1984-09-24', 'Surabaya', 0, 3.1, 149, '3723321', '46432859', '6023', '05011087', 'TATANG TRIYONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023064', 16, 1.54, 'DO', '63-63', 'FRANKY WIJAYA', 'VILA KALIJUDAN INDAH H 23 -Surabaya', '1985-04-29', 'Palu', 0, 2.24, 35, '3817457', '41053777', '6023', '05011116', 'EDY WIJAYA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023065', 24, 4, '', '63-63', 'ARYANIAGA AMEPUTRA', 'WISMA PERMAI 6 1          -Surabaya', '1984-10-10', 'Surabaya', 0, 2.77, 143, '5932955', '90209714', '6023', '05010002', 'BASU ADJI BAWONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023066', 24, 4, '', '63-63', 'ROCKY NUGROHO SETIYADI', 'PAJAJARAN UTARA 1 NO 10   -Surakart', '1984-03-02', 'Surakarta', 0, 2.84, 149, '715783', '37510168', '6023', '03021018', 'NUGROHO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023067', 24, 4, '', '63-63', 'IKA HAPSARI KOESETYO PUTRI', 'BABATAN PRATAMA XIV K 9   -Surabaya', '1984-07-04', 'Bandung', 0, 2.81, 142, '7522777', '21019787', '6023', '05011077', 'AGUS KUSAMSI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023068', 16, 0, 'DO', '63-63', 'ANDI TEJA', 'TAMBAK SEGARAN 8 23       -Surabaya', '1983-11-03', 'Surabaya', 0, 1.57, 7, '3769244', '23324720', '6023', '05011101', 'JANUAR TEJA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023069', 24, 4, 'TD', '63-63', 'ASRINI BUDIWATI', 'DARMO PERMAI TIMUR 2 58   -Surabaya', '1983-10-20', 'Bandung', 0, 3.34, 146, '7314394', '28953869', '6023', '05010005', 'AM SALEH', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023070', 24, 3.5, '', '63-63', 'VONNY PERINA', 'JL MELATI 4 TABANAN BALI  -Tabanan', '1985-02-04', 'Tabanan', 1, 2.75, 148, '811269', '72156773', '6023', '22380001', 'BUDIARTHA PERI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023071', 14, 0.25, 'P', '63-63', 'RICKY BUDIARTO', 'SUTOREJO TENGAH 4 34      -Surabaya', '1899-12-30', 'SURABAYA', 2, 1.92, 13, '5933257', '-  -', '6023', '', '', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023072', 24, 3, '', '63-63', 'LOLY ARY CAHYOWATI', 'PASAR KEMBANG 91          -SURABAYA', '1985-01-03', 'Surabaya', 0, 2.55, 145, '5342792', '76558418', '6023', '05010006', 'SOESILO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023073', 14, 0, 'DO', '63-63', 'PRIMA RAHMADHANY', 'JLOXYGEN 03 PETRO GRESIK  -Gresik', '1984-02-21', 'Semarang', 0, 0, 0, '3978157', '98456270', '6023', '05010002', 'BAMBANG TJAHJONO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023075', 20, 2.2, 'DO', '63-63', 'FEBDY LIWANG', 'SUTOREJO TENGAH 13 27     -Surabaya', '1985-02-14', 'Palu', 1, 2.24, 68, '5923474', '93651066', '6023', '05011149', 'LIE APAT', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023076', 24, 3.5, '', '63-63', 'AGUSTIN AYU CITRAWATI', 'DUKUH KUPANG TIMUR 7 31   -Surabaya', '1984-08-18', 'Surabaya', 0, 2.83, 144, '5687269', '97940688', '6023', '05010006', 'PAIMAN A HARIJANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023077', 24, 3.5, '', '63-63', 'TITUS HARIANTO', 'DUKUH SETRO 3 50          -Surabaya', '1984-01-21', 'Surabaya', 0, 2.44, 147, '3811539', '27101782', '6023', '05010019', 'BAMBANG SETIADI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023078', 14, 0.61, 'DO', '63-63', 'IDA BAGUS SURYA BHUANA', 'JLN MAYJEN SUTOYO NO 30D  -Denpasar', '1984-09-11', 'Denpasar', 0, 2.13, 31, '236575', '69441956', '6023', '22210001', 'IDA BAGUS PUTRA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023079', 16, 1.47, 'DO', '63-63', 'YUDI PUJI SUMARTINI', 'KENJERAN 474              -Surabaya', '1984-03-11', 'Surabaya', 0, 1.89, 82, '3820035', '10781406', '6023', '05011142', 'SUTRISNO WAHYUDI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023081', 24, 3.83, 'N', '63-63', 'WENNY SETIAWATI', 'JL KH ABDUL HAMID 4       -Pasuruan', '1984-06-17', 'Pasuruan', 0, 2.84, 146, '421336', '17-06-84', '6023', '05011091', 'YOHANES PRIYANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023083', 14, 0.96, 'DO', '63-63', 'JAROD PRIYA YUDHA', 'KARAH AGUNG 12 1          -SURABAYA', '1984-01-16', 'Blitar', 0, 1.73, 41, '', '60616556', '6023', '05010021', 'HADI SUPRIYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023084', 24, 4, '', '63-63', 'FUAD HASAN', 'WISMA P ER*I TENGAH 1 39  -Surabaya', '1984-03-16', 'Surabaya', 0, 2.22, 140, '5998486', '69135015', '6023', '05010002', 'HAMBALI BUDIONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023085', 24, 3.5, '', '63-63', 'YANI KRISTIANI', 'PEPAYA NO 8               -Mojokert', '1984-01-25', 'Mojokerto', 0, 2.5, 151, '327456', '46257005', '6023', '05029999', 'JOHANES SARDJO NO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023087', 24, 4, 'N', '63-63', 'RIESTENDY NOVRIANTO', 'PERUM NOJA INDAH G7       -Denpasar', '1983-11-05', 'Surabaya', 0, 3.62, 151, '245188', '05-11-83', '6023', '22210003', 'ARIES SUBANDI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023088', 14, 0.71, 'P', '63-63', 'ARYA PAMELING GAGAT P', 'SEMOLOWARU ELOK BLOK Y 1  -Surabaya', '1984-05-15', 'Surabaya', 0, 2.18, 30, '5949398', '15-05-84', '6023', '05010006', 'TRI DJOKO PRASWIBOWO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023090', 24, 4, 'N', '63-63', 'BIMBA PRADAYATNO', 'SEDATI INDAH E 14         -Sidoarjo', '1984-04-19', 'Surabaya', 0, 3.12, 146, '8665196', '19-04-84', '6023', '05010016', 'BAMBANG SUPRAYITNO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023091', 24, 3.92, 'N', '63-63', 'ALOYSIUS SUJARWADI', 'RUNGKUT ASRI TENGAH 2 25  -Surabaya', '1982-12-15', 'Surabaya', 0, 3.55, 148, '8701595', '15-12-82', '6023', '05010002', 'TJ INDRAYATI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023093', 24, 4, '', '63-63', 'HO HENDRI', 'JL LETJEN SUPRAPTO NO 10  -Balikpap', '1984-05-06', 'Balikpapan', 0, 2.74, 143, '422154', '97344939', '6023', '16020006', 'HO RIYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023094', 20, 0, 'DO', '63-63', 'ANDIKA APRILIAN', 'IKAN MAS 30               -Banyuwan', '1984-04-23', 'Banyuwangi', 0, 2.25, 4, '', '95004734', '6023', '05400001', 'ISKANDAR AZIS SH MM', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023095', 24, 4, 'N', '63-63', 'SURYA HARTAWAN CHANDRA', 'SEM* U 58 BAMBE           -Gresik', '1985-11-13', 'Surabaya', 0, 3.64, 152, '7664896', '13-11-85', '6023', '05011096', 'EDDY CHANDRA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023096', 14, 1.25, 'DO', '63-63', 'INGGRID AGUSTINA DEWI', 'SIMOSIDOMULYO8 54         -Surabaya', '1984-08-29', 'Sumbawa', 1, 2.13, 15, '5313313', '33410818', '6023', '23361006', 'FRANSISKUS', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023097', 20, 1.18, 'P', '63-63', 'BAGUS SAMPURNO', 'PAMENANG   *EDIRI         -Kediri', '1983-12-29', 'Kediri', 0, 2.47, 16, '', '29-12-83', '6023', '05051012', 'JUDIWANTORO S', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023098', 14, 0, 'DO', '63-63', 'MADE SUMERDANA', 'TENGGILIS MEJOYO AG 13    -Surabaya', '1984-09-17', 'Buleleng', 0, 1.95, 42, '8490259', '96647057', '6023', '22339999', 'WIRYA DANA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023099', 24, 3.5, '', '63-63', 'NIRMA NURIANTI', 'KUTISARI INDAH SELATAN5 33-Surabaya', '1984-10-29', 'Surabaya', 0, 2.47, 150, '8436334', '89016289', '6023', '05010020', 'DRS RACHMADISBANDRIO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023101', 24, 4, '', '63-63', 'DIRA MARIANA', 'NGINDEN JAYA 1 4 SURABAYA -Surabaya', '1984-08-27', 'Tuban', 0, 3.02, 150, '5990281', '33367290', '6023', '05530001', 'GANDI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023102', 24, 3.5, '', '63-63', 'WILSON THEODORE', 'SUTOREJO PRIMA BARAT PQ 30-Surabaya', '1985-01-21', 'Palu', 0, 3.23, 154, '5993684', '33245261', '6023', '18219999', 'THE DAVID THEODORE', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023103', 22, 2.53, 'TS', '63-63', 'EKO SUPRIADI', 'JL UKA 12 1               -Surabaya', '1982-05-26', 'Surabaya', 1, 2.25, 152, '', '34084515', '6023', '05011070', 'TUGIMAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023104', 24, 4, 'Tu', '63-63', 'DONNY TANTIO', 'RAYA NGLAMES NO 4         -Madiun', '1983-11-16', 'Madiun', 0, 3, 144, '462821', '51379638', '6023', '05081016', 'SUSANTO TANTIO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023105', 20, 2.21, '', '63-63', 'RATNA KUSUMA WARDHANI', 'GRIYA MAPAN SENT0SA       -Surabaya', '1984-02-18', 'Surabaya', 0, 2.17, 149, '8668346', '62123824', '6023', '05010016', 'MUCH LILIK SETIYONO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023106', 24, 3, '', '63-63', 'LINDA DJUWITA AER', 'KOMPLEKS SESPIMPOL UB 5BDG-Bandung', '1984-08-17', 'Denpasar', 0, 2.93, 149, '2785426', '12952270', '6023', '02010003', 'MAX DONALD AER', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023107', 24, 4, '', '63-63', 'NOVI IKE SULISTYOWATI', 'RUNGKUT ALANG ALANG 135B  -Surabaya', '1983-11-27', 'Surabaya', 0, 3.04, 146, '8706866', '74787898', '6023', '05010016', 'W EKO ARIFIANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023109', 14, 0, 'DO', '63-63', 'FERI HAPOSAN TOBING', 'SIDOSERMO PDKV KAV375     -Surabaya', '1985-02-17', 'Surabaya', 0, 0, 0, '8474654', '83294510', '6023', '05011118', 'ML TOBING', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023110', 20, 2.3, '', '63-63', 'TAUFIK EFFENDY', 'KALIKEPITING 47 29        -Surabaya', '1984-06-12', 'Surabaya', 0, 2.21, 134, '3810 743', '22845590', '6023', '05010002', 'SUWITO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023111', 24, 3.5, 'N', '63-63', 'MICHAEL ALBERTUS ERWIN SETIAWA', 'NGINDEN INTAN TIMUR D6 17 -Surabaya', '1984-05-15', 'Nganjuk', 0, 3.16, 145, '5944107', '15-05-84', '6023', '05011091', 'YULIANI SUYONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023112', 20, 1.08, '', '63-63', 'ISYA ARDIANSYAH', 'SUMBERJO NO 11 JOMBANG    -Jombang', '1982-05-26', 'Jombang', 0, 2.06, 124, '869322', '79954887', '6023', '05470001', 'CHOLIQ ERYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023114', 14, 0, 'DO', '63-63', 'SARI MARIA ROSA MEILINA', 'KALIMAS UDIK 2 15         -Surabaya', '1902-05-30', 'Surabaya', 0, 1.44, 18, '3529886', '94852790', '6023', '05011105', 'M SUROSO ACHMAD', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023115', 14, 0, 'DO', '63-63', 'ADHI HOSANA D.', 'KETINTANG PERMAI BD NO 30 -Surabaya', '1983-12-20', 'Mataram', 0, 0, 0, '8294283', '96778693', '6023', '05010005', 'ARIES SUPRIYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023116', 24, 3.5, '', '63-63', 'YURISA HANDARI', 'JL GADING INDAH UTR 7 14  -Surabaya', '1985-06-03', 'Bandung', 0, 2.95, 147, '3813401', '88152769', '6023', '05010007', 'HARI PRANOTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023117', 24, 3.5, '', '63-63', 'SISCA MAYASARI USMAN', 'DAHLIA 28 MENTUL CEPU     -Blora', '1983-10-07', 'Blora', 0, 2.68, 148, '422332', '42993127', '6023', '03460001', 'NANY HERARDUS USMAN', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023118', 24, 3.5, '', '63-63', 'RIA OKTAVIA DEWI', 'DS. GADUNGAN RT.1 PUNCU PARE KEDIRI', '1984-10-06', 'Kediri', 0, 2.75, 150, '0354394517', '86201423', '6023', '05360006', 'SUTIKNO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023119', 16, 0.46, 'P', '63-63', 'RIZKY MAHARANI', 'BABATAN PANTAI 8 5 SBY    -Surabaya', '1984-03-21', 'Surabaya', 0, 1.79, 14, '3817894', '21-03-84', '6023', '05010005', 'H ABDUL SYUKUR', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023120', 14, 0, 'DO', '63-63', 'JOHAN ADI SWANDANA CH.', 'B RAHMAT 15 BO ONEGORO    -Bojonego', '1983-10-13', 'Jombang', 0, 0, 0, '881636', '20887480', '6023', '05520001', 'EDY JOESOEP', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023121', 20, 0.71, 'P', '63-63', 'IKA CHADYASARI', 'KLAMPIS SEMOLO BRT 9 19K54-Surabaya', '1984-04-02', 'Surabaya', 0, 2.1, 10, '', '02-04-84', '6023', '05010007', 'MOCHAMMAD CHAIRUL', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023122', 14, 0, 'DO', '63-63', 'RINDA SAPITRI', 'JL TENGGILIS MEJOYO AG 9  -Surabaya', '1984-09-14', 'Banjarmasin', 2, 2.13, 8, '8410189', '93836254', '6023', '15010004', 'H M SUDIANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023123', 20, 0, 'DO', '63-63', 'YOGI PRAMONO', 'POGOT LAMA 49             -Surabaya', '1983-09-06', 'Surabaya', 0, 2.25, 4, '3766492', '19209537', '6023', '05011143', 'SUWOTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023124', 14, 0, 'DO', '63-63', 'HENKY KRISTIAWAN', 'VILLA REGENCY AT1 12      -Surabaya', '1983-02-23', 'Surabaya', 0, 0, 0, '752336 9', '75437578', '6023', '04011012', 'WIDJANAR KO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023125', 16, 1, 'P', '63-63', 'HANDI SUTANTO', 'TENGGILIS MEJOYO AF 38    -Lombok B', '1982-09-26', 'Lombok Barat', 1, 1.88, 16, '8418216', '26-09-82', '6023', '23331009', 'YUSUP IHSAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023127', 14, 0, 'DO', '63-63', 'YOHAN ELISA FRANSISKO', 'PONDOK MARITIM INDAH      -Surabaya', '1983-10-15', 'Surabaya', 1, 1.56, 25, '7663082', '66236820', '6023', '05011098', 'FRANS HUWAE', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023129', 14, 0, 'P', '63-63', 'BAYU DWI ANANTO', 'JL GRIYA KEBRAON FI 1     -Surabaya', '1984-02-19', 'Surabaya', 0, 1.69, 16, '7667918', '19-02-84', '6023', '05011068', 'MUDJIRAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023130', 14, 0, 'DO', '63-63', 'ENDI SUHENDRI SAIN', 'CITRA BOUGENVILLE NO 8    -Sidoarjo', '1984-05-12', 'Jakarta Selat', 0, 1.64, 14, '8678920', '52469667', '6023', '05430002', 'M SAIN LATIEF', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023131', 24, 3.5, '', '63-63', 'YODIANTA', 'KARAH INDAH E 28          -Surabaya', '1984-01-19', 'Surabaya', 0, 2.68, 149, '8285577', '26489868', '6023', '05011105', 'SUBENO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023132', 24, 3.5, '', '63-63', 'YUYUN ADHI PRAWOTO', 'BENDUL MERISI SELATAN 3NO3-Surabaya', '1984-05-15', 'Surabaya', 0, 2.58, 149, '8432682', '12386345', '6023', '05010008', 'TRAPSILO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023133', 14, 1, 'P', '63-63', 'CARELL ELNATHAN ANDRE W.', 'BRONGGALAN SAWAH 5C 2     -Surabaya', '1984-09-26', 'Surabaya', 0, 1.88, 24, '3894710', '26-09-84', '6023', '05010021', 'YUNUS ANDRY WIEJOYO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023134', 20, 2.41, '', '63-63', 'RUDY WAHYUDI', 'RUNGKUT MEJOYO SELATAN3 38-Surabaya', '1984-06-06', 'SURABAYA', 0, 2.06, 146, '8413844', '90003518', '6023', '16220001', 'SUITO KURNIAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023135', 14, 0, 'DO', '63-63', 'MOCH ARIEF METHA PRAYOGO', 'IKAN ARWANA A23 TAMBAKREJO-Surabaya', '1983-09-30', 'Surabaya', 1, 2.17, 6, '8669280', '25459373', '6023', '05010016', 'THATHIET PURWO EDI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023136', 16, 1.36, 'DO', '63-63', 'SANJAYA WIJAYA', 'MERDEKA 215 BLITAR JATIM  -Blitar', '1984-04-22', 'Blitar', 1, 1.94, 18, '801318', '77276363', '6023', '05061010', 'OSMAN WIJAYA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023137', 14, 0, 'DO', '63-63', 'RINA OKTRIDARMA SARI', 'KERTAJAYA INDAH TMR  16 25-Surabaya', '1984-10-11', 'Surabaya', 0, 0, 0, '5940548', '52309230', '6023', '05010009', 'DRS SOEDARSONO MSI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023138', 14, 1.29, 'DO', '63-63', 'PRIYUWONO LAKSMONO A.', 'DINOYO BARU 47            -Surabaya', '1984-04-08', 'Surabaya', 0, 1.39, 18, '5682983', '75255957', '6023', '05011046', 'RUDY DRAJAT A', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023139', 20, 1.33, '', '63-63', 'EMBRIO CANDRA HIMAWAN', 'PURI SURYA JAYA A 10 01   -Sidoarjo', '1983-11-20', 'Surabaya', 0, 2.02, 137, '8915009', '59518348', '6023', '05459999', 'ARIE SUTRISNO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023140', 24, 3.13, 'TD', '63-63', 'JUBIANTO HANI', 'SUTOREJO TIMUR 1 53       -Surabaya', '1984-07-17', 'Surabaya', 1, 2.13, 142, '5934587', '76365250', '6023', '05011149', 'LIE TAT LIEN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023141', 24, 4, '', '63-63', 'JOHAN SUBEKTI WYLIE', 'RAYA RAME 28              -Surabaya', '1984-12-19', 'Surabaya', 1, 2.41, 148, '8952242', '43552402', '6023', '05451117', 'SURYANTO WYLIE', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023143', 24, 3.08, 'N', '63-63', 'FANNY HOSEA', 'GAYUNG SARI TIMUR V7      -Surabaya', '1984-05-18', 'Ujung Pandang', 0, 2.77, 146, '8283401', '18-05-84', '6023', '19011012', 'ROBERT HOSEA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023144', 24, 4, '', '63-63', 'DEISY KUSUMA WIDYANINGRUM', 'PUPUK RAYA NO 49 BPPN     -Balikpap', '1984-08-26', 'Surabaya', 0, 3.48, 148, '761505', '20528530', '6023', '16020001', 'BAMBANG WIDJANARKO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023145', 24, 3.05, 'DO', '63-63', 'CHENDRA EKASARI', 'JEMUR ANDAYANI 12 NO 5    -Surabaya', '1984-08-07', 'Surabaya', 2, 2.96, 41, '8418035', '34114526', '6023', '03461009', 'ENNAWATI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023146', 16, 0.95, 'TD', '63-63', 'TOMMY SETIAWAN', 'TENGGILIS MEJOYO W 23     -SURABAYA', '1984-09-21', 'Balikpapan', 0, 2.23, 122, '8433850', '51774267', '6023', '16020001', 'JHONY HARTAKO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023147', 24, 4, '', '63-63', 'ANG ANDRIE SETIAWAN', 'WIGUNA TIMUR 9 11A        -Surabaya', '1983-12-27', 'Balikpapan', 0, 2.45, 140, '8713990', '42843996', '6023', '16020005', 'ANG ALEXANDER', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023148', 24, 4, 'Tu', '63-63', 'SETIADI', 'RUNGKUT MEJOYO UTARA    4A-SURABAYA', '1984-09-14', 'Balikpapan', 0, 3.7, 143, '842', '97993413', '6023', '16020002', 'OEY SIS *NTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023149', 16, 1.35, 'DO', '63-63', 'AGUS PERDANA', 'JL TENGGILIS MEJOYO AA 18B-Surabaya', '1984-08-07', 'Banjarmasin', 0, 2.08, 36, '', '35592555', '6023', '15010007', 'BUDI PRAYITTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023150', 24, 4, '', '63-63', 'AGUSTINUS MAXIMILIANUS VICTOR', 'NGINDEN INTAN TMR E1 1    -Surabaya', '1984-08-09', 'Madiun', 0, 2.94, 145, '5935794', '87172289', '6023', '05080002', 'HARYANTO SOETEDJO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023151', 14, 0.14, 'DO', '63-63', 'PARAMITA AYUNINGTYAS', 'TMN BOUGENVILLE BLOK D2 21-Bekasi', '1984-04-08', 'Yogyakarta', 0, 1.45, 11, '', '14013378', '6023', '01029999', 'IR BAMBANG SUPRIYADI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023152', 24, 4, 'N', '63-63', 'MIKKY FERDHIAN LAURENDHO', 'JL AYANI KM6700 KOMPASDI K-Banjarma', '1984-02-27', 'Banjarmasin', 0, 3.21, 148, '267785', '27-02-84', '6023', '15010007', 'APUY LAURENDHO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023153', 24, 3.53, 'N', '63-63', 'JENNI', 'NIRWANA EKSEKUTIF CC 566  -Surabaya', '1984-10-23', 'Samarinda', 0, 3.5, 148, '8722310', '23-10-84', '6023', '16010001', 'THIO GIK HONG', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023154', 22, 2.89, 'P', '63-63', 'LEENCE ENGELIEN WILHELMINA', 'TAMAN PDK JATI AP 21      -Surabaya', '1985-04-27', 'Maluku Tengah', 1, 2.89, 19, '7874221', '27-04-85', '6023', '21320001', 'JULIUS LATUMAERISSA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023155', 24, 4, '', '63-63', 'MARIA YUSUF', 'SUTOREJO PRIMA INDAH 34   -SURABAYA', '1984-11-25', 'Banjarmasin', 0, 2.55, 146, '5997579', '32975642', '6023', '15010007', 'ANDUY YENI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023156', 24, 3.5, '', '63-63', 'MARLINA', 'LEBAK ARUM BARAT84        -SURABAYA', '1984-02-05', 'BANJARMASIN', 0, 3.01, 152, '3894070', '41688840', '6023', '15019999', 'SUDIRJO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023157', 24, 3.5, '', '63-63', 'LANY AGUSTIN', 'JL GUNUNG SEMERU GG3 NO38 -Jembrana', '1984-08-09', 'NEGARA', 0, 2.48, 146, '41366', '78038094', '6023', '22350001', 'KETUT IRAWAN', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023158', 20, 1.88, 'DO', '63-63', 'I GEDE ANDHI SUPRAPTA', 'SEMOLOWARU UTARA IVA 24   -Surabaya', '1984-03-11', 'Buleleng', 0, 2.24, 29, '5934830', '58043257', '6023', '22330001', 'I NYM SUMENASA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023159', 14, 0, 'DO', '63-63', 'CITRA JUDITH LUPITADEVI', 'RAYA DUKUH KUPANG 14      -Surabaya', '1984-04-01', 'Gresik', 0, 0, 0, '5615655', '49369429', '6023', '05010005', 'SLAMET SOEMARI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023161', 14, 0, 'DO', '63-63', 'I WAYAN HARY KARISMA', 'JL HAYAM WURUK GG 3 2     -SURABAYA', '1984-01-27', 'Denpasar', 0, 0, 0, '240546', '72804147', '6023', '22210001', 'I KETUT MUDRA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023162', 24, 4, 'TD', '63-63', 'MARISSA AGATHA', 'JL MESJID RAYA NO 9       -Palu', '1985-02-05', 'Palu', 0, 2.92, 146, '421717', '92832272', '6023', '18210001', 'BOBBY J CH RUNTUWENE', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023163', 24, 0, 'K', '63-63', 'PANDU WICAKSONO', 'JL SEMERU 6 10 SEMARANG   -Semarang', '1985-03-19', 'Surabaya', 0, 0, 0, '8412887', '19-03-85', '6023', '03040001', 'PRAMONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023164', 14, 0, 'DO', '63-63', 'IRA HANDRIANI', 'JL SUTOREJO SEL 7 11 SBY  -Surabaya', '1982-09-27', 'Surabaya', 0, 0, 0, '5935862', '15295066', '6023', '05010005', 'SAMINTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023165', 14, 1.06, 'DO', '63-63', 'AGUNG MUKTIWIBOWO', 'JALANRAYA GELAM 5 SIDOARJO-Sidoarjo', '1984-04-17', 'Palembang', 1, 1.86, 25, '8941692', '13349013', '6023', '05450001', 'BUSRO ADIPOERNOMO S', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023167', 14, 1.16, 'DO', '63-63', 'ROBBY', 'JLN VETERAN GG SEMPATI NO5-Banjarma', '1984-08-01', 'Banjarmasin', 0, 1.69, 13, '268025', '98822641', '6023', '15010007', 'AGUSTINUS', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023169', 24, 4, 'N', '63-63', 'DENNY SANJAYA', 'PERUM PSI BLOK 2 4        -Pasuruan', '1982-11-17', 'PASURUAN', 0, 2.51, 144, '424898', '17-11-82', '6023', '05031025', 'PRIYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023171', 14, 0, 'DO', '63-63', 'DHITYA OCTORA RUDIPUTRI', 'DHITYA OKTORA R P         -Surabaya', '1984-10-27', 'Jakarta Timur', 0, 0, 0, '8471740', '69317639', '6023', '05010006', 'RUDI ENDE', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023172', 24, 4, '', '63-63', 'IRENE', 'TENGGILIS MEJOYO AN5      -Surabaya', '1985-03-28', 'Ujung Pandang', 0, 2.89, 150, '8417723', '89376712', '6023', '19011012', 'ABDIAS ABU', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023173', 22, 2.65, '', '63-63', 'AMIN ISKANDAR', 'RUNGKUT ASRI UTARA 39     -Surabaya', '1983-07-01', 'Medan', 1, 2.51, 144, '8702181', '16851985', '6023', '05011117', 'AMIR HASAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023174', 14, 0.59, 'DO', '63-63', 'ANDRY SIDHARTA', 'MAYJEN SUNGKONO GGX  NO 14-Gresik', '1984-12-31', 'Palu', 0, 1.7, 32, '3983663', '25797055', '6023', '18210001', 'WARNO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023175', 14, 0, 'DO', '63-63', 'PANDU RESPATI', 'GAYUNGSARI BARAT 3 92     -Surabaya', '1985-05-15', 'Surabaya', 0, 1.4, 5, '8290730', '52824866', '6023', '05010002', 'IBNU SUHARTONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023176', 24, 4, '', '63-63', 'WIDYA NITA', 'TAMBAK REJO 118           -Surabaya', '1985-01-24', 'Malang', 0, 3.27, 149, '', '49703015', '6023', '05031030', 'MARIA INDRAWATI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023177', 24, 4, 'TD', '63-63', 'YUNY DEWI MARTINI', 'BANYU URIP KIDUL GG4ANO53B-Surabaya', '1977-03-25', 'Balikpapan', 0, 2.93, 146, '5620109', '65070645', '6023', '16020001', 'SAMHADIPRAYITNO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023701', 20, 1.82, 'Tu', '63-63', 'MICHAEL SUTANTO', '-', '1979-08-03', 'Surabaya', 0, 2.35, 143, '', '18937115', '6023', '0501xx*x', 'SONNY SUTANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023702', 24, 3, '', '63-63', 'HENDRA UTAMA', 'TENGGILIS MEJOYO AI-4     -SURABAYA', '1981-10-05', 'BANJARMASIN', 0, 2.48, 145, '8410803', '54543707', '6023', '1505xxxx', 'OE TE LONG', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023703', 24, 4, 'N', '63-63', 'ANDHI IRAWAN KALIS', '-', '1984-01-04', 'Madiun', 0, 3.21, 148, '', '04-01-84', '6023', '05080003', 'KALIS BUDIONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023704', 24, 4, '', '63-63', 'EDWARD', '-', '1908-07-16', 'Surabaya', 0, 2.3, 140, '', '46707105', '6023', '05011149', 'LIEM SIOE LIAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023705', 24, 3.5, '', '63-63', 'ARDY DWI PUTRA LESTARI', 'KARAH INDAH BLOK N NO29   -Surabaya', '1984-12-11', 'Bandung', 0, 2.98, 144, '8295858', '91520756', '6023', '05011142', 'ADAM LESTARIYONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023706', 14, 0.8, 'DO', '63-63', 'BERNADINUS RONNY BUDIMAN', '-', '1899-12-30', 'SURABAYA', 1, 2.09, 57, '', '43375910', '6023', '', '', '', '0');
INSERT INTO `tk_mhs` VALUES ('6023707', 14, 0, 'DO', '63-63', 'BILLY MARTINUS', '-', '1899-12-30', 'SURABAYA', 0, 1.72, 68, '', '72316419', '6023', '', '', '', '0');
INSERT INTO `tk_mhs` VALUES ('6023708', 20, 1.19, '', '63-63', 'CELY ORTA BARANI', '-', '1899-12-30', 'SURABAYA', 0, 2.09, 107, '', '17387560', '6023', '', '', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023709', 20, 1.89, 'TD', '63-63', 'SISWANTO SUDIRMAN', 'JL NGINDEN KOTA GG 2 NO 82-Surabaya', '1981-09-25', 'Bangkalan', 0, 2, 127, '5040880', '37242361', '6023', '05010006', 'SUDIRMAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023801', 24, 3.5, '', '63-63', 'LIA AFRIDA', 'SIWALANKERTOTIMUR 1 NO93  -Surabaya', '1984-09-02', 'Kediri', 0, 2.72, 147, '8475716', '53041618', '6023', '05011159', 'BUDI SANTOSO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023802', 24, 4, '', '63-63', 'HERU KRISTIANTO', 'DURIAN 28 PERUMNAS WINONG -Pati', '1984-05-30', 'Pati', 0, 2.57, 141, '', '30391283', '6023', '03481005', 'ANDOYO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023803', 14, 0.37, 'DO', '63-63', 'ANDY CHRISTANTO', 'JL HOS COKROAMINOTO 17    -Pati', '1984-07-07', 'Pati', 0, 1.75, 4, '384890', '71930012', '6023', '03481005', 'IDA LIANAWATI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023804', 24, 3.62, 'N', '63-63', 'DENI SOERYADI SOEGIARTO', 'BHAKTI 49 KUDUS           -SURABAYA', '1985-06-03', 'Rembang', 0, 3.68, 148, '444960', '03-06-85', '6023', '03490001', 'SOEGIARTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023805', 14, 0, 'DO', '63-63', 'CAROLINE FEBIANA TENDEAN', 'WISMA MUKTI B 5           -Surabaya', '1984-02-14', 'Surabaya', 0, 1.38, 13, '5947529', '95602902', '6023', '0501xxxx', 'EDDY TENDEAN', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023806', 24, 4, 'N', '63-63', 'AMELIA FINIARTI MILAWIDJAJA', 'KERTAJAYA INDAH 5 15 F 403-Surabaya', '1984-05-21', 'Surabaya', 0, 3.44, 142, '594 6164', '21-05-84', '6023', '05011149', 'ANDY MILAWIDJAJA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023807', 24, 3.5, 'N', '63-63', 'EVA NOFIANA', 'PETEMON 3 82B             -Surabaya', '1984-11-28', 'Lamongan', 0, 3.27, 149, '5314079', '28-11-84', '6023', '05011095', 'HERTINA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023808', 24, 3.5, '', '63-63', 'SUKMA YULVICASARI', 'JL BAGONG GINAYAN 7 14    -Surabaya', '1984-07-20', 'Surabaya', 0, 2.58, 148, '5021623', '53065035', '6023', '05011159', 'MOCHAMAD RIFAI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023809', 24, 3.5, '', '63-63', 'AGUSTIN', 'MANGGA 12                 -Kudus', '1984-08-16', 'Kudus', 0, 2.81, 148, '438273', '14208301', '6023', '03499999', 'TANTY MEGAWATI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023810', 22, 0.86, 'P', '63-63', 'ROBY SURJOBOWO', 'NGAGEL DADI 1 52          -Surabaya', '1984-04-03', 'Kediri', 1, 1.91, 22, '5046294', '03-04-84', '6023', '05051012', 'TRISNO UTOMO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023811', 24, 3.55, 'N', '63-63', 'AZALIA WIJAYA', 'BRATANG BINANGUN 4 10A    -Surabaya', '1984-07-29', 'Surabaya', 0, 3.22, 146, '5024903', '29-07-84', '6023', '05011091', 'KHOENTORO WIDJAYA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023812', 14, 0, 'DO', '63-63', 'WILLIAM SUHARTONO', 'DARMO PERMAI SELATAN 18 14-Surabaya', '1983-12-21', 'Samarinda', 0, 0, 0, '7316144', '33974123', '6023', '05011145', 'RUDYONO SUHARTONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023813', 24, 3.62, 'N', '63-63', 'DAVID ANDRIAN', 'RUNGKUT ASRI TIMUR 1 3    -Surabaya', '1984-07-01', 'Surabaya', 0, 3.57, 147, '08703487', '01-07-84', '6023', '05011115', 'ANDRIJANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023814', 24, 3.5, '', '63-63', 'WENNY SEPTIANI', 'KAPTEN DULASIM 2D 05      -Surabaya', '1983-09-16', 'Surabaya', 0, 2.93, 149, '3985984', '77477998', '6023', '05011011', 'NG TJIONG KIAN', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023815', 24, 3, 'N', '63-63', 'ROBERT SOEWANTO', 'DARMAHUSADA UTARA 3 14    -Surabaya', '1984-03-09', 'Surabaya', 0, 3.68, 147, '5938998', '09-03-84', '6023', '05011115', 'SANDI SOEWANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023816', 24, 3.92, 'N', '63-63', 'HARMAN DARSONO', 'PUCANG ASRI 4 NO 1        -Surabaya', '1984-06-12', 'Pasuruan', 0, 3.12, 147, '5020174', '12-06-84', '6023', '05011096', 'GATOT DARSONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023817', 14, 1.05, 'P', '63-63', 'SHERLIANA', 'SIDOTOPO WETAN 98         -Surabaya', '1984-07-03', 'Surabaya', 0, 1.54, 13, '3765918', '03-07-84', '6023', '05011116', '', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023818', 24, 3.5, 'N', '63-63', 'LIZ KALLISTA', 'LETJEN HARYONO 389        -SURABAYA', '1983-09-28', 'Surabaya', 0, 3.31, 150, '841906', '28-09-83', '6023', '05xx1013', 'LINUS PAULING TANDEA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023819', 24, 3, 'N', '63-63', 'RUDI SUGIARTO MUHALIM', 'KENCONO WUNGU             -Semarang', '1984-01-27', 'Semarang', 0, 3.03, 150, '', '27-01-84', '6023', '03041022', 'WIM MUHALIM', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023820', 24, 4, '', '63-63', 'WELY SUSANTO', 'MONGINSIDI 29             -Kediri', '1984-09-26', 'Kediri', 0, 2.79, 142, '687375', '35130548', '6023', '05051012', 'AGUS SUSANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023821', 24, 4, 'N', '63-63', 'AGNES IVANA DEWI', 'AHMAD YANI 99             -Surakart', '1984-08-01', 'Surakarta', 0, 2.98, 148, '780846', '01-08-84', '6023', '03021018', 'RUDI HERMANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023822', 24, 4, '', '63-63', 'REZA PRANOWO', 'PEMUDA 51                 -Kudus', '1984-03-23', 'Kudus', 0, 3.15, 143, '437022', '38330042', '6023', '03490001', 'BUDI GUNAWAN PRANOWO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023823', 24, 3.5, '', '63-63', 'INDRA HERMAWAN', 'JL SETONO 64 KUWAK        -Kediri', '1983-07-06', 'Kediri', 0, 2.59, 145, '692409', '90064201', '6023', '05051012', 'SWITO SOEWIRJO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023824', 24, 4, 'N', '63-63', 'NATALIUS CHRISTIAN SUTRISNO', 'DR WAHIDIN 158 GURAH      -Kediri', '1984-12-18', 'Kediri', 0, 3.03, 147, '545520', '18-12-84', '6023', '05051012', 'SUTRISNO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023825', 16, 0, 'K', '63-63', 'ANTONIUS DENNY JULIANTO', 'PEMUDA 32                 -Kudus', '1984-07-05', 'Kudus', 1, 2.21, 43, '430054', '05-07-84', '6023', '03490001', 'AGUS PUJIYONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023826', 24, 4, 'N', '63-63', 'MARTHA THERESIA SUSANTO', 'BANYUWANGI 11 GARAHAN     -Jember', '1984-03-03', 'Jember', 0, 3.13, 148, '521136', '03-03-84', '6023', '05211013', 'EDY SETIJO SUSANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023827', 20, 2.06, '', '63-63', 'ADE IVANA TAN', 'DHARMAHUSADA MAS AC 27    -Surabaya', '1899-12-30', 'SURABAYA', 1, 2.43, 135, '5981273', '86462193', '6023', '05011149', '', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023828', 24, 4, '', '63-63', 'RIZAL HARTANTO SETIYONO', 'SAMBAS 04                 -Malang', '1983-10-07', 'Malang', 0, 3, 147, '498598', '57313471', '6023', '05031025', 'PAULUS SETIYONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023829', 24, 3.81, 'N', '63-63', 'CHANDRA YUWONO', 'PLOSO BARU 65             -Surabaya', '1984-04-04', 'Surabaya', 0, 3.39, 148, '3815247', '04-04-84', '6023', '05011115', 'BUDI SUKIANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023830', 24, 3.5, 'N', '63-63', 'STEVEN INDRAWIJAYA', 'MANYAR TIRTOASRI 11 6     -SURABAYA', '1984-01-31', 'Nganjuk', 0, 2.81, 145, '5941105', '31-01-84', '6023', '05011115', 'JOHANES INDRAWIJAYA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023831', 16, 1.84, 'DO', '63-63', 'KIRANA DEWI', 'A YANI 131               -Nganjuk', '1984-02-02', 'Nganjuk', 2, 2.18, 77, '322987', '70963976', '6023', '05051012', 'DJUWONO    J', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023832', 24, 4, 'N', '63-63', 'YANUAR DWI HANANTO', 'JL RAYA NO90A LASEM       -Rembang', '1983-01-05', 'Rembang', 0, 2.71, 147, '531209', '05-01-83', '6023', '03471003', 'HAMID PRAMONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023833', 24, 4, '', '63-63', 'MELFRIDA HERTATI', 'KALIDAMI NO 42            -Surabaya', '1984-05-15', 'Surabaya', 0, 2.89, 149, '5938251', '30378362', '6023', '05011149', 'BISTK  SIBUEA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023834', 24, 4, '', '63-63', 'AMELIA', 'BRONTOSENO 364 KERAS      -Kediri', '1984-06-08', 'Kediri', 0, 2.66, 142, '478189', '58004284', '6023', '05340013', 'JOKO BINTORO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023835', 24, 3.5, 'N', '63-63', 'HERRY GUNAWAN', 'SUYITMAN 27 AMBULU        -Jember', '1984-02-26', 'Jember', 0, 3.41, 149, '882557', '26-02-84', '6023', '05391013', 'SURYO GUNAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023836', 24, 4, 'N', '63-63', 'FERRY SUSANTO MULYONO', 'SIMOLAWANG BARU NO 1      -Surabaya', '1985-05-07', 'Surabaya', 0, 3.35, 147, '3710140', '07-05-85', '6023', '05011149', 'HADI MUL *NO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023837', 24, 3.6, 'N', '63-63', 'ANGELA WULI', 'RUNGKUT MEJOYO SELATAN 1 7-Surabaya', '1984-05-19', 'Surabaya', 0, 3.52, 148, '8421277', '19-05-84', '6023', '05011091', 'RENO WULI FRIENDLY', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023838', 24, 3.92, 'N', '63-63', 'FERDI GUSTAM', 'KARANG ASEM INDAH B 25    -Surabaya', '1984-08-18', 'Surabaya', 0, 2.71, 147, '3897912', '18-08-84', '6023', '05011101', 'TAMBRIN KUSJANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023839', 24, 3.5, '', '63-63', 'WENNY CAHYONO', 'EMBONG MALANG 26          -Surabaya', '1984-01-23', 'Surabaya', 0, 2.59, 146, '5310680', '45475788', '6023', '05011116', 'SETYO CAHYONO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023840', 24, 3.95, 'N', '63-63', 'YUNUS SIEDARTA', 'KALIKEPITING INDAH 10B    -Surabaya', '1983-09-28', 'Surabaya', 0, 3.53, 145, '3897471', '28-09-83', '6023', '05011087', 'ANWAR SIEDARTA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023841', 24, 3.36, '', '63-63', 'ANDI SOENGGONO', 'DELTA TAMA GANG 4 1 WARU  -Sidoarjo', '1983-10-26', 'Probolinggo', 0, 2.76, 145, '8539851', '16813695', '6023', '05071009', 'KUSTINA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023842', 16, 1.18, 'DO', '63-63', 'HERU SANTOSO', 'TENGGILIS PERMAI A 11     -Surabaya', '1983-11-29', 'Kediri', 0, 2.14, 47, '', '28757924', '6023', '05360006', 'SANTOSO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023843', 24, 3.75, 'N', '63-63', 'AMELIA MEDIAWATI SUTANTO', 'J A SUPR PTO 5 *          -Mojokert', '1984-02-17', 'Mojokerto', 0, 3.01, 149, '321883', '17-02-84', '6023', '05021011', 'HENRY TANAMA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023844', 24, 3.85, 'N', '63-63', 'CHRISTINE NATALIA HARTONO', 'JL RAYA LANGSEP 74        -Malang', '1984-12-27', 'Pasuruan', 0, 3.56, 149, '568220', '27-12-84', '6023', '05031030', 'HARTONO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023845', 24, 4, 'N', '63-63', 'CANITA DEWI', 'SIMPANG BOROBUDUR 37      -Malang', '1984-05-10', 'Mojokerto', 0, 3.7, 147, '495277', '10-05-84', '6023', '05031029', 'TEGUH HARIANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023846', 24, 3.92, 'N', '63-63', 'MYRA JESSICA PURWOBINTORO', 'MOJOPAHIT 99              -Mojokert', '1984-03-02', 'Mojokerto', 0, 3.98, 153, '321583', '02-03-84', '6023', '05021011', 'YASIN PRASETYO P', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023847', 16, 1.55, 'DO', '63-63', 'MARTIN SETIAWAN', 'JL KARTINI 17 REMBANG     -Rembang', '1984-06-29', 'Rembang', 0, 1.85, 42, '691062', '58313694', '6023', '03471003', 'PHAN FIE MING', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023848', 24, 3.97, 'N', '63-63', 'YULIANTO PRAYITNO', 'PETEMON 4 195I            -Surabaya', '1983-07-11', 'Surabaya', 0, 3.58, 145, '5467406', '11-07-83', '6023', '05011087', 'SUPRAYITNO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023849', 24, 4, '', '63-63', 'RONY SETYAWAN', 'PELABUHAN 7A              -Rembang', '1983-10-07', 'Rembang', 0, 2.65, 146, '691640', '19259860', '6023', '03471003', 'EDDY SETYAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023850', 24, 4, 'N', '63-63', 'DEVI ANGGRAINI', 'RA KARTINI 90             -Rembang', '1984-05-04', 'Rembang', 0, 3.33, 148, '691807', '04-05-84', '6023', '03471003', 'SOEJANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023851', 24, 3.5, 'N', '63-63', 'SONY SUGIARTO', 'DR WAHIDIN 35             -Rembang', '1984-04-13', 'Rembang', 0, 2.97, 146, '691908', '13-04-84', '6023', '03471003', 'MOELJO HARIJANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023852', 20, 0, 'Tu', '63-63', 'LEON WIBOWO KURNIAWAN', 'TENGGILIS MEJOYO P-34 SURABAYA', '1983-08-19', 'Surakarta', 3, 2.82, 96, '8412451', '29194956', '6023', '03021018', 'SOEPRAPTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023853', 16, 0.88, 'TD', '63-63', 'MARDI ANGKAJAYA', 'KAPASARI 5 40             -Surabaya', '1984-01-29', 'Surabaya', 2, 2.02, 90, '3712211', '78055687', '6023', '05011101', 'MARUTO ANGKASA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023854', 24, 3.92, 'N', '63-63', 'THERESIA LILYANAWATI TANJUNG', 'SATELIT TIMUR 2   JJ28    -Surabaya', '1983-10-26', 'Surabaya', 0, 3.92, 158, '7313251', '26-10-83', '6023', '05011114', 'JONI GUNAWAN', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023855', 24, 3.85, 'N', '63-63', 'VIVI WIJAYA', 'MANGGAR 177               -Jember', '1984-03-30', 'Jember', 0, 3.73, 146, '421953', '30-03-84', '6023', '05391013', 'EDY MULJONO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023857', 24, 3.5, 'N', '63-63', 'ANDRE PURWANTO WIJAYA', 'LEBAK JAYA 3 UTARA 24     -Surabaya', '1983-12-27', 'Surabaya', 0, 3.46, 145, '3891638', '27-12-83', '6023', '05011101', 'AGUS WIJAYA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023858', 24, 4, 'N', '63-63', 'YONGKI PURWANTO', 'LEBAK JAYA 3 UTARA 18     -Surabaya', '1984-12-20', 'Surabaya', 0, 3.83, 152, '3812895', '20-12-84', '6023', '05011087', 'WONG MEI CHEN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023859', 24, 3.5, 'N', '63-63', 'FRANS', 'I R RAIS 119 C            -Malang', '1985-02-08', 'Malang', 0, 2.79, 148, '365999', '08-02-85', '6023', '05031030', 'HERRY GUNAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023861', 20, 1.25, '', '63-63', 'ANNIE SANJAYA', 'POGOT BARU GG 2 NO 21     -Surabaya', '1984-05-29', 'Sidoarjo', 0, 2.07, 135, '3724647', '53323360', '6023', '05011129', 'INGAWATI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023862', 22, 2.94, 'N', '63-63', 'FERDINAND SAPUTRA CHANDRA', 'PLOSO TIMUR 7 NO 64       -Surabaya', '1984-04-24', 'Surabaya', 0, 3.03, 147, '3810223', '24-04-84', '6023', '05011116', 'SUTEKNO CHANDRA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023864', 20, 1.81, 'N', '63-63', 'PEGGY LIDYA SOLIM', 'SATELIT INDAH 6 LN7       -Surabaya', '1986-03-05', 'AMBON', 0, 2.44, 145, '7318516', '05-03-86', '6023', '05011145', 'MENGKY SOLIM', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023865', 24, 3.39, 'N', '63-63', 'PAULUS SANTOSO', 'DONOREJO 1 22             -Surabaya', '1984-07-06', 'Surabaya', 0, 2.95, 147, '3763746', '06-07-84', '6023', '05011101', 'TIEN GUNAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023866', 24, 3, 'Tu', '63-63', 'ROBERT SUGIYO GUNAWAN SOESANTO', 'IKAN BUNTEK 22            -SURABAYA', '1983-03-29', 'Surabaya', 0, 2.4, 149, '', '85916808', '6023', '05011101', 'GONDO UNTORO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023867', 24, 3.57, 'N', '63-63', 'CENDRA RINI DJUARTA', 'KERTOPATEN 46            -Surabaya', '1984-05-17', 'Surabaya', 0, 2.66, 144, '5945934', '17-05-84', '6023', '05011101', 'NOERDISEN DJUARTA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023868', 22, 2.5, '', '63-63', 'LIE SANCUK HANAFI', 'PLAMPITAN 10 39           -Surabaya', '1984-08-11', 'Surabaya', 0, 2.55, 140, '5323290', '34929346', '6023', '05011116', 'ALEN YUNIOR', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023869', 24, 4, 'Tu', '63-63', 'JEFFRY KOESMONO', 'TAMAN  INTENASIONAL 1 B167-Surabaya', '1984-04-24', 'Surabaya', 0, 3.38, 144, '7414345', '43554213', '6023', '05011114', 'KOESMONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023870', 24, 4, 'N', '63-63', 'ERVAN SUTANTO', '-', '1984-05-26', 'Madiun', 0, 2.84, 144, '', '26-05-84', '6023', '05081016', 'YULIUS SUTANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023871', 14, 0, 'DO', '63-63', 'YOHANES HARIYONO', 'KARANG GAYAM GG1 3F       -Surabaya', '1984-02-01', 'Banyuwangi', 0, 0, 0, '5031938', '15017099', '6023', '05019999', 'BASUKI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023872', 16, 1.29, 'DO', '63-63', 'SOEGIARTO GUNAWAN', 'JAGALAN 1 5 KRIAN         -Sidoarjo', '1985-02-21', 'Sidoarjo', 0, 1.84, 40, '8971362', '78651938', '6023', '05011082', 'FERRY GUNAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023873', 16, 0, 'DO', '63-63', 'HENDRI IRYAWAN', 'KARANG ASEM 4 NO 152      -Surabaya', '1983-04-09', 'SURABAYA', 0, 1.87, 19, '3821894', '97841001', '6023', '05011101', 'LIEM GIOK ING', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023874', 24, 3.5, '', '63-63', 'JIMMY FRANKY HALIM', 'GEMINI 10                 -Surabaya', '1984-08-30', 'Surabaya', 0, 2.56, 146, '3815520', '98283034', '6023', '05011101', 'SUTANTO HALIM', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023875', 24, 3.5, '', '63-63', 'PRIANTO DHARMA KURNIAWAN', 'PENELEH GANG12 NOMOR1     -Surabaya', '1984-06-10', 'Surabaya', 0, 2.74, 149, '5320 30', '38054250', '6023', '05011095', 'JOPIE SOENGKONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023876', 24, 3.67, 'N', '63-63', 'MIA MIRANDA', 'RUNGKUT LOR RL 2K NO 6    -Surabaya', '1984-09-07', 'Probolinggo', 0, 2.7, 146, '3552039', '07-09-84', '6023', '05011095', 'EDDY BUDI SANTOSO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023877', 24, 3.5, '', '63-63', 'LEONY DEWI SETIONINGRUM', 'YOS SUDARSO NO 4          -Madiun', '1984-07-07', 'MAGETAN', 0, 2.55, 146, '894788', '16224371', '6023', '05080003', 'ANDY WITONO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023878', 20, 1.8, 'Tu', '63-63', 'KRISTINA MAULINA SILALAHI', 'DUKUH PAKIS 6C 55         -Surabaya', '1983-09-12', 'Surabaya', 0, 2.33, 145, '5620578', '48182767', '6023', '05011095', 'WESLY SILALAHI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023879', 24, 4, 'N', '63-63', 'MIKE SANTOSO', 'MENOREH TENGAH 3 9        -Semarang', '1983-09-13', 'Semarang', 0, 2.62, 146, '8317419', '13-09-83', '6023', '03041013', 'ANA SANTOSO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023880', 24, 3.5, 'N', '63-63', 'PRISCA DEWI', 'MANYAR KERTOADI XI W522   -Surabaya', '1984-11-10', 'Lumajang', 0, 2.87, 144, '5999628', '10-11-84', '6023', '05011149', 'WELIYANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023881', 24, 3, '', '63-63', 'KOMANG MAYA WIJAYA', 'MANYAR KERTA ADI VII 21   -Surabaya', '1984-07-31', 'Buleleng', 0, 2.5, 144, '5940013', '31284302', '6023', '05011149', 'NENGAH RUMANTIASA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023883', 24, 4, '', '63-63', 'EKO WILIANTO', 'SUKOMANUNGGAL JAYA 2 8    -Surabaya', '1984-02-08', 'Surabaya', 0, 2.81, 145, '7312391', '56654896', '6023', '05011062', 'WINARDI LAVIANO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023884', 16, 0.88, 'DO', '63-63', 'DAVID HARIONO', 'UNDAAN KULON 9            -Surabaya', '1983-07-04', 'Surabaya', 2, 1.82, 25, '05341627', '65292836', '6023', '05011101', 'JAHYA SETIAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023885', 14, 0.53, 'DO', '63-63', 'FX. HANDOKO SETIAWAN', 'TAMBAKMADU 2 09           -Surabaya', '1983-03-29', 'Surabaya', 0, 1.43, 7, '3717239', '98981804', '6023', '05011075', 'YOHANES SOEGIONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023887', 20, 1.18, '', '63-63', 'ARLIA OKTAVIANI', 'DHARMA RAKYAT 4 23        -Surabaya', '1983-10-31', 'Surabaya', 0, 2.02, 133, '5034267', '35540012', '6023', '05011116', 'DJONNI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023888', 14, 0, 'DO', '63-63', 'DENDY', 'WIYUNG INDAH B3 9         -Surabaya', '1984-07-23', 'Surabaya', 0, 2.14, 70, '7662875', '74538300', '6023', '05011116', 'SIPIN TJAHYADI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023889', 24, 4, 'Tu', '63-63', 'ROY SUTANTO', 'KENDANGSARI Q 21A         -Surabaya', '1984-01-23', 'Surabaya', 0, 3.2, 142, '8412691', '18113152', '6023', '05011091', 'TAN TJIN KWANG', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023890', 24, 4, 'N', '63-63', 'CHRISTIANTO GUNAWAN', 'PUCANG INDAH P 17 SIDOARJO-Sidoarjo', '1984-05-01', 'SURABAYA', 0, 3.19, 147, '', '01-05-84', '6023', '05451017', '', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023891', 16, 0, 'P', '63-63', 'SUSANNA', '-', '1899-12-30', 'SURABAYA', 0, 1.75, 4, '', '-  -', '6023', '23211009', '', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023892', 14, 0, 'P', '63-63', 'FINA', '-', '1899-12-30', 'SURABAYA', 0, 1.4, 10, '', '-  -', '6023', '23211009', '', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023893', 24, 3.81, 'N', '63-63', 'DESSYLIA EKAWATI', 'TENGGILIS MEJOYO AM 5     -Surabaya', '1984-12-14', 'SUMBAWA', 0, 3.51, 147, '8470491', '14-12-84', '6023', '23360001', '', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023894', 24, 3.5, '', '63-63', 'YUNITA BUDIMAN', 'P TANJUNG PERMAI C8WONASRI-Surabaya', '1984-06-19', 'BANJARMASIN', 0, 2.77, 148, '8715879', '10007507', '6023', '15011011', '', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023895', 24, 3.79, 'N', '63-63', 'SRI YULIAWATI', 'AMINAH SYUKUR GG MM 2 NO36-Samarind', '1984-07-11', 'SAMARINDA', 0, 3.46, 151, '742988', '11-07-84', '6023', '16010001', '', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023897', 24, 4, 'N', '63-63', 'WENDY', 'RUNGKUT MEJOYO UTARA KY 4A-Surabaya', '1984-09-20', 'BALIKPAPAN', 0, 3.26, 150, '', '20-09-84', '6023', '16020001', '', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023898', 24, 4, '', '63-63', 'WAHYUDI CHANDRA', 'LAMBUNG MANGKURAT 5 RT 27 -Samarind', '1899-12-30', 'SURABAYA', 0, 2.75, 142, '735961', '10951043', '6023', '16011013', '', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023899', 22, 2.5, '', '63-63', 'SELVI ERTANTI ELIM', 'TENGGILIS MEJOYO KH-3     -SURABAYA', '1984-11-21', 'KUPANG', 0, 2.29, 144, '8430531', '37831726', '6023', '24211009', '', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023900', 24, 3.42, 'N', '63-63', 'ELLEN TJOANDY', 'BULAK RUKEM TIMUR 2 18    -SURABAYA', '1984-04-10', 'WAIKABUBAK', 0, 2.61, 145, '3816940', '10-04-84', '6023', '24310001', '', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6023901', 24, 0, 'K', '63-63', 'TRIHANYNDIO RENDY SATRYA', 'MEDOKAN AYU 1P 20 SBY     -Surabaya', '1899-12-30', 'SURABAYA', 0, 0, 0, '8705362', '-  -', '6023', '05010002', '', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023902', 14, 0, 'DO', '63-63', 'ERIK SEBASTIAN', 'DARMO PERMAI TIMUR 14 49  -Surabaya', '1899-12-30', 'SURABAYA', 0, 0, 0, '7314060', '73284562', '6023', '05011087', '', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023991', 24, 3, '', '63-63', 'ANDRY HARTANTO', 'KERTAJAYA 46              -Surabaya', '1985-01-22', 'Surabaya', 1, 2.82, 148, '5018750', '43795201', '6023', '05011096', 'DARMANTO GOENTORO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023992', 24, 4, 'Tu', '63-63', 'HADI WIJAKSANA SINDARU', 'TMN SIMOLAWANG BARU UTR 27-Surabaya', '1984-02-28', 'Banyuwangi', 0, 2.51, 144, '3710731', '87757155', '6023', '05011150', 'SOETIKNO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6023993', 14, 0.14, 'DO', '63-63', 'JEFRI SETIAWAN', 'T ENGGILIS MEJOYO AG 4    -SURABAYA', '1899-12-30', 'SURABAYA', 0, 1, 2, '', '10405833', '6023', '', '', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024001', 20, 2.09, 'Tu', '64-64', 'NOVITA HANAYANI', 'RAJA ALI 35 KOMP AL       -Kepulaua', '1984-11-28', 'Surabaya', 0, 2.26, 140, '27635', '24666030', '6024', '09339999', 'HANANTO DARMOBROTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024002', 24, 3, '', '64-64', 'VIVIN IKA PRANATA', 'JLN DIPONEGORO 29 MAIBIT  -Tuban', '1985-07-07', 'Tuban', 0, 2.84, 150, '811283', '78084459', '6024', '05520004', 'SUNARTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024003', 20, 2.3, '', '64-64', 'ERZA  ABIMURDHANI', 'KOMPLEK HK NO 1 GEBANG    -Mataram', '1984-02-17', 'Mataram', 0, 2.19, 150, '634513', '13825188', '6024', '23210001', 'BAMBANG ABISATYO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024004', 14, 0, 'DO', '64-64', 'ANDRY LIANTO', 'JEND SUDIRMAN 79          -Kupang', '1985-04-04', 'Timor Tengah', 0, 0, 0, '821393', '22087101', '6024', '24211009', 'CHARLES LIE   O', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024005', 24, 4, '', '64-64', 'VIDYA FAYA LESTARI', 'JL BUNG KARNO 51 MATARAM  -Mataram', '1985-04-28', 'Lombok Tengah', 0, 3.03, 144, '637742', '57657468', '6024', '23210002', 'DRS A FAKIHI MBA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024006', 14, 0.68, 'DO', '64-64', 'ENGELBERT HENDRIKUS PETER', 'MENARI 27                 -Pekalong', '1985-01-27', 'Malang', 0, 2.22, 25, '365208', '65412564', '6024', 'SMUK SANTO YUSUF', 'CORRY WAANI TICOALU', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024007', 24, 3, '', '64-64', 'RITA', 'PAGONGAN TIMUR 2 31       -Cirebon', '1984-08-12', 'Cirebon', 1, 3.21, 144, '205635', '16189025', '6024', '02041006', 'ADIKUSUMA JO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024008', 24, 0, 'P', '64-64', 'ARIC ANTHONY', 'DOHO 2                    -Surabaya', '1984-12-04', 'Bojonegoro', 0, 0, 0, '5681868', '04-12-84', '6024', 'SMUK FRATERAN SB', 'LESTIO BUDI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024009', 24, 3.2, 'N', '64-64', 'LYSANDRA JASI', 'WISMA PERMAI 1 NO 46      -Surabaya', '1984-02-06', 'Surabaya', 0, 3.17, 148, '5927546', '06-02-84', '6024', '05011096', 'NONONG JASI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024010', 24, 4, '', '64-64', 'JOICE ONGGARA', 'DIPONEGORO 13             -Lumajang', '1984-05-11', 'Lumajang', 0, 2.9, 144, '881752', '76304797', '6024', '05380001', 'WINARYO ONGGARA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024012', 14, 0.59, 'P', '64-64', 'LESTARI PUTRI UTOMO', 'MH THAMRIN 256            -Banyuwan', '1983-06-14', 'SURABAYA', 0, 1.72, 23, '426049', '14-06-83', '6024', '22211014', 'SYAHRONI HUSEIN', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024013', 16, 1.55, 'TD', '64-64', 'ANTON SOEBIJANTO', 'MANGIS  C 18              -Jombang', '1984-09-19', 'Surabaya', 1, 2.03, 95, '861354', '58677513', '6024', '05371024', 'DEDDY SOEBIJANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024014', 14, 0, 'DO', '64-64', 'ERIC FABRIAN', 'WISMA PERMAI 13 6         -Surabaya', '1985-02-06', 'Surabaya', 0, 2.5, 4, '5932910', '84845255', '6024', '05011149', 'SANTOSO MARTOREDJO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024015', 24, 3.4, '', '64-64', 'HENDRA SANJAYA', 'KARYA TIMUR 66            -Malang', '1983-04-17', 'Malang', 0, 2.29, 133, '495143', '87570601', '6024', '05031029', 'RUSDI HARTAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024016', 16, 1.07, 'DO', '64-64', 'AGUNG YUDIANTO', 'IKAN NUS 2 10             -Malang', '1984-01-22', 'Malang', 2, 2.07, 59, '472783', '25839606', '6024', '05031037', 'KURNIA TJAHJADI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024017', 24, 3, '', '64-64', 'FERA JULIANA', 'BRONGGALAN SAWAH 1 55     -Surabaya', '1983-08-15', 'Surabaya', 0, 2.33, 147, '3817654', '41536552', '6024', '05011091', 'KHO TJUAN GUAN', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024018', 24, 3, '', '64-64', 'SISKA YASODHARA', 'SIMODARSONO 35A           -Blora', '1984-07-31', 'Blora', 0, 2.69, 148, '531642', '50885327', '6024', '03460001', 'EKO SOESETYO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024020', 24, 4, 'N', '64-64', 'DIAN WULANSARI', 'JL HASANUDIN 16           -Pasuruan', '1984-03-09', 'Pasuruan', 0, 3.6, 145, '417706', '09-03-84', '6024', '05040001', 'JOHNY CHAZINO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024022', 14, 0.52, 'DO', '64-64', 'IGNASIUS NUGROHO SAMAYA', 'JL PELATUK   MALANG       -Malang', '1984-12-05', 'Malang', 0, 1.64, 32, '367546', '81103710', '6024', '05031026', 'HERRY PURWANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024023', 16, 0, 'K', '64-64', 'ARGA PRATAMA PUTRA', 'KETINTANG WIYATA 7 8A     -Surabaya', '1985-03-07', 'Surabaya', 0, 2.29, 89, '8283901', '07-03-85', '6024', '05010004', 'INDAH AFIATI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024024', 24, 4, 'TD', '64-64', 'ALDY PRANATA', 'TAMAN DARMO HARAPAN EG 11C-Surabaya', '1984-05-15', 'Surabaya', 0, 2.45, 148, '7317042', '49612176', '6024', '05011091', 'FX FRANS YANUARDI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024025', 24, 3, '', '64-64', 'HENDERA', 'TEMPEL SUKOREJO 1 44      -Surabaya', '1984-02-26', 'Surabaya', 0, 2.38, 147, '5312498', '34800005', '6024', '05011116', 'TEKY MARSIONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024026', 24, 4, 'N', '64-64', 'HANSI ADITYA KURNIAWAN', 'JAGALAN 62                -Surabaya', '1984-07-08', 'Surabaya', 0, 3.79, 144, '3537264', '08-07-84', '6024', '05011087', 'ARDY SETIAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024027', 14, 0, 'DO', '64-64', 'DAVID RAHARJO', 'ARGOPURO 107 JEMBER       -Jember', '1984-02-19', 'Jember', 0, 2.2, 20, '711301', '84943523', '6024', '05391013', 'BUDI RAHARJO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024028', 22, 2.81, '', '64-64', 'JEMY ARIEF GUNAWAN', 'SLAMET RIYADI 35          -Jember', '1984-04-13', 'Jember', 0, 2.48, 150, '481769', '48357933', '6024', '05391013', 'HADI SURYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024029', 20, 1.48, '', '64-64', 'BUDI KANG', 'NIAGA UTARA 79            -Samarind', '1985-05-11', 'Samarinda', 0, 2.09, 103, '737608', '73786521', '6024', '05031026', 'KANG KIM TONG', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024030', 20, 0.86, 'P', '64-64', 'HADI SUSANTO', 'KALUTA 18                 -Malang', '1983-12-08', 'Malang', 0, 2.38, 13, '565787', '08-12-83', '6024', '05031030', 'HERMAN SUSANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024031', 16, 0.2, 'P', '64-64', 'DANIEL TJOKRO YUWONO', '-', '1984-05-04', 'Surabaya', 2, 2.1, 71, '', '04-05-84', '6024', '05011116', 'LINAWATI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024032', 14, 0, 'DO', '64-64', 'MARKUS HADY SUTEJA', 'RAYA DIPONEGORO 208 B     -Surabaya', '1983-03-25', 'Surabaya', 0, 2.02, 25, '5673483', '70095136', '6024', '05011116', 'GUNAWAN SUTEJA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024033', 20, 2.19, '', '64-64', 'HENDRO WICAKSONO', 'KARANGSONO BARAT MAGETAN  -Magetan', '1983-02-14', 'Magetan', 0, 2.25, 149, '', '23070525', '6024', '05500001', 'SUYADI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024034', 24, 3.86, '', '64-64', 'RIO TANOTO', 'SUMBAWA 2 10              -Semarang', '1985-03-26', 'Semarang', 0, 2.38, 139, '8412009', '54641458', '6024', '03041013', 'HADI SUSANTO H', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024035', 16, 0, 'DO', '64-64', 'ANUGROHO NAROTOMO', 'PERUMAHAN DINAS PTKL A7   -Probolin', '1984-03-02', 'Surabaya', 0, 1.73, 15, '680653', '68611772', '6024', '05431010', 'IR SIGIT WIRATNO MBA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024036', 20, 1.59, 'TD', '64-64', 'IMMANUEL JOVIANTO', 'JL SRIGADING 35           -Malang', '1984-10-05', 'Surabaya', 0, 2.27, 122, '492852', '34029806', '6024', '05031029', 'LOEMINTO UNTUNG', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024038', 24, 1.5, 'P', '64-64', 'ARIE ASALI', 'DARMO PERMAI SELATAN 5 36 -Surabaya', '1984-01-29', 'Maluku', 0, 3.22, 9, '7312703', '29-01-84', '6024', '05011090', 'BERNARD ASALI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024039', 24, 3.5, '', '64-64', 'CHANDRA BUDI WIJOYO', 'TAMBORA 37                -Malang', '1984-04-19', 'Malang', 0, 2.76, 144, '565110', '10972530', '6024', '05031025', 'PAULUS JUNAIDY', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024040', 24, 4, '', '64-64', 'NICHOLAS', 'PANGLIMA SUDIRMAN 51      -Malang', '1983-12-11', 'Malang', 0, 2.82, 147, '824397', '25871796', '6024', '05031025', 'ANDI WIJAYA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024042', 22, 0, 'DO', '64-64', 'FERDINANTA SUSILO', 'JL RAYA WARUNGDOWO 11 B   -Pasuruan', '1984-04-07', 'Pasuruan', 0, 2.89, 9, '412874', '70552470', '6024', '05049999', 'YUNUS SUSILO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024043', 22, 2.5, '', '64-64', 'LELIANA SANTOSO', 'BARUK TIMUR 1 12          -SURABAYA', '1984-12-16', 'Banyuwangi', 0, 2.53, 146, '8791164', '41844243', '6024', '05011091', 'KOKOH SANTOSO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024044', 24, 3, '', '64-64', 'R. ADITYA YULISTIANTO', 'KUTISARI INDAH BARAT 1 73 -Surabaya', '1984-07-10', 'Surabaya', 0, 2.36, 148, '8435773', '45363398', '6024', '05011105', 'H R  ARSO SUTJIADI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024046', 14, 0.64, 'DO', '64-64', 'MARTIN EFFENDI', 'RAYA MARON 725            -Probolin', '1984-03-28', 'Malang', 0, 1.57, 23, '611608', '76679137', '6024', '05071009', 'SUGIANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024047', 22, 2.97, '', '64-64', 'ANDRE SUTANTO', 'PROGO 2 46                -Semarang', '1984-10-13', 'Semarang', 0, 2.63, 146, '3520101', '49663378', '6024', '03041022', 'TJAI PIN HO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024048', 20, 1.56, 'Tu', '64-64', 'ANDREW SETIAWAN', 'SETERAN TENGAH 47         -Semarang', '1984-03-29', 'Semarang', 0, 2.33, 133, '3552568', '29730056', '6024', '03041022', 'HARJONO SETIAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024049', 20, 1.77, 'Tu', '64-64', 'WILHELMUS ISIDORUS ATIN', 'NGAGELJAYASELATANGG1NO22  -Surabaya', '1985-02-04', 'Belu', 1, 2.45, 122, '5029425', '69044989', '6024', '05031037', 'JOHANES ROBERT ATIN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024050', 25, 0.75, 'DO', '64-64', 'WELLINGTON TJANDRA P', 'KEMAYORAN 3 19            -Surabaya', '1984-10-06', 'Surabaya', 3, 1.61, 38, '3525506', '17760438', '6024', '05011095', 'HENRRY TJANDRA P', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024051', 14, 0, 'DO', '64-64', 'RATIH FESTIKA SARI', 'JL TAUCHID D 62 PTSG      -Gresik', '1984-05-28', 'Gresik', 0, 0, 0, '3981732', '89001989', '6024', '05551011', 'EDY TRIHARTONO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024052', 16, 1.34, 'P', '64-64', 'SIMON ARDHI Y', 'JL SUNAN BONANG IV 3      -Magelang', '1985-02-02', 'Magelang', 0, 1.78, 41, '361680', '02-02-85', '6024', '03019999', 'TJAHYADI G', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024053', 24, 4, '', '64-64', 'CHANG WEN HAO', '-', '1984-06-26', 'Surabaya', 0, 3.31, 144, '', '91000199', '6024', '05011149', 'CHANG YUN MING', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024054', 22, 2.57, '', '64-64', 'TEK HOK', 'SUTOREJO SELATAN 3 37     -Surabaya', '1984-05-11', 'Surabaya', 0, 2.53, 158, '5935556', '38966070', '6024', '05340005', 'WILLIAM*AFENDI***JJ*', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024055', 20, 2.25, '', '64-64', 'MARIA IMACULATA DESI PANI', 'JL LEBAK JAYA 3 22A       -SURABAYA', '1984-12-01', 'Sumba Barat', 0, 2.34, 141, '3820091', '62954123', '6024', '05031030', 'ALFONSUS PANI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024057', 24, 4, '', '64-64', 'ARIEL SUDIONO', 'PASIR MAS UTARA 207       -Semarang', '1984-07-30', 'Semarang', 0, 2.98, 143, '3582857', '11236662', '6024', '03041012', 'EDDY SUDYONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024060', 24, 3.86, 'Tu', '64-64', 'SAMUEL VINSON HERMAWAN', 'PUCANGAN 4 NO 3           -Surabaya', '1984-11-26', 'Surabaya', 0, 2.45, 146, '5028689', '78127216', '6024', '05011057', 'JAKUB SETJOATMADJA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024061', 14, 1.21, 'DO', '64-64', 'CHANDRA TAMA', 'KERTAJAYA  *O7            -Surabaya', '1983-09-26', 'Surabaya', 0, 1.53, 38, '5025492', '42601418', '6024', '05011149', 'BENNYTEJAPRANATA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024062', 23, 0.94, 'DO', '64-64', 'ERWINANTO MINTAREDJO', 'DARMA HUSADA IND SEL 1 D72-Surabaya', '1984-03-29', 'Surabaya', 3, 1.76, 27, '5949829', '47420985', '6024', '05011149', 'TANTY WAHYUNI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024063', 20, 0.42, 'Tu', '64-64', 'HAMZAH LUTFI ABDAT', 'AMPEL MASJID 4            -Surabaya', '1984-04-19', 'Surabaya', 1, 2.14, 89, '3520104', '95447096', '6024', '05010009', 'LUTFI*ABDAT******M**', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024064', 14, 0, 'DO', '64-64', 'CEN JIANG', 'ELANG NO 7 CAKRANEGARA    -Mataram', '1981-03-07', 'SURABAYA', 0, 0, 0, '632639', '84837153', '6024', '23211009', 'CANDY SALIKIN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024065', 24, 3.11, '', '64-64', 'M NUR ZAINI KOMARULLAH', 'RAJAWALI UTARA 5 114REWWIN-Sidoarjo', '1984-10-01', 'Jakarta Selat', 0, 2.63, 144, '8662913', '21992803', '6024', '05010002', 'DRS PRAYOGA SP APT', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024067', 14, 0.63, 'DO', '64-64', 'YOHAN SUTANTO', 'KELASI 1 9                -Surabaya', '1983-07-02', 'Surabaya', 0, 2.06, 60, '3524376', '99805989', '6024', '05011087', 'TAN PING KIONG', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024068', 24, 3.5, 'N', '64-64', 'ANDRE', 'P SEJATI INDAH 6A 5       -Pasuruan', '1984-07-06', 'Pasuruan', 0, 3.18, 150, '427147', '06-07-84', '6024', '05040001', 'JADI SUPRATMAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024069', 24, 4, '', '64-64', 'OKTARIA ARIANDINI', 'PEPELEGI INDAH BLOK G NO23-Sidoarjo', '1983-10-18', 'SURABAYA', 0, 2.94, 144, '8538119', '70335218', '6024', '05450003', 'BUDI UTOYO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024071', 20, 0.64, 'P', '64-64', 'BAMBANG ADHITYA PUTRA', 'JL DUKU 4 CA 289 P CHANDRA-Surabaya', '1984-03-22', 'Kisaran', 0, 2.25, 4, '8676250', '22-03-84', '6024', '05010014', 'BAMBANG SOEJADI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024072', 24, 4, 'Tu', '64-64', 'VIDA RAHMA HARSIANTI', 'PANJANG JIWQ PERMAI 3 7   -Surabaya', '1984-05-23', 'Surabaya', 1, 2.85, 150, '8420704', '31557267', '6024', '05011096', 'DIDIK HARI SASONQ', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024074', 24, 4, '', '64-64', 'HENNI ARDIANA', 'COKROAMINOTO GANG PUDAK 5 -Denpasar', '1984-03-23', 'Denpasar', 0, 3.18, 139, '433874', '50208852', '6024', '22211014', 'TJIANG WINATA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024076', 24, 4, 'TD', '64-64', 'ALIF HIDAYAT', 'SEMOLOWARU ELOK AB 16     -Surabaya', '1984-05-30', 'Surabaya', 0, 2.42, 139, '5949146', '70888188', '6024', '05010009', 'NOORACHMAN S', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024077', 20, 2, 'P', '64-64', 'BENY KUSUMAWANTO', 'RUNGKUT ASRI 2 NO 7       -Surabaya', '1984-05-27', 'Banjarbaru', 1, 2.25, 18, '8711017', '27-05-84', '6024', '05011105', 'WIYOTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024078', 20, 0.31, 'P', '64-64', 'SAMUEL WANGSA WINATA', 'PWK J5 23 CITRALAND       -Surabaya', '1984-07-20', 'Lumajang', 0, 2, 4, '7415018', '20-07-84', '6024', '05011158', 'WINATA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024079', 14, 0.89, 'DO', '64-64', 'IKETUT PRASETYA ADHI CHANDR', 'DEBES 6 4 TABANAN BALI    -Tabanan', '1984-03-02', 'Denpasar', 0, 1.55, 11, '811645', '81715588', '6024', '22380001', 'TIYAGA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024080', 24, 3.5, 'N', '64-64', 'MELIANA DEWISAPUTRA', 'KLAMPIS ANOM V 19 SURABAYA-Surabaya', '1984-07-19', 'Surabaya', 0, 2.77, 144, '5948137', '19-07-84', '6024', '05011096', 'HARJANTO G', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024081', 14, 0, 'DO', '64-64', 'JUNAIDI WIRAWAN', 'COKR AMINOTO 17 UBUNG     -Denpasar', '1984-06-25', 'Surabaya', 0, 1.84, 25, '420290', '98263488', '6024', '22210007', 'ANTONIUS WIJ* A', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024083', 14, 0, 'DO', '64-64', 'MOCHAMMAD SYAIFUL', 'SEKOLAHAN 21              -Surabaya', '1984-10-29', 'Surabaya', 0, 0, 0, '5322150', '67914107', '6024', '05010008', 'DJAFRI DULLAH', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024084', 16, 0.2, 'P', '64-64', 'JULIAN EDWARD HANDOJO', 'SIMPANG DP SELATAN XV 50  -Surabaya', '1985-01-29', 'Surabaya', 0, 1.78, 18, '7317836', '29-01-85', '6024', '05011062', 'SOETJIPTO HANDOYO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024085', 24, 4, '', '64-64', 'DESSY EKAWATI', 'BUANA PERMATA HIJAU 12    -Denpasar', '1984-12-08', 'Surabaya', 0, 3.01, 147, '426426', '38906408', '6024', '22211014', 'MARIA M MINARNI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024087', 20, 2.17, 'Tu', '64-64', 'SUHERMAN', 'ENDROSONO 5 20            -Surabaya', '1981-07-12', 'Surabaya', 0, 2.31, 152, '3767197', '72958715', '6024', '05010019', 'SRIANAH', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024088', 20, 2.03, '', '64-64', 'BAMBANG SURYA WIJAYA', 'MANYAR KERTOARJO 6 61     -SURABAYA', '1985-03-07', 'Medan', 0, 2.06, 128, '5964328', '39032458', '6024', '05011149', 'JOHN VICTOR WIJAYA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024089', 24, 4, '', '64-64', 'HADI SURYA JAYA', 'JL KEDUNGANYAR5TENGAHNO3  -Surabaya', '1984-02-13', 'Surabaya', 0, 2.59, 139, '5450640', '36199270', '6024', '05011092', 'SOETRISNO HADI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024090', 20, 2.24, '', '64-64', 'VENNY KHUSUMA', 'GALAXY BUMI PER AI E1 6   -SURABAYA', '1984-06-16', 'Maluku', 0, 2.16, 151, '5991707', '67115241', '6024', '05011149', 'KHU PING BING', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024091', 24, 4, '', '64-64', 'ERZALINA EUNIKA FITRIYANTI', 'SEMOLOWARU UTARA 1   128  -Surabaya', '1984-11-05', 'Surabaya', 0, 3.26, 160, '5930305', '54479735', '6024', '05010002', 'INDAH HERWARNI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024094', 20, 2.48, 'Tu', '64-64', 'BERRY STEPHANUS PUTRA', 'JL RAYA 956 ASEMBAGUS     -SURABAYA', '1984-09-23', 'SURABAYA', 0, 2.5, 135, '452777', '62149491', '6024', '05451017', 'PETRUS HARIYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024095', 20, 2.07, '', '64-64', 'AVIA FEBRIANI', 'SIWALANKERTO TIMUR I 71   -Surabaya', '1985-02-07', 'Surabaya', 0, 2.25, 152, '8490771', '50358537', '6024', '05010016', 'SUKANTI RAHAYU', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024096', 24, 4, '', '64-64', 'ILINE LOKAJAYA', 'TAMBAK BENING 29A         -Surabaya', '1984-09-18', 'Surabaya', 1, 2.88, 142, '3762825', '21960605', '6024', '05011087', 'SUSANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024097', 24, 4, '', '64-64', 'RACHMAD AGUS DEBDIANTO', 'GALAXI BUMI PERMAI H5 37  -Surabaya', '1984-08-18', 'Surabaya', 0, 2.78, 141, '5991315', '93771533', '6024', '05010006', 'ARIEF NUR HIDAYAT', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024098', 16, 1.57, 'DO', '64-64', 'PRADITYA ARYATAMA', 'DHARMAHUSADA SELATAN NO 25-Surabaya', '1984-10-04', 'Surabaya', 1, 1.67, 24, '5947687', '66144064', '6024', '05010007', 'BANGUN TP', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024100', 20, 2.44, 'DO', '64-64', 'PUTUT ANGGA WIJAYA', 'JALAN JAKARTA 12 K3       -Jakarta', '1984-09-29', 'Bandung', 1, 2.18, 31, '7106346', '46227326', '6024', '02019999', 'SUYONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024101', 24, 4, 'TD', '64-64', 'JESIKA TANDEAN', 'RAYA TENGGILIS 135        -Surabaya', '1984-09-21', 'Tuban', 0, 2.48, 142, '8431734', '65205116', '6024', '05011115', 'ILI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024103', 24, 4, '', '64-64', 'FERRY ADI KURNIAWAN', 'IKA  MUJAIR 05            -Sidoarjo', '1984-06-06', 'Surabaya', 0, 2.65, 155, '8662014', '11223963', '6024', '05011161', 'DEWI NURANI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024104', 20, 0.62, 'P', '64-64', 'SINGGIH FIBRYANTO HALIM', 'RAMBUTAN TENGAH 1E675 PCI-Sidoarjo', '1984-02-21', 'Surabaya', 0, 2, 9, '8663993', '21-02-84', '6024', '05011118', 'SOEGIONO HALIM', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024105', 16, 1.26, 'DO', '64-64', 'ANDY WIJAYA', 'KARYA DHARMA 240          -Surabaya', '1983-11-08', 'Ujung Pandang', 2, 2.02, 33, '', '80796978', '6024', '05500001', 'H KODERI SKM', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024107', 24, 4, '', '64-64', 'YULI', 'SIMOLAWANG TEMBUSAN 1 80E -Surabaya', '1984-07-27', 'Surabaya', 0, 3.43, 148, '3718633', '52857539', '6024', '05011087', 'SUTOYO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024109', 14, 0, 'DO', '64-64', 'DANIEL KURNIAWAN', 'DARMO BARU BARAT NO 40    -Surabaya', '1983-12-30', 'Surabaya', 0, 0, 0, '7311264', '34810933', '6024', '05011160', 'MARIAWATI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024110', 16, 0.47, 'Tu', '64-64', 'JANUAR PRAWIRO YAONATHA', 'KUNTI 2                   -Denpasar', '1985-01-06', 'Ujung Pandang', 0, 2, 100, '235158', '68879578', '6024', '22211014', 'JIMMY YAONATHA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024111', 24, 3.5, '', '64-64', 'GRACIE KRISTINA RYDWANTO', 'BARATA JAYA 6 41          -Surabaya', '1983-11-11', 'Surabaya', 0, 2.88, 144, '5045380', '17975128', '6024', '05011091', 'RYDWANTO HONGGO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024112', 14, 0, 'DO', '64-64', 'LISA LISTIAN TAN', 'RUNGKUT MAPAN BARAT 12 AK4-Surabaya', '1984-10-13', 'Balikpapan', 0, 1.91, 11, '8705756', '29839778', '6024', '16020005', 'IRAWAN TAN KUSUMA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024113', 14, 0, 'DO', '64-64', 'NAHAKURA ARTHANA H.', 'SEMOLOWARU UTARA 1 80A    -Surabaya', '1984-10-06', 'Jayapura', 0, 1.27, 11, '5962560', '23709879', '6024', '25379999', 'GONGGA HUTAGALUNG', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024114', 24, 4, 'TD', '64-64', 'KATHY LORENCE LOUIS', 'KLAMPIS SEMOLO BARAT V 10 -Surabaya', '1984-09-23', 'Sumba Timur', 0, 2.86, 137, '5920965', '24931798', '6024', '24320001', 'PAULUS Y LOUIS', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024115', 24, 3.5, '', '64-64', 'GUNAWAN TJAMAN', 'JLN PELITA 07 SAMPIT      -SURABAYA', '1983-11-12', 'Kota Waringin', 0, 2.54, 145, '23073', '89280376', '6024', '14329999', 'SUPARDI TJAMAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024116', 24, 4, '', '64-64', 'FARID WAJDY', 'KAMBOJA 02                -Pamekasa', '1984-04-21', 'Pamekasan', 0, 3.12, 145, '332180', '53845662', '6024', '05560001', 'NASRULLAH KADIR', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024117', 24, 4, '', '64-64', 'HERLINA ANGGAR WULAN', 'BOGANGIN 01 06            -Surabaya', '1983-09-02', 'Surabaya', 0, 3.26, 145, '7671005', '92399403', '6024', '05010009', 'SRI HARNANIK', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024118', 14, 0.32, 'DO', '64-64', 'SUPRIADIE', 'JL MANYAR REJO NO 23A     -Surabaya', '1978-02-28', 'Banjarmasin', 0, 1.5, 4, '593182', '60191855', '6024', '15019999', 'ASMUNI RIDUAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024119', 20, 2.09, 'TD', '64-64', 'TOMMY', 'JL PEKAYON 1 65           -Mojokert', '1985-04-25', 'Sambas', 1, 2.39, 141, '', '52362633', '6024', '05021011', 'LI KIAN TAT', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024120', 20, 2.42, 'DO', '64-64', 'HENDRO BAMBANG SUHARTANTO', 'MANYAR INDAH 12 AB 18     -SURABAYA', '1985-03-12', 'Manado', 0, 1.8, 37, '5944679', '32770328', '6024', '17010001', 'MOCHAMAD HARYONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024121', 16, 0.83, 'Tu', '64-64', 'NINIEK SANTOSA', 'TENGGILIS MEJOYO AK 6     -Surabaya', '1984-08-29', 'Ujung Pandang', 0, 2.17, 140, '8414959', '27974290', '6024', '25361003', 'RUBEN SANTOSA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024122', 20, 0, 'P', '64-64', 'WILLY HONGARTA', 'KALIJUDAN INDAH N 15      -Surabaya', '1982-10-19', 'Maluku', 0, 2, 4, '', '19-10-82', '6024', '21349999', 'YONGKY HONGARTA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024124', 16, 0, 'Tu', '64-64', 'EDDY KURNIAWAN', 'DARMO INDAH SELATAN KK55  -Surabaya', '1983-03-30', 'Surabaya', 0, 2.21, 94, '7317118', '33469309', '6024', '01049999', 'SOEGIONO KURNIAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024125', 20, 2, '', '64-64', 'INDAH JUWIKA AGUSTINI', 'KALI KEPITING POMPA 30B   -Surabaya', '1984-08-29', 'Surabaya', 0, 2.1, 132, '', '66494244', '6024', '05010019', 'JUKI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024126', 22, 2.65, '', '64-64', 'CANDRA DWI SAPUTRA', 'JL RAYA DUDUK SAMPEYAN 19 -Gresik', '1983-09-19', 'Gresik', 0, 2.49, 160, '3904509', '31369339', '6024', '05550003', 'USMAN ALI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024127', 14, 0.88, 'DO', '64-64', 'FIRDAUS HASIHOLAN', 'KEDUNG MANGU  84A         -Surabaya', '1984-04-16', 'Surabaya', 0, 1.76, 29, '3760280', '23171268', '6024', '05451027', 'KME MARPAUNG', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024128', 22, 2.66, '', '64-64', 'DIANA JODJANA', 'SUTOREJO SELATAN 8 19 Q 9 -Surabaya', '1984-04-13', 'Alor', 0, 2.43, 146, '5933979', '18462618', '6024', '24369999', 'WOEIDY JODJANA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024129', 16, 0, 'Tu', '64-64', 'HARINA DWI MARET G', 'PLOSO KENDAL RT2 RW4      -Ngawi', '1984-03-28', 'Ngawi', 2, 2.04, 89, '', '85285708', '6024', '05500001', 'EDY SUMARSONO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024130', 22, 2.93, '', '64-64', 'YUDI DANI TRENGGONO', 'JL SUTOREJO UTARA 2 C5 10 -Surabaya', '1983-11-06', 'Malang', 0, 2.36, 147, '5934229', '87379790', '6024', '05011143', 'HARIYONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024131', 14, 0, 'P', '64-64', 'FERDINAN HARSONO', 'KLAMPIS SEMOLO BARAT IX 22-Surabaya', '1985-02-17', 'Samarinda', 0, 2.25, 4, '5923873', '17-02-85', '6024', '05011100', 'JOHNNY HARSONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024132', 24, 4, '', '64-64', 'LANNY UIRIANTO', 'DARMAHUSADA MAS AA2       -Surabaya', '1985-05-15', 'TOLI TOLI', 0, 3.06, 144, '', '57226710', '6024', '18330001', 'TJOANDRA UIRIANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024133', 20, 0.38, 'P', '64-64', 'SANDI LIEANTO', 'KLAMPIS SEMOLO BARAT K22  -Surabaya', '1985-03-16', 'Luwuk/Banggai', 0, 2.17, 6, '5964546', '16-03-85', '6024', '18359999', 'EGA LIEANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024134', 14, 1, 'P', '64-64', 'WIRAWAN SWASTOMO RAHARDJO', 'BENDUL MERISI PERMAI B 12 -Surabaya', '1984-07-26', 'Surabaya', 0, 1.91, 11, '8434378', '26-07-84', '6024', '05010007', 'DRS RAHARDJO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024135', 20, 1, 'P', '64-64', 'NITA PARTYASNINGRUM JULIART', 'BOGANGIN 1 52             -Surabaya', '1983-07-27', 'Surabaya', 0, 2, 11, '7671845', '27-07-83', '6024', '05010018', 'SUPARNO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024136', 24, 3.29, 'Tu', '64-64', 'ROBIATUL QOYYIMAH', 'JL RAYA 14 BLIMBING GUDO  -Jombang', '1983-04-26', 'Jombang', 0, 2.29, 148, '864105', '28137682', '6024', '05470003', 'MUH ALI TOHIR', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024137', 22, 2.69, 'TD', '64-64', 'HALIM SISWANTO', 'JL PELABUHAN 245          -Panaruka', '1984-03-13', 'Panarukan', 0, 2.24, 157, '672455', '12959936', '6024', '22219999', 'HARYOTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024138', 22, 2.52, '', '64-64', 'ROSA TRIASHADI WIBOWO', 'PERUM PONDOK JATI II BD 11-Sidoarjo', '1984-05-14', 'Blora', 0, 2.29, 142, '', '98269467', '6024', '05450005', 'ASMUI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024139', 14, 0, 'DO', '64-64', 'ARIS CHRISTIAWAN', 'KARTINI 03                -Bangkala', '1984-01-08', 'Bangkalan', 0, 0, 0, '', '63951149', '6024', '05560001', 'SANADJI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024140', 24, 4, '', '64-64', 'ALDRICH FARREL SAPUTRA', 'MANYAR REJO 5 7           -Surabaya', '1984-05-13', 'RUMBAI', 0, 3.3, 144, '5946568', '80173343', '6024', '05010005', 'M HERRY SAPUTRA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024141', 24, 3.27, '', '64-64', 'ELIS SETYOWATI', 'MENGANTI WIYUNG 3         -Surabaya', '1984-10-28', 'Surabaya', 0, 2.34, 146, '7532520', '46038608', '6024', '05451025', 'RUKMANU', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024143', 16, 0, 'DO', '64-64', 'RONALD LOARDY', 'KUTISARI INDAH SEL I 22   -Surabaya', '1983-05-03', 'Ujung Pandang', 0, 1.5, 4, '8432686', '72810559', '6024', '19011012', 'JIMMY LOARDY', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024144', 20, 1.91, 'Tu', '64-64', 'A.A ISTRI SRI WERDHI', 'P CANDRA JLPALEMUTARA2MD23-Surabaya', '1899-12-30', 'Klungkung', 0, 2.11, 144, '8674095', '46130484', '6024', '22379999', 'AA OKA WISNU', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024145', 24, 4, '', '64-64', 'YUDA SUKMANA', 'KAPTEN TENDEAN 1 09       -Nganjuk', '1983-06-28', 'Nganjuk', 0, 3.01, 156, '324588', '35768306', '6024', '05480002', 'SUYOTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024148', 14, 0, 'DO', '64-64', 'ALFIAN HOSNI', 'JL SEMUT KALI NO 7 GANG 2 -Surabaya', '1984-03-04', 'Berau', 1, 0, 0, '3523461', '41061405', '6024', '16220001', 'SUKAJI HARIADI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024149', 20, 2.44, '', '64-64', 'FIDELIS ALEN DWIRIAN', 'JL SEMERU II B2           -Jember', '1983-05-04', 'Ternate', 0, 2.18, 148, '330583', '58850224', '6024', '05390002', 'ANTONIUS WS', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024150', 14, 1, 'P', '64-64', 'YANUAR ARIFIANTO', 'KEPUH KIRIMAN DALAM 33A   -Surabaya', '1984-01-08', 'Surabaya', 0, 2, 13, '8662473', '08-01-84', '6024', '05010014', 'BUDI WIJAYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024151', 24, 4, '', '64-64', 'DITTA WIDYA NUGROHO', 'JL BANYU URIP KIDUL 3 14D -Surabaya', '1983-11-04', 'Bojonegoro', 0, 2.43, 147, '5612786', '26007225', '6024', '05010006', 'DRS EC SUNARTO SH', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024152', 14, 1.29, 'P', '64-64', 'FAHRIZAL ANDIK METRIKA', 'JL SAMBIROGO BLOK N NO 8  -Surabaya', '1984-08-12', 'Tulung Agung', 0, 1.69, 16, '7412747', '12-08-84', '6024', '16229999', 'DIDIEK WAHYUDI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024153', 16, 1.97, 'DO', '64-64', 'VERAWATY NEGARA', 'JL A A GDE NGURAH MTR     -Mataram', '1985-05-07', 'Mataram', 1, 2.52, 25, '00637187', '75042477', '6024', '23210001', 'SUGENG NEGARA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024158', 20, 0, 'P', '64-64', 'ASHARI RANGKUTI', 'JL PANDUGO BARU 13 U 25   -Surabaya', '1984-04-25', 'Surabaya', 0, 2, 6, '', '25-04-84', '6024', '05010002', 'WASTOMI SUHARI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024159', 24, 4, '', '64-64', 'ASTY REJEKI', 'KEDUNG BARUK              -Surabaya', '1984-06-12', 'Surabaya', 0, 2.91, 149, '8721153', '38000390', '6024', '05010017', 'MOCH ALI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024160', 16, 1.15, 'DO', '64-64', 'LEILA YUNIAR FIRDAUSI', 'BARATA JAYA 13 38         -Surabaya', '1984-06-16', 'Surabaya', 1, 1.53, 19, '5022525', '76911685', '6024', '05010001', 'SAMSUL MUARIF', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024161', 20, 1.63, '', '64-64', 'FREDDY EKADINATA', 'TAWANGSARI PERMAI B15     -Sidoarjo', '1984-02-24', 'Surabaya', 0, 2.13, 126, '7874385', '49924345', '6024', '05010018', 'DARMA SILALAHI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024162', 14, 0, 'DO', '64-64', 'ANITA', 'SEMOLOWARU ELOK AJ 1      -Surabaya', '1984-07-14', 'Palu', 0, 0, 0, '5944174', '42128980', '6024', '18210003', 'MOH SALEH MALEWA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024164', 24, 4, 'TD', '64-64', 'YONATHAN SAUX POHANDA', 'PEGIRIAN 30               -Surabaya', '1985-09-17', 'Surabaya', 0, 2.55, 141, '3718161', '27331139', '6024', '05011101', 'ALEX POHANDA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024165', 16, 0, 'DO', '64-64', 'CHRISTIAN HADI SAPUTRA', '-', '1982-12-26', 'Surabaya', 1, 1.5, 4, '', '71409931', '6024', '05011054', 'FRANS WIJOEWONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024166', 24, 4, '', '64-64', 'LAURENTIA ARYANI', 'KALIJUDAN 145 F           -Surabaya', '1985-03-08', 'Surabaya', 0, 3.06, 148, '3897759', '14457572', '6024', '05010005', 'ONNY SURYONO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024167', 19, 1.16, 'P', '64-64', 'WIDYA PUSPANINGSIH ROMPAS', 'KEDUNG RUKEM 4 NO 10      -Surabaya', '1985-05-11', 'Manokwari', 1, 2.15, 23, '5484195', '11-05-85', '6024', '05011063', 'ELLY ROMPAS', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024168', 22, 0, 'DO', '64-64', 'CHOTIJAH', 'PLATUK DONOMULYO 1 24     -Surabaya', '1983-11-09', 'Surabaya', 0, 2.5, 15, '3723083', '20468237', '6024', '05010004', 'MATLUKI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024169', 14, 0, 'DO', '64-64', 'LUKAS SIGIT ARMANTO', 'PAKIS TIRTOSARI 16 35     -Surabaya', '1984-05-11', 'Ngawi', 0, 0, 0, '5677203', '41031548', '6024', '05010004', 'JOHANES SUSILO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024170', 22, 2.91, '', '64-64', 'HERMAWAN KUSTANTYO', 'KUTISARI INDAH UTARA 2 86 -Surabaya', '1984-03-11', 'Surabaya', 0, 2.58, 144, '8433317', '56099666', '6024', '05010014', 'MEI KOESYUWONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024171', 24, 3.42, 'TD', '64-64', 'ALI MOHAMMAD NOOR', 'KARAH INDAH BLOK A 21     -Surabaya', '1984-02-04', 'Surabaya', 0, 2.59, 163, '8296294', '53514535', '6024', '05010010', 'TEGUH KOMARUDIN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024172', 14, 0.37, 'DO', '64-64', 'ANDREW SATRYA W', 'GEBANG RAYA AG 18         -Sidoarjo', '1981-05-17', 'Surabaya', 1, 1.8, 20, '8945846', '96002911', '6024', '05011095', 'TOTO ARIEFKANDAR', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024173', 16, 1.53, 'DO', '64-64', 'LOVYTA CHRISTINA ANGELIA Y', 'JL BELIMBING 2 67 PCI     -Sidoarjo', '1984-09-09', 'Surabaya', 0, 1.93, 15, '8672788', '76675411', '6024', '05010015', 'H DAVID YOUNG', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024174', 24, 4, '', '64-64', 'SUSILA HARDIANTO KUSUMA', 'SEMAMPIR TENGAH 1A NO32   -Surabaya', '1983-10-11', 'Surabaya', 0, 3.06, 150, '5936410', '36265061', '6024', '05010014', 'SUHARMINTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024175', 22, 2.98, '', '64-64', 'IBRAHIM SATRIA GUSTAMAN', 'BRAWIJAYA 52              -Surabaya', '1984-04-19', 'Surabaya', 0, 2.34, 149, '7521335', '27343567', '6024', '05011139', 'DASAAD GUSTAMAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024176', 24, 4, '', '64-64', 'DEWI ASTUTI', 'DARMO BARU 1 39           -Surabaya', '1985-02-28', 'Pekan Baru', 0, 3.03, 139, '7313344', '93156381', '6024', '05010005', 'SUWARNO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024177', 24, 4, '', '64-64', 'RENI DWI HARTINI', 'RUNGKUT JIDUL 1 19E       -Surabaya', '1983-09-07', 'Surabaya', 0, 3.09, 145, '8713106', '76146819', '6024', '05010017', 'KARNANTQ', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024178', 14, 1.12, 'DO', '64-64', 'RUDY MULYANTO', 'JL NIAGA 1                -Berau', '1985-03-06', 'Berau', 0, 1.64, 21, '21272', '93591987', '6024', '16310001', 'POSO MULYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024180', 14, 0, 'DO', '64-64', 'BENNY SOEYONO', 'KALONGAN KECIL NO 6       -Surabaya', '1984-11-08', 'SURABAYA', 1, 1.88, 12, '3522478', '30209223', '6024', '05011082', 'ADI PRASETYA S', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024181', 14, 0.8, 'P', '64-64', 'ANDRE LAKSANANTA IZAAK', 'RUNGKUT ASR TIM 14 RK5E 25-Surabaya', '1984-11-01', 'Surabaya', 0, 1.74, 35, '8703763', '01-11-84', '6024', '05010020', 'THIMATEOS IZAAK ST', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024182', 24, 4, '', '64-64', 'RANGGA ROSNA', 'JAGIR SIDORESMO 8 3       -Surabaya', '1984-06-27', 'Surabaya', 0, 2.67, 142, '8419621', '11315580', '6024', '05010007', 'SOEGENG HARIYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024183', 14, 0.22, 'DO', '64-64', 'ACHMAD RENDRA P.P', 'TAWNGSARI PERMAI B52 TAMAN-Sidoarjo', '1984-06-18', 'Sidoarjo', 1, 1.83, 21, '7885323', '69949620', '6024', '05010022', 'RIUNTUNG', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024184', 20, 2.3, '', '64-64', 'IDRUS', 'JL ANJASMORO 6 32         -Pasuruan', '1984-08-22', 'Pasuruan', 0, 2.13, 111, '', '76355044', '6024', '05040004', 'ACHMAD', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024185', 20, 2.29, '', '64-64', 'RIZALDY RIZKY NUGRAHA', 'MEDOKAN ASRI TENGAH 4 R17 -Surabaya', '1983-12-22', 'Surabaya', 0, 2.14, 138, '', '81220880', '6024', '05010007', 'SUPRAPTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024186', 14, 0, 'DO', '64-64', 'ERIC ROBIN', 'ADE IRMA 15 A             -Kupang', '1984-06-05', 'Kupang', 1, 0, 0, '832859', '96099412', '6024', '24210001', 'ROBIN YONG', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024187', 14, 0, 'DO', '64-64', 'ADRIAN INDRA R.', 'BENDUL MERISI SELATAN 3 14-Surabaya', '1984-06-04', 'Surabaya', 0, 0, 0, '8432793', '45309719', '6024', '05010002', 'ALBERT', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024188', 14, 0, 'DO', '64-64', 'RICKY NOVAL FEBRIANTINO', 'KENDANGSARI 3 73          -Surabaya', '1984-02-17', 'Surabaya', 0, 2.55, 10, '8498674', '51242145', '6024', '05010009', 'AMINUDIN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024190', 22, 2.5, '', '64-64', 'DAVID WIBISONO', 'KERTAJAYA INDAH 5 36      -Surabaya', '1984-04-08', 'Surabaya', 0, 2.14, 133, '5945536', '26153569', '6024', '05011096', 'SUGIHARTO WIBISONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024191', 14, 0.37, 'DO', '64-64', 'WIDIANTO AJI ISWOYO', 'SEMAMPIR TENGAH 2A 4      -Surabaya', '1985-02-04', 'Surabaya', 0, 1.75, 4, '5999631', '79113728', '6024', '05010002', 'HANANTOTEDJO P IR', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024192', 24, 3.86, '', '64-64', 'AGUS MARSONO', 'TENGGILIS MEJOYO AH 23    -Surabaya', '1983-10-23', 'Ponorogo', 0, 2.35, 143, '8474933', '34256287', '6024', '05011091', 'MARSONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024193', 24, 4, '', '64-64', 'INSAN TANOTO', 'PERMATA HIJAU 1 31        -Purwoker', '1984-09-02', 'Purwokerto', 0, 2.92, 142, '635172', '81458134', '6024', '03211003', 'HENDRA HARTANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024194', 22, 2.06, 'P', '64-64', 'SABIR', 'HHASANBASRI 91BANJARMASIN -Banjarma', '1984-04-25', 'Banjarmasin', 2, 2.93, 117, '300705', '25-04-84', '6024', '15010001', 'NANANG SURIANSYAH', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024195', 24, 3.5, 'TD', '64-64', 'RONALD SIMON TAPPY', 'TENGGILIS MJY SLTN 3 N39  -Surabaya', '1984-10-03', 'Ujung Pandang', 0, 3.12, 144, '8432985', '58859396', '6024', '19011013', 'DJUFRIDA RANTI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024196', 24, 4, 'TD', '64-64', 'YUDHO KUSWARDHONO', 'LETJEN SUTOYO 3 21D       -Banyuwan', '1983-12-22', 'Banyuwangi', 0, 3.22, 140, '422417', '73966232', '6024', '05400001', 'SUNARYO BA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024198', 24, 4, '', '64-64', 'VARALIANI', 'GUNUNG BULUSARAUNG 23     -Ujung Pa', '1984-01-23', 'Ujung Pandang', 0, 2.64, 139, '314140', '56502267', '6024', '19011013', 'TJEN HWA PIN', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024199', 20, 2.29, '', '64-64', 'JOHAN SURYO PRAYOGO', 'JLN BONE 2 HOP6 513       -SURABAYA', '1984-10-28', 'Sidoarjo', 0, 2.23, 132, '', '19108647', '6024', '16229999', 'HERPUGUH D P', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024200', 24, 4, 'N', '64-64', 'JEFRI GUNAWAN', 'JL RKT MEJOYO UTARA KY 4A -Surabaya', '1985-01-21', 'Balikpapan', 0, 3.45, 147, '8420761', '21-01-85', '6024', '16020002', 'GO KIAN LIP', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024201', 24, 3.64, 'N', '64-64', 'STEAFANY', 'TENGGILIS MEJOYO BLOK AI29-Surabaya', '1984-09-10', 'Balikpapan', 0, 3.24, 148, '8413493', '10-09-84', '6024', '16020001', 'REDYYAN', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024203', 24, 3.21, '', '64-64', 'ANDY HIDAYAT JATMIKA', 'JL SEMANGGI 2   MATARAM   -Mataram', '1983-12-09', 'Mataram', 0, 2.77, 151, '635616', '28289054', '6024', '23210003', 'DRS SYAMSUDDIN MSC', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024204', 20, 1.77, '', '64-64', 'HENDRIK STEVEN OEMATAN', 'NGAGEL JAYA SELATAN 2 27  -Surabaya', '1984-03-14', 'Kupang', 0, 2.13, 135, '5020788', '51901706', '6024', '22210005', 'LORENSIUS OEMATAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024205', 24, 4, '', '64-64', 'ENDAH TRI WULANSARI', 'JL JA * *JAYA NO 6 MALANG -Malang', '1984-05-09', 'Luwu', 0, 2.88, 145, '560954', '37739252', '6024', '05030003', 'EDY SUNARYO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024206', 22, 2.66, '', '64-64', 'ADE NATANAEL SIMANJUNTAK', 'RUNGKUT PERMAI 13 A8      -Surabaya', '1984-12-12', 'Balikpapan', 0, 2.44, 133, '8715467', '53407729', '6024', '16339999', 'CAROLINA CW', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024207', 24, 3.88, 'N', '64-64', 'RINI WIDAYANTI SUYITNO', 'TENGGILIS MEJOYO AN 24    -Surabaya', '1984-05-01', 'Pasuruan', 0, 3.49, 145, '8494967', '01-05-84', '6024', '04011016', 'BAMBANG SUJITNO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024208', 14, 0.36, 'TD', '64-64', 'ROSANTI DIANINGRATRI', 'JL IKAN SELIDING E 1      -Banyuwan', '1984-03-09', 'Banyuwangi', 4, 2.13, 66, '00423055', '79016792', '6024', '05400005', 'EANIS H', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024209', 24, 4, 'N', '64-64', 'SIAUW WELLY', 'RUNGKUT MEJOYO UTARA KY4A -Surabaya', '1984-11-17', 'Balikpapan', 0, 3.85, 154, '8420761', '17-11-84', '6024', '16020001', 'HARYADI SAUWITO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024210', 24, 4, '', '64-64', 'NYO ANDRI WIJAYA', 'RUNGKUT MEJOYO UTARA KY4A -Surabaya', '1983-07-07', 'Balikpapan', 0, 3.25, 162, '8420761', '30999503', '6024', '16020001', 'GUSTI HALIM', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024211', 24, 4, '', '64-64', 'RUDY NIP YANTO', 'RUNGKUT MEJOYO UTARA KY4A -Surabaya', '1984-01-11', 'Balikpapan', 0, 2.83, 142, '8420761', '48712923', '6024', '16020001', 'RUDI SUSANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024212', 14, 1.18, 'DO', '64-64', 'VENIA VIDYA CHRISTINA', 'JL TUKAD PAKERISAN BI NO 2-Denpasar', '1984-06-27', 'Pontianak', 0, 3.21, 7, '256823', '84254992', '6024', '22210003', 'KRISTIJONO SH', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024213', 20, 2.26, 'P', '64-64', 'ABDUL MUKTI', 'JL RAYA PABEAN 73A SEDATI -Sidoarjo', '1984-03-22', 'Surabaya', 0, 2.26, 19, '8665908', '22-03-84', '6024', '05450001', 'ABDUL GHONI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024214', 24, 3.7, '', '64-64', 'SILVERIUS JUNARDO', 'JL MELAYU DARAT GG 3 NO 42-Banjarma', '1984-06-13', 'Banjarmasin', 0, 3.15, 151, '252210', '23144105', '6024', '15010007', 'KHELLY Y N', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024215', 16, 0.44, 'TD', '64-64', 'MOCHAMAD ARIEF BUDIMAN', 'WISMA BUNGURASIH 1 65 SDA -Sidoarjo', '1984-01-08', 'Surabaya', 0, 1.99, 99, '8282448', '79544676', '6024', '05011106', 'ABDULLAH SOFI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024216', 14, 0, 'DO', '64-64', 'RONALD', 'TENGGILIS MEJOYO L 16     -Belu', '1984-11-08', 'Belu', 0, 0, 0, '8418738', '77267201', '6024', '24351003', 'AGUSTINUS', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024217', 14, 0, 'DO', '64-64', 'YULIA ACHMETA', 'PRABAN WETAN 5 14A        -Surabaya', '1983-08-16', 'Surabaya', 2, 1, 7, '5472550', '88577520', '6024', '05011095', 'TJIOE GIOK NIO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024218', 14, 0, 'DO', '64-64', 'DODY DAROINI RAHARJO', 'JALAN GLATIK NO 20        -Sidoarjo', '1983-10-04', 'Tapian', 0, 0, 0, '7889149', '62026032', '6024', '05010018', 'SUPRIYO RAHARJO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024219', 24, 0, 'DO', '64-64', 'JOKO GUNAWAN', 'PANDAN SARI 165           -Balikpap', '1985-01-12', 'Balikpapan', 1, 0, 0, '423155', '24636587', '6024', '16020001', 'CAHYONO GUNAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024220', 14, 0.21, 'DO', '64-64', 'EDWIN HARYANTO', 'PANJANG JIWO PERMAI 5 15  -Surabaya', '1983-09-02', 'Fak-fak', 1, 1.72, 32, '8435091', '84629384', '6024', '25311003', 'JACKY CHARLES THO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024222', 24, 4, 'N', '64-64', 'VICKTOR ARISANDI HALIM', 'DARMO INDAH SELATAN 4 PP 5-Surabaya', '1984-10-02', 'Banjarmasin', 0, 3.73, 148, '7314176', '02-10-84', '6024', '15010007', 'NGO TJE NIANG', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024223', 16, 1.27, 'DO', '64-64', 'AINUR ROZIQIN SYAH', 'SAMUDRA 45 BANYUSANGKA    -Bangkala', '1983-04-25', 'Bangkalan', 0, 1.79, 41, '5921460', '10918587', '6024', '05560002', 'MOH SUUD SYAH', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024224', 20, 0.91, '', '64-64', 'ROBIN GOZALI GO', 'TENGGILIS MEJOYO BLOK AB3 -Surabaya', '1983-08-31', 'Balikpapan', 0, 2.48, 127, '8431306', '95222181', '6024', '16020005', 'GODE LESMANA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024225', 14, 1.03, 'DO', '64-64', 'ANGGITA PUSPHA ARDHYAKTA', 'BARENGKRAJAN 06 02 KRIAN  -Sidoarjo', '1984-07-24', 'Sidoarjo', 0, 1.6, 41, '8973949', '52614852', '6024', '05010001', 'ENDRO ISMIARSO SH', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024226', 24, 4, '', '64-64', 'NITA JUWITHAFINA MEICYDILLAH', 'JL SEROJA NO 14  MAKASSAR -Ujung Pa', '1985-05-05', 'Ujung Pandang', 0, 3.18, 153, '', '91009313', '6024', '19010002', 'TAUFIK ARBAH', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024228', 16, 0.97, 'DO', '64-64', 'ERIK HIDAJAYA PUTRA', 'KH AMIN JAKFAR 4 10  PMK  -Pamekasa', '1984-12-09', 'SURABAYA', 0, 1.98, 25, '322097', '57011626', '6024', '05010001', 'ABDUL HAMID', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024229', 24, 4, '', '64-64', 'THEODORUS CHRISTIAN MITSUTAMA', 'TENGGILIS MEJOYO KK 8     -SURABAYA', '1983-12-24', 'Balikpapan', 0, 3.37, 147, '8412424', '52298678', '6024', '16020001', 'TITUS SUWOTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024230', 24, 4, '', '64-64', 'DESSY MAURYANTI', 'DHARMAWANGSA 07 NO 02     -Surabaya', '1984-12-06', 'Balikpapan', 0, 3.31, 147, '5049664', '63704136', '6024', '16020001', 'GATOT SUDJARWO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024232', 22, 2.88, '', '64-64', 'ARYANTO ARIBOWO', 'TAMANSARI INDAH E1        -Bondowos', '1983-11-13', 'Surabaya', 0, 2.51, 147, '427389', '58331571', '6024', '05030004', 'DR HARI SUMINTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024233', 20, 2.25, 'P', '64-64', 'DWI HANDAYANI', '-', '1985-01-02', 'Karo', 0, 2.18, 39, '', '02-01-85', '6024', '19010002', 'DRS AGUS SUDHARTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024234', 14, 0.32, 'DO', '64-64', 'GAMAL REZA RACHMAN', 'JL MANYAR SABRANGAN9  29B -Surabaya', '1983-08-21', 'Semarang', 0, 1.5, 4, '5924829', '72927237', '6024', '05400005', 'WAHYU PUJIATI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024235', 24, 4, '', '64-64', 'BUDISAPUTRA MARJADI', 'DELTA PERMAI 2 59         -Surabaya', '1983-12-05', 'Kediri', 0, 3.72, 153, '', '94770489', '6024', '05050002', 'ARIFIN MARJADI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024236', 24, 4, '', '64-64', 'MITA LIANI', 'KARAH LAPANGAN BARU 7     -Surabaya', '1984-04-19', 'Manado', 0, 2.45, 139, '8297722', '33349149', '6024', '17010001', 'MAX TOMPODUNG', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024237', 22, 2.64, '', '64-64', 'ROBBY HARIADI WASTA', 'TENGGILIS MEJOYO B-33     -Surabaya', '1984-04-25', 'Lamongan', 0, 2.51, 153, '8498560', '63181599', '6024', '05010002', 'BUDI SANTOSO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024239', 24, 0, 'DO', '64-64', 'PETRA JULY EKANDARTI DONSU', 'MOJOARUM 7 30             -Surabaya', '1984-07-31', 'Surabaya', 0, 3.5, 4, '5945377', '99954150', '6024', '05011041', 'PETER R D', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024240', 24, 4, 'N', '64-64', 'ERICA SINGGIH', 'KUTISARI UTARA 5 29       -Surabaya', '1984-09-01', 'Surabaya', 0, 3.84, 154, '8476503', '01-09-84', '6024', '05031029', 'SUGIANTORO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024241', 14, 1.15, 'DO', '64-64', 'WILLIAM TERYANDI', 'TENGGILIS MEJOYO AH/30 SURABAYA', '1985-10-12', 'BONE', 1, 1.92, 13, '8416959', '26899286', '6024', '19011013', 'TENDY YONG', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024701', 22, 2.67, 'Tu', '64-64', 'ANDY WIJAYA', '-', '1980-10-26', 'Semarang', 0, 2.68, 131, '', '93753276', '6024', '0304xxxx', 'TONY SUSANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024702', 24, 4, '', '64-64', 'OKI INDRO PRIAMBODO', 'TAMAN INDAH 6 45          -Surabaya', '1981-11-07', 'Jakarta Selat', 0, 2.38, 150, '8282460', '19719981', '6024', '05010004', 'DIDI ARYONO B', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024703', 14, 0, 'DO', '64-64', 'HARRY KURNIAWAN', '-', '1899-12-30', 'SURABAYA', 1, 0, 0, '', '35302233', '6024', '', '', '', '0');
INSERT INTO `tk_mhs` VALUES ('6024801', 24, 4, 'N', '64-64', 'JOS HARTONO BUDISAPUTRA', 'KAMPUNG DEMES 119B        -Semarang', '1984-06-13', 'Semarang', 0, 3.73, 148, '8314169', '13-06-84', '6024', '03041022', 'BUDIJANTO PURNOMO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024802', 24, 4, '', '64-64', 'MARIA YESY ROSITASARI', 'PUCANG INDAH H 4          -SURABAYA', '1984-05-04', 'Surabaya', 0, 3.09, 139, '8962085', '91611713', '6024', '05011023', 'LEO UNTUNG', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024803', 24, 4, 'N', '64-64', 'HANDRY GUNAWAN', 'TUMAPEL 73                -Surabaya', '1984-01-15', 'Blora', 0, 3.2, 144, '5673425', '15-01-84', '6024', '03460002', 'HENDRO GUNAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024804', 24, 4, 'N', '64-64', 'WILLY SAMBODHO', 'PRAPEN INDAH D 3          -Surabaya', '1984-01-04', 'Malang', 0, 3.58, 148, '8412078', '04-01-84', '6024', '05011118', 'JOHAN IRWANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024805', 24, 4, '', '64-64', 'ADRYANTO MULYONO', 'WONOREJO PERMAI UTARA 6 50-Surabaya', '1984-05-13', 'Surabaya', 0, 2.77, 148, '8705828', '62798025', '6024', '05011118', 'ANDI MULYONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024806', 24, 4, '', '64-64', 'MUHAMAD GAZALI', 'PRAPEN INDAH BLOK S NO 1  -Surabaya', '1984-11-27', 'Surabaya', 0, 2.77, 139, '8473750', '72741955', '6024', '05010003', 'H ASRI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024807', 24, 3.5, 'N', '64-64', 'MIA ALVINA JOE', 'SELOMAS BARAT 3 107       -Semarang', '1984-11-19', 'Semarang', 0, 2.96, 150, '3512356', '19-11-84', '6024', '03041022', 'BUDHI PRASETIJA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024808', 24, 4, '', '64-64', 'MELLISA KRISTANTI', 'PAPANDAYAN INPRES 71      -SURABAYA', '1984-09-23', 'Semarang', 0, 3.01, 144, '', '50140747', '6024', '03041022', 'IKOWINARTO HADI', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024809', 24, 4, '', '64-64', 'HENDRO WIJOYO', 'JL PAKIS 9                -Surabaya', '1984-05-21', 'Surabaya', 0, 3.38, 151, '', '96058048', '6024', '05011057', 'HARRY LEMANTARA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024811', 20, 1.75, '', '64-64', 'REDDY PUTRANTO KURNIAWAN', 'SUTOREJO TENGAH   EE21 49 -Surabaya', '1984-04-07', 'Surabaya', 1, 2.08, 109, '5933489', '80104861', '6024', '05011149', 'HARYONO KURNIAWAN', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024812', 14, 0.29, 'P', '64-64', 'ERIC SETIAWAN HANDOKO', 'DUKUH KUPANG BARAT XXV 15 -Surabaya', '1984-09-14', 'Surabaya', 0, 1.26, 19, '5669968', '14-09-84', '6024', '05011062', 'YUSUF HANDOKO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024813', 24, 4, '', '64-64', 'YENNI OLIVIA', 'DARMO INDAH TIMUR X S 23  -Surabaya', '1984-01-07', 'Surabaya', 0, 2.78, 139, '7325293', '31159886', '6024', '05011095', 'EDDY KALLO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024814', 24, 4, '', '64-64', 'SYANDAYANI SETIAWAN', 'LEBAK ARUM 5 108          -Surabaya', '1984-05-11', 'Surabaya', 0, 3.18, 139, '3813935', '90637561', '6024', '05011095', 'HARTONO SETIAWAN', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024815', 24, 4, '', '64-64', 'MEI LIANA', 'TENGGILIS MEJOYO AF 44    -Surabaya', '1984-05-15', 'Banyuwangi', 0, 2.89, 144, '8495836', '91794400', '6024', '05011118', 'SUGIANTO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024816', 24, 4, '', '64-64', 'EDWIN WIDJAJA', 'DUKUH KUPANG BARAT 16 7   -Surabaya', '1983-12-29', 'Surabaya', 0, 3.29, 149, '5673475', '95858891', '6024', '05011096', 'SATRIA WIDJAJA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024817', 24, 4, 'N', '64-64', 'HENDRA DINATA', 'KUTISARI INDAH BARAT 9 25 -Surabaya', '1983-10-17', 'SINGARAJA', 0, 3.38, 145, '8433510', '17-10-83', '6024', '05011102', 'PUTU SANTIKA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024819', 24, 4, 'N', '64-64', 'ELIZABETH LISTIYANI SOELISTIYO', 'PLEMAHAN XII 12I          -Surabaya', '1984-04-02', 'Surabaya', 0, 3.93, 151, '5454553', '02-04-84', '6024', '05011091', 'SOEGIANTO SOELISTIJO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024820', 24, 3.5, 'N', '64-64', 'ANTHONY HIDAYAT', '-', '1984-10-24', 'Surabaya', 0, 3.34, 147, '', '24-10-84', '6024', '05011115', 'BENNY HIDAYAT', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024821', 24, 3, '', '64-64', 'ROYMOND', 'JL ERLANGGA 8 20          -Sidoarjo', '1983-11-27', 'Nias', 1, 2.62, 142, '896507 2', '10181314', '6024', '05450999', 'CUNNAWATI', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024822', 24, 4, '', '64-64', 'WENNY LEDYAWATI', 'JL BALI 24 MAGETAN        -SURABAYA', '1985-01-19', 'Surabaya', 0, 2.82, 144, '895570', '51735005', '6024', '05500001', 'WINGIN NURSALIM', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024823', 20, 0.16, 'TD', '64-64', 'DEASY SUSANTI GUNAWAN', 'VETERAN 382               -Sumenep', '1984-12-11', 'Sumenep', 0, 2.57, 90, '668290', '86590663', '6024', '05590001', 'GUNAWAN', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024825', 20, 2, '', '64-64', 'FERNANDY HALIM', 'BUDAYA CIPTA 4 2A         -Kediri', '1984-02-23', 'Semarang', 0, 2.03, 150, '690093', '86938494', '6024', '05xx1012', 'HARIMAN HALIM', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024826', 24, 4, '', '64-64', 'KRISTIAN ADE ANGKIE WIJAYA', 'RAYA KEDIRI 48            -Jombang', '1985-01-03', 'Tegal', 0, 2.99, 144, '862972', '41235077', '6024', '05471009', 'ANGKIE WIJAYA', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024827', 24, 4, 'N', '64-64', 'FLORIAN LUIGI DWITJAHJO', 'JL MANGGA5 H134 PCI SBY   -Surabaya', '1984-07-19', 'SIDOARJO', 0, 3.66, 150, '8664337', '19-07-84', '6024', '05011118', 'PETRUS KARNO D', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024828', 24, 4, 'Tu', '64-64', 'PRAMUDITA IKA DEVIANTHI', 'JAMBANGAN X 10            -Surabaya', '1984-12-04', 'Surabaya', 0, 2.86, 144, '8283542', '39824365', '6024', '05019999', 'ABDUL MUNTAHAL', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024829', 24, 3.5, '', '64-64', 'ROCKY KURNIAWAN HARTONO', 'BENDUL MERISI 63         -Surabaya', '1984-08-26', 'Surabaya', 0, 3, 144, '8410575', '82746838', '6024', '05011118', 'SUJADI HARTONO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024831', 14, 0, 'DO', '64-64', 'CHANDRA IRAWATI', 'WR SUPRATMAN 69 JUWANA    -Pati', '1983-09-21', 'Pati', 1, 1.71, 21, '', '20259183', '6024', '03471003', 'CHANDRA MUSTAFA', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024832', 24, 4, '', '64-64', 'LEONARDO KURNIAWAN', 'JLN DR SUTOMO 95          -Nganjuk', '1985-08-21', 'Kediri', 1, 2.88, 144, '325614', '38263815', '6024', '05480002', 'SUNARTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024833', 16, 0.75, 'TD', '64-64', 'JOLANDA RUSLIEM', 'KLAMPIS SEMOLO TMRV11AB159-Surabaya', '1984-07-20', 'Maluku Tengah', 1, 2.12, 93, '5949908', '70498015', '6024', '05011149', 'EDDY LAUREN RUSLIEM', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024834', 24, 4, '', '64-64', 'ARIE YANTI DWI SANTOSO', 'JL BELITUNG 16            -Surakart', '1984-06-18', 'Surakarta', 0, 2.89, 145, '656215', '91748038', '6024', '03021018', 'DJIEN NIO', '2', '0');
INSERT INTO `tk_mhs` VALUES ('6024835', 24, 4, 'N', '64-64', 'FX. HENDRI ARDIAN MULYANTO', 'KEDAWUNG KULON 6          -Pasuruan', '1984-06-15', 'PASURUAN', 0, 3.23, 147, '482165', '15-06-84', '6024', '05031025', 'AGUS MULYANTO', '1', '0');
INSERT INTO `tk_mhs` VALUES ('6024836', 24, 4, '', '64-64', 'MILA', 'JA SUPRAPTO 69            -Bojonego', '1984-02-26', 'Kediri', 0, 2.56, 139, '881722', '18041516', '6024', '05521008', 'BUDIANTO', '2', '0');
<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at C:\AppServ\www\phpMyAdmin\export.php:150) in <b>C:\AppServ\www\phpMyAdmin\libraries\ob.lib.php</b> on line <b>61</b><br />
<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at C:\AppServ\www\phpMyAdmin\export.php:150) in <b>C:\AppServ\www\phpMyAdmin\libraries\header_http.inc.php</b> on line <b>13</b><br />
<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at C:\AppServ\www\phpMyAdmin\export.php:150) in <b>C:\AppServ\www\phpMyAdmin\libraries\header_http.inc.php</b> on line <b>14</b><br />
<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at C:\AppServ\www\phpMyAdmin\export.php:150) in <b>C:\AppServ\www\phpMyAdmin\libraries\header_http.inc.php</b> on line <b>15</b><br />
<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at C:\AppServ\www\phpMyAdmin\export.php:150) in <b>C:\AppServ\www\phpMyAdmin\libraries\header_http.inc.php</b> on line <b>16</b><br />
<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at C:\AppServ\www\phpMyAdmin\export.php:150) in <b>C:\AppServ\www\phpMyAdmin\libraries\header_http.inc.php</b> on line <b>19</b><br />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <title>phpMyAdmin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="./css/phpmyadmin.css.php?token=4d3fd2774a0241c1058d4301bf830f2e&amp;js_frame=right" />
    <link rel="stylesheet" type="text/css" href="./css/print.css?token=4d3fd2774a0241c1058d4301bf830f2e" media="print" />
    <script type="text/javascript" language="javascript">
    // <![CDATA[
    // Updates the title of the frameset if possible (ns4 does not allow this)
    if (typeof(parent.document) != 'undefined' && typeof(parent.document) != 'unknown'
        && typeof(parent.document.title) == 'string') {
        parent.document.title = 'localhost / localhost / teknik / tk_mk_jur | phpMyAdmin 2.9.0.2';
    }
    
    // ]]>
    </script>
        
    <script src="./js/tooltip.js" type="text/javascript"
        language="javascript"></script>
    <meta name="OBGZip" content="true" />
        <!--[if IE 6]>
    <style type="text/css">
    /* <![CDATA[ */
    html {
        overflow-y: scroll;
    }
    /* ]]> */
    </style>
    <![endif]-->
</head>

<body>
<div id="TooltipContainer" onmouseover="holdTooltip();" onmouseout="swapTooltip('default');"></div>
    <div id="serverinfo">
<a href="main.php?token=4d3fd2774a0241c1058d4301bf830f2e" class="item">        <img class="icon" src="./themes/original/img/s_host.png" width="16" height="16" alt="" /> 
Server: localhost</a>
        <span class="separator"><img class="icon" src="./themes/original/img/item_ltr.png" width="5" height="9" alt="-" /></span>
<a href="db_details_structure.php?db=teknik&amp;token=4d3fd2774a0241c1058d4301bf830f2e" class="item">        <img class="icon" src="./themes/original/img/s_db.png" width="16" height="16" alt="" /> 
Database: teknik</a>

<!-- PMA-SQL-ERROR -->
    <div class="error"><h1>Error</h1>
    <p><strong>SQL query:</strong>
<a href="tbl_properties.php?db=teknik&amp;table=tk_mk_jur&amp;token=4d3fd2774a0241c1058d4301bf830f2e&amp;sql_query=SHOW+TABLE+STATUS+LIKE+%27tk_mk_jur%27%3B&amp;show_query=1"><img class="icon" src=" ./themes/original/img/b_edit.png" width="16" height="16" alt="Edit" /></a>    </p>
    <p>
        <span class="syntax"><span class="syntax_alpha syntax_alpha_reservedWord">SHOW</span>  <span class="syntax_alpha syntax_alpha_reservedWord">TABLE</span>  <span class="syntax_alpha syntax_alpha_reservedWord">STATUS</span>  <span class="syntax_alpha syntax_alpha_reservedWord">LIKE</span>  <span class="syntax_quote syntax_quote_single">'tk_mk_jur'</span><span class="syntax_punct syntax_punct_queryend">;</span><br /><br /></span>
    </p>
<p>
    <strong>MySQL said: </strong><a href="http://dev.mysql.com/doc/refman/5.0/en/error-messages-server.html" target="mysql_doc"><img class="icon" src="./themes/original/img/b_help.png" width="11" height="11" alt="Documentation" title="Documentation" /></a>
</p>
<code>
#2006 - MySQL server has gone away
</code><br />
</div><fieldset class="tblFooters">    </fieldset>

<script type="text/javascript" language="javascript">
//<![CDATA[
// updates current settings
if (window.parent.setAll) {
    window.parent.setAll('en-utf-8', 'utf8_unicode_ci', '1', 'teknik', 'tk_mk_jur');
}


// set current db, table and sql query in the querywindow
if (window.parent.refreshNavigation) {
    window.parent.reload_querywindow(
        'teknik',
        'tk_mk_jur',
        '');
}


if (window.parent.frame_content) {
    // reset content frame name, as querywindow needs to set a unique name
    // before submitting form data, and navigation frame needs the original name
    if (window.parent.frame_content.name != 'frame_content') {
        window.parent.frame_content.name = 'frame_content';
    }
    if (window.parent.frame_content.id != 'frame_content') {
        window.parent.frame_content.id = 'frame_content';
    }
    //window.parent.frame_content.setAttribute('name', 'frame_content');
    //window.parent.frame_content.setAttribute('id', 'frame_content');
}
//]]>
</script>
</body>
</html>
