<?php include('database.php'); ?>

<?php

    $invitation = $_POST['invitation'];
    $title = $_POST['title'];
    $date = $_POST['date_event'];
    $place = $_POST['place'];
    $hour = $_POST['hour_event'];
    $image_url = $_POST['image_url'];


    $query = "INSERT INTO eventos (invitation, title, date_event, place, hour_event, image_url ) values ('$invitation', '$title', '$date', '$place', '$hour', '$image_url')";

    if(mysqli_query($conn, $query)){
        header('Location: index.php');
    } else {
        echo "Error al crear el evento";
    }


?>