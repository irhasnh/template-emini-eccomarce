
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
<p><a href="<?php echo base_url('admin/portfolio/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah portfolio</a></p>


<table class="table table-striped table-bordered table-hover" id="dataTables-example" width="100%">
<thead>
    <tr>
        <th>#</th>
        <th>Gambar</th>
        <th>Nama Portfolio</th>
        <th>Customer</th>
        <th>Project Type</th>
        <th>Tanggal Rilis</th>
        <th></th>
    </tr>
</thead>
<tbody>
	<?php $i=1; foreach($portfolio as $portfolio) { ?>
    <tr class="odd gradeX">
        <td><?php echo $i; ?>.</td>
        <td><img src="<?php echo base_url('assets/upload/image/thumbs/'.$portfolio['gambar']) ?>" width="60"></td>
        <td><?php echo $portfolio['nama_portfolio'] ?></td>
        <td><?php echo $portfolio['nama']; ?></td>
        <td><?php echo $portfolio['name_type']; ?></td>
        <td><?php echo $portfolio['tanggal_rilis']; ?></td>
        <td>
        <a href="<?php echo base_url('admin/portfolio/edit/'.$portfolio['id_portfolio']) ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
       
       <!-- Delete portfolio -->
       <!--  Modals-->
<button class="btn btn-primary" data-toggle="modal" data-target="#Delete<?php echo $portfolio['id_portfolio']; ?>"><i class="fa fa-trash"></i></button>

<div class="modal fade" id="Delete<?php echo $portfolio['id_portfolio']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Yakin ingin menghapus portfolio ini?</h4>
      </div>
      <div class="modal-body">
      <div class="col-md-12">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped table-bordered table-hover">
  <tr>
    <td>Judul portfolio</td>
    <td><?php echo $portfolio['judul'] ?></td>
  </tr>
  <tr>
    <td>Jenis - Status</td>
    <td><?php echo $portfolio['jenis'].' - '.$portfolio['status_portfolio']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    <a href="<?php echo base_url('admin/portfolio/delete/'.$portfolio['id_portfolio']) ?>" class="btn btn-primary">Hapus portfolio</a>
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