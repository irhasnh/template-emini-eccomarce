<!--Fungsi CKEDITOR-->
<script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
<div class="konten">
<h1><?php echo $title ?></h1>

<?php
echo validation_errors('<p class="warning">','</p>');
?>

<form method="post" action="<?php echo base_url() ?>berita/edit" class="myform">

<input type="hidden" name="id_berita" value="<?php echo $berita['id_berita'] ?>">

	<p>
	  <label for="jenis">jenis berita</label>
	  <select name="jenis" id="jenis">
	    <option value="Berita" <?php if($berita['jenis']=="Berita") { echo "selected"; } ?>>Berita</option>
	    <option value="Profil" <?php if($berita['jenis']=="Profil") { echo "selected"; } ?>>Profil</option>
      </select>
	</p>
	<p>
	  <label for="Judul">Judul berita</label>
	  <input type="text" name="judul" value="<?php echo $berita['judul']; ?>">
    </p>
	<p>
	  <label for="id_kategori">kategori berita</label>
	  <select name="id_kategori" id="id_kategori">
      
      <?php foreach($kategori as $kategori) { ?>
        <option value="<?php echo $kategori['id_kategori'] ?>" <?php if($berita['id_kategori']==$kategori['id_kategori']) { echo"selected"; } ?> >
        <?php echo $kategori['nama_kategori'] ?>
        </option>
       <?php }?>
      
      </select>
	</p>
	<p>
	  <label for="ringkasan">ringkasan berita</label>
	  <textarea name="ringkasan" id="ringkasan" class="ckeditor"><?php echo $berita['ringkasan']; ?></textarea>
	</p>
	<p>
	  <label for="isi">isi berita</label>
	  <textarea name="isi" id="isi" class="ckeditor"><?php echo $berita['isi']; ?></textarea>
	</p>
	<p>
	  <label for="status_berita">status berita</label>
	  <select name="status_berita" id="status_berita">
	    <option value="Publish">Publish</option>
	    <option value="Draft">Draft</option>
      </select>
	</p>
	<p>
	  <input type="submit" name="submit" id="submit" value="Submit">
	  <input type="reset" name="submit2" id="submit2" value="Reset">
	</p>
</form>
</div>