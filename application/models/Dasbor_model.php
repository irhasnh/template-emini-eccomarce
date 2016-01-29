<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}

	// Jumlah Pesanan
	public function order() {
		$query = $this->db->get('order');
		return $query->num_rows();	
	}		

	// Jumlah berita
	public function berita() {
		$query = $this->db->get('berita');
		return $query->num_rows();	
	}
		
	// Jumlah Jenis Project
	public function project_type() {
		$query = $this->db->get('project_type');
		return $query->num_rows();	
	}

	// Jumlah Paket
	public function package() {
		$query = $this->db->get('package');
		return $query->num_rows();	
	}

	// Jumlah Modul
	public function module() {
		$query = $this->db->get('module');
		return $query->num_rows();	
	}

	// Jumlah Notes
	public function notes() {
		$query = $this->db->get('notes');
		return $query->num_rows();	
	}

	// Jumlah Customer
	public function customer() {
		$query = $this->db->get('customer');
		return $query->num_rows();	
	}

	// Jumlah Testimonials
	public function testi() {
		$query = $this->db->get('testi');
		return $query->num_rows();	
	}
		
	// Jumlah client
	public function client() {
		$query = $this->db->get('client');
		return $query->num_rows();	
	}
	
	// Jumlah users
	public function users() {
		$query = $this->db->get('users');
		return $query->num_rows();	
	}
	
}