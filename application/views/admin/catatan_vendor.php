<div class="container-fluid">
	<h3><i class="fas fa-edit"></i>Cantumkan Keterangan di sini</h3>

	<?php foreach ($vendor as $vdr) : ?>

		<form method="post" action="<?php echo base_url().'admin/update_vendor' ?>">
			
			<div class="form-group">
				<label>Catatan</label>
				<input type="text" name="catatan" class="form-control" value="<?php echo $vdr->catatan ?>">
			</div>

			<a href="<?php echo base_url('admin/vendor') ?>"><div class="btn btn-sm btn-danger">Kembali</div></a>
			<button type="submit" class="btn btn-sm btn-primary">Simpan</button>

		</form>

	<?php endforeach;  ?>
</div>