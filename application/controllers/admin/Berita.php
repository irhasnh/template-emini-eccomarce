<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {
	
	// Load database
	public function __construct(){
		parent::__construct();
		$this->load->model('berita_model');
		$this->load->model('kategori_berita_model');
		$this->load->model('store_model');
	}

	// Index
	public function index() {
		$berita	= $this->berita_model->listing();
		
		$data = array(	'title'	=> 'Manajemen Berita',
						'berita'	=> $berita,
						'isi'	=> 'admin/berita/list');
		$this->load->view('admin/layout/wrapper',$data);
	}
		
	// Tambah
	public function tambah() {
		// Dari database
		$kategori	= $this->kategori_berita_model->listing();
		$store 		= $this->store_model->listing();
		$akhir		= $this->berita_model->akhir();
		// Validasi
		$v = $this->form_validation;
		$v->set_rules('judul','Judul berita','required');
		$v->set_rules('isi','Isi Berita','required');
		
		if($v->run()) {
			
			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png|svg';
			$config['max_size']			= '1000'; // KB			
			$this->load->library('upload', $config);
			if(! $this->upload->do_upload('gambar')) {
		
		$data = array(	'title'		=> 'Tambah Berita',
						'kategori'	=> $kategori,
						'store'		=> $store,
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/berita/tambah');
		$this->load->view('admin/layout/wrapper', $data);
		// Masuk database
		}else{
				$upload_data				= array('uploads' =>$this->upload->data());
				// Image Editor
				$config['image_library']	= 'gd2';
				$config['source_image'] 	= './assets/upload/image/'.$upload_data['uploads']['file_name']; 
				$config['new_image'] 		= './assets/upload/image/thumbs/';
				$config['create_thumb'] 	= TRUE;
				$config['quality'] 			= "100%";
				$config['maintain_ratio'] 	= FALSE;
				$config['width'] 			= 360; // Pixel
				$config['height'] 			= 200; // Pixel
				$config['x_axis'] 			= 0;
				$config['y_axis'] 			= 0;
				$config['thumb_marker'] 	= '';
				$config['wm_type'] = 'overlay';
				$config['wm_overlay_path'] = './assets/images/logo_wm.png';//the overlay image
				$config['wm_opacity']=50;
				$config['wm_vrt_alignment'] = 'bottom';
				$config['wm_hor_alignment'] = 'right';
				
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$this->image_lib->initialize($config);
				if(!$this->image_lib->watermark())
				{
					echo $this->image_lib->display_errors(); 
				} 
				
			$i = $this->input;
			$slug = url_title($i->post('judul'),'dash', TRUE).'-'.$akhir['id_berita'];
			$data = array(	'slug'			=> $slug,
							'judul'			=> $i->post('judul'),
							'jenis'			=> $i->post('jenis'),
							'id_store'			=> $i->post('id_store'),
							'id_kategori_berita'	=> $i->post('id_kategori_berita'),
							'isi'			=> $i->post('isi'),
							'gambar'		=> $upload_data['uploads']['file_name'],
							'id_admin'		=> $this->session->userdata('id'),
							'status_berita'	=> $i->post('status_berita'),
							'keywords'		=> $i->post('keywords'),
							'urutan'		=> $i->post('urutan')
							);
			$this->berita_model->tambah($data);
			$this->session->set_flashdata('sukses','Berita telah ditambah');
			redirect(base_url('admin/berita'));
		}}
		// End masuk database
		$data = array(	'title'		=> 'Tambah Berita',
						'kategori'	=> $kategori,
						'store'	=> $store,
						'isi'		=> 'admin/berita/tambah');
		$this->load->view('admin/layout/wrapper', $data);
	}
	
	// Edit
	public function edit($id_berita) {
		// Dari database
		$berita		= $this->berita_model->detail($id_berita);
		$kategori	= $this->kategori_berita_model->listing();
		$akhir		= $this->berita_model->akhir();
		// Validasi
		$v = $this->form_validation;
		$v->set_rules('judul','Judul berita','required');
		$v->set_rules('isi','Isi Berita','required');
		
		if($v->run()) {
			if(!empty($_FILES['gambar']['name'])) {
			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png|svg';
			$config['max_size']			= '1000'; // KB			
			$this->load->library('upload', $config);
			if(! $this->upload->do_upload('gambar')) {
		
		$data = array(	'title'		=> 'Edit Berita',
						'kategori'	=> $kategori,
						'berita'	=> $berita,
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/berita/edit');
		$this->load->view('admin/layout/wrapper', $data);
		// Masuk database
		}else{
				$upload_data				= array('uploads' =>$this->upload->data());
				// Image Editor
				$config['image_library']	= 'gd2';
				$config['source_image'] 	= './assets/upload/image/'.$upload_data['uploads']['file_name']; 
				$config['new_image'] 		= './assets/upload/image/thumbs/';
				$config['create_thumb'] 	= TRUE;
				$config['quality'] 			= "100%";
				$config['maintain_ratio'] 	= FALSE;
				$config['width'] 			= 360; // Pixel
				$config['height'] 			= 200; // Pixel
				$config['x_axis'] 			= 0;
				$config['y_axis'] 			= 0;
				$config['thumb_marker'] 	= '';
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				
			$i = $this->input;
			// Hapus gambar lama
			unlink('./assets/upload/image/'.$berita['gambar']);
			unlink('./assets/upload/image/thumbs/'.$berita['gambar']);
			// End hapus gambar lama
			$slug = $akhir['id_berita'].'-'.url_title($i->post('judul'),'dash', TRUE);
			$data = array(	'id_berita'		=> $berita['id_berita'],
							'slug'			=> $slug,
							'judul'			=> $i->post('judul'),
							'jenis'			=> $i->post('jenis'),
							'id_kategori_berita'	=> $i->post('id_kategori_berita'),
							'isi'			=> $i->post('isi'),
							'gambar'		=> $upload_data['uploads']['file_name'],
							'id_admin'		=> $this->session->userdata('id'),
							'status_berita'	=> $i->post('status_berita'),
							'keywords'		=> $i->post('keywords'),
							'urutan'		=> $i->post('urutan')
							);
			$this->berita_model->edit($data);
			$this->session->set_flashdata('sukses','Berita telah diedit dan gambar telah diganti');
			redirect(base_url('admin/berita'));
		}}else{
			$i = $this->input;
			$slug = $akhir['id_berita'].'-'.url_title($i->post('judul'),'dash', TRUE);
			$data = array(	'id_berita'		=> $berita['id_berita'],
							'slug'			=> $slug,
							'judul'			=> $i->post('judul'),
							'jenis'			=> $i->post('jenis'),
							'id_kategori_berita'	=> $i->post('id_kategori_berita'),
							'isi'			=> $i->post('isi'),
							'id_admin'		=> $this->session->userdata('id'),
							'status_berita'	=> $i->post('status_berita'),
							'keywords'		=> $i->post('keywords'),
							'urutan'		=> $i->post('urutan')
							);
			$this->berita_model->edit($data);
			$this->session->set_flashdata('sukses','Berita telah diedit dan gambar tidak diganti');
			redirect(base_url('admin/berita'));			
		}}
		// End masuk database
		$data = array(	'title'		=> 'Edit Berita',
						'kategori'	=> $kategori,
						'berita'	=> $berita,
						'isi'		=> 'admin/berita/edit');
		$this->load->view('admin/layout/wrapper', $data);
	}
	
	// Delete
	public function delete($id_berita) {
		$berita		= $this->berita_model->detail($id_berita);
		// Hapus gambar lama
		unlink('./assets/upload/image/'.$berita['gambar']);
		unlink('./assets/upload/image/thumbs/'.$berita['gambar']);
		// End hapus gambar lama
		$data = array('id_berita'	=> $id_berita);
		$this->berita_model->delete($data);		
		$this->session->set_flashdata('sukses','Berita telah dihapus');
		redirect(base_url('admin/berita'));

	}
}