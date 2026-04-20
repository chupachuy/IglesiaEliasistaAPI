<script>
    function confirmarDelete(){
        return confirm('¿Está seguro que desea eliminar este evento?');
    }

</script>

<?php include('header.php'); ?>

<div class="container mt-4">
    <h1 class="text-center">Lista de eventos</h1>
    
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Titulo</th>
            <th scope="col">Descripción</th>
            <th scope="col">Asunto</th>
            <th scope="col">De quien</th>
            <th scope="col">Para quien</th>
            <th scope="col">Fecha de oración</th>
            <th scope="col">Oración</th>
            </tr>
        </thead>

   <?php

   include('database.php');

   $query = "SELECT * from oraciones";
   $result = mysqli_query($conn, $query);

   while($mostrar = mysqli_fetch_array($result)){

    ?>
        <tr>
            <th><?php echo $mostrar['id']; ?></th>
            <td><?php echo $mostrar['title_pray']; ?></td>
            <td><?php echo $mostrar['description_pray']; ?></td>
            <td><?php echo $mostrar['subject_pray']; ?></td>
            <td><?php echo $mostrar['pray_for']; ?></td>
            <td><?php echo $mostrar['pray_to']; ?></td>
            <td><?php echo $mostrar['date_pray']; ?></td>
            <td><?php echo $mostrar['lyrics_pray']; ?></td>
            <td><a class="btn btn-info" href="editprayer.php?id=<?php echo $mostrar['id']; ?>">Editar</a> | <a class="btn btn-danger" href="deleteprayer.php?id=<?php echo $mostrar['id']; ?>" onClick="return confirmarDelete();">Eliminar</a></td>
            </tr>
        

  <?php }  ?>

  </table>
</div>

<?php include('footer.php'); ?>