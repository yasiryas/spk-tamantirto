<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
     public function __construct()
     {
          parent::__construct();
          check_login();
     }

     public function index()
     {
          $data['title'] = 'Dashboard';
          $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
          $data['padukuhan'] = $this->db->count_all_results('padukuhan');
          $data['indikator'] = $this->db->count_all_results('indikator');
          $data['kategori'] = $this->db->count_all_results('kategori');
          $data['survey'] = $this->db->count_all_results('pertanyaan');

          $this->load->view('templates/dashboard/dashboard_header', $data);
          $this->load->view('templates/dashboard/sidebar', $data);
          $this->load->view('templates/dashboard/topbar', $data);
          $this->load->view('admin/index', $data);
          $this->load->view('templates/dashboard/dashboard_footer');
     }
}
