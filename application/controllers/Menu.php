<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
	
	// Load database
        public function __construct(){
	parent::__construct();
        
        $this->load->model('berita_model');
        $this->load->model('kategori_berita_model');

	}
	
	// Main Course
public function main_course() {
	$config      = $this->konfigurasi_model->listing();        
        $recent      = $this->berita_model->recent_mc();
        $main_course = $this->berita_model->list_mc();
        $kategori    = $this->kategori_berita_model->listing();

                // Berita dan paginasi
                $this->load->library('pagination');
                $config['base_url']             = base_url().'menu/main_course/';
                $config['total_rows']           = $this->berita_model->total_pagin_mc();
                $config['use_page_numbers']     = TRUE;
                $config['num_links']            = 5;
                $config['uri_segment']          = 3;
                $config['per_page']             = 10;
                $config['first_url']            = base_url().'menu/main_course/';
                $this->pagination->initialize($config); 
                $page         = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) * $config['per_page'] : 0;
                $main_course  = $this->berita_model->pagin_mc($config['per_page'], $page);

                $data = array(  'title'=> 'Main Course - '.$config['namaweb'],
			'page_name'    => 'Main Course',
                        'config'       => $config,
                        'main_course'  => $main_course,
                        'kategori'     => $kategori,
                        'pagin'        => $this->pagination->create_links(),
                        'recent'       => $recent,
                        'isi'          => 'pages/main_course');
		$this->load->view('layout/wrapper',$data);
	}

        // Starter
public function appetizer() {
        $config    = $this->konfigurasi_model->listing();
        $recent    = $this->berita_model->Recent_Ap();
        $appetizer = $this->berita_model->List_Ap();
        $kategori  = $this->kategori_berita_model->listing();

                // Berita dan paginasi
                $this->load->library('pagination');
                $config['base_url']             = base_url().'menu/starter/';
                $config['total_rows']           = $this->berita_model->Total_Pagin_Ap();
                $config['use_page_numbers']     = TRUE;
                $config['num_links']            = 5;
                $config['uri_segment']          = 3;
                $config['per_page']             = 10;
                $config['first_url']            = base_url().'menu/starter/';
                $this->pagination->initialize($config); 
                $page         = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) * $config['per_page'] : 0;
                $appetizer    = $this->berita_model->Pagin_Ap($config['per_page'], $page);

                $data = array(  'title' => 'Appetizer - '.$config['namaweb'], 
                        'page_name'    => 'Appetizer',
                        'config'       => $config,
                        'appetizer'    => $appetizer,
                        'kategori'     => $kategori,
                        'pagin'        => $this->pagination->create_links(),
                        'recent'       => $recent,
                        'isi'          => 'pages/appetizer');
                $this->load->view('layout/wrapper',$data);
        }

        // Dessert
public function dessert() {
        $config   = $this->konfigurasi_model->listing();
        $recent   = $this->berita_model->recent_ds();
        $dessert  = $this->berita_model->list_ds();
        $kategori = $this->kategori_berita_model->listing();

                // Berita dan paginasi
                $this->load->library('pagination');
                $config['base_url']             = base_url().'menu/dessert/';
                $config['total_rows']           = $this->berita_model->total_pagin_dk();
                $config['use_page_numbers']     = TRUE;
                $config['num_links']            = 5;
                $config['uri_segment']          = 3;
                $config['per_page']             = 10;
                $config['first_url']            = base_url().'menu/dessert/';
                $this->pagination->initialize($config); 
                $page           = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) * $config['per_page'] : 0;
                $drinks         = $this->berita_model->pagin_ds($config['per_page'], $page);

                $data = array(  'title'=> 'Dessert - '.$config['namaweb'], 
                        'page_name'    => 'Dessert',
                        'config'       => $config,
                        'dessert'      => $dessert,
                        'kategori'     => $kategori,
                        'pagin'        => $this->pagination->create_links(),
                        'recent'       => $recent,
                        'isi'          => 'pages/dessert');
                $this->load->view('layout/wrapper',$data);
        }

        // Drinks
public function drinks() {
        $config = $this->konfigurasi_model->listing();
        $recent = $this->berita_model->recent_dk();
        $drinks = $this->berita_model->list_dk();
        $kategori = $this->kategori_berita_model->listing();

                // Berita dan paginasi
                $this->load->library('pagination');
                $config['base_url']             = base_url().'menu/drinks/';
                $config['total_rows']           = $this->berita_model->total_pagin_dk();
                $config['use_page_numbers']     = TRUE;
                $config['num_links']            = 5;
                $config['uri_segment']          = 3;
                $config['per_page']             = 10;
                $config['first_url']            = base_url().'menu/drinks/';
                $this->pagination->initialize($config); 
                $page           = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) * $config['per_page'] : 0;
                $drinks         = $this->berita_model->pagin_dk($config['per_page'], $page);

                $data = array(  'title' => 'Drinks - '.$config['namaweb'], 
                        'page_name'    => 'Drinks',
                        'config'       => $config,
                        'drinks'       => $drinks,
                        'kategori'     => $kategori,
                        'pagin'        => $this->pagination->create_links(),
                        'recent'       => $recent,
                        'isi'          => 'pages/drinks');
                $this->load->view('layout/wrapper',$data);
        }


}