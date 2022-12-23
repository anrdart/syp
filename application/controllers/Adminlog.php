<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adminlog extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // cek_login();
        $this->load->model('ModelUser');
    }

    public function index($id = null)
    {
        $data['judul'] = "Dashboard";
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['client'] = $this->ModelClient->getClient($id)->result_array();

        if ($this->input->post('keyword')) {
            $data['client'] = $this->ModelClient->cariDataClient();
            $this->session->set_flashdata('flash', 'berhasil ditemukan');
        }

        $this->load->view('templates-adminlog/header', $data);
        $this->load->view('templates-adminlog/sidebar', $data);
        $this->load->view('templates-adminlog/topbar', $data);
        $this->load->view('admin-psikolog/index', $data);
        $this->load->view('templates-adminlog/footer');
    }

    public function client($id = null)
    {
        $data['judul'] = "Data Client";
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['client'] = $this->ModelClient->getClient($id)->result_array();

        if ($this->input->post('keyword')) {
            $data['client'] = $this->ModelClient->cariDataClient();
        }

        $this->load->view('templates-adminlog/header', $data);
        $this->load->view('templates-adminlog/sidebar', $data);
        $this->load->view('templates-adminlog/topbar', $data);
        $this->load->view('client-psikolog/index', $data);
        $this->load->view('templates-adminlog/footer');
    }

    public function hapusClient($id)
    {
        $this->ModelClient->hapusClient($id);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('adminlog/client');
    }

    public function updateClient($id = null)
    {
        $data['judul'] = 'Ubah Data Client';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['client'] = $this->ModelClient->getClient($id)->result_array();

        // $keluhan = $this->ModelKeluhan->joinKeluhanClient(['client.id' => $this->uri->segment(3)])->result_array();
        // foreach ($keluhan as $k) {
        //     $data['id_sambat'] = $k['id_keluhan'];
        //     $data['k'] = $k['keluhan'];
        // }
        // $psikolog = $this->ModelPsikolog->joinPsikologClient(['client.id' => $this->uri->segment(3)])->result_array();
        // foreach ($psikolog as $p) {
        //     $data['sipp'] = $p['sipp'];
        //     $data['nama'] = $p['nama'];
        // }

        $this->form_validation->set_rules('nama', 'Nama Client', 'required', [
            'required' => 'Nama client harus diisi'
        ]);
        $this->form_validation->set_rules(
            'email',
            'Alamat Email',
            'required|trim|valid_email',
            [
                'required' => 'email Harus diisi!!',
                'valid_email' => 'email Tidak Benar!!'
            ]
        );
        $this->form_validation->set_rules('whatsapp', 'Nomor WhatsApp', 'trim|required|numeric', [
            'required' => 'Nomor whatsapp harus diisi',
            'numeric' => 'Nomor whatsapp harus berupa angka'
        ]);
        // $this->form_validation->set_rules('id_keluhan', 'Jenis Keluhan', 'required', [
        //     'required' => 'Jenis keluhan yang ditangani harus diisi'
        // ]);
        // $this->form_validation->set_rules('id_psikolog', 'Nama Psikolog', 'required', [
        //     'required' => 'Nama psikolog yang dipilih harus diisi'
        // ]);
        $this->form_validation->set_rules('tanggal_konsultasi', 'Tanggal Konsultasi', 'required', [
            'required' => 'Tanggal konsultasi harus diisi'
        ]);
        $this->form_validation->set_rules('jam_konsultasi', 'Jam Konsultasi', 'required', [
            'required' => 'Jam Konsultasi harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates-adminlog/header', $data);
            $this->load->view('templates-adminlog/sidebar', $data);
            $this->load->view('templates-adminlog/topbar', $data);
            $this->load->view('client-psikolog/update', $data);
            $this->load->view('templates-adminlog/footer');
        } else {
            $this->ModelClient->updateClient();
            $this->session->set_flashdata('flash', 'berhasil diubah');
            redirect('adminlog/client');
        }
    }

    public function userPsikolog()
    {
        $data['judul'] = 'Profil Saya';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates-adminlog/header', $data);
        $this->load->view('templates-adminlog/sidebar', $data);
        $this->load->view('templates-adminlog/topbar', $data);
        $this->load->view('user-psikolog/index', $data);
        $this->load->view('templates-adminlog/footer');
    }

    public function ubahProfil()
    {
        $data['judul'] = 'Ubah Profil';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak Boleh Kosong'
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates-adminlog/header', $data);
            $this->load->view('templates-adminlog/sidebar', $data);
            $this->load->view('templates-adminlog/topbar', $data);
            $this->load->view('user-psikolog/ubah-profil', $data);
            $this->load->view('templates-adminlog/footer');
        } else {
            $nama = $this->input->post('nama', true);
            $email = $this->input->post('email', true);

            //jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '5000';
                $config['max_width'] = '5000';
                $config['max_height'] = '5000';
                $config['file_name'] = 'profil' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $gambar_lama = $data['user']['image'];
                    if ($gambar_lama != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                    }

                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                }
            }

            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Profil Berhasil diubah </div>');
            redirect('adminlog');
        }
    }

    public function ubahPassword()
    {
        $data['judul'] = 'Ubah Password';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('password_sekarang', 'Password Saat ini', 'required|trim', [
            'required' => 'Password saat ini harus diisi'
        ]);

        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[4]|matches[password_baru2]', [
            'required' => 'Password Baru harus diisi',
            'min_length' => 'Password tidak boleh kurang dari 4 digit',
            'matches' => 'Password Baru tidak sama dengan ulangi password'
        ]);

        $this->form_validation->set_rules('password_baru2', 'Konfirmasi Password Baru', 'required|trim|min_length[4]|matches[password_baru1]', [
            'required' => 'Ulangi Password harus diisi',
            'min_length' => 'Password tidak boleh kurang dari 4 digit',
            'matches' => 'Ulangi Password tidak sama dengan password baru'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates-adminlog/header', $data);
            $this->load->view('templates-adminlog/sidebar', $data);
            $this->load->view('templates-adminlog/topbar', $data);
            $this->load->view('password/ubahpassword', $data);
            $this->load->view('templates-adminlog/footer');
        } else {
            $pwd_skrg = $this->input->post('password_sekarang', true);
            $pwd_baru = $this->input->post('password_baru1', true);
            if (!password_verify($pwd_skrg, $data['user']['password'])) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password Saat ini Salah!!! </div>');
                redirect('adminlog/ubahPassword');
            } else {
                if ($pwd_skrg == $pwd_baru) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password Baru tidak boleh sama dengan password saat ini!!! </div>');
                    redirect('adminlog/ubahPassword');
                } else {
                    //password ok
                    $password_hash = password_hash($pwd_baru, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Password Berhasil diubah</div>');
                    redirect('adminlog/ubahPassword');
                }
            }
        }
    }
}
