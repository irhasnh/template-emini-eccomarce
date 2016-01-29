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

<form action="<?php echo base_url('admin/portfolio/edit/'.$portfolio['id_portfolio']) ?>" method="post" enctype="multipart/form-data">

<div class="col-md-12">
	<div class="form-group input-group-lg">
    	<label>Nama portfolio</label>
        <input type="text" name="nama_portfolio" class="form-control" value="<?php echo $portfolio['nama_portfolio'] ?>" required placeholder="Nama portfolio">
    </div>
</div>

<div class="col-md-6">

    <div class="form-group">
    	<label>Customer portfolio</label>
        <select name="id_customer" class="form-control">
        	<?php foreach($customer as $customer) { ?>
            <option value="<?php echo $customer['id_customer'] ?>" <?php if($portfolio['id_customer']==$customer['id_customer']) { echo "selected"; } ?>>
            	<?php echo $customer['nama'] ?>
            </option>
            <?php } ?>
        </select>
    </div>
	
	<div class="form-group">
    	<label>Tanggal Rilis</label>
      <input type="text" name="tanggal_rilis" class="form-control" placeholder="YYYY-MM-DD" id="tanggal"  value="<?php echo $portfolio['tanggal_rilis'] ?>">
    </div>
</div>

<div class="col-md-6">
	<div class="form-group">
    	<label>Upload Gambar</label>
      <input type="file" name="gambar" class="form-control" id="file">
        <div id="imagePreview"></div>
        <div class="imagePreview"><img src="<?php echo base_url('assets/upload/image/thumbs/'.$portfolio['gambar']) ?>"></div>
    </div>
</div>

<div class="col-md-12">
	<div class="form-group">
    	<label>Keterangan portfolio</label>
        <textarea name="keterangan" placeholder="Keterangan portfolio" class="form-control" id="keterangan"><?php echo $portfolio['keterangan'] ?></textarea>
    </div>

    <div class="form-group">
	<input type="submit" name="submit" value="Simpan portfolio" class="btn btn-primary">
    <input type="reset" name="reset" value="Reset" class="btn btn-primary">
    </div>
</div>

</form>
<script>
$( "#tanggal" ).datepicker({
	  defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
	  dateFormat: "yy-mm-dd",
});
  </script>