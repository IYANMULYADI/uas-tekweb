<?php
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_buku = $_POST['id_buku'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama_peminjam']);
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tgl_kembali = $_POST['tanggal_kembali'];

    // Validasi: tanggal kembali tidak boleh sebelum tanggal pinjam
    if ($tgl_kembali < $tgl_pinjam) {
        echo "<script>alert('❌ Tanggal kembali tidak boleh sebelum tanggal pinjam.');history.back();</script>";
        exit;
    }

    $query = mysqli_query($conn, "INSERT INTO peminjaman (id_buku, nama_peminjam, tanggal_pinjam, tanggal_kembali)
                                  VALUES ('$id_buku', '$nama', '$tgl_pinjam', '$tgl_kembali')");

    if ($query) {
        header("Location: peminjaman.php?success=tambah");
        exit;
    } else {
        echo "Gagal menyimpan data peminjaman.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>
<body class="py-5">
    <div class="form-card">
        <h2>➕ Tambah Data Peminjaman</h2>
        <form method="POST">
            <div class="mb-3">
                <label>Buku</label>
                <select name="id_buku" class="form-control" required>
                    <option value="">-- Pilih Buku --</option>
                    <?php
                    $buku = mysqli_query($conn, "SELECT * FROM buku");
                    while ($b = mysqli_fetch_assoc($buku)) {
                        echo "<option value='{$b['id']}'>{$b['judul']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Nama Peminjam</label>
                <input type="text" name="nama_peminjam" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="form-control" id="tglPinjam" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" class="form-control" id="tglKembali" required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="peminjaman.php" class="btn btn-secondary">⬅️ Batal</a>
                <button class="btn btn-success">💾 Simpan</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tglPinjam = document.getElementById("tglPinjam");
            const tglKembali = document.getElementById("tglKembali");

            tglPinjam.addEventListener("change", function () {
                tglKembali.min = tglPinjam.value;
            });
        });
    </script>
</body>
</html>
