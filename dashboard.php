<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">📚 Dashboard Perpustakaan</h1>
            <p class="lead">Selamat datang, <strong><?= $_SESSION['login'] ?></strong>. Silakan pilih menu di bawah ini.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <a href="buku.php" class="text-decoration-none">
                    <div class="card dashboard-card shadow-sm text-center p-4">
                        <div class="dashboard-icon text-primary">📘</div>
                        <h5 class="mt-3">Manajemen Buku</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="peminjaman.php" class="text-decoration-none">
                    <div class="card dashboard-card shadow-sm text-center p-4">
                        <div class="dashboard-icon text-success">📄</div>
                        <h5 class="mt-3">Data Peminjaman</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="cetak/laporan.php" target="_blank" class="text-decoration-none">
                    <div class="card dashboard-card shadow-sm text-center p-4">
                        <div class="dashboard-icon text-secondary">🖨️</div>
                        <h5 class="mt-3">Cetak Laporan Buku</h5>
                    </div>
                </a>
            </div>
        <div class="col-md-4">
         <a href="cetak/laporan_peminjaman.php" target="_blank" class="text-decoration-none">
            <div class="card dashboard-card shadow-sm text-center p-4">
                <div class="dashboard-icon text-info">📤</div>
                <h5 class="mt-3">Cetak Laporan Peminjaman</h5>
            </div>
        </a>
        </div>

            <div class="col-md-4">
                <a href="logout.php" class="text-decoration-none">
                    <div class="card dashboard-card shadow-sm text-center p-4">
                        <div class="dashboard-icon text-danger">🚪</div>
                        <h5 class="mt-3">Logout</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
