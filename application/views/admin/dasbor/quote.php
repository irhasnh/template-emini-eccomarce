<?php
// Session 
if($this->session->flashdata('sukses')) { 
	echo '<div class="alert alert-success">';
	echo $this->session->flashdata('sukses');
	echo '</div>';
} 
// Error
echo validation_errors('<div class="alert alert-success">','</div>'); 
?>

<form action="<?php echo base_url('admin/dasbor/quote') ?>" method="post">

<input type="hidden" name="id_konfigurasi" value="<?php echo $site['id_konfigurasi'] ?>">

<div class="col-md-6">
	<div class="form-group">
    	<label>Judul Quote 1</label>
        <input type="text" name="judul_1" class="form-control" value="<?php echo $site['judul_1'] ?>" placeholder="Judul quote 1" required>
        
    </div>
    <div class="form-group">
    	<label>Judul Quote 2</label>
        <input type="text" name="judul_2" class="form-control" value="<?php echo $site['judul_2'] ?>" placeholder="Judul quote 2">
        
    </div>
    <div class="form-group">
    	<label>Judul Quote 3</label>
        <input type="text" name="judul_3" class="form-control" value="<?php echo $site['judul_3'] ?>" placeholder="Judul quote 3">
        
    </div>
</div>

<div class="col-md-6">
	<div class="form-group">
    	<label>Content Banner 1</label>
        <textarea name="pesan_1" placeholder="Isi Content 1" class="form-control"><?php echo $site['pesan_1'] ?></textarea>
    </div>
    <div class="form-group">
        <label>Content Banner 2</label>
        <textarea name="pesan_2" placeholder="Isi Content 2" class="form-control"><?php echo $site['pesan_2'] ?></textarea>
    </div>
    <div class="form-group">
        <label>Content Banner 3</label>
        <textarea name="pesan_3" placeholder="Isi Content 3" class="form-control"><?php echo $site['pesan_3'] ?></textarea>
    </div>
</div>

<div class="col-md-12">
	<input type="submit" name="submit" value="Simpan Konfigurasi Website" class="btn btn-primary">
    <input type="reset" name="reset" value="Reset" class="btn btn-primary">
</div>


</form>