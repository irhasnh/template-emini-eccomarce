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

<form action="<?php echo base_url('admin/kategori_berita/edit/'.$kategori_berita['id_kategori_berita']) ?>" method="post">
     
     <input type="hidden" name="id_kategori_berita" value="<?php echo $kategori_berita['id_kategori_berita'] ?>">
          
  <div class="col-md-8">
    <div class="form-group">
      <label>Nama Kategori</label>
      <input type="text" name="nama_kategori_berita" class="form-control" placeholder="Nama kategori berita" required  value="<?php echo $kategori_berita['nama_kategori_berita'] ?>">
    </div>
 </div>
 
  <div class="col-md-4">
    <div class="form-group">
      <label>Nomor Urut</label>
      <input type="number" name="urutan" class="form-control" placeholder="Nomor urut" required  value="<?php echo $kategori_berita['urutan'] ?>">
    </div>
 </div>
    
    <div class="col-md-12">
    <div class="form-group">
      <label>Keterangan</label>
     <textarea class="form-control" name="keterangan"><?php echo $kategori_berita['keterangan'] ?></textarea>
    </div>
    
    <div class="form-group input-group">
        <input type="submit" name="submit" value="Simpan Data Jenis" class="btn btn-primary btn-md">
        <input type="reset" name="reset" value="Reset" class="btn btn-default btn-md">
    </div>
    </div>
  </form>