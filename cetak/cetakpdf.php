<?php
use Dompdf\Dompdf;
use Dompdf\Options;

require_once '../vendor/autoload.php'; // ✅ fix path sesuai struktur kamu

function cetakPDF($html, $filename = 'laporan.pdf', $stream = true) {
    $options = new Options();
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    if ($stream) {
        $dompdf->stream($filename, ["Attachment" => false]);
    } else {
        file_put_contents($filename, $dompdf->output());
    }
}
