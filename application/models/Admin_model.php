<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	// Listing
	public function listing() {
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->order_by('id_admin','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Detail
	public function detail($id_admin) {
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('id_admin',$id_admin);
		$this->db->order_by('id_admin','DESC');
		$query = $this->db->get();
		return $query->row_array();
	}


	// Tambah
	public function tambah($data) {
		$this->db->insert('admin',$data);
	}
	
	// Edit
	public function edit($data) {
		$this->db->where('id_admin',$data['id_admin']);
		$this->db->update('admin',$data);
	}
	
	// Delete
	public function delete($data) {
		$this->db->where('id_admin',$data['id_admin']);
		$this->db->delete('admin',$data);
	}
}