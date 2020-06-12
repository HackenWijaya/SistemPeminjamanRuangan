<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Peminjaman Lab | <?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page" style="background: url('<?php echo base_url('assets/') ?>dist/img/bg.jpg');">
  <?php $this->load->view('ekstra/modal') ?>
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <?php $site = $this->db->get('site')->result(); ?>
        <center><img src="<?php echo base_url('files/site/'.$site[0]->logo) ?>" width="125"></center>
        <div class="logo text-center">
          <h3><?php echo $site[0]->title ?></h3>
        </div>

        <span class="text-red" id="message"></span>
        <form action="<?php echo base_url('auth') ?>" method="post" autocomplete="off">
          <?php echo $this->session->flashdata('message'); ?>
          <div class="input-group mb-3">
            <input type="text" id="username" name="username" class="form-control" value="<?php echo set_value('username'); ?>" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <?php echo form_error('username'); ?>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12 text-center">
              <button type="submit" name="masuk" class="btn btn-primary btn-block btn-flat">Masuk</button>
              <a href="#" data-toggle="modal" data-target="#mendaftar" class="btn btn-success btn-block btn-flat">Mendaftar</a>
              <a href="<?php echo base_url('publik') ?>" class="badge text-lg">Menu Bantuan</a>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
  
  <!-- jQuery -->
  <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="<?= base_url('assets/') ?>plugins/toastr/toastr.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url('assets/') ?>dist/js/demo.js"></script>

  <!-- user -->
  <script src="<?= base_url('assets/') ?>dist/js/user.js"></script></script>

</body>

</html>