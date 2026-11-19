<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manajemen_data extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->requireRole('admin', 'super_user');
    }

    public function index()
    {
        redirect('manajemen_data/padukuhan');
    }

    public function padukuhan()
    {
        $this->masterPage('padukuhan', 'manajemen_data/padukuhan', 'Data Padukuhan', [
            'data_padukuhan' => $this->master_model->all('padukuhan', 'nama_padukuhan'),
        ]);
    }

    public function tambah_padukuhan()
    {
        $this->simpanMaster('padukuhan', 'id_padukuhan', 'nama_padukuhan', 'manajemen_data/padukuhan', 'Padukuhan');
    }

    public function update_padukuhan()
    {
        $this->simpanMaster('padukuhan', 'id_padukuhan', 'nama_padukuhan', 'manajemen_data/padukuhan', 'Padukuhan');
    }

    public function hapus_padukuhan()
    {
        $this->hapusMaster('padukuhan', 'id_padukuhan', 'manajemen_data/padukuhan', 'Padukuhan');
    }

    public function kategori()
    {
        $this->masterPage('kategori', 'manajemen_data/kategori', 'Data Kategori', [
            'data_kategori' => $this->master_model->all('kategori', 'nama_kategori'),
        ]);
    }

    public function tambah_kategori()
    {
        $this->simpanKategori();
    }

    public function update_kategori()
    {
        $this->simpanKategori();
    }

    public function hapus_kategori()
    {
        $this->hapusMaster('kategori', 'id_kategori', 'manajemen_data/kategori', 'Kategori');
    }

    public function indikator()
    {
        $this->masterPage('indikator', 'manajemen_data/indikator', 'Data Indikator', [
            'data_indikator' => $this->master_model->all('indikator', 'id_indikator'),
        ]);
    }

    public function tambah_indikator()
    {
        $this->simpanIndikator();
    }

    public function update_indikator()
    {
        $this->simpanIndikator();
    }

    public function hapus_indikator()
    {
        $this->hapusMaster('indikator', 'id_indikator', 'manajemen_data/indikator', 'Indikator');
    }

    public function survey()
    {
        $this->masterPage('survey', 'manajemen_data/survey', 'Data Survey', [
            'data_survey' => $this->db->select('s.id_survey, s.id_user, s.id_pertanyaan, s.tanggal_survey, u.name AS surveyor, q.pertanyaan')
                ->from('survey s')
                ->join('user u', 'u.id = s.id_user')
                ->join('pertanyaan q', 'q.id_pertanyaan = s.id_pertanyaan')
                ->order_by('s.tanggal_survey', 'DESC')
                ->get()->result_array(),
            'surveyor' => $this->master_model->all('user', 'name'),
            'pertanyaan' => $this->master_model->all('pertanyaan', 'pertanyaan'),
        ]);
    }

    public function tambah_survey()
    {
        $this->simpanSurvey();
    }

    public function update_survey()
    {
        $this->simpanSurvey();
    }

    public function hapus_survey()
    {
        $this->hapusMaster('survey', 'id_survey', 'manajemen_data/survey', 'Survey');
    }

    public function pertanyaan()
    {
        $this->masterPage('pertanyaan', 'manajemen_data/pertanyaan', 'Data Pertanyaan', [
            'data_pertanyaan' => $this->db->select('p.*, k.nama_kategori, i.nama_indikator, d.nama_padukuhan, u.name AS surveyor')
                ->from('pertanyaan p')
                ->join('kategori k', 'k.id_kategori = p.id_kategori')
                ->join('indikator i', 'i.id_indikator = p.id_indikator')
                ->join('padukuhan d', 'd.id_padukuhan = p.id_padukuhan')
                ->join('user u', 'u.id = p.id_surveyor')
                ->order_by('p.tanggal_survey', 'DESC')
                ->get()->result_array(),
            'surveyor' => $this->master_model->all('user', 'name'),
            'kategori' => $this->master_model->all('kategori', 'nama_kategori'),
            'indikator' => $this->master_model->all('indikator', 'id_indikator'),
            'padukuhan' => $this->master_model->all('padukuhan', 'nama_padukuhan'),
        ]);
    }

    public function tambah_pertanyaan()
    {
        $this->simpanPertanyaan();
    }

    public function update_pertanyaan()
    {
        $this->simpanPertanyaan();
    }

    public function hapus_pertanyaan()
    {
        $this->hapusMaster('pertanyaan', 'id_pertanyaan', 'manajemen_data/pertanyaan', 'Pertanyaan');
    }

    private function masterPage(string $table, string $view, string $title, array $data)
    {
        $data['sub_title'] = $table;
        $this->render($view, $title, $data);
    }

    private function simpanMaster(string $table, string $idField, string $field, string $redirect, string $label)
    {
        $id = (int) $this->input->post($idField, true);
        $nilai = trim((string) $this->input->post($field, true));

        if ($nilai === '') {
            $this->flash($label . ' tidak boleh kosong.', 'danger');
            redirect($redirect);
        }

        $ada = $this->master_model->findWhere($table, [$field => $nilai]);
        if ($ada !== null && (int) $ada[$idField] !== $id) {
            $this->flash($label . ' sudah terdaftar.', 'danger');
            redirect($redirect);
        }

        $data = [$field => $nilai];
        if ($id > 0) {
            $this->master_model->update($table, $idField, $id, $data);
        } else {
            $this->master_model->insert($table, $data);
        }

        $this->flash($label . ' berhasil disimpan.');
        redirect($redirect);
    }

    private function simpanKategori()
    {
        $id = (int) $this->input->post('id_kategori', true);
        $nama = trim((string) $this->input->post('nama_kategori', true));
        $ikon = kategori_icon($nama, $this->input->post('ikon', true));
        $data = ['nama_kategori' => $nama, 'ikon' => $ikon];

        if ($nama === '') {
            $this->flash('Nama kategori tidak boleh kosong.', 'danger');
            redirect('manajemen_data/kategori');
        }

        $ada = $this->master_model->findWhere('kategori', ['nama_kategori' => $nama]);
        if ($ada !== null && (int) $ada['id_kategori'] !== $id) {
            $this->flash('Kategori sudah terdaftar.', 'danger');
            redirect('manajemen_data/kategori');
        }

        if ($id > 0) {
            $this->master_model->update('kategori', 'id_kategori', $id, $data);
        } else {
            $this->master_model->insert('kategori', $data);
        }

        $this->flash('Kategori berhasil disimpan.');
        redirect('manajemen_data/kategori');
    }

    private function simpanIndikator()
    {
        $id = (int) $this->input->post('id_indikator', true);
        $data = [
            'nama_indikator' => trim((string) $this->input->post('nama_indikator', true)),
            'kode_indikator' => strtoupper(trim((string) $this->input->post('kode_indikator', true))),
            'skor_maksimal' => (int) $this->input->post('skor_maksimal', true),
        ];

        if ($data['nama_indikator'] === '' || $data['kode_indikator'] === '' || $data['skor_maksimal'] <= 0) {
            $this->flash('Nama, kode, dan skor maksimal wajib diisi.', 'danger');
            redirect('manajemen_data/indikator');
        }

        $ada = $this->master_model->findWhere('indikator', ['kode_indikator' => $data['kode_indikator']]);
        if ($ada !== null && (int) $ada['id_indikator'] !== $id) {
            $this->flash('Kode indikator sudah terdaftar.', 'danger');
            redirect('manajemen_data/indikator');
        }

        if ($id > 0) {
            $this->master_model->update('indikator', 'id_indikator', $id, $data);
        } else {
            $this->master_model->insert('indikator', $data);
        }

        $this->flash('Indikator berhasil disimpan.');
        redirect('manajemen_data/indikator');
    }

    private function simpanSurvey()
    {
        $id = (int) $this->input->post('id_survey', true);
        $data = [
            'id_user' => (int) $this->input->post('id_user', true),
            'id_pertanyaan' => (int) $this->input->post('id_pertanyaan', true),
            'tanggal_survey' => $this->input->post('tanggal_survey', true) ?: date('Y-m-d'),
        ];

        if ($data['id_user'] <= 0 || $data['id_pertanyaan'] <= 0) {
            $this->flash('Surveyor dan pertanyaan wajib dipilih.', 'danger');
            redirect('manajemen_data/survey');
        }

        if ($id > 0) {
            $this->master_model->update('survey', 'id_survey', $id, $data);
        } else {
            $this->master_model->insert('survey', $data);
        }

        $this->flash('Survey berhasil disimpan.');
        redirect('manajemen_data/survey');
    }

    private function simpanPertanyaan()
    {
        $id = (int) $this->input->post('id_pertanyaan', true);
        $data = [
            'tanggal_survey' => $this->input->post('tanggal_survey', true) ?: date('Y-m-d'),
            'id_surveyor' => (int) $this->input->post('id_surveyor', true),
            'pertanyaan' => trim((string) $this->input->post('pertanyaan', true)),
            'id_kategori' => (int) $this->input->post('id_kategori', true),
            'id_indikator' => (int) $this->input->post('id_indikator', true),
            'id_padukuhan' => (int) $this->input->post('id_padukuhan', true),
            'skor' => (int) $this->input->post('skor', true),
        ];

        if ($data['pertanyaan'] === '' || in_array(0, [$data['id_surveyor'], $data['id_kategori'], $data['id_indikator'], $data['id_padukuhan']], true)) {
            $this->flash('Semua field wajib diisi.', 'danger');
            redirect('manajemen_data/pertanyaan');
        }

        if ($id > 0) {
            $this->master_model->update('pertanyaan', 'id_pertanyaan', $id, $data);
        } else {
            $this->master_model->insert('pertanyaan', $data);
        }

        $this->flash('Pertanyaan berhasil disimpan.');
        redirect('manajemen_data/pertanyaan');
    }

    private function hapusMaster(string $table, string $idField, string $redirect, string $label)
    {
        $id = (int) $this->input->post($idField, true);
        if ($id > 0) {
            $this->master_model->delete($table, $idField, $id);
            $this->flash($label . ' berhasil dihapus.');
        }

        redirect($redirect);
    }

    private function flash(string $pesan, string $jenis = 'success')
    {
        $this->session->set_flashdata('message', '<div class="alert alert-' . $jenis . '" role="alert">' . htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8') . '</div>');
    }
}
