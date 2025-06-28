<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: index.php");
include 'config/koneksi.php';

if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    mysqli_query($conn, "DELETE FROM peminjaman WHERE id = $id");
    header("Location: peminjaman.php?success=hapus");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/buku.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container py-5">
    <div class="container-card">
        <h2>📄 Data Peminjaman</h2>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] === 'tambah') echo "✅ Peminjaman berhasil ditambahkan.";
                elseif ($_GET['success'] === 'edit') echo "✅ Data peminjaman berhasil diperbarui.";
                elseif ($_GET['success'] === 'hapus') echo "✅ Data peminjaman berhasil dihapus.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="mb-3 d-flex justify-content-between">
            <a href="dashboard.php" class="btn btn-secondary">⬅️ Kembali</a>
            <a href="tambah_pinjam.php" class="btn btn-success">➕ Tambah Peminjaman</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Buku</th>
                        <th>Peminjam</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $q = mysqli_query($conn, "
                    SELECT p.*, b.judul 
                    FROM peminjaman p 
                    JOIN buku b ON p.id_buku = b.id
                ");
                while ($row = mysqli_fetch_assoc($q)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['judul']}</td>
                        <td>{$row['nama_peminjam']}</td>
                        <td>{$row['tanggal_pinjam']}</td>
                        <td>{$row['tanggal_kembali']}</td>
                        <td>
                            <a href='edit_pinjam.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='?hapus={$row['id']}' onclick=\"return confirm('Yakin ingin hapus?')\" class='btn btn-danger btn-sm'>Hapus</a>
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
