<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {
	
	// Load database
	public function __construct(){
		parent::__construct();
		$this->load->model('store_model');
	}

	// Index
	public function index() {
		$store	= $this->store_model->listing();
		
		$data = array(	'title'		=> 'Management Store',
						'store'		=> $store,
						'isi'		=> 'admin/store/list');
		$this->load->view('admin/layout/wrapper',$data);
	}
		
	// Tambah
	public function create() {
		// Dari database		
		$akhir		= $this->store_model->akhir();
		// Validasi
		$v = $this->form_validation;
		$v->set_rules('nama_toko','Nama Toko','required');
		$v->set_rules('telp_toko','Telepon','required');
		$v->set_rules('telp_pengelola','Telepon Pengelola','required');
		$v->set_rules('email_pengelola','Isi Berita','required');
		$v->set_rules('info_toko','Informasi Toko','required');
		$v->set_rules('alamat','Alamat Toko','required');
		$v->set_rules('kota','Kota','required');
		$v->set_rules('negara','Jenis Makanan','required');
		$v->set_rules('order_makanan','Order Makanan','required');
		$v->set_rules('order_tempat','Order Tempat','required');
		
		if($v->run()) {
			
			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png|svg';
			$config['max_size']			= '1000'; // KB			
			$this->load->library('upload', $config);
			if(! $this->upload->do_upload('gambar')) {
		
		$data = array(	'title'		=> 'Create Store',						
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/store/create');
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
			$slug = url_title($i->post('nama'),'dash', TRUE).'-'.$akhir['id_store'];
			$data = array(	'slug_store'		=> $slug,
							'nama_toko'			=> $i->post('nama_toko'),
							'telp_toko'			=> $i->post('telp_toko'),
							'nama_pengelola'	=> $i->post('nama_pengelola'),							
							'email_pengelola'	=> $i->post('email_pengelola'),
							'gambar'			=> $upload_data['uploads']['file_name'],
							'alamat'			=> $i->post('alamat'),
							'kota'				=> $i->post('kota'),
							'kodepos'			=> $i->post('kodepos'),
							'provinsi'			=> $i->post('provinsi'),
							'negara'			=> $i->post('negara'),
							'jenis_makanan'		=> $i->post('jenis_makanan'),
							'order_makanan'		=> $i->post('order_makanan'),
							'order_tempat'		=> $i->post('order_tempat'),
							'info_toko'			=> $i->post('info_toko'),
							'google_map'		=> $i->post('google_map')
							);
			$this->store_model->tambah($data);
			$this->session->set_flashdata('sukses','Success');
			redirect(base_url('admin/store'));
		}}
		// End masuk database
		$data = array(	'title'		=> 'Create Store',
						'isi'		=> 'admin/store/create');
		$this->load->view('admin/layout/wrapper', $data);
	}
	
		// Edit
	public function edit($id_store) {
		// Dari database
		$store		= $this->store_model->detail($id_store);
		$akhir		= $this->store_model->akhir();
		// Validasi
		$v = $this->form_validation;
		$v->set_rules('nama_toko','Nama Toko','required');
		$v->set_rules('telp_toko','Telepon','required');
		$v->set_rules('telp_pengelola','Telepon Pengelola','required');
		$v->set_rules('email_pengelola','Isi Berita','required');
		$v->set_rules('info_toko','Informasi Toko','required');
		$v->set_rules('alamat','Alamat Toko','required');
		$v->set_rules('kota','Kota','required');
		$v->set_rules('negara','Jenis Makanan','required');
		$v->set_rules('order_makanan','Order Makanan','required');
		$v->set_rules('order_tempat','Order Tempat','required');
		
		if($v->run()) {
			if(!empty($_FILES['gambar']['name'])) {
			$config['upload_path'] 		= './assets/upload/image/';
			$config['allowed_types'] 	= 'gif|jpg|png|svg';
			$config['max_size']			= '1000'; // KB			
			$this->load->library('upload', $config);
			if(! $this->upload->do_upload('gambar')) {
		
		$data = array(	'title'		=> 'Edit Toko',
						'store'		=> $store,
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/store/edit');
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
			unlink('./assets/upload/image/'.$store['gambar']);
			unlink('./assets/upload/image/thumbs/'.$store['gambar']);
			// End hapus gambar lama
			$slug = $akhir['id_store'].'-'.url_title($i->post('nama'),'dash', TRUE);
			$data = array(	'id_store'			=> $store['id_store'],
							'slug'				=> $slug,
							'nama_toko'			=> $i->post('nama_toko'),
							'telp_toko'			=> $i->post('telp_toko'),
							'nama_pengelola'	=> $i->post('nama_pengelola'),
							'telp_pengelola'	=> $i->post('telp_pengelola'),
							'email_pengelola'	=> $i->post('email_pengelola'),
							'gambar'			=> $upload_data['uploads']['file_name'],
							'alamat'			=> $i->post('alamat'),
							'kota'				=> $i->post('kota'),
							'kodepos'			=> $i->post('kodepos'),
							'provinsi'			=> $i->post('provinsi'),
							'negara'			=> $i->post('negara'),
							'jenis_makanan'		=> $i->post('jenis_makanan'),
							'order_makanan'		=> $i->post('order_makanan'),
							'order_tempat'		=> $i->post('order_tempat'),
							'google_map'		=> $i->post('google_map'),
							'info_toko'			=> $i->post('info_toko'),
							);
			$this->store_model->edit($data);
			$this->session->set_flashdata('sukses','Toko telah diedit dan gambar telah diganti');
			redirect(base_url('admin/store'));
		}}else{
			$i = $this->input;
			$slug = $akhir['id_store'].'-'.url_title($i->post('nama'),'dash', TRUE);
			$data = array(	'id_store'			=> $store['id_store'],
							'slug'				=> $slug,
							'nama_toko'			=> $i->post('nama_toko'),
							'telp_toko'			=> $i->post('telp_toko'),
							'nama_pengelola'	=> $i->post('nama_pengelola'),
							'telp_pengelola'	=> $i->post('telp_pengelola'),
							'email_pengelola'	=> $i->post('email_pengelola'),
							//'gambar'			=> $upload_data['uploads']['file_name'],
							'alamat'			=> $i->post('alamat'),
							'kota'				=> $i->post('kota'),
							'kodepos'			=> $i->post('kodepos'),
							'provinsi'			=> $i->post('provinsi'),
							'negara'			=> $i->post('negara'),
							'jenis_makanan'		=> $i->post('jenis_makanan'),
							'order_makanan'		=> $i->post('order_makanan'),
							'order_tempat'		=> $i->post('order_tempat'),
							'google_map'		=> $i->post('google_map'),
							'info_toko'			=> $i->post('info_toko'),
							);
			$this->store_model->edit($data);
			$this->session->set_flashdata('sukses','Toko telah diedit dan gambar tidak diganti');
			redirect(base_url('admin/store'));			
		}}
		// End masuk database
		$data = array(	'title'		=> 'Edit Toko',
						'store'		=> $store,
						'isi'		=> 'admin/store/edit');
		$this->load->view('admin/layout/wrapper', $data);
	}
	
	// Edit
	public function view($id_store) {
		// Dari database
		$store	= $this->store_model->detail($id_store);

		$data = array ('title' => 'Detail Toko',
						'store' => $store,
						'isi'	=> 'admin/store/view');
		$this->load->view('admin/layout/wrapper', $data);
	}

	// Delete
	public function delete($id_store) {
		$store	= $this->store_model->detail($id_store);
		// Hapus gambar lama
		unlink('./assets/upload/image/'.$store['gambar']);
		unlink('./assets/upload/image/thumbs/'.$store['gambar']);
		// End hapus gambar lama
		$data = array('id_store'=> $id_store);
		$this->store_model->delete($data);		
		$this->session->set_flashdata('sukses','Toko telah dihapus');
		redirect(base_url('admin/store'));

	}
}