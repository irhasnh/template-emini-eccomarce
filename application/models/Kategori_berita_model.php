<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_berita_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	// Listing
	public function listing() {
		$this->db->select('*');
		$this->db->from('kategori_berita');
		$this->db->order_by('id_kategori_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Detail
	public function detail($id_kategori_berita) {
		$this->db->select('*');
		$this->db->from('kategori_berita');
		$this->db->where('id_kategori_berita',$id_kategori_berita);
		$this->db->order_by('id_kategori_berita','DESC');
		$query = $this->db->get();
		return $query->row_array();
	}
	
	// Tambah
	public function tambah($data) {
		$this->db->insert('kategori_berita',$data);
	}
	
	// Edit
	public function edit($data) {
		$this->db->where('id_kategori_berita',$data['id_kategori_berita']);
		$this->db->update('kategori_berita',$data);
	}
	
	// Check delete
	public function check($id_kategori_berita) {
		$query = $this->db->get_where('berita',array('id_kategori_berita' => $id_kategori_berita));
		return $query->num_rows();
	}
	
	// Delete
	public function delete($data) {
		$this->db->where('id_kategori_berita',$data['id_kategori_berita']);
		$this->db->delete('kategori_berita',$data);
	}
}