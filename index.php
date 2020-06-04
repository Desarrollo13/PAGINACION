<?php 

include_once'conexion.php';

//vamos a llamar a todos los articulos con la sentencia sql
$sql='SELECT * FROM articulos';
$sentencia=$pdo->prepare($sql);
$sentencia->execute();
$resultado=$sentencia->fetchAll();
var_dump($resultado);



?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Paginacion!</title>
</head>

<body>
    
    <div class="container my-5">
        <h1 class="mb-5">Paginacion</h1>
        <?php  foreach ($resultado as $articulo): { }?>

        <div class="alert alert-primary" role="alert">
            <?php  echo $articulo ?>
        </div>
        <?php  endforeach ?>
        <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
    </div>
    

   
</body>

</html>