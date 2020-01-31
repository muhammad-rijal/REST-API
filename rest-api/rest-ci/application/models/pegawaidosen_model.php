<?php

class pegawaidosen_model extends CI_Model
{
	public function getpegawaidosen($posisi = 1)
	{
		return $this->db->get_where('profilpegawai', ['posisi' => $posisi])->result_array();
	}
}
