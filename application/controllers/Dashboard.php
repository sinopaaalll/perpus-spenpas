<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        $total_buku = $this->db->count_all('buku');
        $total_anggota = $this->db->count_all('anggota');
        $total_kategori = $this->db->count_all('kategori');

        $this->db->select_sum('stok');
        $query = $this->db->get('buku');
        $total_stok =  $query->row()->stok ? $query->row()->stok : 0;

        $this->db->select('COUNT(DISTINCT kode) as total_peminjaman');
        $this->db->from('peminjaman');
        $query = $this->db->get();
        $total_peminjaman = $query->row()->total_peminjaman;

        $params = array(
            'title' => "Dashboard",
            'total_buku' => $total_buku,
            'total_kategori' => $total_kategori,
            'total_anggota' => $total_anggota,
            'total_peminjaman' => $total_peminjaman,
            'total_stok_buku' => $total_stok
        );
        $this->load->view('pages/dashboard/index', $params);
    }
}
