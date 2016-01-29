<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	// Listing
	public function listing() {
		$this->db->select('*');
		$this->db->from('galeri');
		$this->db->order_by('id_galeri','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Listing
	public function home() {
		$this->db->select('*');
		$this->db->from('galeri');
		$this->db->order_by('id_galeri','DESC');
		$this->db->limit(12);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Listing
	public function galeri() {
		$this->db->select('*');
		$this->db->from('galeri');
		$this->db->where('posisi =','Galeri');
		$this->db->order_by('id_galeri','DESC');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Listing semua
	public function semua_galeri($limit,$start) {
		$this->db->select('*');
		$this->db->from('galeri');
		$this->db->limit($limit, $start);
		$this->db->order_by('id_galeri','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Listing semua
	public function total_galeri() {
		$this->db->select('*');
		$this->db->from('galeri');
		$this->db->order_by('id_galeri','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	// Detail
	public function detail($id_galeri) {
		$this->db->select('*');
		$this->db->from('galeri');
		$this->db->where('id_galeri',$id_galeri);
		$this->db->order_by('id_galeri','DESC');
		$query = $this->db->get();
		return $query->row_array();
	}
	
	// Slider
	public function slider() {
		$this->db->select('*');
		$this->db->from('galeri');
		$this->db->where('posisi','Beranda');
		$this->db->order_by('id_galeri','DESC');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Tambah
	public function tambah($data) {
		$this->db->insert('galeri',$data);
	}
	
	// Edit
	public function edit($data) {
		$this->db->where('id_galeri',$data['id_galeri']);
		$this->db->update('galeri',$data);
	}
	
	// Check delete
	public function check($id_galeri) {
		$query = $this->db->get_where('produk',array('id_galeri' => $id_galeri));
		return $query->num_rows();
	}
	
	// Delete
	public function delete($data) {
		$this->db->where('id_galeri',$data['id_galeri']);
		$this->db->delete('galeri',$data);
	}
}