<?php
$emailList = new controllerNewsletter();
?>
<div class="wrap">	
	<div id="icon-options-general" class="icon32"></div>
	<h2>Dernières <?php echo $emailList->limit; ?> inscriptions</h2>

	<div class="tablenav top">
		<div class="alignleft actions bulkactions">
			
				<label for="bulk-action-selector-top" class="screen-reader-text">Exporter</label>
				<select name="action" id="exportMethod">
					<option value="-1">Exporter</option>
					<option value="?newsletter_export_method=EXPORT_ALL">Tout</option>
					<option value="?newsletter_export_method=EXPORT_CONFIRMED">Vérifiées</option>
				</select>
				<input type="submit" id="doExport" class="button" value="Télécharger">
			
		</div>
		<br class="clear">
	</div>
	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<div id="post-body-content">

				<table class="widefat">
					<thead>
						<tr>
							<th>#</th>
							<th>Nom</th>
							<th>E-mail</th>
							<th>Date d'inscription</th>
							<th>Verifiée?</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$page = (isset($_GET['paged']))?$_GET['paged']:0;
						$subscribers = $emailList->get_subscribers('all', $page);

						foreach ( $subscribers as $subscriber) {
							?>
							<tr>
								<td><?php echo $subscriber['id'] ?></td>
								<td><?php echo $subscriber['name'] ?></td>
								<td><?php echo $subscriber['email'] ?></td>
								<td><?php echo date('d/m/Y H:i:s', strtotime($subscriber['created'])); ?></td>
								<td><?php echo ($subscriber['confirmed'] == 0)?'<div class="dashicons-before dashicons-no"><br/></div>':'<div class="dashicons-before dashicons-yes"><br/></div>'; ?></td>
								<td><a href="?newsletter_delete=<?php echo $subscriber['id'] ?>">Supprimer</a></td>
							</tr>
							<?php
						}

						if(empty($subscribers))
						{
							?>
							<tr>
								<td colspan="5"><center>Aucun e-mail</center></td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>

			</div> 


			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">					
					<div class="postbox">
						<h3 class='hndle ui-sortable-handle'><span>Stats</span></h3>
						<div class="inside">
							<div>
								<?php $total = $emailList->count();?>
								<p><b>Vérifiées: </b><?php echo number_format($total[0]['nb_confirmed'], 0, '', '.'); ?></p>
								<p><b>Non vérifiées: </b><?php echo number_format($total[0]['nb_unconfirmed'], 0, '', '.'); ?></p>
								<p><b>Total: </b><?php echo number_format(($total[0]['nb_confirmed']+$total[0]['nb_unconfirmed']), 0, '', '.'); ?></p>
							</div>
						</div> 

					</div> 

				</div> 

			</div> 

		</div> 

		<br class="clear">
	</div> 

</div> 