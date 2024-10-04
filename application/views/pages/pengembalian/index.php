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

                <div class="col-lg-12">
                    <div class="card shadow">
                        <!-- <div class="card-header">
                            <h5 class="mb-3 mb-sm-0">Filter Tabel</h5>
                        </div> -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label">Tangal Kembali</label>
                                        <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" placeholder="Tanggal">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="ALL">Semua</option>
                                            <option value="2">Dikembalikan</option>
                                            <option value="3">Terlambat dikembalikan</option>
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

                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h5 class="mb-3 mb-sm-0">Data <?= $title ?></h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- <div class="table-responsive"> -->
                            <table class="table table-hover" id="dataTable-server">
                                <thead>
                                    <tr>
                                        <th>Kode Pinjam</th>
                                        <th>Nama Anggota</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <!-- data table server side -->
                                <tbody></tbody>
                            </table>
                            <!-- </div> -->
                        </div>
                    </div>

                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

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
                // "ordering": false,
                "ajax": {
                    "url": "<?= base_url('pengembalian/get_data_pengembalian') ?>",
                    "type": "POST",
                    "data": function(d) {
                        // Ambil nilai dari input tanggal dan status
                        d.tgl_kembali = $('#tgl_kembali').val();
                        d.status = $('#status').val();
                    }
                },
                "columns": [{
                        "data": "kode",
                    },
                    {
                        "data": "anggota"
                    },
                    {
                        "data": "tgl_kembali"
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
                $('#tgl_kembali').val('');
                $('#status').val('ALL');

                // Muat ulang DataTable seperti pertama kali halaman di-reload
                table.ajax.reload(null, false); // `null, false` agar posisi halaman tidak berubah
            });

            // Event ketika input tanggal 'tgl_kembali' berubah
            $('#tgl_kembali').on('change', function() {
                table.draw(); // Redraw tabel dengan data yang difilter
            });

            // Event ketika select 'status' berubah
            $('#status').on('change', function() {
                table.draw(); // Redraw tabel dengan data yang difilter
            });
        });
    </script>





</body>
<!-- [Body] end -->

</html>