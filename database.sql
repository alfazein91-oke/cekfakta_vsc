
CREATE DATABASE cekfakta;

USE cekfakta;

-- Tabel administrator
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Tabel artikel
CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    excerpt TEXT,
    content LONGTEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contoh artikel
INSERT INTO articles
(title, category, excerpt, content)
VALUES
(
    'Mengenal Bahaya Berita Hoaks',
    'Edukasi Digital',
    'Pentingnya mengenali berita palsu di internet.',
    'Berita hoaks merupakan informasi palsu atau menyesatkan yang disebarkan seolah-olah benar. Kita harus memeriksa sumber berita sebelum membagikannya.'
),
(
    'Cara Memeriksa Kebenaran Berita',
    'Tips',
    'Beberapa langkah sederhana untuk memeriksa informasi.',
    'Periksa sumber berita, tanggal publikasi, bukti pendukung, dan bandingkan informasi dengan media terpercaya.'
),
(
    'Pentingnya Literasi Digital',
    'Literasi Media',
    'Masyarakat perlu memahami penggunaan informasi digital.',
    'Literasi digital membantu masyarakat menggunakan teknologi secara bijak dan menghindari penyebaran informasi palsu.'
);
-- Konfigurasi database website cekfakta
