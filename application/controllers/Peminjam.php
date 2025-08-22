<?php
class Peminjam extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model');
		if (null==$this->session->level) {
			redirect('auth');
		}else{
			if ($this->session->level!="Peminjam") {
				redirect('auth','refresh');
			}
		}
	}

	public function index()
	{
		$data['title'] = 'Peminjam';
		$data['user'] = $this->session->userdata('id_user');
		$data['username'] = $this->session->userdata('username');

		$data['ruangan'] = $this->model->get_data('ruangan')->result();
		// $data['ruangan'] = $this->db->get('ruangan')->result();
		$this->load->view('templates/header', $data);
		$this->load->view('peminjam/dashboard', $data);
		$this->load->view('templates/footer');
	}

	// PINJAM
	public function pinjam()
	{
		$id_user = $this->input->post('id_user');
		$username = $this->input->post('username');
		$id_ruangan = $this->input->post('id_ruangan');
		$jam_mulai = $this->input->post('jam_mulai');
		$jam_berakhir = $this->input->post('jam_berakhir');
		$tanggal = $this->input->post('tanggal');
		$keterangan = $this->input->post('keterangan');

		$array = [
			'id_peminjaman' => null,
			'id_user' => $id_user,
			'id_ruangan' => $id_ruangan,
			'jam_mulai' => $jam_mulai,
			'jam_berakhir' => $jam_berakhir,
			'tanggal' => $tanggal,
			'keterangan' => $keterangan,
			'status_peminjaman' => 0
		];

		$this->model->add_data('peminjaman', $array);
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h5><i class="icon fas fa-check"></i> Peminjaman berhasil!</h5>
			<span>Harap tunggu konfirmasi admin untuk menerima jadwal</span></div>');
		$tanggalformatted=date_create($tanggal);

		$admin = $this->db->get_where('user', ['level'=>'Admin'])->row_array();

		$this->load->view('peminjam/dashboard', $data);
		redirect($data);
	}

	public function batalpinjam($id_user, $id_ruangan)
	{
		$batalpinjam = $this->model->deletedata('peminjaman', array('id_user'=>$id_user, 'id_ruangan'=>$id_ruangan));
		if ($batalpinjam) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-check"></i> Dibatalkan!</h5></div>');
			redirect('peminjam');
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-ban"></i> Gagal membatalkan peminjaman!</h5>
				<span>Hubungi admin untuk detailnya!</span></div>');
			redirect('peminjam');
		}
	}

	public function jadwal()
	{
		$data['title'] = 'Jadwal';

		$data['id_user'] = $this->session->userdata('id_user');
		$data['username'] = $this->session->userdata('username');
		$data['jadwal'] = $this->db->query("SELECT * FROM jadwal INNER JOIN peminjaman, ruangan, user WHERE jadwal.id_peminjaman=peminjaman.id_peminjaman 
			AND peminjaman.id_ruangan=ruangan.id_ruangan
			AND peminjaman.id_user=user.id_user
			AND peminjaman.status_peminjaman!=0
			AND jadwal.status_jadwal !=3
			")->result();
		$this->load->view('templates/header', $data);
		$this->load->view('peminjam/jadwal', $data);
		$this->load->view('templates/footer');
	}
}
