<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $title; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="content">
      <div class="container">
       
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12"><br></div>
              <div class="col-md-6">
                <table class="table table-hover table-striped table-responsive" id="tabel">
                  <h4>BANTUAN</h4>
                  <thead>
                    <tr>
                      <th>JUDUL</th>
                      <th>ISI</th>
                      <th class="col-sm-2">AKSI</th>
                    </tr>
                  </thead>
                  <tbody id="tabelhelpadmin">
                    <?php
                    foreach ($help as $h) :
                    ?>
                      <tr>
                        <td><b><?php echo $h->judul ?></b></td>
                        <td><?php echo $h->isi ?></td>
                        <td>
                          <a href="#" data-toggle="modal" data-target="#edithelp" data-id_help="<?php echo $h->id_help ?>" data-judul_help="<?php echo $h->judul ?>" data-isi_help="<?php echo $h->isi ?>" class="badge badge-primary">edit</a>
                          <a href="<?php echo base_url('admin/hapushelp/' . $h->id_help) ?>" onclick="return confirm('Hapus?')" data-id="<?php echo $h->id_help ?>" class="badge badge-danger">hapus</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <div class="col-md-6">
                <table class="table table-hover table-striped table-responsive" id="tabel2">
                  <h4>PERTANYAAN</h4>
                  <thead>
                    <tr>
                      <th>PENANYA</th>
                      <th>JUDUL</th>
                      <th>ISI</th>
                      <th class="col-sm-2">AKSI</th>
                    </tr>
                  </thead>
                  <tbody id="tabelhelpadmin">
                    <?php
                    foreach ($ask as $a) :
                    ?>
                      <tr>
                        <td><b><?php echo $a->nama_asker ?></b></td>
                        <td><b><?php echo $a->judul_ask ?></b></td>
                        <td><?php echo $a->isi_ask ?></td>
                        <td>
                          <a href="#" data-toggle="modal" data-target="#jawabask" data-id_ask="<?php echo $a->id_ask ?>" data-judul_ask="<?php echo $a->judul_ask ?>" data-isi_ask="<?php echo $a->isi_ask ?>" class="badge badge-primary">jawab</a>
                          <a href="<?php echo base_url('admin/hapusask/' . $a->id_ask) ?>" onclick="return confirm('Hapus?')" data-id="<?php echo $a->id_ask ?>" class="badge badge-danger">hapus</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>