<?php

if (isset($_GET['logopng']))
{
	$data = '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';
	header('Content-type: image/png');
	echo base64_decode($data);
	exit;
}
else if (isset($_GET['background']))
{
	$data = 'R0lGODlhMAEeAeYAAP///8ni6cTf5+72+PD3+c3k6+nz9ufy9ev099Pn7bnZ48bg6LfY4uHv8/r8/f3+/v7//7bX4cjh6fj7/Mvj6vz9/rva4+z19/X6+/f7/Pn8/fb6+7jZ4vv9/bra473b5Lzb5LXX4b7c5b/c5e31+NTo7tvs8dfq7/H3+bjY4tnq79Hm7c/l69nr8PL4+t7t8sDd5cLe5uPw9Nvr8Mri6fP4+tLn7er099Hm7O/2+dDm7OTw9OXx9Nbp7tbp7+Lv8+Du8szj6sXg57bY4d3s8djq7+jz9tzs8cPe58fh6M7k68Pf5+by9fz+/sDd5vT5+vT5+97t8bbY4trr8P7+/v7+/+Pw8+Xx9dXo7sHe5vH4+fP5+sHd5t/u8s/l7AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAwAR4BAAf/gCGCg4SFhoeIiYqLjI2Oj5CRkpOUlZaXmJmam5ydnp+goaKNEaWmp6ipqqusra6vsLGys7S1tre4ubq7vL2+v8DBwsPExbBDyMnKy8zNzs/Q0dLT1NXW19jZ2tvc3d7KUuHi4+Tl5ufo6err7O3u7/Dx8vP09fb34wz6+/z9/v8AAwocSLCgwYMIEypcyLChw4cQI0qcSLGixYsYM2osmKKjx48gQ4ocSbKkyZMoU6pcybKly5cwY8qc+ZGDzZs4c+rcybOnz59AgwodSrSo0aNIkypdyrSp06dQo0qdSrWq1aAKsmrdyrWr169gw4odS7as2bNo06pdy7at27dw/+PKnUu3rt27ePOS9cC3r9+/gAMLHky4sOHDiBMrXsy4sePHkCNLnky5suXLmDNr3sz5sIXPoEOLHk26tOnTqFOrXs26tevXsGPLnk27tu3buHPr3s27t+/fqkEIH068uPHjyJMrX868ufPn0KNLn069uvXr2LNr3869u/fv4MOLb/6hvPnz6NOrX8++vfv38OPLn0+/vv37+PPr38+/v///AAYo4IAEFgifCAgmqOCCDDbo4IMQRijhhBRWaOGFGGao4YYcdujhhyCGKOKIJJZo4okoTjjCiiy26OKLMMYo44w01mjjjTjmqOOOPPbo449ABinkkEQWaeSRSCap5P+SNsLg5JNQRinllFRWaeWVWGap5ZZcdunll2CGKeaYZELpxJlopqnmmmy26eabcMYp55x01mnnnXjmqeeefPaZJheABirooIQWauihiCaq6KKMNuroo5BGKumklFZqqaBZZKrpppx26umnoIYq6qiklmrqqaimquqqrLbq6qubxiDrrLTWauutuOaq66689urrr8AGK+ywxBZr7LHI0orEssw26+yz0EYr7bTUVmvttdhmq+223Hbr7bfghtvsEuSWa+656Kar7rrstuvuu/DGK++89NZr77345quvuQL06++/AAcs8MAEF2zwwQgnrPDCDDfs8MMQRyzxxBRXbPH/xRhnrPHGHHeMsBAghyzyyCSXbPLJKKes8sost+zyyzDHLPPMNNdss8gL5Kzzzjz37PPPQAct9NBEF2300UgnrfTSTDft9NNQRy311FRXbfXVWGdNdBJcd+3112CHLfbYZJdt9tlop6322my37fbbcMctt9cS1G333XjnrffefPft99+ABy744IQXbvjhiCeu+OKMN+7445BHLvnklFcOeACYZ6755px37vnnoIcu+uikl2766ainrvrqrLfu+uuwxy777LTXbvvtuI9Ow+689+7778AHL/zwxBdv/PHIJ6/88sw37/zz0EffOwXUV2/99dhnr/323Hfv/ffghy/+//jkl2/++einr/767Lfv/vvwxy///PR/H8T9+Oev//789+///wAMoAAHSMACGvCACEygAhfIwAbmrwAQjKAEJ0jBClrwghjMoAY3yMEOevCDIAyhCEdIwhKa8IQoTKEKV8jCFrrwhTDcoBJmSMMa2vCGOMyhDnfIwx768IdADKIQh0jEIhrxiEhMYg1ZwMQmOvGJUIyiFKdIxSpa8YpYzKIWt8jFLnrxi2AMoxid6IUymvGMaEyjGtfIxja68Y1wjKMc50jHOtrxjnjMox73eEYd+PGPgAykIAdJyEIa8pCITKQiF8nIRjrykZCMpCQnSUlA4uCSmMykJjfJyU568v+ToAylKEdJylKa8pSoTKUqV8nKVmZyBbCMpSxnScta2vKWuMylLnfJy1768pfADKYwh0nMYhpTljZIpjKXycxmOvOZ0IymNKdJzWpa85rYzKY2t8nNbnrzm8tMgDjHSc5ymvOc6EynOtfJzna6853wjKc850nPetrznvjMpz73yc9++vOfAA2oQNtZgoIa9KAITahCF8rQhjr0oRCNqEQnStGKWvSiGM2oRjd6UCx49KMgDalIR0rSkpr0pChNqUpXytKWuvSlMI2pTGdKU5D24KY4zalOd8rTnvr0p0ANqlCHStSiGvWoSE2qUpfK1Kbm1AdQjapUp0rVqlr1qlj/zapWt8rVrnr1q2ANq1jHStaymlWqJ0irWtfK1ra69a1wjatc50rXutr1rnjNq173yte++vWvay2CYAdL2MIa9rCITaxiF8vYxjr2sZCNrGQnS9nKWvaymCWsCjbL2c569rOgDa1oR0va0pr2tKhNrWpXy9rWuva1sI1tZ1tA29ra9ra4za1ud8vb3vr2t8ANrnCHS9ziGve4yE2ucm07heY697nQja50p0vd6lr3utjNrna3y93ueve74A2veMf73BmY97zoTa9618ve9rr3vfCNr3znS9/62ve++M2vfvfLX/Sa4L8ADrCAB0zgAhv4wAhOsIIXzOAGO/jBEI6w/4QnTOEKB/gIGM6whjfM4Q57+MMgDrGIR0ziEpv4xChOsYpXzOIWu1jDRIixjGdM4xrb+MY4zrGOd8zjHvv4x0AOspCHTOQiG/nIM46CkpfM5CY7+clQjrKUp0zlKlv5yljOspa3zOUue/nLYGbyC8ZM5jKb+cxoTrOa18zmNrv5zXCOs5znTOc62/nOeM5zmbvA5z77+c+ADrSgB03oQhv60IhOtKIXzehGO/rRkI60pP0MhEpb+tKYzrSmN83pTnv606AOtahHTepSm/rUqE61qld96Qa4+tWwjrWsZ03rWtv61rjOta53zete+/rXwA62sIdN7GIb+9jITrayl//N7GY7O9c/iLa0p03talv72tjOtra3ze1ue/vb4A63uMdN7nKb+9zTtoK6183udrv73fCOt7znTe962/ve+M63vvfN7377+98AZ7cMBk7wghv84AhPuMIXzvCGO/zhEI+4xCdO8Ypb/OIYz3jBd8Dxjnv84yAPuchHTvKSm/zkKE+5ylfO8pa7/OUwj7nMPc6Dmtv85jjPuc53zvOe+/znQA+60IdO9KIb/ehIT7rSl37zKzj96VCPutSnTvWqW/3qWM+61rfO9a57/etgD7vYx052qDPh7GhPu9rXzva2u/3tcI+73OdO97rb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';
	header('Content-type: image/gif');
	echo base64_decode($data);
	exit;
}
else
{
	header('Content-type: text/html; charset=UTF-8');
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>SimplePie: Unit Tests</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<style type="text/css">
body {
	font:11px/16px verdana, sans-serif;
	letter-spacing:0px;
	color:#333;
	margin:0;
	padding:0;
	background:#fff url(?background) repeat-x top left;
}

div#site {
	width:500px;
	margin:20px auto;
}

