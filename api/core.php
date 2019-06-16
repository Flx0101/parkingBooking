<?php
function connection()
{
		/*$database= [
		'servername'=>'localhost',
		'username'=>'root',
		'password'=>'',
		'dbname'=>'impulse_park'
		];*/

	$database = [
		'servername' => 'sql12.freemysqlhosting.net',
		'username' => 'sql12263535',
		'password' => 'X1Xy1CdlAf',
		'dbname' => 'sql12263535'
	];
	// connecting to Database
	$con = new mysqli($database['servername'], $database['username'], $database['password'], $database['dbname']);
		// Check connection
	if ($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	}
	return $con;
}

$_SESSION['basic_load'] = 1;
?>
