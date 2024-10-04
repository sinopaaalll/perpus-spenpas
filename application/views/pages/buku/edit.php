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
                                    <a href="<?= base_url('buku') ?>" class="btn btn-light-primary m-0"><span class="fa fa-arrow-left mt-1"></span>&nbsp; Kembali</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('buku/edit/' . $buku->id) ?>" method="post" enctype="multipart/form-data">

                                <!-- Row for sampul preview and inputs (divided into two columns) -->
                                <div class="form-group">
                                    <div class="row">
                                        <!-- Left Column: Sampul Preview -->
                                        <div class="col-lg-4 col-md-4">
                                            <img id="preview" src="<?= base_url('assets/uploads/buku/' . $buku->sampul) ?>" alt="Preview Sampul" class="img-thumbnail" style="width:100%; height:auto; object-fit:cover; aspect-ratio: 3/4;">
                                        </div>

                                        <!-- Right Column: Input File, ISBN, Judul -->
                                        <div class="col-lg-8 col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">Sampul <small>(type: png, jpg, jpeg|Max size: 2MB)</small></label>
                                                <input type="file" name="sampul" id="sampul" class="form-control <?= form_error('sampul') ? "is-invalid" : "" ?>">
                                                <input type="hidden" name="old_sampul" value="<?= $buku->sampul ?>">
                                                <?= form_error('sampul', '<div class="invalid-feedback">', '</div>') ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">ISBN*</label>
                                                <input type="text" name="isbn" class="form-control <?= form_error('isbn') ? "is-invalid" : "" ?>" placeholder="ISBN : ex 978-602-8519-93-9" value="<?= $buku->isbn ?>">
                                                <?= form_error('isbn', '<div class="invalid-feedback">', '</div>') ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Judul*</label>
                                                <input type="text" name="judul" class="form-control <?= form_error('judul') ? "is-invalid" : "" ?>" placeholder="Judul" value="<?= $buku->judul ?>">
                                                <?= form_error('judul', '<div class="invalid-feedback">', '</div>') ?>
                                            </div>

                                            <div class="form-group mt-3">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label">Penulis*</label>
                                                        <input type="text" name="penulis" class="form-control <?= form_error('penulis') ? "is-invalid" : "" ?>" placeholder="Penulis" value="<?= $buku->penulis ?>">
                                                        <?= form_error('penulis', '<div class="invalid-feedback">', '</div>') ?>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Penerbit*</label>
                                                        <input type="text" name="penerbit" class="form-control <?= form_error('penerbit') ? "is-invalid" : "" ?>" placeholder="Penerbit" value="<?= $buku->penerbit ?>">
                                                        <?= form_error('penerbit', '<div class="invalid-feedback">', '</div>') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Row for Kategori and Stok -->
                                            <div class="form-group mt-3">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <label class="form-label">Tahun Terbit*</label>
                                                        <input type="number" name="tahun_terbit" class="form-control <?= form_error('tahun_terbit') ? "is-invalid" : "" ?>" placeholder="Tahun Terbit" value="<?= $buku->tahun_terbit ?>" min="1900" max="2100">
                                                        <?= form_error('tahun_terbit', '<div class="invalid-feedback">', '</div>') ?>
                                                    </div>

                                                    <div class="col-2">
                                                        <label class="form-label">Stok*</label>
                                                        <input type="number" name="stok" class="form-control <?= form_error('stok') ? "is-invalid" : "" ?>" placeholder="Stok" value="<?= $buku->stok ?>">
                                                        <?= form_error('stok', '<div class="invalid-feedback">', '</div>') ?>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Kategori*</label>
                                                        <select name="kategori" id="kategori" class="form-select">
                                                            <option value="0" disabled>Pilih Opsi</option>
                                                            <?php foreach ($kategori as $k) { ?>
                                                                <option value="<?= $k->id ?>" <?= $buku->kategori_id == $k->id ? "selected" : "" ?>><?= $k->name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <?= form_error('kategori', '<div class="invalid-feedback">', '</div>') ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group mt-4 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary"><span class="fa fa-save mt-1"></span>&nbsp; Ubah </button>
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

    <!-- Input mask Js -->
    <script src="<?= base_url('assets'); ?>/js/plugins/imask.min.js"></script>

    <script>
        var regExpMask = IMask(document.querySelector('.isbn'), {
            mask: '000-000-0000-00-0'
        });
        // JavaScript for Sampul preview
        document.getElementById('sampul').onchange = function(evt) {
            const [file] = this.files;
            if (file) {
                document.getElementById('preview').src = URL.createObjectURL(file);
            }
        };
    </script>

    <script>
        var isbnInput = document.querySelector("[name='isbn']");
        var maskOptions = {
            mask: '000-000-0000-00-0' // ISBN-13 format: 3 digits - 10 digits
        };
        var mask = IMask(isbnInput, maskOptions);
    </script>

</body>
<!-- [Body] end -->

</html>