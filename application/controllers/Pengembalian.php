<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Pengembalian extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Pengembalian_model');
        is_login();
    }

    public function index()
    {
        $params = array(
            'title' => "Pengembalian",
        );
        $this->load->view('pages/pengembalian/index', $params);
    }

    public function get_data_pengembalian()
    {
        // Data dari DataTables
        $search_value = $this->input->post('search')['value']; // Nilai pencarian
        $order_column = $this->input->post('order')[0]['column']; // Index kolom yang diurutkan
        $order_dir = $this->input->post('order')[0]['dir']; // Arah pengurutan (asc/desc)
        $limit = $this->input->post('length'); // Jumlah data yang diambil (pagination)
        $start = $this->input->post('start'); // Data mulai dari index berapa (pagination)

        // Ambil filter tanggal dan status dari input
        $tgl_kembali = $this->input->post('tgl_kembali'); // Tanggal kembali
        $status = $this->input->post('status'); // Status

        // Ambil data dari model dengan pagination, pencarian, sorting, dan filter
        $list = $this->Pengembalian_model->get_datatables($limit, $start, $search_value, $order_column, $order_dir, $tgl_kembali, $status);

        $data = array();
        foreach ($list as $peminjaman) {
            $row = array();
            $row['kode'] = '<a href="' . base_url('pengembalian/detail/' . $peminjaman->kode) . '"><span class="fa fa-qrcode"></span>&nbsp;' . $peminjaman->kode . '</a>';
            $row['anggota'] = $peminjaman->anggota;
            $row['tgl_kembali'] = date('d/m/Y', strtotime($peminjaman->tgl_kembali)); // Format tanggal

            // Badge status
            $row['status'] = $peminjaman->status == 2
                ? '<span class="badge bg-success">Dikembalikan</span>'
                : '<span class="badge bg-warning">Terlambat dikembalikan</span>';

            // Tombol aksi (kembalikan dan hapus)
            $row['aksi'] = '
                <ul class="list-inline me-auto mb-0">
                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" data-bs-original-title="Hapus" aria-label="Hapus">
                        <a href="' . base_url('pengembalian/hapus/' . $peminjaman->kode) . '" class="avtar avtar-xs btn-link-danger btn-pc-default btn-hapus">
                            <i class="ti ti-trash f-18"></i>
                        </a>
                    </li>
                </ul>';

            $data[] = $row;
        }

        // Response untuk DataTables
        $output = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $this->Pengembalian_model->count_all(),
            "recordsFiltered" => $this->Pengembalian_model->count_filtered($search_value, $tgl_kembali, $status),
            "data" => $data,
        );

        // Mengirimkan data dalam format JSON
        echo json_encode($output);
    }

    public function proses_kembali($kode)
    {
        $pinjam = $this->db->get_where('peminjaman', ['kode' => $kode])->result();
        $tgl_kembali = date('Y-m-d');

        foreach ($pinjam as $data) {

            $status = $data->status == 0 ? 2 : 3;
            $params = [
                'status' => $status,
                'tgl_kembali' => $tgl_kembali
            ];
            $this->db->update('peminjaman', $params,  ['id' => $data->id]);
        }

        $this->session->set_flashdata('success', 'Buku berhasil di kembalikan!');
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
            'title' => "Pengembalian",
            'peminjaman' => $peminjaman,
            'detail_buku' => $buku // Mengirimkan data buku ke view
        );
        $this->load->view('pages/pengembalian/view', $params);
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
        redirect('pengembalian');
    }
}
