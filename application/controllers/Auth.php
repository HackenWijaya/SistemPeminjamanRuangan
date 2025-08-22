<?php
class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model');
	}

	public function index()
	{
		if ($this->session->level) {
			redirect($this->session->level, 'refresh');
		}

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');


		if ($this->form_validation->run() == false) {
			$data['title'] = "Login";
			// $this->load->view('templates/header', $data);
			$this->load->view('login', $data);
			// $this->load->view('templates/footer', $data);                   
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$cek_username = $this->db->get_where('user', ['username' => $username])->row_array();

		if ($cek_username) {
			$data = ['password' => $cek_username['password']];

			if ($cek_username['status'] == 1) {
				if ($data['password'] == sha1($password)) {
					$userdata = [
						'id_user' => $cek_username['id_user'],
						'username' => $cek_username['username'],
						'level' => $cek_username['level'],
						'nama_lengkap' => $cek_username['nama_lengkap']
					];

					$this->session->set_userdata($userdata);
					redirect(strtolower($cek_username['level']));
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah untuk username ' . $username . '!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User ' . $username . ' belum aktif!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User tidak terdaftar!</div>');
			redirect('auth');
		}
	}

	public function mendaftar()
	{

		$nama_lengkap = htmlspecialchars($this->input->post('nama_lengkap'));
		$username = htmlspecialchars($this->input->post('username'));
		$password = htmlspecialchars($this->input->post('password'));
		$nip = htmlspecialchars($this->input->post('nip'));

		$array = [
			'id_user' => null,
			'nama_lengkap' => $nama_lengkap,
			'bio' => '',
			'username' => $username,
			'nip' => $nip,
			'no_telp' => '',
			'password' => sha1($password),
			'level' => 'Peminjam',
			'image' => '',
			'status' => 0
		];

		$this->model->add_data('user', $array);
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h5><i class="icon fas fa-check"></i> Mendaftar berhasil!</h5>
			<span>Harap tunggu konfirmasi admin untuk aktivasi</span></div>');
		redirect('auth');
	}

	public function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('nama_lengkap');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Logout berhasil!</div>');
		redirect('auth');
	}


	// BUAT OTORISASI GOOGLE
	public function authorization()
	{
		$jsonStr = file_get_contents('php://input');
		$jsonObj = json_decode($jsonStr);

		if (!empty($jsonObj->request_type) && $jsonObj->request_type == 'user_auth') {
			$credential = !empty($jsonObj->credential) ? $jsonObj->credential : '';

			list($header, $payload, $signature) = explode('.', $credential);
			$responsePayload = json_decode(base64_decode($payload));

			if (!empty($responsePayload)) {
				$oauth_provider = 'google';
				$oauth_uid = !empty($responsePayload->oauth_uid) ? $responsePayload->sub : '';
				$first_name = !empty($responsePayload->given_name) ? $responsePayload->given_name : '';
				$last_name = !empty($responsePayload->family_name) ? $responsePayload->family_name : '';
				$name = $first_name . " " . $last_name;
				$email = !empty($responsePayload->email) ? $responsePayload->email : '';
				$pass = 123;

				$vald = $this->m_user->getByEmail($email);

				if ($vald) {
					$data = [
						'nama' => $name,
						'password' => $pass
					];
					$this->m_user->update(['email' => $email], $data);

					$user = [
						'nama' => $vald['nama'],
						'email' => $vald['email'],
						'level' => $vald['level']
					];

					$this->session->set_userdata($user);

					// Tambahankan dibawahni kondisi kalau dia tu role admin atau user
					// buat Status 1 untuk admin, buat status 2 untuk user.

					// [CONTOH ISI KODE IF DIBAWAH NI]
					// $output = [
					// 	'status' => 1,
					// 	'pdata' => $responsePayload
					// ];

					// echo json_encode($output);

					if ($userRole == 'Admin') {
						$output = [
							'status' => 1,
							'pdata' => $responsePayload
						];
					} elseif ($userRole == 'Peminjam') {
						$output = [
							'status' => 2,
							'pdata' => $responsePayload
						];
					}

				} else {

					$output = [
						'status' => 0,
						'pdata' => $responsePayload
					];

					echo json_encode($output);

				}
			} else {
				echo json_encode(['error' => 'Account Data not Available']);
			}
		}
	}
}
