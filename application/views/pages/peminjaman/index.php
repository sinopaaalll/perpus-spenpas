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
                                <h2 class="mb-0"><?= $title ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->


            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->

                <div class="col-lg-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 class="mb-3 mb-sm-0">Cari dan Pindai QR Code Peminjaman Buku</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="form-label">Cari Kode Pinjam </label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="kode" id="kode_pinjam" class="form-control" placeholder="Contoh: PJ241010001" value="">
                                            <button class="btn btn-primary btn-pindai" type="button"><span class="fa fa-qrcode mt-1"></span> &nbsp;Pindai</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 class="mb-3 mb-sm-0">Filter Tabel</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Tangal Pinjam</label>
                                                <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" placeholder="Tanggal">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="ALL">Semua</option>
                                                    <option value="0">Dipinjam</option>
                                                    <option value="1">Jatuh Tempo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group text-end">
                                                <button type="button" id="refresh" class="btn btn-lg btn-primary mt-4"><span class="fa fa-sync-alt"></span>&nbsp; Muat Ulang</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h5 class="mb-3 mb-sm-0">Data <?= $title ?></h5>
                                <div>
                                    <a href="<?= base_url('peminjaman/tambah') ?>" class="btn btn-light-primary m-0"><span class="fa fa-plus-circle mt-1"></span>&nbsp; Ajukan <?= $title ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="dataTable-server">
                                <thead>
                                    <tr>
                                        <th>Kode Pinjam</th>
                                        <th>Nama Anggota</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <!-- data table server side -->
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Modal Scan -->
    <div id="pindaiModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="pindaiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pindaiModalLabel">Pindai QR Code Peminjaman</h5>
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



    <!-- [ Footer ] start -->
    <?php $this->load->view('component/footer'); ?>
    <!-- [ Footer ] start -->

    <!-- Required Js -->
    <?php $this->load->view('component/script'); ?>

    <script src="<?= base_url('assets/') ?>js/plugins/notifier.js"></script>

    <!-- [ Alert ] start -->
    <?php $this->load->view('component/alert'); ?>
    <!-- [ Alert ] start -->

    <script type="text/javascript">
        $(document).ready(function() {
            // Inisialisasi DataTable
            var table = $('#dataTable-server').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?= base_url('peminjaman/get_data_peminjaman') ?>",
                    "type": "POST",
                    "data": function(d) {
                        // Ambil nilai dari input tanggal dan status
                        d.tgl_pinjam = $('#tgl_pinjam').val();
                        d.status = $('#status').val();
                    }
                },
                "columns": [{
                        "data": "kode"
                    },
                    {
                        "data": "anggota"
                    },
                    {
                        "data": "tgl_pinjam"
                    },
                    {
                        "data": "tgl_tenggat"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "aksi",
                        "orderable": false,
                        "className": "text-center"
                    }
                ],
                "order": [
                    [0, 'desc']
                ],
                "language": {
                    "processing": "Memuat data, mohon tunggu..."
                },

                // Inisialisasi ulang tooltip setelah data di-refresh
                "drawCallback": function(settings) {
                    $('[data-bs-toggle="tooltip"]').tooltip(); // Inisialisasi ulang setiap kali tabel di-refresh
                }
            });

            // Tooltip initialization for the first load
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Event ketika tombol "Muat Ulang" diklik
            $('#refresh').on('click', function() {
                // Reset input tanggal dan status ke default
                $('#tgl_pinjam').val('');
                $('#status').val('ALL');

                // Muat ulang DataTable seperti pertama kali halaman di-reload
                table.ajax.reload(null, false); // `null, false` agar posisi halaman tidak berubah
            });

            // Event ketika input tanggal 'tgl_pinjam' berubah
            $('#tgl_pinjam').on('change', function() {
                table.draw(); // Redraw tabel dengan data yang difilter
            });

            // Event ketika select 'status' berubah
            $('#status').on('change', function() {
                table.draw(); // Redraw tabel dengan data yang difilter
            });
        });
    </script>

    <script type="text/javascript">
        function cekKode(kodePinjam) {
            // Jika panjang kode cukup, misalnya 11 karakter, lakukan aksi
            if (kodePinjam.length === 11) {
                // Bisa gunakan AJAX untuk cek kode ke server
                $.ajax({
                    url: "<?= base_url('peminjaman/cek_kode') ?>",
                    type: "POST",
                    data: {
                        kode_pinjam: kodePinjam
                    }, // Kirim kode_pinjam ke server
                    success: function(response) {
                        // Pastikan response adalah objek JSON
                        var result = JSON.parse(response);

                        // Periksa status yang diterima
                        if (result.status === 'finished') {
                            notifier.show('Info!', result.message, 'info', '', 4000); // Menampilkan notifikasi selesai
                        } else if (result.status === 'valid') {
                            notifier.show('Success!', 'Kode valid. Mengarahkan ke halaman detail...', 'success', '', 4000);

                            setTimeout(function() {
                                window.location.href = "<?= base_url('peminjaman/detail/') ?>" + kodePinjam;
                            }, 2000);
                        } else {
                            // Jika kode tidak valid, tampilkan pesan error
                            notifier.show('Error!', 'Kode tidak valid, silakan coba lagi.', 'danger', '', 4000);
                        }
                    },
                    error: function() {
                        // Jika ada masalah dalam request AJAX
                        notifier.show('Error!', 'Gagal memeriksa kode, silakan coba lagi.', 'danger', '', 4000);
                    }
                });
            }
        }

        let html5QrcodeScanner;
        $(document).on("click", ".btn-pindai", function() {
            // Tampilkan modal
            $('#pindaiModal').modal('show');

            // Function to handle successful QR code scan
            function onScanSuccess(decodedText, decodedResult) {
                // Set the scanned code into the input field
                $('#kode_pinjam').val(decodedText);

                // Stop the QR code scanner
                html5QrcodeScanner.clear().then(() => {
                    // QR code scanning is cleared and modal closed
                    $('#pindaiModal').modal('hide');

                    // Notifikasi jika scan berhasil
                    notifier.show('Success!', 'QR-Code berhasil dipindai.', 'success', '', 4000);

                    // Cek kode
                    cekKode(decodedText);

                }).catch(error => {
                    console.error('Failed to clear scanner. Reason: ', error);
                    // notifier.show('Error!', 'QR-Code gagal dipindai.', 'eroor', '', 4000);

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

        // Jika input kode_pinjam
        $(document).ready(function() {
            // Event ketika input 'kode_pinjam' berubah (menggunakan 'keyup')
            $('#kode_pinjam').on('keyup', function() {
                var kodePinjam = $(this).val(); // Mengambil nilai dari input
                cekKode(kodePinjam);
            });
        });
    </script>





</body>
<!-- [Body] end -->

</html>