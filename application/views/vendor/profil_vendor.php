<div class="container-fluid">
	
	<div class="card">
		<h5 class="card-header">Profil Vendor</h5>
		<div class="card-body">

			<?php foreach ($user as $us) : ?>
			<div class="row">
				<!-- <div class="col-md-4">
					<img src="<?php echo base_url(). '/uploads/'. $pfl->gambar ?>" class="card-img-top">
				</div> -->
				<div class="col-md-8">
					<table class="table">
						<tr>
							<td>Nama Vendor</td>
							<td><strong><?php echo $us->nama ?></strong></td>
						</tr>

						<tr>
							<td>No. Telepon</td>
							<td><strong><?php echo $us->no_telp ?></strong></td>
						</tr>

						<tr>
							<td>Alamat</td>
							<td><strong><?php echo $us->alamat ?></strong></td>
						</tr>
					</table>

					<a href="<?php echo anchor('vendor/edit_profil/'.$us->id) ?>"><div class="btn btn-sm btn-danger">Ubah Profil Anda</div></a>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
	<!-- <div class="card">
		<h5 class="card-header">Riwayat Peminjaman</h5>
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
	</div> -->
</div>