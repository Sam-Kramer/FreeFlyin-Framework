	<div id="twitter">
	<h1>Twitter <a href="http://twitter.com/<?php echo $username; ?>">@<?php echo $username; ?></a></h1>
	<?php foreach($tweets as $tweet) { ?>
		<div class="twitter-post">
			<p>
			<?php echo $tweet; ?>
			</p>
		</div>
	<?php } ?>
	</div>