<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="index.php" class="navbar-brand">

        <span class="brand-text font-weight-light">Siplabs</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?php echo base_url('peminjam') ?>" class="nav-link">Beranda</a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('peminjam/jadwal') ?>" class="nav-link">Jadwal</a>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <a href="#" data-toggle="modal" data-target="#logout" class="btn btn-danger btn-flat"><i class="fas fa-power-off"></i>&nbsp;&nbsp;Keluar</a>
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
            <h1 class="m-0 text-dark"> Jadwal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Jadwal</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Tabel Jadwal</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body text-center">
                <div class="table-responsive">
                  <table id="tabel" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>User</th>
                        <th>Ruangan</th>
                        <th>Jam Mulai</th>
                        <th>Jam Berakhir</th>
                        <th>Tanggal</th>
                        <th>Keterangan Peminjaman</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <?php $no = 1; ?>
                    <?php foreach ($jadwal as $q) : ?>
                      <?php if ($id_user == $q->id_user) { ?>
                        <tbody>
                          <tr>
                            <td><strong><?php echo $no++; ?></strong></td>
                            <td><strong><?php echo $q->username; ?></strong></td>
                            <td><strong><?php echo $q->nama_ruangan; ?></strong></td>
                            <td><strong><?php echo substr($q->jam_mulai, 0, 5); ?></strong></td>
                            <td><strong><?php echo substr($q->jam_berakhir, 0, 5); ?></strong></td>
                            <td><strong><?php $date = date_create($q->tanggal);
                            echo date_format($date, 'd - m - Y'); ?></strong></td>
                            <td><strong><?php echo $q->keterangan; ?></strong></td>
                            <td>
                              <strong>
                                <?php 
                                switch ($q->status_jadwal) {
                                  case 1:
                                  echo "<span class='text-success text-bold'>Sedang berlangsung...</span>";
                                  break;
                                  case 2:
                                  echo "<span class='text-primary text-bold'>Akan datang...</span>";
                                  break;
                                  case 3:
                                  echo "<span class='text-danger text-bold'>Sudah lewat, harap hapus jadwal ini..</span>";
                                  default:
                                                # code...
                                  break;
                                }
                                ?>
                              </strong>
                            </td>
                            <td>
                              <?php if($q->status_jadwal==1){ echo "<span class=text-red>Jadwal tidak bisa dibatalkan</span>"; }else{ ?>
                                <a href="<?php echo base_url('peminjam/batalpinjam/'.$id_user) ?>" class="badge badge-danger" onclick="return confirm('Batalkan jadwal?')">Batalkan</a>
                              <?php } ?>
                            </td>
                          </tr>
                        </tbody>
                      <?php } else { ?>
                        <tbody>
                          <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $q->username; ?></td>
                            <td><?php echo $q->nama_ruangan; ?></td>
                            <td><?php echo substr($q->jam_mulai, 0, 5); ?></td>
                            <td><?php echo substr($q->jam_berakhir, 0, 5); ?></td>
                            <td><?php $date = date_create($q->tanggal);
                            echo date_format($date, 'd - m - Y'); ?></td>
                            <td><?php echo $q->keterangan; ?></td>
                            <td>
                              <strong>
                                <?php 
                                switch ($q->status_jadwal) {
                                  case 1:
                                  echo "<span class='text-success text-bold'>Sedang berlangsung...</span>";
                                  break;
                                  case 2:
                                  echo "<span class='text-primary text-bold'>Akan datang...</span>";
                                  break;
                                  case 3:
                                  echo "<span class='text-danger text-bold'>Sudah lewat, harap hapus jadwal ini..</span>";
                                  default:
                                                # code...
                                  break;
                                }
                                ?>
                              </strong>
                            </tr>
                          </tbody>
                        <?php } ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <span class="text-info p-2">* teks tebal merupakan jadwal anda</span><br>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="<?php echo base_url() ?>">Siplabs Smanda</a>.</strong>
  </footer>
</div>