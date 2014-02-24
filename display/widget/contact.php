	<div id="contact">
		<h1>Contact Me</h1>
		<form action="<?php echo CURRENT_URL;?>#contact" method="post">
			<?php if(array_key_exists('email', $error)) { ?><p><?php echo $error['email']; ?></p><?php } ?>
			<?php if(array_key_exists('wait_time', $error)) { ?><p><?php echo $error['wait_time']; ?></p><?php } ?>
			<?php if(array_key_exists('success', $error)) { ?><p><?php echo $error['success']; ?></p><?php } ?>
			<div class="contact-field"><input type="text" value="Your email" maxlength="33" name="email" /></div>
			<?php if(array_key_exists('subject', $error)) { ?><p><?php echo $error['subject']; ?></p><?php } ?>
			<div class="contact-field"><input type="text" value="Your subject"  maxlength="20" name="subject"/></div>
			<?php if(array_key_exists('body', $error)) { ?><p><?php echo $error['body']; ?></p><?php } ?>
			<textarea rows="10" cols="50"  maxlength="300" name="body">Your message</textarea>
			<div class="button"><input type="submit" value="Send Email" /></div>
		</form>
	</div>