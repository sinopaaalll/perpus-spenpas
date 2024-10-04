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

                <div class="col-md-12">
                    <div class="card shadow text-center">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <!-- <h5 class="mb-3 mb-sm-0">Detail <?= $title ?></h5> -->
                                <a href="<?= base_url('peminjaman') ?>" class="btn btn-light-primary m-0"> <span class="fa fa-arrow-left"></span>&nbsp; Kembali</a>

                                <div>
                                    <a href="<?= base_url('pengembalian/proses_kembali/' . $peminjaman->kode) ?>" class="btn btn-light-warning m-0 btn-kembalikan"><span class="fa fa-sign-in-alt"></span> &nbsp; Kembalikan Buku</a> &nbsp;
                                    <a href="<?= base_url('peminjaman/cetak_peminjaman/') . $peminjaman->kode ?>" class="btn btn-light-danger m-0" target="_blank"><span class="fa fa-print"></span> &nbsp; Cetak Transaksi Peminjaman</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow text-center">
                        <div class="card-body">
                            <h1>QR Code</h1><br>
                            <img src="<?= base_url('assets/qr-code/peminjaman/' . $peminjaman->kode . '.png') ?>" alt="QR Code" class="img-fluid">
                            <h3 class="display-6"><?= $peminjaman->kode ?></h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-6">
                            <div class="card shadow">
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="30%">Kode Pinjam</th>
                                            <th width="3%">:</th>
                                            <th><?= $peminjaman->kode ?></th>
                                        </tr>
                                        <tr>
                                            <th width="30%">Tanggal Pinjam</th>
                                            <th width="3%">:</th>
                                            <td><?= date("d/m/Y", strtotime($peminjaman->tgl_pinjam)) ?></td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Jatuh Tempo</th>
                                            <th width="3%">:</th>
                                            <td><?= date("d/m/Y", strtotime($peminjaman->tgl_tenggat)) ?></td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Lama Pinjam</th>
                                            <th width="3%">:</th>
                                            <td><?= $peminjaman->lama_pinjam ?> Hari</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>


                        </div>
                        <div class="col-6">
                            <div class="card shadow">
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="30%">Kode Anggota</th>
                                            <th width="3%">:</th>
                                            <th><?= $peminjaman->kode_anggota ?></th>
                                        </tr>
                                        <tr>
                                            <th width="30%">Nama Anggota</th>
                                            <th width="3%">:</th>
                                            <td><?= $peminjaman->nama_anggota ?></td>
                                        </tr>
                                        <tr>
                                            <th width="30%">NISN</th>
                                            <th width="3%">:</th>
                                            <td><?= $peminjaman->nisn ?></td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Telepon</th>
                                            <th width="3%">:</th>
                                            <td><?= $peminjaman->telp ? $peminjaman->telp : "-" ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="20%">Status</th>
                                    <th width="3%">:</th>
                                    <td>
                                        <?php if ($peminjaman->status == 0): ?>
                                            <span class="badge bg-primary">Dipinjam</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning">Jatuh Tempo</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="20%">Tanggal Kembali</th>
                                    <th width="3%">:</th>
                                    <td><?= $peminjaman->tgl_kembali != NULL ? date("d/m/Y", strtotime($peminjaman->tgl_kembali)) : '<span class="badge bg-danger">Belum dikembalikan</span>' ?></td>
                                </tr>
                                <tr>
                                    <th width="20%">Data Buku</th>
                                    <th width="3%">:</th>
                                    <td>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Judul</th>
                                                    <th>Penerbit</th>
                                                    <th>Tahun</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                foreach ($detail_buku as $buku) { ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $buku->judul ?></td>
                                                        <td><?= $buku->penerbit ?></td>
                                                        <td><?= $buku->tahun_terbit ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>

                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

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