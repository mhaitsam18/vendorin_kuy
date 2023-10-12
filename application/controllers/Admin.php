<?php 

class Admin extends CI_Controller{

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('role_id') != 1){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Anda Belum Login!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			redirect('auth/login');
		}
	}
	
	public function index()
	{
		redirect('admin/vendor');
	}

	public function vendor()
	{
		$data['vendor'] = $this->model_vendor->view()->result();
		$data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['title'] = 'Data Vendor';
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('admin/vendor', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambahCatatan()
	{
		$user = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row();
		$vendor = $this->db->get_where('tb_vendor', ['id' => $this->input->post('id')])->row();

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('tb_vendor', ['catatan' => $this->input->post('catatan')]);

		$this->db->insert('tb_notifikasi', [
			'id_user' => $vendor->id_user,
			'id_kategori_notifikasi' => 2,
			'sub_id' => $this->input->post('id'),
			'waktu_notifikasi' => date('Y-m-d H:i:s'),
			'subjek' => 'Catatan Validasi',
			'pesan' => 'Catatan Anda: '.$this->input->post('catatan'),
			'is_read' => 0,
			'id_creator' => $user->id
		]);
		
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Catatan Terkirim!
			</div>');
		redirect('Admin/vendor');
	}

	public function updateStatusUser($id = null, $is_active)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_user', ['is_active' => $is_active]);
		redirect('Admin/vendor');
	}

	public function updateStatusVendor($id = null, $status)
	{
		$user = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row();
		$vendor = $this->db->get_where('tb_vendor', ['id' => $id])->row();
		$this->db->where('id', $id);
		$this->db->update('tb_vendor', ['status' => urldecode($status)]);

		$this->db->insert('tb_notifikasi', [
			'id_user' => $vendor->id_user,
			'id_kategori_notifikasi' => 2,
			'sub_id' => $id,
			'waktu_notifikasi' => date('Y-m-d H:i:s'),
			'subjek' => 'Validasi Vendor',
			'pesan' => 'Akun Vendor Anda dinyatakan '.urldecode($status),
			'is_read' => 0,
			'id_creator' => $user->id
		]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Status Vendor dikonfirmasi!
			</div>');
		redirect('Admin/vendor');
	}

	public function edit_vendor($id)
	{
		$data['title'] = 'Data Vendor';
		$where = array('id' =>$id);
		$data['vendor'] = $this->model_vendor->edit_vendor($where, 'tb_vendor')->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('admin/catatan_vendor', $data);
		$this->load->view('templates_admin/footer');
	}

	public function update_vendor(){
		$data['title'] = 'Data Vendor';
		$id 		= $this->input->post('id_vendor');
		$catatan 	= $this->input->post('catatan');

		$data = array(

			'catatan' => $catatan
		);

		$where = array(
			'id' => $id
		);

		$this->model_vendor->update_data($where,$data, 'tb_vendor');
		redirect('admin/vendor');
	}

	// public function mahasiswa()
	// {
	// 	$data['mahasiswa'] = $this->model_mahasiswa->view()->result();
	// 	$data['title'] = 'Data Mahasiswa';
	// 	$this->load->view('templates_admin/header');
	// 	$this->load->view('templates_admin/sidebar', $data);
	// 	$this->load->view('admin/mahasiswa', $data);
	// 	$this->load->view('templates_admin/footer');
	// }

	// public function updateStatusMhs($id = null, $is_active)
	// {
	// 	$this->db->where('id', $id);
	// 	$this->db->update('tb_user', ['is_active' => $is_active]);
	// 	redirect('Admin/mahasiswa');
	// }
}