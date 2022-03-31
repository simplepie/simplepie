<?php
// Set up our constants
define('SP_PATH', dirname(dirname(__FILE__)));
define('COMPILED', SP_PATH . DIRECTORY_SEPARATOR . 'SimplePie.compiled.php');

if (! function_exists('str_starts_with')) {
	function str_starts_with(string $haystack, string $needle) {
		return strncmp($haystack, $needle, strlen($needle)) === 0;
	}
}

if (! function_exists('str_ends_with')) {
	function str_ends_with(string $haystack, string $needle) {
		return $needle === '' || $needle === substr($haystack, - strlen($needle));
	}
}

function remove_header($contents)
{
	$tokens = token_get_all($contents);
	$stripped_source = '';
	$stripped_doc = false;
	$stripped_open = false;
	foreach ($tokens as $value)
	{
		if (is_string($value))
		{
			$stripped_source .= "{$value}";
			continue;
		}
		switch ($value[0])
		{
			case T_DOC_COMMENT:
				if (!$stripped_doc)
				{
					$stripped_doc = true;
					continue 2;
				}
				break;
			case T_OPEN_TAG:
				if (!$stripped_open)
				{
					$stripped_open = true;
					continue 2;
				}
				break;
		}
		$stripped_source .= "{$value[1]}";
	}

	return $stripped_source;
}

// Start with the header
$compiled = file_get_contents(SP_PATH . '/build/header.txt');
$compiled .= "\n";

// Add all the files in the SimplePie directory
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(SP_PATH . '/src', FilesystemIterator::SKIP_DOTS));
$file_paths = array();
$first_file = '';
$last_file = '';

foreach($files as $file_path => $info)
{
	if (str_ends_with($file_path, 'SimplePie.php')) {
		// Add the base class first
		$first_file = $file_path;
		// We add the library/SimplePie.php as last file,
		// because we need the constants definitions for BC reasons
		// @deprecated This will be removed with SimplePie v2
		$last_file = str_replace('src', 'library', $file_path);
		continue;
	}

	$file_paths[] = $file_path;
}

natsort($file_paths);
array_unshift($file_paths, $first_file);
array_push($file_paths, $last_file);

foreach($file_paths as $file_path)
{
	$contents = file_get_contents($file_path);
	$contents = trim(remove_header($contents));

	if (str_starts_with($contents, 'namespace SimplePie')) {
		// use bracketed syntax for namespaced classes
		$pos = strpos($contents, ';');
		$namespace_name = substr($contents, 0, $pos);

		$contents = $namespace_name . " {\n\n" . substr($contents, $pos+1) . "\n\n}";
	} else {
		// use bracketed syntax for global namespace
		$contents = "namespace {\n\n" . $contents . "\n\n}";
	}

	$compiled .= $contents . "\n\n";
}

// Strip excess whitespace
$compiled = preg_replace("#\n\n\n+#", "\n\n", $compiled);

// Hardcode the build
$compiled = str_replace(
	"define('SIMPLEPIE_BUILD', gmdate('YmdHis', \SimplePie\Misc::get_build()))",
	"define('SIMPLEPIE_BUILD', '" . gmdate('YmdHis', time()) . "')",
	$compiled
);

// Finally, save
file_put_contents(COMPILED, $compiled);
