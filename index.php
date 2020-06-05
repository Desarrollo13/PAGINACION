<?php 

include_once'conexion.php';

//vamos a llamar a todos los articulos con la sentencia sql
$sql='SELECT * FROM articulos';
$sentencia=$pdo->prepare($sql);
$sentencia->execute();
$resultado=$sentencia->fetchAll();
// var_dump($resultado);
$articulos_x_pagina=3;
//contar articulos de nuestra base de datos
$total_articulos_db=$sentencia->rowCount();
// echo $total_articulos_db;
$paginas=$total_articulos_db/3;
$paginas=ceil($paginas);
// echo $paginas;



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
        
        <h1 class="mb-5">Paginaciòn</h1>

        <?php 
        
        if(!$_GET){
            header('Location:index.php?pagina=1');        
        } 
        //si esta condicion es mayor que 10 entonces renderizamos por que si el cliente pone 10 que sobre pase nuestro limite

        if($_GET['pagina']>$paginas || $_GET['pagina']<=0 ){
            header('Location:index.php?pagina=1');        

        }
        //variable para remplazar en forma dinamica 0,3
        $iniciar=($_GET['pagina']-1) * $articulos_x_pagina;
        // echo $iniciar;
        //vamos a hacer el pasaje de entero a string ya que en inicio devuelve un valor entero

        $sql_articulos = 'SELECT * FROM articulos LIMIT :iniciar,:narticulos';
        $sentencia_articulos = $pdo->prepare($sql_articulos);
        $sentencia_articulos->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
        $sentencia_articulos->bindParam(':narticulos', $articulos_x_pagina, PDO::PARAM_INT);      
        $sentencia_articulos->execute();

        $resultado_articulos=$sentencia_articulos->fetchAll();        
       
        ?>   
        
        <?php  foreach ($resultado_articulos as $articulo): ?>

        <div class="alert alert-primary" role="alert">
            <?php  echo $articulo['titulo'] ?>
        </div>
        <?php  endforeach ?>
        <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item
            <?php echo $_GET['pagina'] <=1? 'disabled':''?>">
                <a class="page-link" 
                href ="index.php?pagina=<?php echo  $_GET['pagina']-1 ?>">
                    Anterior
                </a>
            </li>


            <?php for ($i=0; $i <$paginas ; $i++): ?>                
           
            <li class="page-item 
            <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?> ">
                <a class="page-link"
                href="index.php?pagina=<?php echo $i+1 ?>">
                    <?php echo $i+1 ?>
                </a>
            </li>
             <?php endfor ?>

            <li class="page-item 
            <?php echo $_GET['pagina'] >=$paginas? 'disabled':''?>">
                


                <a class="page-link"
            href ="index.php?pagina=<?php echo  $_GET['pagina']+1 ?>">Siguiente</a></li>
        </ul>
    </nav>
    </div>
    

   
</body>

</html>