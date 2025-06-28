<?php
require '../config/koneksi.php';
require 'cetakpdf.php';

$q = mysqli_query($conn, "SELECT * FROM buku");
$tanggal_cetak = date('d-m-Y');

$html = '
<style>
    body { font-family: sans-serif; font-size: 12px; }
    h2 { text-align: center; margin-bottom: 0; }
    .tanggal { text-align: center; font-size: 11px; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #333; padding: 6px; text-align: center; }
    th { background-color: #f2f2f2; }
    .ttd { margin-top: 50px; width: 100%; text-align: right; padding-right: 50px; }
</style>

<h2>Laporan Data Buku</h2>
<div class="tanggal">Tanggal Cetak: ' . $tanggal_cetak . '</div>

<table>
<tr>
    <th>No</th>
    <th>Judul Buku</th>
    <th>Pengarang</th>
    <th>Stok</th>
</tr>';

$no = 1;
while ($row = mysqli_fetch_assoc($q)) {
    $html .= "<tr>
        <td>{$no}</td>
        <td>{$row['judul']}</td>
        <td>{$row['pengarang']}</td>
        <td>{$row['stok']}</td>
    </tr>";
    $no++;
}

$html .= '</table>';

$html .= '
<div class="ttd">
    <p>Petugas,</p>
    <br><br><br>
    <strong>_______________________</strong>
</div>
';

cetakPDF($html, 'laporan_buku.pdf');
