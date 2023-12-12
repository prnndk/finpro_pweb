-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 12, 2023 at 06:29 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Database: `finpro_pweb`
--
-- --------------------------------------------------------
--
-- Table structure for table `absen_kelas`
--
CREATE TABLE `absen_kelas` (
  `id` int NOT NULL,
  `kode_absen` char(6) NOT NULL,
  `kelas_id` int NOT NULL,
  `pengajar_id` int NOT NULL,
  `expired_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absen_kelas`
--
INSERT INTO
  `absen_kelas` (
    `id`,
    `kode_absen`,
    `kelas_id`,
    `pengajar_id`,
    `expired_at`,
    `created_at`
  )
VALUES
  (
    1,
    '303468',
    2,
    1,
    '2023-12-12 21:50:00',
    '2023-12-12 13:43:07'
  ),
  (
    2,
    '090021',
    1,
    1,
    '2023-12-13 01:17:00',
    '2023-12-12 15:17:49'
  ),
  (
    3,
    'E073E7',
    1,
    1,
    '2023-12-13 03:21:00',
    '2023-12-12 18:19:34'
  ),
  (
    4,
    '8288B7',
    2,
    1,
    '2023-12-13 02:20:00',
    '2023-12-12 18:20:46'
  ),
  (
    5,
    '4CF803',
    2,
    1,
    '2023-12-13 05:27:00',
    '2023-12-12 18:23:24'
  ),
  (
    6,
    '4D57A4',
    2,
    1,
    '2023-12-13 04:23:00',
    '2023-12-12 18:23:36'
  ),
  (
    7,
    '988171',
    2,
    1,
    '2023-12-13 01:26:00',
    '2023-12-12 18:24:57'
  ),
  (
    8,
    '63AE39',
    2,
    1,
    '2023-12-13 01:29:00',
    '2023-12-12 18:26:40'
  );

-- --------------------------------------------------------
--
-- Table structure for table `absen_siswa`
--
CREATE TABLE `absen_siswa` (
  `id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `absen_id` int NOT NULL,
  `kehadiran` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absen_siswa`
--
INSERT INTO
  `absen_siswa` (
    `id`,
    `siswa_id`,
    `absen_id`,
    `kehadiran`,
    `created_at`
  )
VALUES
  (5, 1, 2, 'HADIR', '2023-12-12 16:24:24'),
  (7, 1, 3, 'ALPHA', '2023-12-12 18:19:34'),
  (12, 1, 8, 'HADIR', '2023-12-12 18:26:40');

-- --------------------------------------------------------
--
-- Table structure for table `cabang`
--
CREATE TABLE `cabang` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kontak` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cabang`
--
INSERT INTO
  `cabang` (
    `id`,
    `nama`,
    `kota`,
    `alamat`,
    `kontak`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Cabang Surabaya',
    'Surabaya',
    'Jalan Ir Soekarno Hatta',
    NULL,
    '2023-12-12 03:38:19',
    NULL
  ),
  (
    2,
    'Cabang Surabaya Barat',
    'Surabaya',
    'Jalan Pakuwon',
    NULL,
    '2023-12-12 03:38:19',
    NULL
  );

-- --------------------------------------------------------
--
-- Table structure for table `daftar_siswa`
--
CREATE TABLE `daftar_siswa` (
  `id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `kelas_id` int NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `daftar_siswa`
--
INSERT INTO
  `daftar_siswa` (`id`, `siswa_id`, `kelas_id`)
VALUES
  (1, 1, 1),
  (2, 1, 2);

-- --------------------------------------------------------
--
-- Table structure for table `informasi`
--
CREATE TABLE `informasi` (
  `id` int NOT NULL,
  `judul` varchar(150) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `kategori_id` int NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------
--
-- Table structure for table `jadwal_kelas`
--
CREATE TABLE `jadwal_kelas` (
  `id` int NOT NULL,
  `kelas_id` int NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jadwal_kelas`
--
INSERT INTO
  `jadwal_kelas` (
    `id`,
    `kelas_id`,
    `hari`,
    `jam`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    1,
    'Thursday',
    '15:30:00',
    '2023-12-12 07:54:57',
    NULL
  ),
  (
    2,
    2,
    'Thursday',
    '18:00:30',
    '2023-12-12 08:01:41',
    NULL
  ),
  (
    3,
    1,
    'Wednesday',
    '19:00:30',
    '2023-12-12 09:48:03',
    NULL
  );

-- --------------------------------------------------------
--
-- Table structure for table `kategori_informasi`
--
CREATE TABLE `kategori_informasi` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------
--
-- Table structure for table `kelas`
--
CREATE TABLE `kelas` (
  `id` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `kode_kelas` char(5) NOT NULL,
  `pengajar_id` int NOT NULL,
  `cabang_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--
INSERT INTO
  `kelas` (
    `id`,
    `nama`,
    `kode_kelas`,
    `pengajar_id`,
    `cabang_id`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Kelas Matematika Wajib',
    'MW001',
    1,
    2,
    '2023-12-12 07:53:36',
    NULL
  ),
  (
    2,
    'Kelas Kimia',
    'KI001',
    1,
    2,
    '2023-12-12 08:00:59',
    NULL
  );

-- --------------------------------------------------------
--
-- Table structure for table `kontak_helpdesk`
--
CREATE TABLE `kontak_helpdesk` (
  `id` int NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `oleh_user_id` int NOT NULL,
  `jawab_user_id` int DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL,
  `is_answered` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------
--
-- Table structure for table `materi_kelas`
--
CREATE TABLE `materi_kelas` (
  `id` int NOT NULL,
  `nama_materi` varchar(150) NOT NULL,
  `link` varchar(250) NOT NULL,
  `is_latihan` tinyint(1) NOT NULL DEFAULT '0',
  `kelas_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------
--
-- Table structure for table `nilai_siswa`
--
CREATE TABLE `nilai_siswa` (
  `id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `pengajar_id` int NOT NULL,
  `kelas_id` int NOT NULL,
  `nilai` float NOT NULL,
  `catatan` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------
--
-- Table structure for table `pembayaran`
--
CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `cabang_id` int NOT NULL,
  `total` double NOT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `verified_by` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--
INSERT INTO
  `pembayaran` (
    `id`,
    `siswa_id`,
    `cabang_id`,
    `total`,
    `deskripsi`,
    `bukti_pembayaran`,
    `is_verified`,
    `verified_by`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    1,
    1,
    79000,
    'Pembayaran kedua',
    '/bukti/pembayaran',
    1,
    2,
    '2023-12-12 07:39:42',
    NULL
  );

-- --------------------------------------------------------
--
-- Table structure for table `pengajar`
--
CREATE TABLE `pengajar` (
  `id` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `mapel` varchar(20) NOT NULL,
  `kode` char(5) NOT NULL,
  `cabang_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengajar`
--
INSERT INTO
  `pengajar` (
    `id`,
    `nama`,
    `mapel`,
    `kode`,
    `cabang_id`,
    `user_id`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Guru Pertama',
    'Matematika',
    'GPM01',
    2,
    2,
    '2023-12-12 07:53:09',
    NULL
  );

-- --------------------------------------------------------
--
-- Table structure for table `siswas`
--
CREATE TABLE `siswas` (
  `id` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `riwayat_belajar` text NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswas`
--
INSERT INTO
  `siswas` (
    `id`,
    `nama`,
    `tanggal_lahir`,
    `alamat`,
    `no_hp`,
    `riwayat_belajar`,
    `user_id`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Arya Gading Prinandika',
    '2004-06-04',
    'Jalan Imam Bonjol Nomor selangkung',
    '089512349290',
    'belajar di sman 1 blitar\r\nits surabaya',
    1,
    '2023-12-12 07:38:20',
    NULL
  );

-- --------------------------------------------------------
--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--
INSERT INTO
  `users` (
    `id`,
    `name`,
    `username`,
    `email`,
    `password`,
    `roles`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'arya gading prinandika',
    'prinandika',
    'prinandika@mail.com',
    'password',
    'admin',
    '2023-12-12 07:27:30',
    NULL
  ),
  (
    2,
    'guru',
    'guru',
    'guru@mail.com',
    'guruku',
    'admin',
    '2023-12-12 07:38:57',
    NULL
  );

--
-- Indexes for dumped tables
--
--
-- Indexes for table `absen_kelas`
--
ALTER TABLE
  `absen_kelas`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `kelas_id` (`kelas_id`),
ADD
  KEY `pengajar_id` (`pengajar_id`);

--
-- Indexes for table `absen_siswa`
--
ALTER TABLE
  `absen_siswa`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `absen_id` (`absen_id`),
ADD
  KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `cabang`
--
ALTER TABLE
  `cabang`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_siswa`
--
ALTER TABLE
  `daftar_siswa`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `kelas_id` (`kelas_id`),
ADD
  KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `informasi`
--
ALTER TABLE
  `informasi`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `kategori_id` (`kategori_id`),
ADD
  KEY `user_id` (`user_id`);

--
-- Indexes for table `jadwal_kelas`
--
ALTER TABLE
  `jadwal_kelas`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `kategori_informasi`
--
ALTER TABLE
  `kategori_informasi`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE
  `kelas`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `kelas_cabang_id` (`cabang_id`),
ADD
  KEY `kelas_pengajar_id` (`pengajar_id`);

--
-- Indexes for table `kontak_helpdesk`
--
ALTER TABLE
  `kontak_helpdesk`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `oleh_user_id` (`oleh_user_id`),
ADD
  KEY `jawab_user_id` (`jawab_user_id`);

--
-- Indexes for table `materi_kelas`
--
ALTER TABLE
  `materi_kelas`
ADD
  PRIMARY KEY (`id`) USING BTREE,
ADD
  KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `nilai_siswa`
--
ALTER TABLE
  `nilai_siswa`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `kelas_id` (`kelas_id`),
ADD
  KEY `pengajar_id` (`pengajar_id`),
ADD
  KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE
  `pembayaran`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `pembayaran_siswa_id` (`siswa_id`),
ADD
  KEY `pembayaran_cabang_id` (`cabang_id`),
ADD
  KEY `pembayaran_verified_by` (`verified_by`);

--
-- Indexes for table `pengajar`
--
ALTER TABLE
  `pengajar`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `pengajar_cabang_id` (`cabang_id`),
ADD
  KEY `pengajar_user_id` (`user_id`);

--
-- Indexes for table `siswas`
--
ALTER TABLE
  `siswas`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `siswa_user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE
  `users`
ADD
  PRIMARY KEY (`id`),
ADD
  UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `absen_kelas`
--
ALTER TABLE
  `absen_kelas`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 9;

--
-- AUTO_INCREMENT for table `absen_siswa`
--
ALTER TABLE
  `absen_siswa`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 13;

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE
  `cabang`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;

--
-- AUTO_INCREMENT for table `daftar_siswa`
--
ALTER TABLE
  `daftar_siswa`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE
  `informasi`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_kelas`
--
ALTER TABLE
  `jadwal_kelas`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT for table `kategori_informasi`
--
ALTER TABLE
  `kategori_informasi`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE
  `kelas`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;

--
-- AUTO_INCREMENT for table `kontak_helpdesk`
--
ALTER TABLE
  `kontak_helpdesk`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materi_kelas`
--
ALTER TABLE
  `materi_kelas`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nilai_siswa`
--
ALTER TABLE
  `nilai_siswa`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE
  `pembayaran`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT for table `pengajar`
--
ALTER TABLE
  `pengajar`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT for table `siswas`
--
ALTER TABLE
  `siswas`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE
  `users`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;

--
-- Constraints for dumped tables
--
--
-- Constraints for table `absen_kelas`
--
ALTER TABLE
  `absen_kelas`
ADD
  CONSTRAINT `absen_kelas_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `absen_kelas_ibfk_2` FOREIGN KEY (`pengajar_id`) REFERENCES `pengajar` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `absen_siswa`
--
ALTER TABLE
  `absen_siswa`
ADD
  CONSTRAINT `absen_siswa_ibfk_1` FOREIGN KEY (`absen_id`) REFERENCES `absen_kelas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `absen_siswa_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `daftar_siswa`
--
ALTER TABLE
  `daftar_siswa`
ADD
  CONSTRAINT `daftar_siswa_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `daftar_siswa_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `informasi`
--
ALTER TABLE
  `informasi`
ADD
  CONSTRAINT `informasi_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_informasi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `informasi_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `jadwal_kelas`
--
ALTER TABLE
  `jadwal_kelas`
ADD
  CONSTRAINT `jadwal_kelas_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `kelas`
--
ALTER TABLE
  `kelas`
ADD
  CONSTRAINT `kelas_cabang_id` FOREIGN KEY (`cabang_id`) REFERENCES `cabang` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `kelas_pengajar_id` FOREIGN KEY (`pengajar_id`) REFERENCES `pengajar` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `kontak_helpdesk`
--
ALTER TABLE
  `kontak_helpdesk`
ADD
  CONSTRAINT `kontak_helpdesk_ibfk_1` FOREIGN KEY (`oleh_user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `kontak_helpdesk_ibfk_2` FOREIGN KEY (`jawab_user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `materi_kelas`
--
ALTER TABLE
  `materi_kelas`
ADD
  CONSTRAINT `materi_kelas_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `nilai_siswa`
--
ALTER TABLE
  `nilai_siswa`
ADD
  CONSTRAINT `nilai_siswa_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `nilai_siswa_ibfk_2` FOREIGN KEY (`pengajar_id`) REFERENCES `pengajar` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `nilai_siswa_ibfk_3` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE
  `pembayaran`
ADD
  CONSTRAINT `pembayaran_cabang_id` FOREIGN KEY (`cabang_id`) REFERENCES `cabang` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `pembayaran_siswa_id` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `pembayaran_verified_by` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `pengajar`
--
ALTER TABLE
  `pengajar`
ADD
  CONSTRAINT `pengajar_cabang_id` FOREIGN KEY (`cabang_id`) REFERENCES `cabang` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `pengajar_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `siswas`
--
ALTER TABLE
  `siswas`
ADD
  CONSTRAINT `siswa_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;