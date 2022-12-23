<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testimoni extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // cek_login();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = "Data Testimoni";
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['testi'] = $this->ModelTesti->getTesti()->result_array();

        if ($this->input->post('keyword')) {
            $data['testi'] = $this->ModelTesti->cariDataTetsi();
            $this->session->set_flashdata('flash', 'berhasil ditemukan');
        }

        $this->load->view('templates-admin/header', $data);
        $this->load->view('templates-admin/sidebar', $data);
        $this->load->view('templates-admin/topbar', $data);
        $this->load->view('testi/index', $data);
        $this->load->view('templates-admin/footer');
    }

    public function hapusTesti($id)
    {
        $this->ModelTesti->hapusTesti($id);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('testimoni');
    }

    public function updateTesti($id)
    {
        $data['judul'] = 'Ubah Data Testi';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['testi'] = $this->ModelTesti->getTestiById($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Nama harus diisi'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required', [
            'required' => 'Email harus diisi'
        ]);
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required', [
            'required' => 'Tanggal harus diisi'
        ]);
        $this->form_validation->set_rules('testimoni', 'Testimoni', 'required', [
            'required' => 'Testimoni harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates-admin/header', $data);
            $this->load->view('templates-admin/sidebar', $data);
            $this->load->view('templates-admin/topbar', $data);
            $this->load->view('testi/update', $data);
            $this->load->view('templates-admin/footer');
        } else {
            $this->ModelTesti->updateTesti();
            $this->session->set_flashdata('flash', 'berhasil diubah');
            redirect('testimoni');
        }
    }

    public function exportToPdf()
    {
        $data['judul'] = "Data testimoni";
        $data['testi'] = $this->ModelTesti->getAllTesti();
        $this->load->library('dompdf_gen');
        $this->load->view('testi/cetak-testimoni', $data);
        $paper_size = '4 cm'; // ukuran kertas
        $orientation = 'potrait'; //tipe format kertas potrait atau landscape 
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation); //Convert to PDF 
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Data testimoni syp.pdf", array('Attachment' => 0)); // nama file pdf yang di hasilkan
    }
}
