<?php
$query = $this->db->query("SELECT * FROM user WHERE status=1 ORDER BY level")->result();
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
	<div class="container">
		<div class="card">
			<div class="card-header text-center">
				<h2>Kelola Data User</h2>
			</div>
			<div class="card-body">
				<?php echo $this->session->flashdata('message'); ?>
				<div class="row">
					<div class="col-2">
						<button class="btn btn-primary" data-toggle="modal" data-target="#adduser"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah User</button>
					</div>
					<div class="col-12"><br></div>
				</div>
				<div class="table-responsive">
					<table id="tabel" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama Lengkap</th>
								<th>Username</th>
								<th>NIP</th>
								<th>Level</th>
								<th class="col-xs-2">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($query as $u) : ?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $u->nama_lengkap; ?></td>
									<td><?php echo $u->username; ?></td>
									<td><?php echo $u->nip; ?></td>
									<td><?php echo $u->level; ?></td>
									<td>
										<?php if ($u->level == "Peminjam") : ?>
											<a href="<?php echo base_url('admin/deleteuser/' . $u->id_user) ?>" onclick="return confirm('Hapus?')" class="badge badge-danger">Hapus</a>
										<?php else : ?>
											<?php if ($u->id_user != $this->session->userdata('id_user')) : ?>
												<a href="<?php echo base_url('admin/deleteuser/' . $u->id_user) ?>" onclick="return confirm('Hapus?')" class="badge badge-danger">Hapus</a>
											<?php else : ?>
												<a href="<?php echo base_url('admin/myprofile/' . $this->session->userdata('id_user')) ?>" class="badge badge-primary">Profil Saya</a>
											<?php endif ?>
										<?php endif; ?>
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