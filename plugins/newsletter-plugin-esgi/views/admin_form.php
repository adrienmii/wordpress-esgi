<div class="wrap">
	<form method="post">
		<div id="icon-options-general" class="icon32"></div>
		<h2>Newsletter Plugin ESGI</h2>
		<?php settings_errors(); ?>

		<div id="poststuff">

			<div id="post-body" class="metabox-holder columns-2">

				<div id="post-body-content">
					<div class="meta-box-sortables ui-sortable">

						<div class="postbox">
							<h3><span>Configurations</span></h3>
							<div class="inside">
								<p></p>
								<table class="form-table" id="configure">
									<tbody>
				
										<tr valign="top">
											<th scope="row">URL logo site</th>
											<td>
												<input name="newsletter_logo" type="text" value="<?php echo get_option("newsletter_logo"); ?>" class="large-text" />
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">Afficher le champ Nom ?</th>
											<td>
												<select name="newsletter_showname" class="large-text">
													<option value='1' <?php selected( get_option("newsletter_showname"), 1, true); ?>>Oui</option>
													<option value='0' <?php selected( get_option("newsletter_showname"), 0, true); ?>>Non</option>
												</select>
											</td>
										</tr>
				
										<tr valign="top">
											<th scope="row">Message de confirmation formulaire envoyé</th>
											<td>
												<input name="newsletter_successmessage" type="text" value="<?php echo get_option("newsletter_successmessage"); ?>" class="large-text" />
											</td>
										</tr>
										<tr valign="top">
											<th scope="row">Message de confirmation après validation de l'email</th>
											<td>
												<input name="newsletter_confirmedmessage" type="text" value="<?php echo get_option("newsletter_confirmedmessage"); ?>" class="large-text" />
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">Corps du mail de confirmation</th>
											<td>
												<input name="newsletter_confirmationemail" type="text" value="<?php echo get_option("newsletter_confirmationemail"); ?>" class="large-text" />
											</td>
										</tr>
									</tbody>
								</table>
							</div> 
						</div> 
					</div> 
				</div> 

				<div id="postbox-container-1" class="postbox-container">
					<div class="meta-box-sortables">
						<div class="postbox">
							<div class="inside">
								<?php submit_button( $text = null, $type = 'primary', $name = 'submit', $wrap = true, $other_attributes = null ) ?>
							</div> 
						</div> 
					</div>
				</div>
			</div>
			<br class="clear">
		</div>
	</form>	
</div>