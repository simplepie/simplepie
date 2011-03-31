<?php
$compileFile = 'SimplePie.compiled.php';
chdir(dirname(dirname(__FILE__)));
`cat SimplePie.php > $compileFile.tmp`;
`find SimplePie -type f| xargs cat | sed 's/^<?php//g'>>$compileFile.tmp`;

$contents = file_get_contents("$compileFile.tmp");
$tokens = token_get_all($contents);
$stripped_source = '';
foreach ($tokens as $value) {
	if (is_string($value)) {
		//var_dump($value);
		$stripped_source .= "{$value}";
		continue;
	}
	switch ($value[0]) {
		case T_DOC_COMMENT:
		case T_COMMENT:
			break;
		default:
			$stripped_source .= "{$value[1]}";
			break;
	}
}
file_put_contents("$compileFile.tmp", $stripped_source);
`cat build/header.txt > $compileFile`;
`cat $compileFile.tmp |sed 's/^<?php//g'>>$compileFile`;
unlink("$compileFile.tmp");
