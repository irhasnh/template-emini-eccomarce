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
    selector: "#bio",
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

<form action="<?php echo base_url('admin/user/edit/'.$user['id_user']) ?>" method="post" enctype="multipart/form-data">

<div class="col-md-6">
    <div class="form-group input-group-lg">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $user['nama'] ?>" required placeholder="Nama">
    </div>
    <div class="form-group input-group-lg">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?php echo $user['username'] ?>" required placeholder="Username" readonly>
    </div>
    <div class="form-group input-group-lg">
        <label>Email</label>
        <input type="text" name="email" class="form-control" value="<?php echo $user['email'] ?>" required placeholder="Email">
    </div>
    <div class="form-group input-group-lg">
        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password Baru">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Upload Avatar</label>
      <input type="file" name="avatar" class="form-control" id="file">
        <div id="imagePreview"></div>
        <div class="imagePreview"><img src="<?php echo base_url('assets/upload/image/thumbs/'.$user['avatar']) ?>"></div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label>BIO</label>
        <textarea name="bio" placeholder="BIO" class="form-control" id="bio"><?php echo $user['bio'] ?></textarea>
    </div>
    
    <div class="form-group">
    <input type="submit" name="submit" value="Simpan User" class="btn btn-primary">
    <input type="reset" name="reset" value="Reset" class="btn btn-primary">
    </div>
</div>

</form>