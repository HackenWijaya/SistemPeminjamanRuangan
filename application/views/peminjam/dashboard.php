<!-- reset jadwal -->
<?php
$jadwal = $this->db->query("SELECT * FROM jadwal INNER JOIN peminjaman on jadwal.id_peminjaman=peminjaman.id_peminjaman INNER JOIN user on peminjaman.id_user=user.id_user INNER JOIN ruangan on peminjaman.id_ruangan = ruangan.id_ruangan AND status_jadwal!=3")->result();
foreach ($jadwal as $q):
  // atur jadwal
  $nowtime = strtotime(date('H:i:s')) + strtotime(date('Y-m-d'));
  $dbstart = strtotime($q->jam_mulai) + strtotime($q->tanggal);
  $dbend = strtotime($q->jam_berakhir) + strtotime($q->tanggal);
  $id_jadwal = $q->id_jadwal;
  if ($dbend < $nowtime) {
    $this->db->update('ruangan', ['status_ruangan' => 'Nganggur'], ['id_ruangan' => $q->id_ruangan]);
    $this->db->update('jadwal', ['status_jadwal' => 3], ['id_jadwal' => $id_jadwal]);
  } elseif ($nowtime >= $dbstart and $nowtime <= $dbend) {
    $this->db->update('ruangan', ['status_ruangan' => 'Dipakai'], ['id_ruangan' => $q->id_ruangan]);
    $this->db->update('jadwal', ['status_jadwal' => 1], ['id_jadwal' => $id_jadwal]);
  }
endforeach;
?>
<div class="wrapper">

  <!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light bg-info navbar-white">
  <div class="container">
    <a href="index.php" class="navbar-brand">
      <span class="brand-text font-weight-light text-white">Peminjaman Ruangan</span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="<?php echo base_url('peminjam') ?>" class="nav-link text-white">Beranda</a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('peminjam/jadwal') ?>" class="nav-link text-white">Jadwal</a>
        </li>
      </ul>
    </div>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <li class="nav-item">
        <a href="#" data-toggle="modal" data-target="#logout" class="btn btn-danger btn-sm">
          <i class="fas fa-power-off"></i>&nbsp;&nbsp;Keluar
        </a>
      </li>
    </ul>
  </div>
</nav>
<!-- /.navbar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ruangan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <?php echo $this->session->flashdata('message'); ?>
        <div class="row">
          <?php foreach ($ruangan as $r): ?>
            <div class="col-md-4">
              <div class="card card-success">
                <div class="card-header">
                  <!-- menampilkan nama ruangan pada card -->
                  <h3 class="card-title">
                    <?php echo $r->nama_ruangan; ?>
                  </h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body text-center">
                  <img src="<?= base_url('files/site/' . $r->image) ?>" width="200"><br><br>

                  <?php
                  $cek_user = $this->db->query('SELECT * FROM peminjaman INNER JOIN ruangan on peminjaman.id_ruangan=ruangan.id_ruangan WHERE peminjaman.id_user=' . $user . ' AND ruangan.id_ruangan=' . $r->id_ruangan . ' AND status_peminjaman=0')->row_array();
                  if ($cek_user) {
                    ?>

                    <button class="btn btn-info" data-toggle="modal" data-target="#pinjam" disabled="">Menunggu
                      konfirmasi</button>
                    <a href="<?= base_url('peminjam/batalpinjam/' . $user . '/' . $r->id_ruangan) ?>" class="btn btn-danger"
                      onclick="return confirm('Batalkan peminjaman?')" title="Batalkan peminjaman"><i
                        class="fas fa-times"></i></a>

                  <?php } else {
                    $cek_tersedia = $this->db->query('SELECT * FROM jadwal INNER JOIN peminjaman, ruangan WHERE jadwal.id_peminjaman=peminjaman.id_peminjaman AND peminjaman.id_ruangan=ruangan.id_ruangan AND jadwal.status_jadwal=1 AND ruangan.id_ruangan=' . $r->id_ruangan)->result();
                    ?>
                    <?php if ($cek_tersedia) { ?>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#pinjam" disabled>Sedang
                        dipinjam</button>
                      <br>
                      <?php
                      foreach ($cek_tersedia as $row):
                        echo substr($row->jam_mulai, 0, 5); ?> -
                        <?= substr($row->jam_berakhir, 0, 5); ?>,
                        <?php $date = date_create($row->tanggal);
                        echo date_format($date, 'd/m/Y');
                      endforeach; ?>
                    <?php } else { ?>
                      <button class="btn btn-primary" data-id_ruangan="<?= $r->id_ruangan ?>" data-toggle="modal"
                        data-target="#pinjam">Pinjam</button>
                    <?php } ?>
                  <?php } ?>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- modal pinjam ruangan -->

              <!-- /.card -->
            </div>
          <?php endforeach; ?>

          <!-- FITUR BOOKING -->

          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
  </div>
  <!-- ./wrapper -->