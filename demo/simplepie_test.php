<?php
function supported_php() {
	if (function_exists('version_compare') && ((version_compare(phpversion(), '4.3.0', '>=') && version_compare(phpversion(), '5', '<')) || version_compare(phpversion(), '5.0.3', '>='))) return true;
	else return false;
}

$php_ok = supported_php();
$curl_ok = extension_loaded('curl');
$mbstring_ok = extension_loaded('mbstring');
$iconv_ok = extension_loaded('iconv');

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>SimplePie: Server Compatibility Test</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<style type="text/css">
body {
	font:11px/16px verdana, sans-serif;
	letter-spacing:0px;
	color:#333;
	margin:0;
	padding:0;
}

div#site {
	width:500px;
	margin:20px auto 0 auto;
}

a {
	color:#000;
	text-decoration:underline;
	padding:0 1px;
}

a:hover {
	color:#fff;
	background-color:#333;
	text-decoration:none;
	padding:0 1px;
}

p {
	margin:0;
	padding:5px 0;
}

em {
	font-style:normal;
	background-color:#ffc;
}

ul, ol {
	margin:10px 0 10px 20px;
	padding:0 0 0 15px;
}

ul li, ol li {
	margin:0 0 7px 0;
	padding:0 0 0 3px;
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
}

h4 {
	font-size:14px;
	padding:0;
	margin:15px 0 5px 0;
}

code {
	font-size:1.1em;
	background-color:#f3f3ff;
	color:#000;
}

table#chart {
	border-collapse:collapse;
}

table#chart th {
	background-color:#eee;
	padding:2px 3px;
	border:1px solid #fff;
}

table#chart td {
	text-align:center;
	padding:2px 3px;
	border:1px solid #eee;
}

table#chart tr.enabled td {
	/* Leave this alone */
}

table#chart tr.disabled td {
	color:#999;
	font-style:italic;
}

div.chunk {
	margin:20px 0 0 0;
	padding:0 0 10px 0;
	border-bottom:1px solid #ccc;
}

.footnote,
.footnote a {
	font:10px/12px verdana, sans-serif;
	color:#aaa;
}

.footnote em {
	background-color:transparent;
	font-style:italic;
}
</style>

</head>

<body>

