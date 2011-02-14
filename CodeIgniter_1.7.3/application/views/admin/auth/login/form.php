<?php display_flashdata(); ?>
<div id="loginBox">
	<?php echo form_open('admin/login'); ?>
		<dl class="clearfix">
			<dt><label for="email">Username</label></dt>
			<dd><input type="text" name="email" id="email" size="15" maxlength="100"  /></dd>

			<dt><label for="password">Password</label></dt>
			<dd><input type="password" name="password" id="password" size="15" maxlength="100"  /></dd>
		</dl>
		
		<button class="light" type="submit" name="submit">Log in</button>
	<?php echo form_close(); ?>
</div>

<!-- <script type="text/javascript">
//<![CDATA[
	$(document).ready(function()
	{
		$('#loginBox label[for]+input')
		.wrap('<div class=\"hover-wrap\" style=\"position:relative\"><\/div>')
		.focus(function(){$(this).prev().hide();})
		.blur(function(){if ( !this.value ) $(this).prev().show()})
		.each(function(){$(this).before( $(this).parent().prev() );
		if ( this.value ) $(this).prev().hide();});
	});
//]]>
</script> -->