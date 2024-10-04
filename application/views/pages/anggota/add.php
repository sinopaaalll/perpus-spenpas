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
                                <h2 class="mb-0">Tambah <?= $title ?></h2>
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
                                <h5 class="mb-3 mb-sm-0">Form <?= $title ?>
                                    <br><small>* = field tidak boleh kosong</small>
                                </h5>
                                <div>
                                    <a href="<?= base_url('anggota') ?>" class="btn btn-light-primary m-0"><span class="fa fa-arrow-left mt-1"></span>&nbsp; Kembali</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('anggota/tambah') ?>" method="post">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-lg-end">Nama Lengkap *</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="name" id="name" class="form-control <?= form_error('name') ? "is-invalid" : "" ?>" placeholder="Nama Lengkap" value="<?= set_value('name') ?>">
                                        <?= form_error('name', '<div class="invalid-feedback">', '</div>') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-lg-end">NISN *</label>
                                    <div class="col-lg-6">
                                        <input type="number" name="nisn" id="nisn" class="form-control <?= form_error('nisn') ? "is-invalid" : "" ?>" placeholder="NISN" value="<?= set_value('nisn') ?>">
                                        <?= form_error('nisn', '<div class="invalid-feedback">', '</div>') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-lg-end">Tanggal Lahir *</label>
                                    <div class="col-lg-6">
                                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control <?= form_error('tgl_lahir') ? "is-invalid" : "" ?>" placeholder="Tanggal Lahir" value="<?= set_value('tgl_lahir') ?>">
                                        <?= form_error('tgl_lahir', '<div class="invalid-feedback">', '</div>') ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-lg-end">Jenis Kelamin *</label>
                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jk" id="jk1" value="0" checked="">
                                            <label class="form-check-label" for="jk1"> Laki-laki </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jk" id="jk2" value="1">
                                            <label class="form-check-label" for="jk2"> Perempuan </label>
                                        </div>
                                        <?= form_error('jk', '<div class="invalid-feedback">', '</div>') ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-lg-end">Telepon</label>
                                    <div class="col-lg-6">
                                        <input type="number" name="telp" id="telp" class="form-control" placeholder="Telepon">
                                        <small class="form-text text-muted">Format: 628xxxxxx</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-lg-end">Alamat</label>
                                    <div class="col-lg-6">
                                        <textarea name="alamat" id="alamat" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-3 col-form-label"></div>
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary"><span class="fa fa-save mt-1"></span>&nbsp; Simpan </button>
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