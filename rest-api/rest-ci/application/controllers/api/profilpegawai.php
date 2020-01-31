<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class ProfilPegawai extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProfilPegawai_model', 'pegawai');
	}

	/* public function index_get()
	{
		$nip = $this->get('nip');
		$posisi = $this->get('posisi');
		if($nip == null) {
			if($posisi == null) {
				$ProfilPegawai = $this->pegawai->getProfilPegawai();
			} else {
				$ProfilPegawai = $this->pegawai->getProfilPegawai($posisi);
			}
		} else {
			$ProfilPegawai = $this->pegawai->getProfilPegawai($nip);
		}
		
		if ($ProfilPegawai) {
			$this->response([
				'status' => true,
				'data' => $ProfilPegawai
			], REST_Controller::HTTP_OK);
		} else{
			$this->response([
				'status' => false,
				'message' => 'id not found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	} */


	public function index_get()
	{
		$nip = $this->get('nip');
		if($nip == null) {
			$ProfilPegawai = $this->pegawai->getProfilPegawai();
		} else {
			$ProfilPegawai = $this->pegawai->getProfilPegawai($nip);
		}
		
		if ($ProfilPegawai) {
			$this->response([
				'status' => true,
				'data' => $ProfilPegawai
			], REST_Controller::HTTP_OK);
		} else{
			$this->response([
				'status' => false,
				'message' => 'id not found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	} 

	public function index_post()
	{
		$data = [
			'nama' => $this->post('nama'),
			'nip' => $this->post('nip'),
			'gender' => $this->post('gender'),
			'unitkerja' => $this->post('unitkerja'),
			'posisi' => $this->post('posisi')
		];

		if($this->pegawai->createProfilPegawai($data) > 0) {
			$this->response([
				'status' => true,
				'message' => 'Create'
			], REST_Controller::HTTP_CREATED);
		} else {
			$this->response([
				'status' => false,
				'message' => 'failed'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function index_put()
	{
		$nip = $this->put('nip');
		$data = [
			'nama' => $this->put('nama'),
			'gender' => $this->put('gender'),
			'unitkerja' => $this->put('unitkerja'),
			'posisi' => $this->put('posisi')
		];

		if($this->pegawai->updateProfilPegawai($data, $nip) > 0) {
			$this->response([
				'status' => true,
				'message' => 'Update'
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'failed'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function index_delete()
	{
		$nip = $this->delete('nip');

		if ($nip === null) {
			$this->response([
				'status' => false,
				'message' => 'not NIP'
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			if ( $this->pegawai->deleteProfilPegawai($nip) > 0) {
				$this->response([
					'status' => true,
					'nip' => $nip,
					'message' => 'Deleted'
				], REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => false,
					'message' => 'not found'
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}
}
