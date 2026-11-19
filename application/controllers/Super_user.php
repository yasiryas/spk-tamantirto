<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Super_user extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->requireRole('super_user');
    }

    public function index()
    {
        $this->render('super_user/index', 'Dashboard', [
            'padukuhan' => $this->master_model->count('padukuhan'),
            'indikator' => $this->master_model->count('indikator'),
            'kategori' => $this->master_model->count('kategori'),
            'pertanyaan' => $this->master_model->count('pertanyaan'),
            'ringkasan' => $this->fuzzy_model->ringkasan(),
            'hasil' => $this->fuzzy_model->hasil(),
            'kategoriRingkasan' => $this->master_model->ringkasanKategori(),
        ]);
    }

    public function manajemen_user()
    {
        $this->render('super_user/manajemen_user', 'Manajemen User', [
            'list_user' => $this->auth_model->all(),
        ]);
    }

    public function tambah_user()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[user,admin,super_user]');

        if ($this->form_validation->run() === false) {
            $this->manajemen_user();

            return;
        }

        $this->auth_model->create([
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => $this->input->post('role', true),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
            'date_create' => time(),
        ]);

        $this->flash('Akun berhasil ditambahkan.');
        redirect('super_user/manajemen_user');
    }

    public function update_user()
    {
        $id = (int) $this->input->post('id_user', true);
        $email = $this->input->post('email', true);

        if ($this->auth_model->findById($id) === null) {
            $this->flash('Akun tidak ditemukan.', 'danger');
            redirect('super_user/manajemen_user');
        }

        $this->auth_model->update($id, [
            'name' => $this->input->post('name', true),
            'role' => $this->input->post('role', true),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
        ]);

        $this->flash('Akun ' . $email . ' berhasil diperbarui.');
        redirect('super_user/manajemen_user');
    }

    public function reset_password()
    {
        $id = (int) $this->input->post('id_user', true);
        $password = $this->input->post('password', true);

        if (strlen($password) < 6) {
            $this->flash('Password minimal 6 karakter.', 'danger');
            redirect('super_user/manajemen_user');
        }

        $this->auth_model->update($id, ['password' => password_hash($password, PASSWORD_DEFAULT)]);
        $this->flash('Kata sandi berhasil direset.');
        redirect('super_user/manajemen_user');
    }

    public function hapus_user()
    {
        $id = (int) $this->input->post('id_user', true);

        if ($id === (int) $this->session->userdata('id')) {
            $this->flash('Akun sendiri tidak bisa dihapus.', 'danger');
            redirect('super_user/manajemen_user');
        }

        $this->auth_model->delete($id);
        $this->flash('Akun berhasil dihapus.');
        redirect('super_user/manajemen_user');
    }

    private function flash(string $pesan, string $jenis = 'success')
    {
        $this->session->set_flashdata('message', '<div class="alert alert-' . $jenis . '" role="alert">' . htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8') . '</div>');
    }
}
