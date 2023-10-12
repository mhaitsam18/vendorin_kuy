<div class="container-fluid">
	<h3><i class="fas fa-edit"></i>EDIT DATA BARANG</h3>

	<?php foreach ($barang as $brg) : ?>

		<form method="post" action="<?php echo base_url().'vendor/update_barang' ?>">
			
			<div class="form-group">
				<label>Nama Barang</label>
				<input type="text" name="nama_brg" class="form-control" value="<?php echo $brg->nama_brg ?>">
			</div>

			<div class="form-group">
				<label>Keterangan</label>
				<input type="text" name="keterangan" class="form-control" value="<?php echo $brg->keterangan ?>">
			</div>

			<div class="form-group">
				<label>Kategori</label>
				<input type="hidden" name="id_brg" class="form-control" value="<?php echo $brg->id_brg ?>">
				<input type="text" name="kategori" class="form-control" value="<?php echo $brg->kategori ?>">
			</div>

			<div class="form-group">
				<label>Harga</label>
				<input type="text" name="harga" class="form-control" value="<?php echo $brg->harga ?>">
			</div>

			<div class="form-group">
				<label>Stok</label>
				<input type="text" name="stok" class="form-control" value="<?php echo $brg->stok ?>">
			</div>

			<a href="<?php echo base_url('vendor/data_barang') ?>"><div class="btn btn-sm btn-danger">Kembali</div></a>
			<button type="submit" class="btn btn-sm btn-primary">Simpan</button>



		</form>

	<?php endforeach;  ?>
</div>