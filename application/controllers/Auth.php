<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect($this->session->userdata('role'));
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() === false) {
            $this->render('auth/login', 'Masuk ke Sistem');

            return;
        }

        $this->login();
    }

    public function registration()
    {
        $this->form_validation->set_rules('full_name', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[repeat_password]');
        $this->form_validation->set_rules('repeat_password', 'Ulangi password', 'required|trim|matches[password]');

        if ($this->form_validation->run() === false) {
            $this->render('auth/registration', 'Buat Akun');

            return;
        }

        $this->auth_model->create([
            'name' => htmlspecialchars($this->input->post('full_name', true), ENT_QUOTES, 'UTF-8'),
            'email' => htmlspecialchars($this->input->post('email', true), ENT_QUOTES, 'UTF-8'),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => 'user',
            'is_active' => 1,
            'date_create' => time(),
        ]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dibuat. Silakan masuk.</div>');
        redirect('auth');
    }

    public function logout()
    {
        $this->session->unset_userdata(['id', 'email', 'role']);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah keluar.</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->render('auth/blocked', 'Akses Ditolak');
    }

    private function login()
    {
        $user = $this->auth_model->findByEmail($this->input->post('email', true));

        if ($user === null || !password_verify($this->input->post('password'), $user['password'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email atau kata sandi salah.</div>');
            redirect('auth');
        }

        if ((int) $user['is_active'] !== 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun belum aktif. Hubungi admin.</div>');
            redirect('auth');
        }

        $this->session->set_userdata(['id' => $user['id'], 'email' => $user['email'], 'role' => $user['role']]);
        redirect($user['role']);
    }

    private function render(string $view, string $title)
    {
        $this->load->view('templates/auth/auth_header', ['title' => $title]);
        $this->load->view($view);
        $this->load->view('templates/auth/auth_footer');
    }
}
