<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('hitung_peminjaman')) {
    /**
     * Fungsi untuk menghitung jumlah peminjaman berdasarkan buku_id dan status
     *
     * @param int $buku_id
     * @return int
     */
    function hitung_peminjaman($buku_id)
    {
        $CI = &get_instance(); // Mendapatkan instance CodeIgniter
        $CI->load->database(); // Memastikan database telah dimuat

        // Melakukan query untuk menghitung jumlah peminjaman dengan status 0 (belum dikembalikan)
        $CI->db->where('buku_id', $buku_id);
        $CI->db->where_in('status', [0, 1]); // Status 0 berarti buku masih dipinjam
        $CI->db->from('peminjaman'); // Tabel peminjaman

        return $CI->db->count_all_results(); // Mengembalikan jumlah baris
    }
}

if (!function_exists('format_isbn')) {
    function format_isbn($isbn)
    {
        // Menghapus tanda hubung jika ada
        $isbn = str_replace('-', '', $isbn);

        // Memastikan ISBN memiliki panjang yang tepat (13 digit)
        if (strlen($isbn) != 13) {
            return $isbn; // Jika ISBN tidak sesuai panjang, tidak diformat
        }

        // Memformat ISBN menjadi '000-000-0000-00-0'
        $formatted_isbn = substr($isbn, 0, 3) . '-' . substr($isbn, 3, 3) . '-' . substr($isbn, 6, 4) . '-' . substr($isbn, 10, 2) . '-' . substr($isbn, 12, 1);

        return $formatted_isbn;
    }
}

if (!function_exists('is_login')) {
    /**
     * Check if the user is logged in.
     * If not, redirect to the login page.
     */
    function is_login()
    {
        $CI = &get_instance();

        // Mengecek apakah status pada session adalah "login"
        if ($CI->session->userdata('status') !== 'login') {
            // Redirect ke halaman login jika tidak login
            redirect('login');
            exit(); // Pastikan untuk menghentikan eksekusi setelah redirect
        }

        return true;
    }
}

if (!function_exists('is_not_login')) {
    /**
     * Check if the user is logged in.
     * If not, redirect to the not_login page.
     */
    function is_not_login()
    {
        $CI = &get_instance();

        // Mengecek apakah status pada session adalah "login"
        if ($CI->session->userdata('status') === 'login') {
            // Redirect ke halaman login jika tidak login
            redirect('dashboard');
            exit(); // Pastikan untuk menghentikan eksekusi setelah redirect
        }

        return true;
    }
}

if (!function_exists('get_user_info')) {
    function get_user_info()
    {
        $CI = &get_instance();  // Mendapatkan instance CodeIgniter
        $CI->load->database();  // Memuat database
        $CI->load->library('session');  // Memuat session library

        // Mengambil user_id dari session
        $user_id = $CI->session->userdata('user_id');

        // Query untuk mendapatkan data user berdasarkan user_id
        $CI->db->select('name, foto');
        $CI->db->from('user');
        $CI->db->where('id', $user_id);
        $query = $CI->db->get();

        if ($query->num_rows() > 0) {
            // Jika user ditemukan, kembalikan data nama dan foto
            return $query->row();
        } else {
            // Jika user tidak ditemukan, kembalikan default values
            return (object) [
                'name' => 'Guest',
                'foto' => base_url('assets/uploads/user/default.png')
            ];
        }
    }
}
