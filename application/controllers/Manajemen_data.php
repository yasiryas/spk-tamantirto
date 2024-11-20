<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manajemen_data extends CI_Controller
{
     public function __construct()
     {
          parent::__construct();
          check_login();
     }

     public function padukuhan()
     {
          $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
          $data['title'] = 'Manajemen Data';
          $data['sub_title'] = 'padukuhan';
          $data['data_padukuhan'] = $this->db->get('padukuhan')->result_array();

          $this->load->view('templates/dashboard/dashboard_header', $data);
          $this->load->view('templates/dashboard/sidebar', $data);
          $this->load->view('templates/dashboard/topbar', $data);
          $this->load->view('manajemen_data/padukuhan', $data);
          $this->load->view('templates/dashboard/dashboard_footer');
     }

     public function tambah_padukuhan()
     {
          $this->form_validation->set_rules('nama_padukuhan', 'Padukhan', 'required|trim|is_unique[padukuhan.nama_padukuhan]', [
               'required' => 'Ups, Nama padukuhan harus terisi!',
               'is_unique' => 'Maaf, Padukuhan sudah ada!'
          ]);

          if ($this->form_validation->run() == false) {
               $data['title'] = 'Manajemen Data';
               $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
               $data['data_padukuhan'] = $this->db->get('padukuhan')->result_array();

               $this->load->view('templates/dashboard/dashboard_header', $data);
               $this->load->view('templates/dashboard/sidebar', $data);
               $this->load->view('templates/dashboard/topbar', $data);
               $this->load->view('manajemen_data/padukuhan', $data);
               $this->load->view('templates/dashboard/dashboard_footer');
          } else {
               $data = [
                    'nama_padukuhan' => htmlspecialchars($this->input->post('nama_padukuhan', true)),
               ];

               $this->db->insert('padukuhan', $data);
               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Padukuan berhasil ditambahkan!</div>');
               redirect('manajemen_data/padukuhan');
          }
     }

     public function hapus_padukuhan()
     {
          $id_user = $this->input->post('idPadukuhan', true);
          $this->db->where('id_padukuhan', $id_user);
          $this->db->delete('padukuhan');

          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Padukuhan berhasil dihapus!</div>');
          redirect('manajemen_data/padukuhan');
     }

     public function update_padukuhan()
     {
          $this->form_validation->set_rules('ubahNamaPadukuhan', 'Padukuhan', 'required|trim|is_unique[padukuhan.nama_padukuhan]', [
               'required' => 'Ups, Nama padukuhan harus terisi!',
               'is_unique' => 'Maaf, Padukuhan sudah ada!'
          ]);

          if ($this->form_validation->run() == false) {
               $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Padukuhan sudah ada!</div>');
               $this->session->set_flashdata('message-update-padukuhan', ' <div id="errorNamaPadukuhan" class="invalid-feedback ml-1 errorUpdatePadukuhan" value="1">Padukuhan sudah ada!</div>');
               redirect('manajemen_data/padukuhan');
          } else {
               $id_padukuhan = $this->input->post('idUpdatePadukuhan', true);
               $data = [
                    'nama_padukuhan' => $this->input->post('ubahNamaPadukuhan', true),
               ];

               $this->db->where('id_padukuhan', $id_padukuhan);
               $this->db->update('padukuhan', $data);

               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Padukuhan berhasil diupdate!</div>');
               redirect('manajemen_data/padukuhan');
          }
     }

     public function kategori()
     {
          $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
          $data['title'] = 'Manajemen Data';
          $data['sub_title'] = 'kategori';
          $data['data_kategori'] = $this->db->get('kategori')->result_array();

          $this->load->view('templates/dashboard/dashboard_header', $data);
          $this->load->view('templates/dashboard/sidebar', $data);
          $this->load->view('templates/dashboard/topbar', $data);
          $this->load->view('manajemen_data/kategori', $data);
          $this->load->view('templates/dashboard/dashboard_footer');
     }

     public function tambah_kategori()
     {
          $this->form_validation->set_rules('nama_kategori', 'Kategori', 'required|trim|is_unique[kategori.nama_kategori]', [
               'required' => 'Ups, Nama kategori harus terisi!',
               'is_unique' => 'Maaf, kategori sudah ada!'
          ]);

          if ($this->form_validation->run() == false) {
               $data['title'] = 'Manajemen Data';
               $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
               $data['data_kategori'] = $this->db->get('kategori')->result_array();

               $this->load->view('templates/dashboard/dashboard_header', $data);
               $this->load->view('templates/dashboard/sidebar', $data);
               $this->load->view('templates/dashboard/topbar', $data);
               $this->load->view('manajemen_data/kategori', $data);
               $this->load->view('templates/dashboard/dashboard_footer');
          } else {
               $data = [
                    'nama_kategori' => htmlspecialchars($this->input->post('nama_kategori', true)),
               ];

               $this->db->insert('kategori', $data);
               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Padukuan berhasil ditambahkan!</div>');
               redirect('manajemen_data/kategori');
          }
     }

     public function hapus_kategori()
     {
          $id_user = $this->input->post('idKategori', true);
          $this->db->where('id_kategori', $id_user);
          $this->db->delete('kategori');

          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">kategori berhasil dihapus!</div>');
          redirect('manajemen_data/kategori');
     }

     public function update_kategori()
     {
          $this->form_validation->set_rules('ubah_nama_kategori', 'kategori', 'required|trim|is_unique[kategori.nama_kategori]', [
               'required' => 'Ups, Nama kategori harus terisi!',
               'is_unique' => 'Maaf, kategori sudah ada!'
          ]);

          if ($this->form_validation->run() == false) {

               $data['title'] = 'Manajemen Data';
               $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
               $data['data_kategori'] = $this->db->get('kategori')->result_array();

               $this->load->view('templates/dashboard/dashboard_header', $data);
               $this->load->view('templates/dashboard/sidebar', $data);
               $this->load->view('templates/dashboard/topbar', $data);
               $this->load->view('manajemen_data/kategori', $data);
               $this->load->view('templates/dashboard/dashboard_footer');
          } else {
               $id_kategori = $this->input->post('id_kategori', true);
               $data = [
                    'nama_kategori' => $this->input->post('ubah_nama_kategori', true),
               ];

               $this->db->where('id_kategori', $id_kategori);
               $this->db->update('kategori', $data);

               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">kategori berhasil diupdate!</div>');
               redirect('manajemen_data/kategori');
          }
     }

     public function indikator()
     {
          $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
          $data['title'] = 'Manajemen Data';
          $data['sub_title'] = 'indikator';
          $data['data_indikator'] = $this->db->get('indikator')->result_array();

          $this->load->view('templates/dashboard/dashboard_header', $data);
          $this->load->view('templates/dashboard/sidebar', $data);
          $this->load->view('templates/dashboard/topbar', $data);
          $this->load->view('manajemen_data/indikator', $data);
          $this->load->view('templates/dashboard/dashboard_footer');
     }

     public function tambah_indikator()
     {
          $this->form_validation->set_rules('nama_indikator', 'indikator', 'required|trim|is_unique[indikator.nama_indikator]', [
               'required' => 'Ups, Nama indikator harus terisi!',
               'is_unique' => 'Maaf, indikator sudah ada!'
          ]);

          if ($this->form_validation->run() == false) {
               $data['title'] = 'Manajemen Data';
               $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
               $data['data_indikator'] = $this->db->get('indikator')->result_array();

               $this->load->view('templates/dashboard/dashboard_header', $data);
               $this->load->view('templates/dashboard/sidebar', $data);
               $this->load->view('templates/dashboard/topbar', $data);
               $this->load->view('manajemen_data/indikator', $data);
               $this->load->view('templates/dashboard/dashboard_footer');
          } else {
               $data = [
                    'nama_indikator' => htmlspecialchars($this->input->post('nama_indikator', true)),
               ];

               $this->db->insert('indikator', $data);
               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Padukuan berhasil ditambahkan!</div>');
               redirect('manajemen_data/indikator');
          }
     }

     public function hapus_indikator()
     {
          $id_user = $this->input->post('idindikator', true);
          $this->db->where('id_indikator', $id_user);
          $this->db->delete('indikator');

          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">indikator berhasil dihapus!</div>');
          redirect('manajemen_data/indikator');
     }

     public function update_indikator()
     {
          $this->form_validation->set_rules('ubah_nama_indikator', 'indikator', 'required|trim|is_unique[indikator.nama_indikator]', [
               'required' => 'Ups, Nama indikator harus terisi!',
               'is_unique' => 'Maaf, indikator sudah ada!'
          ]);

          if ($this->form_validation->run() == false) {

               $data['title'] = 'Manajemen Data';
               $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
               $data['data_indikator'] = $this->db->get('indikator')->result_array();

               $this->load->view('templates/dashboard/dashboard_header', $data);
               $this->load->view('templates/dashboard/sidebar', $data);
               $this->load->view('templates/dashboard/topbar', $data);
               $this->load->view('manajemen_data/indikator', $data);
               $this->load->view('templates/dashboard/dashboard_footer');
          } else {
               $id_indikator = $this->input->post('id_indikator', true);
               $data = [
                    'nama_indikator' => $this->input->post('ubah_nama_indikator', true),
               ];

               $this->db->where('id_indikator', $id_indikator);
               $this->db->update('indikator', $data);

               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">indikator berhasil diupdate!</div>');
               redirect('manajemen_data/indikator');
          }
     }

     public function survey()
     {
          $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
          $data['title'] = 'Manajemen Data';
          $data['sub_title'] = 'survey';
          $data['data_survey'] = $this->db->get('survey')->result_array();

          $this->load->view('templates/dashboard/dashboard_header', $data);
          $this->load->view('templates/dashboard/sidebar', $data);
          $this->load->view('templates/dashboard/topbar', $data);
          $this->load->view('manajemen_data/survey', $data);
          $this->load->view('templates/dashboard/dashboard_footer');
     }

     public function tambah_survey()
     {
          $this->form_validation->set_rules('nama_survey', 'survey', 'required|trim|is_unique[survey.nama_survey]', [
               'required' => 'Ups, Nama survey harus terisi!',
               'is_unique' => 'Maaf, survey sudah ada!'
          ]);

          if ($this->form_validation->run() == false) {
               $data['title'] = 'Manajemen Data';
               $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
               $data['data_survey'] = $this->db->get('survey')->result_array();

               $this->load->view('templates/dashboard/dashboard_header', $data);
               $this->load->view('templates/dashboard/sidebar', $data);
               $this->load->view('templates/dashboard/topbar', $data);
               $this->load->view('manajemen_data/survey', $data);
               $this->load->view('templates/dashboard/dashboard_footer');
          } else {
               $data = [
                    'nama_survey' => htmlspecialchars($this->input->post('nama_survey', true)),
               ];

               $this->db->insert('survey', $data);
               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Padukuan berhasil ditambahkan!</div>');
               redirect('manajemen_data/survey');
          }
     }

     public function hapus_survey()
     {
          $id_user = $this->input->post('idsurvey', true);
          $this->db->where('id_survey', $id_user);
          $this->db->delete('survey');

          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">survey berhasil dihapus!</div>');
          redirect('manajemen_data/survey');
     }

     public function update_survey()
     {
          $this->form_validation->set_rules('ubah_nama_survey', 'survey', 'required|trim|is_unique[survey.nama_survey]', [
               'required' => 'Ups, Nama survey harus terisi!',
               'is_unique' => 'Maaf, survey sudah ada!'
          ]);

          if ($this->form_validation->run() == false) {

               $data['title'] = 'Manajemen Data';
               $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
               $data['data_survey'] = $this->db->get('survey')->result_array();

               $this->load->view('templates/dashboard/dashboard_header', $data);
               $this->load->view('templates/dashboard/sidebar', $data);
               $this->load->view('templates/dashboard/topbar', $data);
               $this->load->view('manajemen_data/survey', $data);
               $this->load->view('templates/dashboard/dashboard_footer');
          } else {
               $id_survey = $this->input->post('id_survey', true);
               $data = [
                    'nama_survey' => $this->input->post('ubah_nama_survey', true),
               ];

               $this->db->where('id_survey', $id_survey);
               $this->db->update('survey', $data);

               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Survey berhasil diupdate!</div>');
               redirect('manajemen_data/survey');
          }
     }

     public function pertanyaan()
     {
          $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
          $data['title'] = 'Manajemen Data';
          $data['sub_title'] = 'pertanyaan';
          $data['surveyor'] = $this->db->get('user')->result_array();
          $data['kategori'] = $this->db->get('kategori')->result_array();
          $data['padukuhan'] = $this->db->get('padukuhan')->result_array();
          $data['indikator'] = $this->db->get('indikator')->result_array();
          $data['data_pertanyaan'] = $this->db->select('pertanyaan.id_pertanyaan, pertanyaan.pertanyaan, pertanyaan.skor, kategori.nama_kategori  as kategori, padukuhan.nama_padukuhan as padukuhan, pertanyaan.id_kategori as id_kategori, pertanyaan.id_padukuhan as id_padukuhan, user.name as surveyor, pertanyaan.tanggal_survey as tanggal, user.id as id_surveyor, indikator.nama_indikator as indikator, pertanyaan.id_indikator as id_indikator')
               ->from('pertanyaan')
               ->join('kategori', 'kategori.id_kategori = pertanyaan.id_kategori')
               ->join('padukuhan', 'padukuhan.id_padukuhan = pertanyaan.id_padukuhan')
               ->join('user', 'user.id = pertanyaan.id_surveyor')
               ->join('indikator', 'pertanyaan.id_indikator = indikator.id_indikator')
               ->get()->result_array();

          $this->load->view('templates/dashboard/dashboard_header', $data);
          $this->load->view('templates/dashboard/sidebar', $data);
          $this->load->view('templates/dashboard/topbar', $data);
          $this->load->view('manajemen_data/pertanyaan', $data);
          $this->load->view('templates/dashboard/dashboard_footer');
     }

     public function tambah_pertanyaan()
     {
          $this->form_validation->set_rules('tanggal_pertanyaan', 'tanggal_pertanyaan', 'required|trim', [
               'required' => 'Ups, Tanggal pertanyaan harus terisi!'
          ]);
          $this->form_validation->set_rules('surveyor_pertanyaan', 'surveyor_pertanyaan', 'required|trim', [
               'required' => 'Ups, Surveyor harus terisi!'
          ]);
          $this->form_validation->set_rules('pertanyaan', 'pertanyaan', 'required|trim', [
               'required' => 'Ups, Pertanyaan harus terisi!'
          ]);
          $this->form_validation->set_rules('kategori_pertanyaan', 'kategori_pertanyaan', 'required', [
               'required' => 'Ups, Kategori pertanyaan harus terisi!',
          ]);
          $this->form_validation->set_rules('indikator_pertanyaan', 'indikator_pertanyaan', 'required', [
               'required' => 'Ups, indikator pertanyaan harus terisi!',
          ]);
          $this->form_validation->set_rules('padukuhan_pertanyaan', 'padukuhan_pertanyaan', 'required|trim', [
               'required' => 'Ups, Padukuhan harus terisi!'
          ]);
          $this->form_validation->set_rules('skor_pertanyaan', 'skor_pertanyaan', 'required|trim', [
               'required' => 'Ups, Skor Pertanyaan harus terisi!',
          ]);

          if ($this->form_validation->run() == false) {
               $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
               $data['title'] = 'Manajemen Data';
               $data['sub_title'] = 'pertanyaan';
               $data['surveyor'] = $this->db->get('user')->result_array();
               $data['kategori'] = $this->db->get('kategori')->result_array();
               $data['indikator'] = $this->db->get('indikator')->result_array();
               $data['padukuhan'] = $this->db->get('padukuhan')->result_array();
               $data['data_pertanyaan'] = $this->db->select('pertanyaan.id_pertanyaan, pertanyaan.pertanyaan, pertanyaan.skor, kategori.nama_kategori  as kategori, padukuhan.nama_padukuhan as padukuhan, pertanyaan.id_kategori as id_kategori, pertanyaan.id_padukuhan as id_padukuhan, user.name as surveyor, pertanyaan.tanggal_survey as tanggal, user.id as id_surveyor, indikator.nama_indikator as indikator, pertanyaan.id_indikator as id_indikator')
                    ->from('pertanyaan')
                    ->join('kategori', 'kategori.id_kategori = pertanyaan.id_kategori')
                    ->join('padukuhan', 'padukuhan.id_padukuhan = pertanyaan.id_padukuhan')
                    ->join('user', 'user.id = pertanyaan.id_surveyor')
                    ->join('indikator', 'pertanyaan.id_indikator = indikator.id_indikator')
                    ->get()->result_array();

               $this->load->view('templates/dashboard/dashboard_header', $data);
               $this->load->view('templates/dashboard/sidebar', $data);
               $this->load->view('templates/dashboard/topbar', $data);
               $this->load->view('manajemen_data/pertanyaan', $data);
               $this->load->view('templates/dashboard/dashboard_footer');
          } else {
               $data = [
                    'id_pertanyaan' => null,
                    'tanggal_survey' => htmlspecialchars($this->input->post('tanggal_pertanyaan', true)),
                    'id_surveyor' => htmlspecialchars($this->input->post('surveyor_pertanyaan', true)),
                    'pertanyaan' => htmlspecialchars($this->input->post('pertanyaan', true)),
                    'id_kategori' => htmlspecialchars($this->input->post('kategori_pertanyaan', true)),
                    'id_indikator' => htmlspecialchars($this->input->post('indikator_pertanyaan', true)),
                    'id_padukuhan' => htmlspecialchars($this->input->post('padukuhan_pertanyaan', true)),
                    'skor' => htmlspecialchars($this->input->post('skor_pertanyaan', true)),
               ];

               $this->db->insert('pertanyaan', $data);
               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Padukuan berhasil ditambahkan!</div>');
               redirect('manajemen_data/pertanyaan');
          }
     }

     public function hapus_pertanyaan()
     {
          $id_pertanyaan = $this->input->post('id_pertanyaan', true);
          $this->db->where('id_pertanyaan', $id_pertanyaan);
          $this->db->delete('pertanyaan');

          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">pertanyaan berhasil dihapus!</div>');
          redirect('manajemen_data/pertanyaan');
     }

     public function update_pertanyaan()
     {
          $this->form_validation->set_rules('ubah_tanggal_pertanyaan', 'ubah_tanggal_pertanyaan', 'required|trim', [
               'required' => 'Ups, Tanggal pertanyaan harus terisi!'
          ]);

          $this->form_validation->set_rules('ubah_surveyor_pertanyaan', 'ubah_surveyor_pertanyaan', 'required|trim', [
               'required' => 'Ups, Surveyor harus terisi!'
          ]);

          $this->form_validation->set_rules('update_pertanyaan', 'update_pertanyaan', 'required|trim', [
               'required' => 'Ups, Pertanyaan harus terisi!'
          ]);
          $this->form_validation->set_rules('update_kategori_pertanyaan', 'update_kategori_pertanyaan', 'required', [
               'required' => 'Ups, Kategori pertanyaan harus terisi!',
          ]);
          $this->form_validation->set_rules('update_indikator_pertanyaan', 'update_indikator_pertanyaan', 'required', [
               'required' => 'Ups, indikator pertanyaan harus terisi!',
          ]);
          $this->form_validation->set_rules('update_padukuhan_pertanyaan', 'update_padukuhan_pertanyaan', 'required|trim', [
               'required' => 'Ups, Padukuhan harus terisi!'
          ]);
          $this->form_validation->set_rules('update_skor_pertanyaan', 'update_skor_pertanyaan', 'required|trim', [
               'required' => 'Ups, Skor Pertanyaan harus terisi!',
          ]);

          if ($this->form_validation->run() == false) {
               $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
               $data['title'] = 'Manajemen Data';
               $data['sub_title'] = 'pertanyaan';
               $data['surveyor'] = $this->db->get('user')->result_array();
               $data['kategori'] = $this->db->get('kategori')->result_array();
               $data['indikator'] = $this->db->get('indikator')->result_array();
               $data['padukuhan'] = $this->db->get('padukuhan')->result_array();
               $data['data_pertanyaan'] = $this->db->select('pertanyaan.id_pertanyaan, pertanyaan.pertanyaan, pertanyaan.skor, kategori.nama_kategori  as kategori, padukuhan.nama_padukuhan as padukuhan, pertanyaan.id_kategori as id_kategori, pertanyaan.id_padukuhan as id_padukuhan, user.name as surveyor, pertanyaan.tanggal_survey as tanggal, user.id as id_surveyor, indikator.nama_indikator as indikator, pertanyaan.id_indikator as id_indikator')
                    ->from('pertanyaan')
                    ->join('kategori', 'kategori.id_kategori = pertanyaan.id_kategori')
                    ->join('padukuhan', 'padukuhan.id_padukuhan = pertanyaan.id_padukuhan')
                    ->join('user', 'user.id = pertanyaan.id_surveyor')
                    ->join('indikator', 'pertanyaan.id_indikator = indikator.id_indikator')
                    ->get()->result_array();
               $this->load->view('templates/dashboard/dashboard_header', $data);
               $this->load->view('templates/dashboard/sidebar', $data);
               $this->load->view('templates/dashboard/topbar', $data);
               $this->load->view('manajemen_data/pertanyaan', $data);
               $this->load->view('templates/dashboard/dashboard_footer');
          } else {
               $id_pertanyaan = $this->input->post('update_id_pertanyaan', true);
               $data = [
                    // 'id_pertanyaan' => null,
                    'tanggal_survey' => htmlspecialchars($this->input->post('ubah_tanggal_pertanyaan', true)),
                    'id_surveyor' => htmlspecialchars($this->input->post('ubah_surveyor_pertanyaan', true)),
                    'pertanyaan' => htmlspecialchars($this->input->post('update_pertanyaan', true)),
                    'id_kategori' => htmlspecialchars($this->input->post('update_kategori_pertanyaan', true)),
                    'id_indikator' => htmlspecialchars($this->input->post('update_indikator_pertanyaan', true)),
                    'id_padukuhan' => htmlspecialchars($this->input->post('update_padukuhan_pertanyaan', true)),
                    'skor' => htmlspecialchars($this->input->post('update_skor_pertanyaan', true)),
               ];

               $this->db->where('id_pertanyaan', $id_pertanyaan);
               $this->db->update('pertanyaan', $data);

               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">pertanyaan berhasil diupdate!</div>');
               redirect('manajemen_data/pertanyaan');
          }
     }

     public function keputusan(){
          $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
          $data['title'] = 'Hasil Keputusan';
          $data['sub_title'] = 'keputusan';
          $data['data_indikator'] = $this->db->get('indikator')->result_array();

          $this->load->view('templates/dashboard/dashboard_header', $data);
          $this->load->view('templates/dashboard/sidebar', $data);
          $this->load->view('templates/dashboard/topbar', $data);
          $this->load->view('manajemen_data/keputusan', $data);
          $this->load->view('templates/dashboard/dashboard_footer');
     }

     public function hitungfuzzy(){
          $sdm = (float)$this->input->post('sdm', true);
          $kl  = (float)$this->input->post('kl', true);
          $psr = (float)$this->input->post('psr', true);

          $hasil = fuzymamdani( $sdm,$kl,$psr );

          echo json_encode(['hsl'=>$hasil]);
     }
}
