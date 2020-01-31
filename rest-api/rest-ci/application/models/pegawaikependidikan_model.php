<?php

class pegawaikependidikan_model extends CI_Model
{
	public function getpegawaikependidikan($posisi = 0)
	{
		return $this->db->get_where('profilpegawai', ['posisi' => $posisi])->result_array();
	}
}
