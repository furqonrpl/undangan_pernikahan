// Ubah tanggal di sini: (tahun, bulan [0-11], tanggal, jam, menit, detik)
const waktuPernikahan = new Date(2026, 11, 12, 8, 0, 0).getTime();

// Buka undangan: pintu kaca bergeser, halaman bisa di-scroll
const sampul = document.getElementById('sampul');
const tombolBuka = document.getElementById('tombol-buka');

if (tombolBuka) {
    tombolBuka.addEventListener('click', function () {
        sampul.classList.add('terbuka');
        document.body.classList.remove('terkunci');
        window.scrollTo(0, 0);
    });
}

// Hitung mundur
function dua_digit(angka) {
    return String(angka).padStart(2, '0');
}

const penghitung = setInterval(function () {
    const sekarang = new Date().getTime();
    const selisih = waktuPernikahan - sekarang;

    if (selisih < 0) {
        clearInterval(penghitung);
        document.getElementById('pesan-timer').innerText = 'Hari bahagia telah tiba.';
        return;
    }

    const hari = Math.floor(selisih / (1000 * 60 * 60 * 24));
    const jam = Math.floor((selisih % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const menit = Math.floor((selisih % (1000 * 60 * 60)) / (1000 * 60));
    const detik = Math.floor((selisih % (1000 * 60)) / 1000);

    document.getElementById('days').innerText = dua_digit(hari);
    document.getElementById('hours').innerText = dua_digit(jam);
    document.getElementById('minutes').innerText = dua_digit(menit);
    document.getElementById('seconds').innerText = dua_digit(detik);
}, 1000);
