<script src="<?php echo base_url() ?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
	file_browser_callback: function(field, url, type, win) {
        tinyMCE.activeEditor.windowManager.open({
            file: '<?php echo base_url() ?>assets/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
            title: 'KCFinder',
            width: 700,
            height: 500,
            inline: true,
            close_previous: false
        }, {
            window: win,
            input: field
        });
        return false;
    },
    selector: "#isi",
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

<form action="<?php echo base_url('admin/berita/edit/'.$berita['id_berita']) ?>" method="post" enctype="multipart/form-data">

<div class="col-md-6">
	<div class="form-group input-group-lg">
    	<label>Judul Berita</label>
        <input type="text" name="judul" class="form-control" value="<?php echo $berita['judul'] ?>" required placeholder="Judul berita">
    </div>
</div>

<div class="col-md-6">
	<div class="form-group input-group-lg">
    	<label>Urutan Berita</label>
        <input type="number" name="urutan" class="form-control" value="<?php echo $berita['urutan'] ?>" required placeholder="Judul berita">
    </div>
</div>

<div class="col-md-6">
	<div class="form-group">
    	<label>Jenis Berita</label>
      <select name="jenis" id="jenis" class="form-control">
        <option value="main_course" <?php if(set_value('jenis')=="main_course") { echo "selected"; } ?>>Main Course</option>
        <option value="appetizer" <?php if(set_value('jenis')=="appetizer") { echo "selected"; } ?>>Appetizer</option>
        <option value="dessert" <?php if(set_value('jenis')=="dessert") { echo "selected"; } ?>>Dessert</option>     
        <option value="about" <?php if(set_value('jenis')=="about") { echo "selected"; } ?>>About</option>
      </select>
    </div>
    <div class="form-group">
    	<label>Kategori Berita</label>
        <select name="id_kategori_berita" class="form-control">
        	<?php foreach($kategori as $kategori) { ?>
            <option value="<?php echo $kategori['id_kategori_berita'] ?>" <?php if($berita['id_kategori_berita']==$kategori['id_kategori_berita']) { echo "selected"; } ?>>
            	<?php echo $kategori['nama_kategori_berita'] ?>
            </option>
            <?php } ?>
        </select>
    </div>
    
    <div class="form-group">
    	<label>Status Berita</label>
        <select name="status_berita" class="form-control">
        	<option value="Publish" <?php if($berita['status_berita']=="Publish") { echo "selected"; } ?>>Publikasikan</option>
            <option value="Draft" <?php if($berita['status_berita']=="Draft") { echo "selected"; } ?>>Simpan sebagai draft</option>
        </select>
    </div>

</div>

<div class="col-md-4">
	<div class="form-group">
    	<label>Upload Gambar</label>
      <input type="file" name="gambar" class="form-control" id="file">
        <div id="imagePreview"></div>
    </div>
</div>

<div class="col-md-12">
	<div class="form-group">
    	<label>Isi Berita</label>
        <textarea name="isi" placeholder="Isi Berita" class="form-control" id="isi"><?php echo $berita['isi'] ?></textarea>
    </div>
    
    <div class="form-group">
    	<label>Keywords (Untuk pencarian Google)</label>
        <textarea name="keywords" placeholder="Keywords Berita" class="form-control"><?php echo $berita['keywords'] ?></textarea>
    </div>
    
    <div class="form-group">
	<input type="submit" name="submit" value="Simpan Berita" class="btn btn-primary">
    <input type="reset" name="reset" value="Reset" class="btn btn-primary">
    </div>
</div>

</form>