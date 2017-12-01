<title>Notification</title>

<p style="padding: 10px;"></p>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-hover">
				<?php foreach ($notifs as $notification): ?>					
					<tr>
						<td><?php echo $notification->date ?></td>
						<td><?php echo $notification->message ?></td>
					</tr>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</div>

<p style="padding: 50px;"></p>