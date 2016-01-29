<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
	
	// Load database

	
	// index
	public function index() {

		$config = $this->konfigurasi_model->listing();

		$data = array (	'title'	 => 'Contact List',
						'page_name' => 'Contact Us', 
						'config' => $config,
						'isi'	 => 'contact/list',
					   );

		$this->load->view('layout/wrapper',$data);
	}
	public function sendEmail(){   
$errors = '';
$myemail = 'zetfood@gmail.com';//<-----Put Your email address here.
if(empty($_POST['name'])  || 
   empty($_POST['email']) || 
   empty($_POST['message']))
{
    $errors .= "\n Error: all fields are required";
}

$name = $_POST['name']; 
$email_address = $_POST['email']; 
$message = $_POST['message']; 

if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

if( empty($errors))
{
	$to = $myemail; 
	$email_subject = "Contact form submission: $name";
	$email_body = "You have received a new message. ".
	" Here are the details:\n Name: $name \n Email: $email_address \n Message \n $message"; 
	
	$headers = "From: $myemail\n"; 
	$headers .= "Reply-To: $email_address";
	
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	$this->session->set_flashdata('sukses','Pesan berhasil dikirim');
	redirect(base_url('contact'));

}else{
		$this->session->set_flashdata('gagal','Data yang anda masukan kurang lengkap');
		redirect(base_url('contact'));
}
}
}