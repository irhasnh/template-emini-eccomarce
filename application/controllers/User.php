<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function profile($slug) {
		
		if ($this->uri->segment(3) ==  TRUE) {
    	
    	$user	= $this->user_model->detail($slug);
		
		// Validasi
		$valid = $this->form_validation;
		$valid->set_rules('nama','Nama','required');
		$valid->set_rules('email','Email','required|valid_email');
		$valid->set_rules('password','Password','required|min_length[6]|max_length[32]');
		
		if($valid->run() === FALSE) {
		
		$data = array(	'title'	=> 'Edit User',
						'user'	=> $user,
						'isi'	=> 'user/profile');
		$this->load->view('layout/wrapper',$data);
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
		
		}else{
			redirect(base_url('error'));
		}
			
	}

	public function register(){
		   if ($this->session->userdata('nama')== TRUE ){
			
			redirect('user/profile/'.$this->input->post('username'), 'refresh');


		}else{
		// Validasi
		$valid = $this->form_validation;
		$valid->set_rules('nama','Nama','required');
		$valid->set_rules('email','Email','required|valid_email');
		$valid->set_rules('password','Password','required|min_length[6]|max_length[32]');
		
		if($valid->run() === FALSE) {
		
		$data = array(	'title'	=> 'Register User',
						'isi'	=> 'user/register');
		$this->load->view('layout/wrapper',$data);
		}else{
			$i = $this->input;
			$slug = url_title($i->post('username'),'dash', TRUE);
			$data = array(	'slug_user'	=> $slug,
							'nama'		=> $i->post('nama'),
							'email'		=> $i->post('email'),
							'password'	=> sha1($i->post('password')),
							'username'	=> $i->post('username'));
			$this->user_model->tambah($data);		
			$this->session->set_flashdata('sukses','Silahkan login untuk melanjutkan');  			
  			redirect('user/login');
  			//redirect('user/profile/'.$this->input->post('username'), 'refresh');
			}	
		}
	}

	public function login() {
		
		// Validasi
		$valid 		= $this->form_validation;
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');
		$valid->set_rules('username','Username','required');
		$valid->set_rules('password','Password','required');	
		if($valid->run()) {
			$this->user_login->login($username,$password,base_url('home'), base_url('home'));
		}
		// End validasi
		
		$data = array(	'title'	=> 'Login User');
		$this->load->view('user/login', $data);
	}
	
	// Logout
	public function logout() {
		$this->user_login->logout();
	}
}