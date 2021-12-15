<?php

function conectar() {
	$host = "127.0.0.1";
	$user = "root";
	$password = "";
	$database = "tienda";
	$conn = mysqli_connect(
		$host,
		$user,
		$password,
		$database
	) or die("Error al conectar".mysqli_error($conn));
	return $conn;
}

?>