<div class="pnl-wrapper">
	<div class="pnl full-width">
		<h2>Did you forget your password?</h2>
		
		<div class="section">
			<p>Enter your email address below, and we'll email you instructions to reset it.</p>

			<?php $attributes = array('class' => 'main password', 'id' => '');
			echo form_open_multipart('amnesia/forgot_password', $attributes); ?>
			
				<?php echo form_error('email'); ?>
				<label for="email">Email address</label>
				<input id="email" name="email" type="text" />
				
				<button type="submit" class="submit"><span>Reset my password</span></button>
			
			<?php echo form_close(); ?>
			
			<div class="clear">
				<h3>A note about spam filters</h3>

				<p>If you don&#x27;t get an email from us within a few minutes please be sure to check your spam filter. The email will be coming from <?php echo SYSTEM_EMAIL?>.</p>

				<p>Never mind, send me back to the <a href="<?php echo base_url(); ?>login">login screen</a></p>
			</div>
		</div>
	</div>
</div>