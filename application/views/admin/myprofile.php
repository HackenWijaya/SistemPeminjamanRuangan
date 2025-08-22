< <div class="content-wrapper">
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
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-body">
                    
                    <br>
                    <div class="row">
                        <div class="col-lg">
                            <div class="well well-sm">
                                <div class="row">
                                    <?php foreach ($profile as $p) : ?>
                                        <div class="col-md-3">
                                            <img src="<?php echo base_url('files/userprofil/' . $p->image) ?>" alt="User profil" height="200" class="img-rounded img-responsive" />
                                        </div>
                                        <div class="col-md-9">
                                            <h4><?= $p->nama_lengkap ?></h4>
                                            <hr>
                                            <p>
                                                <span id="bio">Bio : <?php if ($p->bio == null) {
                                                    echo '-';
                                                } else {
                                                    echo $p->bio;
                                                } ?></span>
                                            </p>
                                            <hr>
                                            <p>
                                                <span>No. WA : <?php if(isset($p->no_telp)){ echo '0'.$p->no_telp; }else{ } ?></span>
                                            </p>
                                            <div class="editprofil">
                                                <a href="#" data-id_user="<?= $p->id_user ?>" data-toggle="modal" data-target="#editprofiladmin" class="btn btn-primary btn-flat"><i class="fas fa-edit"></i> Edit profil</a>
                                                <a href="#" data-id_user="<?= $p->id_user ?>" data-toggle="modal" data-target="#gantipassword" class="btn btn-primary btn-flat"><i class="fas fa-key"></i> Ganti password</a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>