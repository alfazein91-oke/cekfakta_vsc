
<?php
require_once 'includes/function.php';

$hasil = "";
$pesan = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $berita = trim($_POST['berita'] ?? '');

    if (strlen($berita) < 20) {

        $hasil = "Teks terlalu pendek";
        $pesan = "Masukkan teks berita yang lebih lengkap.";

    } else {

        $indikator = [
            'sebarkan sekarang',
            '100% terbukti',
            'jangan sampai ketahuan',
            'rahasia pemerintah',
            'viralkan',
            'pasti benar'
        ];

        $jumlah = 0;

        foreach ($indikator as $kata) {
            if (stripos($berita, $kata) !== false) {
                $jumlah++;
            }
        }

        if ($jumlah >= 2) {
            $hasil = "Perlu Diwaspadai";
            $pesan = "Ditemukan beberapa kata yang perlu diperiksa lebih lanjut.";
        } elseif ($jumlah == 1) {
            $hasil = "Perlu Diverifikasi";
            $pesan = "Terdapat satu indikator yang perlu diperiksa.";
        } else {
            $hasil = "Belum Ada Indikator";
            $pesan = "Tidak ditemukan kata indikator pada pemeriksaan sederhana ini. Kebenaran berita belum dapat dipastikan.";
        }
    }
}

$judul = "Pemeriksaan Hoaks";
include 'includes/header.php';
?>

<div class="max-w-3xl mx-auto">

    <h1 class="text-3xl font-bold mb-3">
        Pemeriksaan Berita Hoaks
    </h1>

    <p class="text-gray-600 mb-8">
        Masukkan isi berita yang ingin diperiksa.
        Sistem akan melakukan pemeriksaan awal
        berdasarkan indikator kata tertentu.
    </p>

    <form method="POST"
          class="bg-white p-6 rounded-xl shadow-sm border">

        <label class="font-semibold block mb-3">
            Masukkan Teks Berita
        </label>

        <textarea name="berita" rows="7"
                  required
                  class="w-full border rounded-lg p-4"
                  placeholder="Tempelkan isi berita di sini..."><?= aman($_POST['berita'] ?? '') ?></textarea>

        <button type="submit"
                class="mt-5 bg-blue-700 text-white px-6 py-3 rounded-lg">
            Periksa Berita
        </button>

    </form>

    <?php if ($hasil): ?>

    <div class="mt-6 bg-blue-50 border border-blue-200 p-6 rounded-xl">

        <h2 class="text-xl font-bold text-blue-700">
            Hasil Pemeriksaan:
            <?= aman($hasil) ?>
        </h2>

        <p class="mt-3 text-gray-700">
            <?= aman($pesan) ?>
        </p>

        <p class="text-sm text-gray-500 mt-4">
            Catatan: Hasil ini bukan bukti bahwa berita
            benar atau palsu. Periksa sumber asli,
            tanggal, dan media terpercaya.
        </p>

    </div>

    <?php endif; ?>

</div>

<?php include 'includes/footer.php'; ?>
