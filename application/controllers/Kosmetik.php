<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kosmetik extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model("kosmetik_model");
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	public function index()
	{
		$data =  array(
			'halaman' => 'Kosmetik',
			'kosmetik' => $this->kosmetik_model->getAll()
		);
		$this->template->load('template/index', 'pages/kosmetik/read', $data, false);
	}

	public function create()
	{
		$data =  array(
			'halaman' => 'Kosmetik'
		);
		$this->template->load('template/index', 'pages/kosmetik/create', $data, false);
	}
	public function createSave()
	{
		$this->form_validation->set_rules('merek', 'Merek', 'required|min_length[5]', array('required' => 'Merek harus diisi', 'min_length' => 'Minimal text 5'));
		$this->form_validation->set_rules('harga', 'Harga', 'required|integer', array('required' => 'Harga harus diisi', 'integer' => 'Harga harus berupa angka'));
		$this->form_validation->set_rules('stok', 'Stok', 'required|integer', array('required' => 'Stok harus diisi', 'integer' => 'Stok harus berupa angka'));
		if (empty($_FILES['gambar']['name'])) {
			$this->form_validation->set_rules('gambar', 'File', 'required', array('required' => 'Gambar wajib di isi'));
		}
		if ($this->form_validation->run() == true) {
			$dname = explode(".", $_FILES['gambar']['name']);
			$ext = end($dname);
			$newName = $_FILES['gambar']['name'] = strtolower('kosmetik-' . date('YmdHis') . '.' . $ext);
			$config['upload_path']          = 'upload/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 1024;
			$config['max_width']            = 1080;
			$config['max_height']           = 1080;
			$config['file_name'] = $newName;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('gambar')) {
				$error = array('error' => $this->upload->display_errors());
				$data =  array(
					'halaman' => 'Kosmetik',
					'error' => $error
				);
				$this->template->load('template/index', 'pages/kosmetik/create', $data, false);
			} else {
				$data['id_kosmetik'] = null;
				$data['merek_kosmetik'] = $this->input->post('merek');
				$data['harga'] = $this->input->post('harga');
				$data['stok'] = $this->input->post('stok');
				$data['gambar'] = $newName;
				$this->kosmetik_model->save($data);
				$this->session->set_flashdata('success', 'Anda Telah Berhasil Menambah Data Kosmetik');
				redirect('kosmetik');
			}
		} else {

			$data =  array(
				'halaman' => 'Kosmetik'
			);
			$this->template->load('template/index', 'pages/kosmetik/create', $data, false);
		}
	}

	public function update($idKosmetik)
	{
		$data =  array(
			'halaman' => 'Kosmetik',
			'kosmetik' => $this->kosmetik_model->getById($idKosmetik)
		);
		$this->template->load('template/index', 'pages/kosmetik/update', $data, false);
	}

	public function updateSave()
	{
		$this->form_validation->set_rules('merek', 'Merek', 'required', array('required' => 'Merek harus diisi'));
		$this->form_validation->set_rules('harga', 'Harga', 'required|integer', array('required' => 'Harga harus diisi', 'integer' => 'Harga harus berupa angka'));
		$this->form_validation->set_rules('stok', 'Stok', 'required|integer', array('required' => 'Stok harus diisi', 'integer' => 'Stok harus berupa angka'));
		$idKosmetik =  $this->input->post('id');;
		$data['merek_kosmetik'] = $this->input->post('merek');
		$data['harga'] = $this->input->post('harga');
		$data['stok'] = $this->input->post('stok');
		$data['gambar'] = $this->input->post('gambar');
		if ($this->form_validation->run() == true) {
			if (!empty($_FILES['gambar']['name'])) {
				$dname = explode(".", $_FILES['gambar']['name']);
				$ext = end($dname);
				$newName = $_FILES['gambar']['name'] = strtolower('kosmetik-' . date('YmdHis') . '.' . $ext);
				$config['upload_path']          = 'upload/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 1024;
				$config['max_width']            = 1080;
				$config['max_height']           = 1080;
				$config['file_name'] = $newName;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					$error = array('error' => $this->upload->display_errors());
					$data =  array(
						'halaman' => 'Kosmetik',
						'error' => $error
					);
					$this->template->load('template/index', 'pages/kosmetik/create', $data, false);
				}
				$gambar = $this->input->post('gambar');
				if (file_exists('upload/' . $gambar)) {
					unlink('upload/' . $gambar);
				}
				$data['gambar'] = $newName;
				$this->kosmetik_model->update($data, $idKosmetik);
				$this->session->set_flashdata('success', 'Anda Telah Berhasil Update Data Kosmetik');
			} else {
				$this->kosmetik_model->update($data, $idKosmetik);
				$this->session->set_flashdata('success', 'Anda Telah Berhasil Update Data Kosmetik');
			}
			redirect('kosmetik');
		}
	}
	public function delete($idKosmetik)
	{
		$data = $this->kosmetik_model->getById($idKosmetik);
		$gambar = $data->gambar;
		if (file_exists('upload/' . $gambar)) {
			unlink('upload/' . $gambar);
		}
		$this->kosmetik_model->delete($idKosmetik);
		$this->session->set_flashdata('success', 'Anda Telah Berhasil Menghapus Data Kosmetik');
		redirect('kosmetik');
	}
}
