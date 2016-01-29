<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	// Listing
	public function listing() {
		$this->db->select(' berita.id_berita, 
							berita.slug,
							berita.judul,
							store.nama_toko,
							berita.id_store,
							berita.id_kategori_berita,
							berita.jenis,
							berita.status_berita,
							berita.tanggal,
							kategori_berita.nama_kategori_berita, 
							kategori_berita.slug_kategori_berita, 
							admin.nama, 
							berita.gambar
						');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->join('store','store.id_store = berita.id_store','LEFT');
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Detail
	public function detail($id_berita) {
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where('id_berita',$id_berita);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	// Read
	public function read($slug) {
		$this->db->select('berita.id_berita, 
						   berita.slug, 
						   berita.judul, 
						   berita.isi, 
						   berita.id_store, 
						   store.nama_toko, 
						   store.slug_store,
						   berita.id_kategori_berita,
						   berita.jenis, 
						   berita.status_berita,
						   berita.tanggal, 
						   kategori_berita.nama_kategori_berita, 
						   admin.nama, 
						   berita.gambar
						   ');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('store','store.id_store = berita.id_store','LEFT');
		
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','slug'	=> $slug));
		// End relasi tabel
		$query = $this->db->get();
		return $query->row_array();
	}

	public function addComment(){
 	
 	$now = date("Y-m-d H:i:s");
	$data = array( 
		'isi' => strip_tags(substr($this->input->post('isi'),0,255)),
		'id_berita' => $this->input->post('id_berita'),	
		'id_user'	=> $this->session->userdata('id'),
		'pubdate' => $now);

	$this->db->insert('comment', $data);	 
 }

	public function comment($slug) {
		$this->db->select(' comment.id_berita,
							comment.id_comment,
							comment.id_user,
							comment.isi,
							comment.pubdate,
							berita.slug,
							user.nama,
							user.avatar,													
							');
		$this->db->from('comment');
		$this->db->join('user','user.id_user = comment.id_user','LEFT');
		$this->db->join('berita','berita.id_berita = comment.id_berita','LEFT');
		$this->db->where(array('slug' => $slug));
		$this->db->order_by('id_comment','ASC');

		// End relasi tabel
		$query = $this->db->get();
		return $query->result_array();
	}

	function getPost($id){
    $data = array();
    $this->db->where('id_berita',$id);
    $this->db->limit(1);
    $Q = $this->db->get('berita');
    if ($Q->num_rows() > 0){
      $data = $Q->row_array();
    }

    $Q->free_result();    
    return $data;    
 }

 function getComments($slug){
     $data = array();
     
     $this->db->where('id_berita',$slug);
     $Q = $this->db->get('comment');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
    }
    $Q->free_result();  
    return $data; 
 }

 	// Jumlah calon
	public function countComment($slug) {
				$this->db->select(' comment.id_berita,
							comment.id_comment,
							comment.isi,
							comment.pubdate,
							berita.slug
							');
		$this->db->join('berita','berita.id_berita = comment.id_berita','LEFT');
		$query = $this->db->get_where('comment',array('slug' => $slug));
		return $query->num_rows();	
	}
	    
	// Recent
	public function recent() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result_array();
	}

	// Jumlah Profil
	public function total_blog() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, kategori_berita.slug_kategori_berita,  admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	// Listing Berita
	public function semua_berita() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
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
		$this->db->select(' berita.id_berita, 
							berita.slug,
							berita.judul,
							berita.isi,
							store.nama_toko,
							store.slug_store,
							berita.id_store,
							berita.id_kategori_berita,
							berita.jenis,
							berita.status_berita,
							berita.tanggal,
							kategori_berita.nama_kategori_berita, 
							kategori_berita.slug_kategori_berita, 
							admin.nama, 
							berita.gambar
						');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->join('store','store.id_store = berita.id_store','LEFT');
		$this->db->where('status_berita','Publish');
		// End relasi tabel
		$this->db->limit($limit, $start);
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	// Search Berita
	public function search_berita($ringkasan,$isi) {
		$this->db->select('store.id_store,
							store.nama_toko,
							store.slug_store,
							store.telp_toko,
							store.gambar,
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
							store.info_toko,
							store.google_map,														
						');
		$this->db->from('store');
		if (!empty($ringkasan)) {
			$this->db->like('nama_toko', $ringkasan);
		}
		elseif (!empty($isi)) {
			$this->db->like('isi', $isi);
		}

		// Relasi tabel
		//$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		//$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		// End relasi tabel
		//$this->db->limit($limit, $start);
		$this->db->order_by('id_store','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}


// Listing Main Course
	public function List_Mc() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'main_course'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

		// Listing
	public function List_Mc_Home() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'main_course'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	}

		// Latest
	public function Latest_Mc() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'main_course'));
		// End relasi tabel
		$this->db->order_by('id_berita','ASC');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	}

		// Recent 
	public function Recent_Mc() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'main_course'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	}

		// Paging 
	public function Pagin_Mc($limit,$start) {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'main_course'));
		// End relasi tabel
		$this->db->limit($limit, $start);
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

		// Total Paging
	public function Total_Pagin_Mc() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, kategori_berita.slug_kategori_berita,  admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'main_course'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

// Listing Appetizer
	public function List_Ap() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'appetizer'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

		// Listing
	public function List_Ap_Home() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'appetizer'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	}

		// Latest
	public function Latest_Ap() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'appetizer'));
		// End relasi tabel
		$this->db->order_by('id_berita','ASC');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	}

		// Recent 
	public function Recent_Ap() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'appetizer'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	}

		// Paging 
	public function Pagin_Ap($limit,$start) {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'appetizer'));
		// End relasi tabel
		$this->db->limit($limit, $start);
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

		// Total Paging
	public function Total_Pagin_Ap() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, kategori_berita.slug_kategori_berita,  admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'appetizer'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}


