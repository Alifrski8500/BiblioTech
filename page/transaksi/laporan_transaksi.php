<?php
require '../../koneksi.php'; // Pastikan koneksi OK
require_once('../../assets/html2pdf/html2pdf.class.php');

$content = '
<style type="text/css">
    .tabel{border-collapse: collapse;}
    .tabel th{padding: 8px 5px; background-color: #cccccc;}
    .tabel td{padding: 8px 5px;}
</style>

<page>
    <h1>Laporan Data Transaksi</h1>
    <br>
    <table border="1" class="tabel">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
        </tr>
';

if (isset($_POST['cetak'])) {
    $tgl1 = $_POST['tanggal1'];
    $tgl2 = $_POST['tanggal2'];

    $no = 1;
    $sql = $koneksi->query("
        SELECT 
            t.id, t.id_buku, t.nis, t.tgl_pinjam, t.tgl_kembali, t.status,
            b.judul,
            a.nama
        FROM tb_transaksi t
        INNER JOIN tb_buku b ON t.id_buku = b.id_buku
        INNER JOIN tb_anggota a ON t.nis = a.nis
        WHERE t.tgl_pinjam BETWEEN '$tgl1' AND '$tgl2'
    ");

    while ($data = $sql->fetch_assoc()) {
        $content .= '
            <tr>
                <td align="center">'.$no++.'</td>
                <td>'.htmlspecialchars($data['judul']).'</td>
                <td align="center">'.htmlspecialchars($data['nis']).'</td>
                <td>'.htmlspecialchars($data['nama']).'</td>
                <td align="center">'.$data['tgl_pinjam'].'</td>
                <td align="center">'.$data['tgl_kembali'].'</td>
                <td align="center">'.ucfirst($data['status']).'</td>
            </tr>
        ';
    }
}

$content .= '
    </table>
</page>
';

$html2pdf = new HTML2PDF('P', 'A4', 'fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('laporan_transaksi.pdf');
?>
