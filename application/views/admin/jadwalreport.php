<?php
$jadwal = $this->db->query("SELECT * FROM jadwal INNER JOIN peminjaman, ruangan, user WHERE jadwal.id_peminjaman=peminjaman.id_peminjaman 
    AND peminjaman.id_ruangan=ruangan.id_ruangan
    AND peminjaman.id_user=user.id_user
    AND peminjaman.status_peminjaman!=0
    ")->result();
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
                            <li class="breadcrumb-item"><a href="#"><?= $title; ?></a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="container-fluid mt-3">
            <div class="card">
                <div class="card-header text-center">
                    <h2>LAPORAN JADWAL</h2>
                </div>
                <div class="card-body">
                   
                    <div class="row">
                        <div class="col-md">
                            <label for="" class="badge badge-primary">Filter Bulan</label>
                            <select name="filter_bulan" id="filter-bulan" class="form-control">
                                <option value="">-- Filter Bulan --</option>
                                <option value="01">JANUARI</option>
                                <option value="02">FEBRUARI</option>
                                <option value="03">MARET</option>
                                <option value="04">APRIL</option>
                                <option value="05">MEI</option>
                                <option value="06">JUNI</option>
                                <option value="07">JULI</option>
                                <option value="08">AGUSTUS</option>
                                <option value="09">SEPTEMBER</option>
                                <option value="10">OKTOBER</option>
                                <option value="11">NOVEMBER</option>
                                <option value="12">DESEMBER</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label for="" class="badge badge-primary">FILTER TANGGAL</label>
                                <input type="date" id="filter_tanggal" class="form-control">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label for="" class="badge badge-primary">FILTER RANGE TANGGAL</label>
                                <div class="input-group">
                                    <input type="date" name="range_tanggal1" id="filter_tanggal1" class="form-control">
                                    <input type="date" name="range_tanggal2" id="filter_tanggal2" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for=""><br></label>
                                <button id="cetaklapjadwal" class="btn btn-success btn-block"><i class="fas fa-print"></i> Cetak</button>
                            </div>
                        </div>
                        <div class="col-12"><br></div>
                    </div>
                    <div class="table-responsive">
                        <table id="tabel" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>User</th>
                                    <th>Ruangan</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Berakhir</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan Peminjaman</th>
                                </tr>
                            </thead>
                            <tbody id="tabeljadwal">
                                <?php $no = 1; ?>
                                <?php foreach ($jadwal as $q) : ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $q->username; ?></td>
                                        <td><?php echo $q->nama_ruangan; ?></td>
                                        <td><?php echo substr($q->jam_mulai, 0, 5); ?></td>
                                        <td><?php echo substr($q->jam_berakhir, 0, 5); ?></td>
                                        <td><?php $date = date_create($q->tanggal);
                                        echo date_format($date, 'd/m/Y'); ?></td>
                                        <td><?php echo $q->keterangan; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>