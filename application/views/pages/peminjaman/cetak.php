<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Peminjaman Buku - <?= $peminjaman->kode ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 10px;
            width: 80mm;
            /* Lebar struk */
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            font-size: 16px;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #000;
        }

        .table {
            width: 100%;
            margin-bottom: 10px;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
        }

        .table th {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        img {
            display: block;
            margin: 10px auto;
            width: 60%;
            /* Ukuran QR code */
        }

        .no-print {
            display: none;
        }

        @media print {
            @page {
                size: 80mm auto;
                margin: 0;
            }

            body {
                width: 80mm;
                margin: 0;
            }

            .no-print {
                display: none;
            }
        }

        .content {
            padding: 10px;
            border: 1px solid #000;
            margin-bottom: 10px;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="content">
        <h2>Transaksi Peminjaman Buku</h2>

        <div class="text-center">
            <img src="<?= base_url('assets/qr-code/peminjaman/' . $peminjaman->kode . '.png') ?>" alt="QR Code">
            <h3><?= $peminjaman->kode ?></h3>
        </div>

        <table class="table">
            <tr>
                <th>Tanggal Pinjam</th>
                <th width="3%">:</th>
                <td><?= date("d/m/Y", strtotime($peminjaman->tgl_pinjam)) ?></td>
            </tr>
            <tr>
                <th>Jatuh Tempo</th>
                <th width="3%">:</th>
                <td><?= date("d/m/Y", strtotime($peminjaman->tgl_tenggat)) ?></td>
            </tr>
            <tr>
                <th>Lama Pinjam</th>
                <th width="3%">:</th>
                <td><?= $peminjaman->lama_pinjam ?> Hari</td>
            </tr>
            <tr>
                <th>Kode Anggota</th>
                <th width="3%">:</th>
                <td><?= $peminjaman->kode_anggota ?></td>
            </tr>
            <tr>
                <th>Nama Anggota</th>
                <th width="3%">:</th>
                <td><?= $peminjaman->nama_anggota ?></td>
            </tr>
        </table>
    </div>

    <div class="button-container no-print">
        <button onclick="window.print()">Cetak</button>
    </div>

    <script>
        // Print otomatis ketika halaman selesai dimuat
        window.onload = function() {
            window.print();
        }

        // Tutup halaman saat proses cetak dibatalkan
        window.onafterprint = function() {
            setTimeout(function() {
                window.close();
            }, 100);
        }
    </script>
</body>

</html>