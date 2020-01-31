<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Jadwal extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Jadwal_model', 'jadwal');
	}

	public function index_get()
	{
		$id = $this->get('id');
		if($id == null) {
			$jadwal = $this->jadwal->getJadwal();
		} else {
			$jadwal = $this->jadwal->getJadwal($id);
		}
		
		if ($jadwal) {
			$this->response([
				'status' => true,
				'data' => $jadwal
			], REST_Controller::HTTP_OK);
		} else{
			$this->response([
				'status' => false,
				'message' => 'id not found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_delete()
	{
		$id = $this->delete('id');

		if ($id === null) {
			$this->response([
				'status' => false,
				'message' => 'not ID'
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			if ( $this->jadwal->deleteJadwal($id) > 0) {
				$this->response([
					'status' => true,
					'id' => $id,
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

	public function index_post()
	{
		$data = [
			'id' => $this->post('id'),
			'matakulia' => $this->post('matakulia'),
			'dosen1' => $this->post('dosen1'),
			'dosen2' => $this->post('dosen2'),
			'ruangan' => $this->post('ruangan'),
			'waktu' => $this->post('waktu')
		];

		if($this->jadwal->createJadwal($data) > 0) {
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
		$id = $this->put('id');
		$data = [
			'matakulia' => $this->put('matakulia'),
			'dosen1' => $this->put('dosen1'),
			'dosen2' => $this->put('dosen2'),
			'ruangan' => $this->put('ruangan'),
			'waktu' => $this->put('waktu')
		];

		if($this->jadwal->updateJadwal($data, $id) > 0) {
			$this->response([
				'status' => true,
				'message' => 'Updated'
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'failed'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	/* public function index_get()
	{
		$jadwal = $this->jadwal->getJadwal();
		
		if ($jadwal) {
			$this->response([
				'status' => true,
				'data' => $jadwal
			], REST_Controller::HTTP_NOT_FOUND);
		}
	} */
}
