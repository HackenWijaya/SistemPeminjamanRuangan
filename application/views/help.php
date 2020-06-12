  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="<?php echo base_url(); ?>" class="navbar-brand">
        <?php foreach($site as $s): ?>
          <img src="<?php echo base_url('files/site/'.$s->logo) ?>" height="20" style="vertical-align: center">
          <span class="brand-text font-weight-light" style="vertical-align: center"><?php echo $s->title; ?></span>
        <?php endforeach; ?>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
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
            <h1 class="m-0 text-dark"> Bantuan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('auth') ?>">Login</a></li>
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
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md">
                <button class="btn btn-primary" data-toggle="modal" data-target="#pertanyaan"><i class="fas fa-question"></i> Ajukan pertanyaan</button>
              </div>
              <div class="col-md">
               <input type="text" class="form-control" name="carihelp" id="carihelp" placeholder="Cari bantuan...">
             </div>
             <div class="col-md-12">
              <table class="table table-hover table-striped tabelhelppublik" id="tabelhelppublik">
                <?php foreach($help as $h): ?>
                  <tbody>
                    <tr>
                      <td><b><?php echo $h->judul ?></b></td>
                    </tr>
                    <tr>
                      <td><?php echo $h->isi ?></td>
                    </tr>
                  </tbody>
                  <br>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
</div>