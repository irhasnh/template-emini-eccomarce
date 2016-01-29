
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
<p><a href="<?php echo base_url('admin/store/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Toko</a></p>


<table class="table table-striped table-bordered table-hover" id="dataTables-example" width="100%">
<thead>
    <tr>
        <th>#</th>
        <th>Gambar</th>
        <th>Nama Toko</th>
        <th>Alamat</th>
        <th>O/Makanan</th>
        <th>O/Tempat</th>
        <th></th>
    </tr>
</thead>
<tbody>
	<?php $i=1; foreach($store as $store) { ?>
    <tr class="odd gradeX">
        <td><?php echo $i; ?>.</td>
        <td><img src="<?php echo base_url('assets/upload/image/thumbs/'.$store['gambar']) ?>" width="60"></td>
        <td><?php echo $store['nama_toko'] ?></td>
        <td><?php echo $store['alamat']; ?></td>
        <td><?php echo $store['order_makanan']; ?></td>
        <td><?php echo $store['order_tempat']; ?></td>
        <td>
        <a href="<?php echo base_url('admin/store/edit/'.$store['id_store']) ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
        <a href="<?php echo base_url('admin/store/view/'.$store['id_store']) ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
       
       <!-- Delete store -->
       <!--  Modals-->
<button class="btn btn-primary" data-toggle="modal" data-target="#Delete<?php echo $store['id_store']; ?>"><i class="fa fa-trash"></i></button>

<div class="modal fade" id="Delete<?php echo $store['id_store']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Yakin ingin menghapus store ini?</h4>
      </div>
      <div class="modal-body">
      <div class="col-md-12">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped table-bordered table-hover">
  <tr>
    <td>Nama Toko</td>
    <td><?php echo $store['nama_toko'] ?></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td><?php echo $store['alamat']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    <a href="<?php echo base_url('admin/store/delete/'.$store['id_store']) ?>" class="btn btn-primary">Hapus Berita</a>
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