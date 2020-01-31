<?php

/*
class Jadwal_model extends CI_Model
{
	public function getJadwal()
	{
		return $this->db->get('jadwalmatkul')->result_array();
	}
} */

class ProfilPegawai_model extends CI_Model
{
	/* public function getProfilPegawai($nip = null)
	{
		if($nip === null) {
			if($posisi === null) {
				return $this->db->get('profilpegawai')->result_array();
			} else {
				return $this->db->get_where('profilpegawai', ['posisi' => $posisi])->result_array();
			}
		} else {
			return $this->db->get_where('profilpegawai', ['nip' => $nip])->result_array();
		}
	} */

	public function getProfilPegawai($nip = null)
	{
		if($nip === null) {
			return $this->db->get('profilpegawai')->result_array();
		} else {
			return $this->db->get_where('profilpegawai', ['nip' => $nip])->result_array();
		}
	}

	public function createProfilPegawai($data)
	{
		$this->db->insert('profilpegawai', $data);
		return $this->db->affected_rows();
	}

	public function updateProfilPegawai($data, $nip)
	{
		$this->db->update('profilpegawai', $data, ['nip' => $nip]);
		return $this->db->affected_rows();
	}

	public function deleteProfilPegawai($nip)
	{
		$this->db->delete('profilpegawai', ['nip' => $nip]);
		return $this->db->affected_rows();
	}

}
