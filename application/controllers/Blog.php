<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	
	// Load database
	public function __construct(){
		parent::__construct();
		$this->load->model('konfigurasi_model');
		$this->load->model('berita_model');
		$this->load->model('kategori_berita_model');
		$this->load->model('store_model');
	}
	
	// Index
	public function index() {
		$siteku	= $this->konfigurasi_model->listing();
		$berita	= $this->berita_model->semua_berita();
		$config = $this->konfigurasi_model->listing();
		$recent = $this->berita_model->recent();
		$kategori = $this->kategori_berita_model->listing();

		// Berita dan paginasi
		$this->load->library('pagination');
		$config['base_url'] 		= base_url().'blog/index/';
		$config['total_rows'] 		= $this->berita_model->total_blog();
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] 		= 5;
		$config['uri_segment'] 		= 3;
		$config['per_page'] 		= 6;
		$config['first_url'] 		= base_url().'blog/';
		$this->pagination->initialize($config); 
		$page 		= ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) * $config['per_page'] : 0;
		$berita 	= $this->berita_model->list_berita($config['per_page'], $page);		
		// End paginasi
		
		$data = array(	'title'			=> 'Blog - '.$siteku['namaweb'],
						'keywords'		=> 'Blog - '.$siteku['namaweb'],
						'siteku'		=> $siteku,
						'berita'		=> $berita,
						'config'		=> $config,
						'recent'		=> $recent,
						'kategori'		=> $kategori,
						'pagin' 		=> $this->pagination->create_links(),
						'description'	=> 'Blog - '.$siteku['namaweb'],
						'isi'			=> 'berita/list');
		$this->load->view('layout/wrapper',$data);
	}
	
	// Read
	public function read($slug) {
		$config	= $this->konfigurasi_model->listing();
		$profil	= $this->berita_model->semua_berita();
		$recent	= $this->berita_model->recent();
		$read	= $this->berita_model->read($slug);
		$kategori = $this->kategori_berita_model->listing();
		$store 	  = $this->store_model->listing();
		$comment = $this->berita_model->comment($slug);
		$count = $this->berita_model->countComment($slug);


		
		$data = array(	'title'			=> $read['judul'].' - '.$config['namaweb'],
						'keywords'		=> $read['judul'],
						'config'		=> $config,
						'berita'		=> $read,						
						'profil'		=> $profil,
						'store' 		=> $store,
						'comment'		=> $comment,
						'count'			=> $count,
						'recent'		=> $recent,
						'kategori'		=> $kategori,
						'description'	=> $read['judul'],
						'isi'			=> 'berita/read');
		$this->load->view('layout/wrapper',$data);
	}

		function addcomment(){

		if ($this->input->post('isi')){
			$this->berita_model->addComment();
		}

$this->session->set_flashdata('sukses','Comment telah ditambah');  	
header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
		
}