<div id="site">
	<div id="content">

		<div class="chunk">
			<h3>SimplePie Compatibility Test</h3>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" id="chart">
				<thead>
					<tr>
						<th>Test</th>
						<th>Should Be</th>
						<th>What You Have</th>
					</tr>
				</thead>
				<tbody>
					<tr class="<?php echo ($php_ok) ? 'enabled' : 'disabled'; ?>">
						<td>PHP</td>
						<td>4.3.0&ndash;4.4.x; 5.0.3&ndash;5.1.x</td>
						<td><?php echo phpversion(); ?></td>
					</tr>
					<tr class="<?php echo ($curl_ok) ? 'enabled' : 'disabled'; ?>">
						<td>curl</td>
						<td>Enabled</td>
						<td><?php echo ($curl_ok) ? 'Enabled' : 'Disabled'; ?></td>
					</tr>
					<tr class="<?php echo ($mbstring_ok) ? 'enabled' : 'disabled'; ?>">
						<td>mbstring</td>
						<td>Enabled</td>
						<td><?php echo ($mbstring_ok) ? 'Enabled' : 'Disabled'; ?></td>
					</tr>
					<tr class="<?php echo ($iconv_ok) ? 'enabled' : 'disabled'; ?>">
						<td>iconv</td>
						<td>Enabled</td>
						<td><?php echo ($iconv_ok) ? 'Enabled' : 'Disabled'; ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="chunk">
			<h3>What does this mean?</h3>
			<ol>
				<?php if ($php_ok && $mbstring_ok && $iconv_ok && $curl_ok) { ?>
				<li><em>You have everything you need to run SimplePie properly!  Congratulations!</em></li>
				<?php } else { ?>
					<?php if ($php_ok) { ?>
						<li><strong>PHP:</strong> You are running a supported version of PHP.  <em>No problems here.</em></li>
						<?php if ($curl_ok) { ?>
							<li><strong>curl:</strong> You have <code>curl</code> installed.  <em>No problems here.</em></li>
							<?php if ($mbstring_ok && $iconv_ok) { ?>
								<li><strong>mbstring and iconv:</strong> You have both <code>mbstring</code> and <code>iconv</code> installed!  This will allow SimplePie to handle the greatest number of languages.  Check the <a href="http://simplepie.org/docs/reference/simplepie-core/supported-character-encodings/">Supported Character Encodings</a> chart to see what's supported on your webhost.</li>
							<?php } else if ($mbstring_ok) { ?>
								<li><strong>mbstring:</strong> <code>mbstring</code> is installed, but <code>iconv</code> is not.  Check the <a href="http://simplepie.org/docs/reference/simplepie-core/supported-character-encodings/">Supported Character Encodings</a> chart to see what's supported on your webhost.</li>
							<?php } else if ($iconv_ok) { ?>
								<li><strong>iconv:</strong> <code>iconv</code> is installed, but <code>mbstring</code> is not.  Check the <a href="http://simplepie.org/docs/reference/simplepie-core/supported-character-encodings/">Supported Character Encodings</a> chart to see what's supported on your webhost.</li>
							<?php } else { ?>
								<li><strong>mbstring and iconv:</strong> <em>You do not have either of the extensions installed.</em>  This will significantly affect your ability to read non-english feeds, as well as even some english ones.  Check the <a href="http://simplepie.org/docs/reference/simplepie-core/supported-character-encodings/">Supported Character Encodings</a> chart to see what's supported on your webhost.</li>
							<?php } ?>
						<?php } else { ?>
							<li><strong>curl:</strong> The <code>curl</code> extension is not available.  <em>SimplePie is a no-go at the moment.</em></li>
						<?php } ?>
					<?php } else { ?>
						<li><strong>PHP:</strong> You are running an unsupported version of PHP.  <em>SimplePie is a no-go at the moment.</em></li>
					<?php } ?>
				<?php }?>
			</ol>
		</div>

		<div class="chunk">
			<?php if ($php_ok && $mbstring_ok && $iconv_ok && $curl_ok) { ?>
				<h3>Bottom Line: Yes, you can!</h3>
				<p><em>Your webhost has its act together!</em></p>
				<p>You can download the latest version of SimplePie from <a href="http://simplepie.org/downloads/">SimplePie.org</a> and install it by <a href="http://simplepie.org/docs/setup.php">following the instructions</a>.  You can find example uses with <a href="/ideas/">SimplePie Ideas</a>.</p>
			<?php } else if ($php_ok && $curl_ok && !$mbstring_ok && !$iconv_ok) { ?>
				<h3>Bottom Line: Yes, but it's crippled.</h3>
				<p><em>You're limited to essentially english, spanish, italian, and other western-european languages.</em>  Even then you might still have some problems.  We'd recommend that you stick to publishing specific feeds on your site where you know that they're UTF-8 or ISO-8859-1.</p>
				<p>You can download the latest version of SimplePie from <a href="http://simplepie.org/downloads/">SimplePie.org</a> and install it by <a href="http://simplepie.org/docs/setup.php">following the instructions</a>.  You can find example uses with <a href="/ideas/">SimplePie Ideas</a>.</p>
			<?php } else if ($php_ok && $curl_ok && (!$mbstring_ok || !$iconv_ok)) { ?>
				<h3>Bottom Line: Yes, you can!</h3>
				<p><em>For most feeds, it'll run with no problems.</em>  There are certain languages that you'll have a hard time with though.</p>
				<p>You can download the latest version of SimplePie from <a href="http://simplepie.org/downloads/">SimplePie.org</a> and install it by <a href="http://simplepie.org/docs/setup.php">following the instructions</a>.  You can find example uses with <a href="/ideas/">SimplePie Ideas</a>.</p>
			<?php } else { ?>
				<h3>Bottom Line: We're sorry...</h3>
				<p><em>Your webhost does not support the minimum requirements for SimplePie.</em>  It may be a good idea to contact your webhost, and ask them to install a more recent version of PHP as well as the <code>mbstring</code> and <code>iconv</code> extensions.</p>
			<?php } ?>
		</div>

	</div>

</div>

</body>
</html>