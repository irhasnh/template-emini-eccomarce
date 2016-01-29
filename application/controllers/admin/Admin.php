<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	// Load database
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	// Index
	public function index() {
		$user	= $this->user_model->listing();
		
		// Validasi
		$valid = $this->form_validation;
		$valid->set_rules('nama','Nama','required');
		$valid->set_rules('email','Email','required|valid_email');
		$valid->set_rules('username','Username','required|min_length[6]|max_length[32]|is_unique[users.username]');
		$valid->set_rules('password','Password','required|min_length[6]|max_length[32]');
		
		if($valid->run() === FALSE) {
		
		$data = array(	'title'	=> 'Manajemen User',
						'user'	=> $user,
						'isi'	=> 'admin/user/list');
		$this->load->view('admin/layout/wrapper',$data);
		}else{
			$i = $this->input;
			$data = array(	'nama'		=> $i->post('nama'),
							'email'		=> $i->post('email'),
							'username'	=> $i->post('username'),
							'password'	=> sha1($i->post('password')),
							'level'		=> $i->post('level'));
			$this->user_model->tambah($data);		
			$this->session->set_flashdata('sukses','User telah ditambah');
			redirect(base_url('admin/user'));
		}
	}
		
	// Edit
	public function edit($id_user) {
		$user	= $this->user_model->detail($id_user);
		
		// Validasi
		$valid = $this->form_validation;
		$valid->set_rules('nama','Nama','required');
		$valid->set_rules('email','Email','required|valid_email');
		$valid->set_rules('password','Password','required|min_length[6]|max_length[32]');
		
		if($valid->run() === FALSE) {
		
		$data = array(	'title'	=> 'Edit User',
						'user'	=> $user,
						'isi'	=> 'admin/user/tambah');
		$this->load->view('admin/layout/wrapper',$data);
		}else{
			$i = $this->input;
			$data = array(	'id_user'	=> $i->post('id_user'),
							'nama'		=> $i->post('nama'),
							'email'		=> $i->post('email'),
							'password'	=> sha1($i->post('password')),
							'level'		=> $i->post('level'));
			$this->user_model->edit($data);		
			$this->session->set_flashdata('sukses','User telah diupdate');
			redirect(base_url('admin/user'));
		}
	}
	
	// Delete
	public function delete($id_user) {
		$data = array('id_user'	=> $id_user);
		$this->user_model->delete($data);		
		$this->session->set_flashdata('sukses','User telah dihapus');
		redirect(base_url('admin/user'));

	}
}