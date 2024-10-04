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
                                <h2 class="mb-0">Edit <?= $title ?></h2>
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
                                    <a href="<?= base_url('kategori') ?>" class="btn btn-light-primary m-0"><span class="fa fa-arrow-left mt-1"></span>&nbsp; Kembali</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('kategori/edit/' . $kategori->id) ?>" method="post">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-lg-end">Kode *</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="kode" id="kode" class="form-control <?= form_error('kode') ? "is-invalid" : "" ?>" value="<?= $kategori->kode ?>">
                                        <?= form_error('kode', '<div class="invalid-feedback">', '</div>') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-lg-end">Nama Ketegori *</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="name" id="name" class="form-control <?= form_error('name') ? "is-invalid" : "" ?>" value="<?= $kategori->name ?>">
                                        <?= form_error('name', '<div class="invalid-feedback">', '</div>') ?>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-3 col-form-label"></div>
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary"><span class="fa fa-save mt-1"></span>&nbsp; Ubah </button>
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