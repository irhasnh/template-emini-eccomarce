<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends CI_Controller {
	
	// Load database
	public function __construct(){
		parent::__construct();
		$this->load->model('galeri_model');
	}

	// Index
	public function index() {
		$galeri	= $this->galeri_model->listing();
		
		$data = array(	'title'	=> 'Manajemen Galeri',
						'galeri'	=> $galeri,
						'isi'	=> 'admin/galeri/list');
		$this->load->view('admin/layout/wrapper',$data);
	}
		
	// Tambah
	public function tambah() {
		// Validasi
		$v = $this->form_validation;
		$v->set_rules('judul','Nama galeri','required');
		
		if($v->run()) {
			
			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png|svg';
			$config['max_size']			= '1000'; // KB			
			$this->load->library('upload', $config);
			if(! $this->upload->do_upload('gambar')) {
		
		$data = array(	'title'		=> 'Tambah Galeri',
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/galeri/tambah');
		$this->load->view('admin/layout/wrapper', $data);
		// Masuk database
		}else{
				$upload_data				= array('uploads' =>$this->upload->data());
				// Image Editor
				$config['image_library']	= 'gd2';
				$config['source_image'] 	= './assets/upload/image/'.$upload_data['uploads']['file_name']; 
				$config['new_image'] 		= './assets/upload/image/thumbs/';
				$config['create_thumb'] 	= TRUE;
				$config['quality'] 			= "100%";
				$config['maintain_ratio'] 	= FALSE;
				$config['width'] 			= 400; // Pixel
				$config['height'] 			= 250; // Pixel
				$config['x_axis'] 			= 0;
				$config['y_axis'] 			= 0;
				$config['thumb_marker'] 	= '';
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				
			$i = $this->input;
			$data = array(	'judul'			=> $i->post('judul'),
							'posisi'		=> $i->post('posisi'),
							'gambar'		=> $upload_data['uploads']['file_name'],
							'keterangan'	=> $i->post('keterangan'),
							'website'		=> $i->post('website'),
							'id_user'		=> $this->session->userdata('id')
							);
			$this->galeri_model->tambah($data);
			$this->session->set_flashdata('sukses','Galeri telah ditambah');
			redirect(base_url('admin/galeri'));
		}}
		// End masuk database
		$data = array(	'title'		=> 'Tambah Galeri',
						'isi'		=> 'admin/galeri/tambah');
		$this->load->view('admin/layout/wrapper', $data);
	}
	
	// Edit
	public function edit($id_galeri) {
		// Dari database
		$galeri		= $this->galeri_model->detail($id_galeri);
		// Validasi
		$v = $this->form_validation;
		$v->set_rules('judul','Nama galeri','required');
		
		if($v->run()) {
			if(!empty($_FILES['gambar']['name'])) {
			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png|svg';
			$config['max_size']			= '1000'; // KB			
			$this->load->library('upload', $config);
			if(! $this->upload->do_upload('gambar')) {
		
		$data = array(	'title'		=> 'Edit Galeri',
						'galeri'	=> $galeri,
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/galeri/edit');
		$this->load->view('admin/layout/wrapper', $data);
		// Masuk database
		}else{
				$upload_data				= array('uploads' =>$this->upload->data());
				// Image Editor
				$config['image_library']	= 'gd2';
				$config['source_image'] 	= './assets/upload/image/'.$upload_data['uploads']['file_name']; 
				$config['new_image'] 		= './assets/upload/image/thumbs/';
				$config['create_thumb'] 	= TRUE;
				$config['quality'] 			= "100%";
				$config['maintain_ratio'] 	= FALSE;
				$config['width'] 			= 400; // Pixel
				$config['height'] 			= 250; // Pixel
				$config['x_axis'] 			= 0;
				$config['y_axis'] 			= 0;
				$config['thumb_marker'] 	= '';
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				
			$i = $this->input;
			// Hapus gambar lama
			unlink('./assets/upload/image/'.$galeri['gambar']);
			unlink('./assets/upload/image/thumbs/'.$galeri['gambar']);
			// End hapus gambar lama
			$data = array(	'id_galeri'		=> $galeri['id_galeri'],
							'judul'			=> $i->post('judul'),
							'posisi'		=> $i->post('posisi'),
							'gambar'		=> $upload_data['uploads']['file_name'],
							'keterangan'	=> $i->post('keterangan'),
							'website'		=> $i->post('website'),
							'id_user'		=> $this->session->userdata('id')
							);
			$this->galeri_model->edit($data);
			$this->session->set_flashdata('sukses','Galeri telah diedit dan gambar telah diganti');
			redirect(base_url('admin/galeri'));
		}}else{
			$i = $this->input;
			$data = array(	'id_galeri'		=> $galeri['id_galeri'],
							'judul'			=> $i->post('judul'),
							'posisi'		=> $i->post('posisi'),
							'keterangan'	=> $i->post('keterangan'),
							'website'		=> $i->post('website'),
							'id_user'		=> $this->session->userdata('id')
							);
			$this->galeri_model->edit($data);
			$this->session->set_flashdata('sukses','Galeri telah diedit dan gambar tidak diganti');
			redirect(base_url('admin/galeri'));			
		}}
		// End masuk database
		$data = array(	'title'		=> 'Edit Galeri',
						'galeri'	=> $galeri,
						'isi'		=> 'admin/galeri/edit');
		$this->load->view('admin/layout/wrapper', $data);
	}
	
	// Delete
	public function delete($id_galeri) {
		$galeri		= $this->galeri_model->detail($id_galeri);
		// Hapus gambar lama
		unlink('./assets/upload/image/'.$galeri['gambar']);
		unlink('./assets/upload/image/thumbs/'.$galeri['gambar']);
		// End hapus gambar lama
		$data = array('id_galeri'	=> $id_galeri);
		$this->galeri_model->delete($data);		
		$this->session->set_flashdata('sukses','Galeri telah dihapus');
		redirect(base_url('admin/galeri'));

	}
}