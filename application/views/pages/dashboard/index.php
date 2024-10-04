<!DOCTYPE html>
<html lang="en">

<!-- [Head] start -->

<head>
    <?php $this->load->view('component/header'); ?>
</head>
<!-- [Head] end -->

<!-- [Body] Start -->

<body data-pc-preset="preset-3">
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
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-1"><?= $total_buku; ?></h3>
                                    <p class="text-muted mb-0">Buku</p>
                                </div>
                                <div class="col-4 text-end">
                                    <i class="ti ti-book text-danger f-36"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-1"><?= $total_stok_buku; ?></h3>
                                    <p class="text-muted mb-0">Stok Buku</p>
                                </div>
                                <div class="col-4 text-end">
                                    <i class="ti ti-archive text-warning f-36"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-1"><?= $total_kategori; ?></h3>
                                    <p class="text-muted mb-0">Kategori</p>
                                </div>
                                <div class="col-4 text-end">
                                    <i class="ti ti-tag text-info f-36"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-1"><?= $total_anggota; ?></h3>
                                    <p class="text-muted mb-0">Anggota</p>
                                </div>
                                <div class="col-4 text-end">
                                    <i class="ti ti-users text-primary f-36"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-1"><?= $total_peminjaman; ?></h3>
                                    <p class="text-muted mb-0">Transaksi Peminjaman & Pengembalian</p>
                                </div>
                                <div class="col-4 text-end">
                                    <i class="ti ti-activity text-secondary f-36"></i>
                                </div>
                            </div>
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

    <!-- [ Alert ] start -->
    <?php $this->load->view('component/alert'); ?>
    <!-- [ Alert ] start -->


</body>
<!-- [Body] end -->

</html>