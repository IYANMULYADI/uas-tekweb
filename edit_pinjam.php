<?php
include 'config/koneksi.php';

$id = intval($_GET['id']);
$q = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id = $id");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_buku = $_POST['id_buku'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama_peminjam']);
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tgl_kembali = $_POST['tanggal_kembali'];

    // Validasi tanggal
    if ($tgl_kembali < $tgl_pinjam) {
        echo "<script>alert('❌ Tanggal kembali tidak boleh sebelum tanggal pinjam.');history.back();</script>";
        exit;
    }

    $update = mysqli_query($conn, "UPDATE peminjaman SET 
        id_buku = '$id_buku', 
        nama_peminjam = '$nama', 
        tanggal_pinjam = '$tgl_pinjam', 
        tanggal_kembali = '$tgl_kembali' 
        WHERE id = $id");

    if ($update) {
        header("Location: peminjaman.php?success=edit");
        exit;
    } else {
        echo "Gagal mengupdate data.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Peminjaman</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>
<body class="py-5">
    <div class="form-card">
        <h2>✏️ Edit Data Peminjaman</h2>
        <form method="POST">
            <div class="mb-3">
                <label>Buku</label>
                <select name="id_buku" class="form-control" required>
                    <option value="">-- Pilih Buku --</option>
                    <?php
                    $buku = mysqli_query($conn, "SELECT * FROM buku");
                    while ($b = mysqli_fetch_assoc($buku)) {
                        $selected = ($b['id'] == $data['id_buku']) ? 'selected' : '';
                        echo "<option value='{$b['id']}' $selected>{$b['judul']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Nama Peminjam</label>
                <input type="text" name="nama_peminjam" class="form-control" value="<?= $data['nama_peminjam'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" id="tglPinjam" class="form-control" value="<?= $data['tanggal_pinjam'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" id="tglKembali" class="form-control" value="<?= $data['tanggal_kembali'] ?>" required>
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

            function updateTanggalKembali() {
                const minDate = tglPinjam.value;
                if (minDate) {
                    tglKembali.min = minDate;
                }
            }

            updateTanggalKembali();
            tglPinjam.addEventListener("change", updateTanggalKembali);
        });
    </script>
</body>
</html>
