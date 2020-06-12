<form action="<?php echo base_url('admin/editprofil') ?>" method="POST" enctype="multipart/form-data">
    <div class="modal-header">
        <h4 class="modal-title">Edit profil</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <?php foreach($profil as $p): ?>
            <div class="row">
                <div class="col-md">
                    <input type="hidden" name="id_user" value="<?php echo $p->id_user ?>">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" value="<?php echo $p->username ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="<?php echo $p->nama_lengkap ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Bio</label>
                        <textarea name="bio" class="form-control"><?php echo $p->bio ?></textarea>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label>NIP/NIS</label>
                        <input type="text" onkeypress="return isNumberKey(event)" name="nip" value="<?php echo $p->nip ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nomor WA Aktif</label>
                        <div class="input-group">
                            <span class="text-bold">+62</span>&nbsp;&nbsp;<input type="text" onkeypress="return isNumberKey(event)" name="no_telp" value="<?php echo $p->no_telp ?>" class="form-control">
                        </div>
                        <small class="text-danger">Nomor dimulai dari angka 8, peminjam akan langsung mengirimkan pesan ke nomor ini</small>
                    </div>
                    <div class="form-group">
                        <label>Pilih Gambar</label>
                        <input type="file" id="imageinput" onchange="return filename()" name="image" class="form-control image">
                        <span class="text-danger" id="imagename"></span>
                        <img src="<?php echo base_url('files/userprofil/'.$p->image) ?>" width="100">
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" name="edit" class="btn btn-primary pinjam">Edit</button>
    </div>
</form>