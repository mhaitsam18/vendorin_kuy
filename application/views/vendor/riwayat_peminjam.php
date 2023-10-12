<div class="container-fluid">
	
	<div class="card">
		<h5 class="card-header">DETAIL BARANG</h5>
		<div class="card-body">

			<?php foreach ($barang as $brg) : ?>
			<div class="row">
				<div class="col-md-4">
					<img src="<?php echo base_url(). '/uploads/'. $brg->gambar ?>" class="card-img-top">
				</div>
				<div class="col-md-8">
					<table class="table">
						<tr>
							<td>Nama Barang</td>
							<td><strong><?php echo $brg->nama_brg ?></strong></td>
						</tr>

						<tr>
							<td>Keterangan</td>
							<td><strong><?php echo $brg->keterangan ?></strong></td>
						</tr>

						<tr>
							<td>Kategori</td>
							<td><strong><?php echo $brg->kategori ?></strong></td>
						</tr>

						<tr>
							<td>Stok</td>
							<td><strong><?php echo $brg->stok ?></strong></td>
						</tr>

						<tr>
							<td>Harga</td>
							<td><strong><div class="btn btn-sm btn-success">Rp. <?php echo number_format($brg->harga,0,',','.') ?></div></strong></td>
						</tr>
					</table>

					<a href="<?php echo base_url('vendor/data_barang') ?>"><div class="btn btn-sm btn-danger">Kembali</div></a>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
	<br>
	<div class="card">
		<h5 class="card-header">RIWAYAT PEMINJAM</h5>
		<div class="card-body">
			<table class="table table-hover" id="dataTable">
				<thead>
					<tr>
						<th scope="col">No.</th>
						<th scope="col">Nama Peminjam</th>
						<th scope="col">Alamat Peminjam</th>
						<th scope="col">Jumlah Barang</th>
						<th scope="col">Tanggal Pinjam</th>
						<th scope="col">Tanggal Kembali</th>
					</tr>
				</thead>
				<tbody>
					<?php $n = 1; ?>
					<?php foreach ($riwayat as $row): ?>
						<tr>
							<th scope="col"><?= $n++; ?></th>
							<td><?= $row->nama; ?></td>
							<td><?= $row->alamat; ?></td>
							<td><?= $row->jumlah; ?></td>
							<td><?= date('j F Y', strtotime($row->tgl_pesan)); ?></td>
							<td><?= date('j F Y', strtotime($row->tgl_pengembalian)); ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>