<!DOCTYPE html>
<html>

<head>
    <title><?= $title_pdf; ?></title>
    <style>
        /* Custom styling for the PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2><?= $title_pdf; ?></h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Peminjam</th>
                <th>Tanggal Peminjaman</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($laporan as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['kode']; ?></td>
                    <td><?= $row['anggota']; ?></td>
                    <td><?= date('d/m/Y', strtotime($row['tgl_pinjam']));; ?></td>
                    <td><?= date('d/m/Y', strtotime($row['tgl_tenggat']));; ?></td>
                    <td><?= $row['status'] == 0 ? "Dipinjam" : "Jatuh Tempo"; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>