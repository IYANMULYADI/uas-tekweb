<?php
include 'config/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM buku WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $pengarang = mysqli_real_escape_string($conn, $_POST['pengarang']);
    $stok = intval($_POST['stok']);

    $update = mysqli_query($conn, "UPDATE buku SET judul='$judul', pengarang='$pengarang', stok=$stok WHERE id=$id");

    if ($update) {
        header("Location: buku.php?success=edit");
        exit;
    } else {
        echo "Gagal mengupdate data.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>
<body class="py-5">
    <div class="form-card">
        <h2>✏️ Edit Buku</h2>
        <form method="POST">
            <div class="mb-3">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-control" value="<?= $data['judul'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Pengarang</label>
                <input type="text" name="pengarang" class="form-control" value="<?= $data['pengarang'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="<?= $data['stok'] ?>" required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="buku.php" class="btn btn-secondary">⬅️ Batal</a>
                <button class="btn btn-primary">💾 Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>
