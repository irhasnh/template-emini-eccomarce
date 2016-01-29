
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


<div class="panel-body">
<p><a href="<?php echo base_url('admin/berita/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Berita</a></p>


<table class="table table-striped table-bordered table-hover" id="dataTables-example" width="100%">
<thead>
    <tr>
        <th>#</th>
        <th>Gambar</th>
        <th>Judul</th>
        <th>Kategori</th>
        <th>Penulis</th>
        <th>Jenis</th>
        <th></th>
    </tr>
</thead>
<tbody>
	<?php $i=1; foreach($berita as $berita) { ?>
    <tr class="odd gradeX">
        <td><?php echo $i; ?>.</td>
        <td><img src="<?php echo base_url('assets/upload/image/thumbs/'.$berita['gambar']) ?>" width="60"></td>
        <td><?php echo $berita['judul'] ?></td>
        <td><?php echo $berita['nama_kategori_berita']; ?></td>
        <td><?php echo $berita['nama']; ?></td>
        <td><?php echo $berita['jenis'].' - '.$berita['status_berita']; ?></td>
        <td>
        <a href="<?php echo base_url('admin/berita/edit/'.$berita['id_berita']) ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
       
       <!-- Delete berita -->
       <!--  Modals-->
<button class="btn btn-primary" data-toggle="modal" data-target="#Delete<?php echo $berita['id_berita']; ?>"><i class="fa fa-trash"></i></button>

<div class="modal fade" id="Delete<?php echo $berita['id_berita']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Yakin ingin menghapus berita ini?</h4>
      </div>
      <div class="modal-body">
      <div class="col-md-12">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped table-bordered table-hover">
  <tr>
    <td>Judul Berita</td>
    <td><?php echo $berita['judul'] ?></td>
  </tr>
  <tr>
    <td>Jenis - Status</td>
    <td><?php echo $berita['jenis'].' - '.$berita['status_berita']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    <a href="<?php echo base_url('admin/berita/delete/'.$berita['id_berita']) ?>" class="btn btn-primary">Hapus Berita</a>
    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></td>
  </tr>
</table>
</div>
<div class="clearfix"></div>
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </div>
</div>
</div>
<!-- End Modals-->
       
        </td>
    </tr>
    <?php $i++; } ?>
</tbody>
</table>