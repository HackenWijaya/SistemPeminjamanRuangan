    <?php foreach($ruangan as $r): ?>
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"><?php echo $r->nama_ruangan; ?></h3>
            </div>
            <div class="card-body">
                <div class="image text-center">
                    <img src="<?= base_url('files/site/'.$r->image) ?>" width="120">
                </div>
                <form enctype="multipart/form-data" action="<?php echo base_url('admin/ubahruangan') ?>" method="POST">
                    <input type="hidden" id="id_ruangan" name="id_ruangan" value="<?php echo $r->id_ruangan ?>">
                    
                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" id="kode_ruangan" data-id_ruangan="<?php echo $r->id_ruangan ?>" onkeyup="return cekkoderuangan(event)" name="kode_ruangan" class="form-control" value="<?php echo $r->kode_ruangan ?>">
                        <span id="alertkoderuangan" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama_ruangan" value="<?php echo $r->nama_ruangan ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <?php echo $r->image ?>
                        <label for="ubahgambaruangan" class="badge badge-primary">Ubah</label>
                        <input type="file" id="ubahgambaruangan" name="gambar" onchange="return getnamaruangan(event)" class="d-none">
                        <span id="gambarruanganbaru" class="text-danger"></span>
                    </div>
                    <div class="text-center">                        
                        <button type="submit" id="btnubahruangan" class="btn btn-primary ubahruangan">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
        <?php endforeach; ?>