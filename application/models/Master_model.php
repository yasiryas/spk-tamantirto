<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_model extends CI_Model
{
    public function all(string $table, ?string $order = null, string $direction = 'ASC'): array
    {
        if ($order !== null) {
            $this->db->order_by($order, $direction);
        }

        return $this->db->get($table)->result_array();
    }

    public function find(string $table, string $key, $value): ?array
    {
        $row = $this->db->get_where($table, [$key => $value])->row_array();

        return $row ?: null;
    }

    public function findWhere(string $table, array $conditions): ?array
    {
        $row = $this->db->get_where($table, $conditions)->row_array();

        return $row ?: null;
    }

    public function insert(string $table, array $data): bool
    {
        return $this->db->insert($table, $data);
    }

    public function update(string $table, string $key, $value, array $data): bool
    {
        $this->db->where($key, $value);

        return $this->db->update($table, $data);
    }

    public function delete(string $table, string $key, $value): bool
    {
        return $this->db->delete($table, [$key => $value]);
    }

    public function count(string $table, array $conditions = []): int
    {
        if ($conditions !== []) {
            $this->db->where($conditions);
        }

        return $this->db->count_all_results($table);
    }

    public function ringkasanKategori(): array
    {
        return $this->db->select('k.id_kategori, k.nama_kategori, k.ikon, COUNT(p.id_pertanyaan) AS jumlah_pertanyaan, COALESCE(SUM(p.skor), 0) AS total_skor')
            ->from('kategori k')
            ->join('pertanyaan p', 'p.id_kategori = k.id_kategori', 'left')
            ->group_by('k.id_kategori, k.nama_kategori, k.ikon')
            ->order_by('k.id_kategori')
            ->get()
            ->result_array();
    }
}
