<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->requireRole('admin', 'super_user');
    }

    public function index()
    {
        $this->render('admin/index', 'Dashboard', [
            'padukuhan' => $this->master_model->count('padukuhan'),
            'indikator' => $this->master_model->count('indikator'),
            'kategori' => $this->master_model->count('kategori'),
            'pertanyaan' => $this->master_model->count('pertanyaan'),
            'ringkasan' => $this->fuzzy_model->ringkasan(),
            'hasil' => $this->fuzzy_model->hasil(),
            'kategoriRingkasan' => $this->master_model->ringkasanKategori(),
        ]);
    }
}
