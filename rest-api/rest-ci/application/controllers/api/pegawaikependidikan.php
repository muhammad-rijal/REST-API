<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class pegawaikependidikan extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pegawaikependidikan_model', 'dosen');
	}

	public function index_get()
	{
		$posisi = $this->get('posisi');
		
		$PegawaiKependidikan = $this->dosen->getpegawaikependidikan($posisi = 0);
	
		if ($PegawaiKependidikan) {
			$this->response([
				'status' => true,
				'data' => $PegawaiKependidikan
			], REST_Controller::HTTP_OK);
		} else{
			$this->response([
				'status' => false,
				'message' => 'id not found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

}
