<?php
include 'config/database.php';

$query_ucapan = $pdo->query("SELECT * FROM ucapan ORDER BY tanggal DESC");
$daftar_ucapan = $query_ucapan->fetchAll(PDO::FETCH_ASSOC);

$nama_tamu_url = isset($_GET['to']) ? htmlspecialchars($_GET['to']) : 'Tamu Undangan';
$sudah_terkirim = isset($_GET['terkirim']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pernikahan Romeo & Juliet</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;1,500&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="<?= $sudah_terkirim ? '' : 'terkunci'; ?>">

<?php if (!$sudah_terkirim) { ?>
<div class="sampul" id="sampul">
    <div class="pintu kiri"></div>
    <div class="pintu kanan"></div>
    <div class="isi-sampul">
        <div class="cincin"><span class="inisial">R & J</span></div>
        <p class="kecil">Kepada Yth. Bapak/Ibu/Saudara/i</p>
        <h2 class="nama-tamu"><?= $nama_tamu_url; ?></h2>
        <button class="tombol" id="tombol-buka" type="button">Buka Undangan</button>
    </div>
</div>
<?php } ?>

<header class="hero">
    <p class="kecil">Kami mengundang Anda di hari pernikahan kami</p>
    <h1>Romeo & Juliet</h1>
    <p class="tanggal">Sabtu, 12 Desember 2026</p>
    <a class="tombol" href="#acara">Lihat acara</a>
</header>

<section class="bagian" id="timer">
    <h2>Menuju hari bahagia</h2>
    <div class="grid-timer">
        <div class="kaca kotak-timer"><span id="days">00</span><small>Hari</small></div>
        <div class="kaca kotak-timer"><span id="hours">00</span><small>Jam</small></div>
        <div class="kaca kotak-timer"><span id="minutes">00</span><small>Menit</small></div>
        <div class="kaca kotak-timer"><span id="seconds">00</span><small>Detik</small></div>
    </div>
    <p class="kecil" id="pesan-timer"></p>
</section>

<section class="bagian" id="acara">
    <h2>Rangkaian acara</h2>
    <div class="grid-acara">
        <article class="kaca kartu">
            <h3>Akad nikah</h3>
            <p class="jam">08.00 WIB</p>
            <p>[Nama gedung / alamat]</p>
        </article>
        <article class="kaca kartu">
            <h3>Resepsi</h3>
            <p class="jam">11.00 WIB sampai selesai</p>
            <p>[Nama gedung / alamat]</p>
        </article>
    </div>
</section>

<section class="bagian" id="ucapan">
    <h2>Ucapan dan doa</h2>
    <?php if ($sudah_terkirim) { ?>
        <p class="sukses">Ucapanmu sudah terkirim. Terima kasih.</p>
    <?php } ?>

    <form class="kaca form" action="proses_ucapan.php" method="post">
        <label for="nama">Nama</label>
        <input id="nama" name="nama" type="text" maxlength="100" required>

        <label for="kehadiran">Apakah Anda akan hadir?</label>
        <select id="kehadiran" name="kehadiran" required>
            <option value="HADIR">Ya, saya hadir</option>
            <option value="TIDAK HADIR">Maaf, belum bisa hadir</option>
        </select>

        <label for="pesan">Ucapan</label>
        <textarea id="pesan" name="pesan" rows="4" maxlength="500" required></textarea>

        <button class="tombol" type="submit">Kirim ucapan</button>
    </form>

    <div class="daftar-ucapan">
        <?php if (count($daftar_ucapan) === 0) { ?>
            <p class="kecil">Belum ada ucapan. Jadilah yang pertama.</p>
        <?php } ?>
        <?php foreach ($daftar_ucapan as $ucapan) { ?>
            <article class="kaca ucapan">
                <div class="baris-ucapan">
                    <strong><?= htmlspecialchars($ucapan['nama']); ?></strong>
                    <span class="lencana <?= $ucapan['kehadiran'] === 'HADIR' ? 'hadir' : 'tidak-hadir'; ?>">
                        <?= $ucapan['kehadiran'] === 'HADIR' ? 'Hadir' : 'Tidak hadir'; ?>
                    </span>
                </div>
                <p><?= nl2br(htmlspecialchars($ucapan['pesan'])); ?></p>
                <small><?= date('d M Y, H:i', strtotime($ucapan['tanggal'])); ?></small>
            </article>
        <?php } ?>
    </div>
</section>

<footer class="kaki">
    <p>Terima kasih atas doa dan kehadiran Anda.</p>
    <p class="nama-kaki">Romeo & Juliet</p>
</footer>

<script src="assets/js/script.js"></script>
</body>
</html>
