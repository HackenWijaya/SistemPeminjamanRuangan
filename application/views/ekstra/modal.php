<!-- MODAL PUBLIK -->
<!-- PERTANYAAN -->
<div class="modal fade" id="pertanyaan">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form role="form" action="<?= base_url('publik/pertanyaan') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Ajukan pertanyaan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="nama_asker" id="" class="form-control" placeholder="Sebutkan nama anda" required aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" id="judulpertanyaan" name="judul" required class="form-control" placeholder="Sebutkan judul">
                        </div>
                        <div class="form-group">
                            <label for="">Isi pertanyaan</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsipertanyaan" rows="5" placeholder="Deskripsi, ulasan rinci mengenai pertanyaan"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="tambah" class="btn btn-primary pinjam">Pinjam</button>
                </div>
            </form>
        </div>
        <!-- modal pinjam ruangan -->
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- ADMIN HELP -->
<div class="modal fade" id="edithelp">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form role="form" action="<?= base_url('admin/edithelp') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Edit bantuan ini</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <input type="hidden" id="id_help" name="id_help">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" id="judul_help" name="judul" class="form-control" placeholder="Sebutkan judul">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="isi_help" rows="5" placeholder="Deskripsi, ulasan rinci mengenai pertanyaan"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="tambah" class="btn btn-primary help">Ubah</button>
                </div>
            </form>
        </div>
        <!-- modal pinjam ruangan -->
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- ADMIN EDIT PROFIL -->
<!-- MODAL LOGOUT -->

<div class="modal fade" id="editprofiladmin">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="ajaxeditprofil"></div>
        </div>
    </div>
</div>

<!-- ADMIN EDIT SITUS -->
<div class="modal fade" id="ubahsitus">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div id="ajaxubahsitus"></div>
        </div>
    </div>
</div>

<!-- UBAH RUANGAN -->
<div class="modal fade" id="ubahruangan">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div id="ajaxubahruangan"></div>
        </div>
    </div>
</div>



<div class="modal fade" id="gantipassword">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/aksigantipass') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_user" name="id_user" value="<?php echo $this->session->userdata('id_user') ?>">
                    <div class="form-group">
                        <label for="">Password lama</label>
                        <div class="input-group">
                            <input type="password" id="password_lama" name="password_lama" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Password baru</label>
                        <div class="input-group">
                            <input type="password" id="password_baru" name="password_baru" class="form-control" required>
                        </div>
                        <span class="text-danger" id="password_baru_message"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Konfirmasi password baru</label>
                        <div class="input-group">
                            <input type="password" id="password_baru2" name="password_baru2" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="btnubahpassword" name="ubah" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JAWAB PERTANYAAN -->
