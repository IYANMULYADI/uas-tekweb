<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: index.php");
include 'config/koneksi.php';

if (isset($_GET['hapus'])) {
    $id_buku = intval($_GET['hapus']);
    $cek = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_buku = $id_buku");

    if (mysqli_num_rows($cek) > 0) {
        header("Location: buku.php?error=terpakai");
    } else {
        mysqli_query($conn, "DELETE FROM buku WHERE id = $id_buku");
        header("Location: buku.php?success=hapus");
    }
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Buku</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/buku.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container py-5">
    <div class="container-card">
        <h2>📚 Manajemen Data Buku</h2>
        <?php if (isset($_GET['success']) || isset($_GET['error'])): ?>
            <div class="alert alert-<?= isset($_GET['error']) ? 'danger' : 'success' ?> alert-dismissible fade show" role="alert">
                <?php
                if (isset($_GET['success'])) {
                    if ($_GET['success'] === 'tambah') echo "✅ Buku berhasil ditambahkan.";
                    elseif ($_GET['success'] === 'edit') echo "✅ Buku berhasil diperbarui.";
                    elseif ($_GET['success'] === 'hapus') echo "✅ Buku berhasil dihapus.";
                } elseif ($_GET['error'] === 'terpakai') {
                    echo "❌ Buku tidak dapat dihapus karena sedang digunakan dalam data peminjaman.";
                }
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="mb-3 d-flex justify-content-between">
            <a href="dashboard.php" class="btn btn-secondary">⬅️ Kembali</a>
            <a href="tambah_buku.php" class="btn btn-success">➕ Tambah Buku</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q = mysqli_query($conn, "SELECT * FROM buku");
                    while ($row = mysqli_fetch_assoc($q)) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['judul']}</td>
                            <td>{$row['pengarang']}</td>
                            <td>{$row['stok']}</td>
                            <td>
                                <a href='edit_buku.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='?hapus={$row['id']}' onclick=\"return confirm('Hapus data?')\" class='btn btn-danger btn-sm'>Hapus</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
