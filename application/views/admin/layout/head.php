<?php
$this->admin_login->cek_login();

// Load konfigurasi
$site = $this->konfigurasi_model->listing();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo $title.' - '.$site['namaweb'] ?></title>
<link href="<?php echo base_url('assets/upload/image/'.$site['icon']) ?>" rel="shortcut icon">
<!-- BOOTSTRAP STYLES-->
<link href="<?php echo base_url() ?>assets/admin/assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONTAWESOME STYLES-->
<link href="<?php echo base_url() ?>assets/admin/assets/css/font-awesome.css" rel="stylesheet" />
<!-- MORRIS CHART STYLES-->
<!-- CUSTOM STYLES-->
<link href="<?php echo base_url() ?>assets/admin/assets/css/custom.css" rel="stylesheet" />
<!-- GOOGLE FONTS-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<!-- TABLE STYLES-->
<link href="<?php echo base_url() ?>assets/admin/assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/jquery/jquery-ui.min.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/jquery/jquery-ui.theme.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>assets/admin/assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo base_url() ?>assets/jquery/jquery-ui.js"></script>

<!-- Fa picker -->
<link href="<?php echo base_url() ?>assets/fa-picker/dist/css/fontawesome-iconpicker.min.css" rel="stylesheet">
</head>

<body>
<div id="wrapper">