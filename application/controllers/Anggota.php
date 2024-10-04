<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Anggota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        $params = array(
            'title' => "Anggota",
            'anggota' => $this->db->get('anggota')->result()
        );
        $this->load->view('pages/anggota/index', $params);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('nisn', 'NISN', 'required|is_unique[anggota.nisn]', array(
            'required' => '%s tidak boleh kosong',
            'is_unique' => '%s sudah ada, silahkan inputkan yang lain'
        ));
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));

        if ($this->form_validation->run() == FALSE) {
            $params = array(
                'title' => "Anggota",
            );
            $this->load->view('pages/anggota/add', $params);
        } else {
            $name = htmlspecialchars($this->input->post('name'));
            $nisn = htmlspecialchars($this->input->post('nisn'));
            $tgl_lahir = $this->input->post('tgl_lahir');
            $jk = $this->input->post('jk');
            $telp = $this->input->post('telp');
            $alamat = htmlspecialchars($this->input->post('alamat'));

            // Query untuk mendapatkan kode terbesar
            $this->db->select_max('kode');
            $this->db->like('kode', 'AG', 'after'); // Mencari kode yang dimulai dengan 'AG'
            $last_data = $this->db->get('anggota')->row(); // Ganti 'siswa' dengan nama tabel Anda

            // Jika ada data dengan kode terbesar, ambil nomor urutnya
            if ($last_data && !empty($last_data->kode)) {
                // Ambil 4 digit terakhir dari kode (nomor urut)
                $last_number = (int)substr($last_data->kode, -4);
                $kode_number = str_pad($last_number + 1, 4, '0', STR_PAD_LEFT); // Tambah 1 untuk kode berikutnya
            } else {
                // Jika belum ada data, mulai dari 0001
                $kode_number = '0001';
            }

            // Membuat kode dengan format AG0001
            $kode = 'AG' . $kode_number;

            $data = array(
                'kode' => $kode,
                'name' => $name,
                'nisn' => $nisn,
                'tgl_lahir' => $tgl_lahir,
                'jk' => $jk,
                'telp' => $telp,
                'alamat' => $alamat,
            );

            $insert = $this->db->insert('anggota', $data);
            if ($insert) {

                // Generate QR Code
                $this->generate_qrcode($data['kode']);

                $this->session->set_flashdata('success', 'Data berhasil di simpan!');
                redirect('anggota');
            }
        }
    }

    public function detail($id)
    {
        $anggota = $this->db->get_where('anggota', array('id' => $id))->row();

        $params = array(
            'title' => "Anggota",
            'anggota' => $anggota
        );
        $this->load->view('pages/anggota/view', $params);
    }

    public function edit($id)
    {
        $anggota = $this->db->get_where('anggota', array('id' => $id))->row();
        $this->form_validation->set_rules('name', 'Nama', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('nisn', 'NISN', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));

        if ($this->input->post('nisn') != $anggota->nisn) {
            $this->form_validation->set_rules('nisn', 'NISN', 'is_unique[anggota.nisn]', array(
                'is_unique' => '%s sudah ada, silahkan inputkan yang lain'
            ));
        }

        if ($this->form_validation->run() == FALSE) {
            $params = array(
                'title' => "Anggota",
                'anggota' => $anggota
            );
            $this->load->view('pages/anggota/edit', $params);
        } else {
            $name = htmlspecialchars($this->input->post('name'));
            $nisn = htmlspecialchars($this->input->post('nisn'));
            $tgl_lahir = $this->input->post('tgl_lahir');
            $jk = $this->input->post('jk');
            $telp = $this->input->post('telp');
            $alamat = htmlspecialchars($this->input->post('alamat'));

            $data = array(
                'name' => $name,
                'nisn' => $nisn,
                'tgl_lahir' => $tgl_lahir,
                'jk' => $jk,
                'telp' => $telp,
                'alamat' => $alamat,
            );

            $this->db->update('anggota', $data, array('id' => $id));
            $this->session->set_flashdata('success', 'Data berhasil di ubah!');
            redirect('anggota');
        }
    }

    public function hapus($id)
    {
        $anggota = $this->db->get_where('anggota', ['id' => $id])->row_array()['kode'];

        // Hapus file QR code dari folder qr-code
        $path_qr_code = 'assets/qr-code/anggota/' . $anggota . '.png';
        if (file_exists($path_qr_code)) {
            unlink($path_qr_code);
        }
        $this->db->delete('anggota', array('id' => $id));
        $this->session->set_flashdata('success', 'Data berhasil di hapus!');
        redirect('anggota');
    }

    public function cetak_kartu($kode)
    {
        $anggota = $this->db->get_where('anggota', ['kode' => $kode])->row();

        $data = [
            'anggota' => $anggota
        ];

        $this->load->view('pages/anggota/cetak', $data);
    }

    private function generate_qrcode($kode)
    {
        $this->load->library('ciqrcode'); // Memanggil library QR CODE

        // Konfigurasi QR code
        $config['cacheable']    = true;
        $config['cachedir']     = './assets/';
        $config['errorlog']     = './assets/';
        $config['imagedir']     = './assets/qr-code/anggota/'; // Direktori penyimpanan QR code
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

    public function get_data()
    {
        $kodeAnggota = $this->input->post('anggota');
        $today = date('Y-m-d'); // Ambil tanggal hari ini

        if ($kodeAnggota) {
            // Query untuk mengambil data anggota berdasarkan kode
            $this->db->where('kode', $kodeAnggota);
            $query = $this->db->get('anggota');

            if ($query->num_rows() > 0) {
                $data = $query->row_array();

                // **Langkah 1: Cek apakah ada peminjaman sebelumnya yang belum dikembalikan (tgl_kembali == NULL)**
                $this->db->where('anggota_id', $data['id']);
                $this->db->where('tgl_kembali IS NULL'); // Cek peminjaman dengan tgl_kembali NULL
                $peminjamanBelumKembali = $this->db->get('peminjaman');

                if ($peminjamanBelumKembali->num_rows() > 0) {
                    // **Jika anggota memiliki peminjaman yang belum dikembalikan**
                    echo json_encode([
                        'success' => false,
                        'message' => 'Anggota tersebut harus mengembalikan buku yang dipinjam sebelumnya, agar bisa meminjam buku baru.'
                    ]);
                } else {
                    // **Langkah 2: Cek apakah anggota sudah meminjam buku hari ini**
                    $this->db->where('anggota_id', $data['id']);
                    $this->db->where('DATE(tgl_pinjam)', $today); // Cek apakah ada peminjaman pada hari ini
                    $peminjamanToday = $this->db->get('peminjaman');

                    if ($peminjamanToday->num_rows() > 0) {
                        // Anggota sudah meminjam buku hari ini
                        echo json_encode([
                            'success' => false,
                            'message' => 'Anggota tersebut sudah meminjam buku hari ini dan tidak dapat meminjam lagi.'
                        ]);
                    } else {
                        // Anggota belum meminjam buku hari ini, kirimkan data anggota
                        echo json_encode([
                            'success' => true,
                            'data' => [
                                'id' => $data['id'],
                                'name' => $data['name'],           // Asumsikan 'name' adalah kolom di database
                                'nisn' => $data['nisn'],           // Asumsikan 'nisn' adalah kolom di database
                                'telp' => $data['telp'],           // Asumsikan 'telp' adalah kolom di database
                            ]
                        ]);
                    }
                }
            } else {
                // Data anggota tidak ditemukan
                echo json_encode(['success' => false, 'message' => 'Data anggota tidak ditemukan.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Kode anggota tidak valid.']);
        }
    }
}
