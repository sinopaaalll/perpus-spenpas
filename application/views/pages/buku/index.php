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
                                    <a href="<?= base_url('buku/tambah') ?>" class="btn btn-light-primary m-0"><span class="fa fa-plus-circle mt-1"></span>&nbsp; Tambah <?= $title ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sampul</th>
                                            <th>Kode</th>
                                            <th>ISBN</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th class="text-center">Stok</th>
                                            <th class="text-center">Dipinjam</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($buku as $data) { ?>
                                            <tr>
                                                <td>
                                                    <img id="preview" src="<?= base_url('assets/uploads/buku/' . $data->sampul) ?>" alt="Preview Sampul" class="img-thumbnail" style="width:70px; height:auto; object-fit:cover; aspect-ratio: 3/4;">
                                                </td>
                                                <td>
                                                    <?= $data->kode ?>
                                                </td>
                                                <td><?= format_isbn($data->isbn) ?></td>
                                                <td><?= $data->judul ?></td>
                                                <td><?= $data->kategori ?></td>
                                                <td class="text-center"><?= $data->stok > 0 ?  $data->stok : '<span class="badge bg-danger">Tidak tersedia</span>' ?></td>
                                                <td class="text-center"><?= hitung_peminjaman($data->id) > 0 ? hitung_peminjaman($data->id) : '<span class="badge bg-primary">Tidak ada peminjaman</span>' ?></td>
                                                <td class="text-center">
                                                    <ul class="list-inline me-auto mb-0">
                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Detail" data-bs-original-title="Detail">
                                                            <a href="<?= base_url('buku/detail/' . $data->id) ?>" class="avtar avtar-xs btn-link-info btn-pc-default">
                                                                <i class="ti ti-eye f-18"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                                                            <a href="<?= base_url('buku/edit/' . $data->id) ?>" class="avtar avtar-xs btn-link-warning btn-pc-default">
                                                                <i class="ti ti-edit f-18"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Hapus" data-bs-original-title="Hapus">
                                                            <a href="<?= base_url('buku/hapus/' . $data->id) ?>" class="avtar avtar-xs btn-link-danger btn-pc-default btn-hapus">
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