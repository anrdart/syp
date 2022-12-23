<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        $data['psikolog'] = $this->ModelPsikolog->getPsikolog($id)->result_array();

        if ($this->input->post('keyword')) {
            $data['psikolog'] = $this->ModelPsikolog->cariDataPsikolog();
            $this->session->set_flashdata('flash', 'berhasil ditemukan');
        }

        if ($this->input->post('keyword')) {
            $data['client'] = $this->ModelClient->cariDataClient();
            $this->session->set_flashdata('flash', 'berhasil ditemukan');
        }

        $this->load->view('templates-admin/header', $data);
        $this->load->view('templates-admin/sidebar', $data);
        $this->load->view('templates-admin/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates-admin/footer');
    }
}
