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
                    <div class="card">
                        <div class="card-body py-0">
                            <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1" role="tab"
                                        aria-selected="true">
                                        <i class="ti ti-user me-2"></i>Profile
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                            <form action="<?= base_url('user') ?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body position-relative">
                                                <div class="position-absolute end-0 top-0 p-3">
                                                    <!-- <span class="badge bg-primary">Pro</span> -->
                                                </div>
                                                <div class="text-center mt-3">
                                                    <div class="chat-avtar d-inline-flex mx-auto">
                                                        <img class="rounded-circle img-fluid wid-70" src="<?= base_url('assets/uploads/user/' . $user->foto) ?>"
                                                            alt="User image">
                                                    </div>
                                                    <h5 class="mb-0"><?= $user->name ?></h5>
                                                    <p class="text-muted text-sm"><?= $user->username ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Edit Profil</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Username</label>
                                                            <input type="text" class="form-control <?= form_error('username') ? "is-invalid" : "" ?>" name="username" value="<?= $user->username ?>" readonly>
                                                            <?= form_error('username', '<div class="invalid-feedback">', '</div>') ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Nama</label>
                                                            <input type="text" class="form-control <?= form_error('name') ? "is-invalid" : "" ?>" name="name" value="<?= $user->name ?>">
                                                            <?= form_error('name', '<div class="invalid-feedback">', '</div>') ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Password</label>
                                                            <input type="password" class="form-control <?= form_error('password') ? "is-invalid" : "" ?>" name="password" placeholder="Ketikkan Password">
                                                            <?= form_error('password', '<div class="invalid-feedback">', '</div>') ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Konfirmasi Password</label>
                                                            <input type="password" class="form-control" name="password_conf" placeholder="Ketikkan Konfirmasi Password">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Foto</label>
                                                            <input type="file" class="form-control" name="foto">
                                                            <input type="hidden" class="form-control" name="old_foto" value="<?= $user->foto ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-end btn-page">
                                        <button type="submit" class="btn btn-primary">Ubah Profil</button>
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

    <!-- [ Alert ] start -->
    <?php $this->load->view('component/alert'); ?>
    <!-- [ Alert ] start -->


</body>
<!-- [Body] end -->

</html>