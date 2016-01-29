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

<style>
#imagePreview {
    width: 150px;
    height: 150px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}

.container-inner{
    content: " ";
    display: table;
    width: 980px;
    margin-left: auto;
    margin-right: auto;
    background: white;
    padding:20px;
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
<!--main content area-->
<section class="recipes-home-body inner-page">
    <div class="container-inner">
    <h3>Mendaftar ke ZetFood</h3><hr>
<form action="<?php echo base_url('user/register') ?>" method="post" enctype="multipart/form-data">

<div class="col-md-6">
    <div class="form-group input-group-lg">
        <input type="text" name="nama" class="form-control" value="<?php echo set_value('nama') ?>" required placeholder="Nama">
    </div>
    <div class="form-group input-group-lg">
        <input type="text" name="username" class="form-control" value="<?php echo set_value('username') ?>" required placeholder="Username">
    </div>
    <div class="form-group input-group-lg">
        <input type="text" name="email" class="form-control" value="<?php echo set_value('email') ?>" required placeholder="Email">
    </div>
    <div class="form-group input-group-lg">
        <input type="password" name="password" class="form-control" value="<?php echo set_value('password') ?>" required placeholder="Password">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
    <p>Dengan mengeklik Mendaftar, Anda menyetujui Ketentuan kami dan bahwa Anda telah membaca Kebijakan kami.</p>
    <input type="submit" name="submit" value="Mendaftar" class="btn btn-primary">
    </div>
</div>
</div>
</form>
</div>
</section>
