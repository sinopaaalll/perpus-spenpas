<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Peminjaman extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->library(array('cart'));
        $this->load->model('Peminjaman_model');
    }

    public function index()
    {
        $params = array(
            'title' => "Peminjaman",
        );
        $this->load->view('pages/peminjaman/index', $params);
    }

    public function get_data_peminjaman()
    {
        // Data dari DataTables
        $search_value = $this->input->post('search')['value']; // Nilai pencarian
        $order_column = $this->input->post('order')[0]['column']; // Index kolom yang diurutkan
        $order_dir = $this->input->post('order')[0]['dir']; // Arah pengurutan (asc/desc)
        $limit = $this->input->post('length'); // Jumlah data yang diambil (pagination)
        $start = $this->input->post('start'); // Data mulai dari index berapa (pagination)

        // Ambil filter tanggal dan status dari input
        $tgl_pinjam = $this->input->post('tgl_pinjam'); // Tanggal pinjam
        $status = $this->input->post('status'); // Status

        // Ambil data dari model dengan pagination, pencarian, sorting, dan filter
        $list = $this->Peminjaman_model->get_datatables($limit, $start, $search_value, $order_column, $order_dir, $tgl_pinjam, $status);

        $data = array();
        foreach ($list as $peminjaman) {
            $row = array();
            $row['kode'] = '<a href="' . base_url('peminjaman/detail/' . $peminjaman->kode) . '"><span class="fa fa-qrcode"></span>&nbsp;' . $peminjaman->kode . '</a>';
            $row['anggota'] = $peminjaman->anggota;
            $row['tgl_pinjam'] = date('d/m/Y', strtotime($peminjaman->tgl_pinjam)); // Format tanggal
            $row['tgl_tenggat'] = date('d/m/Y', strtotime($peminjaman->tgl_tenggat)); // Format tanggal

            // Badge status
            $row['status'] = $peminjaman->status == 0
                ? '<span class="badge bg-primary">Dipinjam</span>'
                : '<span class="badge bg-warning">Jatuh Tempo</span>';

            // Tombol aksi (kembalikan dan hapus)
            $row['aksi'] = '
                <ul class="list-inline me-auto mb-0">
                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" data-bs-original-title="Kembalikan Buku" aria-label="Kembalikan Buku">
                        <a href="' . base_url('pengembalian/proses_kembali/' . $peminjaman->kode) . '" class="avtar avtar-xs btn-link-warning btn-pc-default btn-kembalikan">
                            <i class="fa fa-lg fa-sign-in-alt"></i>
                        </a>
                    </li>
                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" data-bs-original-title="Hapus" aria-label="Hapus">
                        <a href="' . base_url('peminjaman/hapus/' . $peminjaman->kode) . '" class="avtar avtar-xs btn-link-danger btn-pc-default btn-hapus">
                            <i class="ti ti-trash f-18"></i>
                        </a>
                    </li>
                </ul>';

            $data[] = $row;
        }

        // Response untuk DataTables
        $output = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $this->Peminjaman_model->count_all(),
            "recordsFiltered" => $this->Peminjaman_model->count_filtered($search_value, $tgl_pinjam, $status),
            "data" => $data,
        );

        // Mengirimkan data dalam format JSON
        echo json_encode($output);
    }

    public function tambah()
    {
        if ($this->session->has_userdata('cart')) {
            // Unset session cart
            $this->session->unset_userdata('cart');
        }

        // Ambil data anggota dan buku
        $anggota = $this->db->get('anggota')->result();
        $buku = $this->db->get_where('buku', ['stok >' => 0])->result();


        // Query untuk mendapatkan kode terbesar dengan awalan 'PJ' dan tanggal hari ini
        $this->db->select_max('kode');
        $this->db->like('kode', 'PJ' . date('ymd'), 'after'); // Cari kode yang dimulai dengan 'PJ' dan tanggal hari ini
        $last_data = $this->db->get('peminjaman')->row();

        // Jika ada data dengan kode terbesar, ambil nomor urutnya
        if ($last_data && !empty($last_data->kode)) {
            // Ambil 3 digit terakhir dari kode (nomor urut)
            $last_number = (int)substr($last_data->kode, -3);
            $kode_number = str_pad($last_number + 1, 3, '0', STR_PAD_LEFT); // Tambah 1 untuk kode berikutnya
        } else {
            // Jika belum ada data, mulai dari 001
            $kode_number = '001';
        }

        // Buat kode peminjaman baru
        $kode = 'PJ' . date('ymd') . $kode_number; // Contoh: PJ240901001

        // Kirim data ke view
        $params = array(
            'title' => "Peminjaman",
            'anggota' => $anggota,
            'buku' => $buku,
            'kode_peminjaman' => $kode, // Kirim kode otomatis ke view
        );
        $this->load->view('pages/peminjaman/add', $params);
    }

    public function proses_tambah()
    {
        $post = $this->input->post();


        $tgl = date('Y-m-d');
        $tgl2 = date('Y-m-d', strtotime('+' . $post['lama_pinjam'] . ' days', strtotime($tgl)));

        // var_dump($tgl2);
        // die();
        $hasil_cart = array_values(unserialize($this->session->userdata('cart')));
        foreach ($hasil_cart as $isi) {
            $data[] = array(
                'kode' => htmlentities($post['kode']),
                'anggota_id' => htmlentities($post['anggota_id']),
                'buku_id' => $isi['id'],
                'status' => 0,
                'tgl_pinjam' => $tgl,
                'lama_pinjam' => $post['lama_pinjam'],
                'tgl_tenggat'  => $tgl2
            );
        }
        $total_array = count($data);
        if ($total_array != 0) {
            $insert = $this->db->insert_batch('peminjaman', $data);

            if ($insert) {
                // Generate QR Code
                $this->generate_qrcode($post['kode']);
            }

            $cart = array_values(unserialize($this->session->userdata('cart')));
            for ($i = 0; $i < count($cart); $i++) {
                // unset($cart[$i]);
                // $this->session->unset_userdata($cart[$i]);
                $this->session->unset_userdata('cart');
            }
        }

        $this->session->set_flashdata('success', 'Data berhasil di simpan!');
        redirect('peminjaman');
    }

    public function detail($kode)
    {
        // Query untuk mengambil data peminjaman
        $query = $this->db->query("SELECT a.kode, a.anggota_id, a.status, a.tgl_pinjam, a.lama_pinjam, a.tgl_tenggat, a.tgl_kembali, 
            b.name as nama_anggota, b.kode as kode_anggota, b.telp, b.nisn
        FROM peminjaman a
        JOIN anggota b ON b.id = a.anggota_id
        WHERE a.kode = '$kode' ");

        $peminjaman = $query->row();

        // Cek apakah peminjaman ada
        if ($peminjaman) {
            // Ambil semua buku yang terkait dengan peminjaman ini
            $pin = $this->db->get_where('peminjaman', ['kode' => $peminjaman->kode])->result();
            $buku = [];
            foreach ($pin as $p) {
                $query_buku = $this->db->get_where('buku', ['id' => $p->buku_id])->row();
                if ($query_buku) {
                    $buku[] = $query_buku; // Tambahkan buku yang ditemukan ke dalam array
                }
            }
        } else {
            $buku = []; // Jika tidak ada peminjaman, set buku sebagai array kosong
        }

        // var_dump($buku);
        // die();

        // Kirim data ke view
        $params = array(
            'title' => "Peminjaman",
            'peminjaman' => $peminjaman,
            'detail_buku' => $buku // Mengirimkan data buku ke view
        );
        $this->load->view('pages/peminjaman/view', $params);
    }

    public function hapus($kode)
    {
        // Hapus file QR code dari folder qr-code
        $path_qr_code = 'assets/qr-code/peminjaman/' . $kode . '.png';
        if (file_exists($path_qr_code)) {
            unlink($path_qr_code);
        }
        $this->db->delete('peminjaman', array('kode' => $kode));
        $this->session->set_flashdata('success', 'Data berhasil di hapus!');
        redirect('peminjaman');
    }

    public function cek_kode()
    {
        // Pastikan request yang diterima adalah AJAX
        if ($this->input->is_ajax_request()) {
            // Ambil kode_pinjam dari input POST
            $kode_pinjam = $this->input->post('kode_pinjam');

            // Query untuk mengambil data peminjaman
            $this->db->where('kode', $kode_pinjam);
            $query = $this->db->get('peminjaman');
            $peminjaman = $query->row();

            // Menggunakan num_rows untuk mengecek apakah ada hasil
            if ($peminjaman) {
                // Jika tgl_kembali tidak null, berarti peminjaman telah selesai
                if ($peminjaman->tgl_kembali != null) {
                    echo json_encode([
                        'status' => 'finished',
                        'message' => 'Peminjaman selesai, buku telah dikembalikan.',
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'valid',
                    ]);
                }
            } else {
                // Jika tidak ditemukan, kirim respon invalid
                echo json_encode(['status' => 'invalid']);
            }
        } else {
            // Tampilkan halaman error jika bukan AJAX request
            show_404();
        }
    }


    public function cetak_peminjaman($kode)
    {
        // Query untuk mengambil data peminjaman
        $query = $this->db->query("SELECT a.kode, a.anggota_id, a.status, a.tgl_pinjam, a.lama_pinjam, a.tgl_tenggat, a.tgl_kembali, 
            b.name as nama_anggota, b.kode as kode_anggota, b.telp, b.nisn
        FROM peminjaman a
        JOIN anggota b ON b.id = a.anggota_id
        WHERE a.kode = '$kode' ");

        $peminjaman = $query->row();

        // Cek apakah peminjaman ada
        if ($peminjaman) {
            // Ambil semua buku yang terkait dengan peminjaman ini
            $pin = $this->db->get_where('peminjaman', ['kode' => $peminjaman->kode])->result();
            $buku = [];
            foreach ($pin as $p) {
                $query_buku = $this->db->get_where('buku', ['id' => $p->buku_id])->row();
                if ($query_buku) {
                    $buku[] = $query_buku; // Tambahkan buku yang ditemukan ke dalam array
                }
            }
        } else {
            $buku = []; // Jika tidak ada peminjaman, set buku sebagai array kosong
        }

        // var_dump($buku);
        // die();

        // Kirim data ke view
        $params = array(
            'title' => "Peminjaman",
            'peminjaman' => $peminjaman,
            'detail_buku' => $buku // Mengirimkan data buku ke view
        );
        $this->load->view('pages/peminjaman/cetak', $params);
    }

    public function buku()
    {
        $kode = $this->input->post('kode_buku');
        $row = $this->db->query("SELECT * FROM buku WHERE kode ='$kode'");

        if ($row->num_rows() > 0) {
            $tes = $row->row();
            $item = array(
                'id'      => $tes->id,
                'qty'     => 1,
                'price'   => '1000',
                'name'    => $tes->judul,
                'options' => array('isbn' => $tes->isbn, 'tahun_terbit' => $tes->tahun_terbit, 'penerbit' => $tes->penerbit)
            );
            if (!$this->session->has_userdata('cart')) {
                $cart = array($item);
                $this->session->set_userdata('cart', serialize($cart));
            } else {
                $index = $this->exists($tes->id);
                $cart = array_values(unserialize($this->session->userdata('cart')));
                if ($index == -1) {
                    array_push($cart, $item);
                    $this->session->set_userdata('cart', serialize($cart));
                } else {
                    $cart[$index]['quantity']++;
                    $this->session->set_userdata('cart', serialize($cart));
                }
            }
        } else {
        }
    }

    public function buku_list()
    {
        $this->load->view('pages/peminjaman/buku_list');
    }

    public function del_cart()
    {
        error_reporting(0);
        $id = $this->input->post('buku_id');
        $index = $this->exists($id);
        $cart = array_values(unserialize($this->session->userdata('cart')));
        unset($cart[$index]);
        $this->session->set_userdata('cart', serialize($cart));
        // redirect('jual/tambah');
        echo '<script>$("#result_buku").load("' . base_url('peminjaman/buku_list') . '");</script>';
    }

    private function exists($id)
    {
        $cart = array_values(unserialize($this->session->userdata('cart')));
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id'] == $id) {
                return $i;
            }
        }
        return -1;
    }

    private function generate_qrcode($kode)
    {
        $this->load->library('ciqrcode'); // Memanggil library QR CODE

        // Konfigurasi QR code
        $config['cacheable']    = true;
        $config['cachedir']     = './assets/';
        $config['errorlog']     = './assets/';
        $config['imagedir']     = './assets/qr-code/peminjaman/'; // Direktori penyimpanan QR code
        $config['quality']      = true;
        $config['size']         = '1024'; // Ukuran QR code
        $config['black']        = array(0, 0, 0); // Warna QR code (hitam)
        $config['white']        = array(255, 255, 255); // Warna background (putih)

        $this->ciqrcode->initialize($config);

        $image_name = $kode . '.png'; // Nama file QR code

        // Data yang akan dijadikan QR code
        $params = [
            'data' => $kode,
            'level' => 'H', // Tingkat koreksi kesalahan
            'size' => 10, // Ukuran modul QR code
            'version' => 5, // Versi QR code
            'savename' => FCPATH . $config['imagedir'] . $image_name, // Menyimpan QR code
        ];

        // Generate QR code
        $this->ciqrcode->generate($params);

        // Menambahkan border atau padding
        $this->addBorder($config['imagedir'] . $image_name, 10); // Misalnya 10 piksel padding

        // Path ke logo sekolah yang akan dimasukkan ke QR code
        $logo_path = FCPATH . 'assets/images/logo.png'; // Sesuaikan path logo
        if (file_exists($logo_path)) {
            // Menggabungkan QR code dan logo
            $this->combine_qr_with_logo(FCPATH . $config['imagedir'] . $image_name, $logo_path);
        }

        return FCPATH . $config['imagedir'] . $image_name;
    }

    // Fungsi untuk menambahkan border/padding
    private function addBorder($filename, $padding)
    {
        // Load image
        $image = imagecreatefrompng($filename);
        if (!$image) {
            return; // Jika gagal memuat gambar, keluar dari fungsi
        }

        $width = imagesx($image);
        $height = imagesy($image);

        // Buat gambar baru dengan border/padding
        $new_width = $width + $padding * 2;
        $new_height = $height + $padding * 2;

        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Mengatur warna untuk border (putih dalam contoh ini)
        $border_color = imagecolorallocate($new_image, 255, 255, 255);
        imagefill($new_image, 0, 0, $border_color);

        // Salin gambar QR code ke dalam gambar baru dengan padding
        imagecopy($new_image, $image, $padding, $padding, 0, 0, $width, $height);

        // Simpan gambar baru
        imagepng($new_image, $filename);

        // Hapus gambar dari memori
        imagedestroy($image);
        imagedestroy($new_image);
    }

    // Fungsi untuk menggabungkan QR code dengan logo
    private function combine_qr_with_logo($qr_code_path, $logo_path)
    {
        // Load QR code dan logo menggunakan GD library
        $qr_code = imagecreatefrompng($qr_code_path);
        if (!$qr_code) {
            return; // Jika gagal memuat QR code, keluar dari fungsi
        }

        $logo = imagecreatefrompng($logo_path);
        if (!$logo) {
            imagedestroy($qr_code); // Hapus QR code dari memori jika gagal memuat logo
            return;
        }

        // Mendapatkan ukuran dari QR code dan logo
        $qr_width = imagesx($qr_code);
        $qr_height = imagesy($qr_code);
        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);

        // Menentukan ukuran logo di QR code (misalnya 20% dari ukuran QR code)
        $logo_qr_width = $qr_width * 0.2;
        $logo_qr_height = $qr_height * 0.2;

        // Menentukan posisi logo di tengah QR code
        $logo_qr_x = ($qr_width / 2) - ($logo_qr_width / 2);
        $logo_qr_y = ($qr_height / 2) - ($logo_qr_height / 2);

        // Menggabungkan logo dengan QR code
        imagecopyresampled($qr_code, $logo, $logo_qr_x, $logo_qr_y, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

        // Menyimpan QR code yang sudah digabungkan dengan logo
        imagepng($qr_code, $qr_code_path);

        // Hapus resource gambar dari memori
        imagedestroy($qr_code);
        imagedestroy($logo);
    }
}
