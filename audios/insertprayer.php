<?php include('database.php'); ?>

<?php

    $title_pray = $_POST['title_pray'];
    $description_pray = $_POST['description_pray'];
    $subject_pray = $_POST['subject_pray'];
    $pray_for = $_POST['pray_for'];
    $pray_to = $_POST['pray_to'];
    $date_pray = $_POST['date_pray'];
    $lyrics_pray = $_POST['lyrics_pray'];


    $query = "INSERT INTO oraciones (title_pray, description_pray, subject_pray, pray_for, pray_to, date_pray, lyrics_pray ) values ('$title_pray', '$description_pray', '$subject_pray', '$pray_for', '$pray_to', '$date_pray', '$lyrics_pray')";

    if(mysqli_query($conn, $query)){
        header('Location: index.php');
    } else {
        echo "Error al crear el Registro";
    }


?>