<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?= $root; ?></a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
      
                <div class="callout callout-info">
                    <?php foreach($site as $s): ?>
                        <table class="table col-sm-6">
                            <tbody>
                                <tr>
                                    <td style="vertical-align: middle;" rowspan="4" ><img src="<?php echo base_url('files/site/'.$s->logo) ?>" width="100" class="image-responsive" alt="Logo"></td>
                                </tr>
                                <tr>
                                    <th>JUDUL</th>
                                    <td>:</td>
                                    <td><?php echo $s->title ?>
                                </td>
                            </tr>
                            <tr>
                                <th>LOGO</th>
                                <td>:</td>
                                <td><?php echo $s->logo ?> </td>
                            </tr>
                            <tr>
                                <th>ICON</th>
                                <td>:</td>
                                <td><?php echo $s->icon ?></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <a href="javascript:;" data-toggle="modal" data-id_site="<?php echo $s->id_site ?>" data-target="#ubahsitus"><span class="btn btn-primary">Ubah</span></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="container">
                <div class="row">
                    <?php foreach($ruangan as $r): ?>
                        <div class="col-md">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo $r->nama_ruangan; ?></h3>
                                </div>
                                <div class="card-body">
                                    <div class="image text-center">
                                        <img src="<?= base_url('files/site/'.$r->image) ?>" width="120">
                                    </div>
                                    <table class="table">
                                        <tbody>
                                            <tr> 
                                                <th>Kode</th>
                                                <td>:</td>
                                                <td><?php echo $r->kode_ruangan ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama</th>
                                                <td>:</td>
                                                <td><?php echo $r->nama_ruangan ?></td>
                                            </tr>
                                            <tr>
                                                <th>Gambar</th>
                                                <td>:</td>
                                                <td><?php echo $r->image ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-center">
                                                    <a href="#" data-toggle="modal" data-target="#ubahruangan" data-id_ruangan="<?php echo $r->id_ruangan ?>" class="btn btn-primary">Ubah</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- modal pinjam ruangan -->

    <!-- /.card -->
</div>
</div>
<!-- /.card-body -->
</div>
</div>
</div>
</div>
</div>

</div>
</section>
<!-- /.content -->
</div>