<style type="text/css">
	
	.title-contact{
		font-size: 14px;
		font-weight: bold;
		padding-bottom: 10px;
		padding-top: 10px;

	}
	.content-contact{
		padding: 10px;
		border: 1px solid #eee;
	}

</style>	
	<div class="title-contact">
	<i class="fa fa-user"></i> Nama Pengirim Pesan : </div>
	<div class="content-contact">
	<p> <?php echo $contact['nama_contact'];?></p>
	</div>

	<div class="title-contact">
	<i class="fa fa-send"></i> Alamat Email Pengirim : </div>
	<div class="content-contact">
	 <p><?php echo $contact['email_contact'];?></p>
	</div>

	<div class="title-contact">
	<i class="fa fa-pencil"></i> Isi Pesan Pengirim : </div>
	<div class="content-contact">
	<p><?php echo $contact['isi_contact'];?></p>
	</div>