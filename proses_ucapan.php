<?php
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mb_substr(trim($_POST['nama'] ?? ''), 0, 100);
    $kehadiran = trim($_POST['kehadiran'] ?? '');
    $pesan = mb_substr(trim($_POST['pesan'] ?? ''), 0, 500);
    $pilihan_kehadiran_valid = ['HADIR', 'TIDAK HADIR'];

    if ($nama !== '' && $pesan !== '' && in_array($kehadiran, $pilihan_kehadiran_valid, true)) {
        $query_simpan = $pdo->prepare(
            "INSERT INTO ucapan (nama, pesan, kehadiran) VALUES (:nama, :pesan, :kehadiran)"
        );
        $query_simpan->execute([
            'nama' => $nama,
            'pesan' => $pesan,
            'kehadiran' => $kehadiran,
        ]);
    }

    header("Location: index.php?terkirim=1#ucapan");
    exit();
}
