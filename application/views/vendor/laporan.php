	<div class="container-fluid">
		<h4>LAPORAN PEMINJAMAN</h4>
		<a href="<?= base_url('Vendor/cetakLaporan/'.$this->input->post('dari_tanggal').'/'.$this->input->post('ke_tanggal').'/') ?>" class="btn btn-outline-primary float-right mb-4" target="_blank"><i class="fas fa-print">Cetak Laporan</i></a>
		<!-- <table border="0" cellspacing="5" cellpadding="5">
			<tbody>
				<tr>
					<td>Minimum date:</td>
					<td><input type="text" id="min" name="min"></td>
				</tr>
				<tr>
					<td>Maximum date:</td>
					<td><input type="text" id="max" name="max"></td>
				</tr>
			</tbody>
		</table> -->
		<!-- <div class="btn-group dropright">
			<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Tahun
			</button>
			<div class="dropdown-menu">

			</div>
		</div> -->
		<!-- <div class="btn-group dropright">
			<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Bulan
			</button>
			<div class="dropdown-menu">
				
			</div>
		</div> -->

		<form action="<?= base_url('Vendor/laporan/') ?>" method="post">
			<div class="form-row">
				<div class="col">
					<label for="dari_tanggal">Dari Tanggal</label>
					<input type="date" name="dari_tanggal" id="dari_tanggal" class="form-control">
				</div>
				<div class="col">
					<label for="ke_tanggal">Ke Tanggal</label>
					<input type="date" name="ke_tanggal" id="ke_tanggal" class="form-control">
				</div>
				<div class="col">
					<button type="submit" class="btn btn-primary mt-4">Cari</button>
				</div>
			</div>
		</form>


		<table class="table display nowrap" id="example">
			<thead>
				<tr>
					<th>ID BARANG</th>
					<th>TANGGAL TRANSAKSI</th>
					<th>NAMA</th>
					<th>NAMA BARANG</th>
					<th>JUMLAH<br>PESANAN</th>
					<th>HARGA SATUAN</th>
					<th>SUB-TOTAL</th>
				</tr>
			</thead>
				
			<?php if ($pesanan): ?>
				<?php $total = 0; ?>
				<tbody>
					<?php foreach ($pesanan as $psn) :

						$subtotal = $psn->jumlah * $psn->harga;
						$total += $subtotal;

					?>
					 <tr>
					 	<td><?php echo $psn->id_brg ?></td>
					 	<td><?php echo date('Y/m/d', strtotime($psn->tgl_pesan)); ?></td>
					 	<td><?php echo $psn->nama ?></td>
					 	<td><?php echo $psn->nama_brg ?></td>
					 	<td><?php echo $psn->jumlah ?></td>
					 	<td>Rp. <?php echo number_format($psn->harga,2,',','.') ?></td>
					 	<td>Rp. <?php echo number_format($subtotal,2,',','.') ?></td>
					 </tr>

					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6" align="right">Grand Total</td>
						<td>Rp. <?php echo number_format($total,2,',','.')  ?></td>
					</tr>
				</tfoot>
			<?php else: ?>
				<tbody>
					<tr>
						<td colspan="7" class="text-center">PESANAN TIDAK TERSEDIA</td>
					</tr>
				</tbody>
			<?php endif ?>

			
		</table>

		<a href="<?php echo base_url('vendor/invoice') ?>"><div class="btn btn-sm btn-primary">Kembali</div></a>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.0/css/dataTables.dateTime.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.0/js/dataTables.dateTime.min.js"></script>
<script type="text/javascript">
	var minDate, maxDate;
	// Custom filtering function which will search data in column four between two values
	$.fn.dataTable.ext.search.push(
		function( settings, data, dataIndex ) {
			var min = minDate.val();
			var max = maxDate.val();
			var date = new Date( data[4] );
			if (
				( min === null && max === null ) ||
				( min === null && date <= max ) ||
				( min <= date   && max === null ) ||
				( min <= date   && date <= max )
			) {
			return true;
			}
			return false;
		}
	);
	$(document).ready(function() {
		// Create date inputs
		minDate = new DateTime($('#min'), {
			format: 'MMMM Do YYYY'
		});
		maxDate = new DateTime($('#max'), {
			format: 'MMMM Do YYYY'
		});
		// DataTables initialisation
		var table = $('#example').DataTable();
		// Refilter the table
		$('#min, #max').on('change', function () {
			table.draw();
		});
	});
</script>