<?php
$query = "SELECT * FROM user WHERE status=0 ORDER BY level";
$datauser = $this->db->query($query)->result();
?>
<div class="content-wrapper">
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
    <div class="container mt-3">
        <div class="card">
            <div class="card-header text-center">
                <h2>Pendaftar Baru</h2>
            </div>
            <div class="card-body">
               
                <div class="table-responsive">
                    <table id="tabel" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>NIP/NIS</th>
                                <th>No. Telepon</th>
                                <th class="col-xs-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($datauser as $u) : ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $u->nama_lengkap; ?></td>
                                    <td><?php echo $u->username; ?></td>
                                    <td><?php echo $u->nip; ?></td>
                                    <td><?php echo ($u->no_telp) ? $u->no_telp : '-'; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/accuser/' . $u->id_user) ?>" onclick="return confirm('Terima user?')" class="badge badge-primary">Terima User</a>
                                        <a href="<?php echo base_url('admin/disaccuser/' . $u->id_user) ?>" onclick="return confirm('Tolak user?')" class="badge badge-danger">Tolak User</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>