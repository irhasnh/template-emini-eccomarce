<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	// Listing
	public function listing() {
		$this->db->select(	'store.id_store,
							 store.slug_store, 
							 store.nama_toko,
							 store.telp_toko,
							 store.nama_pengelola,						
							 store.telp_pengelola,						
							 store.email_pengelola,						
							 store.alamat,							 						
							 store.kota,							 						
							 store.kodepos,							 						
							 store.provinsi,							 						
							 store.negara,							 						
							 store.jenis_makanan,							 						
							 store.order_makanan,							 							 						
							 store.order_tempat,							 							 						
							 store.info_toko,							 							 						
							 store.gambar');
		$this->db->from('store');
		// Relasi tabel
		//$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = store.id_kategori_berita','LEFT');
		//$this->db->join('users','users.id_user = store.id_user','LEFT');
		// End relasi tabel
		$this->db->order_by('id_store','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Detail
	public function detail($id_store) {
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where('id_store',$id_store);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	// Read

	    
	// Recent
	public function recent() {
		$this->db->select(	'store.id_store,
							 store.slug_store, 
							 store.nama_toko,
							 store.telp_toko,
							 store.nama_pengelola,						
							 store.telp_pengelola,						
							 store.email_pengelola,						
							 store.alamat,							 						
							 store.kota,							 						
							 store.kodepos,							 						
							 store.provinsi,							 						
							 store.negara,							 						
							 store.jenis_makanan,							 						
							 store.order_makanan,							 							 						
							 store.order_tempat,							 							 						
							 store.info_toko,							 							 						
							 store.gambar');
		$this->db->from('store');
		// Relasi tabel
		//$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = store.id_kategori_berita','LEFT');
		//$this->db->join('users','users.id_user = store.id_user','LEFT');
		//$this->db->where(array('status_berita' => 'Publish'));
		// End relasi tabel
		$this->db->order_by('id_store','DESC');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result_array();
	}

	// Read
	public function read($slug) {
		$this->db->select(	'store.id_store,
							 store.slug_store, 
							 store.nama_toko,
							 store.telp_toko,
							 store.nama_pengelola,						
							 store.telp_pengelola,						
							 store.email_pengelola,						
							 store.alamat,							 						
							 store.kota,							 						
							 store.kodepos,							 						
							 store.provinsi,							 						
							 store.negara,							 						
							 store.jenis_makanan,							 						
							 store.order_makanan,							 							 						
							 store.order_tempat,							 							 						
							 store.info_toko,							 							 						
							 store.google_map,							 							 						
							 store.gambar');
		$this->db->from('store');
		// Relasi tabel
		//$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');

		//$this->db->join('users','users.id_user = berita.id_user','LEFT');
		$this->db->where(array('slug_store'	=> $slug));
		// End relasi tabel
		$query = $this->db->get();
		return $query->row_array();
	}
	
	// Listing Berita
	public function semua_berita() {
		$this->db->select('store.id_berita, store.slug, store.judul, store.isi,
							store.id_kategori_berita, store.jenis, store.status_berita,
							store.tanggal, kategori_berita.nama_kategori_berita, users.nama, store.gambar');
		$this->db->from('store');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = store.id_kategori_berita','LEFT');
		$this->db->join('users','users.id_user = store.id_user','LEFT');
		$this->db->where('status_berita','Publish');
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(15);
		$query = $this->db->get();
		return $query->result_array();
	}

// *Listing 
	// Listing Berita
	public function list_store($limit,$start) {
		$this->db->select(	'store.id_store,
							 store.slug_store, 
							 store.nama_toko,
							 store.telp_toko,
							 store.nama_pengelola,						
							 store.telp_pengelola,						
							 store.email_pengelola,						
							 store.alamat,							 						
							 store.kota,							 						
							 store.kodepos,							 						
							 store.provinsi,							 						
							 store.negara,							 						
							 store.jenis_makanan,							 						
							 store.order_makanan,							 							 						
							 store.order_tempat,							 							 						
							 store.info_toko,							 							 						
							 store.google_map,							 							 						
							 store.gambar');
		$this->db->from('store');
		// Relasi tabel
		//$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = store.id_kategori_berita','LEFT');
		//$this->db->join('users','users.id_user = store.id_user','LEFT');
		// End relasi tabel
		$this->db->limit($limit, $start);
		$this->db->order_by('id_store','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	// Search Berita
	public function search_berita($ringkasan,$isi) {
		$this->db->select('store.id_berita, store.slug, store.judul, store.isi,
							store.id_kategori_berita, store.jenis, store.status_berita,
							store.tanggal, kategori_berita.nama_kategori_berita, users.nama, store.gambar');
		$this->db->from('store');
		if (!empty($ringkasan)) {
			$this->db->like('judul', $ringkasan);
		}
		elseif (!empty($isi)) {
			$this->db->like('isi', $isi);
		}

		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = store.id_kategori_berita','LEFT');
		$this->db->join('users','users.id_user = store.id_user','LEFT');
		$this->db->where('status_berita','Publish');
		// End relasi tabel
		//$this->db->limit($limit, $start);
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	// Jumlah Berita
	public function total_store() {
		$this->db->select(	'store.id_store,
							 store.slug_store, 
							 store.nama_toko,
							 store.telp_toko,
							 store.nama_pengelola,						
							 store.telp_pengelola,						
							 store.email_pengelola,						
							 store.alamat,							 						
							 store.kota,							 						
							 store.kodepos,							 						
							 store.provinsi,							 						
							 store.negara,							 						
							 store.jenis_makanan,							 						
							 store.order_makanan,							 							 						
							 store.order_tempat,							 							 						
							 store.info_toko,							 							 						
							 store.google_map,							 							 						
							 store.gambar');
		$this->db->from('store');
		// Relasi tabel
		//$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = store.id_kategori_berita','LEFT');
		//$this->db->join('users','users.id_user = store.id_user','LEFT');
		// End relasi tabel
		$this->db->order_by('id_store','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	// Akhir
	public function akhir() {
		$this->db->select('*');
		$this->db->from('store');
		$this->db->order_by('id_store','DESC');
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	// Tambah
	public function tambah($data) {
		$this->db->insert('store',$data);
	}
	
	// Edit
	public function edit($data) {
		$this->db->where('id_store',$data['id_store']);
		$this->db->update('store',$data);
	}
	
	// Check delete
	public function check($id_berita) {
		$query = $this->db->get_where('produk',array('id_berita' => $id_berita));
		return $query->num_rows();
	}
	
	// Delete
	public function delete($data) {
		$this->db->where('id_store',$data['id_store']);
		$this->db->delete('store',$data);
	}
}