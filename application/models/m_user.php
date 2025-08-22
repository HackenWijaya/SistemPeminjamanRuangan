<?php
defined("BASEPATH") or exit("No direct script access allowed");


class m_user extends CI_Model
{
    public $table = 'user';

    public $id = 'user.id_user';

    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getById($nip)
    {
        $this->db->from($this->table);
        $this->db->where('nip', $nip);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getByEmail($email)
    {
        $this->db->from($this->table);
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}