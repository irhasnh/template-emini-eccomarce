<!-- /. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
<div class="sidebar-collapse">
<ul class="nav" id="main-menu">
	<li><a  href="<?php echo base_url('admin/dasbor') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <!-- Konfigurasi -->                  
    <li><a href="#"><i class="fa fa-wrench"></i> Config<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="<?php echo base_url('admin/dasbor/konfigurasi') ?>">General Config</a></li>
            <li><a href="<?php echo base_url('admin/dasbor/quote') ?>">Quote Homepage</a></li>
            <li><a href="<?php echo base_url('admin/dasbor/logo') ?>">Change Logo</a></li>
            <li><a href="<?php echo base_url('admin/dasbor/icon') ?>">Change Icon</a></li>
        </ul>
    </li>
     <!-- Modul Berita-->                      
    <li><a href="#"><i class="fa fa-newspaper-o"></i> Blog<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="<?php echo base_url('admin/berita') ?>">Post</a></li>
            <li><a href="<?php echo base_url('admin/berita/tambah') ?>">Create Post</a></li>
            <li><a href="<?php echo base_url('admin/kategori_berita') ?>">Category Blog</a></li>
        </ul>
    </li>
    <!-- Modul Store-->                      
    <li><a href="#"><i class="fa fa-cutlery"></i> Store<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="<?php echo base_url('admin/store') ?>">Date Store</a></li>
            <li><a href="<?php echo base_url('admin/store/create') ?>">Create Store</a></li>
        </ul>
    </li>
    
    <!-- Modul User-->                      
    <li><a href="#"><i class="fa fa-user"></i> User<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="<?php echo base_url('admin/user') ?>">User</a></li>
            <li><a href="<?php echo base_url('admin/user/create') ?>">Create User</a></li>
        </ul>
    </li>
    <!-- Modul Berita-->                      
    <li><a href="#"><i class="fa fa-photo"></i> Gallery<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="<?php echo base_url('admin/galeri') ?>">Data Gallery</a></li>
            <li><a href="<?php echo base_url('admin/galeri/tambah') ?>">Tambah Gallery</a></li>
        </ul>
    </li> 
</ul>
</div>

</nav>  
<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
<div id="page-inner">


<div class="row">
<div class="col-md-12">
    <!-- Advanced Tables -->
    <div class="panel panel-default">
        <div class="panel-heading">
             <h2><?php echo $title ?></h2>
        </div>
        <div class="panel-body">
            <div class="table-responsive">