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
                                <h2 class="mb-0">Detail <?= $title ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->


            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <!-- <h5 class="mb-3 mb-sm-0">Detail <?= $title ?></h5> -->
                                <a href="<?= base_url('anggota') ?>" class="btn btn-light-primary m-0"><span class="fa fa-arrow-left mt-1"></span>&nbsp; Kembali</a>

                                <div>
                                    <a href="<?= base_url('anggota/cetak_kartu/' . $anggota->kode) ?>" class="btn btn-light-danger m-0" target="_blank"><span class="fa fa-print"></span> &nbsp; Cetak Kartu Anggota</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Informasi anggota -->
                                <div class=" col-md-12">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th>Nama</th>
                                            <th width="3%">:</th>
                                            <td><?= $anggota->name ?></td>
                                        </tr>
                                        <tr>
                                            <th>NISN</th>
                                            <th width="3%">:</th>
                                            <td><?= $anggota->nisn ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir</th>
                                            <th width="3%">:</th>
                                            <td><?= date('d M Y', strtotime($anggota->tgl_lahir)) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <th width="3%">:</th>
                                            <td><?= $anggota->jk == 0 ? "Laki-laki" : "Perempuan" ?></td>
                                        </tr>
                                        <tr>
                                            <th>Telepon</th>
                                            <th width="3%">:</th>
                                            <td><?= $anggota->telp ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <th width="3%">:</th>
                                            <td><?= $anggota->alamat ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card shadow text-center">
                        <div class="card-body">
                            <h2>Qr Code</h2><br>
                            <small>KODE: <?= $anggota->kode ?></small>
                            <img src="<?= base_url('assets/qr-code/anggota/' . $anggota->kode . '.png') ?>" alt="QR Code" class="img-fluid">
                            <h4><?= $anggota->name ?></h4>
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
    <?php $this->load->view('component/alert'); ?>

</body>
<!-- [Body] end -->

</html>