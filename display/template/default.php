<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="A site running off of FreeFlyin Framework!" />
    <meta name="keywords" content="FreeFlyin Framework, Freeflyin, Framework" />
    <title>FreeFlyin Framework</title>
    <link rel="stylesheet" href="<?php echo MEDIA; ?>/css/style.css" type="text/css" media="screen" charset="utf-8" />
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Serif' rel='stylesheet' type='text/css' />
    <?php
    $this->html->loadJs();
    $this->html->loadCss();
    ?>
</head>
<body>
<div id="header">
    <ul>
        <li><a href="<?php echo URL; ?>">Home</a></li>
        <li><a href="<?php echo URL; ?>/error">Error</a></li>
    </ul>
</div>
<?php $this->loadView($view, $data); ?>
<div id="footer">
    <div id="copyright">
        <p>&copy; Freeflyin 2011</p>
    </div>
</div>
</body>
</html>