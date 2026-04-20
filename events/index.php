<script>
    function confirmarDelete(){
        return confirm('¿Estás seguroque desea eliminar este evento?');
    }

</script>

<?php include('header.php'); ?>

<div class="container mt-4">
    <h1 class="text-center">LIsta de eventos</h1>
    
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Invitación</th>
            <th scope="col">Titulo</th>
            <th scope="col">Fecha</th>
            <th scope="col">lugar</th>
            <th scope="col">Hora</th>
            <th scope="col">Imagen</th>
            <th scope="col">Editar</th>
            </tr>
        </thead>

   <?php

   include('database.php');

   $query = "SELECT * from eventos";
   $result = mysqli_query($conn, $query);

   while($mostrar = mysqli_fetch_array($result)){

    ?>
        <tr>
            <th><?php echo $mostrar['id']; ?></th>
            <td><?php echo $mostrar['invitation']; ?></td>
            <td><?php echo $mostrar['title']; ?></td>
            <td><?php echo $mostrar['date_event']; ?></td>
            <td><?php echo $mostrar['place']; ?></td>
            <td><?php echo $mostrar['hour_event']; ?></td>
            <td>
                <img class="img-table" src="<?php echo $mostrar['image_url']; ?>" alt="">
            </td>
            <td><a class="btn btn-info" href="editevent.php?id=<?php echo $mostrar['id']; ?>">Editar</a> | <a class="btn btn-danger" href="deleteevent.php?id=<?php echo $mostrar['id']; ?>" onClick="return confirmarDelete();">Eliminar</a></td>
            </tr>
        

  <?php }  ?>

  </table>
</div>

<?php include('footer.php'); ?>