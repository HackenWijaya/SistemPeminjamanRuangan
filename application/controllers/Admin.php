<?php
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (null == $this->session->level) {
			redirect('auth');
		} else {
			if ($this->session->level != "Admin") {
				redirect('auth', 'refresh');
			}
		}
	}

	public function index()
	{
		$data['title'] = "Beranda";
		$data['user'] = $this->session->id_user;
		$data['username'] = $this->session->username;
		$data['nama_lengkap'] = $this->session->nama_lengkap;
		$this->load->view('templates/header', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('templates/footer');
	}

	// NEW USER
	public function newuser()
	{
		$data['root'] = "Manajemen Pengguna";
		$data['title'] = "User Baru";
		$data['user'] = $this->session->userdata('id_user');
		$data['username'] = $this->session->userdata('username');
		$this->load->view('templates/header', $data);
		$this->load->view('admin/newuser', $data);
		$this->load->view('templates/footer');
	}

	public function accuser($id_user)
	{
		$this->db->update('user', array('status' => 1), array('id_user' => $id_user));
		$this->session->set_flashdata('message', '<div class="alert alert-success animated fadeIn" role="alert">User diterima!</div>');
		redirect('admin/newuser');
	}

	public function disaccuser($id_user)
	{
		$this->db->delete('user', array('id_user' => $id_user));
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User ditolak!</div>');
		redirect('admin/newuser');
	}

	// USERS
	public function users()
	{
		$data['root'] = "Manajemen Pengguna";
		$data['title'] = "Users";
		$data['user'] = $this->session->userdata('id_user');
		$data['username'] = $this->session->userdata('username');
		$this->load->view('templates/header', $data);
		$this->load->view('admin/users', $data);
		$this->load->view('templates/footer');
	}

	public function deleteuser($id_user)
	{
		$cekpeminjaman = $this->db->get_where('user', ['id_user' => $id_user])->row_array();
		if ($cekpeminjaman) {
			$this->db->delete('peminjaman', ['id_user' => $id_user]);
		}

		$this->db->delete('user', ['id_user' => $id_user]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User dihapus!</div>');
		redirect('admin/users');
	}

	// REQUEST
	public function request()
	{
		$data['root'] = "Kelola Peminjaman";
		$data['title'] = "Peminjaman";
		$data['user'] = $this->session->userdata('id_user');
		$data['username'] = $this->session->userdata('username');
		$this->load->view('templates/header', $data);
		$this->load->view('admin/request', $data);
		$this->load->view('templates/footer');
	}

	public function accrequest($id_peminjaman)
	{

		$cekpeminjaman = $this->db->get_where('peminjaman', ['id_peminjaman' => $id_peminjaman])->row_array();

		$nowtime = strtotime(date('H:i:s')) + strtotime(date('Y-m-d'));

		$dbstart = strtotime($cekpeminjaman['jam_mulai']) + strtotime($cekpeminjaman['tanggal']);
		$dbend = strtotime($cekpeminjaman['jam_berakhir']) + strtotime($cekpeminjaman['tanggal']);

		if ($nowtime >= $dbstart and $nowtime <= $dbend) {
			$ruangan = $cekpeminjaman['id_ruangan'];
			$cekjadwal = $this->db->query('SELECT * FROM jadwal INNER JOIN peminjaman, ruangan 
			WHERE jadwal.id_peminjaman=peminjaman.id_peminjaman
			AND peminjaman.id_ruangan=ruangan.id_ruangan
			AND status_jadwal=1
			AND peminjaman.id_ruangan=' . $ruangan)->row_array();

			if ($cekjadwal) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal diterima, jadwal bentrok!</div>');
				redirect('admin/request');
			} else {
				$this->db->update('ruangan', ['status_ruangan' => 'Dipakai'], ['id_ruangan' => $cekpeminjaman['id_ruangan']]);
				$this->db->update('peminjaman', array('status_peminjaman' => 1), array('id_peminjaman' => $id_peminjaman));
				$this->db->insert('jadwal', array(
					'id_jadwal' => null,
					'id_peminjaman' => $id_peminjaman,
					'status_jadwal' => 1
				));
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Request diterima!</div>');
				redirect('admin/request');
			}
		} elseif ($nowtime < $dbstart) {
			$ruangan = $cekpeminjaman['id_ruangan'];
			$cekjadwal = $this->db->query('SELECT * FROM jadwal INNER JOIN peminjaman, ruangan 
			WHERE jadwal.id_peminjaman=peminjaman.id_peminjaman
			AND peminjaman.id_ruangan=ruangan.id_ruangan
			AND status_jadwal=2
			AND peminjaman.id_ruangan=' . $ruangan)->row_array();

			$dbone = strtotime($cekjadwal['jam_mulai']) + strtotime($cekjadwal['jam_ berakhir']) + strtotime($cekjadwal['tanggal']);

			$dbtwo = strtotime($cekpeminjaman['jam_mulai']) + strtotime($cekpeminjaman['jam_ berakhir']) + strtotime($cekpeminjaman['tanggal']);

			if ($dbone == $dbtwo) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal diterima, jadwal bentrok!</div>');
				redirect('admin/request');
			} else {
				$this->db->update('peminjaman', array('status_peminjaman' => 2), array('id_peminjaman' => $id_peminjaman));
				$this->db->insert('jadwal', array(
					'id_jadwal' => null,
					'id_peminjaman' => $id_peminjaman,
					'status_jadwal' => 2
				));
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Request diterima!</div>');
				redirect('admin/request');
			}
		} else {
			$this->db->insert('jadwal', array(
				'id_jadwal' => null,
				'id_peminjaman' => $id_peminjaman,
				'status_jadwal' => 1
			));
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Request diterima!</div>');
			redirect('admin/request');
		}
	}

	public function disaccrequest($id_peminjaman)
	{
		$disaccrequest = $this->db->delete('peminjaman', array('id_peminjaman' => $id_peminjaman));
		if ($disaccrequest) {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Request ditolak!</div>');
			redirect('admin/request');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Request gagal ditolak!</div>');
			redirect('admin/request');
		}
	}

	// JADWAL
	public function jadwal()
	{
		$data['root'] = "Kelola Peminjaman";
		$data['title'] = "Jadwal";
		$data['user'] = $this->session->userdata('id_user');
		$data['username'] = $this->session->userdata('username');
		$this->load->view('templates/header', $data);
		$this->load->view('admin/jadwal', $data);
		$this->load->view('templates/footer');
	}

	public function hapusjadwal($aksi, $id_jadwal)
	{
		if ($aksi = 0) {
			$cek = $this->db->query('SELECT * FROM jadwal INNER JOIN peminjaman ON jadwal.id_peminjaman=peminjaman.id_peminjaman AND id_jadwal=' . $id_jadwal)->row_array();

			$id_peminjaman = $cek['id_peminjaman'];
			$this->db->delete('peminjaman', ['id_peminjaman' => $id_peminjaman]);
			$this->db->delete('jadwal', ['id_jadwal' => $id_jadwal]);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jadwal dihapus!</div>');
			redirect('admin/jadwal');
		} elseif ($aksi = 3) {
			$this->db->update('jadwal', ['status_jadwal' => 3], ['id_jadwal' => $id_jadwal]);
			redirect('admin/jadwal');
		} elseif ($aksi = 1) {
			$this->db->update('jadwal', ['status_jadwal' => 1], ['id_jadwal' => $id_jadwal]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jadwal dihapus!</div>');
			redirect('admin/jadwal', 'refresh');
		}
	}

	public function resetjadwal($id_peminjaman)
	{
		$resetjadwal = $this->db->update('peminjaman', array('status_peminjaman' => 4), array('id_peminjaman'));
		if ($resetjadwal) {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Beberapa jadwal yang telah melewati otomatis dihapus!</div>');
			redirect('admin/jadwal');
		}
	}

	// LAPORAN JADWAL
	public function jadwalreport()
	{
		$data['title'] = "Laporan Jadwal #" . uniqid();
		$data['user'] = $this->session->userdata('id_user');
		$data['username'] = $this->session->userdata('username');
		$this->load->view('templates/header', $data);
		$this->load->view('admin/jadwalreport', $data);
		$this->load->view('templates/footer');
	}

	// HELP
	public function help()
	{
		$data['title'] = "Bantuan dan Pertanyaan";
		$data['user'] = $this->session->userdata('id_user');
		$data['username'] = $this->session->userdata('username');
		$data['help'] = $this->db->get('help')->result();
		$data['ask'] = $this->db->get('ask')->result();
		$this->load->view('templates/header', $data);
		$this->load->view('admin/help', $data);
		$this->load->view('templates/footer');
	}

	public function edithelp()
	{
		$id_help = $this->input->post('id_help');
		$judul = $this->input->post('judul');
		$deskripsi = $this->input->post('deskripsi');

		$this->db->update('help', ['judul' => $judul, 'isi' => $deskripsi], ['id_help' => $id_help]);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data diubah!</div>');
		redirect('admin/help');
	}

	public function hapushelp($id_help)
	{
		$this->db->delete('help', ['id_help' => $id_help]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data dihapus!</div>');
		redirect('admin/help');
	}

	public function jawabask()
	{
		$id_ask = $this->input->post('id_ask');
		$judul_ask = $this->input->post('judul_ask');
		$isi_ask = $this->input->post('isi_ask');

		$this->db->insert('help', [
			'id_help' => null,
			'judul' => $judul_ask,
			'isi' => $isi_ask
		]);
		$this->db->delete('ask', ['id_ask' => $id_ask]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Dijawab! hasil jawaban akan masuk ke bantuan</div>');
		redirect('admin/help');
	}

	public function hapusask($id_ask)
	{
		$this->db->delete('ask', ['id_ask' => $id_ask]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data dihapus!</div>');
		redirect('admin/help');
	}

	// MY PROFILE
	public function myprofile($id_user)
	{
		$data['root'] = "Pengaturan";
		$data['title'] = "Profil Saya";
		$data['user'] = $this->session->userdata('id_user');
		$data['username'] = $this->session->userdata('username');
		$data['profile'] = $this->m_siplabs->getwhere('user', array('id_user' => $id_user))->result();
		$this->load->view('templates/header', $data);
		$this->load->view('admin/myprofile', $data);
		$this->load->view('templates/footer');
	}

	public function editprofil()
	{
		$id_user = $this->input->post('id_user');
		$username = $this->input->post('username');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$bio = $this->input->post('bio');
		$no_telp = $this->input->post('no_telp');
		$nip = $this->input->post('nip');
		$uploaded = $_FILES['image']['name'];
		$imagetype = end(explode('.', $uploaded));
		$image = uniqid() . '.' . $imagetype;

		$cekusername = $this->db->get_where('user', ['id_user' != $id_user])->row_array();
		if ($cekusername['username'] != $username) {
			if (!empty($uploaded)) {
				$config['upload_path'] = './files/userprofil/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']  = '500';
				$config['file_name'] = $image;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('image')) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('admin/myprofile/' . $id_user);
				} else {
					$userdata = $this->db->get_where('user', ['id_user' => $id_user])->row_array();
					if (!empty($userdata['image'])) {
						$path = 'files/userprofil/' . $userdata['image'];
						unlink($path);
					}

					$array = [
						'username' => $username,
						'nama_lengkap' => $nama_lengkap,
						'bio' => $bio,
						'nip' => $nip,
						'no_telp' => $no_telp,
						'image' => $image
					];
					$this->upload->do_upload($image);
					$this->db->update('user', $array, ['id_user' => $id_user]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses</div>');
					redirect('admin/myprofile/' . $id_user);
				}
			} else {
				$array = [
					'username' => $username,
					'nama_lengkap' => $nama_lengkap,
					'bio' => $bio,
					'nip' => $nip,
					'no_telp' => $no_telp
				];
				$this->db->update('user', $array, ['id_user' => $id_user]);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses</div>');
				redirect('admin/myprofile/' . $id_user);
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username sudah ada!</div>');
			redirect('admin/myprofile/' . $id_user);
		}
	}

	public function aksigantipass()
	{
		$id_user = $this->input->post('id_user');
		$password_lama = $this->input->post('password_lama');
		$password_baru = $this->input->post('password_baru');
		$password_baru2 = sha1($password_baru);

		$cekpassword = $this->db->get_where('user', ['id_user' => $id_user])->row_array();
		if ($cekpassword['password'] != sha1($password_lama)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
			redirect('admin/myprofile/' . $id_user);
		} else {
			$this->db->update('user', ['password' => $password_baru2], ['id_user' => $id_user]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses!</div>');
			redirect('admin/myprofile/' . $id_user);
		}
	}

	// SITE SETTINGS
	public function sitesetting()
	{
		$data['root'] = "Pengaturan";
		$data['title'] = "Pengaturan situs";
		$data['user'] = $this->session->userdata('id_user');
		$data['username'] = $this->session->userdata('username');
		$data['site'] = $this->db->get('site')->result();
		$data['ruangan'] = $this->db->get('ruangan')->result();
		$this->load->view('templates/header', $data);
		$this->load->view('admin/site', $data);
		$this->load->view('templates/footer');
	}

	public function editsite()
	{
		$id_site = $this->input->post('id_site');
		$title = $this->input->post('title');

		// $logoexp = explode('.', $_FILES['logo']['name']);
		// $logotype = end($logoexp);
		// $logo = uniqid().'.'.$logotype;

		// $iconexp = explode('.', $_FILES['icon']['name']);
		// $icontype = end($iconexp);
		// $icon = uniqid().'.'.$icontype;

		$ceksite = $this->db->get_where('site', ['id_site' => $id_site])->row_array();

		$config['upload_path'] = './files/site/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_ext_tolower'] = TRUE;
		$config['remove_space'] = TRUE;
		$config['file_name'] = uniqid();

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('logo')) {
			$logo = ['file_name' => $ceksite['logo']];
		} else {
			if (null !== $ceksite['logo']) {
				$path = 'files/site/' . $ceksite['logo'];
				unlink($path);
			}
			$logo = $this->upload->data();
		}

		if (!$this->upload->do_upload('icon')) {
			$icon = ['file_name' => $ceksite['icon']];
		} else {
			if (null !== $ceksite['icon']) {
				$path = 'files/site/' . $ceksite['icon'];
				unlink($path);
			}
			$icon = $this->upload->data();
		}

		$array = [
			'title' => $title,
			'logo' => $logo['file_name'],
			'icon' => $icon['file_name']
		];

		$this->upload->do_upload();
		$this->db->update('site', $array, ['id_site' => $id_site]);
		redirect('admin/sitesetting', 'refresh');
	}

	public function ubahruangan()
	{
		$id_ruangan = $this->input->post('id_ruangan');
		$kode_ruangan = $this->input->post('kode_ruangan');
		$nama_ruangan = $this->input->post('nama_ruangan');

		$config['upload_path'] = 'files/site/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name'] = uniqid();

		$this->load->library('upload', $config);
		$thisruangan = $this->db->get_where('ruangan', ['id_ruangan' => $id_ruangan])->row_array();

		$cekkoderuangan = $this->db->query("select * from ruangan where kode_ruangan='$kode_ruangan' AND id_ruangan!=$id_ruangan")->row_array();
		if ($cekkoderuangan) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kode ruangan sudah ada!</div>');
			redirect('admin/sitesetting');
		} else {
			if (!$this->upload->do_upload('gambar')) {
				$gambar = ['file_name' => $thisruangan['image']];
			} else {
				if (null !== ($thisruangan['image'])) {
					$path = 'files/site/' . $thisruangan['image'];
					unlink($path);
				}
				$gambar = $this->upload->data();
			}

			$array = [
				'kode_ruangan' => $kode_ruangan,
				'nama_ruangan' => $nama_ruangan,
				'image' => $gambar['file_name']
			];

			$this->upload->do_upload();
			$this->db->update('ruangan', $array, ['id_ruangan' => $id_ruangan]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Ruangan diubah!</div>');
			redirect('admin/sitesetting');
		}
	}
}
