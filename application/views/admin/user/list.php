
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
<p><a href="<?php echo base_url('admin/user/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah User</a></p>


<table class="table table-striped table-bordered table-hover" id="dataTables-example" width="100%">
<thead>
    <tr>
        <th>#</th>
        <th>Avatar</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Bio</th>       
        <th></th>
    </tr>
</thead>
<tbody>
	<?php $i=1; foreach($user as $user) { ?>
    <tr class="odd gradeX">
        <td><?php echo $i; ?>.</td>
        <td><img src="<?php echo base_url('assets/upload/image/thumbs/'.$user['avatar']) ?>" width="60"></td>
        <td><?php echo $user['nama'] ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo substr(strip_tags($user['bio']),0,50); ?></td>
        <td>
        <a href="<?php echo base_url('admin/user/edit/'.$user['id_user']) ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
       
       <!-- Delete user -->
       <!--  Modals-->
<button class="btn btn-primary" data-toggle="modal" data-target="#Delete<?php echo $user['id_user']; ?>"><i class="fa fa-trash"></i></button>

<div class="modal fade" id="Delete<?php echo $user['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Yakin ingin menghapus user ini?</h4>
      </div>
      <div class="modal-body">
      <div class="col-md-12">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped table-bordered table-hover">
  <tr>
    <td>Nama</td>
    <td><?php echo $user['nama'] ?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $user['email'] ?></td>
  </tr>
  <tr>
    <td>Bio</td>
    <td><?php echo $user['bio'] ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    <a href="<?php echo base_url('admin/user/delete/'.$user['id_user']) ?>" class="btn btn-primary">Hapus User</a>
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