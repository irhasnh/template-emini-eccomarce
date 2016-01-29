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

<!--  Modals-->
<div class="panel-body">
<p><button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah User</button></p>

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Tambah User Baru</h4>
      </div>
      <div class="modal-body">
          <form action="<?php echo base_url('admin/user') ?>" method="post">
          	<div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-tag"></i></span>
              <input name="nama" type="text" autofocus required class="form-control" placeholder="Nama lengkap"  value="<?php echo set_value('nama') ?>">
          	</div>
            <div class="form-group input-group">
              <span class="input-group-addon">@</span>
              <input type="email" name="email" class="form-control" placeholder="Alamat email" required value="<?php echo set_value('email') ?>">
          	</div>
            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" name="username" class="form-control" placeholder="Username" required value="<?php echo set_value('username') ?>">
          	</div>
            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="password" name="password" class="form-control" placeholder="Password" required value="<?php echo set_value('password') ?>">
          	</div>
            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-eye"></i></span>
              <select name="level" class="form-control" required>
              	<option value="Admin">Administrator</option>
                <option value="Member">Member</option>
              </select>
          	</div>
            <div class="form-group input-group">
            	<input type="submit" name="submit" value="Simpan Data User" class="btn btn-primary btn-md">
                <input type="reset" name="reset" value="Reset" class="btn btn-default btn-md">
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </div>
</div>
</div>
</div>
<!-- End Modals-->

<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<thead>
    <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Username - Level</th>
        <th></th>
    </tr>
</thead>
<tbody>
	<?php $i=1; foreach($user as $user) { ?>
    <tr class="odd gradeX">
        <td><?php echo $i; ?></td>
        <td><?php echo $user['nama'] ?></td>
        <td><?php echo $user['email'] ?></td>
        <td class="center"><?php echo $user['username'].' - '.$user['level']; ?></td>
        <td class="center">
        <a href="<?php echo base_url('admin/user/edit/'.$user['id_user']) ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
        <a href="<?php echo base_url('admin/user/delete/'.$user['id_user']) ?>" class="btn btn-primary" onClick="return confirm('Yakin ingin menghapus user ini?')"><i class="fa fa-trash"></i></a>
       
        </td>
    </tr>
    <?php $i++; } ?>
</tbody>
</table>