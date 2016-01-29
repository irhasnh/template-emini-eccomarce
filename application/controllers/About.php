<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
	
	// Load database
	public function __construct(){
		parent::__construct();
        
        $this->load->model('berita_model');

	}
	
	// index
	public function index() {
		$config = $this->konfigurasi_model->listing();
        $about = $this->berita_model->list_ab();

		$data = array( 	'title' 	=> $config['namaweb'].': '.$config['tagline'],
						'page_name'	=> 'About', 
						'config' 	=> $config,
                        'about'		=> $about,
					    'isi'   	=> 'about/list');
		$this->load->view('layout/wrapper',$data);
	}
}