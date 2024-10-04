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
                <div class="col-sm-12">

                    <div class="card shadow">
                        <div class="card-header">

                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h5 class="mb-3 mb-sm-0">Data <?= $title ?></h5>
                                <div>
                                    <a href="<?= base_url('anggota/tambah') ?>" class="btn btn-light-primary m-0"><span class="fa fa-plus-circle mt-1"></span>&nbsp; Tambah <?= $title ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($anggota as $data) { ?>
                                            <tr>
                                                <td>
                                                    <a href="<?= base_url('anggota/detail/' . $data->id) ?>"><span class="fa fa-qrcode"></span>&nbsp; <?= $data->kode ?></a>
                                                </td>
                                                <td><?= $data->name ?></td>
                                                <td><?= $data->jk == 0 ? "Laki-laki" : "Perempuan" ?></td>
                                                <td><?= $data->alamat != "" ? $data->alamat : "-" ?></td>
                                                <td><?= $data->telp != "" ? $data->telp : "-" ?></td>
                                                <td class="text-center">
                                                    <ul class="list-inline me-auto mb-0">
                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                                                            <a href="<?= base_url('anggota/edit/' . $data->id) ?>" class="avtar avtar-xs btn-link-warning btn-pc-default">
                                                                <i class="ti ti-edit f-18"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Hapus" data-bs-original-title="Hapus">
                                                            <a href="<?= base_url('anggota/hapus/' . $data->id) ?>" class="avtar avtar-xs btn-link-danger btn-pc-default btn-hapus">
                                                                <i class="ti ti-trash f-18"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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