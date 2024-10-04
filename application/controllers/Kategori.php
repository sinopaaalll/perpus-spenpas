<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        $params = array(
            'title' => "Kategori",
            'kategori' => $this->db->select('*')->from('kategori')->order_by('id', 'ASC')->get()->result()
        );

        // var_dump($params['kategori']);
        // die();
        $this->load->view('pages/kategori/index', $params);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('kode', 'Kode Kategori', 'required|is_unique[kategori.kode]', array(
            'required' => '%s tidak boleh kosong',
            'is_unique' => '%s sudah ada, silahkan inputkan yang lain'
        ));
        $this->form_validation->set_rules('name', 'Kategori', 'required|is_unique[kategori.name]', array(
            'required' => '%s tidak boleh kosong',
            'is_unique' => '%s sudah ada, silahkan inputkan yang lain'
        ));

        if ($this->form_validation->run() == FALSE) {
            $params = array(
                'title' => "Kategori",
            );
            $this->load->view('pages/kategori/add', $params);
        } else {
            $kode = htmlspecialchars($this->input->post('kode'));
            $name = htmlspecialchars($this->input->post('name'));

            $data = array(
                'kode' => $kode,
                'name' => $name,
            );

            $this->db->insert('kategori', $data);
            $this->session->set_flashdata('success', 'Data berhasil di simpan!');
            redirect('kategori');
        }
    }

    public function edit($id)
    {

        $kategori = $this->db->get_where('kategori', array('id' => $id))->row();
        $this->form_validation->set_rules('kode', 'Kode Kategori', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('name', 'Kategori', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));

        if ($this->input->post('name') != $kategori->name) {
            $this->form_validation->set_rules('name', 'Kategori', 'is_unique[kategori.name]', array(
                'is_unique' => '%s sudah ada, silahkan inputkan yang lain'
            ));
        }

        if ($this->input->post('kode') != $kategori->kode) {
            $this->form_validation->set_rules('kode', 'Kode Kategori', 'is_unique[kategori.kode]', array(
                'is_unique' => '%s sudah ada, silahkan inputkan yang lain'
            ));
        }

        if ($this->form_validation->run() == FALSE) {
            $params = array(
                'title' => "Kategori",
                'kategori' => $kategori
            );
            $this->load->view('pages/kategori/edit', $params);
        } else {
            $kode = htmlspecialchars($this->input->post('kode'));
            $name = htmlspecialchars($this->input->post('name'));

            $data = array(
                'kode' => $kode,
                'name' => $name
            );

            $this->db->update('kategori', $data, array('id' => $id));
            $this->session->set_flashdata('success', 'Data berhasil di ubah!');
            redirect('kategori');
        }
    }

    public function hapus($id)
    {
        $this->db->delete('kategori', array('id' => $id));
        $this->session->set_flashdata('success', 'Data berhasil di hapus!');
        redirect('kategori');
    }
}
