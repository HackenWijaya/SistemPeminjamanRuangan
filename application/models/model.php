<?php
class model extends CI_Model
{
	public function get_data($table)
	{
		return $this->db->get($table);
	}

	public function get_datawithadd($table, $additional)
	{
		return $this->db->query("SELECT * FROM " . $table . ' ' . $additional);
	}

	public function get_join($table, $join, $where)
	{
		$query = "SELECT * FROM " . $table . " INNER JOIN " . $join . " WHERE " . $where;
		return $this->db->query($query);
	}

	public function getwhere($table, $where)
	{
		return $this->db->get_where($table, $where);
	}
	public function add_data($table, $array)
	{
		return $this->db->insert($table, $array);
	}

	public function updatedata($table, $array, $where)
	{
		$this->db->where($where);
		return $this->db->update($table, $array);
	}

	public function deletedata($table, $where)
	{
		return $this->db->delete($table, $where);
	}
}
