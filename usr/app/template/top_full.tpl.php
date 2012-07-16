<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<meta name="description" content="HTML_META_DESCRIPTION">
<meta name="keywords" content="HTML_META_KEYWORDS">
<meta name="author" content="renas - renasboy@gmail.com">

<link rel="shortcut icon" href="/img/favicon.png" type="image/png">
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="/img/canistro-icon-57x57.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/canistro-icon-114x114.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>HTML_TITLE</title>

<?php
foreach ($css as $file) {
    print $helper->css($file);
}
foreach ($js as $file) {
    print $helper->js($file);
}
?>

<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-33408401-1']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>

</head>

<body>

<?php $view->add('header'); ?>

<div class="container">
<?php $view->add('main'); ?>
</div>

<?php $view->add('footer'); ?>

</body>
</html>