h2 {
	font-size:18px;
	padding:0;
	margin:30px 0 10px 0;
}

h3 {
	font-size:16px;
	padding:0;
	margin:20px 0 5px 0;
	padding-top:20px;
	border-top:1px solid #ccc;
}

.footnote {
	margin:20px 0 0 0;
	padding-top:10px;
	border-top:1px solid #ccc;
}

.footnote,
.footnote a {
	font:10px/12px verdana, sans-serif;
	color:#aaa;
}

table {
	border-collapse:collapse;
}

table tr {
	color:green;
}

table tr.fail {
	color:red;
	background-color:#fee;
}

table th {
	background-color:#eee;
	padding:2px 3px;
	border:1px solid #fff;
}

table td {
	text-align:left;
	padding:2px 3px;
	border:1px solid #eee;
}

table td:first-child {
	text-align:center;
	padding:2px 3px;
	border:1px solid #eee;
}
</style>

<script type="text/javascript">
// Sleight - Alpha transparency PNG's in Internet Explorer 5.5/6.0
// (c) 2001, Aaron Boodman; http://www.youngpup.net

if (navigator.platform == "Win32" && navigator.appName == "Microsoft Internet Explorer" && window.attachEvent) {
	document.writeln('<style type="text/css">img, input.image { visibility:hidden; } </style>');
	window.attachEvent("onload", fnLoadPngs);
}

