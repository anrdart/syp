<?php

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index($id = null)
    {
            $data['judul'] = "Home";
            $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
            $data['psikolog'] = $this->ModelPsikolog->getPsikolog($id)->result_array();
            $data['keluhan'] = $this->ModelKeluhan->getKeluhan()->result_array();


        // //jika sudah login dan jika belum login
        // if ($this->session->userdata('email')) {
        //     $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        // }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/index', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/layanan');
        $this->load->view('templates/footer', $data);
    }

    public function about()
    {
        $data = [
            'judul' => "Tentang Kami"
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/tentangkami/index', $data);
        $this->load->view('templates/layanan');
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function rumahbicara()
    {
        $data = [
            'judul' => "Rumah Bicara"
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/rumahbicara/index', $data);
        $this->load->view('templates/layanan');
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function psikolog()
    {
        $data = [
            'judul' => "Psikolog"
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/psikolog/index', $data);
        $this->load->view('templates/layanan');
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function testimoni()
    {
        $data = [
            'judul' => "Testimoni"
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/testimoni/index', $data);
        $this->load->view('templates/layanan');
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }
    
}
