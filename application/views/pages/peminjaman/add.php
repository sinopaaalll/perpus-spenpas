<!DOCTYPE html>
<html lang="en">

<!-- [Head] start -->

<head>
    <?php $this->load->view('component/header'); ?>
</head>
<!-- [Head] end -->

<!-- [Body] Start -->

<body>
    <!-- [ Pre-loader ] start -->
    <?php $this->load->view('component/loader'); ?>
    <!-- [ Pre-loader ] End -->

    <!-- [ Sidebar Menu ] start -->
    <?php $this->load->view('component/sidebar'); ?>
    <!-- [ Sidebar Menu ] end -->

    <!-- [ Header Topbar ] start -->
    <?php $this->load->view('component/navbar'); ?>
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">

            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Ajukan <?= $title ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->


            <!-- [ Main Content ] start -->
            <form action="<?= base_url('peminjaman/proses_tambah'); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">

                    <!-- [ sample-page ] start -->
                    <div class="col-lg-4">

                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Kode</label>
                                            <div class="col-lg-8">
                                                <input type="text" name="kode" id="kode" class="form-control" value="<?= $kode_peminjaman ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Lama Pinjam</label>
                                            <div class="col-lg-6">
                                                <input type="number" name="lama_pinjam" id="lama_pinjam" class="form-control" placeholder="Contoh: 2 (Hari)" required>
                                            </div>
                                            <label class="col-lg-2 col-form-label">Hari</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Anggota</label>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <input type="text" name="anggota" id="anggota" class="form-control" placeholder="Contoh: AG0001" value="" required>
                                                    <button class="btn btn-primary btn-pindai" type="button"><span class="fa fa-qrcode mt-1"></span> &nbsp;Pindai</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Nama</label>
                                            <div class="col-lg-8">
                                                <input type="hidden" name="anggota_id" id="anggota_id" class="form-control">
                                                <input type="text" name="name" id="name" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">NISN</label>
                                            <div class="col-lg-8">
                                                <input type="text" name="nisn" id="nisn" class="form-control" readonly>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Buku</label>
                                            <div class="col-lg-10">
                                                <div class="input-group">
                                                    <input type="text" name="buku_kode" id="buku_kode" class="form-control" placeholder="Contoh: BK000001" value="">
                                                    <button class="btn btn-primary" type="button" id="btn-buku"><span class="fa fa-search mt-1"></span> &nbsp;Cari</button>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Data Buku</label>
                                            <div class="col-lg-10">
                                                <div id="result_tunggu_buku">
                                                    <p class="mt-3" style="color:red">* Belum Ada Hasil</p>
                                                </div>
                                                <div id="result_buku"></div>
                                            </div>
                                        </div>

                                        <div class="form-group mt-4 d-flex justify-content-end">
                                            <a href="<?= base_url('peminjaman') ?>" class="btn btn-light-primary"><span class="fa fa-arrow-left"></span>&nbsp; Kembali</a>&nbsp;
                                            <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span>&nbsp; Simpan</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- [ sample-page ] end -->

                </div>
            </form>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Modal Scan -->
    <div id="pindaiModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="pindaiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pindaiModalLabel">Pindai QR Code Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="reader" width="600px"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Buku -->
    <div id="bukuModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="bukuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bukuModalLabel">Data Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pilihanBuku">
                    <table class="table table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>ISBN</th>
                                <th>Judul</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                                <th>Stok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($buku as $b) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $b->kode ?></td>
                                    <td><?= format_isbn($b->isbn) ?></td>
                                    <td><?= $b->judul ?></td>
                                    <td><?= $b->penerbit ?></td>
                                    <td><?= $b->tahun_terbit ?></td>
                                    <td><?= $b->stok ?></td>
                                    <td class="text-center">
                                        <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Pilih" data-bs-original-title="Pilih">
                                                <button type="button" class="avtar avtar-xs btn-link-warning btn-pc-default" id="pilih_buku" data_kode="<?= $b->kode; ?>">
                                                    <i class="ti ti-check f-18"></i>
                                                </button>

                                            </li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Detail" data-bs-original-title="Detail">
                                                <a href="<?= base_url('buku/detail/' . $b->id); ?>" target="_blank" class="avtar avtar-xs btn-link-info btn-pc-default">
                                                    <i class="ti ti-eye f-18"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- [ Footer ] start -->
    <?php $this->load->view('component/footer'); ?>
    <!-- [ Footer ] start -->

    <!-- Required Js -->
    <?php $this->load->view('component/script'); ?>

    <script src="<?= base_url('assets/') ?>js/plugins/notifier.js"></script>

    <script>
        // Fungsi get Data
        function getDataAnggota(kodeAnggota) {
            if (kodeAnggota != '') { // Cek apakah input tidak kosong
                $.ajax({
                    url: '<?= base_url('anggota/get_data') ?>',
                    type: 'POST',
                    data: {
                        anggota: kodeAnggota
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Jika anggota sudah meminjam buku hari ini
                        if (!response.success) {
                            notifier.show('Gagal!', response.message, 'error', '');
                        } else {
                            // Isi data ke dalam tabel jika data ditemukan
                            $('#anggota_id').val(response.data.id); // Isi Nama
                            $('#name').val(response.data.name); // Isi Nama
                            $('#nisn').val(response.data.nisn); // Isi NISN
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ', status, error);
                    }
                });
            } else {
                // Kosongkan tabel jika input kosong
                $('#anggota_id').val(''); // Kosongkan Nama
                $('#name').val(''); // Kosongkan Nama
                $('#nisn').val(''); // Kosongkan NISN
            }
        }


        // Definisikan variabel html5QrcodeScanner di luar event handler agar bisa diakses saat modal ditutup
        let html5QrcodeScanner;

        $(document).on("click", ".btn-pindai", function() {
            // Tampilkan modal
            $('#pindaiModal').modal('show');

            // Function to handle successful QR code scan
            function onScanSuccess(decodedText, decodedResult) {
                // Set the scanned code into the input field
                $('#anggota').val(decodedText);

                // Panggil fungsi untuk mendapatkan data berdasarkan hasil scan
                getDataAnggota(decodedText);

                // Stop the QR code scanner
                html5QrcodeScanner.clear().then(() => {
                    // QR code scanning is cleared and modal closed
                    $('#pindaiModal').modal('hide');
                    notifier.show('Success!', 'QR-Code berhasil dipindai.', 'success', '', 4000);
                }).catch(error => {
                    console.error('Failed to clear scanner. Reason: ', error);
                });
            }

            // Function to handle scan failure (optional, can be ignored)
            function onScanFailure(error) {
                console.warn(`Code scan error = ${error}`);
            }

            // Initialize the QR code scanner if it hasn't been initialized
            if (!html5QrcodeScanner) {
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        }
                    },
                    false
                );
            }

            // Start the QR code scanner
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });

        // Clear scanner and hide modal on close button click or when modal is hidden
        $('#pindaiModal').on('hidden.bs.modal', function() {
            if (typeof html5QrcodeScanner !== 'undefined') {
                html5QrcodeScanner.clear().catch(err => console.error('Failed to clear scanner. Reason:', err));
            }
        });

        // Get data anggota
        $(document).ready(function() {
            // Event ketika input 'anggota' berubah (menggunakan 'keyup')
            $('#anggota').on('keyup', function() {
                var kodeAnggota = $(this).val(); // Mengambil nilai dari input

                if (kodeAnggota.length === 6) {
                    getDataAnggota(kodeAnggota); // Panggil fungsi jika panjang input 7 karakter
                } // Panggil fungsi untuk mengambil data anggota
            });
        });
    </script>

    <script>
        $(document).on("click", "#btn-buku", function() {
            $('#bukuModal').modal('show');
        });

        $(document).ready(function() {
            $("#buku_kode").keyup(function() {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('peminjaman/buku'); ?>",
                    data: 'kode_buku=' + $(this).val(),
                    beforeSend: function() {
                        $("#result_tunggu_buku").html('<p class="mt-3" style="color:green"><blink>tunggu sebentar</blink></p>');
                    },
                    success: function(html) {
                        $("#result_buku").load("<?= base_url('peminjaman/buku_list'); ?>");
                        $("#result_tunggu_buku").html('');
                    }
                });
            });
        });

        $(".pilihanBuku #pilih_buku").click(function(e) {
            document.getElementsByName('buku_kode')[0].value = $(this).attr("data_kode");
            $('#bukuModal').modal('hide');
            $.ajax({
                type: "POST",
                url: "<?= base_url('peminjaman/buku'); ?>",
                data: 'kode_buku=' + $(this).attr("data_kode"),
                beforeSend: function() {
                    $("#result_buku").html("");
                    $("#result_tunggu_buku").html('<p class="mt-3" style="color:green"><blink>tunggu sebentar</blink></p>');
                },
                success: function(html) {
                    $("#result_buku").load("<?= base_url('peminjaman/buku_list'); ?>");
                    $("#result_tunggu_buku").html('');
                }
            });
        });
    </script>

</body>
<!-- [Body] end -->

</html>