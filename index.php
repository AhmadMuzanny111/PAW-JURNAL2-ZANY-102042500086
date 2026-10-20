<?php
require 'functions.php';
require 'connect.php';

// TODO 1 (RINGKASAN)
// Hitung jumlah baris di tabel mata_kuliah, materi, dan tugas,
// lalu hitung juga tugas yang statusnya 'Aktif'.
// Simpan hasilnya ke empat variabel di bawah ini (gunakan COUNT, bukan mengambil semua baris).

$sql_mk = "SELECT COUNT(*) AS total FROM mata_kuliah";
$stmt_mk = $conn->prepare($sql_mk);
$stmt_mk->execute();
$jumlah_mata_kuliah = $stmt_mk->get_result()->fetch_assoc()['total'];

$sql_materi = "SELECT COUNT(*) AS total FROM materi";
$stmt_materi = $conn->prepare($sql_materi);
$stmt_materi->execute();
$jumlah_materi = $stmt_materi->get_result()->fetch_assoc()['total'];

$sql_tugas = "SELECT COUNT(*) AS total FROM tugas";
$stmt_tugas = $conn->prepare($sql_tugas);
$stmt_tugas->execute();
$jumlah_tugas = $stmt_tugas->get_result()->fetch_assoc()['total'];

$sql_aktif = "SELECT COUNT(*) AS total FROM mata_kuliah";
$stmt_aktif = $conn->prepare($sql_aktif);
$stmt_aktif->execute();
$jumlah_tugas_aktif = $stmt_aktif->get_result()->fetch_assoc()['total'];

$pilihan_mk = pilihan_mata_kuliah($conn);

$judul = 'Beranda';
require 'header.php';
?>
<p class="eyebrow">Learning Management System</p>
<h1 class="hero">Kelola perkuliahan dalam satu tempat.</h1>
<p class="muted">Pengelolaan mata kuliah, materi pembelajaran, dan tugas.</p>

<div class="stats">
    <a class="card stat" href="mata_kuliah.php">
        <b><?= (int) $jumlah_mata_kuliah ?></b>
        <span>Mata kuliah</span>
    </a>
    <a class="card stat" href="materi.php">
        <b><?= (int) $jumlah_materi ?></b>
        <span>Materi</span>
    </a>
    <a class="card stat" href="tugas.php">
        <b><?= (int) $jumlah_tugas ?></b>
        <span>Tugas</span>
    </a>
    <a class="card stat" href="tugas.php?status=Aktif">
        <b><?= (int) $jumlah_tugas_aktif ?></b>
        <span>Tugas aktif</span>
    </a>
</div>

<h2>Mata kuliah tersedia</h2>
<?php if (count($pilihan_mk) === 0): ?>
    <p class="empty">Belum ada mata kuliah.</p>
<?php else: ?>
    <div class="card list">
        <?php foreach ($pilihan_mk as $id => $nama): ?>
            <a class="list-item" href="mata_kuliah.php?aksi=detail&id=<?= (int) $id ?>"><?= h($nama) ?></a>
        <?php endforeach ?>
    </div>
<?php endif ?>
<?php require 'footer.php'; ?>
