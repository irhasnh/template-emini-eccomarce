<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
	
	// Load db
	public function __construct() {
		parent::__construct();
        $this->load->model('contact_model');
	}
	// Index
	public function index() {
		$contact = $this->contact_model->listing();
		// Default page
		$data = array( 	'title' 		=> 'Manajemen Contact',
						'contact'		=> $contact,
						'isi'	 		=> 'admin/contact/list');
		$this->load->view('admin/layout/wrapper', $data);
	}

	// Detail Pesan
	public function detail($id_contact) {
		$contact = $this->contact_model->detail($id_contact);
		
		// Validasi
		$valid = $this->form_validation;
		$valid->set_rules('nama','Nama','required');
		$valid->set_rules('email','Email','required|valid_email');
		
		if($valid->run() === FALSE) {
		
		$data = array(	'title'		=> 'Detail Pesan',
						'contact'	=> $contact,
						'isi'		=> 'admin/contact/detail');
		$this->load->view('admin/layout/wrapper',$data);
		}else{
			$i = $this->input;
			$data = array(	'id_contact'	=> $i->post('id_contact'),
							'nama_contact'	=> $i->post('nama_contact'),
							'email_contact'	=> $i->post('email_contact'),
							'isi_contact'	=> $i->post('isi_contact'));

			$this->contact_model->edit($data);		
			$this->session->set_flashdata('sukses','User telah diupdate');
			redirect(base_url('admin/contact'));
		}
	}

	// Delete
	public function delete($id_contact) {
		$data = array('id_contact'	=> $id_contact);
		$this->contact_model->delete($data);		
		$this->session->set_flashdata('sukses','Pesan telah dihapus');
		redirect(base_url('admin/contact'));

	}
}