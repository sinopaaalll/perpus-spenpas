<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        // Query buku join kategori
        $buku = $this->db->select('a.*, b.name as kategori')->from('buku a')
            ->join('kategori b', 'b.id = a.kategori_id')
            ->order_by('a.id', 'ASC')
            ->get()
            ->result();

        $params = array(
            'title' => "Buku",
            'buku' => $buku
        );
        $this->load->view('pages/buku/index', $params);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('isbn', 'ISBN', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('penulis', 'Penulis', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('penerbit', 'penerbit', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('tahun_terbit', 'Tahun terbit', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('stok', 'Stok', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('kategori', 'Kategori', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));

        if ($this->form_validation->run() == FALSE) {

            $kategori = $this->db->select('*')->from('kategori')
                ->order_by('id', 'ASC')
                ->get()
                ->result();

            $params = array(
                'title' => "Buku",
                'kategori' => $kategori
            );
            $this->load->view('pages/buku/add', $params);
        } else {

            $upload_data = array();

            $this->upload->initialize(array(
                'allowed_types' => 'png|jpg|jpeg',
                'upload_path' => 'assets/uploads/buku/',
                'encrypt_name'  => TRUE,
                'max_size' => 5048,
            ));

            if (empty($_FILES['sampul']['name'])) {
                $sampul = 'cover-buku.png';
            } else {

                // Upload the new photo
                if (!$this->upload->do_upload('sampul')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('admin/buku');
                } else {
                    $upload_data['sampul'] = $this->upload->data();
                    $sampul = $upload_data['sampul']['file_name'];
                }
            }

            // Mengambil data post
            $judul = htmlspecialchars($this->input->post('judul'));
            $isbn = preg_replace('/[^0-9]/', '', $this->input->post('isbn'));
            $penulis = htmlspecialchars($this->input->post('penulis'));
            $penerbit = htmlspecialchars($this->input->post('penerbit'));
            $tahun_terbit = htmlspecialchars($this->input->post('tahun_terbit'));
            $stok = htmlspecialchars($this->input->post('stok'));
            $kategori_id = htmlspecialchars($this->input->post('kategori'));


            // Membuat kode buku otomatis
            // Contoh kategori_id adalah 3, maka kita akan membuatnya 3 digit -> 003
            $this->db->where('id', $kategori_id);
            $this->db->from('kategori');
            $kategori = $this->db->get()->row();

            $kode_kategori = $kategori->kode;

            // Query untuk mendapatkan kode buku terbesar di kategori tersebut
            $this->db->select_max('kode');
            $this->db->like('kode', 'BK' . $kode_kategori, 'after');  // mencari kode yang dimulai dengan 'BK' dan kode kategori
            $last_buku = $this->db->get('buku')->row();

            // Jika ada buku dengan kode tertinggi, ambil nomor urutnya
            if (
                $last_buku && !empty($last_buku->kode)
            ) {
                // Ambil 3 digit terakhir dari kode buku (nomor urut)
                $last_number = (int)substr($last_buku->kode, -3);
                $nomor_buku = str_pad($last_number + 1, 3, '0', STR_PAD_LEFT);
            } else {
                // Jika tidak ada buku dalam kategori, mulai dari 001
                $nomor_buku = '001';
            }

            // Membuat kode buku dengan format BK000001
            $kode_buku = 'BK' . $kode_kategori . $nomor_buku;

            $data = array(
                'kode' => $kode_buku,
                'judul' => $judul,
                'isbn' => $isbn,
                'penulis' => $penulis,
                'penerbit' => $penerbit,
                'tahun_terbit' => $tahun_terbit,
                'stok' => $stok,
                'kategori_id' => $kategori_id,
                'kategori_id' => $kategori_id,
                'sampul' => $sampul
            );

            $insert = $this->db->insert('buku', $data);
            if ($insert) {
                $this->session->set_flashdata('success', 'Data berhasil di simpan!');
                redirect('buku');
            }
        }
    }

    public function detail($id)
    {
        // Query buku join kategori
        $buku = $this->db->select('a.*, b.name as kategori')->from('buku a')
            ->join('kategori b', 'b.id = a.kategori_id')
            ->order_by('a.id', 'ASC')
            ->where('a.id', $id)
            ->get()
            ->row();

        $params = array(
            'title' => "Buku",
            'buku' => $buku
        );
        $this->load->view('pages/buku/view', $params);
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('isbn', 'ISBN', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('penulis', 'Penulis', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('penerbit', 'penerbit', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('tahun_terbit', 'Tahun terbit', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('stok', 'Stok', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('kategori', 'Kategori', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));

        if ($this->form_validation->run() == FALSE) {

            $kategori = $this->db->select('*')->from('kategori')
                ->order_by('id', 'ASC')
                ->get()
                ->result();
            $buku = $this->db->get_where('buku', array('id' => $id))->row();

            $params = array(
                'title' => "Buku",
                'buku' => $buku,
                'kategori' => $kategori
            );
            $this->load->view('pages/buku/edit', $params);
        } else {

            $upload_data = array();

            $this->upload->initialize(array(
                'allowed_types' => 'png|jpg|jpeg',
                'upload_path' => 'assets/uploads/buku/',
                'encrypt_name'  => TRUE,
                'max_size' => 5048,
            ));

            $old_sampul = $this->input->post('old_sampul');

            if (empty($_FILES['sampul']['name'])) {
                $sampul = $old_sampul;
            } else {

                if ($old_sampul != 'cover-buku.png') {
                    $old_photo_path = 'assets/uploads/buku/' . $old_sampul;
                    if (file_exists($old_photo_path)) {
                        unlink($old_photo_path);
                    }
                }
                // Upload the new photo
                if (!$this->upload->do_upload('sampul')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('admin/buku');
                } else {
                    $upload_data['sampul'] = $this->upload->data();
                    $sampul = $upload_data['sampul']['file_name'];
                }
            }

            // Mengambil data post
            $judul = htmlspecialchars($this->input->post('judul'));
            $isbn = preg_replace('/[^0-9]/', '', $this->input->post('isbn'));
            $penulis = htmlspecialchars($this->input->post('penulis'));
            $penerbit = htmlspecialchars($this->input->post('penerbit'));
            $tahun_terbit = htmlspecialchars($this->input->post('tahun_terbit'));
            $stok = htmlspecialchars($this->input->post('stok'));
            $kategori_id = htmlspecialchars($this->input->post('kategori'));

            $data = array(
                'judul' => $judul,
                'isbn' => $isbn,
                'penulis' => $penulis,
                'penerbit' => $penerbit,
                'tahun_terbit' => $tahun_terbit,
                'stok' => $stok,
                'kategori_id' => $kategori_id,
                'kategori_id' => $kategori_id,
                'sampul' => $sampul
            );

            $this->db->update('buku', $data, array('id' => $id));
            $this->session->set_flashdata('success', 'Data berhasil di ubah!');
            redirect('buku');
        }
    }

    public function hapus($id)
    {

        // Mendapatkan data sampul dan kode dari database
        $buku = $this->db->get_where('buku', ['id' => $id])->row_array();
        $sampul = $buku['sampul'];

        // Hapus file sampul dari folder uploads
        if ($sampul != 'cover-buku.png') {
            $path_sampul = 'assets/uploads/buku/' . $sampul;
            if (file_exists($path_sampul)) {
                unlink($path_sampul);
            }
        }

        $this->db->delete('buku', array('id' => $id));
        $this->session->set_flashdata('success', 'Data berhasil di hapus!');
        redirect('buku');
    }

    private function generate_qrcode($kode)
    {

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']             = './assets/'; //string, the default is application/cache/
        $config['errorlog']             = './assets/'; //string, the default is application/logs/
        $config['imagedir']             = './assets/qr-code/buku/'; //direktori penyimpanan qr code
        $config['quality']              = true; //boolean, the default is true
        $config['size']                 = '1024'; //interger, the default is 1024
        $config['black']                = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']                = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $kode . '.png'; //buat name dari qr code sesuai dengan kode

        $params['data'] = $kode; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        return $this->ciqrcode->generate($params);
    }
}
