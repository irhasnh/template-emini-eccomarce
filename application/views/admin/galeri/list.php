
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
<p><a href="<?php echo base_url('admin/galeri/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Galeri</a></p>


<table class="table table-striped table-bordered table-hover" id="dataTables-example" width="100%">
<thead>
    <tr>
        <th width="5%">#</th>
        <th width="12%">Foto</th>
        <th width="19%">Nama</th>
        <th width="21%">Posisi</th>
        <th width="7%">Website/Link</th>
        <th width="17%"></th>
    </tr>
</thead>
<tbody>
	<?php $i=1; foreach($galeri as $galeri) { ?>
    <tr class="odd gradeX">
        <td><?php echo $i; ?>.</td>
        <td><img src="<?php echo base_url('assets/upload/image/thumbs/'.$galeri['gambar']) ?>" width="60"></td>
        <td><?php echo $galeri['judul'] ?></td>
        <td><?php echo $galeri['posisi'] ?></td>
        <td><?php echo $galeri['website'] ?></td>
        <td>
        
    <!-- Delete galeri -->
       <!--  Modals-->
<button class="btn btn-primary" data-toggle="modal" data-target="#Detail<?php echo $galeri['id_galeri']; ?>"><i class="fa fa-eye"></i></button>

<div class="modal fade" id="Detail<?php echo $galeri['id_galeri']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><?php echo $galeri['judul'] ?></h4>
      </div>
      <div class="modal-body">
      <div class="col-md-12">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped table-bordered table-hover">
  <tr>
    <td colspan="2" align="center"><img src="<?php echo base_url('assets/upload/image/thumbs/'.$galeri['gambar']) ?>" ></td>
    </tr>
  <tr class="bg-primary">
    <th colspan="2" align="center"><?php echo $galeri['judul']; ?></th>
    </tr>
  <tr>
    <td>Posisi</td>
    <td><?php echo $galeri['posisi']; ?></td>
  </tr>
  <tr>
    <td>Website/Link Galeri</td>
    <td><?php echo $galeri['website']; ?></td>
  </tr>
   <tr>
    <td>Tanggal update</td>
    <td><?php echo $galeri['tanggal']; ?></td>
  </tr>
   <tr class="bg-primary">
    <th colspan="2" align="center">Keterangan</th>
    </tr>
     <tr>
    <td colspan="2"><?php echo $galeri['keterangan']; ?></td>
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

        <a href="<?php echo base_url('admin/galeri/edit/'.$galeri['id_galeri']) ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
       
       <!-- Delete galeri -->
       <!--  Modals-->
<button class="btn btn-primary" data-toggle="modal" data-target="#Delete<?php echo $galeri['id_galeri']; ?>"><i class="fa fa-trash"></i></button>

<div class="modal fade" id="Delete<?php echo $galeri['id_galeri']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Yakin ingin menghapus galeri ini?</h4>
      </div>
      <div class="modal-body">
      <div class="col-md-12">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped table-bordered table-hover">
  <tr>
    <td>Nama Galeri</td>
    <td><?php echo $galeri['judul'] ?></td>
  </tr>
  <tr>
    <td>Website/Link Publikasi</td>
    <td><?php echo $galeri['website']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    <a href="<?php echo base_url('admin/galeri/delete/'.$galeri['id_galeri']) ?>" class="btn btn-primary">Hapus Galeri</a>
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