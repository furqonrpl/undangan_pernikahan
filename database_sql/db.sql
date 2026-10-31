CREATE TABLE IF NOT EXISTS tamu (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_tamu VARCHAR(100) NOT NULL,
  kode_unik VARCHAR(50) UNIQUE NOT NULL,
  status_hadir ENUM('HADIR', 'TIDAK HADIR', 'BELUM KONFIRMASI') DEFAULT 'BELUM KONFIRMASI'
);

CREATE TABLE IF NOT EXISTS ucapan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  pesan TEXT NOT NULL,
  kehadiran ENUM('HADIR', 'TIDAK HADIR') NOT NULL,
  tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO ucapan (nama, pesan, kehadiran) VALUES
('Sahabat Lama', 'Selamat menempuh hidup baru. Semoga sakinah, mawaddah, warahmah.', 'HADIR'),
('Teman ', 'Maaf belum bisa hadir, doa terbaik untuk kalian berdua.', 'TIDAK HADIR');
