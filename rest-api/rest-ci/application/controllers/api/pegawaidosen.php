<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class pegawaidosen extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pegawaidosen_model', 'dosen');
	}

	public function index_get()
	{
		$posisi = $this->get('posisi');
		
		$PegawaiDosen = $this->dosen->getpegawaidosen($posisi = 1);
	
		if ($PegawaiDosen) {
			$this->response([
				'status' => true,
				'data' => $PegawaiDosen
			], REST_Controller::HTTP_OK);
		} else{
			$this->response([
				'status' => false,
				'message' => 'id not found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

}
