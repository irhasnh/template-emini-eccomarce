<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Starter extends CI_Controller {
	
	// Load database
        public function __construct(){
	parent::__construct();
        
        $this->load->model('berita_model');
        $this->load->model('kategori_berita_model');

	}
	
	// index
	public function index() {
	$config = $this->konfigurasi_model->listing();
        $recent = $this->berita_model->recent_st();
        $starter = $this->berita_model->list_st();
        $kategori = $this->kategori_berita_model->listing();

                // Berita dan paginasi
                $this->load->library('pagination');
                $config['base_url']             = base_url().'starter/index/';
                $config['total_rows']           = $this->berita_model->total_pagin_st();
                $config['use_page_numbers']     = TRUE;
                $config['num_links']            = 5;
                $config['uri_segment']          = 3;
                $config['per_page']             = 2;
                $config['first_url']            = base_url().'starter/';
                $this->pagination->initialize($config); 
                $page       = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) * $config['per_page'] : 0;
                $starter    = $this->berita_model->pagin_st($config['per_page'], $page);


        $data = array(  'title'        => $config['namaweb'].': '.$config['tagline'], 
			'page_name'    => 'Dessert',
                        'config'       => $config,
                        'starter'      => $starter,
                        'kategori'     => $kategori,
                        'pagin'        => $this->pagination->create_links(),
                        'recent'       => $recent,
                        'isi'          => 'berita/starter');
		$this->load->view('layout/wrapper',$data);
	}
}