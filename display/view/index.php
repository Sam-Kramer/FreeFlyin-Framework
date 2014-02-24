<div id="body">
	<h1>Welcome FreeFlyin Framework user!</h1>
	<p>You made a great decision to come with us! Not only are we unique, but we're also speedy. No need to take an hour just to setup your framework!
	In fact, you should be able to set this up under 10 minutes (depending on your internet speed). Honestly, you probably could do it in one minute. After
	that, it takes about ~30 to 60 minutes implementing your template. In fact, you don't even have to deal with that! This framework is quite unique, and
	after deciding that templates can rather be more of a pain then beneficial. So, you'll load everything through your 'view' files.
	</p>
	<br />
	<p>
	Honestly, that folder
	is going to get big. But no problem! You can use <code>$this->loadView('template' . DS . 'header');</code> verus
	<code>$this->loadView('header');</code> in order to keep your views organized. In fact, if you're that nit picky, you could even write your own loadView
	function in your own page class!</p>
	<br />
	<p>Here is an example of using an image!</p>
	<img src="<?php echo MEDIA; ?>/images/smilely.png" alt="frowny.png" />
	
	<p>Here is an example of another way to use an image while under this framework! </p>
	<?php echo $this->html->image('frowny.png', 'frowny :('); ?>
</div>