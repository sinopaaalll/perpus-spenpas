<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kartu Anggota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .kartu {
            width: 100%;
            max-width: 900px;
            border: 2px solid #333;
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            background-color: #fff;
            display: flex;
            justify-content: space-between;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .kartu-kiri {
            width: 50%;
            background-color: #e0f7fa;
            padding: 15px;
            border-right: 2px solid #333;
            border-radius: 10px 0 0 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .kartu-kanan {
            width: 50%;
            padding-left: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: #f1f8e9;
            border-radius: 0 10px 10px 0;
        }

        .header-kiri {
            display: flex;
            align-items: center;
            background-color: #00796b;
            color: white;
            padding: 10px;
            border-radius: 10px;
        }

        .header-kiri h3,
        .header-kiri h4 {
            margin: 0;
        }

        .header-kiri img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .info-anggota h4 {
            margin-bottom: 10px;
            font-size: 1.2rem;
            color: #00796b;
        }

        .info-anggota p {
            margin: 5px 0;
            font-size: 0.9rem;
            color: #333;
        }

        .qr-code {
            text-align: right;
            margin-top: 10px;
        }

        .qr-code img {
            width: 80px;
            height: 80px;
        }

        .kartu-kanan h3 {
            margin-bottom: 10px;
            font-size: 1rem;
            color: #558b2f;
        }

        .kartu-kanan p {
            margin: 5px 0;
            font-size: 0.9rem;
            color: #333;
        }

        .kartu-kanan .aturan {
            margin-top: 20px;
        }

        .kartu-kanan ul {
            padding-left: 20px;
            list-style: disc;
        }

        .kartu-kanan ul li {
            margin-bottom: 10px;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .header-kiri {
                background-color: #00796b !important;
                color: white !important;
            }

            .kartu-kiri {
                background-color: #e0f7fa !important;
            }

            .kartu-kanan {
                background-color: #f1f8e9 !important;
            }
        }
    </style>
    <script>
        window.onload = function() {
            window.print(); // Memanggil dialog cetak saat halaman dimuat
        }

        window.onafterprint = function() {
            window.close(); // Menutup jendela setelah pencetakan
        }
    </script>
</head>

<body>

    <div class="kartu">
        <!-- Bagian Kiri Kartu -->
        <div class="kartu-kiri">
            <div class="header-kiri">
                <!-- Logo Perpustakaan -->
                <img src="<?= base_url('assets/images/logo.png'); ?>" alt="Logo Perpustakaan">
                <div>
                    <h3>KARTU ANGGOTA PERPUSTAKAAN</h3>
                    <h4>SMP NEGERI 1 PASAWAHAN</h4>
                </div>
            </div>
            <div class="info-anggota">
                <h4><?= $anggota->name ?></h4><br>
                <p><strong>Alamat:</strong> <?= $anggota->alamat ?></p>
                <p><strong>Nomor Anggota:</strong> <?= $anggota->kode ?></p>
                <p><strong>Nomor Telepon:</strong> <?= $anggota->telp ?></p>
            </div>
            <div class="qr-code">
                <img src="<?= base_url('assets/qr-code/anggota/' . $anggota->kode . '.png'); ?>" alt="QR Code">
            </div>
        </div>

        <!-- Bagian Kanan Kartu -->
        <div class="kartu-kanan">
            <div class="aturan">
                <h3>Aturan Perpustakaan</h3>
                <ul>
                    <li>Kartu ini diterbitkan oleh perpustakaan.</li>
                    <li>Harap kembalikan kartu ini jika Anda menemukannya.</li>
                </ul>
            </div>
            <div class="info-perpustakaan">
                <p><strong>MY LIBRARY</strong></p>
                <p>Alamat Lengkap dan Website Perpustakaan</p>
            </div>
        </div>
    </div>

</body>

</html>