<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{
    public function index()
    {
        $kategori = $this->master_model->ringkasanKategori();
        $data = [
            'title' => 'Peta Potensi Kalurahan Tamantirto',
            'ringkasan' => $this->fuzzy_model->ringkasan(),
            'hasil' => $this->fuzzy_model->hasil(),
            'jumlahPadukuhan' => $this->master_model->count('padukuhan'),
            'kategoriRingkasan' => $kategori,
            'jumlahKategori' => count($kategori),
        ];

        $this->load->view('templates/landing/header', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/landing/footer', $data);
    }
}
