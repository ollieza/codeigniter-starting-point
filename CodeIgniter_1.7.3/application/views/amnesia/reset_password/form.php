<div class="pnl-wrapper">
	<div class="pnl full-width">
		<h2>Reset your password</h2>

		<?php echo form_open("amnesia/reset_password/{$reset_code}")?>

		<p><label for='new_password'>
		<b>New password:</b>
		</label>
		<input id="password" name="new_password" type="password" />
		</p>

		<p><label for='new_password_confirm'>
		<b>Confirm new password:</b>
		</label>
		<input id="password" name="new_password_confirm" type="password" />
		</p>

		<p><input type="submit" name="submit" value="Save new password"  /></p>
		</form>
	</div>
</div>