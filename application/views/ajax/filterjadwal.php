<?php
$no=1;
foreach($jadwal as $q): ?>
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