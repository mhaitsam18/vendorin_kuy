<div class="container-fluid">
	<h4>INVOICE PEMINJAMAN BARANG</h4>
	<?= $this->session->flashdata('message'); ?>
	<table class="table table-bordered table-hover table-striped table-responsive" id="dataTable">
		<thead>
			<tr>
				<th>No.</th>
				<th>Id Invoice</th>
				<th>Nama Pemesan</th>
				<th>Alamat Pengiriman</th>
				<th>Tanggal Pemesanan</th>
				<th>Batas Pembayaran</th>
				<th>Tanggal Peminjaman</th>
				<th>Tanggal Pengembalian</th>
				<!-- <th>Status Pembayaran</th> -->
				<th>Status Barang</th>
				<th>Dokumen</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $n = 1; ?>
			<?php foreach ($invoice as $inv) : ?>

				<?php 
				$color = '';
				if ($inv->status_sewa == 'Belum dikonfirmasi'){
					$color = '';
				} elseif($inv->status_sewa == 'Batal'){
					$color = 'table-danger';
				} elseif($inv->status_sewa == 'Selesai'){
					$color = 'table-success';
				} elseif($inv->status_sewa == 'Tersewa'){
					$color = 'table-info';
				}?>
				<tr class="<?= $color ?>">
					<th><?= $n++; ?></th>
					<td><?= $inv->idi ?></td>
					<td><?= $inv->nama ?></td>
					<td><?= $inv->alamat ?></td>
					<td><?= $inv->tgl_pesan ?></td>
					<td><?= cari_waktu($inv->batas_bayar) ?></td>
					<td><?= cari_waktu($inv->tgl_pengiriman); ?></td>
					<td><?= cari_waktu($inv->tgl_pengembalian); ?></td>
					<!-- <td><?= $inv->status_pembayaran ?></td> -->
					<td><?= $inv->status_sewa ?></td>
					<td>
						<?php if (!empty($inv->ktp) && file_exists("./assets/doc/ktp/$inv->ktp")): ?>
							<a href="<?= base_url('/assets/doc/ktp/'.$inv->ktp); ?>" class="btn btn-sm btn-info mb-1 mr-2">KTM/KTP</a>
						<?php endif ?>
						<?php if (!empty($inv->mou) && file_exists("./assets/doc/mou/$inv->mou")): ?>
							<a href="<?= base_url('/assets/doc/mou/'.$inv->mou); ?>" class="btn btn-sm btn-danger mb-1 mr-2">MOU</a>
						<?php endif ?>
						<?php if (!empty($inv->bukti_pembayaran) && file_exists("./assets/img/bukti-transfer/$inv->bukti_pembayaran")): ?>
							<a href="<?= base_url('assets/img/bukti-transfer/'.$inv->bukti_pembayaran); ?>" class="btn btn-sm btn-success mb-1 mr-2">Bukti Transfer</a>
						<?php endif ?>
					</td>
					<td>
						<?= anchor('vendor/detailInvoice/'.$inv->idi, '<div class="btn btn-sm btn-primary mb-1 mr-2">Detail</div>') ?>
						<?= anchor('vendor/updateStatusInvoice/'.$inv->idi.'/Tersewa', '<div class="btn btn-sm btn-success mb-1 mr-2">Tersewa</div>') ?>
						<?= anchor('vendor/updateStatusInvoice/'.$inv->idi.'/Batal', '<div class="btn btn-sm btn-danger mb-1 mr-2">Batal</div>') ?>
						<?= anchor('vendor/updateStatusInvoice/'.$inv->idi.'/Selesai', '<div class="btn btn-sm btn-info mb-1 mr-2">Selesai</div>') ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>