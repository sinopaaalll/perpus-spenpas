<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Perpustakaan | <?= $title ?></title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="description" content="Able Pro is trending dashboard template made using Bootstrap 5 design framework. Able Pro is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
    <meta name="keywords" content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
    <meta name="author" content="Phoenixcoded"> -->

    <!-- [Favicon] icon -->
    <link rel="icon" href="<?= base_url('assets'); ?>/images/logo.svg" type="image/x-icon">
    <!-- [Font] Family -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/fonts/inter/inter.css" id="main-font-link" />

    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/fonts/tabler-icons.min.css" />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/fonts/feather.css" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/fonts/fontawesome.css" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/fonts/material.css" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/style.css" id="main-style-link" />
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/style-preset.css" />

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="auth-main">
        <div class="auth-wrapper v1">
            <div class="auth-form">
                <div class="card shadow my-5">
                    <div class="card-body">
                        <form action="<?= base_url('login') ?>" method="post">
                            <div class="text-center mb-4">
                                <a href="#"><img src="<?= base_url('assets'); ?>/images/logo.png" alt="img" style="width: 70px;"></a>
                            </div>
                            <h4 class="text-center f-w-500 mb-3">Login</h4>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control <?= form_error('username') ? "is-invalid" : "" ?>" id="username" name="username" placeholder="Username" value="<?= set_value('username') ?>" autofocus>
                                <?= form_error('username', '<div class="invalid-feedback">', '</div>') ?>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control <?= form_error('password') ? "is-invalid" : "" ?>" id="password" name="password" placeholder="Password">
                                <?= form_error('password', '<div class="invalid-feedback">', '</div>') ?>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- Required Js -->
    <script src="<?= base_url('assets'); ?>/js/plugins/popper.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/plugins/simplebar.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/plugins/bootstrap.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/fonts/custom-font.js"></script>
    <script src="<?= base_url('assets'); ?>/js/config.js"></script>
    <script src="<?= base_url('assets'); ?>/js/pcoded.js"></script>
    <script src="<?= base_url('assets'); ?>/js/plugins/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/plugins/sweetalert2.all.min.js"></script>

    <!-- [ Alert ] start -->
    <?php $this->load->view('component/alert'); ?>
    <!-- [ Alert ] start -->

</body>
<!-- [Body] end -->

</html>