<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function render(string $view, string $title, array $data = [])
    {
        $email = $this->session->userdata('email');
        $data['user'] = $email ? $this->auth_model->findByEmail($email) : null;
        $data['title'] = $title;

        $this->load->view('templates/app/header', $data);
        $this->load->view('templates/app/sidebar', $data);
        $this->load->view('templates/app/topbar', $data);
        $this->load->view($view, $data);
        $this->load->view('templates/app/footer', $data);
    }

    protected function requireRole(string ...$roles)
    {
        check_login();

        if (!in_array($this->session->userdata('role'), $roles, true)) {
            redirect('auth/blocked');
        }
    }
}
