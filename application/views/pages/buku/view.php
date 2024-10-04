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
                                <h2 class="mb-0">Detial <?= $title ?></h2>
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
                                <!-- <h5 class="mb-3 mb-sm-0">Detail <?= $title ?></h5> -->
                                <a href="<?= base_url('buku') ?>" class="btn btn-light-primary m-0"><span class="fa fa-arrow-left mt-1"></span>&nbsp; Kembali</a>

                                <div>

                                    <ul class="list-inline me-auto mb-0">
                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                                            <a href="<?= base_url('buku/edit/' . $buku->id) ?>" class="avtar avtar-xs btn-link-warning btn-pc-default">
                                                <i class="ti ti-edit f-18"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Hapus" data-bs-original-title="Hapus">
                                            <a href="<?= base_url('buku/hapus/' . $buku->id) ?>" class="avtar avtar-xs btn-link-danger btn-pc-default btn-hapus">
                                                <i class="ti ti-trash f-18"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Gambar Sampul -->
                                <div class="col-md-4 text-center">
                                    <img id="preview" src="<?= base_url('assets/uploads/buku/' . $buku->sampul) ?>" alt="Preview Sampul" class="img-fluid w-75" style="object-fit:cover; aspect-ratio: 3/4;">
                                </div>
                                <!-- Informasi Buku -->
                                <div class=" col-md-8">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th>Kode</th>
                                            <td><?= $buku->kode ?></td>
                                        </tr>
                                        <tr>
                                            <th>ISBN</th>
                                            <td><?= format_isbn($buku->isbn) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Judul</th>
                                            <td><?= $buku->judul ?></td>
                                        </tr>

                                        <tr>
                                            <th>Penulis</th>
                                            <td><?= $buku->penulis ?></td>
                                        </tr>
                                        <tr>
                                            <th>Penerbit</th>
                                            <td><?= $buku->penerbit ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tahun Terbit</th>
                                            <td><?= $buku->tahun_terbit ?></td>
                                        </tr>
                                        <tr>
                                            <th>Stok</th>
                                            <td><?= $buku->stok ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kategori</th>
                                            <td><?= $buku->kategori ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-sm-4">
                    <div class="card shadow text-center">
                        <div class="card-body">
                            <h2>Qr Code</h2><br>
                            <small>KODE: <?= $buku->kode ?></small>
                            <img src="<?= base_url('assets/qr-code/buku/' . $buku->kode . '.png') ?>" alt="QR Code" class="img-fluid">
                        </div>
                        <div class="card-footer">
                            <a href="" class="btn btn-sm btn-light"><span class="fa fa-print"></span> Cetak</a>
                        </div>
                    </div>
                </div> -->

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