function fnLoadPngs() {
	var rslt = navigator.appVersion.match(/MSIE (\d+\.\d+)/, '');
	var itsAllGood = (rslt != null && Number(rslt[1]) >= 5.5);

	for (var i = document.images.length - 1, img = null; (img = document.images[i]); i--) {
		if (itsAllGood && img.src.match(/\png$/i) != null) {
			var src = img.src;
			var div = document.createElement("DIV");
			div.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + src + "', sizing='scale')";
			div.style.width = img.width + "px";
			div.style.height = img.height + "px";
			img.replaceNode(div);
		}
		img.style.visibility = "visible";
	}
}
</script>

</head>

<body>

<div id="site">
	<h2 style="text-align:center;"><img src="?logopng" alt="SimplePie Compatibility Test" title="SimplePie Compatibility Test" /></h2>
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tbody>
<?php

require_once '../simplepie.inc';
require_once 'functions.php';

$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];

$passed = 0;
$failed = 0;
global $passed, $failed;

absolutize_test(SimplePie_List::get('absolutize'));

date_test(SimplePie_List::get('date'));

feed_copyright_test(SimplePie_List::get('feed_copyright'));

feed_description_test(SimplePie_List::get('feed_description'));

feed_image_link_test(SimplePie_List::get('feed_image_link'));

feed_image_title_test(SimplePie_List::get('feed_image_title'));

feed_image_url_test(SimplePie_List::get('feed_image_url'));

feed_language_test(SimplePie_List::get('feed_language'));

feed_link_test(SimplePie_List::get('feed_link'));

feed_title_test(SimplePie_List::get('feed_title'));

first_item_category_test(SimplePie_List::get('first_item_category'));

first_item_permalink_test(SimplePie_List::get('first_item_permalink'));

first_item_title_test(SimplePie_List::get('first_item_title'));

if (isset($_GET['remote']))
{
	dive_into_mark_atom_autodiscovery();
}

$total = $passed + $failed;
$passed_percentage = round($passed/$total*100);
$failed_percentage = round($failed/$total*100);

$mtime = explode(' ', microtime());
$mtime = $mtime[1] + $mtime[0];
$time = $mtime - $starttime;

?>
		</tbody>
	</table>
	
	<h3><?php echo $passed_percentage; ?>% passed!</h3>
	<p>We ran <?php echo $total; ?> tests in <?php echo round($time, 3); ?> seconds (<?php echo round($time/$total, 3); ?> seconds per test) of which <?php echo $passed; ?> (<?php echo $passed_percentage; ?>%) were passed, and <?php echo $failed; ?> (<?php echo $failed_percentage; ?>%) were failed.</p>
	
	<p class="footnote">Powered by <a href="<?php echo SIMPLEPIE_URL; ?>"><?php echo SIMPLEPIE_NAME . ' ' . SIMPLEPIE_VERSION . ', Build ' . SIMPLEPIE_BUILD; ?></a>.  SimplePie is &copy; 2004&ndash;<?php echo date('Y'); ?>, <a href="http://www.skyzyx.com">Skyzyx Technologies</a>, and licensed under the <a href="http://creativecommons.org/licenses/LGPL/2.1/">LGPL</a>.</p>

</div>

</body>
</html>