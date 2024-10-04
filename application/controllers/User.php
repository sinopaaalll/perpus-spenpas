<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required', array(
            'required' => '%s tidak boleh kosong',
        ));
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|matches[password_conf]', [
            'matches' => '%s tidak sama!',
            'min_length' => '%s terlalu pendek, minimal 5 karakter!'
        ]);
        $this->form_validation->set_rules('password_conf', 'Konfirmasi Password', 'trim|matches[password]');

        $id = $this->session->userdata('user_id');

        if ($this->form_validation->run() == FALSE) {
            $params = array(
                'title' => "Profil Saya",
                'user' => $this->db->get_where('user', ['id' => $id])->row()
            );
            $this->load->view('pages/user/index', $params);
        } else {
            $upload_data = array();

            $this->upload->initialize(array(
                'allowed_types' => 'png|jpg|jpeg',
                'upload_path' => 'assets/uploads/user/',
                'encrypt_name'  => TRUE,
                'max_size' => 2048,
            ));

            $i = $this->input;
            $old_foto = $i->post('old_foto');

            if (empty($_FILES['foto']['name'])) {
                $foto = $old_foto;
            } else {
                $old_photo_path = 'assets/uploads/user/' . $old_foto;
                if (file_exists($old_photo_path)) {
                    unlink($old_photo_path);
                }

                // Upload the new photo
                if (!$this->upload->do_upload('foto')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('admin/user');
                } else {
                    $upload_data['foto'] = $this->upload->data();
                    $foto = $upload_data['foto']['file_name'];
                }
            }

            $old_password = $this->db->get_where('user', ['id' => $id])->row_array()['password'];
            if ($i->post('password') == "") {
                $pasword = $old_password;
            } else {
                $pasword = password_hash($i->post('password'), PASSWORD_DEFAULT);
            }

            $data = [
                'name' => htmlspecialchars($i->post('name')),
                'password' => $pasword,
                'foto' => $foto,
            ];

            $this->db->update('user', $data, ['id' => $id]);

            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('user');
        }
    }
}
