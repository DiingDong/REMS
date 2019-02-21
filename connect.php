<?php
/*
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'DiingDong');
	define('DB_PASSWORD', 'g2XcLL{qGu;H');
	define('DB_NAME', 'vregms');
*/
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'root');
	define('DB_NAME', 'rems');
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if ($link == false) {
		die("No connection. ". mysqli_connect_error());
	}
?>