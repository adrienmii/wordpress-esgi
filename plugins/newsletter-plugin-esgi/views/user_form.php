<div class="newsletter" data-showon='<?php echo get_option('newsletter_showon'); ?>'>
	<br>
	<?php $formID = uniqid('form_newsletter-'); ?>
	<form method='POST' id='submit_newsletter' class='<?php echo $formID ?>'>
		<?php 
		if(get_option('newsletter_showname') == 1)
		{
			?>
			<fieldset class='newsletter-field newsletter-field-name'>
				<input name='newsletter[name]' type='text' placeholder='Nom'/>
			</fieldset>
			<?php 
		} ?>
		<fieldset class='newsletter-field newsletter-field-email'>
			<input name='newsletter[email]' type='email' placeholder='E-mail' />
		</fieldset>
		<input type="submit" value="S'inscrire" class='newsletter-field-submit' />
	</form>
	<div class="newsletter_spinner" style="display:none;">
		<center><img src="<?php echo plugins_url('../images/loading_spinner.gif', __FILE__) ?>" ></center>
	</div>
</div>
<script>
	initNewsletter('.<?php echo $formID; ?>');
</script>