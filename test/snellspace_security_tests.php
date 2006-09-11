<?php include('../simplepie.inc'); ?>

<html>
<head>
<title>SnellSpace Security Tests</title>
</head>
<body>
<ul>
	<li><a href="?feed=http://www.snellspace.com/public/everything.atom">http://www.snellspace.com/public/everything.atom</a></li>
	<li><a href="?feed=http://www.snellspace.com/public/everything2.atom">http://www.snellspace.com/public/everything2.atom</a></li>
	<li><a href="?feed=http://www.snellspace.com/public/everything3.atom">http://www.snellspace.com/public/everything3.atom</a></li>
	<li><a href="?feed=http://www.snellspace.com/public/everything4.atom">http://www.snellspace.com/public/everything4.atom</a></li>
	<li><a href="?feed=http://www.snellspace.com/public/everything5.atom">http://www.snellspace.com/public/everything5.atom</a></li>
</ul>
<hr />

<?php
if (isset($_GET['feed']) && !empty($_GET['feed'])) {
	$feed = new SimplePie();
	$feed->feed_url($_GET['feed']);
	$feed->enable_caching(false);
	$feed->order_by_date(false);
	$feed->init();
}
?>

<h1><a href="<?php echo $feed->get_feed_link(); ?>"><?php echo $feed->get_feed_title(); ?></a></h1>
<div><strong>Description:</strong> <?php echo $feed->get_feed_description(); ?></div>
<div><strong>Language:</strong> <?php echo $feed->get_feed_language(); ?></div>
<div><strong>Copyright:</strong> <?php echo $feed->get_feed_copyright(); ?></div>


<?php foreach ($feed->get_items() as $item) {?>

<h2><a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a></h2>
<div><strong>Date:</strong> <?php echo $item->get_date(); ?></div>
<div><strong>Description:</strong> <?php echo $item->get_description(); ?></div>
<hr />

<?php } ?>

</body>
</html>