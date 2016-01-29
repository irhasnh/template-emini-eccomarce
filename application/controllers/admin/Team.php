<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {
	
	// Load db
	public function __construct() {
		parent::__construct();
        $this->load->model('team_model');
	}
	// Index
	public function index() {
		$team = $this->team_model->listing();
		// Default page
		$data = array( 	'title' 		=> 'Manajemen Client',
						'team'			=> $team,
						'isi'	 		=> 'admin/team/list');
		$this->load->view('admin/layout/wrapper', $data);
	}
	// Tambah
	public function tambah() {		
		// Validasi
		$valid = $this->form_validation;
		$valid->set_rules('nama_member','Nama Member','required');
		
		if($valid->run()) {
			
			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx|ppt|pptx';
			$config['max_size']			= '1000'; // KB			
			$this->load->library('upload', $config);
			if(! $this->upload->do_upload('gambar')) {
			
		$data = array( 'title' 		=> 'Tambah Sponsor',
						'error'		=> $this->upload->display_errors(),
						'isi' 		=> 'admin/team/tambah');
		$this->load->view('admin/layout/wrapper', $data);
		}else{
			$upload_data	= array('uploads'	=>	$this->upload->data());
				
			// Image Editor
			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/upload/image/'.$upload_data['uploads']['file_name']; // $_FILES['gambar']['name']
			$config['new_image'] = './assets/upload/image/thumbs/';
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 150; // Pixel
			$config['height'] = 150; // Pixel
			$config['thumb_marker'] = '';
				
			$this->load->library('image_lib', $config);
				
			$this->image_lib->resize();
			$input = $this->input;
			$data = array(	'nama_member'			=> $input->post('nama_member'),
							'motivasi_member'		=> $input->post('motivasi_member'),
							'jabatan_member'		=> $input->post('jabatan_member'),
							'gambar'				=> $upload_data['uploads']['file_name']);
			$this->team_model->add($data);
			$this->session->set_flashdata('sukses','Sponsor berhasil ditambah');
			redirect(base_url('admin/team'));
		}				
	}
		// Default page
		$data = array( 	'title' 	=> 'Tambah Member',
						'isi' 		=> 'admin/team/tambah');
		$this->load->view('admin/layout/wrapper', $data);
	
	}
	
	// Edit
	public function edit($id_member) {
		// Load data
		$team = $this->team_model->detail($id_member);
		// Validasi
		$valid = $this->form_validation;
		$valid->set_rules('nama_member','Nama Member','required');
		
		if($valid->run()) {
			// Kalau gambar kosong atau tidak diupdate
			if(!empty($_FILES['gambar']['name'])) {
				
			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png';
			$config['max_size']			= '1000'; // KB			
			$this->load->library('upload', $config);
			if(! $this->upload->do_upload('gambar')) {
				
		$data = array( 'title' 		=> 'Edit Team',
						'team'		=> $team,
						'error'		=> $this->upload->display_errors(),
						'isi' 		=> 'admin/team/edit');
		$this->load->view('admin/layout/wrapper', $data);
		}else{
			$upload_data	= array('uploads'	=>	$this->upload->data());
				
			// Image Editor
			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/upload/image/'.$upload_data['uploads']['file_name']; // $_FILES['gambar']['name']
			$config['new_image'] = './assets/upload/image/thumbs/';
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 150; // Pixel
			$config['height'] = 150; // Pixel
			$config['thumb_marker'] = '';
				
			$this->load->library('image_lib', $config);
				
			$this->image_lib->resize();
			$input = $this->input;
			$data = array(	'id_member'				=> $input->post('id_member'),
							'nama_member'			=> $input->post('nama_member'),
							'motivasi_member'		=> $input->post('motivasi_member'),
							'jabatan_member'		=> $input->post('jabatan_member'),
							'gambar'				=> $upload_data['uploads']['file_name']);
			$this->team_model->edit($data);
			$this->session->set_flashdata('sukses','Sponsor berhasil diedit');
			redirect(base_url('admin/team'));
		}				
	}else{
		// Update pelajaran tanpa ganti gambar
		$input = $this->input;
		$data = array(	'id_member'				=> $input->post('id_member'),
						'nama_member'			=> $input->post('nama_member'),
						'motivasi_member'		=> $input->post('motivasi_member'),
						'jabatan_member'		=> $input->post('jabatan_member'),
						'gambar'				=> $upload_data['uploads']['file_name']);
		$this->team_model->edit($data);
		$this->session->set_flashdata('sukses','Sponsor berhasil diedit');
		redirect(base_url('admin/team'));
	}}
		// Default page
		$data = array( 'title' 			=> 'Edit Team',
						'team'			=> $team,
						'isi' 			=> 'admin/team/edit');
		$this->load->view('admin/layout/wrapper', $data);
	}
	
	// Delete
	public function delete ($id_member) {
		// Delete Gambar
		$gambar = $this->team_model->detail($id_member);
		unlink('./assets/upload/image/'.$gambar['gambar']);
		unlink('./assets/upload/image/thumbs/'.$gambar['gambar']);
		//Delete Database
		  $data = array('id_member' => $id_member);
		  $this->team_model->delete($data);
		  $this->session->set_flashdata('sukses','Data Sponsor berhasil dihapus');
		  redirect(base_url().'admin/team');
	}
	// Download
	public function download($id_member) {
		$file 	= $this->team_model->detail($id_member);
		$files	= $file['gambar'];
		// Read the file's contents
		$data	= file_get_contents(base_url()."assets/upload/image/".$files);
		$name	= $files;
		$this->load->helper('download');
		force_download($name, $data);
	}
}

