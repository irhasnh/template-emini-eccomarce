<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	// Listing
	public function listing() {
		$this->db->select(	'comment.id_comment, 
							 comment.id_berita, 
							 comment.id_user, 							  
							 berita.judul, 
							 berita.isi, 
							 users.nama, 
							 berita.gambar');
		$this->db->from('comment');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = comment.id_kategori_berita','LEFT');
		$this->db->join('users','users.id_user = comment.id_user','LEFT');
		$this->db->join('store','store.id_store = comment.id_store','LEFT');
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Detail
	public function detail($id_berita) {
		$this->db->select('*');
		$this->db->from('comment');
		$this->db->where('id_berita',$id_berita);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	// Read
	public function read($slug) {
		$this->db->select('comment.id_berita,
							comment.id_berita,
							comment.id_user,
						   	berita.judul, 
						   	berita.isi, 
						   	berita.gambar, 
						   	users.nama, 
						   	comment.gambar
						   ');
		$this->db->from('comment');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = comment.id_kategori_berita','LEFT');
		$this->db->join('store','store.id_store = comment.id_store','LEFT');

		$this->db->join('users','users.id_user = comment.id_user','LEFT');
		$this->db->where(array('status_berita' => 'Publish','slug'	=> $slug));
		// End relasi tabel
		$query = $this->db->get();
		return $query->row_array();
	}
	    
	// Recent
	public function recent() {
		$this->db->select('comment.id_berita, comment.slug, comment.judul, comment.isi,
							comment.id_kategori_berita, comment.jenis, comment.status_berita,
							comment.tanggal, kategori_berita.nama_kategori_berita, users.nama, comment.gambar');
		$this->db->from('comment');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = comment.id_kategori_berita','LEFT');
		$this->db->join('users','users.id_user = comment.id_user','LEFT');
		$this->db->where(array('status_berita' => 'Publish'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result_array();
	}

	// Jumlah Profil
	public function total_blog() {
		$this->db->select('comment.id_berita, comment.slug, comment.judul, comment.isi,
							comment.id_kategori_berita, comment.jenis, comment.status_berita,
							comment.tanggal, kategori_berita.nama_kategori_berita, kategori_berita.slug_kategori_berita,  users.nama, comment.gambar');
		$this->db->from('comment');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = comment.id_kategori_berita','LEFT');
		$this->db->join('users','users.id_user = comment.id_user','LEFT');
		$this->db->where(array('status_berita' => 'Publish'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	// Listing Berita
	public function semua_berita() {
		$this->db->select('comment.id_berita, comment.slug, comment.judul, comment.isi,
							comment.id_kategori_berita, comment.jenis, comment.status_berita,
							comment.tanggal, kategori_berita.nama_kategori_berita, users.nama, comment.gambar');
		$this->db->from('comment');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = comment.id_kategori_berita','LEFT');
		$this->db->join('users','users.id_user = comment.id_user','LEFT');
		$this->db->where('status_berita','Publish');
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(15);
		$query = $this->db->get();
		return $query->result_array();
	}

// *Listing 
	// Listing Berita
	public function list_berita($limit,$start) {
		$this->db->select(' comment.id_berita, 
							comment.slug,
							comment.judul,
							comment.isi,
							store.nama_toko,
							store.slug_store,
							comment.id_store,
							comment.id_kategori_berita,
							comment.jenis,
							comment.status_berita,
							comment.tanggal,
							kategori_berita.nama_kategori_berita, 
							kategori_berita.slug_kategori_berita, 
							users.nama, 
							comment.gambar
						');
		$this->db->from('comment');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = comment.id_kategori_berita','LEFT');
		$this->db->join('users','users.id_user = comment.id_user','LEFT');
		$this->db->join('store','store.id_store = comment.id_store','LEFT');
		$this->db->where('status_berita','Publish');
		// End relasi tabel
		$this->db->limit($limit, $start);
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	// Search Berita
	public function search_berita($ringkasan,$isi) {
		$this->db->select('comment.id_berita, comment.slug, comment.judul, comment.isi,
							comment.id_kategori_berita, comment.jenis, comment.status_berita,
							comment.tanggal, kategori_berita.nama_kategori_berita, users.nama, comment.gambar');
		$this->db->from('comment');
		if (!empty($ringkasan)) {
			$this->db->like('judul', $ringkasan);
		}
		elseif (!empty($isi)) {
			$this->db->like('isi', $isi);
		}

		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = comment.id_kategori_berita','LEFT');
		$this->db->join('users','users.id_user = comment.id_user','LEFT');
		$this->db->where('status_berita','Publish');
		// End relasi tabel
		//$this->db->limit($limit, $start);
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}


	// Listing About

	public function list_ab() {
		$this->db->select('comment.id_berita, comment.slug, comment.judul, comment.isi,
							comment.id_kategori_berita, comment.jenis, comment.status_berita,
							comment.tanggal, kategori_berita.nama_kategori_berita, users.nama, comment.gambar');
		$this->db->from('comment');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = comment.id_kategori_berita','LEFT');
		$this->db->join('users','users.id_user = comment.id_user','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'about'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->row_array();
	}


	// Jumlah Berita
	public function total_comment() {
		$this->db->select(	'comment.id_comment, 
							 comment.id_berita, 
							 comment.id_user, 							  
							 berita.judul, 
							 berita.isi, 
							 users.nama, 
							 berita.gambar');
		$this->db->from('comment');
		// Relasi tabel
		$this->db->join('berita','berita.id_berita = comment.id_berita','LEFT');
		$this->db->join('users','users.id_user = comment.id_user','LEFT');
		$this->db->where('status_berita','Publish');
		// End relasi tabel
		$this->db->order_by('id_comment','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	// Akhir
	public function akhir() {
		$this->db->select('*');
		$this->db->from('comment');
		$this->db->order_by('id_comment','DESC');
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	// Tambah
	public function tambah($data) {
		$this->db->insert('comment',$data);
	}
	
	// Edit
	public function edit($data) {
		$this->db->where('id_comment',$data['id_comment']);
		$this->db->update('comment',$data);
	}
	
	// Check delete
	public function check($id_comment) {
		$query = $this->db->get_where('produk',array('id_comment' => $id_comment));
		return $query->num_rows();
	}
	
	// Delete
	public function delete($data) {
		$this->db->where('id_comment',$data['id_comment']);
		$this->db->delete('comment',$data);
	}
}