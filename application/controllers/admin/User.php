<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	// Load database
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('store_model');
	}

	// Index
	public function index() {
		$user	= $this->user_model->listing();
		
		$data = array(	'title'	=> 'Manajemen User',
						'user'	=> $user,
						'isi'	=> 'admin/user/list');
		$this->load->view('admin/layout/wrapper',$data);
	}
		
	// Tambah
	public function create() {
		// Dari database		
		$akhir		= $this->user_model->akhir();
		// Validasi
		$v = $this->form_validation;
		$v->set_rules('nama','Nama','required');
		$v->set_rules('email','Email','required|valid_email');
		$v->set_rules('username','Username','required|min_length[6]|max_length[32]|is_unique[user.username]');
		$v->set_rules('password','Password','required|min_length[6]|max_length[32]');
		
		if($v->run()) {
			
			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png|svg';
			$config['max_size']			= '1000'; // KB			
			$this->load->library('upload', $config);
			if(! $this->upload->do_upload('avatar')) {
		
		$data = array(	'title'		=> 'Create Users',						
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/user/create');
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
				$config['width'] 			= 360; // Pixel
				$config['height'] 			= 200; // Pixel
				$config['x_axis'] 			= 0;
				$config['y_axis'] 			= 0;
				$config['thumb_marker'] 	= '';
				
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				
			$i = $this->input;
			$slug = url_title($i->post('username'),'dash', TRUE);
			$data = array(	'slug_user'	=> $slug,
							'nama'		=> $i->post('nama'),
							'username'	=> $i->post('username'),
							'password'	=> sha1($i->post('password')),
							'email'		=> $i->post('email'),							
							'bio'		=> $i->post('bio'),							
							'avatar'	=> $upload_data['uploads']['file_name']
							);
			$this->user_model->tambah($data);
			$this->session->set_flashdata('sukses','Success');
			redirect(base_url('admin/user'));
		}}
		// End masuk database
		$data = array(	'title'		=> 'Create User',
						'isi'		=> 'admin/user/create');
		$this->load->view('admin/layout/wrapper', $data);
	}
	
	// Edit
	public function edit($id_user) {
		// Dari database
		$user		= $this->user_model->detail_user($id_user);
		$akhir		= $this->user_model->akhir();
		// Validasi
		$v = $this->form_validation;
		$v->set_rules('nama','Nama','required');
		$v->set_rules('email','Email','required|valid_email');

		
		if($v->run()) {
			if(!empty($_FILES['avatar']['name'])) {
			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png|svg';
			$config['max_size']			= '1000'; // KB			
			$this->load->library('upload', $config);
			if(! $this->upload->do_upload('avatar')) {
		
		$data = array(	'title'		=> 'Edit User',
						'user'		=> $user,
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/user/edit');
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
				$config['width'] 			= 360; // Pixel
				$config['height'] 			= 200; // Pixel
				$config['x_axis'] 			= 0;
				$config['y_axis'] 			= 0;
				$config['thumb_marker'] 	= '';
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				
			$i = $this->input;
			// Hapus gambar lama
			unlink('./assets/upload/image/'.$user['avatar']);
			unlink('./assets/upload/image/thumbs/'.$user['avatar']);
			// End hapus gambar lama
			$data = array(	'id_user'	=> $user['id_user'],
							'slug_user'	=> $slug,
							'nama'		=> $i->post('nama'),
							'username'	=> $i->post('username'),
							'password'	=> sha1($i->post('password')),
							'email'		=> $i->post('email'),							
							'bio'		=> $i->post('bio'),							
							'avatar'	=> $upload_data['uploads']['file_name']
							);
			$this->user_model->edit($data);
			$this->session->set_flashdata('sukses','User telah diedit dan avatar telah diganti');
			redirect(base_url('admin/user'));
		}}else{
			$i = $this->input;
			$slug = $akhir['id_user'].'-'.url_title($i->post('nama'),'dash', TRUE);
			$data = array(	'id_user'	=> $user['id_user'],
							'slug_user'	=> $slug,
							'nama'		=> $i->post('nama'),
							'username'	=> $i->post('username'),
							'password'	=> sha1($i->post('password')),
							'email'		=> $i->post('email'),							
							'bio'		=> $i->post('bio')							
							);
			$this->user_model->edit($data);
			$this->session->set_flashdata('sukses','User telah diedit dan avatar tidak diganti');
			redirect(base_url('admin/user'));			
		}}
		// End masuk database
		$data = array(	'title'		=> 'Edit User',
						'user'		=> $user,
						'isi'		=> 'admin/user/edit');
		$this->load->view('admin/layout/wrapper', $data);
	}
	
	// Delete
	public function delete($id_user) {
		$user	= $this->user_model->detail($id_user);
		// Hapus gambar lama
		unlink('./assets/upload/image/'.$user['avatar']);
		unlink('./assets/upload/image/thumbs/'.$user['avatar']);
		// End hapus gambar lama
		$data = array('id_user'	=> $id_user);
		$this->user_model->delete($data);		
		$this->session->set_flashdata('sukses','Users telah dihapus');
		redirect(base_url('admin/user'));

	}
}