<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // cek_login();
        $this->load->library('form_validation');
    }

    public function index($id = null)
    {
        $data['judul'] = "Data Client";
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['client'] = $this->ModelClient->getClient($id)->result_array();

        if ($this->input->post('keyword')) {
            $data['client'] = $this->ModelClient->cariDataClient();
        }

        $this->load->view('templates-admin/header', $data);
        $this->load->view('templates-admin/sidebar', $data);
        $this->load->view('templates-admin/topbar', $data);
        $this->load->view('client/index', $data);
        $this->load->view('templates-admin/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data Client';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['client'] = $this->ModelClient->getClient()->result_array();

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
        $this->form_validation->set_rules('id_keluhan', 'Jenis Keluhan', 'required', [
            'required' => 'Jenis keluhan yang ditangani harus diisi'
        ]);
        $this->form_validation->set_rules('id_psikolog', 'Nama Psikolog', 'required', [
            'required' => 'Nama psikolog yang dipilih harus diisi'
        ]);
        $this->form_validation->set_rules('tanggal_konsultasi', 'Tanggal Konsultasi', 'required', [
            'required' => 'Tanggal konsultasi harus diisi'
        ]);
        $this->form_validation->set_rules('jam_konsultasi', 'Jam Konsultasi', 'required', [
            'required' => 'Jam Konsultasi harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->ModelClient->simpanClient();
            $this->session->set_flashdata('flash', 'berhasil disimpan');
            redirect('home');
        }
    }

    public function hapusClient($id)
    {
        $this->ModelClient->hapusClient($id);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('client');
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
            $this->load->view('templates-admin/header', $data);
            $this->load->view('templates-admin/sidebar', $data);
            $this->load->view('templates-admin/topbar', $data);
            $this->load->view('client/update', $data);
            $this->load->view('templates-admin/footer');
        } else {
            $this->ModelClient->updateClient();
            $this->session->set_flashdata('flash', 'berhasil diubah');
            redirect('client');
        }
    }

    public function exportToPdf()
    {
        $data['judul'] = "Data Client";
        $data['client'] = $this->ModelClient->getAllClient();
        $this->load->library('dompdf_gen');
        $this->load->view('client/cetak-client', $data);
        $paper_size = '4 cm'; // ukuran kertas
        $orientation = 'potrait'; //tipe format kertas potrait atau landscape 
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation); //Convert to PDF 
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Data client syp.pdf", array('Attachment' => 0)); // nama file pdf yang di hasilkan
    }

    public function importCsv()
    {
        $data['judul'] = "Data Client";
        $this->load->view('client/import-csv', $data);
        $this->load->view('templates-admin/header', $data);
        $this->load->view('templates-admin/footer', $data);
    }
}
