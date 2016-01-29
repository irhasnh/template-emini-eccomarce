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
    selector: "#info_toko",
    height: 250,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>

<style>
#imagePreview {
    width: 150px;
    height: 150px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}
</style>
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

<form action="<?php echo base_url('admin/store/edit/'.$store['id_store']) ?>" method="post" enctype="multipart/form-data">

<div class="col-md-6">
    <h3>Informasi Toko</h3><hr>
    <div class="form-group input-group-lg">
        <label>Nama Toko</label>
        <input type="text" name="nama_toko" class="form-control" value="<?php echo $store['nama_toko'] ?>" required placeholder="Nama Toko">
    </div>
    <div class="form-group input-group-lg">
        <label>Telepon Toko</label>
        <input type="text" name="telp_toko" class="form-control" value="<?php echo $store['telp_toko'] ?>" required placeholder="Telepon Toko">
    </div>
    <div class="form-group input-group-lg">
        <label>Alamat Toko</label>
        <input type="text" name="alamat" class="form-control" value="<?php echo $store['alamat'] ?>" required placeholder="Alamat Toko">
    </div>
    <div class="form-group input-group-lg">
        <label>Kota</label>
        <input type="text" name="kota" class="form-control" value="<?php echo $store['kota'] ?>" required placeholder="Kota">
    </div>
    <div class="form-group input-group-lg">
        <label>Kodepos</label>
        <input type="text" name="kodepos" class="form-control" value="<?php echo $store['kodepos'] ?>" required placeholder="Kodepos">
    </div>
    <div class="form-group input-group-lg">
        <label>Provinsi</label>
        <input type="text" name="provinsi" class="form-control" value="<?php echo $store['provinsi'] ?>" required placeholder="Provinsi">
    </div> 
    <div class="form-group input-group-lg">
        <label>Negara</label>
        <input type="text" name="negara" class="form-control" value="<?php echo $store['negara'] ?>" required placeholder="Negara">
    </div>    
    <div class="form-group input-group-lg">
        <label>Jenis Makanan</label>
        <input type="text" name="jenis_makanan" class="form-control" value="<?php echo $store['jenis_makanan'] ?>" required placeholder="Jenis Makanan">
    </div>
</div>


<div class="col-md-6">
    <div class="form-group">
    <h3>Gambar Toko</h3><hr>  
        <label>Upload Gambar</label>
      <input type="file" name="gambar" class="form-control" id="file">
        <div id="imagePreview"></div>
    </div>
    <h3>Informasi Pengelola</h3><hr>
    <div class="form-group input-group-lg">
        <label>Nama Pengelola</label>
        <input type="text" name="nama_pengelola" class="form-control" value="<?php echo $store['nama_pengelola'] ?>" required placeholder="Nama Pengelola">
    </div>
    <div class="form-group input-group-lg">
        <label>Telepon Pengelola</label>
        <input type="text" name="telp_pengelola" class="form-control" value="<?php echo $store['telp_pengelola'] ?>" required placeholder="Telepon Pengelola">
    </div>
    <div class="form-group input-group-lg">
        <label>Email Pengelola</label>
        <input type="text" name="email_pengelola" class="form-control" value="<?php echo $store['email_pengelola'] ?>" required placeholder="Email Pengelola">
    </div>
    <h3> Order & Booking </h3><hr>
    <div class="form-group">
        <label>Order Makanan</label>
        <select name="order_makanan" class="form-control">
            <option value="ya">Ya</option>
            <option value="tidak">Tidak</option>
        </select>
    </div>
    <div class="form-group">
        <label>Order Tempat</label>
        <select name="order_tempat" class="form-control">
            <option value="ya">Ya</option>
            <option value="tidak">Tidak</option>
        </select>
    </div>  
</div>

<div class="col-md-12">
    <div class="form-group">
        <label>Informasi Toko</label>
        <textarea name="info_toko" placeholder="Informasi Toko" class="form-control" id="info_toko"><?php echo $store['info_toko'] ?></textarea>
    </div>
    <div class="form-group input-group-lg">
        <label>Google Maps</label>
        <input type="text" name="google_map" class="form-control" value="<?php echo $store['google_map'] ?>" required placeholder="Link Google Map">
    </div>
        
    <div class="form-group">
    <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
    <input type="reset" name="reset" value="Reset" class="btn btn-primary">
    </div>
</div>

</form>