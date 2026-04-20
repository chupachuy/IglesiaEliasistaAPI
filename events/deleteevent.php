<?php

$id = $_GET['id'];
include('database.php');

//delete from eventos where id = $id;

$query = "DELETE FROM eventos WHERE id='".$id."'";

$result = mysqli_query($conn, $query);

if($result){
    echo "<script languaje='javaScript'><lert('Evento eliminado correactamente'); location.assign('index.php);</script>";
}else{
    echo "<script languaje='javaScript'><lert('Evento NO fue eliminado correactamente'); location.assign('index.php);</script>";
}

?>