<div class="modal fade" id="jawabask">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form role="form" action="<?= base_url('admin/jawabask') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Jawab pertanyaan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <input type="hidden" name="id_ask" id="id_ask">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul_ask" id="judul_ask" class="form-control" placeholder="Sebutkan judul">
                        </div>
                        <div class="form-group">
                            <label>Isi</label>
                            <textarea class="form-control" name="isi_ask" id="isi_ask" rows="5"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Jawab</button>
                </div>
            </form>
        </div>
        <!-- modal pinjam ruangan -->
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- MODAL PEMINJAM -->
<!-- MODAL MENDAFTAR -->
<div class="modal fade" id="mendaftar">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="<?php echo base_url('auth/mendaftar') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Daftar Akun baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display: none" role="alert" id="alertdaftar"></div>
                    <span id="alertusername"></span>
                    <div class="input-group mb-3">
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="usernamedaftar" name="username" class="form-control usernamedaftar" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password2" id="password2" class="form-control" placeholder="Konfirmasi Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="nip" name="nip" class="form-control" onkeypress="return isNumberKey(event)" onkeyup="return ceknip()" placeholder="NIP/NIS">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-sort-numeric-up-alt"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="daftar" name="daftar" class="btn btn-primary btn-block btn-flat">Daftar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL PINJAM -->
<div class="modal fade" id="pinjam">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form role="form" action="<?= base_url('peminjam/pinjam') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Pinjam ruangan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <input type="hidden" id="pinjam_id_user" name="id_user" value="<?php if (isset($user)) {
                                                                                            echo $user;
                                                                                        } ?>">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" id="pinjam_username" name="username" readonly class="form-control" value="<?php if (isset($username)) {
                                                                                                                                echo $username;
                                                                                                                            } ?>" required="">
                        </div>
                        <div class="form-group">
                            <label>Ruangan</label>
                            <select id="id_ruangan" name="id_ruangan" class="form-control">
                                <?php
                                $ruangan2 = $this->m_siplabs->get_datawithadd('ruangan', 'where status_ruangan="Nganggur"')->result();
                                foreach ($ruangan2 as $r2) : ?>
                                    <option value="<?php echo $r2->id_ruangan ?>"><?php echo $r2->kode_ruangan ?> - <?php echo $r2->nama_ruangan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jam Mulai</label>
                            <input type="time" id="pinjam_jam_mulai" name="jam_mulai" class="form-control verifydate" value="<?php echo date('H:i') ?>">
                        </div>
                        <div class="form-group">
                            <label>Jam Selesai</label>
                            <input type="time" id="pinjam_jam_selesai" name="jam_berakhir" class="form-control verifydate" value="<?php $time = new DateTime(date('H:i'));
                                                                                                                                    $time->modify('+2 hours');
                                                                                                                                    echo $time->format('H:i'); ?>">
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control verifydate" value="<?php echo date('Y-m-d', time()); ?>">
                            <span id="alerttanggal" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Keterangan Peminjaman</label>
                            <select name="keterangan" id="keterangan" class="form-control">
                                <option value="Seminar">Seminar</option>
                                <option value="OSIS">OSIS</option>
                                <option value="Rapat">Rapat</option>
                                <option value="Pelatihan/Workshop">Pelatihan/Workshop</option>
                                <option value="Kegiatan Kepemimpinan">Kegiatan Kepemimpinan</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="tambah" class="btn btn-primary pinjam">Pinjam</button>
                </div>
            </form>
        </div>
        <!-- modal pinjam ruangan -->
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- MODAL BOOKING RUANGAN -->
<div class="modal fade" id="modalBooking">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Booking ruangan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <form role="form" action="" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <input type="hidden" name="id_user" value="<?php if (isset($user)) {
                                                                            echo $user;
                                                                        } ?>">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" disabled class="form-control" value="<?php if (isset($username)) {
                                                                                                            echo $username;
                                                                                                        } ?>" required="">
                            </div>
                            <div class="form-group">
                                <label>Ruangan</label>
                                <select name="id_ruangan" class="form-control">
                                    <?php
                                    $ruangan2 = $this->m_siplabs->get_data('ruangan')->result();
                                    foreach ($ruangan2 as $r2) : ?>
                                        <option value="<?php echo $r2->id_ruangan ?>"><?php echo $r2->kode_ruangan ?> - <?php echo $r2->nama_ruangan ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jam Mulai</label>
                                <input type="time" name="jam_mulai" class="form-control" value="08:00">
                            </div>
                            <div class="form-group">
                                <label>Jam Selesai</label>
                                <input type="time" name="jam_berakhir" class="form-control" value="08:50">
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="form-group">
                                <label>Keterangan Peminjaman</label>
                                <select name="keterangan" id="keterangan" class="form-control">
                                    <option value="Seminar">Seminar</option>
                                    <option value="OSIS">OSIS</option>
                                    <option value="Rapat">Rapat</option>
                                    <option value="Pelatihan/Workshop">Pelatihan/Workshop</option>
                                    <option value="Kegiatan Kepemimpinan">Kegiatan Kepemimpinan</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                </p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" name="booking" class="btn btn-primary">Booking</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- MODAL LOGOUT -->
<div class="modal fade" id="logout">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lanjutkan?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Pilih 'logout' untuk keluar dari sistem</h5>
            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url('auth/logout') ?>" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>