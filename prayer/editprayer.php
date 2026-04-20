<?php include('header.php'); ?>

<?php include('database.php'); ?>

<?php
    if(isset($_POST['enviar'])){


        $id = $_POST['id'];
        $title_pray = $_POST['title_pray'];
        $description_pray = $_POST['description_pray'];
        $subject_pray = $_POST['subject_pray'];
        $pray_for = $_POST['pray_for']; 
        $pray_to = $_POST['pray_to'];
        $date_pray = $_POST['date_pray'];
        $lyrics_pray = $_POST['lyrics_pray'];

        $query = "UPDATE oraciones SET title_pray='" . $title_pray . "', description_pray='" . $description_pray . "', subject_pray='" . $subject_pray . "', pray_for='" . $pray_for . "', pray_to='" . $pray_to . "', date_pray='" . $date_pray . "', lyrics_pray = '".$lyrics_pray."'  WHERE id='" . $id . "'";

        $result = mysqli_query($conn, $query);

        if($result){
            echo "<script languaje='JavaScript'>alert('Los datos fueron Actualizados correctamente'); location.assign('index.php');</script>";
        } else {
            echo  "<script languaje='JavaScript'>alert('Los datos fueron NO fueron actualizados correctamente'); location.assign('index.php');</script>";
        }

        mysqli_close($conn);

    } else {

        $id = $_GET['id'];

        $query = "SELECT * FROM oraciones WHERE id='$id'";
        $result = mysqli_query($conn, $query);

        $mostrar = mysqli_fetch_assoc($result);

        $title_pray = $mostrar['title_pray'];
        $description_pray = $mostrar['description_pray'];
        $subject_pray = $mostrar['subject_pray'];
        $pray_for = $mostrar['pray_for'];
        $pray_to = $mostrar['pray_to'];
        $date_pray = $mostrar['date_pray'];
        $lyrics_pray = $mostrar['lyrics_pray'];

        mysqli_close($conn);
    ?>

    <div class="conatiner">
        <h1 class="text-center"><?php echo $title_pray; ?><br /><small>Editar Pedimento de Oración</small></h1>

        <hr>

        <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="<?=$_SERVER['PHP_SELF'] ?>">
                <div class="mb-3">
                    <label for="title_pray" class="form-label">Título</label>
                    <input value="<?php echo $title_pray; ?>" type="text" class="form-control" name="title_pray" id="title_pray" required >
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="mb-3">
                    <label for="description_pray" class="form-label">Descripción</label>
                    <input value="<?php echo $description_pray; ?>" type="text" class="form-control" name="description_pray" id="description_pray" required >
                </div>
                <div class="mb-3">
                    <label for="subject_pray" class="form-label">Asunto</label>
                    <input value="<?php echo $subject_pray; ?>" type="text" class="form-control" name="subject_pray" id="subject_pray" required >
                </div>
                <div class="mb-3">
                    <label for="pray_for" class="form-label">¿De quien es la Oración?</label>
                    <input value="<?php echo $pray_for; ?>" type="text" class="form-control" name="pray_for" id="pray_for" required >
                </div>
                <div class="mb-3">
                    <label for="pray_to" class="form-label">¿Pará quien es la Oración?</label>
                    <input value="<?php echo $pray_to; ?>" type="text" class="form-control" name="pray_to" id="pray_to" required >
                </div>
                <div class="mb-3">
                    <label for="date_pray" class="form-label">Fecha de la Oración</label>
                    <input value="<?php echo $date_pray; ?>" type="text" class="form-control" name="date_pray" id="date_pray" required >
                </div>
                <div class="mb-3">
                    <label for="lyrics_pray" class="form-label">Oración</label>
                    <textarea rows="4" cols="50" type="text" class="form-control" name="lyrics_pray" id="lyrics_pray" required >
                    <?php echo $lyrics_pray; ?>
                    </textarea>
                </div>
                
                <button type="submit" name="enviar" class="btn btn-primary">Editar Evento</button>
            </form>
        </div>
    </div>

<?php } ?>

</div>


<?php include('footer.php'); ?>