<?php 
if (!empty($this->input->post('ke_tanggal'))) {
	$this->db->distinct();
	$this->db->select('tb_barang.nama_brg AS nama_barang, jumlah');
	$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan.id_brg');
	$this->db->join('tb_invoice', 'tb_invoice.id = tb_pesanan.id_invoice');
	$dataBarangChart = $this->db->get_where("tb_pesanan", [
		'id_vendor' => $this->session->userdata('id_vendor'),
		'tgl_pesan >=' => $this->input->post('dari_tanggal'),
		'tgl_pesan <=' => $this->input->post('ke_tanggal')
	])->result();
} elseif (!empty($this->input->post('dari_tanggal'))) {
	$this->db->distinct();
	$this->db->select('tb_barang.nama_brg AS nama_barang, jumlah');
	$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan.id_brg');
	$this->db->join('tb_invoice', 'tb_invoice.id = tb_pesanan.id_invoice');
	$dataBarangChart = $this->db->get_where("tb_pesanan", [
		'id_vendor' => $this->session->userdata('id_vendor'),
		'tgl_pesan >=' => $this->input->post('dari_tanggal')
	])->result();
} else{
	$this->db->distinct();
	$this->db->select('tb_barang.nama_brg AS nama_barang, jumlah');
	$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan.id_brg');
	$dataBarangChart = $this->db->get_where("tb_pesanan", [
		'id_vendor' => $this->session->userdata('id_vendor'),
	])->result();
}
foreach ($dataBarangChart as $k => $v) {
	$arrBar[] = ['label' => $v->nama_barang, 'y' => $v->jumlah];
}
// print_r(json_encode($arrBar, JSON_NUMERIC_CHECK));die();
?>

<div class="container-fluid">
	<!-- <h4>CHART BARANG</h4><br> -->
	<form action="<?= base_url('Vendor/chart/') ?>" method="post">
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
<script type="text/javascript">
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light1", // "light2", "dark1", "dark2"
	animationEnabled: false, // change to true		
	title:{
		text: "Chart Peminjaman Barang"
	},
	data: [
	{
		// Change type to "bar", "area", "spline", "pie",etc.
		type: "column",
		// dataPoints: [
		// 	{ label: "apple",  y: 10  },
		// 	{ label: "orange", y: 15  },
		// 	{ label: "banana", y: 25  },
		// 	{ label: "mango",  y: 30  },
		// 	{ label: "grape",  y: 28  }
		// ]

		dataPoints: 
			<?php //$dataBarangChart ?> //harusnya pake '=' bukan php
			<?= json_encode($arrBar, JSON_NUMERIC_CHECK); ?>
		
	}
	]
});
chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
</body>
</html>
		
</div>