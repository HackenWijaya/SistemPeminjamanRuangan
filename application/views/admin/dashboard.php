<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $title; ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"><?= $title; ?></a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <div class="container-fluid">
    <div class="header">
      <h1 class="text-center mt-3"><?php $nama_situs = $this->db->get('site')->result();
                                    echo $nama_situs[0]->title ?></h1>
      <h3 class="text-center">Selamat Datang, <?php echo $this->session->nama_lengkap; ?></h3>
    </div>
    <div class="card card-primary m-5">
      <?php echo $this->session->flashdata('message'); ?>
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Quick View</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <?php
                $query = "SELECT count(*) as total FROM user WHERE status=0";
                $result = $this->db->query($query)->result();
                foreach ($result as $q) : ?>
                  <h3><?php echo $q->total; ?></h3>
                <?php endforeach; ?>
                <p>Pendaftar baru</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="<?php echo base_url('admin/newuser') ?>" class="small-box-footer">Selebihnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <?php
                $query = "SELECT count(*) as total FROM peminjaman WHERE status_peminjaman=0";
                $result = $this->db->query($query)->result();
                foreach ($result as $q) : ?>
                  <h3><?php echo $q->total; ?></h3>
                <?php endforeach; ?>
                <p>Request Peminjaman</p>
              </div>
              <div class="icon">
                <i class="fas fa-bookmark"></i>
              </div>
              <a href="<?php echo base_url('admin/request') ?>" class="small-box-footer">Selebihnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                $query = "SELECT count(*) as total FROM jadwal INNER JOIN peminjaman WHERE jadwal.id_peminjaman=peminjaman.id_peminjaman";
                $result = $this->db->query($query)->result();
                foreach ($result as $q) : ?>
                  <h3><?php echo $q->total; ?></h3>
                <?php endforeach; ?>
                <p>Jadwal</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar"></i>
              </div>
              <a href="<?php echo base_url('admin/jadwal') ?>" class="small-box-footer">Selebihnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div>
    </div>
  </div>
</div>