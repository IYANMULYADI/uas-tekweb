<?php
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $pengarang = mysqli_real_escape_string($conn, $_POST['pengarang']);
    $stok = intval($_POST['stok']);

    $query = mysqli_query($conn, "INSERT INTO buku (judul, pengarang, stok) VALUES ('$judul', '$pengarang', '$stok')");
    if ($query) {
        header("Location: buku.php?success=tambah");
        exit;
    } else {
        echo "Gagal menambahkan buku.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>
<body class="py-5">
    <div class="form-card">
        <h2>📘 Tambah Buku Baru</h2>
        <form method="POST">
            <div class="mb-3">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Pengarang</label>
                <input type="text" name="pengarang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="buku.php" class="btn btn-secondary">⬅️ Kembali</a>
                <button class="btn btn-success">💾 Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
