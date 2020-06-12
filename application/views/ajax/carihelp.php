<?php foreach($hasil as $h): ?>
	<tbody>
		<tr>
			<td><b><?php echo $h->judul; ?></b></td>
		</tr>
		<tr>
			<td><?php echo $h->isi ?></td>
		</tr>
	</tbody>
	<br>
	<?php endforeach; ?>