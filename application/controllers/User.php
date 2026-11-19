<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
    }

    public function index()
    {
        $data = [
            'padukuhan' => $this->master_model->count('padukuhan'),
            'indikator' => $this->master_model->count('indikator'),
            'pertanyaan' => $this->master_model->count('pertanyaan'),
            'survey' => $this->master_model->count('survey'),
            'ringkasan' => $this->fuzzy_model->ringkasan(),
            'hasil' => $this->fuzzy_model->hasil(),
            'kategoriRingkasan' => $this->master_model->ringkasanKategori(),
        ];

        $this->render('users/index', 'Dashboard', $data);
    }

    public function hasil_keputusan()
    {
        $this->render('users/hasil_keputusan', 'Rekap Potensi', [
            'hasil' => $this->fuzzy_model->hasil(),
            'ringkasan' => $this->fuzzy_model->ringkasan(),
            'kategoriRingkasan' => $this->master_model->ringkasanKategori(),
        ]);
    }

    public function myprofile()
    {
        $this->render('users/myprofile', 'Profil Saya');
    }
}
