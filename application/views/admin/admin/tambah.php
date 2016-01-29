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

<form action="<?php echo base_url('admin/user/edit/'.$user['id_user']) ?>" method="post">

<input type="hidden" name="id_user" value="<?php echo $user['id_user'] ?>">

  <div class="form-group input-group">
    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
    <input type="text" name="nama" class="form-control" placeholder="Nama lengkap" required  value="<?php echo $user['nama'] ?>">
  </div>
  <div class="form-group input-group">
    <span class="input-group-addon">@</span>
    <input type="email" name="email" class="form-control" placeholder="Alamat email" required value="<?php echo $user['email'] ?>">
  </div>
  <div class="form-group input-group">
    <span class="input-group-addon"><i class="fa fa-user"></i></span>
    <input type="text" name="username" class="form-control" placeholder="Username" required value="<?php echo $user['username'] ?>" readonly disabled>
  </div>
  <div class="form-group input-group">
    <span class="input-group-addon"><i class="fa fa-key"></i></span>
    <input type="password" name="password" class="form-control" placeholder="Password" required value="<?php echo $user['password'] ?>">
  </div>
  <div class="form-group input-group">
    <span class="input-group-addon"><i class="fa fa-eye"></i></span>
    <select name="level" class="form-control" required>
      <option value="Admin" <?php if($user['level']=="Admin") { echo "selected"; } ?>>Administrator</option>
      <option value="Member" <?php if($user['level']=="Member") { echo "selected"; } ?>>Member</option>
    </select>
  </div>
  <div class="form-group input-group">
      <input type="submit" name="submit" value="Simpan Data User" class="btn btn-primary btn-md">
      <input type="reset" name="reset" value="Reset" class="btn btn-default btn-md">
  </div>
</form>