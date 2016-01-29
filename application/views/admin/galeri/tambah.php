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

<form action="<?php echo base_url('admin/galeri/tambah') ?>" method="post" enctype="multipart/form-data">

<div class="col-md-12">
	<div class="form-group input-group-lg">
    	<label>Nama Galeri</label>
        <input type="text" name="judul" class="form-control" value="<?php echo set_value('judul') ?>" required placeholder="Nama galeri">
    </div>
    
</div>

<div class="col-md-6">
    
	<div class="form-group">
    	<label>Link / Website Terkait (http://website.com)</label>
        <input type="url" name="website" class="form-control" value="<?php echo set_value('website') ?>" placeholder="http://website.com">
    </div>
    
    <div class="form-group">
    	<label>Posisi Galeri</label>
        <select name="posisi" class="form-control">
        	<option value="Galeri">Galeri, Tampilkan di galeri</option>
            <option value="Beranda">Beranda - Gambar Slider Utama</option>
            
        </select>
    </div>

</div>

<div class="col-md-6">
	
    
	<div class="form-group">
    	<label>Upload Foto/Gambar</label>
      <input type="file" name="gambar" class="form-control" id="file">
        <div id="imagePreview"></div>
    </div>
</div>

<div class="col-md-12">
	<div class="form-group">
    	<label>Keterangan Lengkap (Deskripsi Galeri)</label>
        <textarea name="keterangan" placeholder="Isi Galeri" class="form-control" id="keterangan"><?php echo set_value('keterangan') ?></textarea>
    </div>
    
    <div class="form-group">
	<input type="submit" name="submit" value="Simpan Galeri" class="btn btn-primary">
    <input type="reset" name="reset" value="Reset" class="btn btn-primary">
    </div>
</div>

</form>