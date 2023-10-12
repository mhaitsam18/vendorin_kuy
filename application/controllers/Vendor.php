<?php

class Vendor extends CI_Controller{

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('role_id') != 3){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Anda Belum Login!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			redirect('auth/login');
		}
	}
	
	public function dashboard_vendor()
	{
		$data['best_rent'] = $this->model_barang->best_rent()->result();
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$this->load->view('templates_vendor/header');
		$this->load->view('templates_vendor/sidebar', $data);
		$this->load->view('vendor/dashboard', $data);
		$this->load->view('templates_vendor/footer');
	}

	public function chart()
	{
		// $data = ['content' => "vendor/chart_peminjaaman"];
		$data['title'] = 'Chart';
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$this->load->view('templates_vendor/header');
		$this->load->view('templates_vendor/sidebar', $data);
		$this->load->view('vendor/chart_peminjaman');
		$this->load->view('templates_vendor/footer');
	}
	
	public function invoice()
	{
		$data['title'] = 'Invoice';

		$this->db->where('batas_bayar <', date('Y-m-d H:i:s'));
		$this->db->where('status', 'Belum dikonfirmasi');
		$this->db->update('tb_invoice', ['status' => 'Batal']);

		$data['invoice'] = $this->model_invoice->tampil_data();
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$this->load->view('templates_vendor/header');
		$this->load->view('templates_vendor/sidebar', $data);
		$this->load->view('vendor/invoice',$data);
		$this->load->view('templates_vendor/footer');
	}

	public function detailInvoice($id_invoice)
	{
		$data['invoice'] = $this->model_invoice->ambil_id_invoice($id_invoice);
		$data['pesanan'] = $this->model_invoice->ambil_id_pesanan($id_invoice);
		$data['title'] = 'Invoice';
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$this->load->view('templates_vendor/header');
		$this->load->view('templates_vendor/sidebar', $data);
		$this->load->view('vendor/detail_invoice',$data);
		$this->load->view('templates_vendor/footer');
	}

	public function updateStatusInvoice($id, $status)
	{
		$data['title'] = 'Invoice';
		$update = $this->model_invoice->updateStatus($id, $status);
		if ($update) {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Status Berhasil diupdate!
				</div>');
			redirect('vendor/invoice');
		} else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Status Gagal diupdate!
				</div>');
			redirect('vendor/invoice');
		}
	}

	public function Data_barang()
	{
		$data['title'] = 'Data Barang';
		$data['barang'] = $this->model_barang->tampil_data($this->session->userdata('id_vendor'))->result();
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$this->load->view('templates_vendor/header');
		$this->load->view('templates_vendor/sidebar', $data);
		$this->load->view('vendor/data_barang', $data);
		$this->load->view('templates_vendor/footer');
	}

	public function tambah_barang(){
		$data['title'] 	= 'Data Barang';
		$nama_brg		= $this->input->post('nama_brg');
		$keterangan		= $this->input->post('keterangan');
		$kategori		= $this->input->post('kategori');
		$harga			= $this->input->post('harga');
		$stok			= $this->input->post('stok');
		$gambar			= $_FILES['gambar']['name'];
		if ($gambar ='') {}else{
			$config['upload_path'] = './uploads';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';

			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('gambar')){
				echo "Gambar Gagal diUpload!";
			}else{
				$gambar=$this->upload->data('file_name');
			}
		}

		$data = array(
			'id_vendor'		=> $this->session->userdata('id_vendor'),
			'nama_brg'		=> $nama_brg,
			'keterangan' 	=> $keterangan,
			'kategori'		=> $kategori,
			'harga'			=> $harga,
			'stok'			=> $stok,
			'gambar' 		=> $gambar
		);

		$this->model_barang->tambah_barang($data, 'tb_barang');
		redirect('vendor/data_barang');
	}

	public function edit_barang($id)
	{
		$data['title'] = 'Data Barang';
		$where = array('id_brg' =>$id);
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['barang'] = $this->model_barang->edit_barang($where, 'tb_barang')->result();
		$this->load->view('templates_vendor/header');
		$this->load->view('templates_vendor/sidebar', $data);
		$this->load->view('vendor/edit_barang', $data);
		$this->load->view('templates_vendor/footer');
	}

	public function update_barang(){
		$data['title'] = 'Data Barang';
		$id 		= $this->input->post('id_brg');
		$nama_brg 	= $this->input->post('nama_brg');
		$keterangan = $this->input->post('keterangan');
		$kategori	= $this->input->post('kategori');
		$harga		= $this->input->post('harga');
		$stok		= $this->input->post('stok');

		$data = array(

			'nama_brg' => $nama_brg,
			'keterangan' => $keterangan,
			'kategori' => $kategori,
			'harga' => $harga,
			'stok' => $stok
		);

		$where = array(
			'id_brg' => $id
		);

		$this->model_barang->update_data($where,$data, 'tb_barang');
		redirect('vendor/data_barang');
	}

	public function hapus_barang($id)
	{
		$data['title'] = 'Data Barang';
		$where = array('id_brg' => $id);
		$this->model_barang->hapus_data($where, 'tb_barang');
		redirect('vendor/data_barang');
	}

	public function riwayat_peminjam($id_brg)
	{
		$data['title'] = 'Riwayat Peminjaman';
		$data['barang'] = $this->model_barang->detail_brg($id_brg);
		$data['riwayat'] = $this->model_invoice->getPesananByBarang($id_brg);
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$this->cart->destroy();
		$this->load->view('templates_vendor/header',$data);
		$this->load->view('templates_vendor/sidebar',$data);
		$this->load->view('vendor/riwayat_peminjam',$data);
		$this->load->view('templates_vendor/footer',$data);
	}

	// public function profil_vendor()
	// {
	// 	$data['title'] = 'Profil Vendor';
	// 	$data['user'] = $this->model_vendor->view();
	// 	$this->load->view('templates_vendor/header');
	// 	$this->load->view('templates_vendor/sidebar', $data);
	// 	$this->load->view('vendor/profil_vendor', $data);
	// 	$this->load->view('templates_vendor/footer');
	// }

	public function laporan()
	{
		$data['title'] = 'Laporan';
		// $data['pesanan'] = $this->model_invoice->getPesananByVendor($this->session->userdata('id_vendor'));
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();


		if (!empty($this->input->post('ke_tanggal'))) {
			$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan.id_brg');
			$this->db->join('tb_invoice', 'tb_invoice.id = tb_pesanan.id_invoice');
			$data['pesanan'] = $this->db->get_where('tb_pesanan', [
				'id_vendor' => $this->session->userdata('id_vendor'),
				'tgl_pesan >=' => $this->input->post('dari_tanggal'),
				'tgl_pesan <=' => $this->input->post('ke_tanggal')
			])->result();
		} elseif (!empty($this->input->post('dari_tanggal'))) {
			$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan.id_brg');
			$this->db->join('tb_invoice', 'tb_invoice.id = tb_pesanan.id_invoice');
			$data['pesanan'] = $this->db->get_where('tb_pesanan', [
				'id_vendor' => $this->session->userdata('id_vendor'),
				'tgl_pesan >=' => $this->input->post('dari_tanggal')
			])->result();
		} else{
			$this->db->join('tb_barang', 'tb_barang.id_brg=tb_pesanan.id_brg');
			$this->db->join('tb_invoice', 'tb_invoice.id=tb_pesanan.id_invoice');
			$data['pesanan'] = $this->db->get_where('tb_pesanan', ['id_vendor' => $this->session->userdata('id_vendor')])->result();
		}


		$this->load->view('templates_vendor/header');
		$this->load->view('templates_vendor/sidebar', $data);
		$this->load->view('vendor/laporan',$data);
		$this->load->view('templates_vendor/footer');
	}

	// public function laporan($dari_tahun = null, $dari_bulan = null, $ke_tahun = null, $ke_bulan = null)
	// {
	// 	$data['title'] = 'Laporan';
	// 	// $data['pesanan'] = $this->model_invoice->getPesananByVendor($this->session->userdata('id_vendor'));
	// 	$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

	// 	$this->db->select('YEAR(tgl_pesan) AS tahun');
	// 	$this->db->distinct();
	// 	$this->db->join('tb_barang', 'tb_barang.id_brg=tb_pesanan.id_brg');
	// 	$this->db->join('tb_invoice', 'tb_invoice.id=tb_pesanan.id_invoice');
	// 	$data['from_tahun'] = $this->db->get_where('tb_pesanan', ['id_vendor' => $id_vendor])->result();

	// 	if ($dari_tahun) {
	// 		$this->db->select('MONTH(tgl_pesan) AS bulan');
	// 		$this->db->distinct();
	// 		$this->db->join('tb_barang', 'tb_barang.id_brg=tb_pesanan.id_brg');
	// 		$this->db->join('tb_invoice', 'tb_invoice.id=tb_pesanan.id_invoice');
	// 		$data['from_bulan'] = $this->db->get_where('tb_pesanan', [
	// 			'id_vendor' => $id_vendor,
	// 			'YEAR(tgl_pesan)' => $dari_tahun
	// 		])->result();
	// 	}

	// 	if ($dari_bulan) {
	// 		$this->db->select('YEAR(tgl_pesan) AS tahun');
	// 		$this->db->distinct();
	// 		$this->db->join('tb_barang', 'tb_barang.id_brg=tb_pesanan.id_brg');
	// 		$this->db->join('tb_invoice', 'tb_invoice.id=tb_pesanan.id_invoice');
	// 		$data['to_tahun'] = $this->db->get_where('tb_pesanan', [
	// 			'id_vendor' => $id_vendor,
	// 			'YEAR(tgl_pesan) >=' => $dari_tahun,
	// 			'MONTH(tgl_pesan) >=' => $dari_bulan
	// 		])->result();
	// 	}

	// 	if ($ke_tahun) {
	// 		$this->db->select('MONTH(tgl_pesan) AS bulan');
	// 		$this->db->distinct();
	// 		$this->db->join('tb_barang', 'tb_barang.id_brg=tb_pesanan.id_brg');
	// 		$this->db->join('tb_invoice', 'tb_invoice.id=tb_pesanan.id_invoice');
	// 		$data['to_bulan'] = $this->db->get_where('tb_pesanan', [
	// 			'id_vendor' => $id_vendor,
	// 			'YEAR(tgl_pesan)' => $ke_tahun,
	// 			'MONTH(tgl_pesan) >=' => $dari_bulan,
	// 		])->result();
	// 	}

	// 	if ($ke_bulan) {
	// 		$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan.id_brg');
	// 		$this->db->join('tb_invoice', 'tb_invoice.id = tb_pesanan.id_invoice');
	// 		$data['pesanan'] = $this->db->get_where('tb_pesanan', [
	// 			'id_vendor' => $id_vendor,
	// 			'YEAR(tgl_pesan) >=' => $dari_tahun,
	// 			'MONTH(tgl_pesan) >=' => $dari_bulan,
	// 			'YEAR(tgl_pesan) <=' => $ke_tahun,
	// 			'MONTH(tgl_pesan) <=' => $ke_bulan,
	// 		])->result();
	// 	} elseif ($ke_tahun) {
	// 		$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan.id_brg');
	// 		$this->db->join('tb_invoice', 'tb_invoice.id = tb_pesanan.id_invoice');
	// 		$data['pesanan'] = $this->db->get_where('tb_pesanan', [
	// 			'id_vendor' => $id_vendor,
	// 			'YEAR(tgl_pesan) >=' => $dari_tahun,
	// 			'MONTH(tgl_pesan) >=' => $dari_bulan,
	// 			'YEAR(tgl_pesan) <=' => $ke_tahun,
	// 		])->result();
	// 	} elseif ($dari_bulan) {
	// 		$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan.id_brg');
	// 		$this->db->join('tb_invoice', 'tb_invoice.id = tb_pesanan.id_invoice');
	// 		$data['pesanan'] = $this->db->get_where('tb_pesanan', [
	// 			'id_vendor' => $id_vendor,
	// 			'YEAR(tgl_pesan) >=' => $dari_tahun,
	// 			'MONTH(tgl_pesan) >=' => $dari_bulan,
	// 		])->result();
	// 	} elseif ($dari_tahun) {
	// 		$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan.id_brg');
	// 		$this->db->join('tb_invoice', 'tb_invoice.id = tb_pesanan.id_invoice');
	// 		$data['pesanan'] = $this->db->get_where('tb_pesanan', [
	// 			'id_vendor' => $id_vendor,
	// 			'YEAR(tgl_pesan) >=' => $dari_tahun,
	// 		])->result();
	// 	} else{
	// 		$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan.id_brg');
	// 		$this->db->join('tb_invoice', 'tb_invoice.id = tb_pesanan.id_invoice');
	// 		$data['pesanan'] = $this->db->get_where('tb_pesanan', ['id_vendor' => $id_vendor])->result();
	// 	}


	// 	$this->load->view('templates_vendor/header');
	// 	$this->load->view('templates_vendor/sidebar', $data);
	// 	$this->load->view('vendor/laporan',$data);
	// 	$this->load->view('templates_vendor/footer');
	// }

	public function cetakLaporan($dari_tanggal = '', $ke_tanggal = '')
	{
		$data['title'] = 'Laporan';
		// $data['pesanan'] = $this->model_invoice->getPesananByVendor($this->session->userdata('id_vendor'));
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		if (!empty($ke_tanggal)) {
			$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan.id_brg');
			$this->db->join('tb_invoice', 'tb_invoice.id = tb_pesanan.id_invoice');
			$data['pesanan'] = $this->db->get_where('tb_pesanan', [
				'id_vendor' => $this->session->userdata('id_vendor'),
				'tgl_pesan >=' => $dari_tanggal,
				'tgl_pesan <=' => $ke_tanggal
			])->result();
		} elseif (!empty($dari_tanggal)) {
			$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan.id_brg');
			$this->db->join('tb_invoice', 'tb_invoice.id = tb_pesanan.id_invoice');
			$data['pesanan'] = $this->db->get_where('tb_pesanan', [
				'id_vendor' => $this->session->userdata('id_vendor'),
				'tgl_pesan >=' => $dari_tanggal
			])->result();
		} else{
			$this->db->join('tb_barang', 'tb_barang.id_brg=tb_pesanan.id_brg');
			$this->db->join('tb_invoice', 'tb_invoice.id=tb_pesanan.id_invoice');
			$data['pesanan'] = $this->db->get_where('tb_pesanan', ['id_vendor' => $this->session->userdata('id_vendor')])->result();
		}
		$this->load->view('templates_vendor/header');
		$this->load->view('vendor/cetak-laporan',$data);
		$this->load->view('templates_vendor/footer');
	}
	
}