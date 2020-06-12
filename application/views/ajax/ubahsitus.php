<form enctype="multipart/form-data" action="<?php echo base_url('admin/editsite') ?>" method="POST">
    <div class="modal-header">
        <h4 class="modal-title">Edit situs</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <?php foreach($site as $s): ?>
            <input type="hidden" name="id_site" value="<?php echo $s->id_site ?>">
            <div class="form-group">
                <label>Judul</label>
                <input type="text" name="title" class="form-control" value="<?php echo $s->title ?>">
            </div>
            <div class="form-group">
                <label>Logo</label>
                <br>
                <center><img src="<?php echo base_url('files/site/'.$s->logo) ?>" width="50" id="imglogo"></center>
                <label for="ubahlogo" class="badge badge-primary">Ubah</label>
                <input type="file" id="ubahlogo" onchange="return ubahLogo()" name="logo" class="d-none">
                <span class="text-danger" id="newlogoname"></span>
            </div>
            <div class="form-group">
                <label>Icon</label>
                <center><img src="<?php echo base_url('files/site/'.$s->icon) ?>" width="50"></center>
                <label for="ubahicon" class="badge badge-primary">Ubah</label>
                <input type="file" id="ubahicon" onchange="return ubahIcon()" name="icon" class="d-none">
                <span class="text-danger" id="newiconname"></span>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" name="edit" class="btn btn-primary pinjam">Edit</button>
    </div>
</form>