<style type="text/css">
	.img-left-info{
		max-width: 425px;
		min-width: 100px;
	}

</style>

<div class="col-md-6">
<h3>Gambar</h3><hr>
<img class="img-left-info" src="<?php echo base_url('assets/upload/image/thumbs/'.$store['gambar']) ?>">
</div>


<div class="col-md-6">
	<h3>Informasi Pengelola</h3><hr>
    <div class="form-group">
    <label>Nama Pengelola :</label>
    <?php echo $store['nama_pengelola'];?>
    </div>
    
    <div class="form-group">
    <label>Telepon Pengelola :</label>
    <?php echo $store['telp_pengelola'];?>
    </div>

    <div class="form-group">
    <label>Email Pengelola :</label>
    <?php echo $store['email_pengelola'];?>
    </div>
    
</div>

<div class="col-md-6">
	<h3>Informasi Toko</h3><hr>
	<div class="form-group">
    <label>Nama Toko :</label>
    <?php echo $store['nama_toko'];?>
    </div>
    
    <div class="form-group">
    <label>Telepon Toko :</label>
    <?php echo $store['telp_toko'];?>
    </div>
    
    <div class="form-group">
    <label>Alamat Toko :</label>
    <?php echo $store['alamat'];?>
    </div>

    <div class="form-group">
    <label>Kota :</label>
    <?php echo $store['kota'];?>
    </div>

    <div class="form-group">
    <label>Kodepos :</label>
    <?php echo $store['kodepos'];?>
    </div>

    <div class="form-group">
    <label>Provinsi :</label>
    <?php echo $store['provinsi'];?>
    </div>

    <div class="form-group">
    <label>Negara :</label>
    <?php echo $store['negara'];?>
    </div>

    <div class="form-group">
    <label>Jenis Makanan :</label>
    <?php echo $store['jenis_makanan'];?>
    </div>

    <div class="form-group">
    <label>Order Makanan :</label>
    <?php echo $store['order_makanan'];?>
    </div>

   	<div class="form-group">
    <label>Order Tempat :</label>
    <?php echo $store['order_tempat'];?>
    </div>
</div>
<div class="col-md-12">
	<h3>Deksripsi Toko</h3><hr>
    <div class="form-group">
    <?php echo $store['info_toko'];?>
    </div>

</div>