// Listing Dessert
	public function List_Ds() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'dessert'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
		// List Home
	public function List_Ds_Home() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'dessert'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	}
		// Recent
	public function Recent_Ds() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'dessert'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	}

		// Paging 
	public function Pagin_Ds($limit,$start) {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'dessert'));
		// End relasi tabel
		$this->db->limit($limit, $start);
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

		// Total Paging
	public function Total_Pagin_Ds() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, kategori_berita.slug_kategori_berita,  admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'dessert'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

// Listing Drinks
	public function list_dk() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'drinks'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
		// List Home
	public function list_dk_home() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'drinks'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	}

		// Recent
	public function recent_dk() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'drinks'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	}
		// Paging 
	public function pagin_dk($limit,$start) {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'drinks'));
		// End relasi tabel
		$this->db->limit($limit, $start);
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

		// Total Paging
	public function total_pagin_dk() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, kategori_berita.slug_kategori_berita,  admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'drinks'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	// Listing About

	public function list_ab() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where(array('status_berita' => 'Publish','jenis'	=> 'about'));
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->row_array();
	}


	// Jumlah Berita
	public function total_berita() {
		$this->db->select('berita.id_berita, berita.slug, berita.judul, berita.isi,
							berita.id_kategori_berita, berita.jenis, berita.status_berita,
							berita.tanggal, kategori_berita.nama_kategori_berita, admin.nama, berita.gambar');
		$this->db->from('berita');
		// Relasi tabel
		$this->db->join('kategori_berita','kategori_berita.id_kategori_berita = berita.id_kategori_berita','LEFT');
		$this->db->join('admin','admin.id_admin = berita.id_admin','LEFT');
		$this->db->where('status_berita','Publish');
		// End relasi tabel
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}
	

	// Akhir
	public function akhir() {
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	// Tambah
	public function tambah($data) {
		$this->db->insert('berita',$data);
	}
	
	// Edit
	public function edit($data) {
		$this->db->where('id_berita',$data['id_berita']);
		$this->db->update('berita',$data);
	}
	
	// Check delete
	public function check($id_berita) {
		$query = $this->db->get_where('produk',array('id_berita' => $id_berita));
		return $query->num_rows();
	}
	
	// Delete
	public function delete($data) {
		$this->db->where('id_berita',$data['id_berita']);
		$this->db->delete('berita',$data);
	}
}