<nav class="pc-sidebar <?= $this->uri->segment(1) == "peminjaman" ? "pc-sidebar-hide" : "" ?>">
    <div class="navbar-wrapper">
        <div class="m-header">
            <div class="row mt-2">
                <div class="col-3">
                    <a href="#" class="b-brand text-primary">
                        <!-- ========   Change your logo from here   ============ -->
                        <img src="<?= base_url('assets'); ?>/images/logo.png" style="width: 50px;" />
                        <!-- <span class="badge bg-light-success rounded-pill ms-2 theme-version"></span> -->
                    </a>
                </div>
                <div class="col-9">
                    <h4 class="mt-1">SMP Negeri 1 Pasawahan</h4>
                </div>
            </div>

        </div>
        <div class="navbar-content">
            <div class="card pc-user-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="<?= base_url('assets/uploads/user/' . get_user_info()->foto); ?>" alt="user-image" class="user-avtar wid-45 rounded-circle" />
                        </div>
                        <div class="flex-grow-1 ms-3 me-2">
                            <h6 class="mb-0"><?= get_user_info()->name ?></h6>
                            <small><?= $this->session->userdata('username') ?></small>
                        </div>
                        <a class="btn btn-icon btn-link-secondary avtar-s" data-bs-toggle="collapse" href="#pc_sidebar_userlink">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-sort-outline"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                        <div class="pt-3">
                            <a href="<?= base_url('user') ?>">
                                <i class="ti ti-user"></i>
                                <span>Profil Saya</span>
                            </a>
                            <a href="<?= base_url('login/logout') ?>">
                                <i class="ti ti-power"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="pc-navbar">
                <li class="pc-item <?= $this->uri->segment(1) == 'dashboard' ? "active" : "" ?>">
                    <a href="<?= base_url('dashboard'); ?>" class="pc-link">
                        <span class="pc-micon">
                            <span class="fa fa-home mt-1"></span>
                        </span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>Transaksi</label>
                    <i class="ti ti-brand-chrome"></i>
                </li>
                <li class="pc-item <?= $this->uri->segment(1) == 'peminjaman' ? "active" : "" ?>">
                    <a href="<?= base_url('peminjaman'); ?>" class="pc-link">
                        <span class="pc-micon">
                            <span class="fa fa-book-open mt-1"></span>
                        </span>
                        <span class="pc-mtext">Peminjaman</span>
                    </a>
                </li>
                <li class="pc-item <?= $this->uri->segment(1) == 'pengembalian' ? "active" : "" ?>">
                    <a href="<?= base_url('pengembalian'); ?>" class="pc-link">
                        <span class="pc-micon">
                            <span class="fa fa-exchange-alt mt-1"></span>
                        </span>
                        <span class="pc-mtext">Pengembalian</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>Master</label>
                    <i class="ti ti-brand-chrome"></i>
                </li>
                <li class="pc-item <?= $this->uri->segment(1) == 'anggota' ? "active" : "" ?>">
                    <a href="<?= base_url('anggota'); ?>" class="pc-link">
                        <span class="pc-micon">
                            <span class="fa fa-user-friends mt-1"></span>
                        </span>
                        <span class="pc-mtext">Anggota</span>
                    </a>
                </li>
                <li class="pc-item <?= $this->uri->segment(1) == 'buku' ? "active" : "" ?>">
                    <a href="<?= base_url('buku'); ?>" class="pc-link">
                        <span class="pc-micon">
                            <span class="fa fa-book mt-1"></span>
                        </span>
                        <span class="pc-mtext">Buku</span>
                    </a>
                </li>
                <li class="pc-item <?= $this->uri->segment(1) == 'kategori' ? "active" : "" ?>">
                    <a href="<?= base_url('kategori'); ?>" class="pc-link">
                        <span class="pc-micon">
                            <span class="fa fa-tags mt-1"></span>
                        </span>
                        <span class="pc-mtext">Kategori</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Laporan</label>
                    <i class="ti ti-brand-chrome"></i>
                </li>
                <li class="pc-item <?= $this->uri->segment(1) == 'laporan' ? "active" : "" ?>">
                    <a href="<?= base_url('laporan'); ?>" class="pc-link">
                        <span class="pc-micon">
                            <span class="fa fa-chart-pie mt-1"></span>
                        </span>
                        <span class="pc-mtext">Laporan Transaksi</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>