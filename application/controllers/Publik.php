<?php
class Publik extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = 'Peminjam';
		$data['user'] = $this->session->userdata('id_user');
		$data['username'] = $this->session->userdata('username');

		$data['site'] = $this->m_siplabs->get_data('site')->result();
		$data['help'] = $this->db->get('help')->result();
		// $data['ruangan'] = $this->db->get('ruangan')->result();
		$this->load->view('templates/header', $data);
		$this->load->view('help', $data);
		$this->load->view('templates/footer');
	}

	public function pertanyaan()
	{
		$nama_asker = $this->input->post('nama_asker');
		$judul = $this->input->post("judul");
		$deskripsi = $this->input->post("deskripsi");

		$this->db->insert('ask', [
			'id_ask' => null,
			'nama_asker' => $nama_asker,
			'judul_ask' => $judul,
			'isi_ask' => $deskripsi,
		]);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pertanyaan diajukan!</div>');
		redirect('publik');
	}
}
