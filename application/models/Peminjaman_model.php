<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi yang digunakan untuk membangun query untuk datatables
    private function _get_datatables_query($search_value = null, $order_column = null, $order_dir = 'desc', $tgl_pinjam = null, $status = null)
    {
        // Select kolom yang dibutuhkan
        $this->db->distinct();
        $this->db->select('peminjaman.kode, peminjaman.tgl_pinjam, peminjaman.tgl_tenggat, peminjaman.status, anggota.name as anggota');
        $this->db->from('peminjaman');
        $this->db->join('anggota', 'anggota.id = peminjaman.anggota_id');
        $this->db->where_not_in('peminjaman.status', [2, 3]);

        // Jika ada pencarian (searching)
        if ($search_value) {
            $this->db->group_start(); // buka group untuk query LIKE
            $this->db->like('peminjaman.kode', $search_value);
            $this->db->or_like('anggota.name', $search_value);
            $this->db->group_end(); // tutup group
        }

        // Filter berdasarkan tanggal pinjam jika tersedia
        if ($tgl_pinjam) {
            $this->db->where('peminjaman.tgl_pinjam', $tgl_pinjam);
        }

        // Filter berdasarkan status jika tersedia
        if ($status == 'ALL') {
            $this->db->where_in('peminjaman.status', [0, 1]);
        } else {
            $this->db->where('peminjaman.status', $status);
        }

        // Jika ada order
        if ($order_column && $order_dir) {
            $this->db->order_by($order_column, $order_dir);
        } else {
            // Default order
            $this->db->order_by('peminjaman.kode', 'desc');
        }
    }

    // Fungsi untuk mengambil data yang akan ditampilkan di DataTables
    function get_datatables($limit = -1, $start = 0, $search_value = null, $order_column = null, $order_dir = 'desc', $tgl_pinjam = null, $status = null)
    {
        // Set up query untuk datatables
        $this->_get_datatables_query($search_value, $order_column, $order_dir, $tgl_pinjam, $status);

        // Jika ada batasan limit (pagination)
        if ($limit != -1) {
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();
        return $query->result();
    }

    // Fungsi untuk menghitung jumlah data yang sesuai dengan filter
    function count_filtered($search_value = null, $tgl_pinjam = null, $status = null)
    {
        $this->_get_datatables_query($search_value, null, 'desc', $tgl_pinjam, $status);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // Fungsi untuk menghitung total data tanpa filter
    public function count_all()
    {
        $this->db->from('peminjaman');
        return $this->db->count_all_results();
    }
}
