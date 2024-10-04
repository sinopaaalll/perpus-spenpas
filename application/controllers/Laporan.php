<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        $params = array(
            'title' => "Laporan Transaksi"
        );
        $this->load->view('pages/laporan/index', $params);
    }

    public function peminjaman()
    {
        $this->load->library('pdfgenerator');

        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        // Query untuk mengambil data peminjaman dengan filter tanggal dan status
        $this->db->distinct();
        $this->db->select('peminjaman.kode, peminjaman.tgl_pinjam, peminjaman.tgl_tenggat, peminjaman.status, anggota.name as anggota');
        $this->db->from('peminjaman');
        $this->db->join('anggota', 'anggota.id = peminjaman.anggota_id');
        $this->db->where_not_in('peminjaman.status', [2, 3]);
        $this->db->where('peminjaman.tgl_pinjam >=', $tgl_awal);  // Filter tanggal awal
        $this->db->where('peminjaman.tgl_pinjam <=', $tgl_akhir); // Filter tanggal akhir

        // Eksekusi query dan ambil hasilnya
        $data_laporan = $this->db->get()->result_array();

        // Data untuk dikirim ke view
        $data = [
            'title_pdf' => 'Laporan Peminjaman Buku',
            'laporan' => $data_laporan
        ];

        // Nama file PDF, ukuran kertas, dan orientasi
        $file_pdf = 'laporan_peminjaman';
        $paper = 'A4';
        $orientation = "portrait";

        // Load view sebagai HTML untuk PDF
        $html = $this->load->view('pages/laporan/laporan_peminjaman_pdf', $data, true);

        // Generate PDF menggunakan library pdfgenerator
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);

        // Redirect setelah PDF dibuat
        redirect('laporan');
    }

    public function pengembalian()
    {
        $this->load->library('pdfgenerator');

        $tgl_awal = $this->input->post('tgl_awal1');
        $tgl_akhir = $this->input->post('tgl_akhir1');

        // Query untuk mengambil data peminjaman dengan filter tanggal dan status
        $this->db->distinct();
        $this->db->select('peminjaman.kode, peminjaman.tgl_pinjam, peminjaman.tgl_kembali, peminjaman.status, anggota.name as anggota');
        $this->db->from('peminjaman');
        $this->db->join('anggota', 'anggota.id = peminjaman.anggota_id');
        $this->db->where_not_in('peminjaman.status', [0, 1]);
        $this->db->where('peminjaman.tgl_kembali >=', $tgl_awal);  // Filter tanggal awal
        $this->db->where('peminjaman.tgl_kembali <=', $tgl_akhir); // Filter tanggal akhir

        // Eksekusi query dan ambil hasilnya
        $data_laporan = $this->db->get()->result_array();

        // Data untuk dikirim ke view
        $data = [
            'title_pdf' => 'Laporan Pengembalian Buku',
            'laporan' => $data_laporan
        ];

        // Nama file PDF, ukuran kertas, dan orientasi
        $file_pdf = 'laporan_pengembalian';
        $paper = 'A4';
        $orientation = "portrait";

        // Load view sebagai HTML untuk PDF
        $html = $this->load->view('pages/laporan/laporan_pengembalian_pdf', $data, true);

        // Generate PDF menggunakan library pdfgenerator
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);

        // Redirect setelah PDF dibuat
        redirect('laporan');
    }
}
