<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	

	// Cek user
	public function cek_user($data){
		$query = $this->db->get_where('tbl_user',$data);
		return $query;
	}

	// Listing
	public function listing() {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->order_by('id_user','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Detail
	public function detail($slug) {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where(array('slug_user' => $slug));
		$this->db->order_by('id_user','DESC');
		$query = $this->db->get();
		return $query->row_array();
	}

	// Detail
	public function detail_user($id_user) {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('id_user',$id_user);
		$this->db->order_by('id_user','DESC');
		$query = $this->db->get();
		return $query->row_array();
	}

	// Akhir
	public function akhir() {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->order_by('id_user','DESC');
		$query = $this->db->get();
		return $query->row_array();
	}

	// Tambah
	public function tambah($data) {
		$this->db->insert('user',$data);
	}
	
	// Edit
	public function edit($data) {
		$this->db->where('id_user',$data['id_user']);
		$this->db->update('user',$data);
	}
	
	// Delete
	public function delete($data) {
		$this->db->where('id_user',$data['id_user']);
		$this->db->delete('user',$data);
	}
}