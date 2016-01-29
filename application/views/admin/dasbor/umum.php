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

<form action="<?php echo base_url('admin/dasbor/konfigurasi') ?>" method="post">

<input type="hidden" name="id_konfigurasi" value="<?php echo $site['id_konfigurasi'] ?>">

<div class="col-md-6">
	<h3>Data dasar</h3><hr>
    <div class="form-group">
    <label>Nama Organisasi/Perusahaan</label>
    <input type="text" name="namaweb" placeholder="Nama organisasi/perusahaan" value="<?php echo $site['namaweb'] ?>" required class="form-control">
    </div>
    
    <div class="form-group">
    <label>Tagline/Motto Perusahaan</label>
    <input type="text" name="tagline" placeholder="Tagline/Motto Perusahaan" value="<?php echo $site['tagline'] ?>" class="form-control">
    </div>

    <div class="form-group">
    <label>Tentang Perusahaan</label>
    <textarea name="tentang" rows="3" class="form-control" placeholder="Tentang Perusahaan"><?php echo $site['tentang'] ?></textarea>
    </div>

    
    <div class="form-group">
    <label>Alamat Website</label>
    <input type="url" name="website" placeholder="<?php echo base_url() ?>" value="<?php echo $site['website'] ?>" class="form-control">
    </div>
    
    <div class="form-group">
    <label>Email resmi perusahaan</label>
    <input type="email" name="email" placeholder="youremail@address.com" value="<?php echo $site['email'] ?>" class="form-control" required>
    </div>
    
     <div class="form-group">
    <label>Alamat lengkap</label>
    <textarea name="alamat" rows="3" class="form-control" placeholder="Alamat perusahaan/organisasi"><?php echo $site['alamat'] ?></textarea>
    </div>
    
     <div class="form-group">
    <label>Nomor Telepon</label>
    <input type="text" name="telepon" placeholder="021-000000" value="<?php echo $site['telepon'] ?>" class="form-control">
    </div>
    
      <div class="form-group">
    <label>Nomor Fax</label>
    <input type="text" name="fax" placeholder="021-000000" value="<?php echo $site['fax'] ?>" class="form-control">
    </div>
    
     <div class="form-group">
    <label>Nomor HP Contact Person</label>
    <input type="text" name="hp" placeholder="021-000000" value="<?php echo $site['hp'] ?>" class="form-control">
    </div>
    
    <h3>Jejaring Sosial</h3><hr>
    
    <div class="form-group">
    <label>Alamat Akun Facebook</label>
    <input type="url" name="facebook" placeholder="http://facebook.com/namakamu" value="<?php echo $site['facebook'] ?>" class="form-control">
    </div>
    
    <div class="form-group">
    <label>Alamat akun Twitter</label>
   <input type="url" name="twitter" placeholder="http://twitter.com/namakamu" value="<?php echo $site['twitter'] ?>" class="form-control">
    </div>

    <div class="form-group">
    <label>Alamat akun Instagram</label>
   <input type="url" name="instagram" placeholder="http://instagram.com/namakamu" value="<?php echo $site['instagram'] ?>" class="form-control">
    </div>
    
</div>

<div class="col-md-6">
	<h3>Modul SEO (Search Engine Optimization)</h3><hr>
	<div class="form-group">
    <label>Keywords (Kata kunci pencarian Google dsb)</label>
    <textarea name="keywords" rows="3" class="form-control" placeholder="Kata kunci / keywords"><?php echo $site['keywords'] ?></textarea>
    </div>
    
    <div class="form-group">
    <label>Metatext (Misal description, dari Google dll)</label>
    <textarea name="metatext" rows="5" class="form-control" placeholder="Kode metatext"><?php echo $site['metatext'] ?></textarea>
    </div>
    
    <h3>Google Map</h3><hr>
    <div class="form-group">
    <label>Peta Google Map</label>
    <textarea name="google_map" rows="5" class="form-control" placeholder="Kode dari Google Map"><?php echo $site['google_map'] ?></textarea>
    </div>
    
    <div class="form-group map">
    <?php echo $site['google_map'] ?>
    </div>
</div>

<div class="col-md-12">
	<input type="submit" name="submit" value="Simpan Konfigurasi Website" class="btn btn-primary">
    <input type="reset" name="reset" value="Reset" class="btn btn-primary">
</div>

</form>