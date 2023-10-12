	<!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- Page Heading -->
		<?= $this->session->flashdata('message'); ?>
		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>" data-objek="Data vendor"></div>
		<?= form_error('vendor','<div class="alert alert-danger" role="alert">','</div>'); ?>
		<div class="card">
			<div class="card-header"><i class="fas fa-table"></i> Data Vendor</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card-body">
						<table class="table table-hover" id="dataTable">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Nama Lengkap</th>
									<th scope="col">Username</th>
									<th scope="col">Bukti Surat Usaha</th>
									<th scope="col">Catatan</th>
									<th scope="col">Status Aktivasi</th>
									<th scope="col">Status Validasi</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; ?>
								<?php foreach ($vendor as $key): ?>
									<tr>
										<th scope="row"><?= $no ?></th>
										<td><?= $key->nama ?></td>
										<td><?= $key->username ?></td>
										<td><a href="<?= base_url('assets/doc/bukti-surat-usaha/').$key->bukti_surat_usaha ?>" class="btn btn-link"><i class="fas fa-file-pdf"></i></a></td>
										<td><?= $key->catatan ?></td>
										<?php if ($key->is_active == 1): ?>
											<td>Aktif</td>
										<?php else: ?>
											<td>Tidak Aktif</td>
										<?php endif ?>
										<td><?= $key->status ?></td>
										<td>
											<?php if ($key->is_active == 1): ?>
												<!-- <a href="<?= base_url("Admin/updateStatusUser/$key->idu/0"); ?>" class="badge badge-danger" data-hapus="vendor">Tolak</a> -->
											<?php else: ?>
												<a href="<?= base_url("Admin/updateStatusUser/$key->idu/1"); ?>" class="badge badge-success" data-hapus="vendor">Aktivasi</a>
											<?php endif ?>
											<a href="#" class="badge badge-primary" data-toggle="modal" data-target="#catatanModal<?= $key->idv ?>"><i class="fas fa-edit"></i></a>
											<?php if ($key->status == 'Belum dikonfirmasi'): ?>
												<a href="<?= base_url("Admin/updateStatusVendor/$key->idv/Valid"); ?>" class="badge badge-success" data-hapus="vendor">Valid</a>
												<a href="<?= base_url("Admin/updateStatusVendor/$key->idv/Tidak Valid"); ?>" class="badge badge-danger" data-hapus="vendor">Tidak valid</a>
											<?php else: ?>
												<!-- <a href="<?= base_url("Admin/updateStatusUser/$key->idu/0"); ?>" class="badge badge-danger" data-hapus="vendor">Tolak</a> -->
											<?php endif ?>
										</td>
										<!-- <td><?php echo anchor('admin/edit_vendor/' .$key->idu, '<div class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></div>') ?></td> -->
									</tr>
									<?php $no++; ?>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Button trigger modal -->

<!-- Modal -->
<?php foreach ($vendor as $key): ?>
	<div class="modal fade" id="catatanModal<?= $key->idv ?>" tabindex="-1" aria-labelledby="catatanModalLabel<?= $key->idv ?>" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="catatanModalLabel<?= $key->idv ?>">Tambah Catatan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('Admin/tambahCatatan') ?>" method="post">
					<input type="hidden" name="id" id="id" value="<?= $key->idv ?>">
					<div class="modal-body">
						<div class="form-group">
							<label for="nama">Nama Vendor</label>
							<input type="text" class="form-control" name="nama" id="nama" value="<?= $key->nama ?>" readonly>
						</div>
						<div class="form-group">
							<label for="catatan">Catatan</label>
							<textarea class="form-control" name="catatan" id="catatan"><?= $key->catatan ?></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-primary">Kirim</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach ?>