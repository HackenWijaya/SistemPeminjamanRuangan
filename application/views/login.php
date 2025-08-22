<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $title; ?>
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet"
    href="<?php echo base_url('assets/') ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:300,400,400i,700&display=swap" rel="stylesheet">

  <script src="https://accounts.google.com/gsi/client"></script>

  <script>
    function handleCredentialResponse(response) {
      fetch('auth/authorization', {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ request_type: 'user_auth', credential: response.credential })
      })
        .then(response => response.json())
        .then(data => {
          if (data.status == 1) {
            window.location.replace('http://localhost/peminjaman-ruang/admin');
          }else if (data.status == 2) {
            window.location.replace('http://localhost/peminjaman-ruang/peminjam')
          }
        })
    }
  </script>

</head>
<style>
  #g {


    background-image: url('files/site/PCR.jpeg');

    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
  }

  .logo h3 {

    font-size: 28px;
    font-weight: bold;
    color: white;
  }
</style>

<body class="hold-transition login-page" id="g">
  <?php $this->load->view('ekstra/modal') ?>
  <div class="login-box  ">
    <!-- /.login-logo -->

    <div class="card-body login-card-body"
      style="border-radius: 10px; background-size: cover; background-color: rgba(0, 0, 0 , 0.4);">
      <?php $site = $this->db->get('site')->result(); ?>

      <div class="logo text-center">
        <h3>Login</h3>
        <br>

      </div>

      <span class="text-red" id="message"></span>
      <div id="g_id_onload" data-client_id="376175635050-2j52vjed9d9nmhasm7ca5brsuapv495s.apps.googleusercontent.com"
        data-context="signin" data-ux_mode="popup" data-callback="handleCredentialResponse" data-auto_prompt="false">
      </div>

      <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline"
        data-text="signin_with" data-size="large" data-logo_alignment="left">
      </div>

    </div>
    <!-- /.login-card-body -->
  </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->


  </script>
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
  <script src="<?= base_url('assets/') ?>dist/js/user.js"></script>
  </script>

</body>

</html>