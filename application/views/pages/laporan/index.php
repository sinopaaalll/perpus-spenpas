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
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Laporan Transaksi Peminjaman Buku</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('laporan/peminjaman') ?>" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Tangal Awal</label>
                                            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Tangal Akhir</label>
                                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-end">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger"><span class="fa fa-file-pdf"></span>&nbsp; Export PDF</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Laporan Transaksi Pengembalian Buku</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('laporan/pengembalian') ?>" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Tangal Awal</label>
                                            <input type="date" name="tgl_awal1" id="tgl_awal1" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Tangal Akhir</label>
                                            <input type="date" name="tgl_akhir1" id="tgl_akhir1" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-end">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger .btn-export1"><span class="fa fa-file-pdf"></span>&nbsp; Export PDF</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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


</body>
<!-- [Body] end -->

</html>