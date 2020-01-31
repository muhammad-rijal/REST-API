<?php

/*
class Jadwal_model extends CI_Model
{
	public function getJadwal()
	{
		return $this->db->get('jadwalmatkul')->result_array();
	}
} */

class Jadwal_model extends CI_Model
{
	public function getJadwal($id = null)
	{
		if($id === null) {
			return $this->db->get('jadwalmatkul')->result_array();
		} else {
			return $this->db->get_where('jadwalmatkul', ['id' => $id])->result_array();
		}	
	}

	public function deleteJadwal($id)
	{
		$this->db->delete('jadwalmatkul', ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function createJadwal($data)
	{
		$this->db->insert('jadwalmatkul', $data);
		return $this->db->affected_rows();
	}

	public function updateJadwal($data, $id)
	{
		$this->db->update('jadwalmatkul', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}

}
