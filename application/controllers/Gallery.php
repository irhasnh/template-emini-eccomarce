<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {
	
	// Load database
	public function __construct(){
		parent::__construct();
        
        $this->load->model('galeri_model');

	}
	
	// index
	public function index() {
		$config = $this->konfigurasi_model->listing();
		$galeri = $this->galeri_model->listing();


		$data = array( 	'title' 	=> $config['namaweb'].': '.$config['tagline'],
						'page_name'	=> 'Gallery
						', 
						'config' 	=> $config,
						'galeri'	=> $galeri,
					    'isi'   	=> 'gallery/list');
		$this->load->view('layout/wrapper',$data);
	}
}