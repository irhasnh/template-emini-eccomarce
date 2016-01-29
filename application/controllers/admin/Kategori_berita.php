<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_berita extends CI_Controller {
	
	// Load database
	public function __construct(){
		parent::__construct();
		$this->load->model('kategori_berita_model');
	}

	// Index
	public function index() {
		$kategori_berita	= $this->kategori_berita_model->listing();
		
		// Validasi
		$valid = $this->form_validation;
		$valid->set_rules('nama_kategori_berita','Nama Kategori_berita Produk','required');
		
		if($valid->run() === FALSE) {
		
		$data = array(	'title'	=> 'Manajemen Kategori_berita',
						'kategori_berita'	=> $kategori_berita,
						'isi'	=> 'admin/berita/list_kategori_berita');
		$this->load->view('admin/layout/wrapper',$data);
		}else{
			$i = $this->input;
			$slug = url_title($this->input->post('nama_kategori_berita'), 'dash', TRUE);
			$data = array(	'slug_kategori_berita'	=> $slug,
							'urutan'		=> $i->post('urutan'),
							'nama_kategori_berita'	=> $i->post('nama_kategori_berita'),
							'keterangan'	=> $i->post('keterangan'));
			$this->kategori_berita_model->tambah($data);		
			$this->session->set_flashdata('sukses','Kategori_berita Produk telah ditambah');
			redirect(base_url('admin/kategori_berita'));
		}
	}
		
	// Edit
	public function edit($id_kategori_berita) {
		$kategori_berita	= $this->kategori_berita_model->detail($id_kategori_berita);
		
		// Validasi
		$valid = $this->form_validation;
		$valid->set_rules('nama_kategori_berita','Nama Kategori_berita Produk','required');
		
		if($valid->run() === FALSE) {
		
		$data = array(	'title'	=> 'Edit Kategori_berita',
						'kategori_berita'	=> $kategori_berita,
						'isi'	=> 'admin/berita/edit_kategori_berita');
		$this->load->view('admin/layout/wrapper',$data);
		}else{
			$i = $this->input;
			$slug = url_title($this->input->post('nama_kategori_berita'), 'dash', TRUE);
			$data = array(	'id_kategori_berita'		=> $i->post('id_kategori_berita'),
							'slug_kategori_berita'	=> $slug,
							'urutan'		=> $i->post('urutan'),
							'nama_kategori_berita'	=> $i->post('nama_kategori_berita'),
							'keterangan'	=> $i->post('keterangan'));
			$this->kategori_berita_model->edit($data);		
			$this->session->set_flashdata('sukses','Kategori_berita Produk telah ditambah');
			redirect(base_url('admin/kategori_berita'));
		}
	}
	
	// Delete
	public function delete($id_kategori_berita) {
		// Check delete
		$jumlah = $this->kategori_berita_model->check($id_kategori_berita);
		if($jumlah < 1) {
			$data = array('id_kategori_berita'	=> $id_kategori_berita);
			$this->kategori_berita_model->delete($data);		
			$this->session->set_flashdata('sukses','Kategori_berita telah dihapus');
		}else{
			$this->session->set_flashdata('sukses','Data kategori_berita berita tidak dapat dihapus karena terkait dengan salah satu berita');
		}
		redirect(base_url('admin/kategori_berita'));

	}
}