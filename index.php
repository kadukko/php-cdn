<?php
include('config.php');
include('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$headers = apache_request_headers();
	$token = $headers['X-Token'];

	if ($token != $GLOBALS['CONFIG']['TOKEN']) die('INVALID_TOKEN');

	$file = $_FILES['file'];
	$path = $_POST['path'];
	$name = $_POST['name'];

	$filePath = '';

	try {
		$filePath = uploadFile($file, $path, $name);
	} catch (Exception $e) {
		http_response_code(500);
		echo $e->getMessage();
		die();
	}

	printJSON([
		"filePath" => $filePath
	]);

	exit();
} 

echo "Welcome to LBEE CDN";
?>