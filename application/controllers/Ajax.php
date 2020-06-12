<?php

class Ajax extends CI_Controller
{
    // PUBLIK
    // cari help
    public function carihelp()
    {
        $keyword = $this->input->post('keyword');
        $data['hasil'] = $this->db->query("SELECT * FROM help WHERE judul LIKE '%$keyword%'")->result();
        $this->load->view('ajax/carihelp', $data);
    }

    public function carihelpadmin()
    {
        $keyword = $this->input->post('keyword');
        $data['hasil'] = $this->db->query("SELECT * FROM help WHERE judul LIKE '%$keyword%'")->result();
        $this->load->view('ajax/carihelpadmin', $data);
    }

    public function editprofil()
    {
        $id_user = $this->input->post('id_user');
        if (null !== $id_user) {
            $data['profil'] = $this->db->get_where('user', array('id_user' => $id_user))->result();
            $this->load->view('ajax/editprofil', $data);
            // echo $dataprofil['username'];
        }
    }

    public function ubahsitus()
    {
        $id_site = $this->input->post('id_site');

        $data['site'] = $this->db->get_where('site', ['id_site' => $id_site])->result();

        $this->load->view('ajax/ubahsitus', $data);
    }

    public function ubahruangan()
    {
        $id_ruangan = $this->input->post('id_ruangan');

        $data['ruangan'] = $this->db->get_where('ruangan', ['id_ruangan' => $id_ruangan])->result();

        $this->load->view('ajax/ubahruangan', $data);
    }

    public function ajaxcekkoderuangan()
    {
        $kode_ruangan = $this->input->post('kode_ruangan');
        $id_ruangan = $this->input->post('id_ruangan');
        $cekkoderuangan = $this->db->query("select * from ruangan where kode_ruangan='$kode_ruangan' AND id_ruangan!=$id_ruangan")->row_array();
        if ($cekkoderuangan) {
            echo "Kode ruangan ini sudah ada!";
        } else {
            echo "";
        }
    }

    public function livekotakpertanyaan()
    {
        $this->load->view('ajax/livekotakpertanyaan');
    }

    // MENDAFTAR
    // cek username
    public function cekusernamedaftar($username)
    {
        $cekusernamedaftar = $this->db->get_where('user', array('username' => $username))->row_array();
        if ($cekusernamedaftar) {
            echo 'Username sudah ada!';
        } else {
            echo "";
        }
    }

    // cek nip
    public function ceknip()
    {
        $nip = $this->input->post('nip');
        $ceknip = $this->db->get_where('user', ['nip' => $nip])->row_array();
        if ($ceknip) {
            echo 'Nip sudah terdaftar!';
        } else {
            echo "";
        }
    }

    // PEMINJAMAN
    // validasi tanggal
    public function ajaxverifyreqdate()
    {
        $tanggal = $this->input->post('tanggal');
        $jam_mulai = $this->input->post('jam_mulai');
        $jam_selesai = $this->input->post('jam_selesai');

        $nowtime = new DateTime(date('H:i'));
        $nowtime = $nowtime->format('H:i');

        $nowdate = new DateTime(date('Y-m-d'));
        $nowdate = $nowdate->format('Y-m-d');

        $timeinput = strtotime($tanggal) + strtotime($jam_mulai);
        $timenow = strtotime($nowdate) + strtotime($nowtime);

        $limitdate = new DateTime(date('Y-m-d'));
        $limitdate->modify('+4 day');
        $limitdate = $limitdate->format('Y-m-d');

        if ($jam_mulai > $jam_selesai) {
            echo "Waktu tidak valid";
        } elseif ($timeinput < $timenow) {
            echo "Waktu tidak valid";
        } elseif ($tanggal > $limitdate) {
            echo "Peminjaman hanya untuk 3 hari kedepan";
        }
    }

    // FILTER BULAN
    public function filter_bulan()
    {
        if ($this->input->post('bulan') != null) {
            $bulan = $this->input->post('bulan');
            $data['jadwal'] = $this->db->query("SELECT * FROM jadwal INNER JOIN peminjaman, ruangan, user 
                WHERE jadwal.id_peminjaman=peminjaman.id_peminjaman 
                AND peminjaman.id_ruangan=ruangan.id_ruangan
                AND peminjaman.id_user=user.id_user
                AND peminjaman.status_peminjaman!=0
                AND month(tanggal) = '$bulan'")->result();
            $this->load->view('ajax/filterjadwal', $data);
        } else {
            $data['jadwal'] = $this->db->query("SELECT * FROM jadwal INNER JOIN peminjaman, ruangan, user 
                WHERE jadwal.id_peminjaman=peminjaman.id_peminjaman 
                AND peminjaman.id_ruangan=ruangan.id_ruangan
                AND peminjaman.id_user=user.id_user
                AND peminjaman.status_peminjaman!=0")->result();
            $this->load->view('ajax/filterjadwal', $data);
        }
    }

    public function filter_tanggal()
    {
        if ($this->input->post('tanggal') != NULL) {
            $tanggal = $this->input->post('tanggal');
            $data['jadwal'] = $this->db->query("SELECT * FROM jadwal INNER JOIN peminjaman, ruangan, user 
                WHERE jadwal.id_peminjaman=peminjaman.id_peminjaman 
                AND peminjaman.id_ruangan=ruangan.id_ruangan
                AND peminjaman.id_user=user.id_user
                AND peminjaman.status_peminjaman!=0
                AND tanggal = '$tanggal'")->result();
            $this->load->view('ajax/filterjadwal', $data);
        } else {
            $data['jadwal'] = $this->db->query("SELECT * FROM jadwal INNER JOIN peminjaman, ruangan, user 
                WHERE jadwal.id_peminjaman=peminjaman.id_peminjaman 
                AND peminjaman.id_ruangan=ruangan.id_ruangan
                AND peminjaman.id_user=user.id_user
                AND peminjaman.status_peminjaman!=0")->result();
            $this->load->view('ajax/filterjadwal', $data);
        }
    }

    public function filter_range_tanggal()
    {
        if ($this->input->post('tanggal2') != null) {
            $tanggal1 = $this->input->post('tanggal1');
            $tanggal2 = $this->input->post('tanggal2');
            $data['jadwal'] = $this->db->query("SELECT * FROM jadwal INNER JOIN peminjaman, ruangan, user 
                WHERE jadwal.id_peminjaman=peminjaman.id_peminjaman 
                AND peminjaman.id_ruangan=ruangan.id_ruangan
                AND peminjaman.id_user=user.id_user
                AND peminjaman.status_peminjaman!=0
                AND tanggal BETWEEN '$tanggal1' AND '$tanggal2'")->result();
            $this->load->view('ajax/filterjadwal', $data);
        } else {
            $data['jadwal'] = $this->db->query("SELECT * FROM jadwal INNER JOIN peminjaman, ruangan, user 
                WHERE jadwal.id_peminjaman=peminjaman.id_peminjaman 
                AND peminjaman.id_ruangan=ruangan.id_ruangan
                AND peminjaman.id_user=user.id_user
                AND peminjaman.status_peminjaman!=0")->result();
            $this->load->view('ajax/filterjadwal', $data);
        }
    }
}
