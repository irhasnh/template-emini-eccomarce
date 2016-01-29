<script src="<?php echo base_url() ?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "#keterangan",
	height: 250,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<script type="text/javascript">
$(function() {
    $("#file").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            
            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview").css("background-image", "url("+this.result+")");
            }
        }
    });
});
</script>


<?php
// Session 
if($this->session->flashdata('sukses')) { 
	echo '<div class="alert alert-success">';
	echo $this->session->flashdata('sukses');
	echo '</div>';
} 

// File upload error
if(isset($error)) {
	echo '<div class="alert alert-success">';
	echo $error;
	echo '</div>';
}

// Error
echo validation_errors('<div class="alert alert-success">','</div>'); 
?>

<form action="<?php echo base_url('admin/galeri/edit/'.$galeri['id_galeri']) ?>" method="post" enctype="multipart/form-data">

<div class="col-md-12">
	<div class="form-group input-group-lg">
    	<label>Nama Galeri</label>
        <input type="text" name="judul" class="form-control" value="<?php echo $galeri['judul'] ?>" placeholder="Nama galeri">
    </div>
    
</div>

<div class="col-md-6">
    
	<div class="form-group">
    	<label>Link / Website Terkait (http://website.com)</label>
        <input type="url" name="website" class="form-control" value="<?php echo $galeri['website'] ?>" required placeholder="http://website.com">
    </div>
    
    <div class="form-group">
    	<label>Posisi Galeri</label>
        <select name="posisi" class="form-control">
        	<option value="Beranda" <?php if($galeri['posisi']=="Beranda") { echo "selected"; } ?>>Beranda - Gambar Slider Utama</option>
            <option value="Galeri"  <?php if($galeri['posisi']=="Galeri") { echo "selected"; } ?>>Galeri, Tampilkan di galeri</option>
        </select>
    </div>

</div>

<div class="col-md-6">
	
    
	<div class="form-group">
    	<label>Upload Foto/Gambar</label>
      <input type="file" name="gambar" class="form-control" id="file">
        <div id="imagePreview"></div>
        <div class="imagePreview"><img src="<?php echo base_url('assets/upload/image/thumbs/'.$galeri['gambar']) ?>"></div>
    </div>
</div>

<div class="col-md-12">
	<div class="form-group">
    	<label>Keterangan Lengkap (Deskripsi Galeri)</label>
        <textarea name="keterangan" placeholder="Isi Galeri" class="form-control" id="keterangan"><?php echo $galeri['keterangan'] ?></textarea>
    </div>
    
    <div class="form-group">
	<input type="submit" name="submit" value="Simpan Galeri" class="btn btn-primary">
    <input type="reset" name="reset" value="Reset" class="btn btn-primary">
    </div>
</div>

</form>