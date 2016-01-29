<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	// Load database
	public function __construct(){
		parent::__construct();
        
        $this->load->model('berita_model');

	}
	
	// index
	public function index() {
		$config = $this->konfigurasi_model->listing();
        $recent = $this->berita_model->recent();
        $ListMc = $this->berita_model->list_Mc_Home();
        $ListAp = $this->berita_model->List_Ap_Home();
        $ListDs = $this->berita_model->list_Ds_Home();


		$data = array( 	'title' 	=> $config['namaweb'].' - '.$config['tagline'],
						'page_name'	=> 'Main Course', 
						'config' 	=> $config,
                        'recent'	=> $recent,
                        'ListMc'	=> $ListMc,
                        'ListAp'	=> $ListAp,
                        'ListDs'	=> $ListDs,                        
					    'isi'   	=> 'home/list');
		$this->load->view('layout/wrapper',$data);
	}
}