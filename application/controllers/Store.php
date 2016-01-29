<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {
	
	// Load database
	public function __construct(){
		parent::__construct();       
        $this->load->model('store_model');
        $this->load->model('berita_model');
	}

	public function index (){
		$store = $this->store_model->listing();
		$recent = $this->store_model->recent();
		$config	= $this->konfigurasi_model->listing();

		// Berita dan paginasi
		$this->load->library('pagination');
		$config['base_url'] 		= base_url().'store/index/';
		$config['total_rows'] 		= $this->store_model->total_store();
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] 		= 5;
		$config['uri_segment'] 		= 3;
		$config['per_page'] 		= 10;
		$config['first_url'] 		= base_url().'store/';
		$this->pagination->initialize($config); 
		$page 		= ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) * $config['per_page'] : 0;
		$store 		= $this->store_model->list_store($config['per_page'], $page);		
		// End paginasi

		$data = array ( 'title'		=> 'Store',
						'store' 	=> $store,
						'config' 	=> $config,
						'recent' 	=> $recent,
						'pagin' 	=> $this->pagination->create_links(),
						'isi'		=> 'store/list');
		$this->load->view('layout/wrapper',$data);
	}

	public function read($slug) {
		$config	= $this->konfigurasi_model->listing();
		$read	= $this->store_model->read($slug);
		$recent = $this->store_model->recent();

		
		$data = array(	'title'			=> $read['nama_toko'].' - '.$config['namaweb'],
						'keywords'		=> $read['nama_toko'],
						'config'		=> $config,
						'store'			=> $read,
						'recent'		=> $recent,
						'description'	=> $read['nama_toko'],
						'isi'			=> 'store/read');
		$this->load->view('layout/wrapper',$data);
	}

	        public function search()
        {

                if (isset($_POST['cari'])) {
                        $data['ringkasan'] = $this->input->post('cari');
                        $data['isi'] = $this->input->post('cari');
                        $this->session->set_userdata('sess_ringkasan', $data['ringkasan']);
                        $this->session->set_userdata('sess_isi', $data['isi']);
                }
                else {
                        $data['ringkasan'] = $this->session->userdata('sess_ringkasan');
                        $data['isi'] = $this->session->userdata('sess_isi');
                }
                
                $config  = $this->konfigurasi_model->listing();
                $siteku = $this->konfigurasi_model->listing();
                $recent = $this->berita_model->recent();

                /*$this->load->library('pagination');
                $config['base_url']             = base_url().'menu/search/';
                $config['total_rows']           = $this->berita_model->total_berita();
                $config['use_page_numbers'] = TRUE;
                $config['num_links']            = "5";
                $config['uri_segment']          = 3;
                $config['per_page']             = 100;
                $config['first_url']            = base_url().'menu/search/';
                $this->pagination->initialize($config); 
                $page           = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) * $config['per_page'] : 0;
                */
                $search         = $this->berita_model->search_berita($data['ringkasan'],$data['isi']);
                //$kliping      = $this->kliping_model->list_berita($data['ringkasan'],$config['per_page'], $page);
                
                $data = array(  'title'     => $config['namaweb'].': '.$config['tagline'], 
                                'page_name' => 'Hasil Pencarian',
                                'search'    => $search,
                                'config'    => $config,
                                'recent'    => $recent,
                                //'pagin'     => $this->pagination->create_links(),
                                'isi'       => 'pages/search');
                $this->load->view('layout/wrapper',$data);
                
        }
}