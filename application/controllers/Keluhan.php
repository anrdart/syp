<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keluhan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // cek_login();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = "Data Keluhan";
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['keluhan'] = $this->ModelKeluhan->getKeluhan()->result_array();

        if ($this->input->post('keyword')) {
            $data['keluhan'] = $this->ModelKeluhan->cariDataKeluhan();
        }

        $this->load->view('templates-admin/header', $data);
        $this->load->view('templates-admin/sidebar', $data);
        $this->load->view('templates-admin/topbar', $data);
        $this->load->view('keluhan/index', $data);
        $this->load->view('templates-admin/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data Keluhan';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['keluhan'] = $this->ModelKeluhan->getKeluhan()->result_array();

        $this->form_validation->set_rules('keluhan', 'Keluhan', 'trim|required', [
            'required' => 'Jenis keluhan yang ditangani harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates-admin/header', $data);
            $this->load->view('templates-admin/sidebar', $data);
            $this->load->view('templates-admin/topbar', $data);
            $this->load->view('keluhan/index', $data);
            $this->load->view('templates-admin/footer');
        } else {
            $this->ModelKeluhan->simpanKeluhan();
            // $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Data keluhan berhasil ditambahkan</div>');
            $this->session->set_flashdata('flash', 'berhasil ditambahkan');
            redirect('keluhan');
        }
    }

    public function hapusKeluhan($id)
    {
        $this->ModelKeluhan->hapusKeluhan($id);
        $this->session->set_flashdata('flash', 'dihapus');
        // $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Data keluhan dihapus</div>');
        redirect('keluhan');
    }

    public function updateKeluhan($id = null)
    {   
        $data['judul'] = 'Ubah Data Keluhan';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['keluhan'] = $this->ModelKeluhan->getKeluhanById($id);

        $this->form_validation->set_rules('keluhan', 'Keluhan', 'required', [
            'required' => 'Jenis keluhan yang ditangani harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates-admin/header', $data);
            $this->load->view('templates-admin/sidebar', $data);
            $this->load->view('templates-admin/topbar', $data);
            $this->load->view('keluhan/update', $data);
            $this->load->view('templates-admin/footer');
        } else {
            $this->ModelKeluhan->updateKeluhan();
            $this->session->set_flashdata('flash', 'berhasil diubah');
            // $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Data keluhan berhasil diubah</div>');
            redirect('keluhan');
        }
    }

    public function exportToPdf()
    {
        $data['judul'] = "Data keluhan";
        $data['keluhan'] = $this->ModelKeluhan->getAllKeluhan();
        $this->load->library('dompdf_gen');
        $this->load->view('keluhan/cetak-keluhan', $data);
        $paper_size = '4 cm'; // ukuran kertas
        $orientation = 'potrait'; //tipe format kertas potrait atau landscape 
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation); //Convert to PDF 
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Data keluhan syp.pdf", array('Attachment' => 0)); // nama file pdf yang di hasilkan
    }
}
