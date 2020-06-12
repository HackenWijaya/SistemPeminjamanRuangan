<li class="nav-item dropdown">
	<a class="nav-link" data-toggle="dropdown" href="#">
		<?php 
		$counthelp = $this->db->query('select count(*) as total from help where status=0')->result();
		?>
		<i class="far fa-envelope"></i>
		<span class="badge badge-warning navbar-badge">
			<?php 
			if ($counthelp[0]->total==0) {
            // show nothing
			}else{
				echo $counthelp[0]->total; 
			} ?>
		</span>
	</a>
	<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
		<span class="dropdown-item dropdown-header">
			<?php if (null!==$counthelp[0]->total){
				echo $counthelp[0]->total; ?>
				Pertanyaan baru
			<?php }else{ ?>
				Tidak ada pertanyaann baru
			<?php } ?>
		</span>
		<div class="dropdown-divider"></div>
		<?php 
		$gethelp = $this->db->get_where('help', ['status'=>0])->result();
		foreach($gethelp as $g):
			?>
			<a href="<?php echo base_url('admin/help') ?>" data-id_help="<?php echo $g->id_help ?>" class="dropdown-item">
				<span class="text-bold"><?php echo $g->judul ?></span>
				<span class="float-right text-muted text-sm">3 mins</span>
				<div class="dropdown-divider"></div>
			<?php endforeach; ?>
		</a>
	</div>
</li>