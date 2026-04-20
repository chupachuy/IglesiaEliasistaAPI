<?php include('header.php'); ?>

<?php include('database.php'); ?>

<?php
    if(isset($_POST['enviar'])){


        $id = $_POST['id'];
        $invitation = $_POST['invitation'];
        $title = $_POST['title'];
        $date_event = $_POST['date_event'];
        $place = $_POST['place']; 
        $hour_event = $_POST['hour_event'];
        $image_url = $_POST['image_url'];

        $query = "UPDATE eventos SET invitation='" . $invitation . "', title='" . $title . "', date_event='" . $date_event . "', place='" . $place . "', hour_event='" . $hour_event . "', image_url='" . $image_url . "' WHERE id='" . $id . "'";

        $result = mysqli_query($conn, $query);

        if($result){
            echo "<script languaje='JavaScript'>alert('Los datos fueron Actualizados correctamente'); location.assign('index.php');</script>";
        } else {
            echo  "<script languaje='JavaScript'>alert('Los datos fueron NO fueron actualizados correctamente'); location.assign('index.php');</script>";
        }

        mysqli_close($conn);

    } else {

        $id = $_GET['id'];

        $query = "SELECT * FROM eventos WHERE id='$id'";
        $result = mysqli_query($conn, $query);

        $mostrar = mysqli_fetch_assoc($result);

        $invitation = $mostrar['invitation'];
        $title = $mostrar['title'];
        $date_event = $mostrar['date_event'];
        $place = $mostrar['place'];
        $hour_event = $mostrar['hour_event'];
        $image_url = $mostrar['image_url'];

        mysqli_close($conn);
    ?>

    <div class="conatiner">
        <h1 class="text-center"><?php echo $title; ?><br /><small>Editar Evento</small></h1>

        <hr>

        <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="<?=$_SERVER['PHP_SELF'] ?>">
                <div class="mb-3">
                    <label for="invitation" class="form-label">Invitación</label>
                    <input value="<?php echo $invitation; ?>" type="text" class="form-control" name="invitation" id="invitation" placeholder="Descripción del Evento" required >
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input value="<?php echo $title; ?>" type="text" class="form-control" name="title" id="title" placeholder="Título del Evento" required >
                </div>
                <div class="mb-3">
                    <label for="date_event" class="form-label">Fecha</label>
                    <input value="<?php echo $date_event; ?>" type="text" class="form-control" name="date_event" id="date_event" placeholder="Fecha del Evento" required >
                </div>
                <div class="mb-3">
                    <label for="place" class="form-label">Lugar de Evento</label>
                    <input value="<?php echo $place; ?>" type="text" class="form-control" name="place" id="place" placeholder="Lugar del Evento" required >
                </div>
                <div class="mb-3">
                    <label for="hour" class="form-label">Hora</label>
                    <input value="<?php echo $hour_event; ?>" type="text" class="form-control" name="hour_event" id="hour" placeholder="Hora del Evento" required >
                </div>
                <div class="mb-3">
                    <label for="image_url" class="form-label">Inserta el url de la imagén</label>
                    <input value="<?php echo $image_url; ?>" type="text" class="form-control" name="image_url" id="image_url" placeholder="ej: https://iglesiaeliasista.org.mx/app-images/Eventos-3-Mesias-2024.jpeg">
                </div>
                
                <button type="submit" name="enviar" class="btn btn-primary">Editar Evento</button>
            </form>
        </div>
    </div>

<?php } ?>

</div>


<?php include('footer.php'); ?>