<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
          $this->load->view('users/index', $data);
          $this->load->view('templates/dashboard/dashboard_footer');
     }

     public function myprofile()
     {
          $data['title'] = 'My Profile';
          $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

          $this->load->view('templates/dashboard/dashboard_header', $data);
          $this->load->view('templates/dashboard/sidebar', $data);
          $this->load->view('templates/dashboard/topbar', $data);
          $this->load->view('users/myprofile', $data);
          $this->load->view('templates/dashboard/dashboard_footer');
     }


     public function hasil_keputusan()
     {
          $data['title'] = 'Hasil Keputusan';
          $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

          $this->load->view('templates/dashboard/dashboard_header', $data);
          $this->load->view('templates/dashboard/sidebar', $data);
          $this->load->view('templates/dashboard/topbar', $data);
          $this->load->view('users/hasil_keputusan', $data);
          $this->load->view('templates/dashboard/dashboard_footer');
     }
}
