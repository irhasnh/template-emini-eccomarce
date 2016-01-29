<?php
     $id_user   = $this->session->userdata('id');
     	$name_session   = $this->user_model->detail_user($id_user);
    		$site = $this->konfigurasi_model->listing();
    			$user = $this->user_model->detail_user($id_user);
    	


    require_once ('head.php');
    require_once ('preloader.php');
    require_once ('header.php');   
    require_once ('content.php');
    require_once ('footer.php');