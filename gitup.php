<?php
error_reporting(E_ALL);

$base_path = dirname(__FILE__);

function l($message)
{
	global $base_path;

	echo $message . PHP_EOL;
	file_put_contents($base_path . '/gitup.log', $message . PHP_EOL, FILE_APPEND);
}

function e($command)
{
	l('try execute: ' . $command);
	return shell_exec($command);
}

l('Init. Hello!');
l('Current time: ' . date('Y-m-d H:i'));

ob_start();
print_r($_POST);
$data = ob_get_clean();

l('We have request: ' . $data);

l('try to execute git pull...');
$result = e('cd ' . $base_path . ' && git pull origin master 2>&1');

l('result of git pull:');
l($result);

l('try to apply migrations...');

$result = e($base_path . '/protected/yiic migrate --interactive=false');

l('migration result:');
l($result);

l('clear assets...');
if (strpos(php_uname('s'), 'Windows') !== false) {
	file_put_contents(
		$base_path . '\assets\clear.bat',
		'for /f "delims=" %%i in (\'dir "' . $base_path . '\assets\*" /a:d /b\') do rmdir /s /q "' . $base_path . '\assets\%%i"'
	);

	$result = e($base_path . '\assets\clear.bat');

	unlink($base_path . '\assets\clear.bat');
} else {
	$result = e('rm -r ' . $base_path . '/assets/*');
}
l($result);

l('clear cache');
if (strpos(php_uname('s'), 'Windows') !== false) {
	$result = e('rd /s /q "' . $base_path . '\protected\runtime\cache"');
} else {
	$result = e('rm -rf ' . $base_path . '/protected/runtime/cache');
}

?>
