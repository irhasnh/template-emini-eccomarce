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
<p><button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Kategori Berita</button></p>

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Tambah Jenis Baru</h4>
      </div>
      <div class="modal-body">
          <form action="<?php echo base_url('admin/kategori_berita') ?>" method="post">
          
          <div class="col-md-8">
          	<div class="form-group">
              <label>Nama Kategori Berita</label>
              <input type="text" name="nama_kategori_berita" class="form-control" placeholder="Nama kategori berita produk" required  value="<?php echo set_value('nama_kategori_berita') ?>">
          	</div>
         </div>
         
          <div class="col-md-4">
          	<div class="form-group">
              <label>Nomor Urut</label>
              <input type="number" name="urutan" class="form-control" placeholder="Nomor urut" required  value="<?php echo set_value('urutan') ?>">
          	</div>
         </div>
         
            <div class="col-md-12">
            <div class="form-group">
              <label>Keterangan</label>
             <textarea class="form-control" name="keterangan"><?php echo set_value('keterangan') ?></textarea>
          	</div>
            
            <div class="form-group input-group">
            	<input type="submit" name="submit" value="Simpan Data Jenis" class="btn btn-primary btn-md">
                <input type="reset" name="reset" value="Reset" class="btn btn-default btn-md">
            </div>
            </div>
            <div class="clearfix"></div>
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
        <th>Slug</th>
        <th>Urutan</th>
        <th></th>
    </tr>
</thead>
<tbody>
	<?php $i=1; foreach($kategori_berita as $kategori_berita) { ?>
    <tr class="odd gradeX">
        <td><?php echo $i; ?></td>
        <td><?php echo $kategori_berita['nama_kategori_berita'] ?></td>
        <td><?php echo $kategori_berita['slug_kategori_berita'] ?></td>
        <td class="center"><?php echo $kategori_berita['urutan']; ?></td>
        <td class="center">
        <a href="<?php echo base_url('admin/kategori_berita/edit/'.$kategori_berita['id_kategori_berita']) ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
        <a href="<?php echo base_url('admin/kategori_berita/delete/'.$kategori_berita['id_kategori_berita']) ?>" class="btn btn-primary" onClick="return confirm('Yakin ingin menghapus kategori_berita ini?')"><i class="fa fa-trash"></i></a>
       
        </td>
    </tr>
    <?php $i++; } ?>
</tbody>
</table>