<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Psikolog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // cek_login();
        $this->load->library('form_validation');
    }

    public function index($id = null)
    {
        $data['judul'] = "Data Psikolog";
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['psikolog'] = $this->ModelPsikolog->getPsikolog($id)->result_array();
        $data['keluhan'] = $this->ModelKeluhan->getKeluhan()->result_array();

        if ($this->input->post('keyword')) {
            $data['psikolog'] = $this->ModelPsikolog->cariDataPsikolog();
        }

        $this->load->view('templates-admin/header', $data);
        $this->load->view('templates-admin/sidebar', $data);
        $this->load->view('templates-admin/topbar', $data);
        $this->load->view('psikolog/index', $data);
        $this->load->view('templates-admin/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data Psikolog';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['psikolog'] = $this->ModelPsikolog->getPsikolog()->result_array();
        $data['keluhan'] = $this->ModelKeluhan->getKeluhan()->result_array();

        $this->form_validation->set_rules('sipp', 'SIPP', 'required', [
            'required' => 'Nomor sertifikat SIPP harus diisi'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Nama psikolog harus diisi'
        ]);
        $this->form_validation->set_rules('email', 'Email Psikolog', 'required', [
            'required' => 'Nama psikolog harus diisi'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Password harus diisi'
        ]);
        $this->form_validation->set_rules('whatsapp', 'Nomor WhatsApp', 'trim|required|numeric', [
            'required' => 'Nomor whatsapp harus diisi',
            'numeric' => 'Nomor whatsapp harus berupa angka'
        ]);
        $this->form_validation->set_rules('id_keluhan', 'Bidang Keluhan', 'required', [
            'required' => 'Jenis keluhan yang ditangani harus diisi'
        ]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/psikolog';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '5000';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';
        $config['file_name'] = 'img' . time();

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates-admin/header', $data);
            $this->load->view('templates-admin/sidebar', $data);
            $this->load->view('templates-admin/topbar', $data);
            $this->load->view('psikolog/index', $data);
            $this->load->view('templates-admin/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $image = '';
            }

            $data = array(
                'sipp' => $this->input->post('sipp', true),
                'nama' => $this->input->post('nama', true),
                'whatsapp' => $this->input->post('whatsapp', true),
                'id_keluhan' => $this->input->post('id_keluhan', true),
                'image' => $gambar
            );

            $this->ModelPsikolog->simpanPsikolog($data);
            $this->session->set_flashdata('flash', 'berhasil ditambahkan');
            redirect('psikolog');
        }
    }

    public function hapusPsikolog($id)
    {
        $this->ModelPsikolog->hapusPsikolog($id);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('psikolog');
    }

    public function updatePsikolog($id = null)
    {
        $data['judul'] = 'Ubah Data Psikolog';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['psikolog'] = $this->ModelPsikolog->getPsikolog($id)->result_array();
        $keluhan = $this->ModelKeluhan->joinKeluhanPsikolog(['psikolog.sipp' => $this->uri->segment(3)])->result_array();
        foreach ($keluhan as $k) {
            $data['id'] = $k['id_keluhan'];
            $data['k'] = $k['keluhan'];
        }

        $this->form_validation->set_rules('nama', 'Nama Psikolog', 'required', [
            'required' => 'Nama psikolog harus diisi'
        ]);
        $this->form_validation->set_rules('whatsapp', 'Nomor WhatsApp', 'trim|required|numeric', [
            'required' => 'Nomor whatsapp harus diisi',
            'numeric' => 'Nomor whatsapp harus berupa angka'
        ]);


        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/psikolog';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '5000';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';
        $config['file_name'] = 'img' . time();

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates-admin/header', $data);
            $this->load->view('templates-admin/sidebar', $data);
            $this->load->view('templates-admin/topbar', $data);
            $this->load->view('psikolog/update', $data);
            $this->load->view('templates-admin/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                unlink('./assets/img/psikolog' . $this->input->post('old_pict', TRUE));
                $gambar = $image['file_name'];
            } else {
                $gambar = $this->input->post('old_pict', TRUE);
            }

            $data = array(
                'sipp' => $this->input->post('sipp', true),
                'nama' => $this->input->post('nama', true),
                'whatsapp' => $this->input->post('whatsapp', true),
                'image' => $gambar
            );

            $this->ModelPsikolog->updatePsikolog($data, ['sipp' => $this->input->post('sipp')]);
            $this->session->set_flashdata('flash', 'diubah');
            redirect('psikolog');
        }
    }

    public function exportToPdf()
    {
        $data['judul'] = "Data psikolog SYP.id";
        $data['psikolog'] = $this->ModelPsikolog->getAllPsikolog();
        $this->load->library('dompdf_gen');
        $this->load->view('psikolog/cetak-psikolog', $data);
        $paper_size = '4 cm'; // ukuran kertas
        $orientation = 'potrait'; //tipe format kertas potrait atau landscape 
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation); //Convert to PDF 
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Data psikolog syp.pdf", array('Attachment' => 0)); // nama file pdf yang di hasilkan
    }
}
