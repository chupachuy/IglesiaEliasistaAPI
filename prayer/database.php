<?php

$host = "localhost";
$username = "iglesiae_ApiUseRApp2024";
$password = "N{{!w9![uw,q";
$dbname = "iglesiae_ApIApp2024";

$conn = mysqli_connect( $host, $username, $password, $dbname);

if($conn){
    echo "Conexión exitosa";
} else {
    echo "Error de conexión";
}


?>