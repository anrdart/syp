<?php
class Autentifikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {

        // if ($this->session->userdata('email')) {
        //     redirect('user');
        // }

        $this->form_validation->set_rules(
            'email',
            'Alamat Email',
            'required|trim|valid_email',
            [
                'required' => 'Email harus diisi!!',
                'valid_email' => 'Email tidak benar!!'
            ]
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim',
            [
                'required' => 'Password Harus diisi'
            ]
        );
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Login';
            // $data['user'] = '';

            $this->load->view('templates/aute_header', $data);
            $this->load->view('autentifikasi/login');
            $this->load->view('templates/aute_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // jika usernya ada
        if ($user) {
            // jika user aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];

                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('adminlog');
                    }

                    // INI UNTUK JIKA TAMU BISA LOGIN
                    // if ($user['role_id'] == 1) {
                    //     redirect('admin');
                    // } elseif ($user['role_id'] == 2) {
                    //     redirect('adminlog');
                    // } else {
                    //     redirect('home');
                    // }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message" role="alert"> Password Salah</div>');
                    redirect('autentifikasi');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message" role="alert"> User Belum diaktivasi</div>');
                redirect('autentifikasi');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message" role="alert"> Email Tidak Terdaftar</div>');
            redirect('autentifikasi');
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password Salah
          </div>');
        //redirect('auth');

        // $user = $this->ModelUser->cekData(['email' => $email]);
        // if ($user->num_rows() > 0) {
        //     $hasil = $user->row();
        //     if (password_verify($password, $hasil->password)) {
        //         $this->session->set_userdata('id', $hasil->id);
        //         $this->session->set_userdata('is_login', TRUE);
        //         redirect('admin');
        //     } else {
        //         //jika password salah
        //         $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>');
        //         redirect('autentifikasi');
        //     }
        // } else {
        //     // jika email salah
        //     $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar!!</div>');
        //     redirect('autentifikasi');
        // }
    }

    public function register()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules(
            'nama',
            'Nama',
            'required',
            [
                'required' => 'Nama Belum diisi!!'
            ]
        );

        $this->form_validation->set_rules(
            'email',
            'Alamat Email',
            'required|trim|valid_email|is_unique[user.email]',
            [
                'valid_email' => 'Email Tidak Benar',
                'required' => 'Email Belum diisi!!',
                'is_unique' => 'Email Sudah Terdaftar!'
            ]
        );

        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'required' => 'Password Harus Diisi',
                'matches' => 'Password Tidak Sama!!',
                'min_length' => 'Password Terlalu Pendek'
            ]
        );
        $this->form_validation->set_rules(
            'password2',
            'Repeat Password',
            'required|trim|matches[password1]',
            [
                'required' => 'Password Harus Diisi',
                'matches' => 'Password Tidak Sama!!',
                'min_length' => 'Password Terlalu Pendek'
            ]
        );

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Registrasi';
            $this->load->view('templates/aute_header', $data);
            $this->load->view('autentifikasi/register');
            $this->load->view('templates/aute_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'image' => 'default.jpg',
                'role_id' => 1,
                'is_active' => 1
            ];
            $this->ModelUser->simpanData($data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Selamat!! akun member anda sudah dibuat.</div>');
            redirect('autentifikasi');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('password');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda Telah Logout </div>');
        redirect('autentifikasi');
    }
}
