<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function findByEmail(string $email): ?array
    {
        return $this->db->get_where('user', ['email' => $email])->row_array() ?: null;
    }

    public function findById(int $id): ?array
    {
        return $this->db->get_where('user', ['id' => $id])->row_array() ?: null;
    }

    public function all(): array
    {
        return $this->db->order_by('id', 'ASC')->get('user')->result_array();
    }

    public function create(array $data): bool
    {
        return $this->db->insert('user', $data);
    }

    public function update(int $id, array $data): bool
    {
        $this->db->where('id', $id);

        return $this->db->update('user', $data);
    }

    public function delete(int $id): bool
    {
        return $this->db->delete('user', ['id' => $id]);
    }
}
