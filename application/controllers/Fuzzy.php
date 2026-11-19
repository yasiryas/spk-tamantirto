<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fuzzy extends MY_Controller
{
    public function index()
    {
        redirect('fuzzy/hasil');
    }

    public function hasil()
    {
        $this->requireRole('admin', 'super_user');

        $tahun = $this->input->get('tahun', true) ?: date('Y');
        $data = [
            'tahun' => $tahun,
            'tahunTersedia' => $this->fuzzy_model->tahunTersedia(),
            'hasil' => $this->fuzzy_model->hasil(null, $tahun),
            'ringkasan' => $this->fuzzy_model->ringkasan($tahun),
        ];

        $this->render('fuzzy/hasil', 'Hasil Perhitungan', $data);
    }

    public function detail(int $idPadukuhan)
    {
        $this->requireRole('admin', 'super_user');

        $tahun = $this->input->get('tahun', true) ?: date('Y');
        $data = [
            'detail' => $this->fuzzy_model->hitung($idPadukuhan, $tahun),
            'tahun' => $tahun,
        ];

        $this->render('fuzzy/detail', 'Detail Perhitungan', $data);
    }

    public function hitung()
    {
        $this->requireRole('admin', 'super_user');

        if ($this->input->method() === 'post') {
            $tahun = $this->input->post('tahun', true) ?: date('Y');
            $jumlah = $this->fuzzy_model->hitungSemua($tahun);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $jumlah . ' padukuhan berhasil dihitung untuk tahun ' . htmlspecialchars($tahun, ENT_QUOTES, 'UTF-8') . '.</div>');
            redirect('fuzzy/hasil?tahun=' . rawurlencode($tahun));
        }

        $this->render('fuzzy/hitung', 'Hitung Ulang', [
            'tahun' => date('Y'),
            'jumlahPadukuhan' => $this->master_model->count('padukuhan'),
        ]);
    }

    public function metode()
    {
        check_login();

        $this->render('fuzzy/metode', 'Metode Fuzzy Mamdani', [
            'variabel' => Fuzzy_model::VARIABLES,
            'keluaran' => Fuzzy_model::OUTPUT,
            'label' => Fuzzy_model::LABELS,
            'aturan' => $this->fuzzy_model->aturan(),
        ]);
    }
}
